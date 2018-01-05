<?php

namespace Solis\Expressive\Magic\Concerns;

use Solis\Expressive\Magic\Exception;
use Solis\Expressive\Schema\Contracts\SchemaContract;
use Solis\Breaker\Abstractions\TExceptionAbstract;
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
            throw new Exception("Arquivo json não encontrado em diretório [{ $path }] fornecido", 400);
        }

        if (!isset(self::$schema)) {
            self::$schema = Schema::make(file_get_contents($path));
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
     * @return SchemaContract
     */
    public function getSchema()
    {
        return self::$schema;
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
    public function toArray($asAlias = false, $returnHidden = true) {

        $method = $asAlias ? "getAlias" : "getProperty";

        $dados = [];

        foreach (self::$schema->getProperties() as $item) {
            $value = $this->{$item->getProperty()};

            if (!$returnHidden && $item->getBehavior()->isHidden()) {
                continue;
            }

            if (is_null($value)) {
                continue;
            }

            if(is_array($value)){
                $dados[$item->{$method}()] = [];

                foreach ($value as $valueItem) {
                    $valueItem = is_object($valueItem) ? $valueItem->toArray($asAlias, $returnHidden) : $valueItem;

                    $dados[$item->{$method}()][] = $valueItem;
                }

                continue;
            }

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

        return $dados;
    }
}
