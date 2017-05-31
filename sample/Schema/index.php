<?php

require_once '../../vendor/autoload.php';

use Solis\PhpMagic\Sample\Schema\Classes\Estado;
use Solis\Breaker\TException;

try {

    $instance = Estado::make(
        [
            'sNome'       => 'Santa Catarina',
            'iCodigoIbge' => 42,
            'aCidade'     => [
                [
                    'sNome'       => 'Florianopolis',
                    'iCodigoIbge' => 52,
                ],
                [
                    'sNome'       => 'Joinville',
                    'iCodigoIbge' => 52,
                ]
            ],
            "aCapital"    => ['Florianopolis', 'Joinville']
        ]
    );

    var_dump($instance);

} catch (TException $exception) {
    echo $exception->toJson();
}
