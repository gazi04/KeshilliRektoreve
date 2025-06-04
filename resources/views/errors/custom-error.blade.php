@extends('layouts.app')

@section('title', 'Something Went Wrong')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8 text-center">
            <div class="card shadow-lg p-4">
                <h1 class="display-4 text-danger mb-4">Oops!</h1>
                <h2 class="mb-3">Something went wrong on our end.</h2>
                <p class="lead">
                    We're sorry, but we encountered an unexpected error while trying to load this page.
                    Please try again later or contact support if the problem persists.
                </p>
                @isset($message)
                    <p class="text-muted">{{ $message }}</p>
                @endisset
                <hr class="my-4">
                <a href="{{ url()->previous() }}" class="btn btn-outline-primary me-2">Go Back</a>
                <a href="{{ route('admin.index') }}" class="btn btn-primary">Go to Dashboard</a>
            </div>
        </div>
    </div>
</div>
@endsection
