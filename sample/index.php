<?php

require_once '../vendor/autoload.php';

use Solis\PhpValidator\Helpers\Types;
use Sample\Pessoas\Fulano;

try {

    $fulano = Fulano::make([
        [
            'name' => 'code',
            'type' => Types::TYPE_INT,
        ],
        [
            'name' => 'firstName',
            'type' => Types::TYPE_STRING,
            'format' => [
                'uppercase' => ''
            ]
        ],
        [
            'name' => 'lastName',
            'type' => Types::TYPE_STRING,
            'format' => [
                'lowercase' => ''
            ]
        ]
    ]);

    $fulano->firstName = 'Rafael';
    $fulano->lastName = 'Becker';
    $fulano->code = '1';

    var_dump([
        $fulano->firstName,
        $fulano->lastName,
        $fulano->code
    ]);

} catch (\InvalidArgumentException $exception) {
    echo $exception->getMessage();
}
