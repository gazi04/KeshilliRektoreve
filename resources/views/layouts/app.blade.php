<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <title>@yield('title')</title>
    <style>
        body {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .page-wrapper {
            display: flex;
            flex-grow: 1;
        }

        .main-content {
            flex-grow: 1;
            padding: 1.5rem;
        }

        .btn-toggle {
            display: inline-flex;
            align-items: center;
            padding: .25rem .5rem;
            font-weight: 600;
            color: rgba(0, 0, 0, .65);
            background-color: transparent;
            border: 0;
            width: 100%;
            text-align: left;
        }
        .btn-toggle:hover,
        .btn-toggle:focus {
            color: rgba(0, 0, 0, .85);
            background-color: #e2e6ea;
            outline: none;
        }
        .btn-toggle::before {
            width: 1.25em;
            line-height: 0;
            content: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='rgba%280,0,0,.5%29' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M5 14l6-6-6-6'/%3e%3c/svg%3e");
            transition: transform .35s ease;
            transform-origin: .5em 50%;
            margin-left: auto;
        }
        .btn-toggle[aria-expanded="true"] {
            color: rgba(0, 0, 0, .85);
        }
        .btn-toggle[aria-expanded="true"]::before {
            transform: rotate(90deg);
        }
        .btn-toggle-nav a {
            padding: .1875rem .5rem;
            margin-top: .125rem;
            margin-left: 1.5rem;
            display: block;
        }
        .btn-toggle-nav a:hover,
        .btn-toggle-nav a:focus {
            background-color: #dee2e6;
        }

        .nav-link.active {
            background-color: var(--bs-primary) !important;
            color: white !important;
        }

        .sidebar-desktop {
            width: 280px;
            flex-shrink: 0;
            border-right: 1px solid rgba(0, 0, 0, .125);
            background-color: #f8f9fa;
            height: 100vh;
            overflow-y: auto;
            position: sticky;
            top: 0;
        }

        @media (max-width: 1399.98px) {
            .sidebar-desktop {
                display: none;
            }
            .main-content {
                margin-top: 56px;
            }
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-xxl navbar-light bg-light border-bottom d-xxl-none fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand text-primary fw-bold" href="#">[Logo] Rectors' Council</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasSidebar" aria-controls="offcanvasSidebar" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
    </nav>

    <div class="page-wrapper">
        <aside class="sidebar-desktop d-none d-xxl-block p-3">
            @include('components.sidebar', ['isOffcanvas' => false])
        </aside>

        <div class="offcanvas offcanvas-start bg-light" tabindex="-1" id="offcanvasSidebar" aria-labelledby="offcanvasSidebarLabel">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title text-primary fw-bold" id="offcanvasSidebarLabel">[Logo] Rectors' Council</h5>
                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body d-flex flex-column">
                @include('components.sidebar', ['isOffcanvas' => true])
            </div>
        </div>

        <main class="main-content">
            <div class="container-fluid">
                @yield('content')
            </div>
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
</body>
</html>
