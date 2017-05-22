<?php

require_once '../vendor/autoload.php';

use Sample\Pessoas\Individuo;

error_reporting(E_ALL);

try {

    $individuo = Individuo::make(
        [
            'code'      => '1',
            'money'     => '1.54',
            'firstName' => 'Rafael',
            'lastName'  => 'Becker',
            'address'   => 'Emilio Peters'
        ]
    );

    var_dump($individuo);
} catch (\InvalidArgumentException $exception) {
    echo $exception->getMessage();
}
