@extends('layouts.app')

@section('content')
    <div class="card mb-4">
        <div class="card-header">
            {{ $post->title }}
        </div>
        <div class="card-body">
            <p>{{ $post->content }}</p>
            @if($post->image)
                <img src="{{ asset('storage/' . $post->image) }}" class="img-fluid" alt="Post Image">
            @endif
        </div>
    </div>

    <!-- Comments Section -->
    <div class="card mb-4">
        <div class="card-header">
            Comments
        </div>
        <div class="card-body">
            @forelse($post->comments as $comment)
                <div class="mb-3">
                    <p>{{ $comment->body }}</p>
                    <small>Commented on: {{ $comment->created_at->format('d M Y, H:i') }}</small>
                </div>
                <hr>
            @empty
                <p>No comments yet. Be the first to comment!</p>
            @endforelse
        </div>
    </div>

    <!-- Add Comment Form -->
    <div class="card">
        <div class="card-header">
            Add Comment
        </div>
        <div class="card-body">
            <form action="{{ route('comments.store') }}" method="POST">
                @csrf
                <input type="hidden" name="post_id" value="{{ $post->id }}">
                <div class="mb-3">
                    <label for="body" class="form-label">Comment</label>
                    <textarea class="form-control" id="body" name="body" rows="3" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Submit Comment</button>
            </form>
        </div>
    </div>
@endsection
