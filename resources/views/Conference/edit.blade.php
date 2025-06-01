@extends('layouts.app')

@section('title', 'Edit Conference')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h2 class="mb-0">Edit Conference: {{ $conference->title }}</h2>
                </div>
                <div class="card-body">
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
                    {{-- Update Form --}}
                    {{-- Note: Your web.php for update uses Route::patch('/udpate', 'update').
                    It has a typo ('udpate' instead of 'update') and does not use route model binding.
                    For this view, I'm assuming you will fix the typo in web.php to '/update'
                    and potentially switch to route model binding for consistency (e.g., /conference/{conference}).
                    For now, I'll pass the ID as a hidden field, matching your edit route's current request handling.
                    --}}
                    <form action="{{ route('conference.update') }}" method="POST">
                        @csrf
                        @method('PATCH') {{-- Use PATCH method for updates --}}

                        {{-- Hidden ID field for the update --}}
                        <input type="hidden" name="id" value="{{ $conference->id }}">

                        {{-- Title Field --}}
                        <div class="mb-3">
                            <label for="title" class="form-label">Title</label>
                            {{-- old('title', $conference->title) will prioritize old input on validation failure --}}
                            <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title', $conference->title) }}" required autofocus>
                            @error('title')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        {{-- Date and Time Field --}}
                        <div class="mb-3">
                            <label for="date" class="form-label">Date and Time</label>
                            {{-- Format date for datetime-local input: YYYY-MM-DDTHH:MM --}}
                            <input type="datetime-local" class="form-control @error('date') is-invalid @enderror" id="date" name="date" value="{{ old('date', $conference->date->format('Y-m-d\TH:i')) }}" required>
                            @error('date')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        {{-- Submit and Cancel Buttons --}}
                        <div class="d-flex justify-content-between mt-4">
                            <button type="submit" class="btn btn-success">Update Conference</button>
                            <a href="{{ route('conference.index') }}" class="btn btn-secondary">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
