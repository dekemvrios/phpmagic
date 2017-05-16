<?php

namespace Solis\PhpValidator\Types;

use Solis\PhpValidator\Helpers\Properties;

/**
 * Class FloatValidator
 *
 * @package Solis\PhpValidator\Types
 */
class FloatValidator
{

    /**
     * validate
     *
     * @param       $name
     * @param       $data
     * @param array $options
     *
     * @return float
     *
     * @throws \InvalidArgumentException
     */
    public static function validate(
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