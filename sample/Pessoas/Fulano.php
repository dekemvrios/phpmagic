<?php

namespace Sample\Pessoas;

use Solis\PhpValidator\Contracts\ValidatorContract;
use Solis\PhpValidator\Classes\Validator;
use Solis\PhpValidator\Helpers\Magic;

/**
 * Class Fulano
 *
 * @package Sample
 */
class Fulano
{

    use Magic;

    /**
     * @var ValidatorContract
     */
    protected $validator;

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

}