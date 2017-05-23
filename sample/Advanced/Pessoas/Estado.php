<?php

namespace Solis\PhpMagic\Sample\Advanced\Pessoas;

use Solis\PhpMagic\Helpers\Magic;

/**
 * Class Estado
 *
 * @package Solis\PhpMagic\Sample\Pessoas
 */
class Estado
{
    use Magic;

    /**
     * @var array
     */
    protected $schema;

    /**
     * @var string
     */
    protected $nome;

    /**
     * @var string
     */
    protected $codigoIbge;

    /**
     * __construct
     *
     */
    public function __construct()
    {
        if (!file_exists(dirname(dirname(__FILE__)) . "/Schemas/Estado.json")) {
            throw new \RuntimeException('not found schema for class ' . __CLASS__);
        }

        $this->schema = json_decode(
            file_get_contents(dirname(dirname(__FILE__)) . "/Schemas/Estado.json"),
            true
        );
    }
}
