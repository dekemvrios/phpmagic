<?php

namespace Solis\Expressive\Magic\Classes;

use Solis\Expressive\Magic\Abstractions\TypeValidatorAbstract;
use Solis\Expressive\Magic\Contracts\StringValidatorContract;
use Solis\Breaker\Abstractions\TExceptionAbstract;
use Solis\Expressive\Magic\Helpers\Message;
use Solis\Expressive\Magic\MagicException;

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
     * @param string $name
     * @param mixed  $data
     * @param array  $format
     *
     * @return string
     *
     * @throws TExceptionAbstract
     */
    public function validate(
        $name,
        $data,
        $format = null
    ) {
        if (!is_string($data)) {
            throw new MagicException(
                __CLASS__,
                __METHOD__,
                Message::getTextMessage(
                    [
                        '@name' => $name,
                        '@type' => 'string',
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

        return (string)$data;
    }
}
