<?php

namespace Updivision\Datatable\Core\Filters;

use Updivision\Datatable\Core\Abstracts\DataTableFilter;

/**
 * Class BooleanColumn
 *
 * @package App\DataTables\Core\Filters
 */
class BooleanColumnFilter extends DataTableFilter
{
    /** @var string */
    public string $type = 'boolean';

    /** @var string */
    public string $true_string = 'Yes';

    /** @var string */
    public string $false_string = 'No';

    /**
     * @param string $true_string
     * @return $this
     */
    public function setTrueString(string $true_string): self
    {
        $this->true_string = $true_string;

        return $this;
    }

    /**
     * @param string $false_string
     * @return $this
     */
    public function setFalseString(string $false_string): self
    {
        $this->false_string = $false_string;

        return $this;
    }

    /**
     * @return string
     */
    public function view()
    {
        return 'datatable::filters.boolean-column-filter';
    }
}