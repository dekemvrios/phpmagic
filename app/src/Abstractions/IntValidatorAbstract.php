<?php

namespace Solis\PhpValidator\Abstractions;

use Solis\PhpValidator\Contracts\IntValidatorContract;
use Solis\PhpValidator\Helpers\Types;

/**
 * Class IntValidatorAbstract
 *
 * @package Solis\PhpValidator\Abstractions
 */
abstract class IntValidatorAbstract implements IntValidatorContract
{

    /**
     * validate
     *
     * @param       $name
     * @param       $data
     * @param array $format
     *
     * @return int
     *
     * @throws \InvalidArgumentException
     */
    public static function validate(
        $name,
        $data,
        array $format = null
    ) {
        if (!is_numeric($data) || !is_int(intval($data))) {
            throw new \InvalidArgumentException(
                Types::getInvalidTypeMessage(
                    [
                        '@name' => $name,
                        '@type' => 'int'
                    ]
                )
            );
        }

        return intval($data);

    }
}