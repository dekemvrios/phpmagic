<?php

namespace Solis\Expressive\Magic\Concerns;

use Solis\Expressive\Schema\Contracts\SchemaContract;
use Solis\Breaker\Abstractions\TExceptionAbstract;
use Solis\Expressive\Magic\MagicException;
use Solis\Expressive\Schema\Schema;

/**
 * Trait HasSchema
 *
 * @package Solis\Expressive\Magic\Concerns
 */
trait HasSchema
{

    use HasMagic;

    /**
     * @var SchemaContract
     */
    public static $schema;

    /**
     * boot
     *
     * @param string $path
     *
     * @throws TExceptionAbstract
     */
    public function boot($path)
    {
        if (!file_exists($path)) {
            throw new MagicException(
                __CLASS__,
                __METHOD__,
                'not found schema for class ' . __CLASS__,
                400
            );
        }

        if (!isset(self::$schema)) {
            self::$schema = Schema::make(
                file_get_contents($path)
            );
        }
    }

    /**
     * toArray
     *
     * @param boolean $asAlias
     *
     * @throws TExceptionAbstract
     *
     * @return array
     */
    public function toArray($asAlias = false)
    {

        if (!isset(self::$schema)) {
            throw new MagicException(
                __CLASS__,
                __METHOD__,
                "schema property has not been defined at " . get_class($this),
                500
            );
        }

        $method = !empty($asAlias) ? "getAlias" : "getProperty";

        $dados = [];
        foreach (self::$schema->getProperties() as $item) {
            $value = $this->{$item->getProperty()};

            if (!is_null($value)) {
                if (is_array($value)) {
                    $dados[$item->{$method}()] = [];
                    foreach ($value as $valueItem) {

                        $valueItem = is_object($valueItem) ? $valueItem->toArray(
                            $asAlias
                        ) : $valueItem;

                        $dados[$item->{$method}()][] = $valueItem;
                    }
                } else {
                    $value = is_object($value) ? $value->toArray($asAlias) : $value;

                    $dados[$item->{$method}()] = $value;
                }
            }
        }

        return $dados;
    }
}