@extends('layouts.app')

@section('title', 'Këshilli Rektorëve - Konferencat')

@section('content')
<div class="container mt-4">
    <h1 class="text-center text-primary mb-4">Conferences</h1>

    {{-- Success/Error Messages (Keep these for general success/error messages) --}}
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

    {{-- Display Validation Errors --}}
    @if ($errors->any())
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Whoops! There were some problems with your input.</strong>
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap">
        <a href="{{ route('conference.create') }}" class="btn btn-success mb-2 mb-md-0">Add Conference</a>

        {{-- Search and Filter Form --}}
        <form action="{{ route('conference.index') }}" method="GET" class="d-flex flex-wrap gap-2 flex-grow-1 justify-content-end" x-data="{
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
            <input type="text" name="search" x-model="search" placeholder="Search by title..." class="form-control me-2 flex-grow-1" style="max-width: 200px;">
            {{-- Added: Search Button --}}
            <button type="submit" class="btn btn-outline-primary">Search</button>
            @if (request()->filled('search') || request()->filled('status') || request()->filled('order_by'))
            <a href="{{ route('conference.index') }}" class="btn btn-outline-secondary">Reset</a>
            @endif

            <select name="status" x-model="status" class="form-select me-2">
                <option value="all">All Conferences</option>
                <option value="upcoming">Upcoming</option>
                <option value="past">Past</option>
                <option value="active">Active</option>
                <option value="inactive">Inactive</option>
            </select>
            <select name="order_by" x-model="orderBy" class="form-select me-2">
                <option value="latest">Order by Latest Date</option>
                <option value="oldest">Order by Oldest Date</option>
                <option value="title_asc">Title (A-Z)</option>
                <option value="title_desc">Title (Z-A)</option>
            </select>
        </form>
    </div>

    <div class="card">
        <div class="card-header">
            @if(request('type'))
            {{ request('type') }} ({{ $conferences->count() }})
            @else
            All the conferences ({{ $conferences->count() }})
            @endif
        </div>
        <div class="card-body">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>
                            <a href="{{ route('conference.index', array_merge(request()->query(), ['order_by' => (request('order_by') == 'title_asc' ? 'title_desc' : 'title_asc')])) }}" class="text-black text-decoration-none">
                                @if (request('order_by') == 'title_asc')
                                <i class="bi bi-arrow-up ms-1"></i>
                                @elseif (request('order_by') == 'title_desc')
                                <i class="bi bi-arrow-down ms-1"></i>
                                @endif
                                Title
                            </a>
                        </th>
                        <th>Date</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($conferences as $conference)
                    <tr>
                        <td>{{ $conference->title }}</td>
                        <td>{{ $conference->date->format('Y-m-d H:i') }}</td>
                        <td>
                            @if ($conference->isActive)
                            <span class="badge bg-success">Active</span>
                            @else
                            <span class="badge bg-secondary">Inactive</span>
                            @endif
                        </td>
                        <td>
                            <div class="d-flex gap-2">
                                <form action="{{ route('conference.edit') }}" method="GET">
                                    <input type="hidden" name="id" value="{{ $conference->id }}">
                                    <button type="submit" class="btn btn-primary btn-sm">
                                        <i class="bi bi-pencil-fill"></i> Edit
                                    </button>
                                </form>

                                <form action="{{ route('conference.toggleStatus') }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="id" value="{{ $conference->id }}">
                                    <button type="submit" class="btn btn-sm {{ $conference->isActive ? 'btn-warning' : 'btn-success' }}"
                                        onclick="return confirm('Are you sure you want to {{ $conference->isActive ? 'deactivate' : 'activate' }} this conference?');"
                                        title="{{ $conference->isActive ? 'Deactivate Conference' : 'Activate Conference' }}">
                                        @if ($conference->isActive)
                                        <i class="bi bi-toggle-on"></i> Deactivate
                                        @else
                                        <i class="bi bi-toggle-off"></i> Activate
                                        @endif
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center">No conferences found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Laravel's pagination links --}}
    <div class="d-flex justify-content-center mt-4">
        {{ $conferences->links() }}
    </div>
</div>
@endsection
