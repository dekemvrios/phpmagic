<?php

namespace Solis\PhpMagic\Concerns;

use Solis\Expressive\Schema\Contracts\SchemaContract;
use Solis\Expressive\Schema\Schema;
use Solis\Breaker\TException;

/**
 * Trait HasSchema
 *
 * @package Solis\PhpMagic\Concerns
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
     * @throws TException
     */
    public function boot($path)
    {
        if (!file_exists($path)) {
            throw new TException(
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
     * @throws TException
     *
     * @return array
     */
    public function toArray($asAlias = false)
    {

        if (!isset(self::$schema)) {
            throw new TException(
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