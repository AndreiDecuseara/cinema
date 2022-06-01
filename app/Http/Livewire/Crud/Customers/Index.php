<?php

namespace App\Http\Livewire\Crud\Customers;

use App\DataTables\CustomersDataTable;
use Livewire\Component;


class Index extends Component
{
    public function render()
    {
        return view('livewire.crud.customers.index', [
            'datatable' => new CustomersDataTable(),
            'title' => 'Customers',
        ]);
    }
}
