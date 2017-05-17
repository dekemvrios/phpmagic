<?php


namespace Solis\PhpValidator\Abstractions;

use Solis\PhpValidator\Contracts\TypeValidatorContract;

/**
 * Class TypeValidatorAbstract
 *
 * @package Solis\PhpValidator\Abstractions
 */
abstract class TypeValidatorAbstract
{
    /**
     * @var array
     */
    protected $formatting;

    /**
     * applyFormat
     *
     * @param array $format
     * @param mixed $data
     *
     * @return string
     */
    protected function applyFormat(
        $format,
        $data
    ) {
        $bHasCustomFormat = false;

        foreach ($this->formatting as $options) {

            foreach ($format as $item => $value) {

                if (!is_array($value)) {
                    $compare = !is_string($item) ? $value : $item;

                    if ($options['name'] === $compare) {

                        $data = self::applyDefaultFormat(
                            $format,
                            $options,
                            $data
                        );

                    }
                } else {
                    $bHasCustomFormat = true;
                }
            }

        }

        if (!empty($bHasCustomFormat)) {
            $data = self::applyCustomFormat(
                $format,
                $data
            );
        }

        return $data;
    }

    /**
     * appluCustomFormat
     *
     * @param $format
     * @param $data
     *
     * @return string
     */
    protected function applyCustomFormat(
        $format,
        $data
    ) {

        foreach ($format as $key => $value) {

            if (is_array($value)) {
                $class = array_key_exists(
                    'class',
                    $value
                ) ? $value['class'] : null;

                $method = array_key_exists(
                    'function',
                    $value
                ) ? $value['function'] : null;

                $params = array_key_exists(
                    'params',
                    $value
                ) ? $value['params'] : [];

                array_unshift(
                    $params,
                    $data
                );

                if (!empty($class) && !empty($method)) {
                    $data = call_user_func_array(
                        $class . "::" . $method,
                        $params
                    );
                }
            }
        }

        return $data;
    }

    /**
     * applyDefaultFormat
     *
     * @param array $format
     * @param array $options
     * @param array $data
     *
     * @return string
     *
     * @throws \InvalidArgumentException
     */
    protected function applyDefaultFormat(
        $format,
        $options,
        $data
    ) {

        $method = array_key_exists(
            'function',
            $options
        ) ? $options['function'] : null;

        $class = array_key_exists(
            'class',
            $options
        ) ? $options['class'] : null;

        if (empty($method) || empty($class)) {
            return $data;
        }

        $params = isset($options['params']) ? [$format[$options['name']]] : [];

        array_unshift(
            $params,
            $data
        );

        $data = call_user_func_array(
            $class . '::' . $method,
            $params
        );

        return $data;
    }
}