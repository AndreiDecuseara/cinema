@props([
    'title',
    'xshow',
    'function',
    'id',
    'confirmBtnText',
    'cancelBtnText',
    'actions',
])

<div x-cloak>
    <div x-show="{{$xshow}}"  class="fixed top-0 bottom-0 left-0 right-0 z-50 flex items-center justify-center overflow-auto bg-black-soft bg-opacity-70" x-transition:enter="transition ease duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition ease duration-300" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
        <div x-show="{{$xshow}}" @click.away="{{$xshow}} = !{{$xshow}}" class="px-10 py-8 mx-4 bg-white rounded shadow-lg md:w-1/4" x-transition:enter="transition ease duration-100 transform" x-transition:enter-start="opacity-0 scale-90 translate-y-1" x-transition:enter-end="opacity-100 scale-100 translate-y-0" x-transition:leave="transition ease duration-100 transform" x-transition:leave-start="opacity-100 scale-100 translate-y-0" x-transition:leave-end="opacity-0 scale-90 translate-y-1">
            <h1 class="text-2xl font-semibold poppins text-black-soft">{{ $title }}</h1>
            <p class="mt-2 mb-6 text-sm font-normal text-gray-600 opensans">{{ $slot }}</p>
            <div class="flex justify-end mt-9">
                <button @click="{{$xshow}} = !{{$xshow}};" class="mr-6 text-lg font-semibold text-gray-300 poppins">
                    {{ $cancelBtnText ?? 'Cancel' }}
                </button>

                @isset($actions)
                    @foreach($actions as $action)
                        <button
                            @click="{{$xshow}} = !{{$xshow}};"
                            wire:click="{{ $action['function'] . (isset($action['parameters']) ? '(' . implode(', ', $action['parameters']) . ')' : '') }}"
                            class="mr-6 text-lg font-semibold poppins {{ isset($action['color']) ? "text-{$action['color']}" : 'text-gray-300' }}"
                        >
                            {{ $action['text'] }}
                        </button>
                    @endforeach
                @endisset

                <button wire:click='{{$function}}({{$id}})'  @click="{{$xshow}} = !{{$xshow}};" class="text-lg font-semibold poppins text-blue-marin">
                    {{ $confirmBtnText ?? 'Yes' }}
                </button>
            </div>
        </div>
    </div>
</div>
