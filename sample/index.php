<?php

require_once '../vendor/autoload.php';

use Solis\PhpMagic\Sample\Pessoas\Individuo;

error_reporting(E_ALL);

try {

    $individuo = Individuo::make(
        [
            'code'      => '1',
            'money'     => '1.54',
            'firstName' => 'Rafael',
            'lastName'  => 'Becker',
            'address'   => [
                'Rua 25 de maio',
                'Rua XV de novembro',
                'Rua 7 de setembro',
            ]
        ]
    );

    var_dump($individuo);
} catch (\InvalidArgumentException $exception) {
    echo $exception->getMessage();
}
