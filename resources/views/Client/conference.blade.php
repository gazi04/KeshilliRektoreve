@extends('layouts.client_app')

@section('title', $conference->title . ' | Universiteti Publik Kadri Zeka')

@section('content')
<!-- Hero Banner -->
<header class="hero text-center text-white" style="background: url('{{ asset('img/slide1.jpeg') }}') center center / cover no-repeat; padding: 150px 0;">
    <div class="container">
        <h1 class="display-4 fw-bold">{{ $conference->title }}</h1>
        <p class="lead">Universiteti Publik "Kadri Zeka" në Gjilan</p>
        <p><span class="badge bg-light text-dark fs-6">{{ $conference->date->format('d-m-Y') }}</span></p>
    </div>
</header>

<section class="py-5 bg-light">
    <div class="container">
        <div class="row g-5">
            <div class="col-md-8">
                <h2 class="text-center mb-4">Dokumentet e Konferencës</h2>
                @if($conference->documents->count() > 0)
                <ul class="list-group">
                    @foreach($conference->documents as $document)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        {{ $document->title }}
                        <a href="{{ route('downloadDocument', $document) }}" class="btn btn-primary btn-sm" download>
                            Shkarko
                        </a>
                    </li>
                    @endforeach
                </ul>
                @else
                <p class="text-center">Nuk ka dokumente të disponueshme për këtë konferencë.</p>
                @endif
            </div>

            <div class="col-md-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="mb-3 text-dark">Rreth Konferencës</h5>
                        <p>{{ $conference->description }}</p>

                        @if($conference->location)
                        <h5 class="mt-4 text-dark">Vendndodhja</h5>
                        <p><i class="bi bi-geo-alt-fill"></i> {{ $conference->location }}</p>
                        @endif

                        @if($conference->registration_link)
                        <a href="{{ $conference->registration_link }}" class="btn btn-primary mt-3" target="_blank">
                            Regjistrohu tani
                        </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
