<?php

namespace Solis\Expressive\Magic\Contracts;

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
     */
    public function validate(
        $name,
        $value
    );
}
