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
     * @var DatabaseEntryContract[]
     */
    protected $database;

    /**
     * __construct
     *
     * @param string $class
     */
    protected function __construct(
        $class
    ) {
        $this->setClass($class);
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
            'class' => $this->getClass()
        ];

        if (!empty($this->getDatabase())) {
            $database = [];
            foreach ($this->getDatabase() as $item) {
                $database[] = $item->toArray();
            }
            $array['database'] = $database;
        }

        return $array;
    }
}
