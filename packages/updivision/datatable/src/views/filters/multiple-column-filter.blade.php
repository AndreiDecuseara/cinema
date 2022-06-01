<div class="col-span-4">
    <label for="datatable.filters.{{ $filter->name }}" class="block mb-2">{{ $filter->label }}</label>
    <x-input
        type="select"
        wire:model.debounce.500ms="filters.{{ $filter->name }}"
        :options="$filter->options()"
    ></x-input>
</div>