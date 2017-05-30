<?php

namespace Solis\PhpMagic\Abstractions\Schema;

use Solis\PhpMagic\Contracts\Schema\SchemaEntryContract;

/**
 * Class SchemaEntryAbstract
 *
 * @package Solis\PhpMagic\Abstractions
 */
abstract class SchemaEntryAbstract implements SchemaEntryContract
{

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $property;

    /**
     * @var string
     */
    protected $type;

    /**
     * __construct
     *
     * @param string $name
     * @param string $property
     * @param string $type
     */
    protected function __construct($name, $property, $type)
    {
        $this->setName($name);
        $this->setProperty($property);
        $this->setType($type);
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getProperty()
    {
        return $this->property;
    }

    /**
     * @param string $property
     */
    public function setProperty($property)
    {
        $this->property = $property;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * toArray
     *
     * @return array
     */
    public function toArray()
    {
        return [
            'name' => $this->getName(),
            'property' => $this->getProperty(),
            'type' => $this->getType()
        ];
    }
}

