<?php

namespace Solis\PhpMagic\Helpers;

use Solis\PhpMagic\Classes\Schema\Schema;
use Solis\PhpMagic\Classes\Validator;
use Solis\Breaker\TException;
use Solis\PhpMagic\Contracts\Schema\SchemaContract;
use Solis\PhpMagic\Contracts\Schema\SchemaEntryContract;

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
     * @param $dados
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
     * @param $name
     * @param $value
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

        $name instanceof Schema ? $this->attForeign(
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

        $meta = $this->schema->getEntry(
            'name',
            $name
        );
        if (empty($meta) || !is_array($meta)) {
            throw new TException(
                get_class($this),
                __METHOD__,
                "property $name not found in schema, review your schema definition",
                400
            );
        }

        return !empty($meta[0]->getObject()) ? $meta[0] : $meta[0]->getProperty();
    }

    /**
     * ___set
     *
     * @param $name
     * @param $value
     */
    private function ___set(
        $name,
        $value
    ) {
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

    /**
     * attForeign
     *
     * @param SchemaEntryContract $meta
     * @param mixed               $value
     *
     * @throws TException
     */
    private function attForeign(
        $meta,
        $value
    ) {

        $instance = is_array($value) ? $this->attForeignArrayValue(
            $value,
            $meta
        ) : $this->attForeignSingleValue(
            $value,
            $meta
        );

        $this->{$meta['property']} = !empty($instance) ? $instance : null;
    }

    /**
     * attArrayValue
     *
     * @param mixed               $value
     * @param SchemaEntryContract $meta
     *
     * @return array
     * @throws TException
     */
    private function attForeignArrayValue(
        $value,
        $meta
    ) {
        $aInstance = [];
        foreach ($value as $item) {
            $class = $meta->getObject()->getClass();

            $property = $meta->getObject()->getProperty();

            $instance = new $class();

            if (is_array($property)) {
                foreach ($property as $prop) {
                    if (!is_array($item)) {
                        throw new TException(
                            get_class($this),
                            __METHOD__,
                            "supplied value must be an key value array as specified in " . $meta->getName() . " schema",
                            '400'
                        );
                    }

                    $instance->{$prop} = array_key_exists(
                        $prop,
                        $item
                    ) ? $item[$prop] : null;
                }
            } else {
                $instance->{$property} = $item;
            }

            $aInstance[] = $instance;
        }

        return $aInstance;
    }

    /**
     * attForeignSingleValue
     *
     * @param mixed               $value
     * @param SchemaEntryContract $meta
     *
     * @return mixed
     * @throws TException
     */
    private function attForeignSingleValue(
        $value,
        $meta
    ) {
        $class = $meta->getObject()->getClass();
        $property = $meta->getObject()->getClass()->getProperty();

        $instance = new $class();
        $instance->{$property} = $value;

        return $instance;
    }
}
