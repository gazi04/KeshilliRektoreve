@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-4">Ndrysho Njoftimin</h1>

        <form action="{{ route('notifications.update', $notification->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="imageUrl" class="form-label">Ngarko Imazh</label>
                <input type="file" class="form-control" id="imageUrl" name="imageUrl" accept="image/*">
                <div class="form-text">Pranoni format: JPEG, PNG, JPG, GIF. Madhësia max: 2MB</div>
                @if($notification->imageUrl)
                    <div class="mt-2">
                        <img src="{{ $notification->imageUrl }}" class="img-thumbnail" style="max-width: 200px;">
                    </div>
                @endif
            </div>

            <div class="mb-3">
                <label for="datetime" class="form-label">Data & Koha</label>
                <input type="datetime-local" class="form-control" id="datetime" name="datetime" required
                    value="{{ old('datetime', $notification->datetime->format('Y-m-d\TH:i')) }}">
            </div>

            <div class="mb-3">
                <label for="title" class="form-label">Titulli</label>
                <input type="text" class="form-control" id="title" name="title" required maxlength="200"
                    value="{{ old('title', $notification->title) }}">
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Përshkrimi</label>
                <textarea class="form-control" id="description" name="description" rows="4"
                    required>{{ old('description', $notification->description) }}</textarea>
            </div>

            <div class="mb-3">
                <label for="notificationType" class="form-label">Lloji</label>
                <select class="form-select" id="notificationType" name="notificationType" required>
                    @foreach($types as $type)
                        <option value="{{ $type }}" @selected(old('notificationType', $notification->notificationType) == $type)>
                            {{ $type }}
                        </option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Përditëso</button>
            <a href="{{ route('notifications.index') }}" class="btn btn-secondary">Anulo</a>
        </form>
    </div>
@endsection
