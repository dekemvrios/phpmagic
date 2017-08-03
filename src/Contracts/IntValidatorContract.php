<?php

namespace Solis\Expressive\Magic\Contracts;

use Solis\Breaker\Abstractions\TExceptionAbstract;

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
     * @throws TExceptionAbstract
     */
    public function validate(
        $name,
        $data,
        $format = null
    );
}
