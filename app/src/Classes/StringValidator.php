<?php

namespace Solis\PhpValidator\Classes;

use Solis\PhpValidator\Abstractions\TypeValidatorAbstract;
use Solis\PhpValidator\Contracts\StringValidatorContract;
use Solis\PhpValidator\Helpers\Message;

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
            'class'    => 'Solis\\PhpValidator\\Format\\StringFormat'
        ],
        [
            'name'     => 'uppercase',
            'function' => 'applyUppercase',
            'class'    => 'Solis\\PhpValidator\\Format\\StringFormat'
        ],
        [
            'name'     => 'lowercase',
            'function' => 'applyLowercase',
            'class'    => 'Solis\\PhpValidator\\Format\\StringFormat'
        ],
        [
            'name'     => 'noSpecialChars',
            'function' => 'removeSpecialChars',
            'class'    => 'Solis\\PhpValidator\\Format\\StringFormat'
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
        string $name,
        $data,
        array $format = null
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