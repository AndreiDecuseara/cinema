<?php

namespace Updivision\Datatable\Core\Interfaces;

use Illuminate\Support\Collection;

/**
 * Class DataTable
 *
 * @package Updivision\DataTable\Core\Interfaces
 */
interface DataTableInterface
{
    /**
     * @return bool
     */
    public function isSearchable(): bool;

    /**
     * @return bool
     */
    public function isFilterable(): bool;

    /**
     * @param string $columnAttribute
     * @param string $dir
     * @return bool
     */
    public function sortBy(string $columnAttribute, string $dir = 'asc'): bool;

    /**
     * @param string $columnAttribute
     * @return mixed|null
     */
    public function getColumn(string $columnAttribute): mixed;

    /**
     * Get Columns
     *
     * @return \Illuminate\Support\Collection
     */
    public function columns(): Collection;

    /**
     * @return int[]
     */
    public function pageLengthMenu(): array;

    /**
     * @return array
     */
    public function viewData(): array;

    /**
     * Get Query
     *
     * @return \Illuminate\Database\Eloquent\Builder|mixed
     */
    public function query(): mixed;
}