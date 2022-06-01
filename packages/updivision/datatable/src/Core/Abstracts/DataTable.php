<?php

namespace Updivision\Datatable\Core\Abstracts;

use Closure;
use Updivision\Datatable\Core\Columns\TextColumn;
use Updivision\Datatable\Core\Traits\HasActions;
use Updivision\Datatable\Core\Traits\HasColumns;
use Updivision\Datatable\Core\Traits\HasFilters;
use Updivision\Datatable\Core\Traits\HasPagination;
use Updivision\Datatable\Core\Traits\HasSearch;
use Updivision\Datatable\Core\Traits\Serializable;

/**
 * Class DataTable
 *
 * @package Updivision\DataTable\Core
 */
abstract class DataTable
{
    use Serializable;

    use HasColumns, HasActions, HasFilters, HasPagination, HasSearch;

    /** @var string */
    private static string $serializationSecretKey = 'datatables_' . self::class;

    /** @var string */
    public string $name = 'table';

    /** @var string */
    public string $id;

    /** @var \Closure */
    public Closure $customQuery;

    /** @var string */
    public string $model;

    /**
     * DataTable Constructor
     */
    public function __construct(string $id = null)
    {
        $this->id = $id ?? uniqid();
        $this->init();

        if ($this->hasActions() && !$this->columns()->get('actions')) {
            $this->columns()->add(
                (new TextColumn('actions'))
                    ->setLabel('')
                    ->setSortable(false)
                    ->setFilterable(false)
            );
        }
    }

    /**
     * @param string $id
     * @return string
     */
    public function setId(string $id): string
    {
        $this->id = $id ?? uniqid();

        return $this->id;
    }

    /**
     * @return array
     */
    public function viewData(): array
    {
        return [
            'datatable' => $this,
            'records' => $this->getRecordsFromQuery()
        ];
    }

    /**
     * @return array|\Illuminate\Contracts\Pagination\LengthAwarePaginator|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    protected function getRecordsFromQuery()
    {
        $query = $this
            ->newQuery()
            ->where(function ($query) {
                $query->when($this->isFilterable() && $this->filters()->hasValues(), function ($query) {
                    foreach ($this->filters()->whereNotNullValue() as $filter) {
                        $query = $filter->query($query);
                    }
                });
                return $query;
            })
            ->where(function ($query) {
                $query->when($this->isSearchable() && $this->search, function ($query) {
                    foreach ($this->getQueryableAttributes() as $index => $name) {
                        $query->{$index === 0 ? 'where' : 'orWhere'}($name, 'like', "%$this->search%");
                    }
                });
                return $query;
            })
            ->when($this->columns()->get($this->sortBy), function ($query) {
                $query->orderBy($this->columns()->get($this->sortBy)->attribute, $this->sortDir);
            });

//        dd(vsprintf(str_replace('?', '%s', $query->toSql()), collect($query->getBindings())->map(function ($binding) {
//            return is_numeric($binding) ? $binding : "'{$binding}'";
//        })->toArray()));

        return $this->paginate
            ? $query->paginate($this->pageLength)
            : $query->get();
    }

    /**
     * Get Query
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function newQuery(): mixed
    {
        $query = (new $this->model())->query();

        if (method_exists($this::class, 'query')) {
            $query = $this->query($query);
        }

        if (isset($this->customQuery)) {
            $query = ($this->customQuery)($query);
        }

        return $query;
    }

    /**
     * @return array
     */
    protected function getQueryableAttributes()
    {
        $model = new $this->model();
        return $this->columns()
            ->filter(function ($item) {
                return $item->searchable || $item->filterable;
            })
            ->whereNull('renderCallback')
            ->whereIn(
                'attribute',
                collect([
                    $model->getKeyName(),
                    $model->getCreatedAtColumn(),
                    $model->getUpdatedAtColumn(),
                ])->merge($model->getFillable())->diff($model->getHidden())->unique()->values()
            )
            ->pluck('attribute')
            ->toArray();
    }

    /**
     * @param \Closure $customQuery
     * @return $this
     */
    public function setQuery(Closure $customQuery): self
    {
        $this->customQuery = $customQuery;

        return $this;
    }

    /**
     * @return array
     */
    protected function getCollectionQueryableAttributes()
    {
        return $this->columns()
            ->where('searchable', true)
            ->whereNotIn('attribute', $this->getQueryableAttributes())
            ->pluck('attribute')
            ->toArray();
    }
}
