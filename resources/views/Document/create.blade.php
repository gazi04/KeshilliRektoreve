@extends('layouts.app')

@section('title', 'Create Document')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h2 class="mb-0">Create New Document</h2>
                </div>
                <div class="card-body">
                    {{-- Display Validation Errors --}}
                    @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Whoops! There were some problems with your input.</strong>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif

                    <form action="{{ route('document.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label for="title" class="form-label">Document Title <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title') }}" required autofocus>
                            @error('title')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="url" class="form-label">Document File (PDF, Word, PPT) <span class="text-danger">*</span></label>
                            <input type="file" class="form-control @error('url') is-invalid @enderror" id="url" name="url" required>
                            @error('url')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                            <div class="form-text">Max file size: 10MB. Allowed types: .pdf, .doc, .docx, .ppt, .pptx, .odt</div>
                        </div>

                        {{-- MODIFICATION START: Changed from select to text input --}}
                        <div class="mb-3">
                            <label for="type" class="form-label">Document Type <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('type') is-invalid @enderror" id="type" name="type" value="{{ old('type') }}" placeholder="e.g., Presentation, Paper, Abstract" required>
                            @error('type')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        {{-- MODIFICATION END --}}

                        <div class="mb-3">
                            <!-- TODO- SHOULD I DISPLAY ALL THE CONFERENCES OR SHOULD I ONLY DISPLAY THE UPCOMING CONFERENCES -->
                            <label for="conferenceId" class="form-label">Associated Conference <span class="text-danger">*</span></label>
                            <select class="form-select @error('conferenceId') is-invalid @enderror" id="conferenceId" name="conferenceId" required>
                                <option value="">Select a Conference</option>
                                @foreach ($conferences as $conference)
                                    <option value="{{ $conference->id }}" {{ old('conferenceId') == $conference->id ? 'selected' : '' }}>
                                        {{ $conference->title }} ({{ $conference->date->format('Y-m-d') }})
                                    </option>
                                @endforeach
                            </select>
                            @error('conferenceId')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-between">
                            <button type="submit" class="btn btn-primary">Create Document</button>
                            <a href="{{ route('document.index') }}" class="btn btn-secondary">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
