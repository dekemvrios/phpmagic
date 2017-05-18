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
            'type'     => Types::TYPE_INT,
            'property' => 'codigo'
        ],
        [
            'name'     => 'money',
            'type'     => Types::TYPE_FLOAT,
            'property' => 'dinheiro'
        ],
        [
            'name'     => 'firstName',
            'type'     => Types::TYPE_STRING,
            'property' => 'primeiroNome',
            'format'   => [
                'uppercase'
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
                        'Becker'
                    ]
                ]
            ]
        ]
    ];

    /**
     * @var int
     */
    protected $codigo;

    /**
     * @var float
     */
    protected $dinheiro;

    /**
     * @var string
     */
    protected $primeiroNome;

    /**
     * @var string
     */
    protected $segundoNome;

    /**
     * @param $dados
     *
     * @return static
     */
    public static function make($dados)
    {

        $individuo = new static();
        $individuo->attach($dados);

        return $individuo;
    }

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