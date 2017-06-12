<?php

require_once '../../vendor/autoload.php';

use Solis\PhpMagic\Sample\Veiculo\Classes\Carro;
use Solis\Breaker\TException;

try {

    var_dump(Carro::make(['sNome' => 'Fusca']));
} catch (TException $exception) {
    echo $exception->toJson();
}