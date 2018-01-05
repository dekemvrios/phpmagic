<?php

namespace Solis\Expressive\Magic\Concerns;

use Solis\Expressive\Magic\Exception;
use Solis\Expressive\Schema\Contracts\Entries\Property\PropertyContract;
use Solis\Breaker\Abstractions\TExceptionAbstract;
use Solis\Expressive\Magic\Validator\Validator;
use Solis\Expressive\Magic\Validator\Types;

/**
 * Trait HasMagic
 *
 * @package Solis\Expressive\Magic\Concerns
 */
trait HasMagic
{

    use HasSchema;

    /**
     * make
     *
     * @param $dados
     *
     * @return static
     */
    public static function make($dados = [])
    {
        $instance = new static();

        if ($dados) {
            $instance->attach($dados);
        }

        return $instance;
    }

    /**
     * attach
     *
     * @param array $dados
     *
     * @throws \InvalidArgumentException
     */
    public function attach($dados)
    {
        foreach ($dados as $item => $value) {
            $this->{$item} = $value;
        }

        $this->withDefaultValuesValidation();
    }

    /**
     * withDefaultValues
     *
     * @return $this
     */
    private function withDefaultValuesValidation()
    {
        /**
         * @var PropertyContract[] $propertiesWithDefault
         */
        $propertiesWithDefault = $this::$schema->getPropertiesWithDefaultValue();
        if (!$propertiesWithDefault) {
            return $this;
        }

        foreach ($propertiesWithDefault as $property) {
            if (is_null($this->{$property->getProperty()})) {
                $this->{$property->getAlias()} = $property->getDefault();
            }
        }

        return $this;
    }

    /**
     * withNotNull
     *
     * @return $this
     *
     * @throws TExceptionAbstract
     */
    public function withNotNull()
    {
        /**
         * @var PropertyContract[] $propertiesWithNotNull
         */
        $propertiesWithNotNull = $this::$schema->getPropertiesWithNotNullConstraint();
        if (!$propertiesWithNotNull) {
            return $this;
        }

        foreach ($propertiesWithNotNull as $property) {
            if (is_null($this->{$property->getProperty()})) {
                throw new Exception("Propriedade obrigatória não pode ser nula [ " . $property->getAlias() . " ]", 400);
            }
        }

        return $this;
    }

    /**
     * __set
     *
     * @param string $name
     * @param mixed  $value
     *
     * @return mixed
     *
     * @throws TExceptionAbstract
     */
    public function __set($name, $value)
    {
        if (!property_exists($this, $name)) {
            $name = $this->___property($name);

            if (!$name) {
                return false;
            }
        }

        $name instanceof PropertyContract ? $this->___object($name, $value) : $this->___set($name, $value);
    }

    /**
     * __get
     *
     * @param $name
     *
     * @return mixed
     *
     * @throws TExceptionAbstract
     */
    public function __get($name)
    {
        if (!property_exists($this, $name)) {

            if (empty(Types::$TYPE_STRICT)) {
                return false;
            }

            throw new Exception("Tentativa de acesso a propridade [ {$name} ] não definida na classe", 400);
        }

        if (method_exists($this, 'get' . ucfirst($name))) {
            return $this->{'get' . ucfirst($name)}();
        }

        return $this->$name;
    }

    /**
     * __property
     *
     * @param $name
     *
     * @return mixed
     * @throws TExceptionAbstract
     */
    private function ___property($name)
    {
        $meta = self::$schema->getPropertyEntryByIdentifier($name, 'alias');

        $meta = is_array($meta) ? $meta[0] : $meta;

        if (!$meta) {

            if (!Types::$TYPE_STRICT) {
                return false;
            }

            throw new Exception("Tentativa de acesso a propridade [ {$name} ] não definida no schema", 400);
        }

        return !empty($meta->getComposition()) ? $meta : $meta->getProperty();
    }

    /**
     * ___set
     *
     * @param $name
     * @param $value
     *
     * @throws TExceptionAbstract
     */
    private function ___set($name, $value)
    {
        /**
         * @var PropertyContract $meta
         */
        $meta = self::$schema->getPropertyEntryByIdentifier($name);

        if (!$meta) {
            return;
        }

        $isRequired = $meta->getBehavior()->isRequired();

        if (is_null($value) && $isRequired) {
            throw new Exception("Propriedade obrigatória não pode ser nula [ " . $name . " ]", 400);
        }

        if ($value) {
            $value = Validator::make(self::$schema)->validate($name, $value);

            if ($meta->getAllowedValues()) {

                if (!in_array($value, $meta->getAllowedValues())) {

                    $msg = "Valor [ {$value} ] para [ {$name} ] esta fora do intervalo permitido ";
                    $msg .= '[ ' . implode(',', $meta->getAllowedValues()) . ' ]';

                    throw new Exception($msg, 400);
                }
            }
        }

        if (method_exists($this, 'set' . ucfirst($name))) {
            $this->{'set' . ucfirst($name)}($value);
        } else {
            $this->{$name} = $value;
        }
    }

    /**
     * @param PropertyContract $meta
     * @param                  $value
     */
    private function ___object($meta, $value)
    {
        $instance = $this->___attForeign($value, $meta);

        $this->{$meta->getProperty()} = $instance ? $instance : null;
    }

    /**
     * @param                  $value
     * @param PropertyContract $meta
     *
     * @return array|bool|mixed|string
     * @throws Exception
     */
    private function ___attForeign($value, $meta)
    {

        if (!$value) {
            return false;
        }

        $value = count(
            array_filter(
                array_keys($value),
                'is_string'
            )
        ) > 0 ? [$value] : $value;

        $aInstance = [];
        foreach ($value as $item) {

            $class = $meta->getComposition()->getClass();

            if (!$item || !is_array($item)) {
                $msg = "Tentativa de atribuição de dependência [ {$meta->getAlias()} ] com valor não array.";

                throw new Exception($msg, 400);
            }

            $instance = call_user_func_array([$class, 'make'], [$item]);

            if ($meta->getType() === 'json') {
                $instance->withNotNull();

                $instance = $instance->toArray(true);
            }

            $aInstance[] = $instance;
        }

        $aInstance = count($aInstance) === 1 ? $aInstance[0] : $aInstance;

        if ($meta->getType() === 'json') {
            $aInstance = json_encode($aInstance);
        }

        return $aInstance;
    }
}
