{{-- This component can be included for both desktop sidebar and offcanvas sidebar --}}
@php
    // Prefix IDs to ensure uniqueness between desktop and offcanvas menus
    $prefix = $isOffcanvas ? 'offcanvas-' : '';
@endphp

{{-- Brand/Logo for desktop sidebar (Offcanvas has its own header) --}}
@unless($isOffcanvas)
    <a href="{{ route('admin.index') }}" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-primary text-decoration-none">
        <span class="fs-5 fw-bold">[Logo] Rectors' Council</span>
    </a>
    <hr>
@endunless

<ul class="nav nav-pills flex-column mb-auto">
    <li class="nav-item mb-1">
        {{-- Dashboard link now points to admin.index as a placeholder --}}
        <a href="{{ route('admin.index') }}" class="nav-link link-dark {{ request()->routeIs('admin.index') ? 'active' : '' }}" aria-current="page">
            <i class="bi bi-speedometer2 me-2"></i> Dashboard
        </a>
    </li>

    {{-- User Management --}}
    <li class="nav-item mb-1">
        <button class="btn btn-toggle align-items-center rounded collapsed nav-link link-dark" data-bs-toggle="collapse" data-bs-target="#{{ $prefix }}user-collapse" aria-expanded="{{ request()->routeIs('admin.*') ? 'true' : 'false' }}">
            <i class="bi bi-people me-2"></i> User Management
        </button>
        <div class="collapse {{ request()->routeIs('admin.*') ? 'show' : '' }}" id="{{ $prefix }}user-collapse">
            <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                <li><a href="{{ route('admin.index') }}" class="nav-link link-dark rounded {{ request()->routeIs('admin.index', 'admin.edit') ? 'active' : '' }}">List Admins</a></li>
                <li><a href="{{ route('admin.create') }}" class="nav-link link-dark rounded {{ request()->routeIs('admin.create') ? 'active' : '' }}">Create Admin</a></li>
            </ul>
        </div>
    </li>

    {{-- Council Members - Using # as placeholder for now --}}
    <li class="nav-item mb-1">
        <button class="btn btn-toggle align-items-center rounded collapsed nav-link link-dark" data-bs-toggle="collapse" data-bs-target="#{{ $prefix }}members-collapse" aria-expanded="false">
            <i class="bi bi-person-fill me-2"></i> Council Members
        </button>
        <div class="collapse" id="{{ $prefix }}members-collapse">
            <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                <li><a href="#" class="nav-link link-dark rounded">All Members</a></li>
                <li><a href="#" class="nav-link link-dark rounded">Add Member</a></li>
            </ul>
        </div>
    </li>

    {{-- Notifications - Using # as placeholder for now --}}
    <li class="nav-item mb-1">
        <button class="btn btn-toggle align-items-center rounded collapsed nav-link link-dark" data-bs-toggle="collapse" data-bs-target="#{{ $prefix }}notifications-collapse" aria-expanded="false">
            <i class="bi bi-bell me-2"></i> Notifications
        </button>
        <div class="collapse" id="{{ $prefix }}notifications-collapse">
            <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                <li><a href="#" class="nav-link link-dark rounded">All Notifications</a></li>
                <li>
                    <button class="btn btn-toggle align-items-center rounded collapsed nav-link link-dark ms-3" data-bs-toggle="collapse" data-bs-target="#{{ $prefix }}create-notification-collapse" aria-expanded="false">
                        Create Notification
                    </button>
                    <div class="collapse" id="{{ $prefix }}create-notification-collapse">
                        <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                            <li><a href="#" class="nav-link link-dark rounded">News</a></li>
                            <li><a href="#" class="nav-link link-dark rounded">Competition</a></li>
                            <li><a href="#" class="nav-link link-dark rounded">Press Release</a></li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
    </li>

    {{-- Documents - Using # as placeholder for now --}}
    <li class="nav-item mb-1">
        <button class="btn btn-toggle align-items-center rounded collapsed nav-link link-dark" data-bs-toggle="collapse" data-bs-target="#{{ $prefix }}documents-collapse" aria-expanded="false">
            <i class="bi bi-file-earmark-text me-2"></i> Documents
        </button>
        <div class="collapse" id="{{ $prefix }}documents-collapse">
            <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                <li><a href="#" class="nav-link link-dark rounded">All Documents</a></li>
                <li><a href="#" class="nav-link link-dark rounded">Upload Document</a></li>
            </ul>
        </div>
    </li>

    {{-- Conferences - Using # as placeholder for now --}}
    <li class="nav-item mb-1">
        <button class="btn btn-toggle align-items-center rounded collapsed nav-link link-dark" data-bs-toggle="collapse" data-bs-target="#{{ $prefix }}conferences-collapse" aria-expanded="false">
            <i class="bi bi-calendar-event me-2"></i> Conferences
        </button>
        <div class="collapse" id="{{ $prefix }}conferences-collapse">
            <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                <li><a href="#" class="nav-link link-dark rounded">Upcoming Conferences</a></li>
                <li><a href="#" class="nav-link link-dark rounded">Past Conferences</a></li>
                <li><a href="#" class="nav-link link-dark rounded">Add Conference</a></li>
            </ul>
        </div>
    </li>
</ul>

<hr>

{{-- User Profile Dropdown --}}
<div class="dropdown">
    <a href="#" class="d-flex align-items-center link-dark text-decoration-none dropdown-toggle" id="{{ $prefix }}dropdownUser2" data-bs-toggle="dropdown" aria-expanded="false">
        <img src="https://github.com/mdo.png" alt="" width="32" height="32" class="rounded-circle me-2">
        <strong>{{ Auth::user()->name ?? 'Admin' }}</strong>
    </a>
    <ul class="dropdown-menu text-small shadow" aria-labelledby="{{ $prefix }}dropdownUser2">
        {{-- Profile Settings - Using # as placeholder for now --}}
        <li><a class="dropdown-item" href="#">Profile Settings</a></li>
        <li><hr class="dropdown-divider"></li>
        <li>
            {{-- Logout form - This route is defined --}}
            <form action="{{ route('logout') }}" method="POST" class="dropdown-item p-0">
                @csrf
                <button type="submit" class="btn btn-link text-decoration-none text-dark w-100 text-start ps-3 py-2">Sign out</button>
            </form>
        </li>
    </ul>
</div>
