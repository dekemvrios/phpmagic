<?php

namespace Solis\PhpMagic\Classes;

use Solis\PhpMagic\Abstractions\TypeValidatorAbstract;
use Solis\PhpMagic\Contracts\FloatValidatorContract;
use Solis\PhpMagic\Helpers\Message;
use Solis\Breaker\TException;

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
            'class'    => 'Solis\\PhpValidator\\Format\\FloatFormat'
        ]
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
     * @throws TException
     */
    public function validate(
        $name,
        $data,
        $format = null
    ) {
        if (!is_numeric($data) || !is_float(floatval($data))) {
            throw new TException(
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
