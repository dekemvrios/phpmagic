<?php

namespace Solis\PhpValidator\Abstractions;

use Solis\PhpValidator\Contracts\ValidatorContract;
use Solis\PhpValidator\Classes\FloatValidator;
use Solis\PhpValidator\Classes\IntValidator;
use Solis\PhpValidator\Classes\StringValidator;
use Solis\PhpValidator\Helpers\Properties;
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
                    return $item['property'] === $name ? true : false;
                }
            )
        );

        if (empty($meta)) {
            throw new \InvalidArgumentException(
                Properties::getNotFoundMessage(['@name' => $name, '@class' => __CLASS__]) . ' schema'
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
        switch ($meta['type']) {
            case Types::TYPE_STRING:
                return (new StringValidator())->validate(
                    $meta['property'],
                    $data,
                    $meta['format']
                );

            case Types::TYPE_INT:
                return (new IntValidator)->validate(
                    $meta['property'],
                    $data,
                    $meta['format']
                );

            case Types::TYPE_FLOAT:
                return (new FloatValidator())->validate(
                    $meta['property'],
                    $data,
                    $meta['format']
                );
        }
    }

}