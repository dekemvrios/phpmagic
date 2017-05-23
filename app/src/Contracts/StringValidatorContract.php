<?php

namespace Solis\PhpMagic\Contracts;

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
        $name,
        $data,
        $format = null
    );
}
