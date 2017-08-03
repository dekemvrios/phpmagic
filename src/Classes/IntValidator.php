<?php

namespace Solis\Expressive\Magic\Classes;

use Solis\Expressive\Magic\Abstractions\TypeValidatorAbstract;
use Solis\Expressive\Magic\Contracts\IntValidatorContract;
use Solis\Breaker\Abstractions\TExceptionAbstract;
use Solis\Expressive\Magic\Helpers\Message;
use Solis\Expressive\Magic\MagicException;

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
            'class'    => 'Solis\\Expressive\\Magic\\Format\\IntFormat'
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
     * @throws TExceptionAbstract
     */
    public function validate(
        $name,
        $data,
        $format = null
    ) {
        if (!is_numeric($data) || !is_int(intval($data))) {
            throw new MagicException(
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
