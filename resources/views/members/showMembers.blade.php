@extends('members.layout')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Detajet e Anëtarit: {{ $member->full_name }}</div>

                    <div class="card-body">
                        <div class="text-center mb-4">
                            @if($member->imageUrl)
                                <img src="{{ asset('storage/' . $member->imageUrl) }}" alt="{{ $member->name }}"
                                    class="rounded-circle" style="width: 150px; height: 150px; object-fit: cover;">
                            @else
                                <div class="bg-secondary rounded-circle d-flex align-items-center justify-content-center mx-auto"
                                    style="width: 150px; height: 150px;">
                                    <i class="fas fa-user text-white" style="font-size: 5rem;"></i>
                                </div>
                            @endif
                            <h3 class="mt-3">{{ $member->full_name }}</h3>
                            <h5 class="text-muted">{{ $member->position }}</h5>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <p><strong>ID:</strong> {{ $member->id }}</p>
                                <p><strong>Renditja:</strong> {{ $member->orderNr }}</p>
                            </div>
                            <div class="col-md-6">
                                @if($member->email)
                                    <p><strong>Email:</strong>
                                        <a href="mailto:{{ $member->email }}">{{ $member->email }}</a>
                                    </p>
                                @endif
                                <p><strong>Krijuar më:</strong> {{ $member->created_at->format('d/m/Y H:i') }}</p>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between mt-4">
                            <a href="{{ route('members.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Kthehu
                            </a>
                            <div>
                                <a href="{{ route('members.edit', $member) }}" class="btn btn-warning">
                                    <i class="fas fa-edit"></i> Edito
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection