<?php

require_once '../../vendor/autoload.php';

use Solis\PhpMagic\Sample\Veiculo\Classes\Carro;
use Solis\Breaker\TException;

try {

    $instance = Carro::make(
        [
            'sNome' => 'Fusca',
            'sRoda' => [
                [
                    'sMarca' => 'Pirelli'
                ],
                [
                    'sMarca' => 'Pirelli'
                ]
            ]
        ]
    );

    $instance->toArray();

} catch (TException $exception) {
    echo $exception->toJson();
}