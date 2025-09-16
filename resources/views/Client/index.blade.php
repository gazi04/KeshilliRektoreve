@extends('layouts.client_app')

@section('title', 'Ballina - Këshilli i Rektorëve')

@section('content')

<div class="relative w-full overflow-hidden mb-12">
    @if($sliderNotifications->isNotEmpty())
    <div id="mainSlider" class="relative w-full">
        <div class="flex transition-transform duration-500 ease-in-out" style="transform: translateX(0%);" data-carousel-items>
            @foreach($sliderNotifications as $notification)
            <div class="w-full flex-shrink-0 relative h-[450px] lg:h-[600px]">
                <img src="{{ route('notifications.image', $notification) }}" class="absolute inset-0 w-full h-full object-cover" alt="{{ $notification->title }}">

                <div class="absolute inset-0 bg-black/40"></div>

                <div class="absolute inset-0 flex items-end">
                    <div class="container mx-auto px-4 py-8">
                        <div class="bg-black/60 backdrop-blur-sm p-6 rounded-lg max-w-xl text-white">
                            <h2 class="text-2xl lg:text-4xl font-extrabold mb-2">{{ $notification->title }}</h2>
                            <p class="mb-4 text-sm lg:text-base">{{ Str::limit($notification->description, 150) }}</p>
                            <a href="{{ route('showNotification', $notification) }}" class="inline-flex items-center text-primary-400 hover:text-primary-300 font-semibold transition-colors duration-200">
                                Lexo më shumë
                                <i class="fas fa-arrow-right ml-2 text-sm"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <button class="absolute top-1/2 left-4 transform -translate-y-1/2 bg-white bg-opacity-30 hover:bg-opacity-50 text-white rounded-full p-2 transition-colors duration-200" data-carousel-prev>
            <i class="fas fa-chevron-left text-xl"></i>
        </button>
        <button class="absolute top-1/2 right-4 transform -translate-y-1/2 bg-white bg-opacity-30 hover:bg-opacity-50 text-white rounded-full p-2 transition-colors duration-200" data-carousel-next>
            <i class="fas fa-chevron-right text-xl"></i>
        </button>
    </div>
    @endif
</div>

<section class="container mx-auto px-4 py-12">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-4xl font-bold text-gray-900">Lajmet<span class="text-primary-600">.</span></h2>
        <a href="{{ route('njoftimet') }}" class="text-primary-600 hover:text-primary-800 transition-colors duration-200 flex items-center">
            Shiko të gjitha
            <i class="fas fa-arrow-right ml-2 text-sm"></i>
        </a>
    </div>

    @if($mainNews)
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <div class="lg:col-span-2">
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden group">
                <a href="{{ route('showNotification', $mainNews) }}" class="block">
                    <img src="{{ route('notifications.image', $mainNews) }}" loading="lazy" alt="{{ $mainNews->title }}" class="w-full h-80 object-cover transition-transform duration-300 group-hover:scale-105" />
                    <div class="p-6">
                        <span class="inline-block bg-primary-100 text-primary-600 text-xs font-semibold px-2.5 py-0.5 rounded-full mb-2">
                            {{ $mainNews->notificationType }}
                        </span>
                        <h3 class="text-2xl font-bold text-gray-900 mb-2 group-hover:text-primary-600 transition-colors duration-200">{{ $mainNews->title }}</h3>
                        <p class="text-gray-600">{{ Str::limit($mainNews->description, 200) }}</p>
                    </div>
                </a>
            </div>
        </div>
        <div class="lg:col-span-1 space-y-4">
            @foreach($otherNews as $news)
            <a href="{{ route('showNotification', $news) }}" class="flex items-center space-x-4 p-4 bg-white rounded-lg shadow-md hover:shadow-xl transition-all duration-300 group">
                <img src="{{ route('notifications.image', $news) }}" alt="{{ $news->title }}" loading="lazy" class="w-24 h-24 flex-shrink-0 object-cover rounded-md" />
                <div>
                    <h4 class="text-lg font-semibold text-gray-900 group-hover:text-primary-600 transition-colors duration-200">{{ Str::limit($news->title, 50) }}</h4>
                    <p class="text-gray-500 text-sm mt-1">{{ Str::limit($news->description, 60) }}</p>
                </div>
            </a>
            @endforeach
        </div>
    </div>
    @endif
