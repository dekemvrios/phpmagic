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
            'name'     => 'firstName',
            'type'     => Types::TYPE_STRING,
            'property' => 'primeiroNome',
            'format'   => [
                'size' => 3
            ]
        ],
        [
            'name'     => 'lastName',
            'type'     => Types::TYPE_STRING,
            'property' => 'segundoNome',
            'format'   => [
                [
                    'class'    => 'Sample\\Pessoas\\Individuo',
                    'function' => 'getCustomString',
                    'params'   => [
                        'Exemplo',
                        'Implementacao'
                    ]
                ]
            ]
        ]
    ];

    /**
     * @var string
     */
    protected $primeiroNome;

    /**
     * @var string
     */
    protected $segundoNome;

    /**
     * getCustomString
     *
     * @param       $data
     * @param mixed $param2
     * @param mixed $param3
     *
     * @return string
     */
    public function getCustomString(
        $data,
        $param2 = null,
        $param3 = null
    ) {
        return "{$data} {$param2} {$param3}";
    }

}