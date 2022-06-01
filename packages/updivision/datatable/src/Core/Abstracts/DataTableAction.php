<?php

namespace Updivision\Datatable\Core\Abstracts;

use Closure;
use Exception;
use Illuminate\Support\Str;
use InvalidArgumentException;
use Updivision\Datatable\Core\Traits\Serializable;

/**
 * Class DataTableAction
 *
 * @package Updivision\DataTable\Core\Abstracts
 */
abstract class DataTableAction
{
    use Serializable;

    /** @var string */
    private static string $serializationSecretKey = 'datatables_actions_' . self::class;

    /** @var string */
    public string $name;

    /** @var \Closure */
    public Closure $renderCallback;

    /** @var string */
    public string $text;

    /** @var array */
    public array $attributes = [];

    /**
     * @param string $name
     */
    public function __construct(string $name)
    {
        $this->name = $name;
        $this->text = $this->makeText($name);
    }

    /**
     * @param $name
     * @return string
     */
    protected function makeText($name): string
    {
        return ucwords(Str::replace(['-', '_', '.'], ' ', $name));
    }

    /**
     * @param \Closure $renderCallback
     * @return $this
     */
    public function setRenderCallback(Closure $renderCallback): self
    {
        $this->renderCallback = $renderCallback;

        return $this;
    }

    /**
     * @param array $attributes
     * @return $this
     */
    public function setAttributes(array $attributes)
    {
        $this->attributes = $attributes;

        return $this;
    }

    /**
     * @return string
     */
    public function renderAttributes(): string
    {
        return collect($this->attributes)->map(function ($value, $attribute) {
            return "$attribute=\"$value\"";
        })->implode(' ');
    }

    /**
     * @param string $text
     * @return $this
     */
    public function setText(string $text)
    {
        $this->text = $text;

        return $this;
    }

    /**
     * @param $entity
     * @return null
     */
    public function render($entity)
    {
        if (isset($this->renderCallback) && $this->isRenderCallbackReturnTypeSupported($data = $this->resolveRenderCallback($entity))) {
            return (string)$data;
        } else {
            if (is_object($entity) || is_array($entity)) {
                $data = is_array($entity) ? (object)$entity : $entity;


                return $this->resolveData($data);
            }
        }

        return null;
    }

    /**
     * @param $data
     * @return bool|mixed
     */
    private function isRenderCallbackReturnTypeSupported($data)
    {
        $given_type = gettype($data);

        try {
            settype($data, 'string');

            return true;
        } catch (Exception $exception) {
            return static::unsupportedRenderCallbackReturnType($given_type, $this->name);
        }
    }

    /**
     * @static
     * @param string $given_type
     * @param string $action
     * @return mixed
     */
    private static function unsupportedRenderCallbackReturnType(string $given_type, string $action): mixed
    {
        return throw new InvalidArgumentException(
            "Given type '$given_type' cannot be converted to 'string'." .
            "Make sure your \$renderCallback for action '$action' is returning 'string' or other supported types to perform the conversion."
        );
    }

    /**
     * @param $entity
     * @return mixed
     */
    public function resolveRenderCallback($entity): mixed
    {
        if (isset($this->renderCallback)) {
            return $this->renderCallback->call($this, $entity, $this);
        }

        return null;
    }
}