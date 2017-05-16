<?php

namespace Solis\PhpValidator\Contracts;

/**
 * Interface StringValidatorContract
 *
 * @package Solis\PhpValidator\Contracts
 */
interface StringValidatorContract
{

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
    );
}