<?php

require_once '../../vendor/autoload.php';

use Solis\Expressive\Magic\Sample\Veiculo\Classes\Carro;
use Solis\Breaker\TException;

try {

    $instance = Carro::make([
        'sNome' => 'Fusca',
        'sRoda' => [
            [
                'sMarca' => 'Pirelli',
            ],
            [
                'sMarca' => 'Pirelli',
            ],
        ],
    ]);

    var_dump($instance);

} catch (TException $exception) {
    echo $exception->toJson();
}