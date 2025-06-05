@extends('layouts.app')

@section('title', 'Këshilli Rektorëve - Administratorët')

@section('content')
<div class="container mt-4">
    <h1 class="text-center text-primary mb-4">Admin Users</h1>

    {{-- Success/Error Messages --}}
    @if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    @if (session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap flex-column">
       

        {{-- Search and Filter Form --}}
        <form action="{{ route('admin.index') }}" method="GET" class="d-flex flex-wrap gap-2 flex-grow-1 justify-content-end w-100" x-data="{
            search: '{{ request('search') }}',
            status: '{{ request('status') }}',
            orderBy: '{{ request('order_by') }}',
            init() {
                this.$watch('status', value => this.submitForm());
                this.$watch('orderBy', value => this.submitForm());
            },
            submitForm() {
                this.$el.submit();
            }
            }">
            <div class="w-100 d-flex flex-wrap gap-2 mb-2 mb-md-0">
                 <a href="{{ route('admin.create') }}" class="btn btn-success mb-2 mb-md-0" >Create Admin</a>
                <input type="text" name="search" x-model="search" placeholder="Search admins..." class="form-control me-2 flex-grow-1 w-50" >
            <div class="d-flex gap-2"><button type="submit" class="btn btn-outline-primary">Search</button>
             @if (request()->filled('search') || request()->filled('status') || request()->filled('order_by'))
            <a href="{{ route('admin.index') }}" class="btn btn-outline-secondary">Reset</a>
            @endif</div>
                
            </div>
            
           
            <select name="status" x-model="status" class="form-select me-2">
                <option value="all">All Statuses</option>
                <option value="active">Active</option>
                <option value="inactive">Inactive</option>
            </select>
            <select name="order_by" x-model="orderBy" class="form-select me-2">
                <option value="latest">Order by Latest</option>
                <option value="name_asc">Name (A-Z)</option>
                <option value="name_desc">Name (Z-A)</option>
                <option value="lastname_asc">Last Name (A-Z)</option>
                <option value="lastname_desc">Last Name (Z-A)</option>
                <option value="email_asc">Email (A-Z)</option>
                <option value="email_desc">Email (Z-A)</option>
                <option value="username_asc">Username (A-Z)</option>
                <option value="username_desc">Username (Z-A)</option>
            </select>
        </form>
    </div>

    <div class="card">
        <div class="card-header">
            @if(request('type'))
            {{ request('type') }} ({{ $admins->total() }})
            @else
            All Admins ({{ $admins->total() }})
            @endif
        </div>
        <div class="card-body">
            {{-- Table View - Visible on XL screens and up (>= 1200px) --}}
            <div class="table-responsive d-none d-xl-block">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>
                                <a href="{{ route('admin.index', array_merge(request()->query(), ['order_by' => (request('order_by') == 'name_asc' ? 'name_desc' : 'name_asc')])) }}" class="text-black text-decoration-none d-flex align-items-center justify-content-between">
                                    Name
                                    @if (request('order_by') == 'name_asc')
                                    <i class="bi bi-arrow-up ms-1"></i>
                                    @elseif (request('order_by') == 'name_desc')
                                    <i class="bi bi-arrow-down ms-1"></i>
                                    @endif
                                </a>
                            </th>
                            <th>
                                <a href="{{ route('admin.index', array_merge(request()->query(), ['order_by' => (request('order_by') == 'lastname_asc' ? 'lastname_desc' : 'lastname_asc')])) }}" class="text-black text-decoration-none d-flex align-items-center justify-content-between">
                                    Last Name
                                    @if (request('order_by') == 'lastname_asc')
                                    <i class="bi bi-arrow-up ms-1"></i>
                                    @elseif (request('order_by') == 'lastname_desc')
                                    <i class="bi bi-arrow-down ms-1"></i>
                                    @endif
                                </a>
                            </th>
                            <th>
                                <a href="{{ route('admin.index', array_merge(request()->query(), ['order_by' => (request('order_by') == 'email_asc' ? 'email_desc' : 'email_asc')])) }}" class="text-black text-decoration-none d-flex align-items-center justify-content-between">
                                    Email
                                    @if (request('order_by') == 'email_asc')
                                    <i class="bi bi-arrow-up ms-1"></i>
                                    @elseif (request('order_by') == 'email_desc')
                                    <i class="bi bi-arrow-down ms-1"></i>
                                    @endif
                                </a>
                            </th>
                            <th>Phone Number</th>
                            <th>Address</th>
                            <th>
                                <a href="{{ route('admin.index', array_merge(request()->query(), ['order_by' => (request('order_by') == 'username_asc' ? 'username_desc' : 'username_asc')])) }}" class="text-black text-decoration-none d-flex align-items-center justify-content-between">
                                    Username
                                    @if (request('order_by') == 'username_asc')
                                    <i class="bi bi-arrow-up ms-1"></i>
                                    @elseif (request('order_by') == 'username_desc')
                                    <i class="bi bi-arrow-down ms-1"></i>
                                    @endif
                                </a>
                            </th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($admins as $admin)
                        <tr>
                            <td>{{ $admin->name }}</td>
                            <td>{{ $admin->lastname }}</td>
                            <td>{{ $admin->email }}</td>
                            <td>{{ $admin->phoneNumber ?? '-' }}</td>
                            <td>{{ $admin->address ?? '-' }}</td>
                            <td>{{ $admin->username }}</td>
                            <td>
                                @if ($admin->isActive)
                                <span class="badge bg-success">Active</span>
                                @else
                                <span class="badge bg-secondary">Inactive</span>
                                @endif
                            </td>
                            <td>
                                <div class="d-flex gap-2">
                                    <form action="{{ route('admin.edit') }}" method="GET">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $admin->id }}">
                                        <button type="submit" class="btn btn-primary btn-sm">
                                            <i class="bi bi-pencil-fill"></i> Edit
                                        </button>
                                    </form>
                                    @if ($admin->isActive)
                                    <form action="{{ route('admin.deactivate') }}" method="POST" onsubmit="return confirm('Are you sure you want to deactivate this admin?');">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="id" value="{{ $admin->id }}">
                                        <button type="submit" class="btn btn-warning btn-sm">
                                            <i class="bi bi-toggle-on"></i> Deactivate
                                        </button>
                                    </form>
                                    @else
                                    <form action="{{ route('admin.activate') }}" method="POST" onsubmit="return confirm('Are you sure you want to activate this admin?');">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="id" value="{{ $admin->id }}">
                                        <button type="submit" class="btn btn-success btn-sm">
                                            <i class="bi bi-toggle-off"></i> Activate
                                        </button>
                                    </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center">No admin users found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Card View - Visible on screens smaller than XL (< 1200px) --}}
            <div class="d-xl-none">
                @forelse ($admins as $admin)
                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title fw-bold mb-3">{{ $admin->name }} {{ $admin->lastname }}</h5>
                        <p class="card-text d-flex justify-content-between mb-1">
                            <strong class="text-muted">Email:</strong>
                            <span>{{ $admin->email }}</span>
                        </p>
                        <p class="card-text d-flex justify-content-between mb-1">
                            <strong class="text-muted">Username:</strong>
                            <span>{{ $admin->username }}</span>
                        </p>
                        <p class="card-text d-flex justify-content-between mb-1">
                            <strong class="text-muted">Phone:</strong>
                            <span>{{ $admin->phoneNumber ?? '-' }}</span>
                        </p>
                        <p class="card-text d-flex justify-content-between mb-2">
                            <strong class="text-muted">Address:</strong>
                            <span>{{ Str::limit($admin->address ?? '-', 50) }}</span>
                        </p>
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <strong class="text-muted">Status:</strong>
                            @if ($admin->isActive)
                            <span class="badge bg-success">Active</span>
                            @else
                            <span class="badge bg-secondary">Inactive</span>
                            @endif
                        </div>
                        <div class="d-flex flex-wrap gap-2"> {{-- Replaced admin-card-actions with flex utilities --}}
                            <form action="{{ route('admin.edit') }}" method="GET" class="d-inline-block"> {{-- Added d-inline-block --}}
                                @csrf
                                <input type="hidden" name="id" value="{{ $admin->id }}">
                                <button type="submit" class="btn btn-primary btn-sm">
                                    <i class="bi bi-pencil-fill"></i> Edit
                                </button>
                            </form>
                            @if ($admin->isActive)
                            <form action="{{ route('admin.deactivate') }}" method="POST" class="d-inline-block" onsubmit="return confirm('Are you sure you want to deactivate this admin?');"> {{-- Added d-inline-block --}}
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="id" value="{{ $admin->id }}">
                                <button type="submit" class="btn btn-warning btn-sm">
                                    <i class="bi bi-toggle-on"></i> Deactivate
                                </button>
                            </form>
                            @else
                            <form action="{{ route('admin.activate') }}" method="POST" class="d-inline-block" onsubmit="return confirm('Are you sure you want to activate this admin?');"> {{-- Added d-inline-block --}}
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="id" value="{{ $admin->id }}">
                                <button type="submit" class="btn btn-success btn-sm">
                                    <i class="bi bi-toggle-off"></i> Activate
                                </button>
                            </form>
                            @endif
                        </div>
                    </div>
                </div>
                @empty
                <div class="alert alert-info text-center">No admin users found.</div>
                @endforelse
            </div>
        </div>
    </div>

    {{-- Laravel's pagination links --}}
    @if ($admins->hasPages())
    <div class="d-flex justify-content-center mt-4">
        {{ $admins->appends(request()->query())->links() }}
    </div>
    @endif
</div>
@endsection

{{-- Removed the @push('styles') block as custom CSS is no longer needed --}}

@push('scripts')
<script>
// Small script to ensure form submission for selects also triggers on Enter key for the search input
document.addEventListener('alpine:init', () => {
    Alpine.data('formHandlers', () => ({
        search: '{{ request('search') }}',
        status: '{{ request('status') }}',
        orderBy: '{{ request('order_by') }}',
        init() {
            this.$watch('status', () => this.submitForm());
            this.$watch('orderBy', () => this.submitForm());
        },
        submitForm() {
            this.$el.closest('form').submit();
        },
        // Optional: if you want the search input to also submit on enter
        // and not rely solely on the button or other field changes
        submitOnEnter(event) {
            if (event.key === 'Enter') {
                this.submitForm();
            }
        }
    }));
});
</script>
@endpush
