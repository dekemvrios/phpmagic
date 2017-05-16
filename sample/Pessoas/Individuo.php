<?php

namespace Sample\Pessoas;

use Solis\PhpValidator\Contracts\ValidatorContract;
use Solis\PhpValidator\Classes\Validator;

/**
 * Class Individuo
 *
 * @package Sample
 */
class Individuo
{

    /**
     * @var ValidatorContract
     */
    protected $validator;

    /**
     * @var string
     */
    protected $name;

    /**
     * __construct
     *
     * @param $validator
     */
    protected function __construct($validator)
    {
        $this->validator = $validator;
    }

    /**
     * @param $schema
     *
     * @return static
     */
    public static function make(array $schema)
    {
        return new static(Validator::make($schema));
    }

    /**
     * __set
     *
     * @param $name
     * @param $value
     *
     * @throws \InvalidArgumentException
     */
    public function __set(
        $name,
        $value
    ) {
        if (property_exists(
            __CLASS__,
            $name
        )) {
            $value = $this->validator->validate(
                $name,
                $value
            );

            $this->$name = $value;
        }

    }

    /**
     * __get
     *
     * @param $name
     *
     * @return mixed
     */
    public function __get($name)
    {
        if (property_exists(
            __CLASS__,
            $name
        )) {
            return $this->$name;
        }
    }

}