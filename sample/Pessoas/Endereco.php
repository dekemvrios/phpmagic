<?php

namespace Solis\PhpMagic\Sample\Pessoas;

use Solis\PhpMagic\Helpers\Magic;
use Solis\PhpMagic\Helpers\Types;

/**
 * Class Endereco
 *
 * @package Sample\Pessoas
 */
class Endereco
{
    use Magic;

    /**
     * @var array
     */
    protected $schema = [
        [
            'name'     => 'sLogradouro',
            'type'     => Types::TYPE_STRING,
            'property' => 'logradouro',
            'format'   => [
                [
                    'function' => 'uppercase'
                ]
            ]
        ],
        [
            'name'     => 'sCep',
            'type'     => Types::TYPE_STRING,
            'property' => 'cep'
        ],
        [
            'name'     => 'sBairro',
            'type'     => Types::TYPE_STRING,
            'property' => 'bairro',
            'format'   => [
                [
                    'function' => 'lowercase'
                ],
            ]
        ],
        [
            'name'     => 'sComplemento',
            'type'     => Types::TYPE_STRING,
            'property' => 'complemento'
        ],
        [
            'name'     => 'aCidade',
            'property' => 'cidade',
            'class'    => [
                'class' => 'Solis\\PhpMagic\\Sample\\Pessoas\\Cidade',
                'name'  => [
                    'sNome',
                    'iCodigoIbge',
                    'aEstado'
                ]
            ]
        ],
    ];

    /**
     * @var string
     */
    protected $logradouro;

    /**
     * @var string
     */
    protected $cep;

    /**
     * @var string
     */
    protected $bairro;

    /**
     * @var string
     */
    protected $complemento;

    /**
     * @var string
     */
    protected $cidade;
}