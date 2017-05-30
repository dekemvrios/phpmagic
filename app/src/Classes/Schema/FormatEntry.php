<?php

namespace Solis\PhpMagic\Classes\Schema;

use Solis\Breaker\TException;
use Solis\PhpMagic\Abstractions\Schema\FormatEntryAbstract;

/**
 * Class FormatEntry
 *
 * @package Solis\PhpMagic\Classes\Schema
 */
class FormatEntry extends FormatEntryAbstract
{

    /**
     * @param $format
     *
     * @return self
     * @throws TException
     */
    public static function make($format)
    {
        if (!array_key_exists(
            'function',
            $format
        )
        ) {
            throw new TException(
                __CLASS__,
                __METHOD__,
                'key function not found in schema',
                400
            );
        }
        $instance = new self($format['function']);

        if (array_key_exists(
            'class',
            $format
        )) {
            if (!class_exists($format['class'])) {
                throw new TException(
                    __CLASS__,
                    __METHOD__,
                    "class {$format['class']} has not been defined",
                    400
                );
            }

            if (!method_exists(
                $format['class'],
                $format['function']
            )) {
                throw new TException(
                    __CLASS__,
                    __METHOD__,
                    "not found function {$format['function']} in class {$format['class']}",
                    400
                );
            }

            $instance->setClass($format['class']);
        }

        if (array_key_exists(
            'params',
            $format
        )) {
            $instance->setParams($format['params']);
        }

        return $instance;
    }
}
