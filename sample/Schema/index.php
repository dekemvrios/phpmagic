<?php

require_once '../../vendor/autoload.php';

use Solis\PhpMagic\Sample\Schema\Classes\Estado;
use Solis\Breaker\TException;

try {

    $instance = Estado::make(
        [
            'sNome'       => 'Santa Catarina',
            'iCodigoIbge' => 42
        ]
    );

    var_dump($instance);

} catch (TException $exception) {
    echo $exception->toJson();
}
