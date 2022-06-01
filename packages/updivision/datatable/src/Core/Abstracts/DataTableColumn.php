<?php

namespace Updivision\Datatable\Core\Abstracts;

use Closure;
use Exception;
use Illuminate\Support\Str;
use InvalidArgumentException;
use Updivision\Datatable\Core\Interfaces\DataTableColumnInterface;
use Updivision\Datatable\Core\Traits\Serializable;

/**
 * Class DataTableColumn
 *
 * @package Updivision\DataTable\Core\Abstracts
 */
abstract class DataTableColumn implements DataTableColumnInterface
{
    use Serializable;

    /** @var string */
    private static string $serializationSecretKey = 'datatables_columns_' . self::class;

    /** @var string */
    public string $type;

    /** @var string */
    public string $name;

    /** @var string */
    public string $attribute;

    /** @var string */
    public string $label;

    /** @var Closure|null */
    public ?Closure $renderCallback = null;

    /** @var bool */
    public bool $renderCallbackSkipCustomFormatting = false;

    /** @var bool */
    public bool $searchable = true;

    /** @var bool */
    public bool $sortable = true;

    /** @var bool */
    public bool $filterable = false;

    /** @var bool */
    public bool $visibility = true;

    /**
     * @param string $name
     * @param string|null $attribute
     * @param string|null $label
     */
    public function __construct(string $name, string $attribute = null, string $label = null)
    {
        $this->name = $name;
        $this->attribute = $attribute ?? $name;
        $this->label = $this->makeLabel($label ?? $attribute ?? $name);

        return $this;
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
     * @param string $type
     * @return $this
     */
    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @param string $attribute
     * @return $this
     */
    public function setAttribute(string $attribute): self
    {
        $this->attribute = $attribute;

        return $this;
    }

    /**
     * @param string $label
     * @return $this
     */
    public function setLabel(string $label): self
    {
        $this->label = $label;

        return $this;
    }

    /**
     * @param \Closure $renderCallback
     * @param bool $skipCustomFormatting
     * @return $this
     */
    public function setRenderCallback(Closure $renderCallback, bool $skipCustomFormatting = false): self
    {
        $this->renderCallback = $renderCallback;
        $this->renderCallbackSkipCustomFormatting = $skipCustomFormatting;

        return $this;
    }

    /**
     * @param bool $searchable
     * @return $this
     */
    public function setSearchable(bool $searchable): self
    {
        $this->searchable = $searchable;

        return $this;
    }

    /**
     * @param bool $sortable
     * @return $this
     */
    public function setSortable(bool $sortable): self
    {
        $this->sortable = $sortable;

        return $this;
    }

    /**
     * @param bool $filterable
     * @return $this
     */
    public function setFilterable(bool $filterable): self
    {
        $this->filterable = $filterable;

        return $this;
    }

    /**
     * @param bool $visibility
     * @return $this
     */
    public function setVisibility(bool $visibility): self
    {
        $this->visibility = $visibility;

        return $this;
    }

    /**
     * @param $entity
     * @return null
     */
    public function render($entity)
    {
        if (isset($this->renderCallback)) {
            if ($this->renderCallbackSkipCustomFormatting && $this->isRenderCallbackReturnTypeSupported($data = $this->resolveRenderCallback($entity))) {
                return (string)$data;
            }

            return $this->resolveData($this->resolveRenderCallback($entity), $entity);
        } else {
            if (is_object($entity) || is_array($entity)) {
                $data = is_array($entity) ? (object)$entity : $entity;
                return $this->resolveData($data->{$this->attribute}, $data);
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
            return static::unsupportedRenderCallbackReturnType($given_type, $this->attribute);
        }
    }

    /**
     * @static
     * @param string $given_type
     * @param string $columnAttribute
     * @return mixed
     */
    private static function unsupportedRenderCallbackReturnType(string $given_type, string $columnAttribute): mixed
    {
        return throw new InvalidArgumentException(
            "Given type '$given_type' cannot be converted to 'string'." .
            "Make sure your \$renderCallback for column '$columnAttribute' is returning 'string' or other supported types to perform the conversion or set \$renderCallbackSkipCustomFormatting parameter to 'false' when setting the \$renderCallback."
        );
    }

    /**
     * @param $entity
     * @return mixed
     */
    public function resolveRenderCallback($entity): mixed
    {
        if (isset($this->renderCallback)) {
            return $this->renderCallback->call($this, $entity);
        }

        return null;
    }

    /**
     * @param $data
     * @param $entity
     */
    public function resolveData($data, $entity)
    {
        return $data;
    }

    /**
     * @return bool
     */
    private function isVisible($data)
    {
        return $this->visibility;
    }
}