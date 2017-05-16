<?php

namespace Solis\PhpValidator\Helpers;

/**
 * Class Types
 *
 * @package Solis\PhpValidator
 */
class Types
{

    const TYPE_INT = 'int';

    const TYPE_STRING = 'string';

    const TYPE_FLOAT = 'float';

    const TYPE_BOOLEAN = 'bool';


    /**
     * validateString
     *
     * @param string $name
     * @param mixed  $data
     * @param array  $options
     *
     * @return mixed
     *
     * @throws \InvalidArgumentException
     */
    public static function validateString(
        string $name,
        $data,
        array $options = null
    ) {
        if (!is_string($data)) {
            throw new \InvalidArgumentException(
                Properties::getInvalidTypeMessage(
                    [
                        '@name' => $name,
                        '@type' => 'string'
                    ]
                )
            );
        }

        if (!empty($options)) {
            if (array_key_exists(
                'size',
                $options
            )) {
                $data = substr(
                    $data,
                    0,
                    intval($options['size'])
                );
            }
        }

        return $data;
    }

    /**
     * validateInt
     *
     * @param       $name
     * @param       $data
     * @param array $options
     *
     * @return int
     *
     * @throws \InvalidArgumentException
     */
    public static function validateInt(
        $name,
        $data,
        array $options = null
    ) {
        if (!is_numeric($data) || !is_int(intval($data))) {
            throw new \InvalidArgumentException(
                Properties::getInvalidTypeMessage(
                    [
                        '@name' => $name,
                        '@type' => 'int'
                    ]
                )
            );
        }

        return intval($data);

    }

    /**
     * validateFloat
     *
     * @param       $name
     * @param       $data
     * @param array $options
     *
     * @return float
     *
     * @throws \InvalidArgumentException
     */
    public static function validateFloat(
        $name,
        $data,
        array $options = null
    ) {
        if (!is_float(floatval($data))) {
            throw new \InvalidArgumentException(
                Properties::getInvalidTypeMessage(
                    [
                        '@name' => $name,
                        '@type' => 'float'
                    ]
                )
            );
        }

        return floatval($data);
    }

}