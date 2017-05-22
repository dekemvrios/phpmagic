<?php

namespace Solis\PhpMagic\Helpers;

use Solis\PhpMagic\Classes\Validator;

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
            $this->$item = $value;
        }
    }

    /**
     * __set
     *
     * @param $name
     * @param $value
     *
     * @throws \InvalidArgumentException
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
     * @throws \InvalidArgumentException
     */
    public function __get($name)
    {
        if (!property_exists(
            $this,
            $name
        )
        ) {
            throw new \InvalidArgumentException(
                Message::getTextMessage(
                    [
                        '@name'  => $name,
                        '@class' => __CLASS__,
                    ],
                    Message::PROPERTY_NOT_FOUND
                )
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
     * @return string
     */
    private function ___property($name)
    {
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
                        throw new \InvalidArgumentException('invalid schema definition');
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
            throw new \InvalidArgumentException(
                Message::getTextMessage(
                    [
                        '@name'  => $name,
                        '@class' => __CLASS__,
                    ],
                    Message::PROPERTY_NOT_FOUND
                ) . ' schema'
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
            $this->$name = $value;
        }
    }

    /**
     * attForeign
     *
     * @param $meta
     * @param $value
     */
    private function attForeign(
        $meta,
        $value
    ) {

        if (!class_exists($meta['class']['class'])) {
            throw new \RuntimeException("class not found {$meta['class']['class']}");
        }

        $instance = new $meta['class']['class'];

        $instance->{$meta['class']['name']} = $value;

        if (!property_exists(
            $this,
            $meta['property']
        )
        ) {
            throw new \InvalidArgumentException(
                Message::getTextMessage(
                    [
                        '@name'  => $meta['property'],
                        '@class' => __CLASS__,
                    ],
                    Message::PROPERTY_NOT_FOUND
                )
            );
        }
        $this->$meta['property'] = $instance;
    }


}