<nav x-data="{ open: false }" id="navbar" class="fixed top-0 w-full z-50 transition-all duration-300 
    @if (Request::is('/')) 
        bg-transparent 
    @else 
        bg-gray-900 shadow 
    @endif
">
    <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
        <!-- Logo -->
        <a href="{{ route('home') }}" wire:navigate class="flex items-center space-x-3 rtl:space-x-reverse">
            <img src="{{ asset('images/banjarnegara.png') }}" class="h-8" alt="Logo" />
            <span class="self-center text-2xl font-semibold whitespace-nowrap text-white">Lapor Mbae Guse</span>
        </a>

        <!-- Hamburger Button -->
        <button @click="open = !open" type="button"
            class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 cursor-pointer rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200" 
            aria-controls="navbar-default" aria-expanded="false">
            <span class="sr-only">Open main menu</span>
            <svg class="w-5 h-5" aria-hidden="true" fill="none" viewBox="0 0 17 14" xmlns="http://www.w3.org/2000/svg">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                    d="M1 1h15M1 7h15M1 13h15"/>
            </svg>
        </button>

        <!-- Menu Items -->
        <div :class="{ 'block': open, 'hidden': !open }" 
             class="w-full md:block md:w-auto transition-all duration-300" 
             id="navbar-default">
            <ul class="font-medium flex flex-col p-4 md:p-0 mt-4 border border-gray-100 rounded-lg 
                bg-white text-gray-800 md:bg-transparent md:text-white md:flex-row md:space-x-8 rtl:space-x-reverse md:mt-0 md:border-0">

                <!-- HOME -->
                <li>
                    <a href="{{ route('home') }}" wire:navigate 
                        class="block py-2 px-3 rounded-sm md:p-0
                        {{ Request::routeIs('home') 
                                ? 'text-blue-400 bg-gray-100 md:bg-transparent md:text-blue-400' 
                                : 'text-gray-800 hover:bg-gray-200 md:text-white md:hover:bg-transparent md:hover:text-blue-400' }}">
                        Home
                    </a>
                </li>

                <!-- ADUAN (Dropdown) -->
                <li class="relative" x-data="{ dropdownOpen: false }" 
                    {{-- @mouseenter="dropdownOpen = true" 
                    @mouseleave="dropdownOpen = false" --}}
                    >
                    @php
                        $isAduanActive = Request::routeIs('aduans.index') || Request::routeIs('aduans.create');
                    @endphp

                    <button @click="dropdownOpen = !dropdownOpen" 
                        :class="dropdownOpen ? 'text-blue-400' : '{{ $isAduanActive ? 'text-blue-400' : 'text-gray-800 md:text-white' }}'"
                        class="flex items-center w-full py-2 px-3 rounded-md md:p-0
                            md:hover:bg-transparent md:hover:text-blue-400
                            focus:outline-none transition-colors duration-200 cursor-pointer">
                        Aduan
                        <svg 
                            :class="{
                                'rotate-180 text-blue-400': dropdownOpen, 
                                'rotate-0 text-blue-400': {{ $isAduanActive ? 'true' : 'false' }}, 
                                'rotate-0 text-gray-800 md:text-white': !dropdownOpen && !{{ $isAduanActive ? 'true' : 'false' }}
                            }" 
                            class="ml-1 w-4 h-4 transition-transform duration-300" 
                            fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" 
                            xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"></path>
                        </svg>

                    </button>


                    <!-- Dropdown Menu -->
                    <div x-show="dropdownOpen"
                        x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0 transform -translate-y-2"
                        x-transition:enter-end="opacity-100 transform translate-y-0"
                        x-transition:leave="transition ease-in duration-150"
                        x-transition:leave-start="opacity-100 transform translate-y-0"
                        x-transition:leave-end="opacity-0 transform -translate-y-2"
                        class="md:absolute left-0 mt-2 md:w-48 bg-white rounded shadow-lg ring-1 ring-black ring-opacity-50 z-50"
                        @click.away="dropdownOpen = false">
                        
                        <a href="{{ route('aduans.index') }}" wire:navigate 
                           class="block px-5 py-3 rounded-t-lg border-b border-gray-200 md:border-none
                           {{ Request::routeIs('aduans.index') 
                               ? 'text-blue-600 bg-gray-100 md:bg-transparent md:text-blue-400' 
                               : 'text-gray-800 hover:bg-gray-200 md:text-gray-800 md:hover:bg-transparent md:hover:text-blue-400' }}">
                            Daftar Aduan
                        </a>

                        <a href="{{ route('aduans.create') }}" wire:navigate 
                           class="block px-5 py-3 rounded-b-lg 
                           {{ Request::routeIs('aduans.create') 
                               ? 'text-blue-400 bg-gray-100 md:bg-transparent md:text-blue-400' 
                               : 'text-gray-800 hover:bg-gray-200 md:text-gray-800 md:hover:bg-transparent md:hover:text-blue-400' }}">
                            Buat Aduan
                        </a>
                    </div>
                </li>

                <!-- ALUR -->
                <li>
                    <a href="{{ route('alur') }}" wire:navigate 
                        class="block py-2 px-3 rounded-sm md:p-0
                        {{ Request::routeIs('alur') 
                                ? 'text-blue-400 bg-gray-100 md:bg-transparent md:text-blue-400' 
                                : 'text-gray-800 hover:bg-gray-200 md:text-white md:hover:bg-transparent md:hover:text-blue-400' }}">
                        Alur Pengaduan
                    </a>
                </li>

            </ul>
        </div>
    </div>
</nav>
