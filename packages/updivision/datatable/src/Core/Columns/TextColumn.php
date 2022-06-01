<?php

namespace Updivision\Datatable\Core\Columns;

use Updivision\Datatable\Core\Abstracts\DataTableColumn;

/**
 * Class TextColumn
 *
 * @package Updivision\DataTable\Core\Columns
 */
class TextColumn extends DataTableColumn
{
    /** @var string */
    public string $type = 'text';

    /**
     * Resolve Data
     *
     * @param $data
     * @param $entity
     * @return mixed
     */
    public function resolveData($data, $entity): mixed
    {
        return $data;
    }
}