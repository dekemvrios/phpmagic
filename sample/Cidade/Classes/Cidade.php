<?php

namespace Solis\PhpMagic\Sample\Cidade\Classes;

use Solis\PhpMagic\Concerns\HasMagic;

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
        $this->boot(dirname(dirname(__FILE__)) . "/Schemas/Cidade.json");
    }
}
