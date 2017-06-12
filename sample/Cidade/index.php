<?php

require_once '../../vendor/autoload.php';

use Solis\PhpMagic\Sample\Cidade\Classes\Estado;
use Solis\Breaker\TException;

try {

    var_dump(
        Estado::make([])
    );
} catch (TException $exception) {
    echo $exception->toJson();
}