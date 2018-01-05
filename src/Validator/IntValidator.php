<?php

namespace Solis\Expressive\Magic\Validator;

use Solis\Expressive\Magic\Abstractions\TypeValidatorAbstract;
use Solis\Expressive\Magic\Contracts\IntValidatorContract;
use Solis\Breaker\Abstractions\TExceptionAbstract;
use Solis\Expressive\Magic\Exception;

/**
 * Class IntValidator
 *
 * @package Solis\PhpValidator\Types
 */
class IntValidator extends TypeValidatorAbstract implements IntValidatorContract
{
    /**
     * @var array
     */
    protected $formatting = [
        [
            'name'     => 'intval',
            'function' => 'applyIntval',
            'class'    => 'Solis\\Expressive\\Magic\\Format\\IntFormat'
        ]
    ];

    /**
     * make
     *
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
     * @param       $name
     * @param       $data
     * @param array $format
     *
     * @return int
     *
     * @throws TExceptionAbstract
     */
    public function validate($name, $data, $format = null)
    {
        if (!is_numeric($data) || !is_int(intval($data))) {
            throw new Exception("propriedade [ {$name} ] é inválida para tipo [ int ] definido no schema", 400);
        }

        if ($format) {
            $data = self::applyFormat($format, $data);
        }

        return intval($data);
    }
}
