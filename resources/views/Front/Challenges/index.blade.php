@extends('front.layout')
<title>EcoImpact - Challenges</title>


@section('content')
    <div class="container">
        <h1 class="h4">Available Challenges</h1>
        <div class="input-group input-group-merge search-bar">
            <span class="input-group-text" id="topbar-addon"><svg class="icon icon-xs"
                x-description="Heroicon name: solid/search" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                fill="currentColor" aria-hidden="true">
                <path fill-rule="evenodd"
                  d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                  clip-rule="evenodd"></path>
              </svg></span></span>
              <input type="text" id="search" class="form-control" placeholder="Search challenges..." value="{{ $search }}">

          </div>


      
<br>
        <div class="row">
        <div class="row" id="challengesTableBody">
        @include('Front.Challenges.challenges_list', ['challenges' => $challenges])
    </div>
    </div>
    <link rel="stylesheet" href="{{ asset('css/challenge.css') }}">

    <script>
 

    // Live search function
    document.getElementById('search').addEventListener('input', function () {
    const searchTerm = this.value;

    // Make an AJAX request to the server to fetch search results
    fetch(`{{ route('challenges.indexfront') }}?search=${searchTerm}`, {
        headers: {
            'X-Requested-With': 'XMLHttpRequest' // Ensure it is recognized as an AJAX request
        }
    })
    .then(response => {
        if (response.ok) {
            return response.text();
        }
        throw new Error('Network response was not ok.');
    })
    .then(html => {
        // Update the table body with the new HTML
        document.getElementById('challengesTableBody').innerHTML = html;
    })
    .catch(error => {
        console.error('There was a problem with the fetch operation:', error);
    });
});

</script>

@endsection
