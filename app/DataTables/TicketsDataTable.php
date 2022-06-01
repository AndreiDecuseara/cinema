<?php

namespace App\DataTables;

use App\Models\Cinema;
use App\Models\Movie;
use App\Models\Ticket;
use Illuminate\Database\Eloquent\Builder;
use Updivision\Datatable\Core\Abstracts\DataTable;
use Updivision\Datatable\Core\Facades\Action;
use Updivision\Datatable\Core\Facades\Column;
use Updivision\Datatable\Core\Facades\Filter;

/**
 * Class TicketsDataTable
 *
 * @package App\DataTables\Tickets
 */
class TicketsDataTable extends DataTable
{
    /** @var string */
    public string $model = Ticket::class;


    /** @var string */
    public string $name = 'tickets_datatable';

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
            Column::text('ticket_number', 'ticket_number'),
            Column::text('ticket_price', 'ticket_price'),
            Column::text('ticket_date_time', 'ticket_date_time'),
            Column::text('seat_id', 'seat_id'),
            Column::text('movie', 'movie_id', 'movie')
            ->setFilterable(true)
            ->setRenderCallback(function ($entity){
                return $entity->movie->title;
            }),
        ]);

        // // Set your filters
        $this->setFilters([
            Filter::text('ticket_price', 'ticket_price'),
            Filter::multiple('movie_id', 'movie_id', 'Movie')
            ->setOptions(Movie::query()->pluck('title', 'id')->toArray())
            ->setOptionsNullValue('View all'),
        ]);

        // // Set your actions
        $this->setActions([
            // Action::edit('Tickets.edit', ['publication' => 'id']),
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
