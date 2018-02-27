<?php

namespace Solis\Expressive\Magic\Sample\Pessoas\Classes;

use Solis\Expressive\Magic\Concerns\HasMagic;

/**
 * Class Individuo
 *
 * @package Sample\PhpMagic\Pessoas
 */
class Individuo
{

    use HasMagic;

    /**
     * @var Endereco
     */
    protected $endereco;

    /**
     * @var int
     */
    protected $codigo;

    /**
     * @var float
     */
    protected $dinheiro;

    /**
     * @var string
     */
    protected $primeiroNome;

    /**
     * @var string
     */
    protected $segundoNome;

    /**
     * @var string
     */
    protected $dataNascimento;

    /**
     * @var string
     */
    protected $jsonEndereco;

    /**
     * __construct
     *
     * @throws \RuntimeException
     */
    public function __construct()
    {
        $this->start(dirname(dirname(__FILE__)) . "/Schemas/Individuo.json");
    }

    /**
     * getCustomString
     *
     * @param       $data
     * @param mixed $param2
     * @param mixed $param3
     *
     * @return string
     */
    public function getCustomString(
        $data,
        $param2 = null,
        $param3 = null
    ) {
        return "{$data} {$param2} {$param3}";
    }
}
