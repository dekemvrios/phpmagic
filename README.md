# README

## PhpMagic

PhpMagic é utilizado como ferramenta por [phpexpressive](https://github.com/rafaelbeecker/phpexpressive) para atribuição e validação dinâmica de propriedades.

## Como instalar?

Esse pacote foi estruturado para ser instalado por meio do composer

```
composer require solis/phpmagic
``` 

## Como utilizar?

Primeiramente é necessário definir um schema, representando as propriedades a serem atribuidas e seus respectivos tipos.

```
{
    "properties": [
        {
          "alias": "sNome",
          "property": "nome",
          "type": "string"
        },
        {
          "alias": "iCodigoIbge",
          "property": "codigoIbge",
          "type": "int"
        }
     ]
}
```

O schema é uma representação em Json  de uma determinada classe, e é criado através da implementação do [phpschema](https://github.com/rafaelbeecker/phpschema) 

```
$schema = Schema::make(
    file_get_contents("/path/to/schema.json")
);
```

É possível utilizar o mecanismo de validação para validar uma determinada propriedade contra um schema.

```
use Solis\Expressive\Magic\Validator\Validator;

try {

  $value = Validator::make($schema)->validate($property, $value);

} catch(TExceptionAbstract $exception){
  echo $exception->toJson();  
}
```

O mecanismo valida e retorna o valor como especificado no schema, lançando uma TException caso for inválido.

## Change log

Acompanhe o [CHANGELOG](CHANGELOG.md) para informações sobre atualizações recentes.

## Licença

The MIT License (MIT). Verifique [LICENSE](LICENSE.MD) para mais informações.
