<?php
namespace Solis\PhpMagic\Abstractions\Schema;

use Solis\PhpMagic\Contracts\Schema\DatabaseEntryContract;
use Solis\PhpMagic\Contracts\Schema\ObjectEntryContract;
use Solis\PhpMagic\Contracts\Schema\FormatEntryContract;
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
     * @var FormatEntryContract[]
     */
    protected $format;

    /**
     * @var ObjectEntryContract
     */
    protected $object;

    /**
     * @var DatabaseEntryContract
     */
    protected $database;

    /**
     * __construct
     *
     * @param string $name
     * @param string $property
     * @param string $type
     */
    protected function __construct(
        $name,
        $property,
        $type = null
    ) {
        $this->setName($name);
        $this->setProperty($property);
        $this->setType(!empty($type) ? $type : null);
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
     * @return FormatEntryContract[]
     */
    public function getFormat()
    {
        return $this->format;
    }

    /**
     * @param FormatEntryContract[] $format
     */
    public function setFormat($format)
    {
        $this->format = $format;
    }

    /**
     * @return ObjectEntryContract
     */
    public function getObject()
    {
        return $this->object;
    }

    /**
     * @param ObjectEntryContract $object
     */
    public function setObject($object)
    {
        $this->object = $object;
    }

    /**
     * @return DatabaseEntryContract
     */
    public function getDatabase()
    {
        return $this->database;
    }

    /**
     * @param DatabaseEntryContract $database
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
        $array = [];

        $array['name'] = $this->getName();
        $array['property'] = $this->getProperty();

        if (!empty($this->getType())) {
            $array['type'] = $this->getType();
        }

        if (!empty($this->getFormat())) {
            $format = [];
            foreach ($this->getFormat() as $item) {
                $format[] = $item->toArray();
            }
            $array['format'] = $format;
        }

        if (!empty($this->getObject())) {
            $array['object'] = $this->getObject()->toArray();
        }

        if(!empty($this->getDatabase())){
            $array['database'] = $this->getDatabase()->toArray();
        }

        return $array;
    }
}
