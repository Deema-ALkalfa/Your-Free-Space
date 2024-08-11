@extends('layouts.app')

@section('content')
<div class="row mb-4">
    @auth
        <!-- Add a "Create Post" button -->
        <div class="col-md-12 text-end">
            <a href="{{ route('posts.create') }}" class="btn btn-primary">Create Post</a>
        </div>
    @endauth
    @guest
        <!-- The Login and Register buttons here have been removed -->
    @endguest
</div>

<div class="row">
    @foreach($posts as $post)
        <div class="col-md-4 mb-3">
            <div class="card">
                @if($post->image)
                    <div class="card-img-container">
                        <img src="{{ asset('storage/' . $post->image) }}" class="card-img-top" alt="Post Image">
                    </div>
                @endif
                <div class="card-body">
                    <h5 class="card-title">{{ $post->title }}</h5>
                    <p class="card-text text-muted">by <strong>{{ $post->user ? $post->user->name : 'Unknown' }}</strong></p>
                    <p class="card-text">{{ Str::limit($post->content, 100) }}</p>
                    <a href="{{ route('posts.show', $post->id) }}" class="btn btn-info btn-sm">View</a>
                    @auth
                        <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('posts.destroy', $post->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    @endauth
                </div>
            </div>
        </div>
    @endforeach
</div>

<!-- Pagination Links -->
{{ $posts->links() }}
@endsection

<style>
    .card-img-container {
        height: 200px; /* Adjust this height as needed */
        overflow: hidden;
    }
    .card-img-top {
        width: 100%;
        height: 100%;
        object-fit: cover; /* Maintain aspect ratio while covering the container */
    }
</style>
