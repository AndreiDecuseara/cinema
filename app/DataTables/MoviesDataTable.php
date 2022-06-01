<?php

namespace App\DataTables;

use App\Models\Cinema;
use App\Models\Movie;
use App\Models\PublicationCategory;
use Illuminate\Database\Eloquent\Builder;
use Updivision\Datatable\Core\Abstracts\DataTable;
use Updivision\Datatable\Core\Facades\Action;
use Updivision\Datatable\Core\Facades\Column;
use Updivision\Datatable\Core\Facades\Filter;

/**
 * Class MoviesDataTable
 *
 * @package App\DataTables\Movies
 */
class MoviesDataTable extends DataTable
{
    /** @var string */
    public string $model = Movie::class;


    /** @var string */
    public string $name = 'movies_datatable';

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
            Column::text('title', 'title'),
            Column::text('rating_audience', 'rating_audience'),
            Column::text('rating_score', 'rating_score'),
            Column::text('release_year', 'release_year'),
            Column::text('duration', 'duration'),
            Column::text('cinema', 'cinema_id', 'cinema')
            ->setFilterable(true)
            ->setRenderCallback(function ($entity){
                return $entity->cinema->name;
            }),
            // Column::text('publication_category_id', 'publication_category_id', 'Category')->setRenderCallback(function ($entity) {
            //     return $entity->publication_category->name;
            // }),
            // Column::boolean('status', 'status')->setTrueString('Active')->setFalseString('Inactive'),
        ]);

        // // Set your filters
        $this->setFilters([
            Filter::text('release_year', 'release_year'),
            Filter::multiple('cinema_id', 'cinema_id', 'Cinema')
            ->setOptions(Cinema::query()->pluck('name', 'id')->toArray())
            ->setOptionsNullValue('View all'),
            Filter::multiple('rating_score', 'rating_score', 'Rating Score')
            ->setOptions([
                '1' => '1',
                '2' => '2',
                '3' => '3',
                '4' => '4',
                '5' => '5',
                '6' => '6',
                '7' => '7',
                '8' => '8',
                '9' => '9',
                '10' => '10',
            ])
            ->setOptionsNullValue('View all'),
        ]);

        // // Set your actions
        $this->setActions([
            // Action::edit('Movies.edit', ['publication' => 'id']),
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
