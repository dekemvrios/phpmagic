<?php

require_once '../../vendor/autoload.php';

use Solis\Expressive\Magic\Sample\Pessoas\Classes\Individuo;
use Solis\Breaker\Abstractions\TExceptionAbstract;

error_reporting(E_ALL);

try {
    $individuo = Individuo::make(
        [
            'iCodigo'       => '1',
            'fDinheiro'     => '1.54',
            'sPrimeiroNome' => 'Rafael',
            'sSegundoNome'  => 'Becker',
            'aEndereco'     => [
                [
                    'sLogradouro'  => 'Rua XV de novembro',
                    'sCep'         => '89160000',
                    'sBairro'      => 'Centro',
                    'sComplemento' => 'Sala 15',
                    'aCidade'      => [
                        [
                            'sNome'       => 'Rio do Sul',
                            'iCodigoIbge' => '123456',
                        ],
                    ],
                ],
            ],
        ]
    );

    var_dump($individuo);
} catch (TExceptionAbstract $exception) {
    echo $exception->toJson();
}
