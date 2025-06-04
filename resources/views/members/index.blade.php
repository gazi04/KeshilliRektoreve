@extends('members.layout')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>Menaxho Anëtarët</h1>
            <a href="{{ route('members.create') }}" class="btn btn-primary">Shto Anëtar të Ri</a>
        </div>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>Foto</th>
                                <th>Titulli</th>
                                <th>Emri i Plotë</th>
                                <th>Pozita</th>
                                <th>Renditja</th>
                                <th>Veprimet</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($members as $member)
                                <tr>
                                    <td>{{ ($members->currentPage() - 1) * $members->perPage() + $loop->iteration }}</td>
                                    <td>
                                        @if($member->imageUrl)
                                            <img src="{{ asset('storage/' . $member->imageUrl) }}" alt="{{ $member->name }}"
                                                class="rounded" style="width: 60px; height: 60px; object-fit: cover;">
                                        @else
                                            <div class="bg-secondary rounded d-flex align-items-center justify-content-center"
                                                style="width: 60px; height: 60px;">
                                                <span class="text-white">Nuk ka foto</span>
                                            </div>
                                        @endif
                                    </td>
                                    <td>
                                        @if($member->title)
                                            <strong>{{ $member->title }}</strong>
                                        @endif
                                        {{ $member->name }}
                                    </td>
                                    <td>{{ $member->position }}</td>
                                    <td>{{ $member->orderNr }}</td>
                                    <td>
                                        <div class="d-flex gap-2">
                                            <a href="{{ route('members.show', $member) }}" class="btn btn-sm btn-info">Shiko</a>
                                            <a href="{{ route('members.edit', $member) }}"
                                                class="btn btn-sm btn-warning">Edito</a>
                                            <form action="{{ route('members.destroy', $member) }}" method="POST"
                                                class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger"
                                                    onclick="return confirm('A jeni i sigurt që dëshironi të fshini këtë anëtar?')">
                                                    Fshij
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="d-flex justify-content-center mt-4">
                    {{ $members->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection