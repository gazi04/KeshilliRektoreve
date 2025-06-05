@extends('layouts.app')

@section('title', 'Këshilli Rektorëve - Dokumentet')

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

    {{-- Validation Errors --}}
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

        {{-- Search and Order By Form --}}
        <form action="{{ route('document.index') }}" method="GET" class="d-flex flex-wrap gap-2 flex-grow-1 justify-content-end" x-data="{
            search: '{{ request('search') }}',
            orderBy: '{{ request('order_by') }}',
            init() {
            this.$watch('orderBy', value => this.submitForm());
            },
            submitForm() {
            this.$el.submit();
            }
            }">
            <div class="w-100 d-flex flex-wrap gap-2 mb-2 mb-md-0">     
                   <a href="{{ route('document.create') }}" class="btn btn-success mb-2 mb-md-0">Add Document</a>
                   <input type="text" name="search" x-model="search" placeholder="Search by title or conference..." class="form-control me-2 flex-grow-1 w-50"> 
            <div class="d-flex gap-2">
            {{-- Search Button --}}
            <button type="submit" class="btn btn-outline-primary">Search</button>
 
            {{-- Reset Button --}}
            @if (request()->filled('search') || request()->filled('order_by'))
            <a href="{{ route('document.index') }}" class="btn btn-outline-secondary">Reset</a>
            @endif
            </div> 
              
            </div>
           

            {{-- Order By Dropdown --}}
            <select name="order_by" x-model="orderBy" class="form-select me-2">
                <option value="latest">Order by Latest Date</option>
                <option value="oldest">Order by Oldest Date</option>
                <option value="title_asc">Title (A-Z)</option>
                <option value="title_desc">Title (Z-A)</option>
                <option value="type_asc">Type (A-Z)</option>
                <option value="type_desc">Type (Z-A)</option>
            </select>
        </form>
    </div>

    @if($documents->isEmpty())
    <div class="alert alert-info text-center">
        No documents found.
    </div>
    @else
    <div class="card">
        <div class="card-header">
            All the documents ({{ $documents->total() }})
        </div>
        <div class="card-body">
            {{-- Table View - Visible on XL screens and up (>= 1200px) --}}
            <div class="table-responsive d-none d-xl-block">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>
                                <a href="{{ route('document.index', array_merge(request()->query(), ['order_by' => (request('order_by') == 'title_asc' ? 'title_desc' : 'title_asc')])) }}" class="text-black text-decoration-none d-flex align-items-center justify-content-between">
                                    Title
                                    @if (request('order_by') == 'title_asc')
                                    <i class="bi bi-arrow-up ms-1"></i>
                                    @elseif (request('order_by') == 'title_desc')
                                    <i class="bi bi-arrow-down ms-1"></i>
                                    @endif
                                </a>
                            </th>
                            <th>
                                <a href="{{ route('document.index', array_merge(request()->query(), ['order_by' => (request('order_by') == 'type_asc' ? 'type_desc' : 'type_asc')])) }}" class="text-black text-decoration-none d-flex align-items-center justify-content-between">
                                    Type
                                    @if (request('order_by') == 'type_asc')
                                    <i class="bi bi-arrow-up ms-1"></i>
                                    @elseif (request('order_by') == 'type_desc')
                                    <i class="bi bi-arrow-down ms-1"></i>
                                    @endif
                                </a>
                            </th>
                            <th>Conference</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($documents as $document)
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
                                        <button type="submit" class="btn btn-primary btn-sm" title="Edit Document">
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
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- Card View - Visible on screens smaller than XL (< 1200px) --}}
                <div class="d-xl-none">
                    @foreach($documents as $document)
                    <div class="card mb-3">
                        <div class="card-body">
                            <h5 class="card-title fw-bold mb-2">{{ $document->title }}</h5>
                            <p class="card-text d-flex justify-content-between mb-1">
                                <strong class="text-muted">Type:</strong>
                                <span>{{ ucfirst($document->type) }}</span>
                            </p>
                            <p class="card-text d-flex justify-content-between mb-2">
                                <strong class="text-muted">Conference:</strong>
                                <span>
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
                                </span>
                            </p>
                            <div class="d-flex flex-wrap gap-2">
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
                                    <button type="submit" class="btn btn-primary btn-sm" title="Edit Document">
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
                        </div>
                    </div>
                    @endforeach
                </div>
        </div>
    </div>

    {{-- Laravel's pagination links --}}
    <div class="d-flex justify-content-center mt-4">
        {{ $documents->appends(request()->query())->links() }}
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
