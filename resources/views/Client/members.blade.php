@extends('layouts.client_app')

@section('title', 'Anëtarët e këshillit | Universiteti Publik Kadri Zeka')

@section('content')
<section class="py-5">
    <div class="container">
        <div class="row g-4">
            @forelse($members as $member)
            <div class="col-lg-3 col-md-6">
                <div class="card text-center h-100 shadow-sm">
                    @if($member->imageUrl)
                    <img
                        src="{{ route('members.image', $member) }}"
                        class="card-img-top rounded-circle mx-auto mt-4"
                        alt="{{ $member->name }}"
                        style="width: 200px; height: 200px; object-fit: cover"
                    />
                    @else
                    <div class="card-img-top rounded-circle mx-auto mt-4 bg-secondary"
                        style="width: 200px; height: 200px; object-fit: cover"></div>
                    @endif
                    <div class="card-body">
                        <h5 class="card-title mb-1">{{ $member->name }}</h5>
                        <p class="text-muted mb-3">{{ $member->position }}</p>
                        @if($member->email)
                        <div class="mb-3">
                            <i class="bi bi-envelope-fill"></i> {{ $member->email }}
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12">
                <div class="alert alert-info text-center">Nuk ka anëtarë të regjistruar.</div>
            </div>
            @endforelse
        </div>

        {{-- Pagination --}}
        @if($members->hasPages())
        <div class="d-flex justify-content-center mt-5">
            <nav aria-label="Page navigation">
                <ul class="pagination">
                    {{ $members->links() }}
                </ul>
            </nav>
        </div>
        @endif
    </div>
</section>
@endsection
