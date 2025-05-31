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
            /* Ensure body takes full viewport height and uses flexbox for overall layout */
            min-height: 100vh;
            display: flex;
            flex-direction: column; /* Stack vertically for overall flex layout */
        }

        /* Styles for the main content wrapper when sidebar is present */
        .page-wrapper {
            display: flex;
            flex-grow: 1; /* Allow content to grow and fill available space */
        }

        /* Main content area padding for when sidebar is fixed/present */
        .main-content {
            flex-grow: 1; /* Allows main content to fill remaining width */
            padding: 1.5rem; /* Default padding for content area */
        }

        /* Custom styles for Bootstrap toggle buttons in sidebar (for nested menus) */
        .btn-toggle {
            display: inline-flex;
            align-items: center;
            padding: .25rem .5rem;
            font-weight: 600;
            color: rgba(0, 0, 0, .65);
            background-color: transparent;
            border: 0;
            width: 100%; /* Ensure button takes full width */
            text-align: left; /* Align text to left */
        }
        .btn-toggle:hover,
        .btn-toggle:focus {
            color: rgba(0, 0, 0, .85);
            background-color: #e2e6ea;
            outline: none; /* Remove default focus outline */
        }
        /* Arrow icon for collapsible menus */
        .btn-toggle::before {
            width: 1.25em;
            line-height: 0;
            content: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='rgba%280,0,0,.5%29' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M5 14l6-6-6-6'/%3e%3c/svg%3e");
            transition: transform .35s ease;
            transform-origin: .5em 50%;
            margin-left: auto; /* Push arrow to the right */
        }
        .btn-toggle[aria-expanded="true"] {
            color: rgba(0, 0, 0, .85);
        }
        .btn-toggle[aria-expanded="true"]::before {
            transform: rotate(90deg);
        }
        /* Styling for nested nav links in collapsible menus */
        .btn-toggle-nav a {
            padding: .1875rem .5rem;
            margin-top: .125rem;
            margin-left: 1.5rem; /* Indent nested links */
            display: block; /* Ensure links take full width for padding/hover */
        }
        .btn-toggle-nav a:hover,
        .btn-toggle-nav a:focus {
            background-color: #dee2e6;
        }

        /* Active link styling */
        .nav-link.active {
            background-color: var(--bs-primary) !important;
            color: white !important;
        }

        /* Sidebar specific styles */
        .sidebar-desktop {
            width: 280px; /* Fixed width for desktop sidebar */
            flex-shrink: 0; /* Prevent sidebar from shrinking */
            border-right: 1px solid rgba(0, 0, 0, .125); /* Separator border */
            background-color: #f8f9fa; /* Light background */
            height: 100vh; /* Take full viewport height */
            overflow-y: auto; /* Enable scrolling for long content */
            position: sticky; /* Make it sticky */
            top: 0; /* Stick to the top */
        }

        /* Hide desktop sidebar and adjust main content on small screens */
        @media (max-width: 991.98px) { /* Bootstrap's lg breakpoint */
            .sidebar-desktop {
                display: none; /* Hide the static sidebar on small screens */
            }
            .main-content {
                /* Add top margin if you have a fixed top navbar for the offcanvas toggle */
                margin-top: 56px; /* Adjust if your top navbar height is different */
            }
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom d-lg-none fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand text-primary fw-bold" href="#">[Logo] Rectors' Council</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasSidebar" aria-controls="offcanvasSidebar" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
    </nav>

    <div class="page-wrapper">
        <aside class="sidebar-desktop d-none d-lg-block p-3">
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
