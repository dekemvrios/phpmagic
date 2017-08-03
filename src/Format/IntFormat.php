<?php

namespace Solis\Expressive\Magic\Format;

/**
 * Class IntFormat
 *
 * @package Solis\Expressive\Magic\Format
 */
class IntFormat
{
    /**
     * @param $data
     *
     * @return int
     */
    public function applyIntval($data)
    {
        return intval($data);
    }
}
