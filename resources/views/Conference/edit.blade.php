@extends('layouts.app')

@section('title', 'Përditësoni Konferencën')

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
                    <form action="{{ route('conference.update') }}" method="POST">
                        @csrf
                        @method('PATCH')

                        <input type="hidden" name="id" value="{{ $conference->id }}">

                        <div class="mb-3">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title', $conference->title) }}" required autofocus>
                            @error('title')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        {{-- Add this after the date field --}}
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control @error('description') is-invalid @enderror"
                                id="description"
                                name="description"
                                rows="3">{{ old('description', $conference->description) }}</textarea>
                            @error('description')
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

                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="isActive" name="isActive" value="1" {{ old('isActive', $conference->isActive) ? 'checked' : '' }}>
                            <label class="form-check-label" for="isActive">Conference is Active (Visible to Public)</label>
                        </div>

                        {{-- Submit and Cancel Buttons --}}
                        <div class="d-flex justify-content-between align-items-center mt-4 gap-4">
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
