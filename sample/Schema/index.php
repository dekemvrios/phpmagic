<?php

require_once '../../vendor/autoload.php';

use Solis\PhpMagic\Classes\Schema\Schema;
use Solis\Breaker\TException;

try {

    $instance = Schema::make(
        file_get_contents('Individuo.json')
    );

    echo $instance->toJson();

} catch (TException $exception) {
    echo $exception->toJson();
}
