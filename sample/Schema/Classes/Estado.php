<?php

namespace Solis\PhpMagic\Sample\Schema\Classes;

use Solis\Breaker\TException;
use Solis\PhpMagic\Contracts\Schema\SchemaContract;
use Solis\PhpMagic\Helpers\Magic;
use Solis\PhpMagic\Classes\Schema\Schema;

/**
 * Class Estado
 *
 * @package Solis\PhpMagic\Sample\Schema\Classes
 */
class Estado
{
    use Magic;

    /**
     * @var SchemaContract
     */
    protected $schema;

    /**
     * @var string
     */
    protected $nome;

    /**
     * @var string
     */
    protected $codigoIbge;

    /**
     * __construct
     *
     */
    protected function __construct()
    {

        if (!file_exists(dirname(dirname(__FILE__)) . "/Schemas/Estado.json")) {
            throw new TException(
                __CLASS__,
                __METHOD__,
                'not found schema for class ' . __CLASS__,
                400
            );
        }

        $this->schema = Schema::make(
            file_get_contents(dirname(dirname(__FILE__)) . "/Schemas/Estado.json")
        );
    }

    /**
     * @param $dados
     *
     * @return static
     */
    public static function make($dados)
    {
        $instance = new static();
        $instance->attach($dados);

        return $instance;
    }
}