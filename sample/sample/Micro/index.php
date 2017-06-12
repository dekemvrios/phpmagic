<?php

require_once '../../vendor/autoload.php';

use Solis\PhpMagic\Sample\Micro\Classes\OrdemServico;
use Solis\Breaker\TException;

error_reporting(E_ALL);

try {

    $instance = OrdemServico::make(
        [
            'proID'          => 1,
            'proServicoID'   => [
                [
                    "proID"        => 1,
                    "proDescricao" => 'Descricao de servico'
                ]
            ],
            'proClienteNome' => 'CONECTRA SISTEMAS'
        ]
    );

    var_dump($instance);
} catch (TException $exception) {
    echo $exception->toJson();
}
