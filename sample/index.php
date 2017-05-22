<?php

require_once '../vendor/autoload.php';

use Solis\PhpMagic\Sample\Pessoas\Individuo;

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
                    'sCidade'      => 'Rio do Sul',
                    'sComplemento' => 'Sala 15'
                ],
                [
                    'sLogradouro'  => 'Rua 7 de Setembro',
                    'sCep'         => '89172000',
                    'sBairro'      => 'Centro',
                    'sCidade'      => 'Pouso Redondo',
                    'sComplemento' => 'Casa'
                ],
            ]
        ]
    );

    var_dump($individuo);
} catch (\InvalidArgumentException $exception) {
    echo $exception->getMessage();
}
