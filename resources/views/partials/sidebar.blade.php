<!-- resources/views/partials/sidebar.blade.php -->
<div class="sidebar bg-light border rounded p-3">
    <h4 class="fw-bold mb-3" style="color: #4b2e83;">Recent Posts</h4>
    <ul class="list-unstyled">
        @foreach($recentPosts as $post)
            <li class="mb-2">
                <a href="{{ route('posts.show', $post->id) }}" class="text-decoration-none text-dark">
                    {{ $post->title }}
                </a>
            </li>
        @endforeach
    </ul>
</div>
