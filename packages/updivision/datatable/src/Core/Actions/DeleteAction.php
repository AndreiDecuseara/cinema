<?php

namespace Updivision\Datatable\Core\Actions;

use Updivision\Datatable\Core\Abstracts\DataTableAction;

/**
 * Class DeleteAction
 *
 * @package Updivision\DataTable\Core\Actions
 */
class DeleteAction extends DataTableAction
{
    /** @var string */
    public string $name = 'delete';

    /** @var string */
    public string $text = 'Delete';

    /** @var string */
    public string $primaryKey = 'id';

    /**
     * @param string|null $name
     */
    public function __construct(string $name = null)
    {
        parent::__construct($name ?? $this->name);
    }

    /**
     * @param $entity
     * @return string
     */
    public function resolveData($entity)
    {
        return view('datatable::actions.delete', [
            'action' => $this,
            'entity' => $entity,
            'primaryKey' => $this->primaryKey
        ])->render();
    }

    /**
     * @param $primaryKey
     * @return $this
     */
    public function setPrimaryKey($primaryKey): self
    {
        $this->primaryKey = $primaryKey;

        return $this;
    }
}