<?php

namespace Solis\PhpMagic\Abstractions\Schema;

use Solis\Breaker\TException;
use Solis\PhpMagic\Contracts\Schema\SchemaContract;
use Solis\PhpMagic\Contracts\Schema\SchemaEntryContract;

/**
 * Class SchemaAbstract
 *
 * @package Solis\PhpMagic\Abstractions
 */
abstract class SchemaAbstract implements SchemaContract
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
     * @param string $key
     * @param mixed $value
     *
     * @return array|bool
     */
    public function getEntry($key, $value)
    {
        $entry = [];
        if (!empty($this->getSchema())) {
            $entry = array_filter($this->getSchema(), function ($item) use ($key, $value) {

                if (!method_exists(
                    $item,
                    'get' . ucfirst($key)
                )
                ) {
                    throw new TException(
                        __CLASS__,
                        __METHOD__,
                        'method ' . 'get' . ucfirst($key) . ' not found at ' . get_class($item),
                        400
                    );
                }

                return $item->{'get'.ucfirst($key)}() === $value ? true : false;
            });
        }
        return empty($entry) ? false : array_values($entry);
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
