<?php

namespace App\Http\Livewire\Crud\Movies;

use App\DataTables\MoviesDataTable;
use Livewire\Component;


class Index extends Component
{
    public function render()
    {
        return view('livewire.crud.movies.index', [
            'datatable' => new MoviesDataTable(),
            'title' => 'Movies',
        ]);
    }
}
