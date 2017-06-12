<?php

namespace Solis\PhpMagic\Sample\Micro\Classes;

use Solis\PhpMagic\Contracts\Schema\SchemaContract;
use Solis\PhpMagic\Classes\Schema\Schema;
use Solis\PhpMagic\Helpers\Magic;

/**
 * Class OrdemServico
 *
 * @package Solis\PhpMagic\Sample\Micro
 */
class OrdemServico
{
    use Magic;

    /**
     * @var SchemaContract
     */
    public $schema;

    protected $ID;
    protected $organizacaoID;
    protected $entidadeID;
    protected $clienteID;
    protected $clienteNome;
    protected $clienteInscrFederal;
    protected $descricao;
    protected $vencimento;
    protected $valor;
    protected $situacao;
    protected $tipoCobranca;
    protected $observacao;
    protected $servicoID;

    /**
     * __construct
     *
     */
    protected function __construct()
    {
        if (!file_exists(dirname(dirname(__FILE__)) . '/Schemas/OrdemServico.json')) {
            throw new \RuntimeException('not found schema for class ' . __CLASS__);
        }
        $this->schema = Schema::make(
            file_get_contents(dirname(dirname(__FILE__)) . '/Schemas/OrdemServico.json')
        );
    }

    /**
     * make
     *
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