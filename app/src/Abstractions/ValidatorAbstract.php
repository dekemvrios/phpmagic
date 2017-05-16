<?php

namespace Solis\PhpValidator\Abstractions;

use Solis\PhpValidator\Contracts\ValidatorContract;

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
    protected $expectedProps;

    /**
     * __construct
     *
     * @param $expectedProps
     */
    protected function __construct($expectedProps)
    {
        $this->setExpectedProps($expectedProps);
    }

    /**
     * setExpectedProps
     *
     * @param array $expectedProps
     */
    protected function setExpectedProps(array $expectedProps)
    {
        $this->expectedProps = $expectedProps;
    }

    /**
     * getExpectedProps
     *
     * @return array
     */
    protected function getExpectedProps()
    {
        return $this->expectedProps;
    }
}