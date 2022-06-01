<?php

namespace Updivision\Datatable\Livewire;

use Livewire\Component;
use Updivision\Datatable\Core\Abstracts\DataTable;
use Updivision\Datatable\Livewire\Traits\SyncWithDatatable;

/**
 * Class Filters
 *
 * @package Updivision\Datatable\Livewire
 */
class FiltersRemove extends Component
{
    use SyncWithDatatable;

    /** @var string */
    public string $datatableId;

    /** @var \Updivision\Datatable\Core\Abstracts\DataTable */
    protected DataTable $datatable;

    /**
     * @param \Updivision\Datatable\Core\Abstracts\DataTable $datatableClass
     * @return void
     */
    public function mount(DataTable $datatableClass)
    {
        $this->datatableId = $datatableClass->id;
        $this->datatable = $datatableClass;
        $this->syncWithDataTable('cacheDataTable');
    }

    /**
     * @return void
     */
    public function booted()
    {
        $this->syncWithDataTable('getCachedDataTable');
    }

    /**
     * @return void
     */
    public function removeFilters()
    {
        $this->emitTo('datatable::filters', 'resetFilters', $this->datatableId);
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function render()
    {
        return view('datatable::filters-remove', [
            'datatable' => $this->datatable
        ]);
    }
}
