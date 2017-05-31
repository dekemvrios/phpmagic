<?php

namespace Solis\PhpMagic\Classes;

use Solis\PhpMagic\Abstractions\ValidatorAbstract;
use Solis\PhpMagic\Contracts\Schema\SchemaContract;
use Solis\PhpMagic\Contracts\ValidatorContract;

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
     * @param SchemaContract $schema
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
