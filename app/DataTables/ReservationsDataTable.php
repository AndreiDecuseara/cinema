<?php

namespace App\DataTables;

use App\Models\Customer;
use App\Models\Reservation;
use App\Models\PublicationCategory;
use App\Models\Ticket;
use Illuminate\Database\Eloquent\Builder;
use Updivision\Datatable\Core\Abstracts\DataTable;
use Updivision\Datatable\Core\Facades\Action;
use Updivision\Datatable\Core\Facades\Column;
use Updivision\Datatable\Core\Facades\Filter;

/**
 * Class ReservationDataTable
 *
 * @package App\DataTables\Reservation
 */
class ReservationsDataTable extends DataTable
{
    /** @var string */
    public string $model = Reservation::class;


    /** @var string */
    public string $name = 'reservation_datatable';

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
            Column::text('customer', 'customer_id', 'customer')
            ->setFilterable(true)
            ->setRenderCallback(function ($entity){
                return $entity->customer->first_name . ' ' . $entity->customer->last_name;
            }),
            Column::text('ticket', 'ticket_id', 'ticket')
            ->setFilterable(true)
            ->setRenderCallback(function ($entity){
                return 'Ticket id: <b>' .$entity->ticket->ticket_number . '</b>; seat id: <b>'. $entity->ticket->seat_id . '</b>';
            }),
        ]);

        // // Set your filters
        $this->setFilters([
            Filter::multiple('customer_id', 'customer_id', 'Customer')
            ->setOptions(Customer::query()->pluck('first_name', 'id')->toArray())
            ->setOptionsNullValue('View all'),
            Filter::multiple('ticket_id', 'ticket_id', 'Ticket')
            ->setOptions(Ticket::query()->pluck('ticket_number', 'id')->toArray())
            ->setOptionsNullValue('View all'),
        ]);

        // // Set your actions
        $this->setActions([
            Action::edit('reservations.edit', ['reservation' => 'id']),
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
