<?php

namespace Solis\PhpValidator\Classes;

use Solis\PhpValidator\Abstractions\TypeValidatorAbstract;
use Solis\PhpValidator\Helpers\Types;

/**
 * Class StringValidator
 *
 * @package Solis\PhpValidator\Types
 */
class StringValidator extends TypeValidatorAbstract
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
                Types::getInvalidTypeMessage(
                    [
                        '@name' => $name,
                        '@type' => 'string'
                    ]
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