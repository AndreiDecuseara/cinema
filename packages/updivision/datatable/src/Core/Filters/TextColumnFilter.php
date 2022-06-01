<?php

namespace Updivision\Datatable\Core\Filters;

use Updivision\Datatable\Core\Abstracts\DataTableFilter;

/**
 * Class TextColumn
 *
 * @package Updivision\DataTable\Core\Filters
 */
class TextColumnFilter extends DataTableFilter
{
    /** @var string */
    public string $type = 'text';

    /**
     * @param $query
     * @param $value
     * @return mixed
     */
    public function setQuery($query, $value)
    {
        return $query->where($this->attribute, 'like', "%$value%");
    }

    /**
     * @return string
     */
    public function view()
    {
        return 'datatable::filters.text-column-filter';
    }
}