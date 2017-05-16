<?php

namespace Solis\PhpValidator\Types;

use Solis\PhpValidator\Helpers\Properties;

/**
 * Class IntValidator
 *
 * @package Solis\PhpValidator\Types
 */
class IntValidator
{
    /**
     * validateInt
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
}