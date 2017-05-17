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
        foreach (self::$formatting as $options) {

            foreach ($format as $item => $value) {

                $compare = !is_string($item) ? $value : $item;

                if ($options['name'] === $compare) {

                    $method = $options['function'];

                    $class = !empty($options['class']) ? $options['class'] : null;

                    if (isset($options['params'])) {
                        $data = !empty($class) ? $class::$method(
                            $data,
                            $format[$options['name']]
                        ) : self::$method(
                            $data,
                            $format[$options['name']]
                        );
                    } else {
                        $data = !empty($class) ? $class::$method($data) : self::$method($data);
                    }

                }
            }
        }

        return $data;
    }

}