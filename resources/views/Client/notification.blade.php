@extends('layouts.client_app')

@section('title', $notification->title . ' - Universiteti Publik Kadri Zeka')

@section('content')

<header class="relative w-full h-80 md:h-96 flex items-end overflow-hidden">
    @if($notification->imageUrl)
        <img
            src="{{ route('notifications.image', $notification) }}"
            alt="{{ $notification->title }}"
            class="absolute inset-0 w-full h-full object-cover object-center"
        />
        <div class="absolute inset-0 bg-primary-900 bg-opacity-70"></div>
    @else
        <div class="absolute inset-0 bg-gray-300"></div>
    @endif

    <div class="relative container mx-auto px-4 py-8 text-white z-10">
        <h1 class="text-3xl lg:text-5xl font-extrabold mb-2 leading-tight">
            {{ $notification->title }}
        </h1>
        <p class="text-lg text-primary-200">
            Publikuar më {{ $notification->datetime->format('d M Y') }}
        </p>
    </div>
</header>

<main class="bg-white py-12">
    <div class="container mx-auto px-4">
        <div class="flex flex-col md:flex-row gap-8">
            <aside class="md:w-1/4">
                <div class="bg-gray-50 rounded-lg p-6 shadow-md border border-gray-200">
                    <h4 class="text-xl font-semibold text-gray-800 mb-4">Informacion</h4>
                    <ul class="text-gray-600 space-y-3">
                        <li class="flex items-center">
                            <svg class="w-5 h-5 text-primary-600 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            <span>{{ $notification->datetime->format('d M Y') }}</span>
                        </li>
                        <li class="flex items-center">
                            <svg class="w-5 h-5 text-primary-600 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h10a2 2 0 012 2v2a2 2 0 01-2 2H7a2 2 0 01-2-2V5a2 2 0 012-2zm0 8h.01M7 11h10a2 2 0 012 2v2a2 2 0 01-2 2H7a2 2 0 01-2-2v-2a2 2 0 012-2z" />
                            </svg>
                            <span class="font-bold">{{ $notification->notificationType }}</span>
                        </li>
                    </ul>
                </div>
            </aside>

            <article class="md:w-3/4">
                <div class="bg-white p-6 md:p-8 rounded-lg">
                    <h2 class="text-3xl font-bold text-gray-900 mb-6 border-b border-gray-200 pb-3">Përmbajtja e njoftimit</h2>
                    <div class="prose max-w-none text-gray-600 leading-relaxed">
                        {{-- The 'prose' class from Tailwind Typography handles basic text styling --}}
                        {{ $notification->description }}
                    </div>
                </div>
            </article>
        </div>
    </div>
</main>
@endsection
