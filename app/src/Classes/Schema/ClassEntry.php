<?php

namespace Solis\PhpMagic\Classes\Schema;

use Solis\PhpMagic\Abstractions\Schema\ClassEntryAbstract;
use Solis\Breaker\TException;

/**
 * Class ClassEntry
 *
 * @package Solis\PhpMagic\Classes\Schema
 */
class ClassEntry extends ClassEntryAbstract
{

    /**
     * make
     *
     * @param $class
     *
     * @return static
     * @throws TException
     */
    public static function make($class)
    {
        if (!array_key_exists(
            'class',
            $class
        )
        ) {
            throw new TException(
                __CLASS__,
                __METHOD__,
                'not found key class in schema for class',
                400
            );
        }

        if (!class_exists($class['class'])) {
            throw new TException(
                __CLASS__,
                __METHOD__,
                "class {$class['class']} has not been defined",
                400
            );
        }

        if (!array_key_exists(
            'name',
            $class
        )
        ) {
            throw new TException(
                __CLASS__,
                __METHOD__,
                'not found key name in schema for class',
                400
            );
        }

        return new static(
            $class['class'],
            $class['name']
        );
    }
}
