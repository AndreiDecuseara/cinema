<?php

namespace Updivision\Datatable\Core\Columns;

use Updivision\Datatable\Core\Abstracts\DataTableColumn;

/**
 * Class TextColumn
 *
 * @package Updivision\DataTable\Core\Columns
 */
class IDColumn extends DataTableColumn
{
    /** @var string */
    public string $type = 'id';

    /** @var string */
    public string $name = 'id';

    /** @var string */
    public string $attribute = 'id';

    /** @var string */
    public string $label = 'ID';

    /** @var bool */
    public bool $filterable = true;

    /**
     * @param string|null $name
     * @param string|null $attribute
     * @param string|null $label
     */
    public function __construct(string $name = null, string $attribute = null, string $label = null)
    {
        parent::__construct($name ?? $this->name, $attribute ?? $this->attribute, $label ?? $this->label);
    }

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