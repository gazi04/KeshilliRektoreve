@extends('layouts.app')

@section('title', 'Edit Member')

@section('content')
<div class="container mt-4">
    <h1 class="text-center text-primary mb-4">Edit Member: {{ $member->name }}</h1>

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
        <form action="{{ route('members.update', $member) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PATCH')

            <div class="mb-3">
                <label for="title" class="form-label">Title (e.g., Dr., Prof.):</label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title', $member->title) }}" maxlength="50">
                @error('title')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="name" class="form-label">Name <span class="text-danger">*</span>:</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $member->name) }}" required maxlength="255">
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="position" class="form-label">Position <span class="text-danger">*</span>:</label>
                <input type="text" class="form-control @error('position') is-invalid @enderror" id="position" name="position" value="{{ old('position', $member->position) }}" required maxlength="255">
                @error('position')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email:</label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $member->email) }}" maxlength="255">
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="orderNr" class="form-label">Order Number <span class="text-danger">*</span>:</label>
                <input type="number" class="form-control @error('orderNr') is-invalid @enderror" id="orderNr" name="orderNr" value="{{ old('orderNr', $member->orderNr) }}" required min="1">
                @error('orderNr')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="image" class="form-label">Member Image:</label>
                <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image" accept="image/*">
                @error('image')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <div class="form-text">Accepted formats: JPEG, PNG, JPG, GIF. Max size: 2MB. Leave empty to keep current image.</div>

                @if ($member->imageUrl)
                    <div class="mt-3">
                        <p>Current Image:</p>
                        <img src="{{ route('members.image', $member) }}" class="img-thumbnail" style="max-width: 150px; height: auto; object-fit: cover;">
                    </div>
                @endif
            </div>

            <div class="d-flex justify-content-between align-items-center gap-4">
                <button type="submit" class="btn btn-primary">Update Member</button>
                <a href="{{ route('members.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
