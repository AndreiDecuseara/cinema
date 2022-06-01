<?php

namespace Updivision\Datatable\Core\Interfaces;


use Closure;
use Updivision\Datatable\Core\Abstracts\DataTableColumn;

/**
 * Class DataTableColumn
 *
 * @package Updivision\DataTable\Core\Interfaces
 */
interface DataTableColumnInterface
{
    /**
     * @param string $type
     * @return \Updivision\Datatable\Core\Abstracts\DataTableColumn
     */
    public function setType(string $type): DataTableColumn;

    /**
     * @param string $attribute
     * @return \Updivision\Datatable\Core\Abstracts\DataTableColumn
     */
    public function setAttribute(string $attribute): DataTableColumn;

    /**
     * @param string $label
     * @return \Updivision\Datatable\Core\Abstracts\DataTableColumn
     */
    public function setLabel(string $label): DataTableColumn;

    /**
     * @param \Closure $renderCallback
     * @param bool $skipCustomFormatting
     * @return \Updivision\Datatable\Core\Abstracts\DataTableColumn
     */
    public function setRenderCallback(Closure $renderCallback, bool $skipCustomFormatting): DataTableColumn;

    /**
     * @param bool $sortable
     * @return \Updivision\Datatable\Core\Abstracts\DataTableColumn
     */
    public function setSortable(bool $sortable): DataTableColumn;

    /**
     * @param bool $filterable
     * @return \Updivision\Datatable\Core\Abstracts\DataTableColumn
     */
    public function setFilterable(bool $filterable): DataTableColumn;

    /**
     * @param $entity
     * @return null
     */
    public function render($entity);

    /**
     * @param $entity
     * @return mixed
     */
    public function resolveRenderCallback($entity): mixed;

    /**
     * @param $data
     * @param $entity
     */
    public function resolveData($data, $entity);
}