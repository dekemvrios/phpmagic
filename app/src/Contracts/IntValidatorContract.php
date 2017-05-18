<?php

namespace Solis\PhpValidator\Contracts;

/**
 * Class IntValidatorContract
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
    public function validate(
        $name,
        $data,
        $format = null
    );
}