@extends('layouts.client_app')

@section('title', 'Dokumentet | Universiteti Publik Kadri Zeka')

@section('content')
<section class="py-5 bg-light">
    <div class="container">
        <h2 class="mb-4 text-dark">Dokumente</h2>
        <div class="list-group">
            @forelse($documents as $document)
            <a href="{{ route('downloadDocument', $document) }}"
               class="list-group-item list-group-item-action border-secondary border-bottom"
               download="{{ Str::slug($document->title) }}">
                {{ $document->title }}
                <span class="float-end">
                    <i class="bi bi-download text-primary"></i>
                </span>
            </a>
            @empty
            <div class="list-group-item">
                <p class="text-muted mb-0">Nuk ka dokumente të disponueshme</p>
            </div>
            @endforelse
        </div>

        {{-- Pagination --}}
        @if($documents->hasPages())
        <div class="d-flex justify-content-center mt-4">
            {{ $documents->links() }}
        </div>
        @endif
    </div>
</section>
@endsection
