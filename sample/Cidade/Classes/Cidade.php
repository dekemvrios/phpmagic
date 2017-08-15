<?php

namespace Solis\Expressive\Magic\Sample\Cidade\Classes;

use Solis\Expressive\Magic\Concerns\HasMagic;

/**
 * Class Cidade
 *
 * @package Sample\Pessoas
 */
class Cidade
{

    use HasMagic;

    /**
     * @var string
     */
    protected $nome;

    /**
     * @var string
     */
    protected $codigoIbge;

    /**
     * __construct
     */
    protected function __construct()
    {
        $this->start(dirname(dirname(__FILE__)) . "/Schemas/Cidade.json");
    }
}
