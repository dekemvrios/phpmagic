<?php

namespace Solis\PhpValidator\Classes;

use Solis\PhpValidator\Abstractions\ValidatorAbstract;

/**
 * Class Validator
 *
 * @package Solis\PhpValidator\Classes
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