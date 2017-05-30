<?php

namespace Solis\PhpMagic\Abstractions\Schema;

use Solis\PhpMagic\Contracts\Schema\ClassEntryContract;

/**
 * Class ClassEntryAbstract
 *
 * @package Solis\PhpMagic\Abstractions\Schema
 */
abstract class ClassEntryAbstract implements ClassEntryContract
{
    /**
     * @var string
     */
    protected $class;

    /**
     * @var string|array
     */
    protected $name;

    /**
     * __construct
     *
     * @param $class
     * @param $name
     */
    protected function __construct(
        $class,
        $name
    ) {
        $this->setClass($class);
        $this->setName($name);
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
     * @return array|string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param array|string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * toArray
     *
     * @return array
     */
    public function toArray()
    {
        return [
            'class' => $this->getClass(),
            'name'  => $this->getName()
        ];
    }
}
