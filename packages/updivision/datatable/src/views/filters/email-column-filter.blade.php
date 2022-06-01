<div class="col-span-4">
    <label for="datatable.filters.{{ $filter->name }}_start_date" class="block mb-2">{{ $filter->label }}</label>
    <x-input
        id="datatable.filters.{{ $filter->name }}"
        wire:model.debounce.500ms="filters.{{ $filter->name }}"
        type="email"
        placeholder="{{ $filter->placeholder }}"
    />
</div>