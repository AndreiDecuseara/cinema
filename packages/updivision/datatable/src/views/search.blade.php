<div wire:key="{{ $datatableId }}_datatable_search">
    @if($datatable->isSearchable())
        <div class="w-full border-2 rounded-lg border-blue-light">
            <div class="flex items-center">
                <p class="text-sm font-semibold poppins text-black-soft my-2.5 px-6 uppercase">
                    {{ $title }}
                </p>

                @if($description)
                    <x-popover :arrange="'right'">{{ $description }}</x-popover>
                @endif
            </div>
            <div class="p-6 rounded-b-lg bg-blue-light">
                <div class="flex gap-x-8">
                    <div class="flex-1">
                        <x-input wire:model.debounce.500ms="search" :placeholder="$placeholder"/>
                    </div>
                    @if($showResetButton)
                        <div class="flex-col">
                            <button wire:click="resetSearch" type="button" class="button-secondary">Reset</button>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    @endif
</div>
