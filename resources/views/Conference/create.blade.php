@extends('layouts.app')

@section('title', 'Krijo Konferencë')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h2 class="mb-0">Create New Conference</h2>
                </div>
                <div class="card-body">
                    <form action="{{ route('conference.store') }}" method="POST">
                        @csrf

                        {{-- Title Field --}}
                        <div class="mb-3">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title') }}" required autofocus>
                            @error('title')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- Date and Time Field --}}
                        <div class="mb-3">
                            <label for="date" class="form-label">Date and Time</label>
                            <input type="datetime-local" class="form-control @error('date') is-invalid @enderror" id="date" name="date" value="{{ old('date') }}" required>
                            @error('date')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- Submit and Cancel Buttons --}}
                        <div class="d-flex justify-content-between mt-4">
                            <button type="submit" class="btn btn-success">Create Conference</button>
                            <a href="{{ route('conference.index') }}" class="btn btn-secondary">Back to Conferences</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
