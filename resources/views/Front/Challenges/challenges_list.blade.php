@foreach ($challenges as $challenge)
    <div class="col-lg-4 mb-4">
        <div class="card shadow">
            <div class="image-framecard">
                <img src="{{ asset('storage/' . $challenge->image) }}" alt="Challenge Image" class="img-fluid challenge-image" />
            </div>
            <div class="card-body">
                <h5 class="card-title">{{ $challenge->title }}</h5>
                <p class="card-text">{{ Str::limit($challenge->description, 20) }}</p>

                <!-- Status Indicator -->
                <div class="mb-2">
                    @if ($challenge->isClosed())
                        <span class="badge bg-danger">Closed</span> 
                    @else
                        <span class="badge bg-success">Open</span> 
                    @endif
                </div>

                <a href="{{ route('challenges.showfront', $challenge->id) }}" class="btn btn-primary">View Challenge</a>
            </div>
        </div>
    </div>
@endforeach

<!-- Pagination Links -->
<div class="mt-3">
    {{ $challenges->links() }} <!-- Pagination links -->
</div>
<link rel="stylesheet" href="{{ asset('css/challenge.css') }}">
