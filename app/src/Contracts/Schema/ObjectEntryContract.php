<?php

namespace Solis\PhpMagic\Contracts\Schema;

/**
 * Interface ObjectEntryContract
 *
 * @package Solis\PhpMagic\Contracts\Schema
 */
interface ObjectEntryContract
{

    /**
     * @return string
     */
    public function getClass();

    /**
     * @param string $class
     */
    public function setClass($class);

    /**
     * @return array|string
     */
    public function getProperty();

    /**
     * @param array|string $property
     */
    public function setProperty($property);

    /**
     * @return DatabaseEntryContract[]
     */
    public function getDatabase();

    /**
     * @param DatabaseEntryContract[] $database
     */
    public function setDatabase($database);

    /**
     * toArray
     *
     * @return array
     */
    public function toArray();
}
