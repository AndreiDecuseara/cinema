<div wire:key="{{ $datatableId }}_datatable_filters">
    @if($datatable->isFilterable())
        <div class="w-full border-2 rounded-lg border-blue-light mt-9">
            <div class="flex items-center">
                <p class="text-sm font-semibold poppins text-black-soft my-2.5 px-6 uppercase">
                    Filters
                </p>
            </div>
            <div class="p-6 rounded-b-lg bg-blue-light">
                <div class="grid gap-8 grid-cols-1 md:grid-cols-2 lg:grid-cols-12">
                    @foreach($datatable->filters() as $key => $filter)
                        {!! $filter->render() !!}
                    @endforeach
                </div>
            </div>
        </div>
    @endif
</div>
