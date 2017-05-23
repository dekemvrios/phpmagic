<?php

require_once '../vendor/autoload.php';

use Solis\PhpMagic\Sample\Veiculo\Carro;

error_reporting(E_ALL);

try {
    $veiculo = Carro::make(
        [
            'sNome' => 'Kombi',
            'sRoda' => [
                [
                    'sMarca'    => 'Pirelli',
                    'sPolegada' => 15
                ],
                [
                    'sMarca'    => 'Michelin',
                    'sPolegada' => 19
                ],
                [
                    'sMarca'    => 'GoodYear',
                    'sPolegada' => 21
                ],
            ]
        ]
    );

    var_dump($veiculo);
} catch (\InvalidArgumentException $exception) {
    echo $exception->getMessage();
}
