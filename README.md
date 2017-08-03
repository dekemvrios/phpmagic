# README

## What is PhpMagic
PhpMagic is a simple php class property validation engine.

## How To Install?
This package was designed to be installed with composer dependency management tool.

```
composer require solis/phpmagic
``` 

## How To Use it?
First, you need to define a schema, representing the properties and its expected types/formats. 

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

The schema is a json representation of a class and is built by the PhpSchema\Schema class.

```
Solis\PhpSchema\Classes\Schema;

$schema = Schema::make(
    file_get_contents("/path/to/schema.json")
);
```

Its possible to use the validation engine to validate a certain value against the schema.

```
use Solis\Expressive\Magic\Classes\Validator;

try {

  $value = Validator::make($schema)->validate($property, $value);

} catch(\InvalidArgumentException $exception){
  $exception->getMessage();  
}
```

It validates and returns the value as specified in the schema, throwing a TException if the value is invalid.
