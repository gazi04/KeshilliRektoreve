@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-4">Krijo Njoftim</h1>

        <form action="{{ route('notifications.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label for="imageUrl" class="form-label">Add image</label>
                <input type="file" class="form-control" id="imageUrl" name="imageUrl" accept="image/*" required>
                <div class="form-text">Accepted forms: JPEG, PNG, JPG, GIF. Madhësia max: 2MB</div>
            </div>

            <div class="mb-3">
                <label for="datetime" class="form-label">Date & Time</label>
                <input type="datetime-local" class="form-control" id="datetime" name="datetime" required
                    value="{{ old('datetime', now()->format('Y-m-d\TH:i')) }}">
            </div>

            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control" id="title" name="title" required maxlength="200"
                    value="{{ old('title') }}">
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description" rows="4"
                    required>{{ old('description') }}</textarea>
            </div>

            <div class="mb-3">
                <label for="notificationType" class="form-label">Lloji</label>
                <select class="form-select" id="notificationType" name="notificationType" required>
                    <option value="">Select Type</option>
                    @foreach($types as $type)
                        <option value="{{ $type }}" @selected(old('notificationType') == $type)>{{ $type }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Create</button>
            <a href="{{ route('notifications.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
@endsection
