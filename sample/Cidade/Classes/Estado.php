<?php

namespace Solis\PhpMagic\Sample\Cidade\Classes;

use Solis\PhpMagic\Concerns\HasMagic;

/**
 * Class Estado
 *
 * @package Solis\PhpMagic\Sample\Schema\Classes
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
        $this->boot(dirname(dirname(__FILE__)) . "/Schemas/Estado.json");
    }
}