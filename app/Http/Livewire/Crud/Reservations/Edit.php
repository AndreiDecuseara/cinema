<?php

namespace App\Http\Livewire\Crud\Reservations;

use App\Models\Customer;
use App\Models\Reservation;
use App\Models\Publication;
use App\Models\Ticket;
use Carbon\Carbon;
use Livewire\Component;

class Edit extends Component
{
    public Reservation $reservation;

    public $customer_id;
    public $ticket_id;

    public function rules()
    {
        return [
            'reservation.customer_id' => 'required',
            'reservation.ticket_id' => 'required',
        ];
    }

    public function getCustomersProperty()
    {
        return Customer::query()->pluck('last_name', 'id')->toArray();
    }
    public function getTicketsProperty()
    {
        return Ticket::query()->pluck('ticket_number', 'id')->toArray();
    }


    public function editEdition()
    {
        $this->validate();

        $this->reservation->update();

        $this->reservation->save();

        return redirect()->route('reservations');

    }

    public function deleteEdition()
    {
        $this->reservation->delete();
        return redirect()->route('reservations');
    }

    public function back()
    {
        $this->redirect(route('reservations'));
    }

    public function render()
    {
        return view('livewire.crud.reservations.edit', ['title' => 'Edit Reservation']);
    }
}
