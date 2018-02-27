<?php

require_once '../../vendor/autoload.php';

use Solis\Expressive\Magic\Sample\Pessoas\Classes\Individuo;
use Solis\Breaker\Abstractions\TExceptionAbstract;

error_reporting(E_ALL);

try {

    $malformed = iconv(
        'UTF-8',
        'ISO-8859-1',
        'ç'
    );

    $endereco = [
        [
            'sLogradouro'  => 'Rua XV de novembro',// . $malformed,
            'sCep'         => '89160000',
            'sBairro'      => 'Centro',
            'sComplemento' => 'Sala 15',
            'aCidade'      => [
                [
                    'sNome'       => 'Rio do Sul',
                    'iCodigoIbge' => '1',
                ],
            ],
        ],
    ];

    $individuo = Individuo::make([
        'iCodigo'         => '3',
        'sSegundoNome'    => 'Becker',
        'sDataNascimento' => Date('Y-m-d H:i:s'),
        'aEndereco'       => $endereco,
        'jEndereco'       => $endereco,
    ]);

    print_r($individuo->toArray());
} catch (TExceptionAbstract $exception) {
    var_dump($exception);
}
