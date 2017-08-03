<?php

namespace Solis\PhpMagic\Abstractions;

use Solis\Expressive\Schema\Contracts\SchemaContract;
use Solis\PhpMagic\Contracts\FloatValidatorContract;
use Solis\PhpMagic\Contracts\IntValidatorContract;
use Solis\PhpMagic\Contracts\StringValidatorContract;
use Solis\PhpMagic\Contracts\ValidatorContract;
use Solis\PhpMagic\Helpers\Types;
use Solis\Breaker\TException;

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
     * __construct
     *
     * @param SchemaContract $schema
     * @param $stringValidator
     * @param $floatValidator
     * @param $intValidator
     */
    protected function __construct(
        $schema,
        $stringValidator,
        $floatValidator,
        $intValidator
    ) {
        $this->schema = $schema;
        $this->stringValidator = $stringValidator;
        $this->floatValidator = $floatValidator;
        $this->intValidator = $intValidator;
    }

    /**
     * validate
     *
     * @param string $name
     * @param mixed  $value
     *
     * @return mixed
     * @throws TException
     */
    public function validate(
        $name,
        $value
    ) {

        $meta = $this->schema->getPropertyEntryByIdentifier($name);
        if (empty($meta)) {
            throw new TException(
                __CLASS__,
                __METHOD__,
                "meta information for 'property' entry has not been found in schema definition",
                400
            );
        }

        $meta = is_array($meta) ? $meta[0] : $meta;
        $meta = $meta->toArray();

        return $this->hydrate(
            $meta,
            $value
        );
    }

    /**
     * hydrate
     *
     * @param array $meta
     * @param mixed $data
     *
     * @return mixed
     *
     * @throws TException
     */
    private function hydrate(
        $meta,
        $data
    ) {

        switch ($meta['type']) {
            case Types::TYPE_STRING:
                return $this->stringValidator->validate(
                    array_key_exists(
                        'property',
                        $meta
                    ) ? $meta['property'] : null,
                    $data,
                    array_key_exists(
                        'format',
                        $meta
                    ) ? $meta['format'] : null
                );

            case Types::TYPE_INT:
                return $this->intValidator->validate(
                    array_key_exists(
                        'property',
                        $meta
                    ) ? $meta['property'] : null,
                    $data,
                    array_key_exists(
                        'format',
                        $meta
                    ) ? $meta['format'] : null
                );

            case Types::TYPE_FLOAT:
                return $this->floatValidator->validate(
                    array_key_exists(
                        'property',
                        $meta
                    ) ? $meta['property'] : null,
                    $data,
                    array_key_exists(
                        'format',
                        $meta
                    ) ? $meta['format'] : null
                );
        }

        // still in development, so if not has an expected type, returns the raw value
        return $data;
    }
}
