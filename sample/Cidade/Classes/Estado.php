<?php

namespace Solis\Expressive\Magic\Sample\Cidade\Classes;

use Solis\Expressive\Magic\Concerns\HasMagic;

/**
 * Class Estado
 *
 * @package Solis\Expressive\Magic\Sample\Schema\Classes
 */
class Estado
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
     * @var string
     */
    protected $cidade;

    /**
     * @var string
     */
    protected $capital;

    /**
     * __construct
     *
     */
    protected function __construct()
    {
        $this->start(dirname(dirname(__FILE__)) . "/Schemas/Estado.json");
    }
}