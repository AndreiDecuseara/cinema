<?php

namespace Updivision\Datatable\Core\Filters;

use Updivision\Datatable\Core\Abstracts\DataTableFilter;

/**
 * Class EmailColumn
 *
 * @package Updivision\DataTable\Core\Filters
 */
class EmailColumnFilter extends DataTableFilter
{
    /** @var string */
    public string $type = 'email';

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
        return 'datatable::filters.email-column-filter';
    }
}