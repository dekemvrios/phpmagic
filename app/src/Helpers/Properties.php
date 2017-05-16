<?php

namespace Solis\PhpValidator\Helpers;

/**
 * Class Properties
 *
 * @package Solis\PhpValidator\Helpers
 */
class Properties
{

    const PROPERTY_NOT_FOUND = "property [@name] not found in [@class]";

    /**
     * getNotExistsMessage
     *
     * @param $params
     *
     * @return string
     */
    public static function getNotFoundMessage($params)
    {
        $mesage = self::PROPERTY_NOT_FOUND;

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