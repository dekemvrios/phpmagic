<?php

namespace Solis\PhpValidator\Classes;

use Solis\PhpValidator\Abstractions\ValidatorAbstract;
use Solis\PhpValidator\Contracts\ValidatorContract;

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
     * @return ValidatorContract
     */
    public static function make($schema)
    {
        return new self(
            $schema,
            StringValidator::make(),
            FloatValidator::make(),
            IntValidator::make()
        );
    }

}