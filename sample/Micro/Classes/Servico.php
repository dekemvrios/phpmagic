<?php

namespace Solis\PhpMagic\Sample\Micro\Classes;

use Solis\PhpMagic\Contracts\Schema\SchemaContract;
use Solis\PhpMagic\Classes\Schema\Schema;
use Solis\PhpMagic\Helpers\Magic;

/**
 * Class Servico
 *
 * @package Solis\PhpMagic\Sample\Micro
 */
class Servico
{
    use Magic;

    /**
     * @var SchemaContract
     */
    public $schema;

    protected $ID;
    protected $organizacaoID;
    protected $entidadeID;
    protected $clienteInscrFederal;
    protected $tipoServicoID;
    protected $descricao;
    protected $valor;
    protected $aliquota;
    protected $valorDeducao;
    protected $valorDeducaoRetidoFonte;
    protected $retencaoIss;
    protected $situacaoTributaria;
    protected $tributaMunicipioPrestador;
    protected $observacao;

    /**
     * __construct
     *
     */
    public function __construct()
    {
        if (!file_exists(dirname(dirname(__FILE__)) . '/Schemas/Servico.json')) {
            throw new \RuntimeException('not found schema for class ' . __CLASS__);
        }
        $this->schema = Schema::make(
            file_get_contents(dirname(dirname(__FILE__)) . '/Schemas/Servico.json')
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