<?php

namespace Solis\Expressive\Magic\Concerns;

use Solis\Expressive\Schema\Contracts\Entries\Property\PropertyContract;
use Solis\Breaker\Abstractions\TExceptionAbstract;
use Solis\Expressive\Magic\Validator\Validator;
use Solis\Expressive\Magic\MagicException;

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
        if (!empty($dados)) {
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
    protected function attach(
        $dados
    ) {
        foreach ($dados as $item => $value) {
            $this->{$item} = $value;
        }
    }

    /**
     * __set
     *
     * @param string $name
     * @param mixed  $value
     *
     * @throws TExceptionAbstract
     */
    public function __set(
        $name,
        $value
    ) {
        if (!property_exists(
            $this,
            $name
        )
        ) {
            $name = $this->___property($name);
        }

        $name instanceof PropertyContract ? $this->___object(
            $name,
            $value
        ) : $this->___set(
            $name,
            $value
        );
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
        if (!property_exists(
            $this,
            $name
        )
        ) {
            throw new MagicException(
                get_class($this),
                __METHOD__,
                "property $name not found in class, review your class or arguments definition",
                400,
                self::$schema->getMeta()
            );
        }

        if (method_exists(
            $this,
            'get' . ucfirst($name)
        )) {
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
        if (!isset(self::$schema)) {
            throw new MagicException(
                get_class($this),
                __METHOD__,
                'property schema has not been defined, review your class definition',
                400,
                self::$schema->getMeta()
            );
        }

        $meta = self::$schema->getPropertyEntryByIdentifier(
            $name,
            'alias'
        );

        $meta = is_array($meta) ? $meta[0] : $meta;

        if (empty($meta)) {
            throw new MagicException(
                get_class($this),
                __METHOD__,
                "property $name not found in schema, review your schema definition",
                400,
                self::$schema->getMeta()
            );
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
    private function ___set(
        $name,
        $value
    ) {
        $isRequired = self::$schema->getPropertyEntryByIdentifier(
            $name
        )->getBehavior()->isRequired();

        if (is_null($value) && !empty($isRequired)) {
            throw new MagicException(
                __CLASS__,
                __METHOD__,
                "value for property [ {$name} ] set as required cannot be null",
                400,
                self::$schema->getMeta()
            );
        }

        if (!is_null($value)) {
            $value = Validator::make(self::$schema)->validate(
                $name,
                $value
            );
        }

        if (method_exists(
            $this,
            'set' . ucfirst($name)
        )) {
            $this->{'set' . ucfirst($name)}($value);
        } else {
            $this->{$name} = $value;
        }
    }

    /**
     * ___object
     *
     * @param PropertyContract $meta
     * @param mixed            $value
     *
     * @throws MagicException
     */
    private function ___object(
        $meta,
        $value
    ) {

        $instance = $this->___attForeign(
            $value,
            $meta
        );

        $this->{$meta->getProperty()} = !empty($instance) ? $instance : null;
    }

    /**
     * ___attForeign
     *
     * @param array            $value
     * @param PropertyContract $meta
     *
     * @return array
     * @throws MagicException
     */
    private function ___attForeign(
        array $value,
        $meta
    ) {

        $value = count(
            array_filter(
                array_keys($value),
                'is_string'
            )
        ) > 0 ? [$value] : $value;

        $aInstance = [];
        foreach ($value as $item) {
            // dependency class
            $class = $meta->getComposition()->getClass();

            if (empty($item) || !is_array($item)) {
                throw new MagicException(
                    __CLASS__,
                    __METHOD__,
                    "meta information for {$meta->getAlias()} expects an associative array as supplied argument",
                    500,
                    self::$schema->getMeta()
                );
            }

            // calling by default its make method
            $instance = call_user_func_array(
                [$class, 'make'],
                [$item]
            );

            if (empty($instance) || !is_object($instance)) {
                throw new MagicException(
                    __CLASS__,
                    __METHOD__,
                    "application can't create instance of {$class}, verify your class make method",
                    500,
                    self::$schema->getMeta()
                );
            }
            $aInstance[] = $instance;
        }

        return count($aInstance) === 1 ? $aInstance[0] : $aInstance;
    }
}