<?php

namespace Solis\PhpMagic\Format;

/**
 * Class IntFormat
 *
 * @package Solis\PhpMagic\Format
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