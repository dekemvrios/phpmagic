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
        [
            'name'     => 'size',
            'function' => 'applySize',
            'params'   => true,
            'class'    => 'Solis\\PhpValidator\\Format\\StringFormat'
        ],
        [
            'name'     => 'uppercase',
            'function' => 'applyUppercase',
            'class'    => 'Solis\\PhpValidator\\Format\\StringFormat'
        ],
        [
            'name'     => 'lowercase',
            'function' => 'applyLowercase',
            'class'    => 'Solis\\PhpValidator\\Format\\StringFormat'
        ],
        [
            'name'     => 'noSpecialChars',
            'function' => 'removeSpecialChars',
            'class'    => 'Solis\\PhpValidator\\Format\\StringFormat'
        ]
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
        $bHasCustomFormat = false;

        foreach (self::$formatting as $options) {

            foreach ($format as $item => $value) {

                if (!is_array($value)) {
                    $compare = !is_string($item) ? $value : $item;

                    if ($options['name'] === $compare) {

                        $data = self::applyDefaultFormat(
                            $format,
                            $options,
                            $data
                        );

                    }
                } else {
                    $bHasCustomFormat = true;
                }
            }

        }

        if (!empty($bHasCustomFormat)) {
            $data = self::applyCustomFormat(
                $format,
                $data
            );
        }

        return $data;
    }

    /**
     * appluCustomFormat
     *
     * @param $format
     * @param $data
     *
     * @return string
     */
    public function applyCustomFormat(
        $format,
        $data
    ) {

        foreach ($format as $key => $value) {

            if (is_array($value)) {
                $class = array_key_exists(
                    'class',
                    $value
                ) ? $value['class'] : null;

                $method = array_key_exists(
                    'function',
                    $value
                ) ? $value['function'] : null;

                $params = array_key_exists(
                    'params',
                    $value
                ) ? $value['params'] : [];

                array_unshift(
                    $params,
                    $data
                );

                if (!empty($class) && !empty($method)) {
                    $data = call_user_func_array(
                        $class . "::" . $method,
                        $params
                    );
                }
            }
        }

        return $data;
    }

    /**
     * applyDefaultFormat
     *
     * @param array $format
     * @param array $options
     * @param array $data
     *
     * @return string
     *
     * @throws \InvalidArgumentException
     */
    public static function applyDefaultFormat(
        $format,
        $options,
        $data
    ) {

        $method = array_key_exists(
            'function',
            $options
        ) ? $options['function'] : null;

        $class = array_key_exists(
            'class',
            $options
        ) ? $options['class'] : null;

        if (empty($method) || empty($class)) {
            return $data;
        }

        $params = isset($options['params']) ? [$format[$options['name']]] : [];

        array_unshift(
            $params,
            $data
        );

        $data = call_user_func_array(
            $class . '::' . $method,
            $params
        );

        if (!is_string($data)) {
            throw new \InvalidArgumentException(
                Types::getInvalidTypeMessage(
                    [
                        '@name' => $class,
                        '@type' => 'string'
                    ]
                )
            );
        }

        return $data;
    }


}