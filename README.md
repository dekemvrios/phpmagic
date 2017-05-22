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
$schema = [
    [
        'name'     => 'iCode',  
        'property' => 'code',
        'type'     => Types::TYPE_INT,
    ],
    [
        'name'     => 'iFirstName'
        'property' => 'firstName',
        'type'     => Types::TYPE_STRING,
        'format'   => [
            'uppercase', 
            'size' => 15
        ]
    ]
];
```

Require it with composer, instantiate a Validator class and validate a value for a property defined in the schema

```
use Solis\PhpMagic\Classes\Validator;

try {

  $value = Validator::make($schema)->validate('firstName', 'Individuo');

} catch(\InvalidArgumentException $exception){
  $exception->getMessage();  
}
```

It validates and returns the value as especified in the schema, throwing a exception if the value is invalid.
