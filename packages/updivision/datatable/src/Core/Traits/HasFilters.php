<?php

namespace Updivision\Datatable\Core\Traits;

use Updivision\Datatable\Core\Collections\FiltersCollection;

/**
 * Trait HasFilters
 *
 * @package Updivision\DataTable\Core\Traits
 */
trait HasFilters
{
    /** @var bool */
    public bool $enableFilters = false;

    /** @var bool */
    public bool $enableResetFilters = true;

    /** @var \Updivision\Datatable\Core\Collections\FiltersCollection */
    public FiltersCollection $filters;

    /**
     * @return \Updivision\Datatable\Core\Collections\FiltersCollection
     */
    public function filters(): FiltersCollection
    {
        return $this->filters;
    }

    /**
     * @param array $filters
     * @return $this
     */
    public function setFilters(array $filters): self
    {
        $this->filters = FiltersCollection::make($filters);

        return $this;
    }

    /**
     * @return bool
     */
    public function isFilterable(): bool
    {
        return $this->enableFilters && $this->columns()->where('filterable', true)->count() && $this->filters->isNotEmpty();
    }

    /**
     * @return bool
     */
    public function showResetFiltersButton(): bool
    {
        return $this->enableResetFilters && $this->isFilterable();
    }
}