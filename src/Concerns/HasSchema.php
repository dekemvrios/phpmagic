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

    /**
     * @var SchemaContract
     */
    public static $schema;

    /**
     * start
     *
     * @param string $path
     *
     * @throws TExceptionAbstract
     */
    public function start($path)
    {
        if (is_file($path)) {
            $this->setSchemaFromPath($path);

            return;
        }

        $this->setSchemaFromString($path);
    }

    /**
     * @param string $path
     *
     * @throws TExceptionAbstract
     */
    private function setSchemaFromPath($path)
    {
        if (!file_exists($path)) {
            throw new MagicException(
                    __CLASS__,
                    __METHOD__,
                    "not found json file in path [ {$path} ]while building schema for class [ " . __CLASS__ . " ]",
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
     * @param string $json
     */
    private function setSchemaFromString($json)
    {
        if (!isset(self::$schema)) {
            self::$schema = Schema::make($json);
        }
    }

    /**
     * toArray
     *
     * @param boolean $asAlias
     * @param boolean $returnHidden
     *
     * @throws TExceptionAbstract
     *
     * @return array
     */
    public function toArray(
        $asAlias = false,
        $returnHidden = true
    ) {

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

            if (
                empty($returnHidden) &&
                !empty($item->getBehavior()->isHidden())
            ) {
                continue;
            }

            if (!is_null($value)) {
                if (is_array($value)) {
                    $dados[$item->{$method}()] = [];

                    foreach ($value as $valueItem) {

                        $valueItem = is_object($valueItem) ? $valueItem->toArray(
                            $asAlias,
                            $returnHidden
                        ) : $valueItem;
                        $dados[$item->{$method}()][] = $valueItem;
                    }
                } else {
                    switch ($item->getType()) {
                        case 'json':
                            $decoded = json_decode($value, true);

                            $dados[$item->{$method}()] = !empty($decoded) ? $decoded : $value;
                            break;
                        default:
                            $value = is_object($value) ? $value->toArray($asAlias, $returnHidden) : $value;

                            $dados[$item->{$method}()] = $value;
                            break;
                    }
                }
            }
        }

        return $dados;
    }
}