<?php

namespace Solis\PhpMagic\Sample\Micro\Classes;

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
     * @var array
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
        $this->schema = json_decode(
            file_get_contents(dirname(dirname(__FILE__)) . '/Schemas/Servico.json'),
            true
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

    /**
     * @return array
     */
    public function __debugInfo()
    {
        $result = [];

        $aProps = (new \ReflectionClass($this))->getProperties();
        foreach ($aProps as $property) {
            if ($property->getName() === 'schema') {
                continue;
            }

            $property->setAccessible(true);
            $result[] = [
                $property->getName() => $property->getValue($this)
            ];
        }

        return $result;
    }
}