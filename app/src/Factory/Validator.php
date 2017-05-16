<?php

namespace Solis\PhpValidator\Factory;

use Solis\PhpValidator\Abstractions\ValidatorAbstract;

/**
 * Class Validator
 *
 * @package Solis\PhpValidator\Factory
 */
class Validator extends ValidatorAbstract
{

    /**
     * make
     *
     * @param $expectedProps
     *
     * @return static
     */
    public static function make($expectedProps)
    {
        return new self($expectedProps);
    }

}