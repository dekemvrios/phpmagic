<?php

namespace Solis\PhpMagic\Sample\Micro\Classes;

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
     * @var array
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
        if (!file_exists(dirname(dirname(__FILE__)) . '/Schemas/OrdemServico.json')) {
            throw new \RuntimeException('not found schema for class ' . __CLASS__);
        }
        $instance->schema = json_decode(
            file_get_contents(dirname(dirname(__FILE__)) . '/Schemas/OrdemServico.json'),
            true
        );
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