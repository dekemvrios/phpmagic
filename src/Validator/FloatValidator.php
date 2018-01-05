<?php

namespace Solis\Expressive\Magic\Validator;

use Solis\Expressive\Magic\Abstractions\TypeValidatorAbstract;
use Solis\Expressive\Magic\Contracts\FloatValidatorContract;
use Solis\Breaker\Abstractions\TExceptionAbstract;
use Solis\Expressive\Magic\Exception;

/**
 * Class FloatValidator
 *
 * @package Solis\PhpValidator\Types
 */
class FloatValidator extends TypeValidatorAbstract implements FloatValidatorContract
{

    /**
     * @var array
     */
    protected $formatting = [
        [
            'name'     => 'floatval',
            'function' => 'applyFloatval',
            'class'    => 'Solis\\Expressive\\Magic\\Format\\FloatFormat',
        ],
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
     * @return float
     *
     * @throws TExceptionAbstract
     */
    public function validate($name, $data, $format = null)
    {
        if (!is_numeric($data) || !is_float(floatval($data))) {
            throw new Exception("propriedade [ {$name} ] é inválida para tipo [ float ] definido no schema", 400);
        }

        if ($format) {
            $data = self::applyFormat($format, $data);
        }

        return floatval($data);
    }
}
