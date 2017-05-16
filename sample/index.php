<?php

require_once '../vendor/autoload.php';

use Solis\PhpValidator\Helpers\Types;
use Sample\Pessoa;

try {
    $aExpectedProps = [
        [
            'name'     => 'codigo',
            'type'     => Types::TYPE_INT,
            'required' => 'TRUE'
        ],
        [
            'name'     => 'nome',
            'type'     => Types::TYPE_STRING,
            'required' => 'TRUE'
        ]
    ];

    $pessoa = Pessoa::make($aExpectedProps);

    var_dump($pessoa->validator);
} catch (\InvalidArgumentException $exception) {
    echo $exception->getMessage();
}
