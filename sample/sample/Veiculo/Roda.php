<?php

namespace Solis\PhpMagic\Sample\Veiculo;

use Solis\PhpMagic\Classes\Schema\Schema;
use Solis\PhpMagic\Helpers\Magic;
use Solis\PhpMagic\Helpers\Types;

/**
 * Class Roda
 *
 * @package Solis\PhpMagic\Sample\Veiculo
 */
class Roda
{
    use Magic;

    /**
     * @var array
     */
    protected $schema = [
        [
            'name'     => 'sMarca',
            'property' => 'marca',
            'type'     => Types::TYPE_STRING
        ],
        [
            'name'     => 'sPolegada',
            'property' => 'polegada',
            'type'     => Types::TYPE_FLOAT
        ]
    ];

    /**
     * @var array
     */
    protected $marca;

    /**
     * @var float
     */
    protected $polegada;

    /**
     * __construct
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
        $instance = new static();
        $instance->attach($dados);

        return $instance;
    }
}
