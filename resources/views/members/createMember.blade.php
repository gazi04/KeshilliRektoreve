@extends('layouts.app')

@section('title', 'Create New Member')

@section('content')
<div class="container mt-4">
    <h1 class="text-center text-primary mb-4">Create New Member</h1>

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

    <div class="card shadow-sm p-4">
        <form action="{{ route('members.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label for="title" class="form-label">Title (e.g., Dr., Prof.):</label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title') }}" maxlength="50">
                @error('title')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="name" class="form-label">Name <span class="text-danger">*</span>:</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required maxlength="255">
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="position" class="form-label">Position <span class="text-danger">*</span>:</label>
                <input type="text" class="form-control @error('position') is-invalid @enderror" id="position" name="position" value="{{ old('position') }}" required maxlength="255">
                @error('position')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email:</label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" maxlength="255">
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="orderNr" class="form-label">Order Number <span class="text-danger">*</span>:</label>
                <input type="number" class="form-control @error('orderNr') is-invalid @enderror" id="orderNr" name="orderNr" value="{{ old('orderNr', $nextOrder) }}" required min="1">
                @error('orderNr')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="imageUrl" class="form-label">Member Image <span class="text-danger">*</span>:</label>
                <input type="file" class="form-control @error('imageUrl') is-invalid @enderror" id="imageUrl" name="imageUrl" accept="image/*" >
                @error('imageUrl')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <div class="form-text">Accepted formats: JPEG, PNG, JPG, GIF. Max size: 2MB.</div>
            </div>

            <div class="d-flex justify-content-between">
                <button type="submit" class="btn btn-primary">Add Member</button>
                <a href="{{ route('members.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
