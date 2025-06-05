@extends('layouts.app')

@section('title', 'Këshilli Rektorëve - Anëtarët')

@section('content')
<div class="container mt-4">
    <h1 class="text-center text-primary mb-4">Manage Members</h1>

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

    {{-- Validation Errors --}}
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

    <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap"> {{-- Added flex-wrap --}}
        <a href="{{ route('members.create') }}" class="btn btn-success mb-2 mb-md-0">Add New Member</a> {{-- Added mb-2 mb-md-0 for spacing --}}

        {{-- Search and Filter Form --}}
        <form action="{{ route('members.index') }}" method="GET" class="d-flex flex-wrap gap-2 flex-grow-1 justify-content-end" x-data="{
            search: '{{ request('search') }}',
            orderBy: '{{ request('order_by') }}',
            init() {
                this.$watch('orderBy', value => this.submitForm());
            },
            submitForm() {
                this.$el.submit();
            }
        }">
            <input type="text" name="search" x-model="search" placeholder="Search members..." class="form-control me-2 flex-grow-1" style="max-width: 200px;">
            <button type="submit" class="btn btn-outline-primary">Search</button>

            @if (request()->filled('search') || request()->filled('order_by'))
            <a href="{{ route('members.index') }}" class="btn btn-outline-secondary">Reset</a>
            @endif
            {{-- Sorting dropdown --}}
            <select name="order_by" x-model="orderBy" class="form-select me-2">
                <option value="latest">Order by Latest</option>
                <option value="orderNr_asc">Order # (Asc)</option>
                <option value="orderNr_desc">Order # (Desc)</option>
                <option value="title_asc">Title (A-Z)</option>
                <option value="title_desc">Title (Z-A)</option>
                <option value="name_asc">Name (A-Z)</option>
                <option value="name_desc">Name (Z-A)</option>
                <option value="position_asc">Position (A-Z)</option>
                <option value="position_desc">Position (Z-A)</option>
                <option value="email_asc">Email (A-Z)</option>
                <option value="email_desc">Email (Z-A)</option>
            </select>
        </form>
    </div>

    <div class="card">
        <div class="card-header">
            @if(request('type'))
            {{ request('type') }} ({{ $members->total() }})
            @else
            All the members ({{ $members->total() }})
            @endif
        </div>
        <div class="card-body">
            {{-- Table View - Visible on XL screens and up (>= 1200px) --}}
            <div class="table-responsive d-none d-xl-block">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>
                                <a href="{{ route('members.index', array_merge(request()->query(), ['order_by' => (request('order_by') == 'orderNr_asc' ? 'orderNr_desc' : 'orderNr_asc')])) }}" class="text-black text-decoration-none d-flex align-items-center justify-content-between">
                                    Order #
                                    @if (request('order_by') == 'orderNr_asc')
                                    <i class="bi bi-arrow-up ms-1"></i>
                                    @elseif (request('order_by') == 'orderNr_desc')
                                    <i class="bi bi-arrow-down ms-1"></i>
                                    @endif
                                </a>
                            </th>
                            <th>Image</th>
                            <th>
                                <a href="{{ route('members.index', array_merge(request()->query(), ['order_by' => (request('order_by') == 'title_asc' ? 'title_desc' : 'title_asc')])) }}" class="text-black text-decoration-none d-flex align-items-center justify-content-between">
                                    Title
                                    @if (request('order_by') == 'title_asc')
                                    <i class="bi bi-arrow-up ms-1"></i>
                                    @elseif (request('order_by') == 'title_desc')
                                    <i class="bi bi-arrow-down ms-1"></i>
                                    @endif
                                </a>
                            </th>
                            <th>
                                <a href="{{ route('members.index', array_merge(request()->query(), ['order_by' => (request('order_by') == 'name_asc' ? 'name_desc' : 'name_asc')])) }}" class="text-black text-decoration-none d-flex align-items-center justify-content-between">
                                    Name
                                    @if (request('order_by') == 'name_asc')
                                    <i class="bi bi-arrow-up ms-1"></i>
                                    @elseif (request('order_by') == 'name_desc')
                                    <i class="bi bi-arrow-down ms-1"></i>
                                    @endif
                                </a>
                            </th>
                            <th>
                                <a href="{{ route('members.index', array_merge(request()->query(), ['order_by' => (request('order_by') == 'position_asc' ? 'position_desc' : 'position_asc')])) }}" class="text-black text-decoration-none d-flex align-items-center justify-content-between">
                                    Position
                                    @if (request('order_by') == 'position_asc')
                                    <i class="bi bi-arrow-up ms-1"></i>
                                    @elseif (request('order_by') == 'position_desc')
                                    <i class="bi bi-arrow-down ms-1"></i>
                                    @endif
                                </a>
                            </th>
                            <th>
                                <a href="{{ route('members.index', array_merge(request()->query(), ['order_by' => (request('order_by') == 'email_asc' ? 'email_desc' : 'email_asc')])) }}" class="text-black text-decoration-none d-flex align-items-center justify-content-between">
                                    Email
                                    @if (request('order_by') == 'email_asc')
                                    <i class="bi bi-arrow-up ms-1"></i>
                                    @elseif (request('order_by') == 'email_desc')
                                    <i class="bi bi-arrow-down ms-1"></i>
                                    @endif
                                </a>
                            </th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($members as $member)
                        <tr>
                            <td>{{ $member->orderNr }}</td>
                            <td>
                                @if ($member->imageUrl)
                                <img src="{{ route('members.image', $member) }}" alt="{{ $member->name }}" class="img-thumbnail" style="width: 80px; height: 80px; object-fit: cover;">
                                @else
                                <img src="https://via.placeholder.com/80?text=No+Image" alt="No Image" class="img-thumbnail" style="width: 80px; height: 80px; object-fit: cover;">
                                @endif
                            </td>
                            <td>{{ $member->title }}</td>
                            <td>{{ $member->name }}</td>
                            <td>{{ $member->position }}</td>
                            <td>{{ $member->email }}</td>
                            <td>
                                <div class="d-flex gap-2">
                                    <a href="{{ route('members.edit', $member) }}" class="btn btn-primary btn-sm">
                                        <i class="bi bi-pencil-fill"></i> Edit
                                    </a>
                                    <form action="{{ route('members.destroy', $member) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this member? This action cannot be undone.');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            <i class="bi bi-trash-fill"></i> Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center">No members found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Card View - Visible on screens smaller than XL (< 1200px) --}}
            <div class="d-xl-none">
                @forelse ($members as $member)
                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title fw-bold mb-3">{{ $member->orderNr }}. {{ $member->name }}</h5>
                        <p class="card-text d-flex justify-content-between mb-1">
                            <strong class="text-muted">Title:</strong>
                            <span>{{ $member->title }}</span>
                        </p>
                        <p class="card-text d-flex justify-content-between mb-1">
                            <strong class="text-muted">Position:</strong>
                            <span>{{ $member->position }}</span>
                        </p>
                        <p class="card-text d-flex justify-content-between mb-1">
                            <strong class="text-muted">Email:</strong>
                            <span>{{ $member->email }}</span>
                        </p>
                        <div class="d-flex flex-wrap gap-2">
                            <a href="{{ route('members.edit', $member) }}" class="btn btn-primary btn-sm">
                                <i class="bi bi-pencil-fill"></i> Edit
                            </a>
                            <form action="{{ route('members.destroy', $member) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this member? This action cannot be undone.');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">
                                    <i class="bi bi-trash-fill"></i> Delete
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                @empty
                <div class="alert alert-info text-center">No members found.</div>
                @endforelse
            </div>
        </div>
    </div>

    {{-- Laravel's pagination links --}}
    @if ($members->hasPages())
    <div class="d-flex justify-content-center mt-4">
        {{ $members->appends(request()->query())->links() }}
    </div>
    @endif
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('formHandlers', () => ({
            search: '{{ request('search') }}',
            orderBy: '{{ request('order_by') }}',
            init() {
                this.$watch('orderBy', () => this.submitForm());
            },
            submitForm() {
                this.$el.closest('form').submit();
            }
        }));
    });
</script>
@endpush
