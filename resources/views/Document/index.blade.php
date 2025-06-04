@extends('layouts.app')

@section('title', 'Documents')

@section('content')
<div class="container mt-4">
    <h1 class="text-center text-primary mb-4">Documents</h1>

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

    {{-- Validation Errors (if any, from a form request) --}}
    @if ($errors->any())
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Whoops! There were some problems.</strong>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap">
        <a href="{{ route('document.create') }}" class="btn btn-success mb-2 mb-md-0">Add Document</a>

        {{-- Search and Order By Form --}}
        <form action="{{ route('document.index') }}" method="GET" class="d-flex flex-wrap gap-2 flex-grow-1 justify-content-end">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by title or conference..." class="form-control me-2 flex-grow-1" style="max-width: 250px;">

            {{-- Search Button --}}
            <button type="submit" class="btn btn-primary">Search</button>

            {{-- Order By Dropdown --}}
            <select name="order_by" class="form-select me-2" onchange="this.form.submit()">
                <option value="latest" {{ request('order_by') == 'latest' ? 'selected' : '' }}>Order by Latest Date</option>
                <option value="oldest" {{ request('order_by') == 'oldest' ? 'selected' : '' }}>Order by Oldest Date</option>
                <option value="title_asc" {{ request('order_by') == 'title_asc' ? 'selected' : '' }}>Title (A-Z)</option>
                <option value="title_desc" {{ request('order_by') == 'title_desc' ? 'selected' : '' }}>Title (Z-A)</option>
            </select>

            {{-- Reset Button --}}
            @if (request()->filled('search') || request()->filled('order_by'))
            <a href="{{ route('document.index') }}" class="btn btn-secondary">Reset</a>
            @endif
        </form>
    </div>

    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead class="table-primary">
                <tr>
                    <th>Title</th>
                    <th>Type</th>
                    <th>Conference</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($documents as $document)
                <tr>
                    <td>{{ $document->title }}</td>
                    <td>{{ ucfirst($document->type) }}</td>
                    <td>
                        @if ($document->conference)
                        <form action="{{ route('conference.edit') }}" method="GET" class="d-inline">
                            @csrf
                            <input type="hidden" name="id" value="{{ $document->conference->id }}" />
                            <button type="submit" class="btn btn-link p-0 m-0 border-0 text-decoration-none" title="View Conference Details">
                                {{ $document->conference->title }}
                            </button>
                        </form>
                        @else
                        N/A
                        @endif
                    </td>
                    <td>
                        <div class="d-flex gap-2">
                            <form action="{{ route('document.download') }}" method="POST" class="d-inline">
                                @csrf
                                <input type="hidden" name="id" value="{{ $document->id }}" />
                                <button type="submit" class="btn btn-info btn-sm" title="Download Document">
                                    <i class="bi bi-download"></i> Download
                                </button>
                            </form>
                            <form action="{{ route('document.edit') }}" method="GET" class="d-inline">
                                @csrf
                                <input type="hidden" name="id" value="{{ $document->id }}" />
                                <button type="submit" class="btn btn-primary btn-sm" title="Download Document">
                                    <i class="bi bi-pencil-fill"></i> Edit
                                </button>
                            </form>
                            <form action="{{ route('document.destroy') }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this document?');" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <input type="hidden" name="id" value="{{ $document->id }}" />
                                <button type="submit" class="btn btn-danger btn-sm" title="Delete Document">
                                    <i class="bi bi-trash-fill"></i> Delete
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center">No documents found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Laravel's pagination links --}}
    <div class="d-flex justify-content-center mt-4">
        {{ $documents->links() }}
    </div>
</div>
@endsection
