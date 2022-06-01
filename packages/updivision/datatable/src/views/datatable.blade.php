<div
    x-cloak
    x-data="{ mobileView: tailwind.currentBreakpoint !== null && tailwind.currentBreakpointIsLessThan('lg') }"
    x-on:resize.window="mobileView = tailwind.currentBreakpoint !== null && tailwind.currentBreakpointIsLessThan('lg')"
    class="table-layout"
    :class="{ 'table-layout': !mobileView, 'table-mobile-layout': mobileView }"
    wire:key="{{ $datatableId }}_datatable"
>
    <div x-cloak x-show="mobileView">

        {{--    Mobile Sorting --}}
        @if($datatable->isSortable())
            <div class="pb-4 flex gap-x-3 items-center">
                <span class="py-2.5 text-[15px] text-black-light text-center sm:text-right">Sort by:</span>

                <div class="flex-1">
                    <select class="w-full text-sm py-2.5 px-4 rounded-md shadow-input bg-white" wire:change="sortBy($event.target.value.split('-')[0], $event.target.value.split('-')[1])">
                        <optgroup label="Ascending">
                            @foreach($datatable->columns()->where('sortable', true)->where('visibility', true) as $column)
                                <option value="{{ $column->name }}-asc" {{ $datatable->isCurrentSortingColumn($column, 'asc') ? 'selected' : '' }}>
                                    {{ $column->label }}
                                </option>
                            @endforeach
                        </optgroup>

                        <optgroup label="Descending">
                            @foreach($datatable->columns()->where('sortable', true)->where('visibility', true) as $column)
                                <option value="{{ $column->name }}-desc" {{ $datatable->isCurrentSortingColumn($column, 'desc') ? 'selected' : '' }}>
                                    {{ $column->label }}
                                </option>
                            @endforeach
                        </optgroup>
                    </select>
                </div>
            </div>
        @endif

        {{--    Mobile Pagination--}}
        @if($datatable->paginate && $records->total() > (count($datatable->pageLengthMenu()) ? $datatable->pageLengthMenu()[0] : $datatable->pageLength))
            <div class="flex items-center justify-end flex-wrap">
                @if(count($datatable->pageLengthMenu()))
                    <div class="py-2.5 sm:px-6 text-[15px] text-black-light flex-1 text-left sm:text-right">
                        Rows per page:
                        <select wire:model="pageLength" class="bg-white">
                            @foreach($datatable->pageLengthMenu() as $length)
                                <option value="{{ $length }}">{{ $length }}</option>
                            @endforeach
                        </select>
                    </div>
                @endif
                <div class="w-full sm:w-auto">
                    {{ $records->links() }}
                </div>
            </div>
        @endif
    </div>


    {{-- DataTable --}}
    <table class="table">
        <thead class="table-head">
        <tr class="table-head-row">
            @foreach($datatable->columns()->where('visibility', true) as $key => $column)
                <td class="table-head-cell" wire:key="{{ "datatable-column-#$key" }}">
                    <div
                        class="flex gap-x-3 items-center justify-between {{ $column->sortable && $datatable->isSortable() ? 'cursor-pointer' : ''}}"
                        @if($column->sortable && $datatable->isSortable())
                            wire:click="sortBy('{{ $column->name }}', '{{ $datatable->sortDir === 'desc' ? 'asc' : 'desc' }}')"
                        @endif
                    >

                        <span class="whitespace-nowrap">{{ $column->label }}</span>

                        @if($column->sortable && $datatable->isSortable())
                            <span class="flex">
                            <button type="button" class="link-info-lg {{ $datatable->isCurrentSortingColumn($column, 'asc') ?: 'text-gray-400' }}">
                                <i class="las la-long-arrow-alt-up font-bold w-2.5"></i>
                            </button>

                            <button type="button" class="link-info-lg {{ $datatable->isCurrentSortingColumn($column, 'desc') ?: 'text-gray-400' }}">
                                <i class="las la-long-arrow-alt-down font-bold w-2.5"></i>
                            </button>
                        </span>
                        @endif

                    </div>
                </td>
            @endforeach

        </tr>

        </thead>
        <tbody class="table-body">
        @forelse($records as $key => $entity)
            <tr class="table-body-row" wire:key="{{ "datatable-record-#$key" }}">
                <td x-cloak x-show="mobileView" class="table-body-cell">
                    <table class="table-nested">
                        @foreach($datatable->columns()->where('visibility', true) as $key => $column)
                            <tr class="table-nested-row" wire:key="{{ "datatable-record-#$key-column-#$key-mobile" }}">
                                <th class="table-nested-head-cell" title="{{ $column->label }}">

                                    <div class="flex gap-x-3 items-center justify-between">
                                        <span class="whitespace-nowrap">{{ $column->label }}</span>
                                        @if($column->sortable && $datatable->isSortable())
                                            <span class="link-info-lg">
                                                @if($datatable->isCurrentSortingColumn($column, 'asc'))
                                                    <i class="las la-long-arrow-alt-up font-bold w-2.5"></i>
                                                @elseif($datatable->isCurrentSortingColumn($column, 'desc'))
                                                    <i class="las la-long-arrow-alt-down font-bold w-2.5"></i>
                                                @endif
                                            </span>
                                        @endif
                                    </div>

                                </th>

                                <td class="table-nested-body-cell" wire:key="{{ "datatable-record-#$key-column-#$key" }}">
                                    @if($column->name === 'actions')
                                        <div class="flex gap-x-3">
                                            @foreach($datatable->actions() as $action)
                                                <div>
                                                    {!! $action->render($entity) !!}
                                                </div>
                                            @endforeach
                                        </div>
                                    @else
                                        {!! $column->render($entity) !!}
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </td>

                @foreach($datatable->columns()->where('visibility', true) as $column)
                    <td x-cloak x-show="!mobileView" class="table-body-cell">
                        @if($column->name === 'actions')
                            <div class="flex gap-x-3">
                                @foreach($datatable->actions() as $action)
                                    <div>
                                        {!! $action->render($entity) !!}
                                    </div>
                                @endforeach
                            </div>
                        @else
                            {!! $column->render($entity) !!}
                        @endif
                    </td>
                @endforeach
            </tr>
        @empty
            <tr class="table-body-row" wire:key="datatable-no-records">
                <td colspan="{{ $datatable->columns()->count() ?? 1 }}" class="block lg:table-cell w-full text-lg text-black-light">
                    <div class="flex flex-col items-center justify-center py-7">
                        <div>
                            <img src="{{ asset('img/datatable/no_data_icon.svg') }}" alt="no data icon">
                        </div>

                        <div class="pt-3">
                            No data found
                        </div>
                    </div>
                </td>
            </tr>
        @endforelse
        </tbody>
    </table>

    {{-- Pagination --}}
    @if($datatable->paginate && $records->total() > (count($datatable->pageLengthMenu()) ? $datatable->pageLengthMenu()[0] : $datatable->pageLength))
        <div class="flex items-center justify-end flex-wrap">
            @if(count($datatable->pageLengthMenu()))
                <div class="py-2.5 px-6 text-[15px] text-black-light flex-1 text-center sm:text-right">
                    Rows per page:
                    <select wire:model="pageLength" class="bg-white">
                        @foreach($datatable->pageLengthMenu() as $length)
                            <option value="{{ $length }}">{{ $length }}</option>
                        @endforeach
                    </select>
                </div>
            @endif
            <div class=" w-full sm:w-auto">
                {{ $records->links() }}
            </div>
        </div>
    @endif
</div>

