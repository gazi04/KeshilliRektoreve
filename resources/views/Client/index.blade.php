@extends('layouts.client_app')

@section('title', 'Ballina - Universiteti Publik Kadri Zeka')

@section('content')
{{-- Slider Section --}}
@if($sliderNotifications->isNotEmpty())
<div id="mainSlider" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">
        @foreach($sliderNotifications as $notification)
        <div class="carousel-item @if($loop->first) active @endif">
            <img src="{{ route('notifications.image', $notification) }}" class="d-block w-100" style="height:450px;object-fit:cover" alt="{{ $notification->title }}">
            <div class="carousel-caption d-none d-md-block bg-dark bg-opacity-50 rounded p-3">
                <h5 class="text-white">{{ $notification->title }}</h5>
                <p class="text-light">{{ Str::limit($notification->description, 100) }}</p>
                <a href="{{ route('showNotification', $notification) }}" class="btn btn-link p-0 text-white text-decoration-none">
                    Lexo më shumë <i class="bi bi-arrow-right"></i>
                </a>
            </div>
        </div>
        @endforeach
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#mainSlider" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#mainSlider" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>
@endif

{{-- Stats Section (Remains Static as per view) --}}
<div class="container mt-5">
    <div class="row text-center mb-4 g-4">
        <div class="col-md-3">
            <div class="card bg-light border-0 shadow-sm h-100">
                <div class="card-body">
                    <h5 class="card-title text-primary">12</h5>
                    <p class="card-text">Fakultete</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-light border-0 shadow-sm h-100">
                <div class="card-body">
                    <h5 class="card-title text-primary">5,000+</h5>
                    <p class="card-text">Studentë aktiv</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-light border-0 shadow-sm h-100">
                <div class="card-body">
                    <h5 class="card-title text-primary">20</h5>
                    <p class="card-text">Konferenca këtë vit</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-light border-0 shadow-sm h-100">
                <div class="card-body">
                    <h5 class="card-title text-primary">10+</h5>
                    <p class="card-text">Kërkime shkencores</p>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- News Section --}}
