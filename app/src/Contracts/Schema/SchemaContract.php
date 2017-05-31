<?php

namespace Solis\PhpMagic\Contracts\Schema;

/**
 * Interface SchemaContract
 *
 * @package Solis\PhpMagic\Contracts
 */
interface SchemaContract
{
    /**
     * setSchema
     *
     * @param SchemaEntryContract []
     */
    public function setSchema($schema);

    /**
     * getSchema
     *
     * @return SchemaEntryContract[]
     */
    public function getSchema();

    /**
     * addEntry
     *
     * @param SchemaEntryContract $entry
     */
    public function addEntry($entry);

    /**
     * getEntry
     *
     * @param string $key
     * @param mixed $value
     *
     * @return array|bool
     */
    public function getEntry($key, $value);

    /**
     * toArray
     *
     * @return array
     */
    public function toArray();

    /**
     * toJson
     *
     * @return string
     */
    public function toJson();
}
