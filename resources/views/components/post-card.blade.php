<div class="col">
    <div class="card shadow-sm h-100">
        <div class="card-body d-flex align-items-center">
            @if($post->image)
                <div class="me-3">
                    <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}" class="img-fluid rounded" style="max-width: 100px; max-height: 100px;">
                </div>
            @endif
            <div>
                <h5 class="card-title fw-bold">{{ $post->title }}</h5>
                <p class="card-text">{{ \Illuminate\Support\Str::limit($post->content, 150) }}</p>
            </div>
        </div>
        <div class="card-footer bg-transparent border-0 d-flex justify-content-between">
            <a href="{{ route('posts.show', ['post' => $post->id]) }}" class="btn btn-info btn-sm">View</a>
            <a href="{{ route('posts.edit', ['post' => $post->id]) }}" class="btn btn-warning btn-sm">Edit</a>
            <form action="{{ route('posts.destroy', ['post' => $post->id]) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
            </form>
        </div>
    </div>
</div>
