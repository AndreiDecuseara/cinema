<?php

namespace App\Http\Livewire\Crud\Cinemas;

use App\DataTables\CinemasDataTable;
use Livewire\Component;


class Index extends Component
{
    public function render()
    {
        return view('livewire.crud.cinemas.index', [
            'datatable' => new CinemasDataTable(),
            'title' => 'Cinemas',
        ]);
    }
}
