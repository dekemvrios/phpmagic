<?php

namespace Solis\PhpValidator\Helpers;

/**
 * Class Types
 *
 * @package Solis\PhpValidator
 */
class Types
{

    const TYPE_INT = 'int';

    const TYPE_STRING = 'string';

    const TYPE_FLOAT = 'float';

    const TYPE_BOOLEAN = 'bool';

    const PROPERTY_INVALID_TYPE = "property [@name] is not of the expected type [@type]";

    /**
     * getInvalidTypeMessage
     *
     * @param $params
     *
     * @return string
     */
    public static function getInvalidTypeMessage($params)
    {
        $mesage = self::PROPERTY_INVALID_TYPE;

        foreach ($params as $name => $value) {
            $mesage = str_replace(
                $name,
                $value,
                $mesage
            );
        }

        return $mesage;
    }

}