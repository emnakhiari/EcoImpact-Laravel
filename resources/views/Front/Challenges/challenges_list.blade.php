@foreach ($challenges as $challenge)
    <div class="col-lg-4 mb-4">
        <div class="card shadow">
            <div class="image-framecard">
                <img src="{{ asset('storage/' . $challenge->image) }}" alt="Challenge Image" class="img-fluid challenge-image" />
            </div>
            <div class="card-body">
                <h5 class="card-title">{{ $challenge->title }}</h5>
                <p class="card-text">{{ Str::limit($challenge->description, 100) }}</p>
                <a href="{{ route('challenges.showfront', $challenge->id) }}" class="btn btn-primary">View Challenge</a>
            </div>
        </div>
    </div>
@endforeach

<!-- Pagination Links -->
<div class="mt-3">
    {{ $challenges->links() }} <!-- Pagination links -->
</div>
