<?php

namespace Solis\PhpMagic\Abstractions\Schema;

use Solis\PhpMagic\Contracts\Schema\DatabaseEntryContract;
use Solis\PhpMagic\Contracts\Schema\SourceEntryContract;

/**
 * Class DatabaseEntryAbstract
 *
 * @package Solis\PhpMagic\Abstractions\Schema
 */
abstract class DatabaseEntryAbstract implements DatabaseEntryContract
{
    /**
     * @var string
     */
    protected $type;

    /**
     * @var SourceEntryContract
     */
    protected $source;

    /**
     * DatabaseEntryAbstract constructor.
     *
     * @param string $type
     */
    protected function __construct($type)
    {
        $this->setType($type);
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
     * @return SourceEntryContract
     */
    public function getSource()
    {
        return $this->source;
    }

    /**
     * @param SourceEntryContract $source
     */
    public function setSource($source)
    {
        $this->source = $source;
    }
}
