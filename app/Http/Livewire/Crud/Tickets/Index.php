<?php

namespace App\Http\Livewire\Crud\Tickets;

use App\DataTables\TicketsDataTable;
use Livewire\Component;


class Index extends Component
{
    public function render()
    {
        return view('livewire.crud.tickets.index', [
            'datatable' => new TicketsDataTable(),
            'title' => 'Tickets',
        ]);
    }
}
