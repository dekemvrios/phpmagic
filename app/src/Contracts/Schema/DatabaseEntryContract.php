<?php

namespace Solis\PhpMagic\Contracts\Schema;

/**
 * Interface DatabaseEntryContract
 *
 * @package Solis\PhpMagic\Contracts\Schema
 */
interface DatabaseEntryContract
{
    /**
     * @return string
     */
    public function getType();

    /**
     * @param string $type
     */
    public function setType($type);

    /**
     * @return SourceEntryContract
     */
    public function getSource();

    /**
     * @param SourceEntryContract $source
     */
    public function setSource($source);

    /**
     * @return array
     */
    public function toArray();
}