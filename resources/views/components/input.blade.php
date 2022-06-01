@props([
        'options',
        'selected'
])

@switch($attributes->get('type'))

    @case('select')
        <select
            {{ $attributes->whereStartsWith('wire:') }}
            {{ $attributes->only(['class', 'name', 'id'])->merge([
                'class' => 'form-input form-select'
            ]) }}
        >
            @isset($selected)
                    <option selected hidden value="">{{ $selected }}</option>
            @endisset
            @isset($options)
                    @foreach ($options as $key => $value)
                            <option value="{{ $key }}">{{ $value }}</option>
                    @endforeach
            @endisset
        </select>
    @break

    @case('toggle')
    <div x-data="{ toggle: $wire.{{ $attributes->get('model') }}}" class="flex items-center">
        <span {{ $attributes->only('class')->merge([
            'class' => 'text-sm font-semibold poppins text-black-soft'
            ]) }}>
            {{ $attributes->get('text') }}
        </span>
        <div class="flex items-center justify-center mx-2">
            <div class="relative h-4 transition duration-200 ease-linear rounded-full w-7 md:h-5 md:w-8"
                 :class="[toggle == '1' ? '{{ $attributes->get('color') == 'blue' ? 'bg-primary' : 'bg-black-soft'}} bg-opacity-90' : '']">
                <label for="{{ $attributes->get('id') }}"
                       class="absolute left-0 w-4 h-4 mb-2 transition duration-100 ease-linear transform border-2 rounded-full cursor-pointer md:border-4 md:w-5 md:h-5 {{ $attributes->get('color') == 'blue' ? 'border-primary bg-blue-sky-darker' : 'border-black-soft bg-white'}} border-opacity-90"
                       :class="[toggle == '1' ? 'translate-x-3' : 'translate-x-0']"></label>
                <input wire:model={{ $attributes->get('model') }} type="checkbox" id="{{ $attributes->get('id') }}" name="toggle"
                       class="w-full h-full mb-2 border-2 appearance-none md:border-4 active:outline-none focus:outline-none {{ $attributes->get('color') == 'blue' ? 'border-primary' : 'border-black-soft'}} border-opacity-90 md:mb-0 rounded-2xl"
                       @click="toggle == '0' ? toggle = '1' : toggle = '0'">
            </div>
        </div>
    </div>
    @break

    @case('datepicker')
        <input type="text" x-data x-ref="input" autocomplete="off" {{ $attributes->merge([
            'class' => 'form-input form-datepicker'
        ]) }}>
    @break

    @case('number')
        <input
            {{ $attributes->whereStartsWith('wire:') }}
            {{ $attributes->only(['class', 'placeholder', 'type', 'id', 'style', 'min', 'max', 'value'])->merge([
                'type' => 'number',
                'class' => 'form-input'
            ]) }}
        >
    @break

    @case('email')
    <input
        {{ $attributes->whereStartsWith('wire:') }}
        {{ $attributes->only(['class', 'placeholder', 'type', 'id', 'style', 'min', 'max', 'value'])->merge([
            'type' => 'email',
            'class' => 'form-input'
        ]) }}
    >
    @break

    @case('date')
    <input
        {{ $attributes->whereStartsWith('wire:') }}
        {{ $attributes->only(['class', 'placeholder', 'type', 'id', 'style', 'min', 'max', 'value'])->merge([
            'type' => 'date',
            'class' => 'form-input'
        ]) }}
    >
    @break

    @case('right-tooltip')
        <div class="flex items-center form-input">     
            <input 
                {{ $attributes->whereStartsWith('wire:') }}
                {{ $attributes->only(['class', 'placeholder', 'id', 'style', 'min', 'max', 'value'])->merge([
                    'type' => 'number',
                    'min' => 0,
                    'class' => 'w-full outline-0'
                ]) }}
            >
            <span class="px-2 text-sm w-max whitespace-nowrap text-gray-tooltip">{{ $attributes->get('tooltip') }}</span>
        </div>
    @break

    @default
        <input
            {{ $attributes->whereStartsWith('wire:') }}
            {{ $attributes->only(['class', 'placeholder', 'type', 'id', 'style', 'min', 'max', 'value'])->merge([
                'type' => 'text',
                'class' => 'form-input'
            ]) }}
        >
        
@endswitch

