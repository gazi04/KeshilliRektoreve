@extends('members.layout')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edito Anëtarin: {{ $member->name }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('members.update', $member) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="form-group mb-3">
                            <label for="title">Titulli</label>
                            <input type="text" name="title" id="title" class="form-control" 
                                   value="{{ $member->title }}"
                                   placeholder="P.sh. Dr. Sc., Prof.">
                        </div>

                        <div class="form-group mb-3">
                            <label for="name">Emri i Plotë *</label>
                            <input type="text" name="name" id="name" class="form-control" 
                                   value="{{ $member->name }}" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="position">Pozita *</label>
                            <input type="text" name="position" id="position" class="form-control" 
                                   value="{{ $member->position }}" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="email">Email</label>
                            <input type="email" name="email" id="email" class="form-control" 
                                   value="{{ $member->email }}">
                        </div>

                        <div class="form-group mb-3">
                            <label for="orderNr">Renditja *</label>
                            <input type="number" name="orderNr" id="orderNr" class="form-control" 
                                   value="{{ $member->orderNr }}" required min="1">
                        </div>

                        <div class="form-group mb-3">
                            <label for="imageUrl">Foto Profili</label>
                            <input type="file" name="imageUrl" id="imageUrl" class="form-control">
                            
                            @if($member->imageUrl)
                                <div class="mt-2">
                                    <img src="{{ asset('storage/' . $member->imageUrl) }}" 
                                         alt="{{ $member->name }}" 
                                         style="max-width: 200px;">
                                    <p class="text-muted">Foto aktuale</p>
                                </div>
                            @endif
                        </div>

                        <button type="submit" class="btn btn-primary">Përditëso</button>
                        <a href="{{ route('members.index') }}" class="btn btn-secondary">Anulo</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection