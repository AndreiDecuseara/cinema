<div>
    <div class="py-16 main-content">
        <div>
            <div class="lg:w-1/2" x-data="{deleteEdition: false}">
                <form wire:submit.prevent="editEdition"> @csrf <div class="form-group">
                        <span class="form-label">Customer</span>
                        <x-input type="select" wire:model='reservation.customer_id' :options="$this->customers"
                            selected="Select a customer"></x-input>
                    </div>
                    <div class="form-group">
                        <span class="form-label">Ticket</span>
                        <x-input type="select" wire:model='reservation.ticket_id' :options="$this->tickets"
                            selected="Select a ticket"></x-input>
                    </div>
                    <div class="flex flex-wrap items-center justify-start mt-10 gap-y-2">
                        <button type="button" wire:click='back' class="mr-6 button-info-lg">CANCEL</button>
                        <button type="button" @click="deleteEdition = !deleteEdition"
                            class="mr-6 button-danger-lg">DELETE</button>
                        <button class="button-dark-lg" type="submit">SAVE</button>
                    </div>
                </form>
                <x-modals.modal :title="'Delete Edition'" :xshow="'deleteEdition'" :actions="[
                        [
                            'close_modal_onclick' => true,
                            'text' => 'Yes',
                            'attributes' => [
                                'wire:click' => 'deleteEdition'
                            ]
                        ]
                    ]"> Are you sure you want to delete this edition? </x-modals.modal>
            </div>
        </div>
    </div>
</div>
