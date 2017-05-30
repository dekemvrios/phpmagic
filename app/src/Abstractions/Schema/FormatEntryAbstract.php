<?php

namespace Solis\PhpMagic\Abstractions\Schema;

use Solis\PhpMagic\Contracts\Schema\FormatEntryContract;

/**
 * Class FormatEntryAbstract
 *
 * @package Solis\PhpMagic\Abstractions\Schema
 */
abstract class FormatEntryAbstract implements FormatEntryContract
{
    /**
     * @var string
     */
    protected $class;

    /**
     * @var string
     */
    protected $function;

    /**
     * @var string|array
     */
    protected $params;

    /**
     * __construct
     *
     * @param $function
     */
    protected function __construct($function)
    {
        $this->setFunction($function);
    }

    /**
     * @return string
     */
    public function getClass()
    {
        return $this->class;
    }

    /**
     * @param string $class
     */
    public function setClass($class)
    {
        $this->class = $class;
    }

    /**
     * @return string
     */
    public function getFunction()
    {
        return $this->function;
    }

    /**
     * @param string $function
     */
    public function setFunction($function)
    {
        $this->function = $function;
    }

    /**
     * @return array|string
     */
    public function getParams()
    {
        return $this->params;
    }

    /**
     * @param array|string $params
     */
    public function setParams($params)
    {
        $this->params = $params;
    }

    /**
     * toArray
     *
     * @return array
     */
    public function toArray()
    {
        $array = [];
        $array['function'] = $this->getFunction();

        if (!empty($this->getClass())) {
            $array['class'] = $this->getClass();
        }

        if (!empty($this->getParams())) {
            $array['params'] = $this->getParams();
        }

        return $array;
    }
}
