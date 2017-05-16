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
     * @param $schema
     *
     * @return static
     */
    public static function make($schema)
    {
        return new self($schema);
    }

}