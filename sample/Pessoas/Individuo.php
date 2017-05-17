<?php

namespace Sample\Pessoas;

use Solis\PhpValidator\Helpers\Magic;
use Solis\PhpValidator\Helpers\Types;

/**
 * Class Individuo
 *
 * @package Sample\Pessoas
 */
class Individuo
{

    use Magic;

    /**
     * @var array
     */
    protected $schema = [
        [
            'name'     => 'code',
            'property' => 'codigo',
            'type'     => Types::TYPE_INT,
        ],
        [
            'name'     => 'firstName',
            'type'     => Types::TYPE_STRING,
            'property' => 'primeiroNome',
            'format'   => [
                'size' => 4,
                'uppercase'
            ]
        ],
        [
            'name'     => 'lastName',
            'type'     => Types::TYPE_STRING,
            'property' => 'segundoNome',
            'format'   => [
                'uppercase'
            ]
        ]
    ];

    /**
     * @var int
     */
    protected $codigo;

    /**
     * @var string
     */
    protected $primeiroNome;

    /**
     * @var string
     */
    protected $segundoNome;

}