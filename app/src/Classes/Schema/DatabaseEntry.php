<?php

namespace Solis\PhpMagic\Classes\Schema;

use Solis\Breaker\TException;
use Solis\PhpMagic\Abstractions\Schema\DatabaseEntryAbstract;

/**
 * Class DatabaseEntry
 *
 * @package Solis\PhpMagic\Classes\Schema
 */
class DatabaseEntry extends DatabaseEntryAbstract
{

    /**
     * make
     *
     * @param $database
     *
     * @throws TException
     *
     * @return self
     */
    public static function make($database)
    {
        if (!array_key_exists(
            'type',
            $database
        )
        ) {
            throw new TException(
                __CLASS__,
                __METHOD__,
                "key type not found in database entry schema",
                400
            );
        }

        $instance = new self($database['type']);

        if (array_key_exists(
            'source',
            $database
        )) {
            $instance->setSource(SourceEntry::make($database['source']));
        }

        return $instance;
    }
}