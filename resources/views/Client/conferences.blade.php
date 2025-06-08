@extends('layouts.client_app')

@section('title', 'Konferencat | Universiteti Publik Kadri Zeka')

@section('content')
<section class="py-5 bg-light">
    <div class="container">
        <h2 class="mb-4 text-dark">Konferencat</h2>

        <div class="row g-4">
            @forelse($conferences as $conference)
            <div class="col-md-6 col-lg-4">
                <div class="card h-100 shadow-sm border-0">
                    <div class="card-body">
                        <h5 class="card-title">{{ $conference->title }}</h5>
                        <p class="text-muted">
                            <i class="bi bi-calendar-event"></i>
                            {{ $conference->date->format('d M Y') }}
                        </p>
                        <p class="card-text">{{ Str::limit($conference->description, 150) }}</p>
                        <a href="{{ route('showConference', $conference) }}" class="btn btn-primary">
                            Shiko më shumë
                        </a>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12">
                <div class="alert alert-info text-center">Nuk ka konferenca të disponueshme</div>
            </div>
            @endforelse
        </div>

        {{-- Pagination --}}
        @if($conferences->hasPages())
        <div class="d-flex justify-content-center mt-4">
            {{ $conferences->links() }}
        </div>
        @endif
    </div>
</section>
@endsection
