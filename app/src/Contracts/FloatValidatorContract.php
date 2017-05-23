<?php

namespace Solis\PhpMagic\Contracts;

/**
 * Class FloatValidatorContract
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
    public function validate(
        $name,
        $data,
        $format = null
    );
}
