<?php

namespace Solis\Expressive\Magic\Validator;

use Solis\Expressive\Magic\Abstractions\TypeValidatorAbstract;
use Solis\Expressive\Magic\Contracts\StringValidatorContract;
use Solis\Breaker\Abstractions\TExceptionAbstract;
use Solis\Expressive\Magic\Exception;

/**
 * Class StringValidator
 *
 * @package Solis\PhpValidator\Types
 */
class StringValidator extends TypeValidatorAbstract implements StringValidatorContract
{
    /**
     * @var array
     */
    protected $formatting = [
        [
            'name'     => 'size',
            'function' => 'applySize',
            'params'   => true,
            'class'    => 'Solis\\Expressive\\Magic\\Format\\StringFormat',
        ],
        [
            'name'     => 'uppercase',
            'function' => 'applyUppercase',
            'class'    => 'Solis\\Expressive\\Magic\\Format\\StringFormat',
        ],
        [
            'name'     => 'lowercase',
            'function' => 'applyLowercase',
            'class'    => 'Solis\\Expressive\\Magic\\Format\\StringFormat',
        ],
        [
            'name'     => 'noSpecialChars',
            'function' => 'removeSpecialChars',
            'class'    => 'Solis\\Expressive\\Magic\\Format\\StringFormat',
        ],
    ];

    /**
     * @param mixed $meta
     *
     * @return static
     */
    public static function make($meta = null)
    {
        $instance = new static();

        if ($meta) {
            $instance->meta = $meta;
        }

        return $instance;
    }

    /**
     * validate
     *
     * @param string $name
     * @param mixed  $data
     * @param array  $format
     *
     * @return string
     *
     * @throws TExceptionAbstract
     */
    public function validate($name, $data, $format = null)
    {
        if (!is_string($data)) {
            throw new Exception("propriedade [ {$name} ] é inválida para tipo [ string ] definido no schema", 400);
        }

        if ($format) {
            $data = self::applyFormat($format, $data);
        }

        return (string)$data;
    }
}
