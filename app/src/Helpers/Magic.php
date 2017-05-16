<?php

namespace Solis\PhpValidator\Helpers;

/**
 * Class Magic
 *
 * @package Solis\PhpValidator\Helpers
 */
trait Magic
{

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
}