<?php

namespace Solis\Expressive\Magic\Validator;

use Solis\Expressive\Magic\Abstractions\ValidatorAbstract;
use Solis\Expressive\Magic\Contracts\ValidatorContract;
use Solis\Expressive\Schema\Contracts\SchemaContract;

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
            StringValidator::make($schema->getMeta()),
            FloatValidator::make($schema->getMeta()),
            IntValidator::make($schema->getMeta())
        );
    }
}
