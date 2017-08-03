<?php

namespace Solis\PhpMagic\Sample\Veiculo\Classes;

use Solis\PhpMagic\Concerns\HasMagic;

/**
 * Class Carro
 *
 * @package Solis\PhpMagic\Sample\Veiculo
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
