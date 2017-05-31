<?php

require_once '../../vendor/autoload.php';

use Solis\PhpMagic\Sample\Schema\Classes\Estado;
use Solis\Breaker\TException;

error_reporting(E_ALL);

try {

    $instance = Estado::make(
        [
            'sNome'       => 'Santa Catarina',
            'iCodigoIbge' => 42,
            'aCidade'     => [
                [
                    'sNome'       => 'Rio do Sul',
                    'iCodigoIbge' => 52,
                ],
                [
                    'sNome'       => 'Joinville',
                    'iCodigoIbge' => 52,
                ]
            ],
            "aCapital"    => [
                'sNome'       => 'Florianopolis',
                'iCodigoIbge' => 52,
            ],
        ]
    );

    var_dump($instance);

} catch (TException $exception) {
    echo $exception->toJson();
}
