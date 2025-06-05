@extends('layouts.app')

@section('title', 'Këshilli Rektorëve')

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

    <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap">
        <a href="{{ route('admin.create') }}" class="btn btn-success mb-2 mb-md-0">Create Admin</a>

        {{-- Search and Filter Form --}}
        <form action="{{ route('admin.index') }}" method="GET" class="d-flex flex-wrap gap-2 flex-grow-1 justify-content-end" x-data="{
            search: '{{ request('search') }}',
            status: '{{ request('status') }}',
            orderBy: '{{ request('order_by') }}',
            init() {
            this.$watch('search', value => this.submitForm());
            this.$watch('status', value => this.submitForm());
            this.$watch('orderBy', value => this.submitForm());
            },
            submitForm() {
            this.$el.submit();
            }
            }">
            <input type="text" name="search" x-model="search" placeholder="Search admins..." class="form-control me-2 flex-grow-1" style="max-width: 200px;">
            <select name="status" x-model="status" class="form-select me-2">
                <option value="all">All Statuses</option>
                <option value="active">Active</option>
                <option value="inactive">Inactive</option>
            </select>
            <select name="order_by" x-model="orderBy" class="form-select me-2">
                <option value="latest">Order by Latest</option>
                <option value="name_asc">Name (A-Z)</option>
                <option value="name_desc">Name (Z-A)</option>
            </select>
            @if (request()->filled('search') || request()->filled('status') || request()->filled('order_by'))
            <a href="{{ route('admin.index') }}" class="btn btn-secondary">Reset</a>
            @endif
        </form>
    </div>

    <div class="card">
        <div class="card-header">
            @if(request('type'))
            {{ request('type') }} ({{ $admins->count() }})
            @else
            All the admins ({{ $admins->count() }})
            @endif
        </div>
        <div class="card-body">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>Phone Number</th>
                        <th>Address</th>
                        <th>Username</th>
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
                        <td>{{ $admin->phoneNumber }}</td>
                        <td>{{ $admin->address }}</td>
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
                                <form action="{{ route('admin.deactivate') }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="id" value="{{ $admin->id }}">
                                    <button type="submit" class="btn btn-warning btn-sm">
                                        <i class="bi bi-toggle-on"></i> Deactivate
                                    </button>
                                </form>
                                @else
                                <form action="{{ route('admin.activate') }}" method="POST">
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
    </div>

    {{-- Laravel's pagination links --}}
    <div class="d-flex justify-content-center mt-4">
        {{ $admins->links() }}
    </div>
</div>
@endsection
