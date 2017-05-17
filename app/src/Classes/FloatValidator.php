<?php

namespace Solis\PhpValidator\Classes;

use Solis\PhpValidator\Abstractions\TypeValidatorAbstract;
use Solis\PhpValidator\Helpers\Types;

/**
 * Class FloatValidator
 *
 * @package Solis\PhpValidator\Types
 */
class FloatValidator extends TypeValidatorAbstract
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
     * validate
     *
     * @param       $name
     * @param       $data
     * @param array $format
     *
     * @return float
     *
     * @throws \InvalidArgumentException
     */
    public function validate(
        $name,
        $data,
        array $format = null
    ) {
        if (!is_float(floatval($data))) {
            throw new \InvalidArgumentException(
                Types::getInvalidTypeMessage(
                    [
                        '@name' => $name,
                        '@type' => 'float'
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

        return floatval($data);
    }

}