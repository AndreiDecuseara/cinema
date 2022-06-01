@props([
    'id',
    'xshow',
    'title',
    'defaultActions' => [[
        'text' => 'Cancel',
        'classes' => 'link-secondary',
        'close_modal_onclick' => true,
    ]],
    'actions' => [],
    'showDefaultActions' => true,
    'showActions' => true,
])

<div
    x-cloak
>
    <div
        x-cloak
        x-show="{{$xshow}}"
        class="fixed top-0 bottom-0 left-0 right-0 z-50 flex items-center justify-center overflow-auto bg-black-soft bg-opacity-70"
        x-transition:enter="transition ease duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease duration-300"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
    >
        <div
            x-cloak
            x-show="{{$xshow}}"
            @click.away="{{$xshow}} = !{{$xshow}}"
            class="px-10 py-8 mx-4 bg-white rounded shadow-lg md:w-1/3"
            x-transition:enter="transition ease duration-100 transform"
            x-transition:enter-start="opacity-0 scale-90 translate-y-1"
            x-transition:enter-end="opacity-100 scale-100 translate-y-0"
            x-transition:leave="transition ease duration-100 transform"
            x-transition:leave-start="opacity-100 scale-100 translate-y-0"
            x-transition:leave-end="opacity-0 scale-90 translate-y-1"
        >
            @isset($title)
                <h1 class="text-2xl font-semibold poppins text-black-soft mb-5">{{ $title }}</h1>
            @endisset

            {{ $slot }}

            @if(count($actions = array_merge(($showDefaultActions ? $defaultActions : []) ?? [], $actions ?? [])))
                <div class="flex justify-end mt-9 gap-x-6">
                    @foreach($actions as $action)
                        <button
                            type="{{ $action['type'] ?? 'button' }}"
                            @if(($action['close_modal_onclick'] ?? false) && isset($xshow))
                                @click="{{ $xshow }} = !{{ $xshow }};"
                            @endif
                            class="{{ $action['classes'] ?? 'link-primary' }}"

                            {!! collect($action['attributes'] ?? [])->implode(function ($value, $attribute) {
                                return "{$attribute}=\"{$value}\"";
                            }, ' ') !!}
                        >
                            {{ $action['text'] }}
                        </button>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</div>
