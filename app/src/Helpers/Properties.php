<?php

namespace Solis\PhpValidator\Helpers;

/**
 * Class Properties
 *
 * @package Solis\PhpValidator\Helpers
 */
class Properties
{
    const PROPERTY_NOT_EXIST = "property [name] does not exists in [class]";

    /**
     * getNotExistsMessage
     *
     * @param $params
     *
     * @return string
     */
    public static function getNotExistsMessage($params)
    {
        $mesage = self::PROPERTY_NOT_EXIST;

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