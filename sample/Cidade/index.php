<?php

require_once '../../vendor/autoload.php';

use Solis\Expressive\Magic\Sample\Cidade\Classes\Estado;
use Solis\Breaker\Abstractions\TExceptionAbstract;
use Solis\Breaker\TException;

try {

    $instance = Estado::make(
        [
            'sNome'       => 'Santa Catarina',
            'iCodigoIbge' => 52,
            'aCidade'     => [
                [
                    'sNome'       => 'Rio do Sul',
                    'iCodigoIbge' => 52,
                ],
                [
                    'sNome'       => 'Joinville',
                    'iCodigoIbge' => 2,
                ],
            ],
            "aCapital"    => [
                'sNome'       => 'Rio do Sul',
                'iCodigoIbge' => 1,
            ],
        ]
    );
    var_dump($instance);
} catch (TExceptionAbstract $exception) {
    echo $exception->toJson();
}