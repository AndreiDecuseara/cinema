<?php

namespace App\Http\Livewire\Crud\Reservations;

use App\DataTables\ReservationsDataTable;
use Livewire\Component;


class Index extends Component
{
    public function render()
    {
        return view('livewire.crud.reservations.index', [
            'datatable' => new ReservationsDataTable(),
            'title' => 'Reservation',
        ]);
    }
}
