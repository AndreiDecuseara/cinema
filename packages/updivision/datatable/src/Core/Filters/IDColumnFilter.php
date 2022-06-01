<?php

namespace Updivision\Datatable\Core\Filters;

use Updivision\Datatable\Core\Abstracts\DataTableFilter;

/**
 * Class TextColumn
 *
 * @package Updivision\DataTable\Core\Filters
 */
class IDColumnFilter extends DataTableFilter
{
    /** @var string */
    public string $type = 'id';

    /** @var string */
    public string $name = 'id';

    /** @var string */
    public string $attribute = 'id';

    /** @var string|null */
    public ?string $label = 'ID';

    /**
     * @param string|null $name
     * @param string|null $attribute
     * @param string|null $label
     */
    public function __construct(string $name = null, string $attribute = null, string $label = null)
    {
        parent::__construct($name ?? $this->name, $attribute ?? $this->attribute, $label ?? $this->label);
    }

    /**
     * @param $query
     * @param $value
     * @return mixed
     */
    public function setQuery($query, $value)
    {
        return $query->where($this->attribute, $value);
    }

    /**
     * @return string
     */
    public function view()
    {
        return 'datatable::filters.id-column-filter';
    }
}