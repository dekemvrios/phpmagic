<?php

namespace Solis\PhpValidator\Classes;

use Solis\PhpValidator\Abstractions\TypeValidatorAbstract;
use Solis\PhpValidator\Helpers\Types;

/**
 * Class IntValidator
 *
 * @package Solis\PhpValidator\Types
 */
class IntValidator extends TypeValidatorAbstract
{
    /**
     * @var array
     */
    protected $formatting = [
        [
            'name'     => 'intval',
            'function' => 'applyIntval',
            'class'    => 'Solis\\PhpValidator\\Format\\IntFormat'
        ]
    ];

    /**
     * validate
     *
     * @param       $name
     * @param       $data
     * @param array $format
     *
     * @return int
     *
     * @throws \InvalidArgumentException
     */
    public function validate(
        $name,
        $data,
        array $format = null
    ) {
        if (!is_numeric($data) || !is_int(intval($data))) {
            throw new \InvalidArgumentException(
                Types::getInvalidTypeMessage(
                    [
                        '@name' => $name,
                        '@type' => 'int'
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

        return intval($data);
    }
}