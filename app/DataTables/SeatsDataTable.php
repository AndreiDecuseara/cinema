<?php

namespace App\DataTables;

use App\Models\Hall;
use App\Models\Seat;
use App\Models\PublicationCategory;
use Illuminate\Database\Eloquent\Builder;
use Updivision\Datatable\Core\Abstracts\DataTable;
use Updivision\Datatable\Core\Facades\Action;
use Updivision\Datatable\Core\Facades\Column;
use Updivision\Datatable\Core\Facades\Filter;

/**
 * Class SeatsDataTable
 *
 * @package App\DataTables\Seats
 */
class SeatsDataTable extends DataTable
{
    /** @var string */
    public string $model = Seat::class;


    /** @var string */
    public string $name = 'seats_datatable';

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
            Column::text('seat_nr', 'seat_nr'),
            Column::text('row_nr', 'row_nr'),
            Column::text('hall', 'hall_id', 'hall')
            ->setFilterable(true)
            ->setRenderCallback(function ($entity){
                return $entity->hall->name;
            }),
        ]);

        // // Set your filters
        $this->setFilters([
            Filter::multiple('hall_id', 'hall_id', 'Hall')
            ->setOptions(Hall::query()->pluck('name', 'id')->toArray())
            ->setOptionsNullValue('View all'),
        ]);

        // // Set your actions
        $this->setActions([
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
