<?php

namespace Solis\PhpMagic\Helpers;

use Solis\PhpMagic\Classes\Validator;
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

        is_array($name) ? $this->attForeign(
            $name,
            $value
        ) : $this->attOwn(
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
                Message::getTextMessage(
                    [
                        '@name'  => $name,
                        '@class' => get_class($this),
                    ],
                    Message::PROPERTY_NOT_FOUND
                ),
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
                Message::getTextMessage(
                    [
                        '@name'  => 'schema',
                        '@class' => get_class($this),
                    ],
                    Message::PROPERTY_NOT_FOUND
                ),
                '400'
            );
        }

        $meta = array_values(
            array_filter(
                $this->schema,
                function ($schemaItem) use
                (
                    $name
                ) {
                    if (!array_key_exists(
                        'name',
                        $schemaItem
                    )
                    ) {
                        throw new TException(
                            get_class($this),
                            __METHOD__,
                            'invalid schema definition',
                            '400'
                        );
                    }

                    return $schemaItem['name'] === $name ? true : false;
                }
            )
        );

        if (empty($meta) || !array_key_exists(
                'property',
                $meta[0]
            )
        ) {
            throw new TException(
                get_class($this),
                __METHOD__,
                Message::getTextMessage(
                    [
                        '@name'  => $name,
                        '@class' => __CLASS__,
                    ],
                    Message::PROPERTY_NOT_FOUND
                ) . ' schema',
                '400'
            );
        }

        return array_key_exists(
            'class',
            $meta[0]
        ) ? $meta[0] : $meta[0]['property'];
    }

    /**
     * attOwn
     *
     * @param $name
     * @param $value
     */
    private function attOwn(
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
     * @param $meta
     * @param $value
     *
     * @throws TException
     */
    private function attForeign(
        $meta,
        $value
    ) {

        if (!property_exists(
            $this,
            $meta['property']
        )
        ) {
            throw new TException(
                get_class($this),
                __METHOD__,
                Message::getTextMessage(
                    [
                        '@name'  => $meta['property'],
                        '@class' => get_class($this),
                    ],
                    Message::PROPERTY_NOT_FOUND
                ) . ' schema',
                '400'
            );
        }

        if (!class_exists($meta['class']['class'])) {
            throw new TException(
                get_class($this),
                __METHOD__,
                "class not found {$meta['class']['class']}",
                '400'
            );
        }

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
     * @param $value
     * @param $meta
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
            $instance = new $meta['class']['class'];

            if (is_array($meta['class']['name'])) {
                foreach ($meta['class']['name'] as $property) {
                    if (!is_array($item)) {
                        throw new TException(
                            get_class($this),
                            __METHOD__,
                            "supplied value must be an key value array as specified in {$meta['name']} schema",
                            '400'
                        );
                    }

                    $instance->{$property} = array_key_exists(
                        $property,
                        $item
                    ) ? $item[$property] : null;
                }
            } else {
                $instance->{$meta['class']['name']} = $item;
            }

            $aInstance[] = $instance;
        }

        return $aInstance;
    }

    /**
     * attForeignSingleValue
     *
     * @param $value
     * @param $meta
     *
     * @return mixed
     * @throws TException
     */
    private function attForeignSingleValue(
        $value,
        $meta
    ) {
        $instance = new $meta['class']['class'];

        if (!is_string($meta['class']['name'])) {
            throw new TException(
                get_class($this),
                __METHOD__,
                "invalid type for property {$meta['class']['name']}",
                '400'
            );
        }

        $instance->{$meta['class']['name']} = $value;

        return $instance;
    }
}
