<?php

namespace Updivision\Datatable\Core\Traits;

use Updivision\Datatable\Core\Abstracts\DataTableColumn;
use Updivision\Datatable\Core\Collections\ColumnsCollection;

/**
 * Trait HasColumns
 *
 * @package Updivision\DataTable\Core\Traits
 */
trait HasColumns
{
    /** @var bool */
    public bool $enableSorting = true;

    /** @var \Updivision\Datatable\Core\Collections\ColumnsCollection */
    public ColumnsCollection $columns;

    /**
     * @return $this
     */
    public function setColumns(array $columns): self
    {
        $this->columns = ColumnsCollection::make($columns);

        return $this;
    }

    /**
     * @param \Updivision\Datatable\Core\Abstracts\DataTableColumn $column
     * @param string $direction
     * @return bool
     */
    public function isCurrentSortingColumn(DataTableColumn $column, string $direction): bool
    {
        return $this->sortBy === $column->name && $this->sortDir === $direction;
    }

    /**
     * @return bool
     */
    public function isSortable()
    {
        return $this->enableSorting;
    }

    /**
     * @param string $name
     * @param string $dir
     * @return bool
     */
    public function sortBy(string $name, string $dir = 'asc'): bool
    {
        if ($this->columns()->get($name) && $this->columns()->get($name)->sortable) {
            $this->sortBy = $name;
            $this->sortDir = $dir;

            return true;
        }

        return false;
    }

    /**
     * Get Columns
     *
     * @return \Updivision\Datatable\Core\Collections\ColumnsCollection
     */
    public function columns(): ColumnsCollection
    {
        return $this->columns;
    }
}