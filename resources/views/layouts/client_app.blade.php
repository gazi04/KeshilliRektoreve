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
                  class="nav-link dropdown-toggle text-light"
                  href="#"
                  role="button"
                  data-bs-toggle="dropdown"
                  aria-expanded="false"
                >
                  Rreth Nesh
                </a>
                <ul class="dropdown-menu bg-primary border-0">
                  <li>
                    <a class="dropdown-item text-white bg-primary"
                       href="{{ route('rrethNesh') }}"
                       onmouseover="this.classList.add('bg-white', 'text-primary'); this.classList.remove('bg-primary', 'text-white')"
                       onmouseout="this.classList.add('bg-primary', 'text-white'); this.classList.remove('bg-white', 'text-primary')"
                    >Rreth Nesh</a>
                  </li>
                  <li>
                    <a class="dropdown-item text-white bg-primary"
                       href="{{ route('anetaret') }}"
                       onmouseover="this.classList.add('bg-white', 'text-primary'); this.classList.remove('bg-primary', 'text-white')"
                       onmouseout="this.classList.add('bg-primary', 'text-white'); this.classList.remove('bg-white', 'text-primary')"
                    >Anëtarët e këshillit</a>
                  </li>
                </ul>
              </li>

                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle text-light" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Konferenca
                                </a>
                                <ul class="dropdown-menu bg-primary border-0">
                                    @php
                                    $recentConferences = App\Models\Conference::where('isActive', true)
                                    ->orderBy('date', 'desc')
                                    ->limit(2)
                                    ->get();
                                    @endphp

                                    @foreach($recentConferences as $conference)
                                    <li>
                                        <a class="dropdown-item text-white bg-primary"
                                            href="{{ route('showConference', $conference) }}"
                                            onmouseover="this.classList.add('bg-white', 'text-primary'); this.classList.remove('bg-primary', 'text-white')"
                                            onmouseout="this.classList.add('bg-primary', 'text-white'); this.classList.remove('bg-white', 'text-primary')">
                                            {{ $conference->title }} ({{ $conference->date->format('Y') }})
                                        </a>
                                    </li>
                                    @endforeach

                                    <li><hr class="dropdown-divider bg-white"></li>
                                    <li>
                                        <a class="dropdown-item text-white bg-primary"
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
                  class="nav-link text-light @if(Request::is('dokumentet')) active text-warning @endif"
                  aria-current="page"
u                 href="{{ route('dokumentet') }}"
                  >Dokumentet</a
                >
              </li>
            <li class="nav-item dropdown">
              <a
                class="nav-link dropdown-toggle text-light"
                href="#"
                role="button"
                data-bs-toggle="dropdown"
                aria-expanded="false"
              >
                Njoftime
              </a>
              <ul class="dropdown-menu bg-primary border-0" style="justify-self: flex-start">
                <li>
                  <a class="dropdown-item text-white bg-primary"
                     href="{{ route('njoftimet') }}"
                     onmouseover="this.classList.add('bg-white','text-primary'); this.classList.remove('bg-primary','text-white')"
                     onmouseout="this.classList.add('bg-primary','text-white'); this.classList.remove('bg-white','text-primary')"
                  >Të Gjitha</a>
                </li>
                <li>
                  <a class="dropdown-item text-white bg-primary"
                     href="{{ url('/njoftimet?filter=Lajm') }}"
                     onmouseover="this.classList.add('bg-white','text-primary'); this.classList.remove('bg-primary','text-white')"
                     onmouseout="this.classList.add('bg-primary','text-white'); this.classList.remove('bg-white','text-primary')"
                  >Lajm</a>
                </li>
                <li>
                  <a class="dropdown-item text-white bg-primary"
                     href="{{ url('/njoftimet?filter=Konkurs') }}"
                     onmouseover="this.classList.add('bg-white','text-primary'); this.classList.remove('bg-primary','text-white')"
                     onmouseout="this.classList.add('bg-primary','text-white'); this.classList.remove('bg-white','text-primary')"
                  >Konkurs</a>
                </li>
                <li>
                  <a class="dropdown-item text-white bg-primary"
                     href="{{ url('/njoftimet?filter=Komunikatë') }}"
                     onmouseover="this.classList.add('bg-white','text-primary'); this.classList.remove('bg-primary','text-white')"
                     onmouseout="this.classList.add('bg-primary','text-white'); this.classList.remove('bg-white','text-primary')"
                  >Komunikatë</a>
                </li>
              </ul>
            </li>
            <li class="nav-item d-flex align-items-center" style="margin-top: 2px;">
              <a
                class="btn btn-sm text-primary bg-white rounded-pill"
                href="{{ route('naKontakto') }}"
                style="font-weight: bold; border: 1.5px solid #0d6efd; transition: 0.3s"
                onmouseover="this.classList.remove('bg-white'); this.classList.add('bg-primary', 'text-white')"
                onmouseout="this.classList.remove('bg-primary', 'text-white'); this.classList.add('bg-white', 'text-primary')"
              >
                Na kontaktoni
              </a>
            </li>

            </ul>
          </div>
        </div>
      </nav>
    </header>

    @yield('content')

    <footer
      class="d-flex justify-content-center align-items-center bg-primary text-light mt-5 py-4 border-top border-warning border-4"
    >
      <div class="container d-flex justify-content-center gap-3 text-center">
        <p class="mb-0">
          Copyright © {{ date('Y') }} Universiteti Publik KADRI ZEKA Gjilan
        </p>
      </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
  </body>
</html>
