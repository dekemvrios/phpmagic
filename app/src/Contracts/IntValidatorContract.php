<?php

namespace Solis\PhpValidator\Contracts;

/**
 * Interface intValidatorContract
 *
 * @package Solis\PhpValidator\Contracts
 */
interface IntValidatorContract
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
    );
}