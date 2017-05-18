<?php

namespace Solis\PhpValidator\Classes;

use Solis\PhpValidator\Abstractions\TypeValidatorAbstract;
use Solis\PhpValidator\Contracts\IntValidatorContract;
use Solis\PhpValidator\Helpers\Message;

/**
 * Class IntValidator
 *
 * @package Solis\PhpValidator\Types
 */
class IntValidator extends TypeValidatorAbstract implements IntValidatorContract
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
                Message::getTextMessage(
                    [
                        '@name' => $name,
                        '@type' => 'int',
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

        return intval($data);
    }
}