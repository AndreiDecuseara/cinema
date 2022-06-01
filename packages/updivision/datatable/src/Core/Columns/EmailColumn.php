<?php

namespace Updivision\Datatable\Core\Columns;

use Updivision\Datatable\Core\Abstracts\DataTableColumn;

/**
 * Class EmailColumn
 *
 * @package Updivision\DataTable\Core\Columns
 */
class EmailColumn extends DataTableColumn
{
    /** @var string */
    public string $type = 'email';

    /**
     * Resolve Data
     *
     * @param $data
     * @param $entity
     * @return string
     */
    public function resolveData($data, $entity): string
    {
        return "<a href='mailto:$data' class='link-info'>$data</a>";
    }
}