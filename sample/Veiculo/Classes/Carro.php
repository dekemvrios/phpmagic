<?php

namespace Solis\PhpMagic\Sample\Veiculo\Classes;

use Solis\PhpSchema\Classes\Schema;
use Solis\PhpMagic\Helpers\Magic;
use Solis\Breaker\TException;

/**
 * Class Carro
 *
 * @package Solis\PhpMagic\Sample\Veiculo
 */
class Carro
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
     * Carro constructor.
     */
    public function __construct()
    {
        if (!file_exists(dirname(dirname(__FILE__)) . "/Schemas/Carro.json")) {
            throw new TException(
                __CLASS__,
                __METHOD__,
                'not found schema for class ' . __CLASS__,
                400
            );
        }

        $this->schema = Schema::make(
            file_get_contents(dirname(dirname(__FILE__)) . "/Schemas/Carro.json")
        );
    }

    /**
     * @param $dados
     *
     * @return static
     */
    public static function make($dados)
    {
        $veiculo = new static();
        $veiculo->attach($dados);

        return $veiculo;
    }
}
