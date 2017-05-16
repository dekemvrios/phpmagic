<?php

namespace Solis\PhpValidator\Abstractions;

use Solis\PhpValidator\Contracts\ValidatorContract;
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
                    return $item['name'] === $name ? true : false;
                }
            )
        );

        if (empty($meta)) {
            throw new \InvalidArgumentException(
                Properties::getNotFoundMessage(['@name' => $name, '@class' => __CLASS__])
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
                return Types::validateString(
                    $meta['name'],
                    $data,
                    $meta['options']
                );

            case Types::TYPE_INT:
                return Types::validateInt(
                    $meta['name'],
                    $data,
                    $meta['options']
                );

            case Types::TYPE_FLOAT:
                return Types::validateFloat(
                    $meta['name'],
                    $data,
                    $meta['options']
                );
        }
    }

}