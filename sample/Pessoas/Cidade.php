<?php

namespace Solis\PhpMagic\Sample\Pessoas;

use Solis\PhpMagic\Helpers\Magic;

/**
 * Class Cidade
 *
 * @package Sample\Pessoas
 */
class Cidade
{
    use Magic;

    /**
     * @var array
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
     * @var string
     */
    protected $estado;

    /**
     * __construct
     */
    public function __construct()
    {

        if (!file_exists(dirname(dirname(__FILE__)) . "/Schemas/Cidade.json")) {
            throw new \RuntimeException('not found schema for class ' . __CLASS__);
        }

        $this->schema = json_decode(
            file_get_contents(dirname(dirname(__FILE__)) . "/Schemas/Cidade.json"),
            true
        );
    }

}