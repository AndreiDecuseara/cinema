<div
    x-cloak
    x-data="{ open: false }"
    :class="{'h-full': open}"
    class="navbar print:!hidden"
>
    <nav class="w-full">

        <div :class="{'flex': open, 'hidden': !open}" class="items-center justify-between -mb-0.5 lg:-mb-2.5 lg:flex">
            <div x-cloak class="flex-col items-center w-full lg:flex lg:flex-row">
                <span class="flex items-center justify-between lg:hidden md-8">
                    <svg height="27" viewBox="0 0 209 37">
                        <image xlink:href="{{ asset('img/navbar/logo_with_title.svg') }}"/>
                    </svg>
                    <button @click="open=!open">
                        <svg width="37" height="38" viewBox="0 0 37 38">
                            <image xlink:href="{{ asset('img/navbar/menu_close_icon.svg') }}"/>
                        </svg>
                    </button>
                </span>
                <div class="flex flex-col lg:flex-row">
                    <a href="{{ route('movies') }}" class="pb-6 lg:ml-10 text-base font-semibold lg:border-b-2 poppins {{ in_array(request()->route()->getName(), ['movies']) ? 'text-black-soft border-black-soft' : 'text-gray-faded' }}">Movies</a>
                    <a href="{{ route('cinemas') }}" class="pb-6 lg:ml-10 text-base font-semibold lg:border-b-2 poppins {{ in_array(request()->route()->getName(), ['cinemas']) ? 'text-black-soft border-black-soft' : 'text-gray-faded' }}">Cinemas</a>
                    <a href="{{ route('tickets') }}" class="pb-6 lg:ml-10 text-base font-semibold lg:border-b-2 poppins {{ in_array(request()->route()->getName(), ['tickets']) ? 'text-black-soft border-black-soft' : 'text-gray-faded' }}">Tickets</a>
                    <a href="{{ route('halls') }}" class="pb-6 lg:ml-10 text-base font-semibold lg:border-b-2 poppins {{ in_array(request()->route()->getName(), ['halls']) ? 'text-black-soft border-black-soft' : 'text-gray-faded' }}">Halls</a>
                    <a href="{{ route('seats') }}" class="pb-6 lg:ml-10 text-base font-semibold lg:border-b-2 poppins {{ in_array(request()->route()->getName(), ['seats']) ? 'text-black-soft border-black-soft' : 'text-gray-faded' }}">Seats</a>
                    <a href="{{ route('customers') }}" class="pb-6 lg:ml-10 text-base font-semibold lg:border-b-2 poppins {{ in_array(request()->route()->getName(), ['customers']) ? 'text-black-soft border-black-soft' : 'text-gray-faded' }}">Customers</a>
                    {{--
                    <a href="{{ route('reservations') }}" class="pb-6 lg:ml-10 text-base font-semibold lg:border-b-2 poppins {{ in_array(request()->route()->getName(), ['reservations']) ? 'text-black-soft border-black-soft' : 'text-gray-faded' }}">Reservations</a>

                    --}}
                    <a href="{{ config('app.production_url') }}" class="pb-6 text-base font-semibold lg:ml-10 poppins lg:hidden text-gray-faded">LuxeXchange</a>
                    <a wire:click='logout' class="pb-6 text-base font-semibold lg:ml-10 poppins lg:hidden text-gray-faded">Logout</a>
                </div>
            </div>
            <div x-data="{ dropdown: false }" class="hidden ml-2 lg:block z-60" style="padding-bottom: 23px">
                <button class="px-3 py-2.5 text-base text-white font-semibold rounded-full bg-blue-dark poppins" @mouseleave="dropdown = false" @mouseover="dropdown = true">
                    {{ auth()->user() ? substr(auth()->user()->name, 0, 2) : 'Me' }}
                </button>
                {{-- <div
                        x-cloak
                        x-show="dropdown"
                        @mouseover="dropdown = true"
                        @mouseleave="dropdown = false"
                        x-transition:enter="transition ease-out duration-100"
                        x-transition:enter-start="transform opacity-0 scale-95"
                        x-transition:enter-end="transform opacity-100 scale-100"
                        x-transition:leave="transition ease-in duration-75"
                        x-transition:leave-start="transform opacity-100 scale-100"
                        x-transition:leave-end="transform opacity-0 scale-95"
                        class="absolute z-10 origin-top-left right-8"
                        style="display: none"
                >
                    <div class="flex flex-col bg-white rounded-md shadow-lg w-44 justify-evenly">
                        <a wire:click='logout' class="px-4 py-2 text-base rounded cursor-pointer opensans text-black-light hover:bg-blue-light">Logout</a>
                    </div>
                </div> --}}
            </div>
        </div>
    </nav>
</div>
