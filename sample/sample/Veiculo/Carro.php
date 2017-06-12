<?php

namespace Solis\PhpMagic\Sample\Veiculo;

use Solis\PhpMagic\Classes\Schema\Schema;
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
            'type'     => 'undefined',
            'object'   => [
                'class' => 'Solis\\PhpMagic\\Sample\\Veiculo\\Roda',
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
     * Carro constructor.
     */
    public function __construct()
    {
        $this->schema = Schema::make(json_encode($this->schema));
    }

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
