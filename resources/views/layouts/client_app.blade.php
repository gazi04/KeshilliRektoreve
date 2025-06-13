<!DOCTYPE html>
<html lang="sq">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>@yield('title', 'Universiteti Publik Kadri Zeka')</title>
        <link rel="icon" href="data:," />
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
            rel="stylesheet"
        />
        <link rel="stylesheet" href="{{ asset('style.css') }}" />

        @stack('styles')
    </head>
    <body style="margin: 0; padding: 0; box-sizing: border-box">

        <header class="bg-white shadow-sm">
            <nav
                class="sticky-top bg-primary navbar navbar-expand-lg border-bottom border-warning border-4"
            >
                <div class="container-fluid">
                    <a class="navbar-brand" href="{{ url('/') }}">
                        <img
                            src="https://uni-gjilan.net/wp-content/themes/kadrizeka/img/uni-gjilan_sq.png"
                            alt="Bootstrap"
                            width="160"
                            height="50"
                        />
                    </a>
                    <button
                        class="navbar-toggler bg-light"
                        type="button"
                        data-bs-toggle="collapse"
                        data-bs-target="#navbarNav"
                        aria-controls="navbarNav"
                        aria-expanded="false"
                        aria-label="Toggle navigation"
                    >
                        <span class="navbar-toggler-icon text-light"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul style="margin-left: auto; margin-right: 5%" class="navbar-nav">
                            <li class="nav-item">
                                <a
                                    class="nav-link @if(Request::is('/')) active text-warning @else text-light @endif"
                                    aria-current="page"
                                    href="{{ url('/') }}"
                                >Ballina</a
                                >
                            </li>
                            <li class="nav-item dropdown">
                                <a
                                    class="nav-link dropdown-toggle @if(Request::is('rrethNesh') || Request::is('anetaret')) active text-warning @else text-light @endif"
                                    href="#"
                                    role="button"
                                    data-bs-toggle="dropdown"
                                    aria-expanded="false"
                                >
                                    Rreth Nesh
                                </a>
                                <ul class="dropdown-menu bg-primary border-0">
                                    <li>
                                        <a class="dropdown-item text-white bg-primary @if(Request::is('rrethNesh')) active @endif"
                                            href="{{ route('rrethNesh') }}"
                                            onmouseover="this.classList.add('bg-white', 'text-primary'); this.classList.remove('bg-primary', 'text-white')"
                                            onmouseout="this.classList.add('bg-primary', 'text-white'); this.classList.remove('bg-white', 'text-primary')"
                                        >Rreth Nesh</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item text-white bg-primary @if(Request::is('anetaret')) active @endif"
                                            href="{{ route('anetaret') }}"
                                            onmouseover="this.classList.add('bg-white', 'text-primary'); this.classList.remove('bg-primary', 'text-white')"
                                            onmouseout="this.classList.add('bg-primary', 'text-white'); this.classList.remove('bg-white', 'text-primary')"
                                        >Anëtarët e këshillit</a>
                                    </li>
                                </ul>
                            </li>

                            <li class="nav-item dropdown">
                                <a
                                    class="nav-link dropdown-toggle @if(Request::is('konferencat') || Request::is('konferenca/*')) active text-warning @else text-light @endif"
                                    href="#"
                                    role="button"
                                    data-bs-toggle="dropdown"
                                    aria-expanded="false"
                                >
                                    Konferenca
                                </a>
                                <ul class="dropdown-menu bg-primary border-0">
                                    @php
                                    $recentConferences = App\Models\Conference::where('isActive', true)
                                    ->orderBy('date', 'desc')
                                    ->limit(4)
                                    ->get();
                                    @endphp

                                    @foreach($recentConferences as $conference)
                                    <li>
                                        <a class="dropdown-item text-white bg-primary @if(Request::url() === route('showConference', $conference)) active @endif"
                                            href="{{ route('showConference', $conference) }}"
                                            onmouseover="this.classList.add('bg-white', 'text-primary'); this.classList.remove('bg-primary', 'text-white')"
                                            onmouseout="this.classList.add('bg-primary', 'text-white'); this.classList.remove('bg-white', 'text-primary')">
                                            {{ $conference->title }} ({{ $conference->date->format('Y') }})
                                        </a>
                                    </li>
                                    @endforeach

                                    <li><hr class="dropdown-divider bg-white"></li>
                                    <li>
                                        <a class="dropdown-item text-white bg-primary @if(Request::is('konferencat')) active @endif"
                                            href="{{ route('conferences') }}"
                                            onmouseover="this.classList.add('bg-white', 'text-primary'); this.classList.remove('bg-primary', 'text-white')"
                                            onmouseout="this.classList.add('bg-primary', 'text-white'); this.classList.remove('bg-white', 'text-primary')">
                                            Të gjitha konferencat
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <li class="nav-item">
                                <a
                                    class="nav-link @if (Request::is('dokumentet')) active text-warning @else text-white @endif "
                                    aria-current="page"
                                    href="{{ route('dokumentet') }}"
                                >Dokumentet</a
                                >
                            </li>
                            <li class="nav-item dropdown">
                                <a
                                    class="nav-link dropdown-toggle @if(Request::is('njoftimet*') || Request::is('njoftim/*')) active text-warning @else text-light @endif"
                                    href="#"
                                    role="button"
                                    data-bs-toggle="dropdown"
                                    aria-expanded="false"
                                >
                                    Njoftime
                                </a>
                                <ul class="dropdown-menu bg-primary border-0" style="justify-self: flex-start">
                                    <li>
                                        <a class="dropdown-item text-white bg-primary @if(Request::fullUrl() === route('njoftimet')) active @endif"
                                            href="{{ route('njoftimet') }}"
                                            onmouseover="this.classList.add('bg-white','text-primary'); this.classList.remove('bg-primary','text-white')"
                                            onmouseout="this.classList.add('bg-primary','text-white'); this.classList.remove('bg-white','text-primary')"
                                        >Të Gjitha</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item text-white bg-primary @if(Request::fullUrl() === url('/njoftimet?filter=Lajm')) active @endif"
                                            href="{{ url('/njoftimet?filter=Lajm') }}"
                                            onmouseover="this.classList.add('bg-white','text-primary'); this.classList.remove('bg-primary','text-white')"
                                            onmouseout="this.classList.add('bg-primary','text-white'); this.classList.remove('bg-white','text-primary')"
                                        >Lajm</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item text-white bg-primary @if(Request::fullUrl() === url('/njoftimet?filter=Konkurs')) active @endif"
                                            href="{{ url('/njoftimet?filter=Konkurs') }}"
                                            onmouseover="this.classList.add('bg-white','text-primary'); this.classList.remove('bg-primary','text-white')"
                                            onmouseout="this.classList.add('bg-primary','text-white'); this.classList.remove('bg-white','text-primary')"
                                        >Konkurs</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item text-white bg-primary @if(Request::fullUrl() === url('/njoftimet?filter=Komunikatë')) active @endif"
                                            href="{{ url('/njoftimet?filter=Komunikatë') }}"
                                            onmouseover="this.classList.add('bg-white','text-primary'); this.classList.remove('bg-primary','text-white')"
                                            onmouseout="this.classList.add('bg-primary','text-white'); this.classList.remove('bg-white','text-primary')"
                                        >Komunikatë</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </header>

        @yield('content')

        <footer class="bg-primary text-light pt-4 pb-2 border-top border-warning border-4">
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-3">
                    <img src="https://uni-gjilan.net/wp-content/themes/kadrizeka/img/uni-gjilan_sq.png" alt="UKZ Logo" width="200" height="70" />
                </div>

                <div class="col-md-4 mb-3">
                    <p><strong>KONTAKT</strong></p>
                    <p>
                        “Zija Shemsiu” nr.183. 60000 Gjilan<br />
                        Tel: +383 280-390-112<br />
                        Mob: +383 45-800-025<br />
                        e-mail: info@uni-gjilan.net
                    </p>
                </div>

                <div class="col-md-4 mb-3">
                    <p><strong>Linqet</strong></p>
                    <ul class="list-unstyled">
                        <li>
                            <a href="{{ route('anetaret') }}" class="text-light text-decoration-none">Anëtarët e këshillit</a>
                        </li>
                        <li>
                            <a href="{{ route('dokumentet') }}" class="text-light text-decoration-none">Dokumentet</a>
                        </li>
                        <li>
                            <a href="{{ route('conferences') }}" class="text-light text-decoration-none">Konferencat</a>
                        </li>
                        <li>
                            <a href="{{ route('njoftimet') }}" class="text-light text-decoration-none">Njoftimet</a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="text-center mt-4 border-top pt-3">
                <small>Copyright © 2017 Universiteti Publik KADRI ZEKA Gjilan</small>
            </div>
        </div>
    </footer>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
        @stack('scripts')
    </body>
</html>
