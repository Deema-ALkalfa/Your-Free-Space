@extends('layouts.app')

@section('content')
    <div class="card mb-4">
        @if($post->image)
            <div class="card-img-container">
                <img src="{{ asset('storage/' . $post->image) }}" class="card-img" alt="Post Image">
            </div>
        @endif
        <div class="card-body">
            <h5 class="card-title">{{ $post->title }}</h5>
            <p class="card-text text-muted">by <strong>{{ $post->user ? $post->user->name : 'Unknown' }}</strong></p>
            <p class="card-text">{{ $post->content }}</p>
        </div>
    </div>

    <!-- Comments Section -->
    <div class="card mt-4">
        <div class="card-header">
            Comments
        </div>
        <div class="card-body">
            @if($comments->count() > 0)
                @foreach($comments as $comment)
                    <div class="mb-3">
                        <strong>{{ $comment->created_at->format('M d, Y') }}</strong>
                        <p>{{ $comment->body }}</p>
                        @if($isOwner)
                            <form action="{{ route('comments.updateStatus', $comment->id) }}" method="POST" class="d-inline">
                                @csrf
                                <select name="status" onchange="this.form.submit()">
                                    <option value="visible" {{ $comment->status === 'visible' ? 'selected' : '' }}>Visible</option>
                                    <option value="hidden" {{ $comment->status === 'hidden' ? 'selected' : '' }}>Hidden</option>
                                </select>
                            </form>
                            <form action="{{ route('comments.destroy', $comment->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        @endif
                    </div>
                    <hr>
                @endforeach
            @else
                <p>No comments yet.</p>
            @endif
        </div>
    </div>

    <!-- Add Comment Section -->
    <div class="card mt-4">
        <div class="card-header">
            Add a Comment
        </div>
        <div class="card-body">
            <form action="{{ route('comments.store') }}" method="POST">
                @csrf
                <input type="hidden" name="post_id" value="{{ $post->id }}">
                <div class="mb-3">
                    <label for="body" class="form-label">Comment</label>
                    <textarea class="form-control" id="body" name="body" rows="5" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Submit Comment</button>
            </form>
        </div>
    </div>
@endsection

<style>
    .card-img-container {
        height: 500px; /* Adjust this height as needed */
        overflow: hidden;
    }
    .card-img {
        width: 100%;
        height: auto;
        object-fit: cover; /* Maintain aspect ratio while covering the container */
    }
    .card-body {
        padding: 2rem; /* Adjust padding to increase the content space */
    }
    .card {
        margin-bottom: 2rem; /* Adjust margin to increase spacing between cards */
    }
</style>
