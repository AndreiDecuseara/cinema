<?php

namespace App\Http\Livewire\Crud\Halls;

use App\DataTables\HallsDataTable;
use Livewire\Component;


class Index extends Component
{
    public function render()
    {
        return view('livewire.crud.halls.index', [
            'datatable' => new HallsDataTable(),
            'title' => 'Halls',
        ]);
    }
}
