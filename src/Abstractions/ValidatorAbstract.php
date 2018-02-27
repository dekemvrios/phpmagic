<?php

namespace Solis\Expressive\Magic\Abstractions;

use MongoDB\BSON\Type;
use Solis\Expressive\Magic\Contracts\JsonValidatorContract;
use Solis\Expressive\Magic\Exception;
use Solis\Expressive\Schema\Contracts\SchemaContract;
use Solis\Expressive\Magic\Contracts\FloatValidatorContract;
use Solis\Expressive\Magic\Contracts\IntValidatorContract;
use Solis\Expressive\Magic\Contracts\StringValidatorContract;
use Solis\Expressive\Magic\Contracts\ValidatorContract;
use Solis\Breaker\Abstractions\TExceptionAbstract;
use Solis\Expressive\Magic\Validator\Types;

/**
 * Class ValidatorAbstract
 *
 * @package Solis\PhpValidator\Abstractions
 */
abstract class ValidatorAbstract implements ValidatorContract
{
    /**
     * @var SchemaContract
     */
    protected $schema;

    /**
     * @var StringValidatorContract
     */
    protected $stringValidator;

    /**
     * @var FloatValidatorContract
     */
    protected $floatValidator;

    /**
     * @var IntValidatorContract
     */
    protected $intValidator;

    /**
     * @var JsonValidatorContract
     */
    protected $jsonValidator;

    /**
     * __construct
     *
     * @param SchemaContract          $schema
     * @param StringValidatorContract $stringValidator
     * @param FloatValidatorContract  $floatValidator
     * @param IntValidatorContract    $intValidator
     * @param JsonValidatorContract   $jsonValidator
     */
    protected function __construct(
        $schema,
        $stringValidator,
        $floatValidator,
        $intValidator,
        $jsonValidator
    ) {
        $this->schema          = $schema;
        $this->stringValidator = $stringValidator;
        $this->floatValidator  = $floatValidator;
        $this->intValidator    = $intValidator;
        $this->jsonValidator   = $jsonValidator;
    }

    /**
     * validate
     *
     * @param string $name
     * @param mixed  $value
     *
     * @return mixed
     * @throws TExceptionAbstract
     */
    public function validate($name, $value)
    {
        $meta = $this->schema->getPropertyEntryByIdentifier($name);

        if (!$meta) {
            throw new Exception("Meta informação para propriedade {$name} não encontrada no schema", 400);
        }
        $meta = is_array($meta) ? $meta[0] : $meta;

        $meta = $meta->toArray();

        return $this->hydrate($meta, $value);
    }

    /**
     * hydrate
     *
     * @param array $meta
     * @param mixed $data
     *
     * @return mixed
     *
     * @throws TExceptionAbstract
     */
    private function hydrate($meta, $data)
    {
        $property = array_key_exists('property', $meta) ? $meta['property'] : null;
        $format   = array_key_exists('format', $meta) ? $meta['format'] : null;
        $type     = array_key_exists('type', $meta) ? $meta['type'] : null;

        switch ($type) {
            case Types::TYPE_STRING:
            case Types::TYPE_DATE:
                return $this->stringValidator->validate($property, $data, $format);
            case Types::TYPE_INT:
                return $this->intValidator->validate($property, $data, $format);
            case Types::TYPE_FLOAT:
                return $this->floatValidator->validate($property, $data, $format);
            case Types::TYPE_JSON:
                return $this->jsonValidator->validate($property, $data, $format);
        }

        return $data;
    }
}
