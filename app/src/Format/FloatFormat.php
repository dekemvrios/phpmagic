<?php

namespace Solis\PhpValidator\Format;

/**
 * Class IntFormat
 *
 * @package Solis\PhpValidator\Format
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