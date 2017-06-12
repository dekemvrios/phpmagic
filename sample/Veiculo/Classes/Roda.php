<?php

namespace Solis\PhpMagic\Sample\Veiculo\Classes;

use Solis\PhpSchema\Classes\Schema;
use Solis\PhpMagic\Helpers\Magic;
use Solis\Breaker\TException;

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
    protected $schema;

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
        if (!file_exists(dirname(dirname(__FILE__)) . "/Schemas/Roda.json")) {
            throw new TException(
                __CLASS__,
                __METHOD__,
                'not found schema for class ' . __CLASS__,
                400
            );
        }

        $this->schema = Schema::make(
            file_get_contents(dirname(dirname(__FILE__)) . "/Schemas/Roda.json")
        );
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
