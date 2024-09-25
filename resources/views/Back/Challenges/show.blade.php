@extends('back.layout')
<title>EcoImpact - Challenges</title>
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

@section('content')
<div id="alert-container" class="mt-3"></div>
<div class="challenge-container">
    <div class="challenge-header">
        <h1>{{ $challenge->title }}</h1>
        <div class="button-group">
            <a href="{{ route('challenges.index') }}" class="btn btn-secondary back-btn">Back to Challenges</a>
        </div>
    </div>

    <div class="challenge-content">
        <div class="image-frame">
            <img src="{{ asset('storage/' . $challenge->image) }}" alt="Challenge Image" class="img-fluid challenge-image" />
        </div>
        <div class="challenge-details">
            <p><strong>Description:</strong> {{ $challenge->description }}</p>
            <p><strong>Start Date:</strong> {{ $challenge->start_date }}</p>
            <p><strong>End Date:</strong> {{ $challenge->end_date }}</p>
            <p><strong>Time Left:</strong> {{ $timeLeft }}</p>
            <p><strong>Reward Points:</strong> {{ $challenge->reward_points }}</p>
        </div>
    </div>

    <div class="solution-list">
        <h3>Solutions</h3>
        @foreach($solutions as $solution)
        <div class="solution-item">
    <div class="solution-header">
        <div class="user-info">
            <img src="/assets/img/team/profile-picture-5.jpg" alt="User Image" class="user-image">

            <strong>{{ $solution->user->name }}</strong>
            
        </div>
        <span class="solution-date">{{ $solution->created_at->format('Y-m-d') }}</span>
        @if(auth()->id() === $solution->user_id || auth()->user()->role === 'admin')
                    <div class="dropdown">
                <button class="btn btn-link dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                    &#x2026;
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <li><a class="dropdown-item edit-solution" data-solution-id="{{ $solution->id }}" data-bs-toggle="modal" data-bs-target="#editSolutionModal">Edit</a></li>
                    <li><a class="dropdown-item" href="{{ route('solutions.destroy', $solution->id) }}" onclick="event.preventDefault(); document.getElementById('delete-solution-{{ $solution->id }}').submit();">Delete</a></li>
                </ul>
            </div>

            <form id="delete-solution-{{ $solution->id }}" action="{{ route('solutions.destroy', $solution->id) }}" method="POST" style="display: none;">
                @csrf
                @method('DELETE')
            </form>
        @endif
     
    </div>
    <div class="vote-section">
    <button class="vote-btn" onclick="voteSolution({{ $solution->id }})">
        <i class="fa fa-star"></i> Vote
    </button>
</div>
    <div class="solution-content">
        <h5 id="solution-title-{{ $solution->id }}">{{ $solution->title }}</h5>
        <p id="solution-description-{{ $solution->id }}">{{ $solution->description }}</p>
    </div>
</div>

        @endforeach

        @if($solutions->isEmpty())
            <p>No solutions have been submitted yet.</p>
        @endif
    </div>

    <!-- Add Solution Modal -->
    <div class="modal fade" id="addSolutionModal" tabindex="-1" aria-labelledby="addSolutionModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addSolutionModalLabel">Add Solution</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="solutionForm" method="POST" action="{{ route('solutions.store') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="solutionTitle" class="form-label">Solution Title</label>
                            <input type="text" class="form-control" id="solutionTitle" name="title" required>
                        </div>
                        <div class="mb-3">
                            <label for="solutionDescription" class="form-label">Description</label>
                            <textarea class="form-control" id="solutionDescription" name="description" rows="3" required></textarea>
                        </div>
                        <input type="hidden" name="challenge_id" value="{{ $challenge->id }}">
                        <button type="submit" class="btn btn-primary">Submit Solution</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Solution Modal -->
    <div class="modal fade" id="editSolutionModal" tabindex="-1" aria-labelledby="editSolutionModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editSolutionModalLabel">Edit Solution</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editSolutionForm" method="POST" action="">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="editSolutionTitle" class="form-label">Solution Title</label>
                            <input type="text" class="form-control" id="editSolutionTitle" name="title" required>
                        </div>
                        <div class="mb-3">
                            <label for="editSolutionDescription" class="form-label">Description</label>
                            <textarea class="form-control" id="editSolutionDescription" name="description" rows="3" required></textarea>
                        </div>
                        <input type="hidden" id="editSolutionId" name="solution_id">
                        <button type="submit" class="btn btn-primary">Update Solution</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <link rel="stylesheet" href="{{ asset('css/challenge.css') }}">
    <link rel="stylesheet" href="{{ asset('css/solution.css') }}">
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    // Attach click event listeners to the edit buttons
    document.querySelectorAll('.edit-solution').forEach(button => {
        button.addEventListener('click', function () {
            const solutionId = this.getAttribute('data-solution-id');
            
            // Fetch the solution data for the clicked edit button
            fetch(`/solutions/${solutionId}/edit`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('editSolutionTitle').value = data.title;
                    document.getElementById('editSolutionDescription').value = data.description;
                    document.getElementById('editSolutionId').value = solutionId;

                    // Update form action for submission
                    const form = document.getElementById('editSolutionForm');
                    form.setAttribute('action', `/solutions/${solutionId}`);
                });
        });
    });

    // Handle form submission via AJAX
    const editSolutionForm = document.getElementById('editSolutionForm');
    editSolutionForm.addEventListener('submit', function (e) {
        e.preventDefault(); // Prevent default form submission

        const solutionId = document.getElementById('editSolutionId').value;
        const formData = new FormData(editSolutionForm);

        fetch(`/solutions/${solutionId}`, {
            method: 'POST',
            body: formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                const modal = bootstrap.Modal.getInstance(document.getElementById('editSolutionModal'));
                modal.hide();

                document.querySelector(`#solution-title-${solutionId}`).textContent = document.getElementById('editSolutionTitle').value;
                document.querySelector(`#solution-description-${solutionId}`).textContent = document.getElementById('editSolutionDescription').value;

                showAlert('Solution updated successfully!', 'success');
            }
        })
        .catch(error => {
            console.error('Error updating the solution:', error);
        });
    });
});

function showAlert(message, type) {
    const alertContainer = document.getElementById('alert-container');
    const alertHTML = `
        <div class="alert alert-${type} alert-dismissible fade show small-alert" role="alert">
            ${message}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    `;
    alertContainer.innerHTML = alertHTML;

    setTimeout(() => {
        const alertNode = document.querySelector('.alert');
        if (alertNode) {
            alertNode.classList.remove('show');
            alertNode.addEventListener('transitionend', () => alertNode.remove());
        }
    }, 3000); // Automatically close after 3 seconds
}
</script>
@endsection
