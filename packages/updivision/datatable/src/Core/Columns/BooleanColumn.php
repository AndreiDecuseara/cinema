<?php

namespace Updivision\Datatable\Core\Columns;

use Updivision\Datatable\Core\Abstracts\DataTableColumn;

/**
 * Class BooleanColumn
 *
 * @package Updivision\DataTable\Core\Columns
 */
class BooleanColumn extends DataTableColumn
{
    /** @var string */
    public string $type = 'boolean';

    /** @var string */
    public string $true_string = 'Yes';

    /** @var string */
    public string $false_string = 'No';

    /**
     * Resolve Data
     *
     * @param $data
     * @param $entity
     * @return string
     */
    public function resolveData($data, $entity): string
    {
        return $data ? $this->true_string : $this->false_string;
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
     * @param string $true_string
     * @return $this
     */
    public function setTrueString(string $true_string): self
    {
        $this->true_string = $true_string;

        return $this;
    }
}