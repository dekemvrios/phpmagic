<?php

namespace Solis\PhpValidator\Abstractions;

use Solis\PhpValidator\Contracts\StringValidatorContract;
use Solis\PhpValidator\Helpers\Types;

/**
 * Class StringValidatorAbstract
 *
 * @package Solis\PhpValidator\Abstractions
 */
abstract class StringValidatorAbstract implements StringValidatorContract
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
     * validate
     *
     * @param string $name
     * @param mixed  $data
     * @param array  $format
     *
     * @return string
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
                Types::getInvalidTypeMessage(
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

        return (string)$data;
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

            foreach ($format as $item => $value) {

                $compare = !is_string($item) ? $value : $item;

                if ($options['name'] === $compare) {

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