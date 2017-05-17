<?php

namespace Solis\PhpValidator\Helpers;

use Solis\PhpValidator\Classes\Validator;

/**
 * Class Magic
 *
 * @package Solis\PhpValidator\Helpers
 */
trait MagicAlone
{

    /**
     * attach
     *
     * @param $dados
     *
     * @return static
     */
    public function attach(
        $dados
    ) {

        $object = (new \ReflectionClass($this))->newInstance();

        foreach ($dados as $item => $value) {
            $object->$item = $value;
        }

        return $object;
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
            __CLASS__,
            $name
        )
        ) {
            $name = $this->___property($name);
        }

        $validator = Validator::make($this->schema);
        if (!empty($validator)) {
            $value = $validator->validate(
                $name,
                $value
            );
        }

        if (method_exists(
            __CLASS__,
            'set' . ucfirst($name)
        )) {
            call_user_func_array(
                __CLASS__ . '::' . 'set' . ucfirst($name),
                [$value]
            );
        } else {
            $this->$name = $value;
        }
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
            __CLASS__,
            $name
        )
        ) {
            throw new \InvalidArgumentException(
                Properties::getNotFoundMessage(
                    [
                        '@name'  => $name,
                        '@class' => __CLASS__
                    ]
                )
            );
        }

        if (method_exists(
            $this,
            'get' . ucfirst($name)
        )) {
            return call_user_func(__CLASS__ . '::' . 'get' . ucfirst($name));
        }

        return $this->$name;

    }

    /**
     * @return string
     */
    public function ___property($name)
    {
        $meta = array_values(
            array_filter(
                $this->schema,
                function ($schemaItem) use
                (
                    $name
                ) {
                    return $schemaItem['name'] === $name ? true : false;
                }
            )
        );

        if (empty($meta)) {
            throw new \InvalidArgumentException(
                Properties::getNotFoundMessage(
                    [
                        '@name'  => $name,
                        '@class' => __CLASS__
                    ]
                )
            );
        }

        return $meta[0]['property'];
    }

}