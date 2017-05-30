<?php

namespace Solis\PhpMagic\Contracts\Schema;

/**
 * Interface SchemaEntryContract
 *
 * @package Solis\PhpMagic\Contract
 */
interface SchemaEntryContract
{
    /**
     * @return string
     */
    public function getName();

    /**
     * @param string $name
     */
    public function setName($name);

    /**
     * @return string
     */
    public function getProperty();

    /**
     * @param string $property
     */
    public function setProperty($property);

    /**
     * @return string
     */
    public function getType();

    /**
     * @param string $type
     */
    public function setType($type);

    /**
     * @return FormatEntryContract[]
     */
    public function getFormat();

    /**
     * @param FormatEntryContract[] $format
     */
    public function setFormat($format);

    /**
     * @return ObjectEntryContract
     */
    public function getObject();

    /**
     * @param ObjectEntryContract $object
     */
    public function setObject($object);

    /**
     * @return DatabaseEntryContract
     */
    public function getDatabase();

    /**
     * @param DatabaseEntryContract $database
     */
    public function setDatabase($database);

    /**
     * @return array
     */
    public function toArray();
}
