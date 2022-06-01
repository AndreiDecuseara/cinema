<?php

namespace Updivision\Datatable;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;
use Updivision\Datatable\Commands\MakeDataTable;
use Updivision\Datatable\Livewire\Datatable;
use Updivision\Datatable\Livewire\Search;
use Updivision\Datatable\Livewire\Filters;
use Updivision\Datatable\Livewire\FiltersRemove;

/**
 * Class DataTableServiceProvider
 *
 * @package Updivision\Datatable
 */
class DataTableServiceProvider extends ServiceProvider
{
    protected $livewire_directive = "datatable";
    /**
     * @return void
     */
    public function boot()
    {
        $this->commands([
            MakeDataTable::class,
        ]);

        $this->loadViewsFrom(__DIR__.'/views', 'datatable');
    }

    /**
     * @return void
     */
    public function register()
    {
        Livewire::component($this->livewire_directive . '::datatable', Datatable::class);
        Livewire::component($this->livewire_directive . '::search', Search::class);
        Livewire::component($this->livewire_directive . '::filters', Filters::class);
        Livewire::component($this->livewire_directive . '::filters.remove', FiltersRemove::class);

        Blade::componentNamespace('Updivision\\Datatable\\View\\Components', $this->livewire_directive);
    }
}