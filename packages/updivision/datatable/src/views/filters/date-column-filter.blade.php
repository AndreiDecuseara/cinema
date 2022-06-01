<div class="col-span-6">
    <label for="datatable.filters.{{ $filter->name }}_start_date" class="block mb-2">{{ $filter->label }}</label>
    <div class="flex gap-3 items-center">
        <div class="flex-1">
            <x-input
                id="datatable.filters.{{ $filter->name }}_start_date"
                wire:model.debounce.500ms="filters.{{ $filter->name }}.start_date"
                type="date"
                placeholder="Start date ({{ $filter->label }})"
            />
        </div>

        <div class="flex-1">
            <x-input
                id="datatable.filters.{{ $filter->name }}_end_date"
                wire:model.debounce.500ms="filters.{{ $filter->name }}.end_date"
                type="date"
                placeholder="End date ({{ $filter->label }})"
            />
        </div>
    </div>
</div>
