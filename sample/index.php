<?php

require_once '../vendor/autoload.php';

use Solis\PhpValidator\Helpers\Types;
use Sample\Pessoas\Fulano;

try {
    $schema = [
        [
            'name' => 'codigo',
            'type' => Types::TYPE_INT,
        ],
        [
            'name' => 'nome',
            'type' => Types::TYPE_STRING,
            'format' => [
                'size' => 2
            ]
        ]
    ];

    $fulano = Fulano::make($schema);

    $fulano->codigo = '1';

    var_dump($fulano);

} catch (\InvalidArgumentException $exception) {
    echo $exception->getMessage();
}
