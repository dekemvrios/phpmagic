<?php

namespace Solis\Expressive\Magic\Sample\Pessoas\Classes;

use Solis\Expressive\Magic\Concerns\HasMagic;

/**
 * Class Endereco
 *
 * @package Sample\Pessoas
 */
class Endereco
{

    use HasMagic;

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
        $this->boot(dirname(dirname(__FILE__)) . "/Schemas/Endereco.json");
    }
}
