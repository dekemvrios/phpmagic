<?php

namespace Solis\PhpMagic\Contracts\Schema;

/**
 * Class FormatEntryContract
 *
 * @package Solis\PhpMagic\Contracts\Schema
 */
interface FormatEntryContract
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
     * @return string
     */
    public function getFunction();

    /**
     * @param string $function
     */
    public function setFunction($function);

    /**
     * @return array|string
     */
    public function getParams();

    /**
     * @param array|string $params
     */
    public function setParams($params);

    /**
     * toArray
     *
     * @return array
     */
    public function toArray();
}
