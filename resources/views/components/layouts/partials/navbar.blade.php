<nav x-data="{ open: false }" id="navbar" class="fixed top-0 w-full z-50 transition-all duration-300 
        @if (Request::is('/')) 
            bg-transparent 
        @else 
            bg-gray-900 shadow 
        @endif
    ">
    <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
        <a href="{{ route('home') }}" wire:navigate class="flex items-center space-x-3 rtl:space-x-reverse">
            <img src="{{ asset('images/banjarnegara.png') }}" class="h-8" alt="Logo" />
            <span class="self-center text-2xl font-semibold whitespace-nowrap text-white">Lapor Mbae Guse</span>
        </a>

        <!-- Hamburger Button -->
        <button @click="open = !open" type="button" 
            class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200" 
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
            <ul class="font-medium flex flex-col p-4 md:p-0 mt-4 border border-gray-100 rounded-lg bg-white md:bg-transparent md:flex-row md:space-x-8 rtl:space-x-reverse md:mt-0 md:border-0">
                <li>
                    <a href="{{ route('home') }}" wire:navigate 
                       class="block py-2 px-3 rounded-sm md:p-0
                        {{ Request::routeIs('home') ? 'text-white bg-blue-700 md:bg-transparent md:text-blue-500' : 'text-white hover:bg-gray-700 md:hover:bg-transparent md:hover:text-blue-500' }}">Home</a>
                </li>
                {{-- <li>
                    <a href="{{ route('aduans.index') }}" wire:navigate 
                       class="block py-2 px-3 rounded-sm md:p-0
                        {{ Request::routeIs('aduans.*') ? 'text-white bg-blue-700 md:bg-transparent md:text-blue-500' : 'text-white hover:bg-gray-700 md:hover:bg-transparent md:hover:text-blue-500' }}">Aduan</a>
                </li> --}}

                <li class="relative" x-data="{ dropdownOpen: false }" 
    @mouseenter="dropdownOpen = true" 
    @mouseleave="dropdownOpen = false"
>
  <button @click="dropdownOpen = !dropdownOpen" 
        class="flex items-center w-full py-2 px-3 rounded-md md:p-0 text-white hover:bg-blue-600 md:hover:bg-transparent md:hover:text-blue-400 focus:outline-none transition-colors duration-200">
    Aduan
    <svg :class="{'rotate-180 text-white md:text-blue-400': dropdownOpen, 'rotate-0 text-white md:text-white': !dropdownOpen }" 
         class="ml-1 w-4 h-4 transition-transform duration-300" 
         fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" 
         xmlns="http://www.w3.org/2000/svg" aria-hidden="true" >
        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"></path>
    </svg>
</button>

    <!-- Dropdown Menu -->
    <div x-show="dropdownOpen" x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 transform -translate-y-2"
         x-transition:enter-end="opacity-100 transform translate-y-0"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100 transform translate-y-0"
         x-transition:leave-end="opacity-0 transform -translate-y-2"
         class="absolute left-0 mt-2 w-48 bg-white rounded-lg shadow-lg ring-1 ring-black ring-opacity-10 z-50"
         @click.away="dropdownOpen = false" style="display: none;"
    >
        <a href="{{ route('aduans.index') }}" wire:navigate 
           class="block px-5 py-3 text-gray-800 font-semibold hover:bg-blue-100 hover:text-blue-700 transition-colors duration-150 rounded-t-lg">
           Daftar Aduan
        </a>
        <a href="{{ route('aduans.create') }}" wire:navigate 
           class="block px-5 py-3 text-gray-800 font-semibold hover:bg-blue-100 hover:text-blue-700 transition-colors duration-150 rounded-b-lg border-t border-gray-200">
           Buat Aduan
        </a>
    </div>
</li>

                <li>
                    <a href="{{ route('alur') }}" wire:navigate 
                       class="block py-2 px-3 rounded-sm md:p-0
                        {{ Request::routeIs('alur') ? 'text-white bg-blue-700 md:bg-transparent md:text-blue-500' : 'text-white hover:bg-gray-700 md:hover:bg-transparent md:hover:text-blue-500' }}">Alur Pengaduan</a>
                </li>
            </ul>
        </div>
    </div>
</nav>