</section>

<section id="members" class="bg-primary-50 py-12">
    <div class="container mx-auto px-4">
        <h2 class="text-4xl font-bold text-gray-900 mb-6">Anëtarët e Këshillit<span class="text-primary-600">.</span></h2>
        @if($members->isNotEmpty())
        <div id="membersScroll" class="flex overflow-x-auto space-x-6 pb-4 -mx-4 px-4 custom-scrollbar">
            @foreach($members as $member)
            <div class="flex-shrink-0 w-64">
                <div class="bg-white rounded-2xl shadow-lg h-full overflow-hidden flex flex-col">
                    <img src="{{ route('members.image', $member) }}" class="w-full h-56 object-cover" alt="{{ $member->name }}">
                    <div class="p-4 text-center flex-grow">
                        <h5 class="font-bold text-lg mb-1">{{ $member->name }}</h5>
                        <p class="text-sm text-gray-500">{{ $member->position }}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <p class="text-center text-gray-500">Nuk u gjetën anëtarë.</p>
        @endif
    </div>
</section>

@if($conferences->isNotEmpty())
<section id="conferences" class="bg-primary-600 text-black py-12">
    <div class="container mx-auto px-4">
        <h2 class="text-4xl font-bold mb-8">Konferenca</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 border-t border-black pt-6">
            @foreach($conferences as $conference)
            <div class="flex flex-col space-y-2">
                <span class="text-sm font-light text-primary-200">{{ $conference->date->format('d M Y') }}</span>
                <a href="{{ route('showConference', $conference) }}" class="text-xl font-semibold hover:underline">{{ $conference->title }}</a>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

@if($documents->isNotEmpty())
<section id="documents" class="bg-gray-100 py-12">
    <div class="container mx-auto px-4">
        <h2 class="text-4xl font-bold text-gray-900 mb-6">Dokumente<span class="text-primary-600">.</span></h2>
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            @foreach($documents as $document)
            <a href="{{ route('downloadDocument', $document) }}" class="flex items-center justify-between p-4 border-b last:border-b-0 border-gray-200 hover:bg-gray-50 transition-colors duration-200" download>
                <span class="text-gray-700 font-medium flex-1">{{ $document->title }}</span>
                <i class="fas fa-download text-primary-600"></i>
            </a>
            @endforeach
        </div>
    </div>
</section>
@endif

<style>
    .custom-scrollbar::-webkit-scrollbar {
        height: 8px;
    }

    .custom-scrollbar::-webkit-scrollbar-track {
        background-color: #f1f5f9;
        border-radius: 4px;
    }

    .custom-scrollbar::-webkit-scrollbar-thumb {
        background-color: #cbd5e1;
        border-radius: 4px;
    }

    .custom-scrollbar::-webkit-scrollbar-thumb:hover {
        background-color: #94a3b8;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const carousel = document.querySelector('#mainSlider');
        const itemsContainer = carousel.querySelector('[data-carousel-items]');
        const prevBtn = carousel.querySelector('[data-carousel-prev]');
        const nextBtn = carousel.querySelector('[data-carousel-next]');
        const totalItems = itemsContainer.children.length;
        let currentIndex = 0;

        const updateCarousel = () => {
            const offset = -currentIndex * 100;
            itemsContainer.style.transform = `translateX(${offset}%)`;
        };

        prevBtn.addEventListener('click', () => {
            currentIndex = (currentIndex > 0) ? currentIndex - 1 : totalItems - 1;
            updateCarousel();
        });

        nextBtn.addEventListener('click', () => {
            currentIndex = (currentIndex < totalItems - 1) ? currentIndex + 1 : 0;
            updateCarousel();
        });

        // Autoplay
        setInterval(() => {
            nextBtn.click();
        }, 5000);
    });
</script>
@endsection
