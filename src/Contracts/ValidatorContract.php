<?php

namespace Solis\Expressive\Magic\Contracts;

use Solis\Breaker\Abstractions\TExceptionAbstract;

/**
 * Class ValidatorContract
 *
 * @package Solis\PhpValidator\Contracts
 */
interface ValidatorContract
{

    /**
     * validate
     *
     * @param string $name
     * @param mixed  $value
     *
     * @return mixed
     *
     * @throws TExceptionAbstract
     */
    public function validate(
        $name,
        $value
    );
}
