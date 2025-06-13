@extends('layouts.client_app')

@section('title', 'Njoftimet | Universiteti Publik Kadri Zeka')

@section('content')
<section class="py-5 bg-light">
    <div class="container">
        <h2 class="mb-4 text-dark text-center">Njoftimet</h2>
        <div class="d-flex flex-wrap justify-content-center gap-3 mb-4">
            <button class="btn btn-outline-primary {{ $activeFilter === 'all' ? 'active' : '' }}" data-filter="all">Të Gjitha</button>
            <button class="btn btn-outline-primary {{ $activeFilter === 'Lajm' ? 'active' : '' }}" data-filter="Lajm">Lajm</button>
            <button class="btn btn-outline-primary {{ $activeFilter === 'Konkurs' ? 'active' : '' }}" data-filter="Konkurs">Konkurs</button>
            <button class="btn btn-outline-primary {{ $activeFilter === 'Komunikatë' ? 'active' : '' }}" data-filter="Komunikatë">Komunikatë</button>
        </div>

        <div class="row g-4">
            @forelse($notifications as $notification)
            <div class="col-lg-4 col-md-6 news-card" data-category="{{ strtolower($notification->notificationType) }}">
                <div class="card h-100 shadow-sm border-0">
                    @if($notification->imageUrl)
                    <img src="{{ route('notifications.image', $notification) }}" class="card-img-top" alt="{{ $notification->title }}" style="height: 200px; object-fit: cover;">
                    @else
                    <div class="card-img-top bg-secondary" style="height: 200px;"></div>
                    @endif
                    <div class="card-body">
                        <h5 class="card-title fw-bold">{{ $notification->title }}</h5>
                        <p class="card-text text-muted">
                            {{ Str::limit($notification->description, 100) }}
                        </p>
                    </div>
                    <div class="card-footer bg-white border-0 d-flex justify-content-between align-items-center">
                        <small class="text-muted">Publikuar: {{ $notification->datetime->format('Y-m-d') }}</small>
                        <a href="{{ route('showNotification', $notification) }}" class="btn btn-sm btn-primary">Lexo më shumë</a>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12">
                <div class="alert alert-info">Nuk ka njoftime të disponueshme.</div>
            </div>
            @endforelse
        </div>

        {{-- Pagination --}}
        @if($notifications->hasPages())
        <div class="d-flex justify-content-center mt-4">
            {{ $notifications->links() }}
        </div>
        @endif
    </div>
</section>
@endsection

@push('scripts')
<script>
const filterButtons = document.querySelectorAll("[data-filter]");
const newsCards = document.querySelectorAll(".news-card");

function filterNews(category) {
    newsCards.forEach((card) => {
        card.style.display =
            category === "all" || card.dataset.category === category.toLowerCase()
                ? "block"
                : "none";
    });

    filterButtons.forEach((btn) => {
        btn.classList.toggle("active", btn.dataset.filter === category);
    });
}

// Initialize with current filter
document.addEventListener('DOMContentLoaded', () => {
    const currentFilter = "{{ $activeFilter }}";
    if (currentFilter !== 'all') {
        filterNews(currentFilter);
    }
});

filterButtons.forEach((btn) => {
    btn.addEventListener("click", () => {
        const selected = btn.getAttribute("data-filter");
        // Update URL with filter parameter
        const url = new URL(window.location);
        url.searchParams.set('filter', selected);
        window.location.href = url.toString();
    });
});
</script>
@endpush
