@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Manage Comments</h1>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Post</th>
                <th>Content</th>
                <th>Visible</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($comments as $comment)
                <tr>
                    <td>{{ $comment->id }}</td>
                    <td>{{ $comment->post->title }}</td>
                    <td>{{ $comment->content }}</td>
                    <td>
                        <form action="{{ route('comments.toggleVisibility', $comment->id) }}" method="POST" style="display:inline;">
                            @csrf
                            <button type="submit" class="btn btn-sm {{ $comment->is_visible ? 'btn-success' : 'btn-secondary' }}">
                                {{ $comment->is_visible ? 'Hide' : 'Show' }}
                            </button>
                        </form>
                    </td>
                    <td>
                        <form action="{{ route('comments.destroy', $comment->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
