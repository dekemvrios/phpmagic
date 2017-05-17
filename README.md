# README

## What is PhpValidate
PhpValidate is a simple php class property validation engine.

## How To Install?
This package was designed to be installed with composer dependency management tool.
```
composer require solis/phpvalidate "dev-master"
``` 

## How To Use it?
First, you need to define a schema, representing the properties and its expected types. 

```
$schema = [
    [
        'property' => 'code',
        'type' => Types::TYPE_INT,
    ],
    [
        'property' => 'firstName',
        'type' => Types::TYPE_STRING,        
    ]
];
```

Require it with composer and instantiate a Validator class and validate a value for a property defined in the schema

```
use Solis\PhpValidator\Classes\Validator;

try {

  $value = Validator::make($schema)->validate('firstName', 'Individuo');

} catch(\InvalidArgumentException $exception){
  $exception->getMessage();  
}
```

The Validator "make static method" returns a implementation of ValidatorContract. It validates 
and returns the value as especified in the schema. It throwns a exception if the value is invalid.
