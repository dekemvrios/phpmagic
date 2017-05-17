<?php

require_once '../vendor/autoload.php';

use Sample\Pessoas\Individuo;


try {

    $fulano = (new Individuo());

    $fulano->attach(
        [
            'code'      => '1',
            'money'     => '1.54',
            'firstName' => 'Rafael',
            'lastName'  => 'Becker',
        ]
    );

    var_dump(
        [
            $fulano,
        ]
    );

} catch (\InvalidArgumentException $exception) {
    echo $exception->getMessage();
}
