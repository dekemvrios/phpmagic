<?php

require_once '../../vendor/autoload.php';

use Solis\PhpMagic\Classes\Schema\Schema;
use Solis\Breaker\TException;

try {

    $instance = Schema::make(
        file_get_contents('Estado.json')
    );

    //echo $instance->toJson();

    var_dump($instance);

} catch (TException $exception) {
    echo $exception->toJson();
}
