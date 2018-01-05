<?php

namespace Solis\Expressive\Magic;

use Solis\Breaker\Abstractions\TExceptionAbstract;
use Solis\Breaker\Classes\TInfo;

/**
 * Class Exception
 *
 * @package Solis\Expressive\Magic
 */
class Exception extends TExceptionAbstract
{
    /**
     * __construct
     *
     * @param mixed $reason explanation for TException
     * @param mixed $code   error code
     */
    public function __construct($reason, $code)
    {
        // create new Tinfo object to store default TException information
        $error = Tinfo::build([
            'code'    => $code,
            'message' => $reason,
        ]);
        // create new Tinfo object to store debug TException information
        $debug = Tinfo::build([
            'class'  => $this->getClassName(),
            'method' => $this->getMethodName(),
            'trace'  => $this->getTrace(),
        ]);
        parent::__construct($error, $debug);
    }

    protected function getClassName()
    {
        $stack = $this->getTrace();

        $class = isset($stack[0]['class']) && !empty($stack[0]['class']) ? $stack[0]['class'] : '';

        return $class;
    }

    protected function getMethodName()
    {
        $stack  = $this->getTrace();
        $method = isset($stack[0]['function']) && !empty($stack[0]['function']) ? $stack[0]['function'] : '';

        return $method;
    }
}