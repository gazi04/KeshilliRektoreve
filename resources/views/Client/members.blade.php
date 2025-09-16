@extends('layouts.client_app')

@section('title', 'Anëtarët e këshillit | Universiteti Publik Kadri Zeka')

@section('content')

<div class="bg-gray-100 py-16">
    <div class="container mx-auto px-4 text-center">
        <h1 class="text-4xl font-extrabold text-gray-900 mb-2">Anëtarët e Këshillit</h1>
        <p class="text-lg text-gray-600">Njihuni me stafin dhe anëtarët e shquar të këshillit tonë.</p>
    </div>
</div>

<section class="container mx-auto px-4 py-12">
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
        @forelse($members as $member)
            <div class="relative bg-white rounded-xl shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1">
                <div class="overflow-hidden">
                    @if($member->imageUrl)
                        <img
                            src="{{ route('members.image', $member) }}"
                            alt="{{ $member->name }}"
                            class="w-full h-72 object-cover object-top rounded-t-xl transition-transform duration-300 hover:scale-105"
                        />
                    @else
                        <div class="w-full h-72 bg-gray-300 flex items-center justify-center rounded-t-xl">
                            <svg class="w-24 h-24 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.571 0 5.136.608 7.08 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm-3 8h.01" />
                            </svg>
                        </div>
                    @endif
                </div>
                <div class="p-6 text-center">
                    <h5 class="text-xl font-bold text-gray-900 mb-1">{{ $member->name }}</h5>
                    <p class="text-sm font-medium text-primary-600 mb-4">{{ $member->position }}</p>
                    @if($member->email)
                        <div class="flex items-center justify-center text-gray-500 text-sm">
                            <svg class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                            <span>{{ $member->email }}</span>
                        </div>
                    @endif
                </div>
            </div>
        @empty
            <div class="w-full">
                <div class="bg-blue-100 border border-blue-400 text-blue-700 px-4 py-3 rounded-lg text-center" role="alert">
                    <span class="font-bold">Info:</span> Nuk ka anëtarë të regjistruar.
                </div>
            </div>
        @endforelse
    </div>

    @if($members->hasPages())
        <div class="mt-12">
            {{ $members->links('pagination::tailwind') }}
        </div>
    @endif
</section>

@endsection
