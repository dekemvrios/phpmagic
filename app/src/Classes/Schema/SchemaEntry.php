<?php

namespace Solis\PhpMagic\Classes\Schema;

use Solis\PhpMagic\Abstractions\Schema\SchemaEntryAbstract;

/**
 * Class SchemaEntry
 *
 * @package Solis\PhpMagic\Classes
 */
class SchemaEntry extends SchemaEntryAbstract
{
    /**
     * make
     *
     * @param string $name
     * @param string $property
     * @param string $type
     *
     * @return static
     */
    public static function make($name, $property, $type)
    {
        return new static($name, $property, $type);
    }

}