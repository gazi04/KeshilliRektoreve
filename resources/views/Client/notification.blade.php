@extends('layouts.client_app')

@section('title', $notification->title . ' - Universiteti Publik Kadri Zeka')

@section('content')
<main class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow border-0">
                <img src="{{ route('notifications.image', $notification) }}" class="card-img-top" alt="{{ $notification->title }}" style="height: 300px; object-fit: cover;">
                <div class="card-body">
                    <h2 class="card-title">{{ $notification->title }}</h2>
                    <p class="text-muted">{{ $notification->datetime->format('d F Y') }} &middot; <span class="badge bg-secondary">{{ $notification->notificationType }}</span></p>
                    <hr>
                    <p class="card-text">
                        {{ $notification->description }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
