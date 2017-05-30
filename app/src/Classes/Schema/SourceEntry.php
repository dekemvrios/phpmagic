<?php

namespace Solis\PhpMagic\Classes\Schema;

use Solis\Breaker\TException;
use Solis\PhpMagic\Abstractions\Schema\SourceEntryAbstract;

/**
 * Class SourceEntry
 *
 * @package Solis\PhpMagic\Classes\Schema
 */
class SourceEntry extends SourceEntryAbstract
{

    /**
     * make
     *
     * @param array $source
     *
     * @return SourceEntry
     * @throws TException
     */
    public static function make($source)
    {
        if (!array_key_exists(
            'field',
            $source
        )
        ) {
            throw new TException(
                __CLASS__,
                __METHOD__,
                "key field not found in database source entry schema",
                400
            );
        }

        if (!array_key_exists(
            'refers',
            $source
        )
        ) {
            throw new TException(
                __CLASS__,
                __METHOD__,
                "key refers not found in database source entry schema",
                400
            );
        }

        return new self(
            $source['field'],
            $source['refers']
        );
    }
}