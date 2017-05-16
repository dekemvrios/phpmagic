<?php

namespace Solis\PhpValidator\Types;

use Solis\PhpValidator\Helpers\Properties;

/**
 * Class StringValidator
 *
 * @package Solis\PhpValidator\Types
 */
class StringValidator
{
    /**
     * @var array
     */
    static $formatting = [
        ['name' => 'size', 'function' => 'applySize', 'params' => true],
        ['name' => 'uppercase', 'function' => 'applyUppercase'],
        ['name' => 'lowercase', 'function' => 'applyLowercase']
    ];

    /**
     * validateString
     *
     * @param string $name
     * @param mixed  $data
     * @param array  $format
     *
     * @return mixed
     *
     * @throws \InvalidArgumentException
     */
    public static function validate(
        string $name,
        $data,
        array $format = null
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

        if (!empty($format)) {
            $data = self::applyFormat(
                $format,
                $data
            );
        }

        return $data;
    }

    /**
     * filterOptions
     *
     * @param array $format
     * @param mixed $data
     *
     * @return string
     */
    private static function applyFormat(
        $format,
        $data
    ) {
        foreach (self::$formatting as $options) {
            if (array_key_exists(
                $options['name'],
                $format
            )) {
                $method = $options['function'];

                if (isset($options['params'])) {
                    $data = self::$method(
                        $data,
                        $format[$options['name']]
                    );
                } else {
                    $data = self::$method($data);
                }
            }
        }

        return $data;
    }

    /**
     * applySize
     *
     * @param string $data
     * @param int    $size
     *
     * @return string
     */
    private static function applySize(
        $data,
        $size
    ) {
        return substr(
            $data,
            0,
            intval($size)
        );
    }

    /**
     * applySize
     *
     * @param string $data
     *
     * @return string
     */
    private static function applyUppercase(
        $data
    ) {
        return strtoupper($data);
    }

    /**
     * applyLowercase
     *
     * @param string $data
     *
     * @return string
     */
    private static function applyLowercase(
        $data
    ) {
        return strtolower($data);
    }

}