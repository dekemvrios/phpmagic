<?php

namespace Solis\PhpMagic\Sample\Pessoas;

use Solis\PhpMagic\Helpers\Magic;
use Solis\PhpMagic\Helpers\Types;

/**
 * Class Estado
 *
 * @package Solis\PhpMagic\Sample\Pessoas
 */
class Estado
{
    use Magic;
    /**
     * @var array
     */
    protected $schema = [
        [
            'name'     => 'sNome',
            'type'     => Types::TYPE_STRING,
            'property' => 'nome',
            'format'   => [
                [
                    'function' => 'uppercase'
                ]
            ]
        ],
        [
            'name'     => 'iCodigoIbge',
            'type'     => Types::TYPE_INT,
            'property' => 'codigoIbge'
        ],
    ];

    /**
     * @var string
     */
    protected $nome;

    /**
     * @var string
     */
    protected $codigoIbge;

}