<div class="sidebar" x-data="{ activeSidebar: false }" x-bind:class="activeSidebar ? 'active' : ''">
    <div class="relative flex justify-center px-4 mt-8">
        <a href="/" class="flex justify-center">

        </a>

        <svg width="10" height="10" viewBox="0 0 10 10" fill="none" xmlns="http://www.w3.org/2000/svg" class="absolute bottom-0 right-0 cursor-pointer" @click.prevent="activeSidebar = !activeSidebar">
            <circle cx="5" cy="5" r="5" fill="#01385E"/>
        </svg>
    </div>

    <div class="flex justify-center mt-3">
        <div class="h-0.5 w-full bg-gray-basic rounded-xl"></div>
    </div>

    <div class="sidebar__menu scroll">
        <div class="flex justify-center mt-4">
            <ul class="flex flex-col gap-x-3.5 w-full">
                <li class="py-2">
                    <a href="{{ url('/') }}" class="flex gap-x-3.5 items-center transition-opacity cursor-pointer duration-300 group hover:opacity-90">
                        <div class="min-w-10 min-h-10 w-10 h-10 rounded-xl flex items-center justify-center {{ in_array(request()->route()->getName(), ['[PLACEHOLDER]']) ? 'bg-blue-dark' : 'bg-blue-marin' }}">
                            <svg width="19" height="16" viewBox="0 0 19 16">
                                <image xlink:href="{{ asset('img/sidebar/home_icon.svg') }}"/>
                            </svg>
                        </div>
                        <p
                                class="text-lg font-semibold whitespace-nowrap"
                                x-cloak
                                x-show="activeSidebar"
                                x-transition:enter-start="opacity-0 scale-90"
                                x-transition:enter="ease-out transition-slow delay-300"
                                x-transition:enter-end="opacity-100 scale-100"
                        >
                            Home
                        </p>
                    </a>
                </li>

                <li class="py-2">
                    <a href="{{ url('/') }}" class="flex gap-x-3.5 items-center transition-opacity cursor-pointer duration-300 group hover:opacity-90">
                        <div class="min-w-10 min-h-10 w-10 h-10 rounded-xl flex items-center justify-center {{ in_array(request()->route()->getName(), ['[PLACEHOLDER]']) ? 'bg-blue-dark' : 'bg-blue-marin' }}">
                            <svg width="19" height="16" viewBox="0 0 19 16">
                                <image xlink:href="{{ asset('img/sidebar/settings_icon.svg') }}"/>
                            </svg>
                        </div>
                        <p
                                class="text-lg font-semibold whitespace-nowrap"
                                x-cloak
                                x-show="activeSidebar"
                                x-transition:enter-start="opacity-0 scale-90"
                                x-transition:enter="ease-out transition-slow delay-300"
                                x-transition:enter-end="opacity-100 scale-100"
                        >
                            Settings
                        </p>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