<section class="py-5">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="display-5 fw-bold mb-0">Lajmet<span class="text-primary">.</span></h2>
            <a href="{{ route('njoftimet') }}" class="text-primary fw-semibold text-decoration-none">
                Shiko të gjitha <i class="bi bi-arrow-right"></i>
            </a>
        </div>

        <div class="row g-4">
            @if($mainNews)
            <div class="col-lg-8">
                <div class="row g-0 bg-light rounded overflow-hidden shadow-sm h-100">
                    <div class="col-md-6">
                        <img src="{{ route('notifications.image', $mainNews) }}" loading="lazy" alt="{{ $mainNews->title }}" class="img-fluid h-100 w-100 object-fit-cover" />
                    </div>
                    <div class="col-md-6 p-4 d-flex flex-column justify-content-between">
                        <div>
                            <span class="badge bg-primary mb-2">{{ $mainNews->notificationType }}</span>
                            <h3 class="fw-bold">{{ $mainNews->title }}</h3>
                            <p class="text-muted small">{{ Str::limit($mainNews->description, 200) }}</p>
                        </div>
                        <a href="{{ route('showNotification', $mainNews) }}" class="fw-semibold text-primary text-decoration-none">
                            Lexo më shumë <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
            @endif

            @if($otherNews->isNotEmpty())
            <div class="col-lg-4">
                <div class="row g-3">
                    @foreach($otherNews as $news)
                    <div class="col-12 d-flex">
                        <img src="{{ route('notifications.image', $news) }}" alt="{{ $news->title }}" loading="lazy" class="flex-shrink-0 rounded me-3" width="100" height="100" style="object-fit: cover;" />
                        <div>
                            <h6 class="fw-bold mb-1">{{ Str::limit($news->title, 50) }}</h6>
                            <p class="small text-muted mb-0">{{ Str::limit($news->description, 60) }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif
        </div>
    </div>
</section>

{{-- Members Section --}}
<section id="members" class="py-5 bg-white">
    <div class="container">
        <h2 class="mb-4 text-black">Anëtarët e Këshillit</h2>

        @if($members->isNotEmpty())
        <div id="membersScroll" class="scroll-container d-flex flex-nowrap overflow-x-auto pb-4" style="scroll-behavior: smooth;">
            @foreach($members as $member)
            <div class="col-md-3 flex-shrink-0 px-2">
                <div class="card shadow-sm border-0 h-100">
                    <img src="{{ route('members.image', $member) }}" class="card-img-top" alt="{{ $member->name }}" style="height: 200px; object-fit: cover;">
                    <div class="card-body">
                        <h5 class="card-title fw-bold">{{ $member->name }}</h5>
                        <p class="card-text text-muted mb-0">{{ $member->position }}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <p class="text-center">No members found.</p>
        @endif
    </div>
</section>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const scrollContainer = document.querySelector('#membersScroll');
        if (!scrollContainer) return;

        const scrollAmount = scrollContainer.querySelector('.col-md-3').offsetWidth + 16; 
        const maxScroll = scrollContainer.scrollWidth - scrollContainer.clientWidth;
        let isDragging = false;
        let startPos = 0;
        let currentScroll = 0;

        function scrollToNextCard(direction) {
            const currentScrollPos = scrollContainer.scrollLeft;
            const targetScroll = direction === 'next'
                ? Math.min(currentScrollPos + scrollAmount, maxScroll)
                : Math.max(currentScrollPos - scrollAmount, 0);
            scrollContainer.scrollTo({ left: targetScroll, behavior: 'smooth' });
        }

        document.addEventListener('keydown', (e) => {
            if (e.key === 'ArrowRight') {
                e.preventDefault();
                scrollToNextCard('next');
            } else if (e.key === 'ArrowLeft') {
                e.preventDefault(); 
                scrollToNextCard('prev');
            }
        });

        scrollContainer.addEventListener('mousedown', (e) => {
            isDragging = true;
            startPos = e.clientX;
            currentScroll = scrollContainer.scrollLeft;
            scrollContainer.style.cursor = 'grabbing';
            scrollContainer.style.scrollSnapType = 'none'; 
            e.preventDefault();
        });

        scrollContainer.addEventListener('mousemove', (e) => {
            if (!isDragging) return;
            e.preventDefault();
            const x = e.clientX;
            const walk = (startPos - x) * 1.5; // Adjust scroll speed
            let newScroll = currentScroll + walk;
            newScroll = Math.max(0, Math.min(newScroll, maxScroll)); 
            scrollContainer.scrollLeft = newScroll;
        });

        scrollContainer.addEventListener('mouseup', () => {
            if (!isDragging) return;
            isDragging = false;
            scrollContainer.style.cursor = 'grab';
            scrollContainer.style.scrollSnapType = 'x mandatory';
            const currentScrollPos = scrollContainer.scrollLeft;
            let nearestCard = Math.round(currentScrollPos / scrollAmount) * scrollAmount;
            if (currentScrollPos >= maxScroll - scrollAmount / 4) {
                nearestCard = maxScroll;
            }
            scrollContainer.scrollTo({ left: nearestCard, behavior: 'smooth' });
        });

        scrollContainer.addEventListener('mouseleave', () => {
            if (!isDragging) return;
            isDragging = false;
            scrollContainer.style.cursor = 'grab';
            scrollContainer.style.scrollSnapType = 'x mandatory';
            const currentScrollPos = scrollContainer.scrollLeft;
            let nearestCard = Math.round(currentScrollPos / scrollAmount) * scrollAmount;
            if (currentScrollPos >= maxScroll - scrollAmount / 4) { 
                nearestCard = maxScroll;
            }
            scrollContainer.scrollTo({ left: nearestCard, behavior: 'smooth' });
        });

        scrollContainer.style.cursor = 'grab';
    });
</script>
{{-- Conferences Section --}}
@if($conferences->isNotEmpty())
<section id="conferences" class="py-5 bg-primary text-white">
    <div class="container">
        <h2 class="mb-4 text-white">Konferenca</h2>
        <div class="row border-top border-white border-2 pt-3 g-3">
            @foreach($conferences as $conference)
            <div class="col-md-6 col-lg-3">
                <div class="d-flex flex-column h-100 ps-3 pe-3 @if(!$loop->last) border-end border-white @endif">
                    <small class="text-light">{{ $conference->date->format('d M Y') }}</small>
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('showConference', $conference) }}" class="text-white text-decoration-none fw-semibold">{{ $conference->title }}</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- Documents Section --}}
@if($documents->isNotEmpty())
<section id="documents" class="py-5 bg-white">
    <div class="container">
        <h2 class="mb-4 text-dark">Dokumente</h2>
        <div class="list-group">
            @foreach($documents as $document)
            <a href="{{ route('downloadDocument', $document) }}" class="list-group-item list-group-item-action border-secondary border-bottom" download>
                {{ $document->title }}
            </a>
            @endforeach
        </div>
    </div>
</section>
@endif
@endsection
