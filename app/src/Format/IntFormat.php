<?php

namespace Solis\PhpValidator\Format;

/**
 * Class IntFormat
 *
 * @package Solis\PhpValidator\Format
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