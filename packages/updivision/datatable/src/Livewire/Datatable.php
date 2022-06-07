<?php

namespace Updivision\Datatable\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Updivision\Datatable\Livewire\Traits\SyncWithDatatable;

/**
 * Class Datatable
 *
 * @package Updivision\Datatable\Livewire
 */
class Datatable extends Component
{
    use WithPagination, SyncWithDatatable;

    /** @var int|null */
    public ?int $pageLength = null;

    /** @var string */
    public string $search = '';

    /** @var array */
    public array $filters = [];

    /** @var */
    public string $sortBy = '';

    /** @var */
    public string $sortDir = '';

    /** @var string */
    public string $datatableId = '';

    /** @var \Updivision\Datatable\Core\Abstracts\DataTable */
    protected \Updivision\Datatable\Core\Abstracts\DataTable $datatable;

    /**
     * @return string
     */
    public function paginationView()
    {
        return 'datatable::pagination';
    }

    /**
     * @return string[]
     */
    public function getListeners(): array
    {
        return [
            'setFilters',
            'removeFilters',
            'setSearch',
            'refresh' => '$refresh'
        ];
    }

    /**
     * @param $datatableClass
     * @return void
     */
    public function mount($datatableClass)
    {
        $this->datatableId = $datatableClass->id;
        $this->datatable = $datatableClass;
        $this->syncWithDataTable('cacheDataTable');
    }

    public function booted()
    {
        $this->syncWithDataTable('getCachedDataTable');
        $this->syncWithDataTable('queryString');
        $this->syncWithDataTable();
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function render()
    {
        $this->syncWithDataTable();
        $this->syncWithDataTable('cacheDataTable');
        return view('datatable::datatable', $this->datatable->viewData());
    }

    /**
     * @param $search
     * @param string $datatableId
     * @return void
     */
    public function setSearch($search, string $datatableId)
    {
        if ($datatableId === $this->datatableId) {
            $this->search = $search;
            $this->syncWithDataTable('search');
        }
    }

    /**
     * @param string $name
     * @param string $dir
     * @return void
     */
    public function sortBy(string $name, string $dir = 'asc'): void
    {
        $this->sortBy = $name;
        $this->sortDir = $dir;
        $this->syncWithDataTable('sort');
    }

    /**
     * @param $values
     * @param string $datatableId
     * @return void
     */
    public function setFilters($values, string $datatableId)
    {
        if ($datatableId === $this->datatableId) {
            $this->filters = $values;
            $this->syncWithDataTable('filters');
        }
    }

    /**
     * @param string $datatableId
     * @return void
     */
    public function removeFilters(string $datatableId)
    {
        if ($datatableId === $this->datatableId) {
            $this->reset('filters');
            $this->emitTo('datatable::filters', 'refresh', $this->datatableId);
            $this->syncWithDataTable('filters');
        }
    }

    /**
     * @param $pageLength
     * @return void
     */
    public function updatedPageLength($pageLength): void
    {
        $this->pageLength = $pageLength;
        $this->syncWithDataTable('pagination');
    }

    public function deleteAction($id, bool $confirmed = false)
    {
        $deleteAction = $this->datatable->actions()->firstWhere('name', 'delete');

        if ($deleteAction) {
            if ($deleteAction->requireConfirmation && !$confirmed) {
                $this->dispatchBrowserEvent("show-delete-datatable-record-modal-$id");
                return false;
            }

            if ($entity = $this->datatable->model::find($id)) {
                $this->emitUp('beforeDeleteActionPerformed', $entity);

                if ($entity->delete()) {
                    $this->emitUp('afterDeleteActionPerformed', $entity);

                    return true;
                }
            }
        }
    }
}
