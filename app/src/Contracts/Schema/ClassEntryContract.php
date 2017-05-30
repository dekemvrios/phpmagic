<?php

namespace Solis\PhpMagic\Contracts\Schema;

/**
 * Interface ClassEntryContract
 *
 * @package Solis\PhpMagic\Contracts\Schema
 */
interface ClassEntryContract
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
    public function getName();

    /**
     * @param array|string $name
     */
    public function setName($name);

    /**
     * toArray
     *
     * @return array
     */
    public function toArray();
}
