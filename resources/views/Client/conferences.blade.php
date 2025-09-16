@extends('layouts.client_app')

@section('title', 'Konferencat | Universiteti Publik Kadri Zeka')

@section('content')

<div class="bg-gray-100 py-16">
    <div class="container mx-auto px-4 text-center">
        <h1 class="text-4xl font-extrabold text-gray-900 mb-2">Konferencat</h1>
        <p class="text-lg text-gray-600">Zbuloni konferencat dhe eventet tona të ardhshme.</p>
    </div>
</div>

<section class="container mx-auto px-4 py-12">
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
        @forelse($conferences as $conference)
            <div class="bg-white rounded-xl shadow-lg border border-gray-200 overflow-hidden hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1">
                <div class="p-6">
                    <h3 class="text-2xl font-bold text-gray-900 mb-3 leading-tight">{{ $conference->title }}</h3>
                    <p class="text-sm font-medium text-primary-600 mb-4 flex items-center">
                        <svg class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        <span>{{ $conference->date->format('d M Y') }}</span>
                    </p>
                    <p class="text-gray-600 mb-6">{{ Str::limit($conference->description, 150) }}</p>
                    <a href="{{ route('showConference', $conference) }}" class="inline-flex items-center text-primary-600 font-semibold hover:text-primary-800 transition-colors duration-200">
                        Lexo më shumë
                        <svg class="w-4 h-4 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                        </svg>
                    </a>
                </div>
            </div>
        @empty
            <div class="col-span-full">
                <div class="bg-blue-100 border border-blue-400 text-blue-700 px-4 py-3 rounded-lg text-center" role="alert">
                    <span class="font-bold">Info:</span> Nuk ka konferenca të disponueshme.
                </div>
            </div>
        @endforelse
    </div>

    @if($conferences->hasPages())
        <div class="mt-12">
            {{ $conferences->links('pagination::tailwind') }}
        </div>
    @endif
</section>

@endsection
