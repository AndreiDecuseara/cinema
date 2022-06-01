<?php

namespace Updivision\Datatable\Core\Columns;

use Updivision\Datatable\Core\Abstracts\DataTableColumn;

/**
 * Class MultipleColumn
 *
 * @package Updivision\DataTable\Core\Columns
 */
class MultipleColumn extends DataTableColumn
{
    /** @var string */
    public string $type = 'multiple';

    /** @var string */
    public string $separator = ', ';

    /**
     * Resolve Data
     *
     * @param $data
     * @param $entity
     * @return string
     */
    public function resolveData($data, $entity): string
    {
        return implode($this->separator, $data);
    }

    /**
     * @param string $separator
     * @return $this
     */
    public function setSeparator(string $separator): self
    {
        $this->separator = $separator;

        return $this;
    }
}