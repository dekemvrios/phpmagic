<?php

namespace Solis\PhpMagic\Classes;

use Solis\PhpMagic\Abstractions\TypeValidatorAbstract;
use Solis\PhpMagic\Contracts\IntValidatorContract;
use Solis\PhpMagic\Helpers\Message;
use Solis\Breaker\TException;

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
     * @throws TException
     */
    public function validate(
        $name,
        $data,
        $format = null
    ) {
        if (!is_numeric($data) || !is_int(intval($data))) {
            throw new TException(
                __CLASS__,
                __METHOD__,
                Message::getTextMessage(
                    [
                        '@name' => $name,
                        '@type' => 'int',
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

        return intval($data);
    }
}
