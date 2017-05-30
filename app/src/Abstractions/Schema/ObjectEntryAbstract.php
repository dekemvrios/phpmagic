<?php

namespace Solis\PhpMagic\Abstractions\Schema;

use Solis\PhpMagic\Contracts\Schema\ObjectEntryContract;

/**
 * Class ObjectEntryAbstract
 *
 * @package Solis\PhpMagic\Abstractions\Schema
 */
abstract class ObjectEntryAbstract implements ObjectEntryContract
{
    /**
     * @var string
     */
    protected $class;

    /**
     * @var string|array
     */
    protected $property;

    /**
     * __construct
     *
     * @param string       $class
     * @param string|array $property
     */
    protected function __construct(
        $class,
        $property
    ) {
        $this->setClass($class);
        $this->setProperty($property);
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
    public function getProperty()
    {
        return $this->property;
    }

    /**
     * @param array|string $property
     */
    public function setProperty($property)
    {
        $this->property = $property;
    }

    /**
     * toArray
     *
     * @return array
     */
    public function toArray()
    {
        return [
            'class'    => $this->getClass(),
            'property' => $this->getProperty()
        ];
    }
}
