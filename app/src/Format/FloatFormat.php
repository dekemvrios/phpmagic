<?php

namespace Solis\PhpMagic\Format;

/**
 * Class IntFormat
 *
 * @package Solis\PhpMagic\Format
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