<?php

namespace Solis\Expressive\Magic\Validator;

use Solis\Expressive\Magic\Abstractions\TypeValidatorAbstract;
use Solis\Expressive\Magic\Contracts\JsonValidatorContract;
use Solis\Breaker\Abstractions\TExceptionAbstract;
use Solis\Expressive\Magic\MagicException;

/**
 * Class JsonValidator
 *
 * @package Solis\PhpValidator\Types
 */
class JsonValidator extends TypeValidatorAbstract implements JsonValidatorContract
{
    /**
     * @var array
     */
    protected $formatting = [];

    /**
     * @param mixed $meta
     *
     * @return static
     */
    public static function make($meta = null)
    {
        $instance = new static();
        if (!empty($meta)) {
            $instance->meta = $meta;
        }

        return $instance;
    }

    /**
     * validate
     *
     * @param string $name
     * @param mixed  $data
     * @param array  $format
     *
     * @return string
     *
     * @throws TExceptionAbstract
     */
    public function validate(
        $name,
        $data,
        $format = null
    ) {
        if (!is_string($data) || !is_array($data)) {
            throw new MagicException(
                __CLASS__,
                __METHOD__,
                "property [ {$name} ] is invalid for type [ json ] specified in schema",
                400,
                $this->meta
            );
        }

        $data = $this->encode(
            $name,
            $data
        );

        if (!empty($format)) {
            $data = self::applyFormat(
                $format,
                $data
            );
        }

        return (string)$data;
    }

    /**
     * @param $name
     * @param $data
     *
     * @return string
     * @throws MagicException
     */
    protected function encode(
        $name,
        $data
    ) {
        if (is_string($data)) {
            return $data;
        }

        $data = json_encode($data);
        if (!empty(json_last_error())) {
            throw new MagicException(
                __CLASS__,
                __METHOD__,
                "Error encoding JSON for property [ {$name} ] - " . $this->lastJsonErrorMessage(json_last_error()),
                400,
                $this->meta
            );
        }

        return $data;
    }

    /**
     * lastJsonErrorMessage
     *
     * @return string
     */
    protected function lastJsonErrorMessage($error)
    {
        $errors = [
            JSON_ERROR_DEPTH => 'Maximum stack depth exceeded',
            JSON_ERROR_STATE_MISMATCH => 'State mismatch (invalid or malformed JSON)',
            JSON_ERROR_CTRL_CHAR => 'Control character error, possibly incorrectly encoded',
            JSON_ERROR_SYNTAX => 'Syntax error',
            JSON_ERROR_UTF8 => 'Malformed UTF-8 characters, possibly incorrectly encoded',
        ];

        return isset($errors[$error]) ? $errors[$error] : 'Unknown error';
    }
}
