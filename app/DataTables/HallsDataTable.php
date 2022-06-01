<?php

namespace App\DataTables;

use App\Models\Cinema;
use App\Models\Hall;
use App\Models\PublicationCategory;
use Illuminate\Database\Eloquent\Builder;
use Updivision\Datatable\Core\Abstracts\DataTable;
use Updivision\Datatable\Core\Facades\Action;
use Updivision\Datatable\Core\Facades\Column;
use Updivision\Datatable\Core\Facades\Filter;

/**
 * Class HallsDataTable
 *
 * @package App\DataTables\Halls
 */
class HallsDataTable extends DataTable
{
    /** @var string */
    public string $model = Hall::class;


    /** @var string */
    public string $name = 'halls_datatable';

    /** @var string */
    public string $sortDir = 'desc'; // 'desc' | 'asc'

    /** @var string */
    public string $sortBy = 'id'; // Column Name

    /** @var bool */
    public bool $hasQueryStrings = true; // Display Search, Filters, Sorting and Pagination properties in url

    /** @var bool */
    public bool $paginate = true; // true | false

    /** @var int */
    public int $pageLength = 10; // 10 | 25 | 50 | 100

    /** @var bool */
    public bool $enableSearch = true; // Enable Search

    /** @var bool */
    public bool $enableFilters = true; // Enable Filters,

    /** @var bool */
    public bool $enableResetFilters = true; // Enable Reset Filters Button,

    /**
     * @return void
     * @throws \Exception
     */
    public function init()
    {
        // Set your columns
        $this->setColumns([
            Column::ID(),
            Column::text('name', 'name'),
            Column::text('cinema', 'cinema_id', 'cinema')
            ->setFilterable(true)
            ->setRenderCallback(function ($entity){
                return $entity->cinema->name;
            }),
        ]);

        // // Set your filters
        $this->setFilters([
            Filter::multiple('cinema_id', 'cinema_id', 'Cinema')
            ->setOptions(Cinema::query()->pluck('name', 'id')->toArray())
            ->setOptionsNullValue('View all'),
        ]);

        // // Set your actions
        $this->setActions([
            Action::delete(),
        ]);
    }

    /**
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Builder $query): Builder
    {
        return $query;
    }
}
