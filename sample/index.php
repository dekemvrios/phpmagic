<?php

require_once '../vendor/autoload.php';

use Solis\PhpValidator\Helpers\Types;
use Sample\Pessoa;

try {
    $schema = [
        [
            'name' => 'codigo',
            'type' => Types::TYPE_INT,
        ],
        [
            'name' => 'nome',
            'type' => Types::TYPE_STRING
        ]
    ];

    $value = Pessoa::make($schema)->validator->validate(
        'nome',
        'Individuo 1'
    );

    echo $value;

} catch (\InvalidArgumentException $exception) {
    echo $exception->getMessage();
}
