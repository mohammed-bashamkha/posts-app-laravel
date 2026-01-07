<x-layouts.app title="View Post">

    <x-post-header
        title="Post Details"
        subtitle="Single post view"
    />

    <div class="card card-post p-4">
        <div class="d-flex gap-3 mb-3">
            <div class="avatar">
                {{ strtoupper(substr($post->title,0,1)) }}
            </div>
            <div>
                <h4 class="mb-1">{{ $post->title }}</h4>
                <small class="text-muted">
                    {{ $post->created_at->diffForHumans() }}
                </small>
            </div>
        </div>

        <hr>

        <div>
            {!! nl2br(e($post->content)) !!}
        </div>
    </div>

</x-layouts.app>
