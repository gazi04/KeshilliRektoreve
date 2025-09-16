@extends('layouts.client_app')

@section('title', 'Njoftimet | Universiteti Publik Kadri Zeka')

@section('content')

<div class="bg-gray-100 py-16">
    <div class="container mx-auto px-4 text-center">
        <h1 class="text-4xl font-extrabold text-gray-900 mb-2">Njoftimet</h1>
        <p class="text-lg text-gray-600">Qëndroni të informuar me lajmet dhe njoftimet më të fundit nga universiteti.</p>
    </div>
</div>

<div class="container mx-auto px-4 py-8">
    <div class="flex flex-wrap justify-center gap-4 mb-8">
        @php
            $baseBtnClass = 'filter-btn font-semibold py-2 px-6 rounded-full transition-colors duration-200 border focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500';
            $activeBtnClass = 'bg-indigo-600 text-white border-transparent';
            $inactiveBtnClass = 'bg-white text-indigo-700 border-indigo-300 hover:bg-indigo-50';
        @endphp

        <button class="{{ $baseBtnClass }} {{ $activeFilter === 'all' ? $activeBtnClass : $inactiveBtnClass }}" data-filter="all">Të Gjitha</button>
        <button class="{{ $baseBtnClass }} {{ $activeFilter === 'Lajm' ? $activeBtnClass : $inactiveBtnClass }}" data-filter="Lajm">Lajm</button>
        <button class="{{ $baseBtnClass }} {{ $activeFilter === 'Konkurs' ? $activeBtnClass : $inactiveBtnClass }}" data-filter="Konkurs">Konkurs</button>
        <button class="{{ $baseBtnClass }} {{ $activeFilter === 'Komunikatë' ? $activeBtnClass : $inactiveBtnClass }}" data-filter="Komunikatë">Komunikatë</button>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @forelse($notifications as $notification)
            <div class="news-card bg-white rounded-xl shadow-lg border border-gray-200 overflow-hidden hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1">
                @if($notification->imageUrl)
                    <img src="{{ route('notifications.image', $notification) }}" alt="{{ $notification->title }}" class="w-full h-52 object-cover rounded-t-xl" />
                @else
                    <div class="w-full h-52 bg-gray-300 rounded-t-xl flex items-center justify-center text-gray-400">
                        <svg class="w-24 h-24" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
                        </svg>
                    </div>
                @endif
                <div class="p-6">
                    <span class="inline-block bg-primary-100 text-primary-800 text-xs font-medium px-2.5 py-0.5 rounded-full mb-3">{{ $notification->notificationType }}</span>
                    <h5 class="text-xl font-bold text-gray-900 mb-2 leading-tight">{{ $notification->title }}</h5>
                    <p class="text-gray-600 text-sm mb-4">{{ Str::limit($notification->description, 100) }}</p>
                </div>
                <div class="flex justify-between items-center p-6 border-t border-gray-200">
                    <small class="text-gray-500 text-xs">Publikuar: {{ $notification->datetime->format('Y-m-d') }}</small>
                    <a href="{{ route('showNotification', $notification) }}" class="text-sm font-semibold text-primary-600 hover:text-primary-800 transition-colors duration-200">Lexo më shumë &rarr;</a>
                </div>
            </div>
        @empty
            <div class="col-span-full mx-auto max-w-lg text-center">
                <div class="bg-blue-100 border border-blue-400 text-blue-700 px-4 py-6 rounded-lg" role="alert">
                    <p class="font-bold mb-2">Info:</p>
                    <p>Nuk ka njoftime të disponueshme.</p>
                </div>
            </div>
        @endforelse
    </div>

    @if($notifications->hasPages())
        <div class="mt-8">
            {{ $notifications->links('pagination::tailwind') }}
        </div>
    @endif
</div>
@endsection

@push('scripts')
{{-- IMPROVEMENT: Removed old complex script and replaced with this simple, correct version. --}}
<script>
document.querySelectorAll(".filter-btn").forEach((button) => {
    button.addEventListener("click", () => {
        const filterValue = button.dataset.filter;
        const currentUrl = new URL(window.location.href);

        // Set the new filter parameter
        currentUrl.searchParams.set('filter', filterValue);

        // Always go back to page 1 when changing the filter to avoid errors
        currentUrl.searchParams.delete('page');

        // Reload the page with the new URL
        window.location.href = currentUrl.toString();
    });
});
</script>
@endpush
