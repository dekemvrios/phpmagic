<?php

namespace Solis\PhpValidator\Abstractions;

use Solis\PhpValidator\Contracts\FloatValidatorContract;
use Solis\PhpValidator\Helpers\Properties;

/**
 * Class FloatValidatorAbstract
 *
 * @package Solis\PhpValidator\Abstractions
 */
abstract class FloatValidatorAbstract implements FloatValidatorContract
{
    /**
     * validate
     *
     * @param       $name
     * @param       $data
     * @param array $format
     *
     * @return float
     *
     * @throws \InvalidArgumentException
     */
    public static function validate(
        $name,
        $data,
        array $format = null
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