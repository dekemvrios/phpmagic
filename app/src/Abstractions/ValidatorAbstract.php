<?php

namespace Solis\PhpMagic\Abstractions;

use Solis\PhpMagic\Contracts\FloatValidatorContract;
use Solis\PhpMagic\Contracts\IntValidatorContract;
use Solis\PhpMagic\Contracts\StringValidatorContract;
use Solis\PhpMagic\Contracts\ValidatorContract;
use Solis\PhpMagic\Helpers\Message;
use Solis\PhpMagic\Helpers\Types;

/**
 * Class ValidatorAbstract
 *
 * @package Solis\PhpValidator\Abstractions
 */
abstract class ValidatorAbstract implements ValidatorContract
{
    /**
     * @var array
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
     * @param $schema
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
     * @throws \InvalidArgumentException
     */
    public function validate(
        $name,
        $value
    ) {

        $meta = array_values(array_filter($this->schema, function ($item) use ($name) {
            if (!array_key_exists('property', $item)) {
                throw new \InvalidArgumentException('invalid schema definition');
            }

            return $item['property'] === $name ? true : false;
        }));

        if (empty($meta)) {
            throw new \InvalidArgumentException(
                Message::getTextMessage(
                    ['@name' => $name, '@class' => __CLASS__],
                    Message::PROPERTY_NOT_FOUND
                ) . ' schema'
            );
        }

        return $this->hydrate(
            $meta[0],
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
     * @throws \InvalidArgumentException
     */
    private function hydrate(
        $meta,
        $data
    ) {

        if (!array_key_exists(
            'type',
            $meta
        )
        ) {
            throw new \InvalidArgumentException('invalid schema definition');
        }

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
    }
}
