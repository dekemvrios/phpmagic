<?php

namespace Solis\PhpMagic\Sample\Advanced\Pessoas;

use Solis\PhpMagic\Helpers\Magic;

/**
 * Class Endereco
 *
 * @package Sample\Pessoas
 */
class Endereco
{

    use Magic;

    /**
     * @var array
     */
    protected $schema;

    /**
     * @var string
     */
    protected $logradouro;

    /**
     * @var string
     */
    protected $cep;

    /**
     * @var string
     */
    protected $bairro;

    /**
     * @var string
     */
    protected $complemento;

    /**
     * @var string
     */
    protected $cidade;

    /**
     * __construct
     *
     * @throws \RuntimeException
     */
    public function __construct()
    {

        if (!file_exists(dirname(dirname(__FILE__)) . "/Schemas/Endereco.json")) {
            throw new \RuntimeException('not found schema for class ' . __CLASS__);
        }

        $this->schema = json_decode(
            file_get_contents(dirname(dirname(__FILE__)) . "/Schemas/Endereco.json"),
            true
        );
    }
}