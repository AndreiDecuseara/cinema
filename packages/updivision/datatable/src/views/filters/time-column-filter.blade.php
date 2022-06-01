<div class="col-span-6">
    <label for="datatable.filters.{{ $filter->name }}_start_time" class="block mb-2">{{ $filter->label }}</label>
    <div class="flex gap-3 items-center">
        <div class="flex-1">
            <x-input
                id="datatable.filters.{{ $filter->name }}_start_time"
                wire:model.debounce.500ms="filters.{{ $filter->name }}.start_time"
                type="time"
                placeholder="Start time ({{ $filter->label }})"
            />
        </div>

        <div class="flex-1">
            <x-input
                id="datatable.filters.{{ $filter->name }}_end_time"
                wire:model.debounce.500ms="filters.{{ $filter->name }}.end_time"
                type="time"
                placeholder="End time ({{ $filter->label }})"
            />
        </div>
    </div>
</div>