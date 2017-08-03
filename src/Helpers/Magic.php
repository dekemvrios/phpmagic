<?php

namespace Solis\Expressive\Magic\Helpers;

use Solis\Expressive\Schema\Contracts\Entries\Property\PropertyContract;
use Solis\Expressive\Magic\Classes\Validator;
use Solis\Breaker\TException;

/**
 * Class Magic
 *
 * @package Solis\PhpValidator\Helpers
 */
trait Magic
{

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
     * @throws TException
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
     * @throws TException
     */
    public function __get($name)
    {
        if (!property_exists(
            $this,
            $name
        )
        ) {
            throw new TException(
                get_class($this),
                __METHOD__,
                "property $name not found in class, review your class or arguments definition",
                '400'
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
     * @throws TException
     */
    private function ___property($name)
    {
        if (!property_exists(
                $this,
                'schema'
            ) || empty($this->schema)
        ) {

            throw new TException(
                get_class($this),
                __METHOD__,
                'property schema has not been defined, review your class definition',
                '400'
            );
        }

        $meta = $this->schema->getPropertyEntryByIdentifier(
            $name,
            'alias'
        );

        $meta = is_array($meta) ? $meta[0] : $meta;

        if (empty($meta)) {
            throw new TException(
                get_class($this),
                __METHOD__,
                "property $name not found in schema, review your schema definition",
                400
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
     * @throws TException
     */
    private function ___set(
        $name,
        $value
    ) {
        $isRequired = $this->schema->getPropertyEntryByIdentifier(
            $name
        )->getBehavior()->isRequired();

        if (is_null($value) && !empty($isRequired)) {
            throw new TException(
                __CLASS__,
                __METHOD__,
                "value for property [ {$name} ] set as required cannot be null",
                400
            );
        }

        if (!is_null($value)) {
            $value = Validator::make($this->schema)->validate(
                $name,
                $value
            );

            if (method_exists(
                $this,
                'set' . ucfirst($name)
            )) {
                $this->{'set' . ucfirst($name)}($value);
            } else {
                $this->{$name} = $value;
            }
        }
    }

    /**
     * ___object
     *
     * @param PropertyContract $meta
     * @param mixed            $value
     *
     * @throws TException
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
     * @throws TException
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
            // callable class
            $class = $meta->getComposition()->getClass();

            if (empty($item) || !is_array($item)) {
                throw new TException(
                    __CLASS__,
                    __METHOD__,
                    "meta information for {$meta->getAlias()} expects an associative array as supplied argument",
                    500
                );
            }

            // calling by default its make method, if its exists
            $instance = call_user_func_array(
                [$class, 'make'],
                [$item]
            );

            if (empty($instance) || !is_object($instance)) {
                throw new TException(
                    __CLASS__,
                    __METHOD__,
                    "application can't create instance of {$class}, verify your class make method",
                    500
                );
            }
            $aInstance[] = $instance;
        }

        return count($aInstance) === 1 ? $aInstance[0] : $aInstance;
    }

    /**
     * toArray
     *
     * @param boolean $asAlias
     *
     * @throws TException
     *
     * @return array
     */
    public function toArray($asAlias = false)
    {

        if (!property_exists(
                $this,
                'schema'
            ) || empty($this->schema)
        ) {
            throw new TException(
                __CLASS__,
                __METHOD__,
                "schema property has not been defined at " . get_class($this),
                500
            );
        }

        $method = !empty($asAlias) ? "getAlias" : "getProperty";

        $dados = [];
        foreach ($this->schema->getProperties() as $item) {
            $value = $this->{$item->getProperty()};

            if (!is_null($value)) {
                if (is_array($value)) {
                    $dados[$item->{$method}()] = [];
                    foreach ($value as $valueItem) {
                        $dados[$item->{$method}()][] = is_object($valueItem) ? $valueItem->toArray(!empty($asAlias) ? $asAlias : false) : $valueItem;
                    }
                } else {
                    $dados[$item->{$method}()] = is_object($value) ? $value->toArray(!empty($asAlias) ? $asAlias : false) : $value;
                }
            }
        }

        return $dados;
    }
}
