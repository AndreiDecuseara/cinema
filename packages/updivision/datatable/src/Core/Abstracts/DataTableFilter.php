<?php

namespace Updivision\Datatable\Core\Abstracts;

use Closure;
use Illuminate\Support\Str;
use Updivision\Datatable\Core\Traits\Serializable;

/**
 * Class DataTableFilter
 *
 * @package Updivision\DataTable\Core\Abstracts
 */
abstract class DataTableFilter
{
    use Serializable;

    /** @var string */
    private static string $serializationSecretKey = 'datatables_filters_' . self::class;

    /** @var string */
    public string $type;
    /** @var string */
    public string $name;
    /** @var string */
    public string $attribute;
    /** @var string|mixed|null */
    public ?string $label = null;
    /** @var string|null */
    public ?string $placeholder = null;
    /** @var mixed|null */
    public mixed $value = null;
    /** @var \Closure */
    protected Closure $queryCallback;

    /**
     * @param string $name
     * @param string $attribute
     * @param $label
     */
    public function __construct(string $name, string $attribute, $label = null)
    {
        $this->name = $name;
        $this->attribute = $attribute;
        $this->label = $label ?? $this->makeLabel($name ?? $attribute);
    }

    /**
     * @param $name
     * @return string
     */
    protected function makeLabel($name): string
    {
        return ucwords(Str::replace(['-', '_', '.'], ' ', $name));
    }

    /**
     * @param $placeholder
     * @return $this
     */
    public function setPlaceholder($placeholder)
    {
        $this->placeholder = $placeholder;

        return $this;
    }

    /**
     * @param $value
     * @return $this
     */
    public function setValue($value)
    {
        $this->value = $this->validateValue($value);

        return $this;
    }

    /**
     * @param $value
     * @return float|int|mixed[]|string|null
     */
    protected function validateValue($value)
    {
        if (is_string($value) && !empty($value = trim($value))) {
            return $value;
        } elseif (is_numeric($value)) {
            return $value;
        } elseif (is_array($value)) {
            return collect($value)->map(function ($value) {
                if (is_string($value) && !empty($value = trim($value))) {
                    return $value;
                } elseif (is_numeric($value)) {
                    return $value;
                }
                return null;
            })->toArray();
        }

        return null;
    }

    /**
     * @param $query
     * @return mixed
     */
    public function query($query)
    {
        if ($q = $this->resolveQueryCallback($query, $this->value())) {
            return $q;
        } elseif (method_exists($this::class, 'setQuery')) {
            return $this->setQuery($query, $this->value());
        }

        return $query;
    }

    /**
     * @param $query
     * @param $value
     * @return mixed
     */
    public function resolveQueryCallback($query, $value): mixed
    {
        if (isset($this->queryCallback)) {
            return $this->queryCallback->call($this, $query, $value, $this);
        }

        return null;
    }

    /**
     * @return mixed|null
     */
    public function value()
    {
        return $this->value;
    }

    /**
     * @param \Closure $queryCallback
     * @return $this
     */
    public function setQueryCallback(Closure $queryCallback): self
    {
        $this->queryCallback = $queryCallback;

        return $this;
    }

    /**
     * @return string
     */
    public function render()
    {
        return view($this->view(), ['filter' => $this])->render();
    }
}