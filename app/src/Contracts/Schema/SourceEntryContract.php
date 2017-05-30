<?php

namespace Solis\PhpMagic\Contracts\Schema;

/**
 * Interface SourceEntryContract
 *
 * @package Solis\PhpMagic\Contracts\Schema
 */
interface SourceEntryContract
{
    /**
     * @return string
     */
    public function getField();

    /**
     * @param string $field
     */
    public function setField($field);

    /**
     * @return string
     */
    public function getRefers();

    /**
     * @param string $refers
     */
    public function setRefers($refers);
}