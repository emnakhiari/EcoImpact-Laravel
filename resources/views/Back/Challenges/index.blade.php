@extends('back.layout')

@section('content')

<h1>Challenges</h1>
<a href="{{ route('challenges.create') }}" class="btn btn-primary">Create New Challenge</a>
<div class="mb-3">
    <input type="text" id="search" class="form-control" placeholder="Search challenges..." value="{{ $search }}">
</div>
<div class="card border-0 shadow mb-4">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-centered table-nowrap mb-0 rounded">
                <thead class="thead-light">
                    <tr>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Reward Points</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="challengesTableBody"> <!-- Set an ID for the table body -->
                    @include('Back.Challenges.table_rows', ['challenges' => $challenges]) <!-- Include a separate view for table rows -->
                </tbody>
            </table>
            <div class="mt-3">
                {{ $challenges->appends(request()->query())->links() }} <!-- Pagination links -->
            </div>
        </div>
    </div>
</div>

<!-- JavaScript to Populate the View Modal -->
<script>
    function populateViewModal(challengeId, title, description, startDate, endDate, rewardPoints) {
        document.getElementById('viewTitle' + challengeId).textContent = title;
        document.getElementById('viewDescription' + challengeId).textContent = description;
        document.getElementById('viewStartDate' + challengeId).textContent = startDate;
        document.getElementById('viewEndDate' + challengeId).textContent = endDate;
        document.getElementById('viewRewardPoints' + challengeId).textContent = rewardPoints;
    }

    // Live search function
    document.getElementById('search').addEventListener('input', function () {
    const searchTerm = this.value;

    // Make an AJAX request to the server to fetch search results
    fetch(`{{ route('challenges.index') }}?search=${searchTerm}`, {
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
