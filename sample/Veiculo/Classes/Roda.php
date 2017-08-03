<?php

namespace Solis\Expressive\Magic\Sample\Veiculo\Classes;

use Solis\Expressive\Magic\Concerns\HasMagic;

/**
 * Class Roda
 *
 * @package Solis\Expressive\Magic\Sample\Veiculo
 */
class Roda
{

    use HasMagic;

    /**
     * @var array
     */
    protected $marca;

    /**
     * @var float
     */
    protected $polegada;

    /**
     * __construct
     */
    public function __construct()
    {
        $this->boot(
            dirname(dirname(__FILE__)) . "/Schemas/Roda.json"
        );
    }
}
