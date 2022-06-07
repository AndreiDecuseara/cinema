<div>
    <div class="py-16 main-content">
        <div>
            <div class="lg:w-1/2">
                <form wire:submit.prevent="createReservation"> @csrf <div class="form-group">
                        <span class="form-label">Customer</span>
                        <x-input type="select" wire:model='customer_id' :options="$this->customers"
                            selected="Select a customer"></x-input>
                    </div>
                    <div class="form-group">
                        <span class="form-label">Ticket</span>
                        <x-input type="select" wire:model='ticket_id' :options="$this->tickets"
                            selected="Select a ticket"></x-input>
                    </div>
                    <div class="flex items-center justify-start mt-10">
                        <button type="button" wire:click='back' class="mr-6 button-info-lg">CANCEL</button>
                        <button class="button-dark-lg" type="submit">SAVE</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
