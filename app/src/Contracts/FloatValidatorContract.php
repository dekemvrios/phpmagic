<?php

namespace Solis\PhpValidator\Contracts;

/**
 * Interface FloatValidatorContract
 *
 * @package Solis\PhpValidator\Contracts
 */
interface FloatValidatorContract
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
    );
}