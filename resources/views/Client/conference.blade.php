@extends('layouts.client_app')

@section('title', $conference->title . ' | Universiteti Publik Kadri Zeka')

@section('content')

<header class="w-full py-16 lg:py-20 bg-gray-100 flex items-center justify-center">
    <div class="relative container mx-auto px-4 text-center">
        <h1 class="text-3xl lg:text-5xl font-extrabold mb-4 text-gray-900">{{ $conference->title }}</h1>
        <span class="inline-block bg-primary-600 px-4 py-1 rounded-full text-lg font-semibold shadow-md text-gray-900">
            {{ $conference->date->format('d M Y') }}
        </span>
    </div>
</header>

<section class="py-12">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="md:col-span-1">
                <div class="bg-white rounded-xl shadow-lg p-8 h-full">
                    <h2 class="text-3xl font-bold text-gray-900 mb-6 border-b border-gray-200 pb-3">Rreth Konferencës</h2>
                    <p class="text-gray-600 mb-6 leading-relaxed">{{ $conference->description }}</p>

                    @if($conference->location)
                    <div class="mb-6">
                        <h4 class="text-xl font-semibold text-gray-900 mb-2">Vendndodhja</h4>
                        <p class="text-gray-600 flex items-center">
                            <svg class="w-5 h-5 text-primary-600 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            <span>{{ $conference->location }}</span>
                        </p>
                    </div>
                    @endif

                    @if($conference->registration_link)
                    <a href="{{ $conference->registration_link }}" class="w-full inline-flex justify-center items-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 transition-colors duration-200" target="_blank">
                        Regjistrohu tani
                        <svg class="w-4 h-4 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                            </svg>
                    </a>
                    @endif
                </div>
            </div>

            <div class="md:col-span-2">
                <div class="bg-white rounded-xl shadow-lg p-8">
                    <h2 class="text-3xl font-bold text-gray-900 mb-6 border-b border-gray-200 pb-3">Dokumentet e Konferencës</h2>
                    @if($conference->documents->count() > 0)
                    <ul class="divide-y divide-gray-200">
                        @foreach($conference->documents as $document)
                        <li class="flex justify-between items-center py-4">
                            <span class="text-gray-700 font-medium">{{ $document->title }}</span>
                            <a href="{{ route('downloadDocument', $document) }}" class="inline-flex items-center text-primary-600 hover:text-primary-800 transition-colors duration-200 font-semibold" download>
                                Shkarko
                                <svg class="w-4 h-4 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                </svg>
                            </a>
                        </li>
                        @endforeach
                    </ul>
                    @else
                    <p class="text-center text-gray-500 py-6">Nuk ka dokumente të disponueshme për këtë konferencë.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
