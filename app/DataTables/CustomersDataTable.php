<?php

namespace App\DataTables;

use App\Models\Customer;
use App\Models\PublicationCategory;
use Illuminate\Database\Eloquent\Builder;
use Updivision\Datatable\Core\Abstracts\DataTable;
use Updivision\Datatable\Core\Facades\Action;
use Updivision\Datatable\Core\Facades\Column;
use Updivision\Datatable\Core\Facades\Filter;

/**
 * Class CustomersDataTable
 *
 * @package App\DataTables\Customers
 */
class CustomersDataTable extends DataTable
{
    /** @var string */
    public string $model = Customer::class;


    /** @var string */
    public string $name = 'customers_datatable';

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
            Column::text('first_name', 'first_name'),
            Column::text('middle_name', 'middle_name'),
            Column::text('last_name', 'last_name'),
            Column::text('cnp', 'cnp'),
            Column::text('email', 'email'),
            Column::text('country_id', 'country_id'),
        ]);

        // // Set your filters
        $this->setFilters([
            Filter::text('cnp', 'cnp'),
            // Filter::multiple('publication_category_id', 'publication_category_id', 'Category')
            //     ->setOptions(PublicationCategory::query()->pluck('name', 'id')->toArray())
            //     ->setOptionsNullValue('View all'),
            // Filter::multiple('status', 'status')
            //     ->setOptions([true => 'Active', false => 'Inactive'])
            //     ->setOptionsNullValue('View all'),
        ]);

        // // Set your actions
        $this->setActions([
            // Action::edit('Customers.edit', ['publication' => 'id']),
            // Action::delete(),
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
