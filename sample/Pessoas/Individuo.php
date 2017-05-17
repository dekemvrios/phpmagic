<?php

namespace Sample\Pessoas;

use Solis\PhpValidator\Helpers\Magic;
use Solis\PhpValidator\Helpers\Types;

/**
 * Class Individuo
 *
 * @package Sample
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
                'size' => 5,
                'uppercase'
            ]
        ],
        [
            'name'     => 'lastName',
            'type'     => Types::TYPE_STRING,
            'property' => 'segundoNome',
            'format'   => [
                'size' => 1,
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