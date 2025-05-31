@extends('members.layout')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Shto Anëtar të Ri</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('members.store') }}" enctype="multipart/form-data">
                            @csrf

                            <div class="mb-3">
                                <label class="form-label">Titulli</label>
                                <input type="text" name="title" class="form-control" value="{{ old('title') }}">
                                @error('title') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Emri i Plotë *</label>
                                <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
                                @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Pozita *</label>
                                <input type="text" name="position" class="form-control" value="{{ old('position') }}"
                                    required>
                                @error('position') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" name="email" class="form-control" value="{{ old('email') }}">
                                @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Renditja *</label>
                                <input type="number" name="orderNr" class="form-control"
                                    value="{{ old('orderNr', $nextOrder ?? 1) }}" min="1" required>
                                @error('orderNr') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Foto Profili *</label>
                                <input type="file" name="imageUrl" class="form-control" accept="image/*" required>
                                @error('imageUrl') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            <button type="submit" class="btn btn-primary">Krijo Anëtar</button>
                            <a href="{{ route('members.index') }}" class="btn btn-secondary">Anulo</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection