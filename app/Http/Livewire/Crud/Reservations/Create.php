<?php

namespace App\Http\Livewire\Crud\Reservations;

use App\Models\Customer;
use App\Models\Reservation;
use App\Models\Publication;
use App\Models\Ticket;
use Carbon\Carbon;
use Livewire\Component;

class Create extends Component
{

    public $customer_id;
    public $ticket_id;

    public function rules()
    {
        return [
            'customer_id' => 'required',
            'ticket_id' => 'required',
        ];
    }

    public function createReservation()
    {
        $this->validate();

        $reservation = Reservation::create([
            'customer_id' => $this->customer_id,
            'ticket_id' => $this->ticket_id,
        ]);

        return redirect()->route('reservations');
    }

    public function getCustomersProperty()
    {
        return Customer::query()->pluck('last_name', 'id')->toArray();
    }
    public function getTicketsProperty()
    {
        return Ticket::query()->pluck('ticket_number', 'id')->toArray();
    }

    public function back()
    {
        $this->redirect(route('reservations'));
    }

    public function render()
    {
        return view('livewire.crud.reservations.create', ['title' => 'Add Reservation']);
    }
}
