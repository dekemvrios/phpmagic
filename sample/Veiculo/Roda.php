<?php

namespace Solis\PhpMagic\Sample\Veiculo;

use Solis\PhpMagic\Helpers\Magic;
use Solis\PhpMagic\Helpers\Types;

/**
 * Class Roda
 *
 * @package Solis\PhpMagic\Sample\Veiculo
 */
class Roda
{
    use Magic;

    /**
     * @var array
     */
    protected $schema = [
        [
            'name'     => 'sMarca',
            'property' => 'marca',
            'type'     => Types::TYPE_STRING
        ],
        [
            'name'     => 'sPolegada',
            'property' => 'polegada',
            'type'     => Types::TYPE_FLOAT
        ]
    ];

    /**
     * @var array
     */
    protected $marca;

    /**
     * @var float
     */
    protected $polegada;
}
