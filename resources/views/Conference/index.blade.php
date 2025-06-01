@extends('layouts.app')

@section('title', 'Conferences')

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

    {{-- Display Validation Errors (NEW SECTION) --}}
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
                this.$watch('search', value => this.submitForm());
                this.$watch('status', value => this.submitForm());
                this.$watch('orderBy', value => this.submitForm());
            },
            submitForm() {
                this.$el.submit();
            }
        }">
            <input type="text" name="search" x-model="search" placeholder="Search by title..." class="form-control me-2 flex-grow-1" style="max-width: 200px;">
            <select name="status" x-model="status" class="form-select me-2">
                <option value="all">All Conferences</option>
                <option value="upcoming">Upcoming</option>
                <option value="past">Past</option>
            </select>
            <select name="order_by" x-model="orderBy" class="form-select me-2">
                <option value="latest">Order by Latest Date</option>
                <option value="oldest">Order by Oldest Date</option>
                <option value="title_asc">Title (A-Z)</option>
                <option value="title_desc">Title (Z-A)</option>
            </select>
            @if (request()->filled('search') || request()->filled('status') || request()->filled('order_by'))
            <a href="{{ route('conference.index') }}" class="btn btn-secondary">Reset</a>
            @endif
        </form>
    </div>

    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead class="table-primary">
                <tr>
                    <th>Title</th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($conferences as $conference)
                <tr>
                    <td>{{ $conference->title }}</td>
                    <td>{{ $conference->date->format('Y-m-d H:i') }}</td>
                    <td>
                        <div class="d-flex gap-2">
                            <form action="{{ route('conference.edit') }}" method="GET">
                                <input type="hidden" name="id" value="{{ $conference->id }}">
                                <button type="submit" class="btn btn-primary btn-sm">Edit</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" class="text-center">No conferences found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Laravel's pagination links --}}
    <div class="d-flex justify-content-center mt-4">
        {{ $conferences->links() }}
    </div>
</div>
@endsection
