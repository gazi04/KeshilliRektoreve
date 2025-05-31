@extends('layouts.app')

@section('title', 'Edit Admin: ' . $admin->name . ' ' . $admin->lastname)

@section('content')
<div class="container mt-4">
    <h1 class="text-center text-primary mb-4">Edit Admin: {{ $admin->name }} {{ $admin->lastname }}</h1>

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
    <div class="alert alert-danger">
        <h3 class="alert-heading">Validation Errors:</h3>
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('admin.update') }}" method="POST" class="needs-validation" novalidate>
        @csrf
        @method('PATCH')

        <input type="hidden" name="id" value="{{ $admin->id }}">

        <div class="mb-3">
            <label for="name" class="form-label">Name:</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $admin->name) }}" required>
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="lastname" class="form-label">Lastname:</label>
            <input type="text" class="form-control @error('lastname') is-invalid @enderror" id="lastname" name="lastname" value="{{ old('lastname', $admin->lastname) }}" required>
            @error('lastname')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="phoneNumber" class="form-label">Phone Number:</label>
            <input type="text" class="form-control @error('phoneNumber') is-invalid @enderror" id="phoneNumber" name="phoneNumber" value="{{ old('phoneNumber', $admin->phoneNumber) }}" required>
            @error('phoneNumber')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email:</label>
            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $admin->email) }}" required>
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="address" class="form-label">Address:</label>
            <input type="text" class="form-control @error('address') is-invalid @enderror" id="address" name="address" value="{{ old('address', $admin->address ?? '') }}" required>
            @error('address')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">New Password (optional):</label>
            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password">
            @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="password_confirmation" class="form-label">Confirm New Password:</label>
            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
        </div>

        <div class="d-flex justify-content-between mt-4">
            <a href="{{ route('admin.index') }}" class="btn btn-secondary">Back to Admin List</a>
            <button type="submit" class="btn btn-primary">Update Admin</button>
        </div>
    </form>
</div>
@endsection
