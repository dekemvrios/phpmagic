<?php

namespace Solis\Expressive\Magic\Abstractions;

use Solis\Breaker\Abstractions\TExceptionAbstract;
use Solis\Expressive\Magic\MagicException;

/**
 * Class TypeValidatorAbstract
 *
 * @package Solis\Expressive\Magic\Abstractions
 */
abstract class TypeValidatorAbstract
{
    /**
     * @var array
     */
    protected $formatting;

    /**
     * @var mixed
     */
    protected $meta = [];

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

        foreach ($format as $key => $value) {
            $meta = array_values(array_filter($this->formatting, function ($item) use ($value) {
                return $item['name'] === $value['function'] ? true : false;
            }));

            if (!empty($meta) && !array_key_exists('class', $value)) {
                $data = $this->applyDefaultFormat(
                    $value,
                    $meta[0],
                    $data
                );
            } else {
                $data = $this->applyCustomFormat(
                    $value,
                    $data
                );
            }
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
     *
     * @throws \InvalidArgumentException
     */
    protected function applyCustomFormat(
        $format,
        $data
    ) {

        $aClassFunc = $this->getFuncParams($format);

        $params = array_key_exists(
            'params',
            $format
        ) ? $format['params'] : [];

        array_unshift(
            $params,
            $data
        );

        $object = (new \ReflectionClass($aClassFunc['class']))->newInstance();
        $data = call_user_func_array(
            [$object, $aClassFunc['method']],
            $params
        );

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

        $aClassFunc = $this->getFuncParams($options);

        $params = array_key_exists(
            'params',
            $format
        ) && isset($options['params']) ? $format['params'] : [];

        if (!is_array($params)) {
            $params = [$params];
        }

        array_unshift(
            $params,
            $data
        );

        $object = (new \ReflectionClass($aClassFunc['class']))->newInstance();
        $data = call_user_func_array(
            [$object, $aClassFunc['method']],
            $params
        );

        return $data;
    }

    /**
     * getFuncParams
     *
     * @param $options
     *
     * @return array
     *
     * @throws TExceptionAbstract
     */
    protected function getFuncParams($options)
    {
        $method = array_key_exists(
            'function',
            $options
        ) ? $options['function'] : null;

        $class = array_key_exists(
            'class',
            $options
        ) ? $options['class'] : null;

        if (!class_exists($class)) {
            throw new MagicException(
                __CLASS__,
                __METHOD__,
                "class {$class} for schema property has not been defined",
                400,
                $this->meta
            );
        }

        if (!method_exists(
            $class,
            $method
        )
        ) {
            throw new MagicException(
                __CLASS__,
                __METHOD__,
                "method {$method} for schema property has not been defined at class {$class}",
                400,
                $this->meta
            );
        }

        return [
            'class'  => $class,
            'method' => $method,
        ];
    }
}
