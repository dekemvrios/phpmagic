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