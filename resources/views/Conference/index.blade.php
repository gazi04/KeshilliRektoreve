@extends('layouts.app')

@section('title', 'Këshilli Rektorëve - Konferencat')

@section('content')
<div class="container mt-4">
    <h1 class="text-center text-primary mb-4">Conferences</h1>

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
            {{-- Search Button --}}
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
                <option value="date_asc">Date (Asc)</option>
                <option value="date_desc">Date (Desc)</option>
            </select>
        </form>
    </div>

    @if ($conferences->isEmpty())
    <div class="alert alert-info text-center">
        No conferences found.
    </div>
    @else
    <div class="card">
        <div class="card-header">
            @if(request('type'))
            {{ request('type') }} ({{ $conferences->total() }})
            @else
            All the conferences ({{ $conferences->total() }})
            @endif
        </div>
        <div class="card-body">
            {{-- Table View - Visible on XL screens and up (>= 1200px) --}}
            <div class="table-responsive d-none d-xl-block">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>
                                <a href="{{ route('conference.index', array_merge(request()->query(), ['order_by' => (request('order_by') == 'title_asc' ? 'title_desc' : 'title_asc')])) }}" class="text-black text-decoration-none d-flex align-items-center justify-content-between">
                                    Title
                                    @if (request('order_by') == 'title_asc')
                                    <i class="bi bi-arrow-up ms-1"></i>
                                    @elseif (request('order_by') == 'title_desc')
                                    <i class="bi bi-arrow-down ms-1"></i>
                                    @endif
                                </a>
                            </th>
                            <th>
                                <a href="{{ route('conference.index', array_merge(request()->query(), ['order_by' => (request('order_by') == 'date_asc' ? 'date_desc' : 'date_asc')])) }}" class="text-black text-decoration-none d-flex align-items-center justify-content-between">
                                    Date
                                    @if (request('order_by') == 'date_asc')
                                    <i class="bi bi-arrow-up ms-1"></i>
                                    @elseif (request('order_by') == 'date_desc')
                                    <i class="bi bi-arrow-down ms-1"></i>
                                    @endif
                                </a>
                            </th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($conferences as $conference)
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
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- Card View - Visible on screens smaller than XL (< 1200px) --}}
            <div class="d-xl-none">
                @foreach ($conferences as $conference)
                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title fw-bold mb-2">{{ $conference->title }}</h5>
                        <p class="card-text d-flex justify-content-between mb-1">
                            <strong class="text-muted">Date:</strong>
                            <span>{{ $conference->date->format('Y-m-d H:i') }}</span>
                        </p>
                        <p class="card-text d-flex justify-content-between mb-2">
                            <strong class="text-muted">Status:</strong>
                            <span>
                                @if ($conference->isActive)
                                <span class="badge bg-success">Active</span>
                                @else
                                <span class="badge bg-secondary">Inactive</span>
                                @endif
                            </span>
                        </p>
                        <div class="d-flex flex-wrap gap-2">
                            <form action="{{ route('conference.edit') }}" method="GET" class="d-inline">
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
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    {{-- Laravel's pagination links --}}
    <div class="d-flex justify-content-center mt-4">
        {{ $conferences->appends(request()->query())->links() }}
    </div>
    @endif
</div>
@endsection

@push('scripts')
<script>
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
            }
        }));
    });
</script>
@endpush
