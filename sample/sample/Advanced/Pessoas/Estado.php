<?php

namespace Solis\PhpMagic\Sample\Advanced\Pessoas;

use Solis\PhpMagic\Contracts\Schema\SchemaContract;
use Solis\PhpMagic\Classes\Schema\Schema;
use Solis\PhpMagic\Helpers\Magic;

/**
 * Class Estado
 *
 * @package Solis\PhpMagic\Sample\Pessoas
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
    public function __construct()
    {
        if (!file_exists(dirname(dirname(__FILE__)) . "/Schemas/Estado.json")) {
            throw new \RuntimeException('not found schema for class ' . __CLASS__);
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
