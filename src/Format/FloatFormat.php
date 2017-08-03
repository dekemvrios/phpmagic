<?php

namespace Solis\Expressive\Magic\Format;

/**
 * Class IntFormat
 *
 * @package Solis\Expressive\Magic\Format
 */
class FloatFormat
{
    /**
     * @param $data
     *
     * @return float
     */
    public function applyFloatval($data)
    {
        return floatval($data);
    }
}
