<?php

namespace Solis\PhpMagic\Abstractions\Schema;

use Solis\PhpMagic\Contracts\Schema\DatabaseEntryContract;
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
     * @var DatabaseEntryContract[]
     */
    protected $database;

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
     * @return DatabaseEntryContract[]
     */
    public function getDatabase()
    {
        return $this->database;
    }

    /**
     * @param DatabaseEntryContract[] $database
     */
    public function setDatabase($database)
    {
        $this->database = $database;
    }

    /**
     * toArray
     *
     * @return array
     */
    public function toArray()
    {
        $array = [
            'class'    => $this->getClass(),
            'property' => $this->getProperty(),
        ];

        if(!empty($this->getDatabase())){
            $database = [];
            foreach ($this->getDatabase() as $item) {
                $database[] = $item->toArray();
            }
            $array['database'] = $database;
        }

        return $array;
    }
}
