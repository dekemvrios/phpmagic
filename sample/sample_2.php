<?php

require_once '../vendor/autoload.php';

use Sample\Pessoas\Individuo;


try {

    $fulano = new Individuo();

    $fulano->attach(
        [
            'firstName' => 'Rafael',
            'lastName'  => 'Becker',
            'code'      => 1
        ]
    );

    var_dump(
        [
            $fulano->primeiroNome,
            $fulano->segundoNome,
            $fulano->codigo
        ]
    );

} catch (\InvalidArgumentException $exception) {
    echo $exception->getMessage();
}
