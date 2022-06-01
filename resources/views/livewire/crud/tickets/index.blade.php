<div>
    @if($datatable->isSearchable() || $datatable->isFilterable())
        <x-page-filters :title="'Find ' . $title">
            <livewire:datatable::search
                :datatable-class="$datatable"
                :title="$title . ' Search'"
                :description="''"
                :placeholder="'Enter search term'"
                :show-reset-button="true"
            />

            <livewire:datatable::filters :datatable-class="$datatable" :title="'Filters'" :description="''"/>
        </x-page-filters>
    @endif

    <div class="main-content">
        @if (isset($title))
            <div class="flex items-center gap-4 pb-7">
                <h2 class="page_title w-max whitespace-nowrap">{{ $title ?? "" }}</h2>

                <livewire:datatable::filters.remove :datatable-class="$datatable"/>
            </div>
        @endif

        <livewire:datatable::datatable :datatable-class="$datatable"/>
    </div>
</div>