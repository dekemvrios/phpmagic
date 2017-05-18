<?php

namespace Solis\PhpValidator\Contracts;

/**
 * Class StringValidatorContract
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
    public function validate(
        string $name,
        $data,
        array $format = null
    );
}