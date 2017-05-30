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
     * @return array
     */
    public function toArray();
}