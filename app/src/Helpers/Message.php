<?php

namespace Solis\PhpValidator\Helpers;

/**
 * Class Message
 *
 * @package Solis\PhpValidator\Helpers
 */
class Message
{
    const PROPERTY_NOT_FOUND = "property [@name] not found in [@class]";

    const PROPERTY_METHOD_NOT_FOUND = "method [@method] for property not found in [@class]";

    const PROPERTY_CLASS_NOT_FOUND = "not found class [@class] for property";

    const PROPERTY_INVALID_TYPE = "property [@name] is not of the expected type [@type]";

    /**
     * getTextMessage
     *
     * @param $params
     *
     * @return string
     */
    public static function getTextMessage($params, $message)
    {

        foreach ($params as $name => $value) {
            $message = str_replace(
                $name,
                $value,
                $message
            );
        }

        return $message;
    }

}