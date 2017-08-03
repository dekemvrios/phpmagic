<?php

namespace Solis\PhpMagic\Sample\Veiculo\Classes;

use Solis\PhpMagic\Concerns\HasMagic;

/**
 * Class Roda
 *
 * @package Solis\PhpMagic\Sample\Veiculo
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
