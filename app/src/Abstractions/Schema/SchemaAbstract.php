<?php

namespace Solis\PhpMagic\Abstractions\Schema;

use Solis\PhpMagic\Contracts\Schema\SchemaEntryContract;

/**
 * Class SchemaAbstract
 *
 * @package Solis\PhpMagic\Abstractions
 */
abstract class SchemaAbstract
{

    /**
     * @var SchemaEntryContract[]
     */
    protected $schema = [];

    /**
     * __construct
     *
     * @param SchemaEntryContract[] $schema
     */
    protected function __construct($schema = [])
    {
        $this->schema = $schema;
    }

    /**
     * setSchema
     *
     * @param SchemaEntryContract []
     */
    public function setSchema($schema)
    {
        $this->schema = $schema;
    }

    /**
     * getSchema
     *
     * @return SchemaEntryContract[]
     */
    public function getSchema()
    {
        return $this->schema;
    }

    /**
     * addEntry
     *
     * @param SchemaEntryContract $entry
     */
    public function addEntry($entry)
    {
        $this->schema[] = $entry;
    }

    /**
     * getEntry
     *
     * @param $name
     *
     * @return array|bool
     */
    public function getEntry($name)
    {
        $entry = [];
        if (!empty($this->getSchema())) {
            $entry = array_filter($this->getSchema(), function ($item) use ($name) {
                return $item->getName() === $name ? true : false;
            });
        }
        return empty($entry) ? false : $entry;
    }

    /**
     * toArray
     *
     * @param array $properties
     *
     * @return array|SchemaEntryContract[]
     */
    public function toArray($properties = null)
    {
        $array = [];
        if (!empty($this->getSchema())) {
            foreach ($this->getSchema() as $item) {
                $array[] = $item->toArray(!empty($properties) ? $properties : null);
            }
        }

        return $array;
    }

    /**
     * toJson
     *
     * @return string
     */
    public function toJson()
    {
        $json = null;
        if (!empty($this->toArray())) {
            $json = json_encode($this->toArray());
        }

        return $json;
    }
}
