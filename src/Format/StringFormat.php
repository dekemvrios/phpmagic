<?php

namespace Solis\Expressive\Magic\Format;

/**
 * Class StringFormat
 *
 * @package Solis\Expressive\Magic\Format
 */
class StringFormat
{
    /**
     * applySize
     *
     * @param string $data
     * @param int    $size
     *
     * @return string
     */
    public static function applySize(
        $data,
        $size
    ) {
        return substr(
            $data,
            0,
            intval($size)
        );
    }

    /**
     * applySize
     *
     * @param string $data
     *
     * @return string
     */
    public static function applyUppercase(
        $data
    ) {
        return strtoupper($data);
    }

    /**
     * applyLowercase
     *
     * @param string $data
     *
     * @return string
     */
    public static function applyLowercase(
        $data
    ) {
        return strtolower($data);
    }

    /**
     * removeSpecialChars
     *
     * @param $data
     *
     * @return mixed
     */
    public static function removeSpecialChars(
        $data
    ) {

        return preg_replace(
            '/[^A-Za-z0-9\-]/',
            '',
            $data
        );
    }
}
