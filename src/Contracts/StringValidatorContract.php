<?php

namespace Solis\Expressive\Magic\Contracts;

use Solis\Breaker\Abstractions\TExceptionAbstract;

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
     * @throws TExceptionAbstract
     */
    public function validate(
        $name,
        $data,
        $format = null
    );
}
