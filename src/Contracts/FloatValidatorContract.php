<?php

namespace Solis\Expressive\Magic\Contracts;

use Solis\Breaker\Abstractions\TExceptionAbstract;

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
     * @throws TExceptionAbstract
     */
    public function validate(
        $name,
        $data,
        $format = null
    );
}
