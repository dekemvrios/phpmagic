<?php

require_once '../../vendor/autoload.php';

use Solis\PhpMagic\Sample\Advanced\Pessoas\Individuo;

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
                            'aEstado'     => [
                                [
                                    'sNome'       => 'Santa Catarina',
                                    'iCodigoIbge' => '123459',
                                ]
                            ]
                        ]
                    ]
                ],
            ]
        ]
    );

    var_dump($individuo);
} catch (\Exception $exception) {
    echo $exception->getMessage();
}
