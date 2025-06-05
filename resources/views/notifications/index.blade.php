@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Notifications</h1>

    <ul class="nav nav-tabs mb-4">
        <li class="nav-item">
            <a class="nav-link {{ !request('type') ? 'active' : '' }}" href="{{ route('notifications.index') }}">
                All
            </a>
        </li>
        @foreach($types as $type)
        <li class="nav-item">
            <a class="nav-link {{ request('type') === $type ? 'active' : '' }}"
                href="{{ route('notifications.index', ['type' => $type]) }}">
                {{ $type }}
            </a>
        </li>
        @endforeach
    </ul>

    <div class="mb-4">
        <a href="{{ route('notifications.create') }}" class="btn btn-success">
            Add New
        </a>
    </div>

    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    @if($notifications->isEmpty())
    <div class="alert alert-info">
        @if(request('type'))
        There aren't any notifications of type {{ request('type') }}
        @else
        Nuk ka njoftime
        @endif
    </div>
    @else
    <div class="card">
        <div class="card-header">
            @if(request('type'))
            {{ request('type') }} ({{ $notifications->count() }})
            @else
            All the notifications ({{ $notifications->count() }})
            @endif
        </div>

        <div class="card-body">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Image</th>
                        <th>Date/Time</th>
                        <th>Title</th>
                        <th>Type</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($notifications as $notification)
                    <tr>
                        <td>{{ $notification->id }}</td>
                        <td>
                            @if($notification->imageUrl)
                            <img src="{{ route('notifications.image', $notification) }}" class="img-thumbnail"
                                style="width: 80px; height: 80px; object-fit: cover;">
                            @else
                            <img src="https://via.placeholder.com/80?text=No+Image" alt="No Image" class="img-thumbnail"
                                style="width: 80px; height: 80px; object-fit: cover;">
                            @endif
                        </td>
                        <td>{{ $notification->datetime->format('d/m/Y H:i') }}</td>
                        <td>{{ \Illuminate\Support\Str::limit($notification->title, 40) }}</td>
                        <td>
                            <span
                                class="badge
                                @if($notification->notificationType === 'Lajm') bg-primary
                                @elseif($notification->notificationType === 'Konkurs') bg-success
                                @else bg-info
                                @endif">
                                {{ $notification->notificationType }}
                            </span>
                        </td>
                        <td>
                            <a href="{{ route('notifications.edit', $notification->id) }}"
                                class="btn btn-primary btn-sm">
                                <i class="bi bi-pencil-fill"></i> Edit
                            </a>
                            <form action="{{ route('notifications.destroy', $notification->id) }}" method="POST"
                                class="d-inline" onsubmit="return confirm('Jeni i sigurt?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">
                                    <i class="bi bi-trash-fill"></i> Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @endif
</div>
@endsection
