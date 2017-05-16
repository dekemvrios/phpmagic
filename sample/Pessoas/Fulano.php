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
    public $validator;

    /**
     * @var int
     */
    protected $code;

    /**
     * @var string
     */
    protected $firstName;

    /**
     * @var string
     */
    protected $lastName;

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