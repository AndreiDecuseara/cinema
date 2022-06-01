<?php

namespace App\Http\Livewire\Crud\Seats;

use App\DataTables\SeatsDataTable;
use Livewire\Component;


class Index extends Component
{
    public function render()
    {
        return view('livewire.crud.seats.index', [
            'datatable' => new SeatsDataTable(),
            'title' => 'Seat',
        ]);
    }
}
