<?php

namespace Solis\Expressive\Magic\Classes;

use Solis\Expressive\Magic\Abstractions\TypeValidatorAbstract;
use Solis\Expressive\Magic\Contracts\FloatValidatorContract;
use Solis\Breaker\Abstractions\TExceptionAbstract;
use Solis\Expressive\Magic\MagicException;
use Solis\Expressive\Magic\Helpers\Message;

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
     * @return static
     */
    public static function make()
    {
        return new static();
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
                Message::getTextMessage(
                    [
                        '@name' => $name,
                        '@type' => 'float',
                    ],
                    Message::PROPERTY_INVALID_TYPE
                ),
                400
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
