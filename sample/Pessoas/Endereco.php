<?php

namespace Sample\Pessoas;

use Solis\PhpValidator\Helpers\Magic;
use Solis\PhpValidator\Helpers\Types;

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
            'format' => [
                'uppercase'
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
            'property' => 'bairro'
        ],
        [
            'name'     => 'sComplemento',
            'type'     => Types::TYPE_STRING,
            'property' => 'complemento'
        ],
        [
            'name'     => 'sCidade',
            'type'     => Types::TYPE_STRING,
            'property' => 'cidade'
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