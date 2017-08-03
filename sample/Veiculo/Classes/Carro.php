<?php

namespace Solis\Expressive\Magic\Sample\Veiculo\Classes;

use Solis\Expressive\Magic\Concerns\HasMagic;

/**
 * Class Carro
 *
 * @package Solis\Expressive\Magic\Sample\Veiculo
 */
class Carro
{

    use HasMagic;

    /**
     * @var string
     */
    protected $nome;

    /**
     * @var Roda
     */
    protected $roda;

    /**
     * Carro constructor.
     */
    public function __construct()
    {
        $this->boot(
            dirname(dirname(__FILE__)) . "/Schemas/Carro.json"
        );
    }
}
