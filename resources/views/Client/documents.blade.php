@extends('layouts.client_app')

@section('title', 'Dokumentet | Universiteti Publik Kadri Zeka')

@section('content')

<div class="bg-gray-100 py-16">
    <div class="container mx-auto px-4 text-center">
        <h1 class="text-4xl font-extrabold text-gray-900 mb-2">Dokumente</h1>
        <p class="text-lg text-gray-600">Shfletoni dhe shkarkoni dokumentet e rëndësishme akademike dhe administrative.</p>
    </div>
</div>

<section class="container mx-auto px-4 py-12">
    <div class="bg-white rounded-xl shadow-lg divide-y divide-gray-200 overflow-hidden">
        @forelse($documents as $document)
            <a href="{{ route('downloadDocument', $document) }}"
               class="flex items-center justify-between p-6 hover:bg-gray-50 transition-colors duration-200"
               download="{{ Str::slug($document->title) }}">
                <div class="flex items-center space-x-4">
                    <svg class="w-6 h-6 text-primary-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2-10V4a2 2 0 00-2-2H5a2 2 0 00-2 2v16a2 2 0 002 2h14a2 2 0 002-2V9m-1-4V3m-1-4h-4m-2 4V3m-1-4h-4" />
                    </svg>
                    <span class="text-lg font-medium text-gray-800">{{ $document->title }}</span>
                </div>
                <div class="flex items-center space-x-2 text-primary-600 font-semibold">
                    <span>Shkarko</span>
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                    </svg>
                </div>
            </a>
        @empty
            <div class="p-6 text-center text-gray-500">
                <p>Nuk ka dokumente të disponueshme.</p>
            </div>
        @endforelse
    </div>

    {{-- Pagination --}}
    @if($documents->hasPages())
        <div class="mt-8">
            {{ $documents->links('pagination::tailwind') }}
        </div>
    @endif
</section>

@endsection
