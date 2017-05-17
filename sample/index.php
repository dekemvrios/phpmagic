<?php

require_once '../vendor/autoload.php';

use Sample\Pessoas\Individuo;


try {

    $fulano = (new Individuo());

    $fulano->attach(
        [
            'firstName' => 'Rafael',
            'lastName'  => 'Becker'
        ]
    );

    var_dump(
        [
            $fulano
        ]
    );

} catch (\InvalidArgumentException $exception) {
    echo $exception->getMessage();
}
