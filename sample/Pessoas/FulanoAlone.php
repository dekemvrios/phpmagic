<?php

namespace Sample\Pessoas;

use Solis\PhpValidator\Helpers\MagicAlone;
use Solis\PhpValidator\Helpers\Types;

/**
 * Class Fulano
 *
 * @package Sample
 */
class FulanoAlone
{

    use MagicAlone;

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
                'lowercase'
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