<?php

namespace Solis\PhpMagic\Sample\Veiculo;

use Solis\PhpMagic\Helpers\Magic;
use Solis\PhpMagic\Helpers\Types;

/**
 * Class Carro
 *
 * @package Solis\PhpMagic\Sample\Veiculo
 */
class Carro
{
    use Magic;

    /**
     * @var array
     */
    protected $schema = [
        [
            'name'     => 'sNome',
            'property' => 'nome',
            'type'     => Types::TYPE_STRING,
            'format'   => [
                [
                    'function' => 'uppercase'
                ]
            ]
        ],
        [
            'name'     => 'sRoda',
            'property' => 'roda',
            'class'    => [
                'class' => 'Solis\\PhpMagic\\Sample\\Veiculo\\Roda',
                'name'  => [
                    'sMarca',
                    'sPolegada'
                ]
            ]
        ]
    ];

    /**
     * @var string
     */
    protected $nome;

    /**
     * @var roda
     */
    protected $roda;

    /**
     * @param $dados
     *
     * @return static
     */
    public static function make($dados)
    {
        $veiculo = new static();
        $veiculo->attach($dados);

        return $veiculo;
    }
}