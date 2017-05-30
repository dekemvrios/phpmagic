<?php

namespace Solis\PhpMagic\Classes\Schema;

use Solis\PhpMagic\Abstractions\Schema\SchemaAbstract;
use Solis\Breaker\TException;

/**
 * Class Schema
 *
 * @package Solis\PhpMagic\Classes
 */
class Schema extends SchemaAbstract
{
    /**
     * make
     *
     * @param string $json
     *
     * @return Schema
     * @throws TException
     */
    public static function make($json)
    {
        $schema = json_decode(
            $json,
            true
        );
        if (!$schema) {
            throw new TException(
                __CLASS__,
                __METHOD__,
                "error decoding json schema",
                500
            );
        }

        $instance = new self();
        foreach ($schema as $item) {
            $instance->addEntry(
                SchemaEntry::make($item)
            );
        }

        return $instance;
    }
}
