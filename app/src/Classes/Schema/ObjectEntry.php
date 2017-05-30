<?php

namespace Solis\PhpMagic\Classes\Schema;

use Solis\PhpMagic\Abstractions\Schema\ObjectEntryAbstract;
use Solis\PhpMagic\Classes\Schema\DatabaseEntry;
use Solis\Breaker\TException;

/**
 * Class ObjectEntry
 *
 * @package Solis\PhpMagic\Classes\Schema
 */
class ObjectEntry extends ObjectEntryAbstract
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
                'not found key class in schema for schema object entry',
                400
            );
        }

        if (!class_exists($class['class'])) {
            throw new TException(
                __CLASS__,
                __METHOD__,
                "class {$class['class']} has not been defined for schema object entry",
                400
            );
        }

        if (!array_key_exists(
            'property',
            $class
        )
        ) {
            throw new TException(
                __CLASS__,
                __METHOD__,
                'not found key property in schema for schema object entry',
                400
            );
        }

        $instance = new static(
            $class['class'],
            $class['property']
        );

        if (array_key_exists(
            'database',
            $class
        )) {

            if (!is_array($class['database'])) {
                throw new TException(
                    __CLASS__,
                    __METHOD__,
                    'key database is not of the espected type array',
                    400
                );
            }

            $databases = [];
            foreach ($class['database'] as $database) {
                $databases[] = DatabaseEntry::make($database);
            }
            $instance->setDatabase($databases);
        }

        return $instance;
    }
}
