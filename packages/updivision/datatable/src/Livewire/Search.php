<?php

namespace Updivision\Datatable\Livewire;

use Livewire\Component;
use Updivision\Datatable\Core\Abstracts\DataTable;
use Updivision\Datatable\Livewire\Traits\SyncWithDatatable;

/**
 * Class Search
 *
 * @package Updivision\Datatable\Livewire
 */
class Search extends Component
{
    use SyncWithDatatable;

    /** @var string */
    public string $datatableId;

    /** @var string */
    public string $search = '';

    /** @var string */
    public string $title = 'Search';

    /** @var string|null */
    public string|null $description = null;

    /** @var string */
    public string $placeholder = 'Enter search term';

    /** @var bool */
    public bool $showResetButton = true;

    /** @var \Updivision\Datatable\Core\Abstracts\DataTable */
    protected DataTable $datatable;

    /**
     * @param \Updivision\Datatable\Core\Abstracts\DataTable $datatableClass
     * @param string $title
     * @param string|null $description
     * @param string $placeholder
     * @param bool $showResetButton
     * @return void
     */
    public function mount(DataTable $datatableClass, string $title = 'Search', string $description = null, string $placeholder = 'Enter search term', bool $showResetButton = true)
    {
        $this->datatableId = $datatableClass->id;
        $this->title = $title;
        $this->description = $description;
        $this->placeholder = $placeholder;
        $this->showResetButton = $showResetButton;

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
    public function updatedSearch()
    {
        $this->emitTo('datatable::datatable', 'setSearch', $this->search, $this->datatableId);
    }

    /**
     * @return void
     */
    public function resetSearch(): void
    {
        $this->reset('search');
        $this->emitTo('datatable::datatable', 'setSearch', $this->search, $this->datatableId);
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function render()
    {
        $this->syncWithDataTable('queryStringSearch');
        return view('datatable::search', [
            'datatable' => $this->datatable
        ]);
    }
}
