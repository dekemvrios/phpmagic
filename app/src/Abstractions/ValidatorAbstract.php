<?php

namespace Solis\PhpValidator\Abstractions;

use Solis\PhpValidator\Contracts\ValidatorContract;
use Solis\PhpValidator\Classes\FloatValidator;
use Solis\PhpValidator\Classes\IntValidator;
use Solis\PhpValidator\Classes\StringValidator;
use Solis\PhpValidator\Helpers\Message;
use Solis\PhpValidator\Helpers\Types;

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
     * __construct
     *
     * @param $schema
     */
    protected function __construct($schema)
    {
        $this->schema = $schema;
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
        string $name,
        $value
    ) {

        $meta = array_values(
            array_filter(
                $this->schema,
                function ($item) use
                (
                    $name
                ) {
                    if (!array_key_exists(
                        'property',
                        $item
                    )
                    ) {
                        throw new \InvalidArgumentException('invalid schema definition');
                    }

                    return $item['property'] === $name ? true : false;
                }
            )
        );

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
                return (new StringValidator())->validate(
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
                return (new IntValidator)->validate(
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
                return (new FloatValidator())->validate(
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