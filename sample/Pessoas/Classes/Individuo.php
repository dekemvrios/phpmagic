<?php

namespace Solis\PhpMagic\Sample\Pessoas\Classes;

use Solis\PhpSchema\Contracts\SchemaContract;
use Solis\PhpSchema\Classes\Schema;
use Solis\PhpMagic\Helpers\Magic;

/**
 * Class Individuo
 *
 * @package Sample\PhpMagic\Pessoas
 */
class Individuo
{

    use Magic;

    /**
     * @var SchemaContract
     */
    protected $schema;

    /**
     * @var Endereco
     */
    protected $endereco;

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

        if (!file_exists(dirname(dirname(__FILE__)) . "/Schemas/Individuo.json")) {
            throw new \RuntimeException('not found schema for class ' . __CLASS__);
        }

        $individuo->schema = Schema::make(
            file_get_contents(dirname(dirname(__FILE__)) . "/Schemas/Individuo.json")
        );

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
