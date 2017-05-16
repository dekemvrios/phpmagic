<?php

namespace Sample;

use Solis\PhpValidator\Contracts\ValidatorContract;
use Solis\PhpValidator\Factory\Validator;
use Solis\PhpValidator\Helpers\Magic;

/**
 * Class Pessoa
 *
 * @package Sample
 */
class Pessoa
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
     * @param $aExpectedProps
     *
     * @return static
     */
    public static function make(array $aExpectedProps)
    {
        return new static(Validator::make($aExpectedProps));
    }

}