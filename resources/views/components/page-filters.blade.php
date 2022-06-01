@props([
    'title',
    'selected'
])

<div class="main-filters">
    @if (isset($title))
        <div class="pb-7">
            <h2 class="page_title w-max whitespace-nowrap">{{ $title }}</h2>
        </div>
    @endif

    <div>
        {{ $slot }}
    </div>
</div>