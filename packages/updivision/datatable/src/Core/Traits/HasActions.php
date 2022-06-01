<?php

namespace Updivision\Datatable\Core\Traits;

use Updivision\Datatable\Core\Collections\ActionsCollection;

/**
 * Trait HasActions
 *
 * @package Updivision\DataTable\Core\Traits
 */
trait HasActions
{
    /** @var bool */
    public bool $enableActions = true;

    /** @var \Updivision\Datatable\Core\Collections\ActionsCollection */
    public ActionsCollection $actions;

    /**
     * @return \Updivision\Datatable\Core\Collections\ActionsCollection
     */
    public function actions()
    {
        return $this->actions;
    }

    /**
     * @param array $actions
     * @return $this
     */
    public function setActions(array $actions): self
    {
        $this->actions = ActionsCollection::make($actions);

        return $this;
    }

    /**
     * @return bool
     */
    public function hasActions(): bool
    {
        return $this->enableActions && $this->actions->isNotEmpty();
    }
}