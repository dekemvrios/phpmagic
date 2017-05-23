<?php

namespace Solis\PhpMagic\Classes;

use Solis\PhpMagic\Abstractions\TypeValidatorAbstract;
use Solis\PhpMagic\Contracts\StringValidatorContract;
use Solis\PhpMagic\Helpers\Message;

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
            'class'    => 'Solis\\PhpMagic\\Format\\StringFormat'
        ],
        [
            'name'     => 'uppercase',
            'function' => 'applyUppercase',
            'class'    => 'Solis\\PhpMagic\\Format\\StringFormat'
        ],
        [
            'name'     => 'lowercase',
            'function' => 'applyLowercase',
            'class'    => 'Solis\\PhpMagic\\Format\\StringFormat'
        ],
        [
            'name'     => 'noSpecialChars',
            'function' => 'removeSpecialChars',
            'class'    => 'Solis\\PhpMagic\\Format\\StringFormat'
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
     * @param string $name
     * @param mixed  $data
     * @param array  $format
     *
     * @return string
     *
     * @throws \InvalidArgumentException
     */
    public function validate(
        $name,
        $data,
        $format = null
    ) {
        if (!is_string($data)) {
            throw new \InvalidArgumentException(
                Message::getTextMessage(
                    [
                        '@name' => $name,
                        '@type' => 'string',
                    ],
                    Message::PROPERTY_INVALID_TYPE
                )
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
