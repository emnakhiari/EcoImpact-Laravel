@extends('front.layout')


@section('content')
    <div class="container">
        <h1 class="h4">Available Challenges</h1>
        <form method="GET" action="{{ route('challenges.indexfront') }}">
        <div class="input-group input-group-merge search-bar">
            <span class="input-group-text" id="topbar-addon"><svg class="icon icon-xs"
                x-description="Heroicon name: solid/search" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                fill="currentColor" aria-hidden="true">
                <path fill-rule="evenodd"
                  d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                  clip-rule="evenodd"></path>
              </svg></span>
              <input type="text" name="search" id="search" class="form-control" placeholder="Search challenges..." value="{{ $search }}">
        </div>
    </form>


      
<br>
        <div class="row">
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
        </div>
    </div>
    <link rel="stylesheet" href="{{ asset('css/challenge.css') }}">

@endsection
