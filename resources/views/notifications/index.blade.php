@extends('layouts.app')

@section('title', 'Këshilli Rektorëve - Njoftimet')

@section('content')
<div class="container mt-4">
    <h1 class="text-center text-primary mb-4">Notifications</h1>

    {{-- Success/Error Messages --}}
    @if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    @if (session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    {{-- Validation Errors --}}
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

    <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap">


        {{-- Search and Filter Form --}}
        <form action="{{ route('notifications.index') }}" method="GET" class="d-flex flex-wrap gap-2 flex-grow-1 justify-content-end" x-data="{
            search: '{{ request('search') }}',
            type: '{{ request('type') }}',
            orderBy: '{{ request('order_by') }}',
            init() {
                this.$watch('type', value => this.submitForm());
                this.$watch('orderBy', value => this.submitForm());
            },
            submitForm() {
                this.$el.submit();
            }
        }">
        <div class="w-100 d-flex flex-wrap gap-2 mb-2 mb-md-0">
            <a href="{{ route('notifications.create') }}" class="btn btn-success mb-2 mb-md-0">
            Add New
        </a>
             <input type="text" name="search" x-model="search" placeholder="Search notifications..." class="form-control me-2 flex-grow-1 w-50">
            <div class="d-flex gap-2">
                 <button type="submit" class="btn btn-outline-primary">Search</button>

            @if (request()->filled('search') || request()->filled('type') || request()->filled('order_by'))
            <a href="{{ route('notifications.index') }}" class="btn btn-outline-secondary">Reset</a>
            @endif</div>

        </div>


            {{-- Type Filter --}}
            <select name="type" x-model="type" class="form-select me-2">
                <option value="">All Types</option>
                @foreach($types as $singleType)
                <option value="{{ $singleType }}">{{ $singleType }}</option>
                @endforeach
            </select>

            {{-- Order By Filter --}}
            <select name="order_by" x-model="orderBy" class="form-select me-2">
                <option value="latest">Order by Latest</option>
                <option value="oldest">Order by Oldest</option>
                <option value="title_asc">Title (A-Z)</option>
                <option value="title_desc">Title (Z-A)</option>
                <option value="type_asc">Type (A-Z)</option>
                <option value="type_desc">Type (Z-A)</option>
            </select>
        </form>
    </div>

    <!-- {{-- Tabs (now for visual display, filtering handled by form) --}}
    <ul class="nav nav-tabs mb-4 d-none d-md-flex">
        <li class="nav-item">
            <a class="nav-link {{ !request('type') ? 'active' : '' }}" href="{{ route('notifications.index', array_merge(request()->except('type'), ['type' => ''])) }}">
                All
            </a>
        </li>
        @foreach($types as $singleType)
        <li class="nav-item">
            <a class="nav-link {{ request('type') === $singleType ? 'active' : '' }}"
                href="{{ route('notifications.index', array_merge(request()->except('type'), ['type' => $singleType])) }}">
                {{ $singleType }}
            </a>
        </li>
        @endforeach
    </ul> -->


    @if($notifications->isEmpty())
    <div class="alert alert-info text-center">
        @if(request('type'))
        There aren't any notifications of type {{ request('type') }}
        @else
        Nuk ka njoftime
        @endif
    </div>
    @else
    <div class="card">
        <div class="card-header">
            @if(request('type'))
            {{ request('type') }} ({{ $notifications->total() }})
            @else
            All the notifications ({{ $notifications->total() }})
            @endif
        </div>

        <div class="card-body">
            {{-- Table View - Visible on XL screens and up (>= 1200px) --}}
            <div class="table-responsive d-none d-xl-block">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Image</th>
                            <th>
                                <a href="{{ route('notifications.index', array_merge(request()->query(), ['order_by' => (request('order_by') == 'datetime_asc' ? 'datetime_desc' : 'datetime_asc')])) }}" class="text-black text-decoration-none d-flex align-items-center justify-content-between">
                                    Date/Time
                                    @if (request('order_by') == 'datetime_asc')
                                    <i class="bi bi-arrow-up ms-1"></i>
                                    @elseif (request('order_by') == 'datetime_desc')
                                    <i class="bi bi-arrow-down ms-1"></i>
                                    @endif
                                </a>
                            </th>
                            <th>Description</th>
                            <th>
                                <a href="{{ route('notifications.index', array_merge(request()->query(), ['order_by' => (request('order_by') == 'title_asc' ? 'title_desc' : 'title_asc')])) }}" class="text-black text-decoration-none d-flex align-items-center justify-content-between">
                                    Title
                                    @if (request('order_by') == 'title_asc')
                                    <i class="bi bi-arrow-up ms-1"></i>
                                    @elseif (request('order_by') == 'title_desc')
                                    <i class="bi bi-arrow-down ms-1"></i>
                                    @endif
                                </a>
                            </th>
                            <th>
                                <a href="{{ route('notifications.index', array_merge(request()->query(), ['order_by' => (request('order_by') == 'type_asc' ? 'type_desc' : 'type_asc')])) }}" class="text-black text-decoration-none d-flex align-items-center justify-content-between">
                                    Type
                                    @if (request('order_by') == 'type_asc')
                                    <i class="bi bi-arrow-up ms-1"></i>
                                    @elseif (request('order_by') == 'type_desc')
                                    <i class="bi bi-arrow-down ms-1"></i>
                                    @endif
                                </a>
                            </th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($notifications as $notification)
                        <tr>
                            <td>{{ $notification->id }}</td>
                            <td>
                                @if($notification->imageUrl)
                                <img src="{{ route('notifications.image', $notification) }}" class="img-thumbnail"
                                    style="width: 80px; height: 80px; object-fit: cover;">
                                @else
                                <img src="https://via.placeholder.com/80?text=No+Image" alt="No Image" class="img-thumbnail"
                                    style="width: 80px; height: 80px; object-fit: cover;">
                                @endif
                            </td>
                            <td>{{ $notification->datetime->format('d/m/Y H:i') }}</td>
                            <td>{{ \Illuminate\Support\Str::limit($notification->description, 50) }}</td>
                            <td>{{ \Illuminate\Support\Str::limit($notification->title, 40) }}</td>
                            <td>
                                <span
                                    class="badge
                                    @if($notification->notificationType === 'Lajm') bg-primary
                                    @elseif($notification->notificationType === 'Konkurs') bg-success
                                    @else bg-info
                                    @endif">
                                    {{ $notification->notificationType }}
                                </span>
                            </td>
                            <td>
                                <div class="d-flex gap-2">
                                    <a href="{{ route('notifications.edit', $notification->id) }}"
                                        class="btn btn-primary btn-sm">
                                        <i class="bi bi-pencil-fill"></i> Edit
                                    </a>
                                    <form action="{{ route('notifications.destroy', $notification->id) }}" method="POST"
                                        class="d-inline" onsubmit="return confirm('Jeni i sigurt?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            <i class="bi bi-trash-fill"></i> Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- Card View - Visible on screens smaller than XL (< 1200px) --}}
            <div class="d-xl-none">
                @foreach($notifications as $notification)
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-3">
                            @if($notification->imageUrl)
                            <img src="{{ route('notifications.image', $notification) }}" class="img-thumbnail me-3"
                                style="width: 80px; height: 80px; object-fit: cover;">
                            @else
                            <img src="https://via.placeholder.com/80?text=No+Image" alt="No Image" class="img-thumbnail me-3"
                                style="width: 80px; height: 80px; object-fit: cover;">
                            @endif
                            <div>
                                <h5 class="card-title fw-bold mb-1">{{ \Illuminate\Support\Str::limit($notification->title, 40) }}</h5>
                                <p class="card-subtitle text-muted mb-0">ID: {{ $notification->id }}</p>
                            </div>
                        </div>

                        <p class="card-text d-flex justify-content-between mb-1">
                            <strong class="text-muted">Date/Time:</strong>
                            <span>{{ $notification->datetime->format('d/m/Y H:i') }}</span>
                        </p>
                        <p class="card-text d-flex justify-content-between mb-2">
                            <strong class="text-muted">Type:</strong>
                            <span>
                                <span
                                    class="badge
                                    @if($notification->notificationType === 'Lajm') bg-primary
                                    @elseif($notification->notificationType === 'Konkurs') bg-success
                                    @else bg-info
                                    @endif">
                                    {{ $notification->notificationType }}
                                </span>
                            </span>
                        </p>
                        <div class="d-flex flex-wrap gap-2">
                            <a href="{{ route('notifications.edit', $notification->id) }}"
                                class="btn btn-primary btn-sm">
                                <i class="bi bi-pencil-fill"></i> Edit
                            </a>
                            <form action="{{ route('notifications.destroy', $notification->id) }}" method="POST"
                                class="d-inline" onsubmit="return confirm('Jeni i sigurt?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">
                                    <i class="bi bi-trash-fill"></i> Delete
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    {{-- Laravel's pagination links --}}
    <div class="d-flex justify-content-center mt-4">
        {{ $notifications->appends(request()->query())->links() }}
    </div>
    @endif
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('formHandlers', () => ({
            search: '{{ request('search') }}',
            type: '{{ request('type') }}',
            orderBy: '{{ request('order_by') }}',
            init() {
                this.$watch('type', () => this.submitForm());
                this.$watch('orderBy', () => this.submitForm());
            },
            submitForm() {
                this.$el.closest('form').submit();
            }
        }));
    });
</script>
@endpush
