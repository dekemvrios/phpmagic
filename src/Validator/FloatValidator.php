<?php

namespace Solis\Expressive\Magic\Validator;

use Solis\Expressive\Magic\Abstractions\TypeValidatorAbstract;
use Solis\Expressive\Magic\Contracts\FloatValidatorContract;
use Solis\Breaker\Abstractions\TExceptionAbstract;
use Solis\Expressive\Magic\MagicException;

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
        if (!empty($meta)) {
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
    public function validate(
        $name,
        $data,
        $format = null
    ) {
        if (!is_numeric($data) || !is_float(floatval($data))) {
            throw new MagicException(
                __CLASS__,
                __METHOD__,
                "property [ {$name} ] is invalid for type [ float ] specified in schema",
                400,
                $this->meta
            );
        }

        if (!empty($format)) {
            $data = self::applyFormat(
                $format,
                $data
            );
        }

        return floatval($data);
    }
}
