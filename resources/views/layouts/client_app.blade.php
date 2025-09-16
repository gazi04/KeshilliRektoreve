<!DOCTYPE html>
<html lang="sq" class="h-full">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title', 'Këshilli i Rektorëve')</title>
    <link rel="icon" href="data:," />
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/20L7Fm2zQk4P7K4W7C7C7v+Jt9s/C7r8B7C7A7A7B7A7" crossorigin="anonymous" referrerpolicy="no-referrer" />
    @stack('styles')
</head>

<body class="bg-gray-50 text-gray-800 font-sans leading-relaxed antialiased flex flex-col min-h-screen">

    <header class="bg-white shadow-lg fixed top-0 w-full z-50">
        <nav class="container mx-auto px-4 py-4 flex items-center justify-between">
            <a href="{{ url('/') }}" class="flex items-center space-x-3 rtl:space-x-reverse">
                <img src="https://uni-gjilan.net/wp-content/themes/kadrizeka/img/uni-gjilan_sq.png" class="h-10 sm:h-12" alt="UKZ Logo" />
            </a>
            <div class="md:hidden">
                <button id="mobileMenuBtn" class="text-primary-600 focus:outline-none p-2">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
                    </svg>
                </button>
            </div>
            <div id="navMenu" class="hidden md:flex md:items-center md:space-x-6">
                <a href="{{ url('/') }}" class="text-gray-600 hover:text-primary-600 transition-colors duration-200 @if(Request::is('/')) font-bold text-primary-600 @endif">
                    Ballina
                </a>

                <div x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false" class="relative">
                    <button class="flex items-center text-gray-600 hover:text-primary-600 transition-colors duration-200 @if(Request::is('rrethNesh') || Request::is('anetaret')) font-bold text-primary-600 @endif">
                        Rreth Nesh
                        <svg class="w-4 h-4 ml-1 transform transition-transform duration-200" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                    <div x-show="open" x-transition class="absolute bg-white shadow-lg rounded-md mt-2 w-48 py-2 z-10">
                        <a href="{{ route('rrethNesh') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 @if(Request::is('rrethNesh')) font-bold text-primary-600 @endif">
                            Rreth Nesh
                        </a>
                        <a href="{{ route('anetaret') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 @if(Request::is('anetaret')) font-bold text-primary-600 @endif">
                            Anëtarët e këshillit
                        </a>
                    </div>
                </div>

                <div x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false" class="relative">
                    <button class="flex items-center text-gray-600 hover:text-primary-600 transition-colors duration-200 @if(Request::is('konferencat') || Request::is('konferenca/*')) font-bold text-primary-600 @endif">
                        Konferenca
                        <svg class="w-4 h-4 ml-1 transform transition-transform duration-200" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                    <div x-show="open" x-transition class="absolute bg-white shadow-lg rounded-md mt-2 w-72 py-2 z-10">
                        @php
                        $recentConferences = App\Models\Conference::where('isActive', true)->orderBy('date', 'desc')->limit(4)->get();
                        @endphp
                        @foreach($recentConferences as $conference)
                        <a href="{{ route('showConference', $conference) }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 @if(Request::url() === route('showConference', $conference)) font-bold text-primary-600 @endif">
                            {{ $conference->title }} ({{ $conference->date->format('Y') }})
                        </a>
                        @endforeach
                        <hr class="my-1 border-gray-200">
                        <a href="{{ route('conferences') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 @if(Request::is('konferencat')) font-bold text-primary-600 @endif">
                            Të gjitha konferencat
                        </a>
                    </div>
                </div>

                <a href="{{ route('dokumentet') }}" class="text-gray-600 hover:text-primary-600 transition-colors duration-200 @if(Request::is('dokumentet')) font-bold text-primary-600 @endif">
                    Dokumentet
                </a>

                <div x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false" class="relative">
                    <button class="flex items-center text-gray-600 hover:text-primary-600 transition-colors duration-200 @if(Request::is('njoftimet*') || Request::is('njoftim/*')) font-bold text-primary-600 @endif">
                        Njoftime
                        <svg class="w-4 h-4 ml-1 transform transition-transform duration-200" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                    <div x-show="open" x-transition class="absolute bg-white shadow-lg rounded-md mt-2 w-48 py-2 z-10">
                        <a href="{{ route('njoftimet') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 @if(Request::fullUrl() === route('njoftimet')) font-bold text-primary-600 @endif">
                            Të Gjitha
                        </a>
                        <a href="{{ url('/njoftimet?filter=Lajm') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 @if(Request::fullUrl() === url('/njoftimet?filter=Lajm')) font-bold text-primary-600 @endif">
                            Lajm
                        </a>
                        <a href="{{ url('/njoftimet?filter=Konkurs') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 @if(Request::fullUrl() === url('/njoftimet?filter=Konkurs')) font-bold text-primary-600 @endif">
                            Konkurs
                        </a>
                        <a href="{{ url('/njoftimet?filter=Komunikatë') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 @if(Request::fullUrl() === url('/njoftimet?filter=Komunikatë')) font-bold text-primary-600 @endif">
                            Komunikatë
                        </a>
                    </div>
                </div>
            </div>
        </nav>
        <div id="mobileMenu" class="md:hidden bg-white shadow-lg hidden">
            <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3">
                <a href="{{ url('/') }}" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:bg-gray-50 hover:text-primary-600 @if(Request::is('/')) bg-gray-100 text-primary-600 @endif">
                    Ballina
                </a>
                <div x-data="{ open: false }">
                    <button @click="open = !open" class="w-full flex justify-between items-center px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:bg-gray-50 hover:text-primary-600">
                        Rreth Nesh
                        <svg :class="{ 'rotate-180': open }" class="w-4 h-4 ml-1 transform transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                    <div x-show="open" class="mt-2 space-y-1 pl-4">
                        <a href="{{ route('rrethNesh') }}" class="block px-3 py-2 rounded-md text-sm font-medium text-gray-600 hover:bg-gray-100 @if(Request::is('rrethNesh')) font-bold text-primary-600 @endif">
                            Rreth Nesh
                        </a>
                        <a href="{{ route('anetaret') }}" class="block px-3 py-2 rounded-md text-sm font-medium text-gray-600 hover:bg-gray-100 @if(Request::is('anetaret')) font-bold text-primary-600 @endif">
                            Anëtarët e këshillit
                        </a>
                    </div>
                </div>
                <div x-data="{ open: false }">
                    <button @click="open = !open" class="w-full flex justify-between items-center px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:bg-gray-50 hover:text-primary-600">
                        Konferenca
                        <svg :class="{ 'rotate-180': open }" class="w-4 h-4 ml-1 transform transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                    <div x-show="open" class="mt-2 space-y-1 pl-4">
                        @foreach($recentConferences as $conference)
                        <a href="{{ route('showConference', $conference) }}" class="block px-3 py-2 rounded-md text-sm font-medium text-gray-600 hover:bg-gray-100 @if(Request::url() === route('showConference', $conference)) font-bold text-primary-600 @endif">
                            {{ $conference->title }} ({{ $conference->date->format('Y') }})
                        </a>
                        @endforeach
                        <hr class="my-1 border-gray-200">
                        <a href="{{ route('conferences') }}" class="block px-3 py-2 rounded-md text-sm font-medium text-gray-600 hover:bg-gray-100 @if(Request::is('konferencat')) font-bold text-primary-600 @endif">
                            Të gjitha konferencat
                        </a>
                    </div>
                </div>
                <a href="{{ route('dokumentet') }}" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:bg-gray-50 hover:text-primary-600 @if(Request::is('dokumentet')) bg-gray-100 text-primary-600 @endif">
                    Dokumentet
                </a>
                <div x-data="{ open: false }">
                    <button @click="open = !open" class="w-full flex justify-between items-center px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:bg-gray-50 hover:text-primary-600">
                        Njoftime
                        <svg :class="{ 'rotate-180': open }" class="w-4 h-4 ml-1 transform transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                    <div x-show="open" class="mt-2 space-y-1 pl-4">
                        <a href="{{ route('njoftimet') }}" class="block px-3 py-2 rounded-md text-sm font-medium text-gray-600 hover:bg-gray-100 @if(Request::fullUrl() === route('njoftimet')) font-bold text-primary-600 @endif">
                            Të Gjitha
                        </a>
                        <a href="{{ url('/njoftimet?filter=Lajm') }}" class="block px-3 py-2 rounded-md text-sm font-medium text-gray-600 hover:bg-gray-100 @if(Request::fullUrl() === url('/njoftimet?filter=Lajm')) font-bold text-primary-600 @endif">
                            Lajm
                        </a>
                        <a href="{{ url('/njoftimet?filter=Konkurs') }}" class="block px-3 py-2 rounded-md text-sm font-medium text-gray-600 hover:bg-gray-100 @if(Request::fullUrl() === url('/njoftimet?filter=Konkurs')) font-bold text-primary-600 @endif">
                            Konkurs
                        </a>
                        <a href="{{ url('/njoftimet?filter=Komunikatë') }}" class="block px-3 py-2 rounded-md text-sm font-medium text-gray-600 hover:bg-gray-100 @if(Request::fullUrl() === url('/njoftimet?filter=Komunikatë')) font-bold text-primary-600 @endif">
                            Komunikatë
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <main class="mt-[70px] flex-grow">
        @yield('content')
    </main>

    <footer class="bg-gray-900 text-gray-300 py-10">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div class="col-span-1 md:col-span-2">
                    <img src="https://uni-gjilan.net/wp-content/themes/kadrizeka/img/uni-gjilan_sq.png" alt="UKZ Logo" class="h-16 sm:h-20 mb-4" />
                    <p class="text-sm">
                        Këshilli i Rektorëve të Universiteteve Publike të Kosovës (KRUPK) është një organ kolektiv që përfaqëson dhe koordinon aktivitetet e universiteteve publike në vend. Misioni ynë është të sigurojmë cilësi në arsimin e lartë, të promovojmë kërkimin shkencor dhe të kontribuojmë në zhvillimin e shoqërisë.
                    </p>
                </div>
                <div>
                    <h3 class="font-semibold text-white mb-4 uppercase tracking-wider">Kontakt</h3>
                    <p class="text-sm mb-2">
                        “Zija Shemsiu” nr.183. 60000 Gjilan<br />
                        Tel: +383 280-390-112<br />
                        Mob: +383 45-800-025<br />
                        e-mail: info@uni-gjilan.net
                    </p>
                    <div class="flex space-x-4 mt-4">
                        <a href="#" class="text-gray-400 hover:text-white transition-colors duration-200">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white transition-colors duration-200">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white transition-colors duration-200">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                    </div>
                </div>
                <div>
                    <h3 class="font-semibold text-white mb-4 uppercase tracking-wider">Linqet</h3>
                    <ul class="space-y-2 text-sm">
                        <li>
                            <a href="{{ route('anetaret') }}" class="hover:text-white transition-colors duration-200">Anëtarët e këshillit</a>
                        </li>
                        <li>
                            <a href="{{ route('dokumentet') }}" class="hover:text-white transition-colors duration-200">Dokumentet</a>
                        </li>
                        <li>
                            <a href="{{ route('conferences') }}" class="hover:text-white transition-colors duration-200">Konferencat</a>
                        </li>
                        <li>
                            <a href="{{ route('njoftimet') }}" class="hover:text-white transition-colors duration-200">Njoftimet</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="mt-8 border-t border-gray-700 pt-6 text-center text-xs text-gray-400">
                <small>Copyright © 2024 Këshilli i Rektorëve. Të gjitha të drejtat e rezervuara.</small>
            </div>
        </div>
    </footer>

    <script src="//unpkg.com/alpinejs" defer></script>
    <script>
        document.getElementById('mobileMenuBtn').addEventListener('click', function() {
            const menu = document.getElementById('mobileMenu');
            menu.classList.toggle('hidden');
        });
    </script>
    @stack('scripts')
</body>
</html>
