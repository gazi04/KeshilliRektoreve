@extends('layouts.app')

@section('title', 'Edit Document')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h2 class="mb-0">Edit Document: {{ $document->title }}</h2>
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

                    <form action="{{ route('document.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH') {{-- Use PATCH method for updates --}}

                        {{-- Hidden ID field to identify which document to update --}}
                        <input type="hidden" name="id" value="{{ $document->id }}">

                        <div class="mb-3">
                            <label for="title" class="form-label">Document Title <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title', $document->title) }}" required autofocus>
                            @error('title')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="url" class="form-label">Document File (Optional, upload to replace existing)</label>
                            <input type="file" class="form-control @error('url') is-invalid @enderror" id="url" name="url">
                            @error('url')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                            <div class="form-text">Max file size: 10MB. Allowed types: .pdf, .doc, .docx, .ppt, .pptx, .odt</div>
                        </div>

                        <div class="mb-3">
                            <label for="type" class="form-label">Document Type <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('type') is-invalid @enderror" id="type" name="type" value="{{ old('type', $document->type) }}" placeholder="e.g., Presentation, Paper, Abstract" required>
                            @error('type')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="conferenceId" class="form-label">Associated Conference <span class="text-danger">*</span></label>
                            <select class="form-select @error('conferenceId') is-invalid @enderror" id="conferenceId" name="conferenceId" required>
                                <option value="">Select a Conference</option>
                                @foreach ($conferences as $conference)
                                    <option value="{{ $conference->id }}" {{ old('conferenceId', $document->conferenceId) == $conference->id ? 'selected' : '' }}>
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

                        <div class="d-flex justify-content-between align-items-center gap-4">
                            <button type="submit" class="btn btn-primary">Update Document</button>
                            <a href="{{ route('document.index') }}" class="btn btn-secondary">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
