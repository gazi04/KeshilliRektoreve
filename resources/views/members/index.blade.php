@extends('layouts.app')

@section('title', 'Manage Members')

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

    <div class="d-flex justify-content-between align-items-center mb-3">
        <a href="{{ route('members.create') }}" class="btn btn-success">Add New Member</a>

        {{-- Search Form with Reset Button --}}
        <form action="{{ route('members.index') }}" method="GET" class="d-flex">
            <input type="text" name="search" class="form-control me-2" placeholder="Search members..." value="{{ request('search') }}">
            <button type="submit" class="btn btn-outline-primary me-2">Search</button>
            {{-- Reset Button --}}
            @if (request()->has('search') || request()->has('sort') || request()->has('direction'))
            <a href="{{ route('members.index') }}" class="btn btn-outline-secondary">Reset</a>
            @endif
        </form>
    </div>

    <div class="card">
        <div class="card-header">
            @if(request('type'))
            {{ request('type') }} ({{ $members->count() }})
            @else
            All the members ({{ $members->count() }})
            @endif
        </div>
        <div class="card-body">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>
                            <a href="{{ route('members.index', array_merge(request()->query(), ['sort' => 'orderNr', 'direction' => ($sortField == 'orderNr' && $sortDirection == 'asc' ? 'desc' : 'asc')])) }}" class="text-white text-decoration-none">
                                Order #
                                @if ($sortField == 'orderNr')
                                <i class="fas fa-sort-{{ $sortDirection }}"></i>
                                @else
                                <i class="fas fa-sort"></i>
                                @endif
                            </a>
                        </th>
                        <th>Image</th>
                        <th>
                            <a href="{{ route('members.index', array_merge(request()->query(), ['sort' => 'title', 'direction' => ($sortField == 'title' && $sortDirection == 'asc' ? 'desc' : 'asc')])) }}" class="text-white text-decoration-none">
                                Title
                                @if ($sortField == 'title')
                                <i class="fas fa-sort-{{ $sortDirection }}"></i>
                                @else
                                <i class="fas fa-sort"></i>
                                @endif
                            </a>
                        </th>
                        <th>
                            <a href="{{ route('members.index', array_merge(request()->query(), ['sort' => 'name', 'direction' => ($sortField == 'name' && $sortDirection == 'asc' ? 'desc' : 'asc')])) }}" class="text-white text-decoration-none">
                                Name
                                @if ($sortField == 'name')
                                <i class="fas fa-sort-{{ $sortDirection }}"></i>
                                @else
                                <i class="fas fa-sort"></i>
                                @endif
                            </a>
                        </th>
                        <th>
                            <a href="{{ route('members.index', array_merge(request()->query(), ['sort' => 'position', 'direction' => ($sortField == 'position' && $sortDirection == 'asc' ? 'desc' : 'asc')])) }}" class="text-white text-decoration-none">
                                Position
                                @if ($sortField == 'position')
                                <i class="fas fa-sort-{{ $sortDirection }}"></i>
                                @else
                                <i class="fas fa-sort"></i>
                                @endif
                            </a>
                        </th>
                        <th>
                            <a href="{{ route('members.index', array_merge(request()->query(), ['sort' => 'email', 'direction' => ($sortField == 'email' && $sortDirection == 'asc' ? 'desc' : 'asc')])) }}" class="text-white text-decoration-none">
                                Email
                                @if ($sortField == 'email')
                                <i class="fas fa-sort-{{ $sortDirection }}"></i>
                                @else
                                <i class="fas fa-sort"></i>
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
                        <td colspan="7" class="text-center">No members found matching your criteria.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Pagination Links --}}
    <div class="d-flex justify-content-center mt-4">
        {{ $members->appends(['search' => $search, 'sort' => $sortField, 'direction' => $sortDirection])->links() }}
    </div>
</div>
@endsection
