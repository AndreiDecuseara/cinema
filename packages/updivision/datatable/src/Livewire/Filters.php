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
class Filters extends Component
{
    use SyncWithDatatable;

    /** @var string */
    public string $datatableId;

    /** @var array */
    public array $filters = [];

    /** @var \Updivision\Datatable\Core\Abstracts\DataTable */
    protected DataTable $datatable;

    protected $listeners = ['resetFilters'];

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

    public function booted()
    {
        $this->syncWithDataTable('getCachedDataTable');
        $this->syncWithDataTable('queryStringFilters');
    }

    /**
     * @return void
     */
    public function updatedFilters()
    {
        $this->emitTo('datatable::datatable', 'setFilters', $this->filters, $this->datatableId);
    }

    public function resetFilters(string $datatableId)
    {
        if ($datatableId === $this->datatableId) {
            $this->reset('filters');
            $this->emitTo('datatable::datatable', 'setFilters', $this->filters, $this->datatableId);
        }
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function render()
    {
        return view('datatable::filters', [
            'datatable' => $this->datatable
        ]);
    }
}
