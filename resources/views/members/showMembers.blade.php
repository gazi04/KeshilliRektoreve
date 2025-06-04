@extends('layouts.app')

@section('title', 'Member Details')

@section('content')
<div class="container mt-4">
    <h1 class="text-center text-primary mb-4">Member Details: {{ $member->name }}</h1>

    <div class="card shadow-sm p-4">
        <div class="row">
            <div class="col-md-4 text-center">
                @if ($member->imageUrl)
                    <img src="{{ route('members.image', $member) }}" alt="{{ $member->name }}" class="img-fluid rounded mb-3" style="max-height: 300px; object-fit: cover;">
                @else
                    <img src="https://via.placeholder.com/300?text=No+Image" alt="No Image" class="img-fluid rounded mb-3" style="max-height: 300px; object-fit: cover;">
                @endif
            </div>
            <div class="col-md-8">
                <dl class="row">
                    <dt class="col-sm-4">Order Number:</dt>
                    <dd class="col-sm-8">{{ $member->orderNr }}</dd>

                    <dt class="col-sm-4">Title:</dt>
                    <dd class="col-sm-8">{{ $member->title ?? 'N/A' }}</dd>

                    <dt class="col-sm-4">Name:</dt>
                    <dd class="col-sm-8">{{ $member->name }}</dd>

                    <dt class="col-sm-4">Position:</dt>
                    <dd class="col-sm-8">{{ $member->position }}</dd>

                    <dt class="col-sm-4">Email:</dt>
                    <dd class="col-sm-8">{{ $member->email ?? 'N/A' }}</dd>

                    <dt class="col-sm-4">Created At:</dt>
                    <dd class="col-sm-8">{{ $member->created_at->format('Y-m-d H:i') }}</dd>

                    <dt class="col-sm-4">Last Updated:</dt>
                    <dd class="col-sm-8">{{ $member->updated_at->format('Y-m-d H:i') }}</dd>
                </dl>
            </div>
        </div>
        <div class="d-flex justify-content-between mt-4">
            <a href="{{ route('members.edit', $member) }}" class="btn btn-primary">Edit Member</a>
            <a href="{{ route('members.index') }}" class="btn btn-secondary">Back to Members List</a>
        </div>
    </div>
</div>
@endsection
