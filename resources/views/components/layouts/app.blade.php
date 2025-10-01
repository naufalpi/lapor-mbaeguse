<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" type="image/png" href="{{ asset('images/favicon.ico') }}">
        <title>{{ $title ?? 'Lapor Mbae Guse' }}</title>

        @livewireStyles
        @vite('resources/css/app.css')
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  
    </head>
    <body>
        <x-layouts.partials.navbar />


        <main class="min-h-screen mx-auto">
            {{ $slot }}
        </main>

        <x-layouts.partials.footer />

        @livewireScripts

        @stack('scripts')

        <script>
            function setupNavbarScrollEffect() {
                const navbar = document.getElementById('navbar');
                if (!navbar) return;

                let isScrolled = false;

                window.addEventListener('scroll', function () {
                    if (window.scrollY > 50) {
                        isScrolled = true;
                        navbar.classList.remove('bg-transparent');
                        navbar.classList.add('bg-gray-900/80', 'shadow');
                    } else {
                        isScrolled = false;
                        navbar.classList.remove('bg-gray-900/80', 'shadow');
                        navbar.classList.add('bg-transparent');
                    }
                });

                navbar.addEventListener('mouseenter', function () {
                    if (!isScrolled) {
                        navbar.classList.remove('bg-transparent');
                        navbar.classList.add('bg-gray-900/80', 'shadow');
                    }
                });

                navbar.addEventListener('mouseleave', function () {
                    if (!isScrolled) {
                        navbar.classList.remove('bg-gray-900/80', 'shadow');
                        navbar.classList.add('bg-transparent');
                    }
                });
            }

            document.addEventListener('livewire:navigated', function () {
                if (window.location.pathname === "/") {
                    setupNavbarScrollEffect();
                }
            });

            // Untuk load awal juga
            window.addEventListener('DOMContentLoaded', function () {
                if (window.location.pathname === "/") {
                    setupNavbarScrollEffect();
                }
            });
        </script>

    

  

    </body>
</html>
