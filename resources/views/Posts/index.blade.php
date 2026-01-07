@extends('layouts.app')

@section('content')
<div class="container">
    @if(session('status'))
        <div class="alert alert-success">{{ session('status') }}</div>
    @endif

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="h3 mb-0">Posts</h1>
        <a href="#" class="btn btn-primary">Create Post</a>
    </div>

    <div class="card">
        <div class="card-body p-0">
            <table class="table mb-0 table-hover">
                <thead>
                    <tr>
                        <th style="width: 60px;">#</th>
                        <th>Title</th>
                        <th>Author</th>
                        <th>Created</th>
                        <th>Status</th>
                        <th style="width: 290px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($posts as $post)
                        <tr class="{{ (method_exists($post, 'trashed') && $post->trashed()) ? 'table-secondary' : '' }}">
                            <td>{{ $post->id }}</td>
                            <td>
                                <a href="{{ route('posts.show', $post) }}">
                                    {{ \Illuminate\Support\Str::limit($post->title, 60) }}
                                </a>
                            </td>
                            <td>{{ $post->user->name ?? '-' }}</td>
                            <td>{{ $post->created_at->diffForHumans() }}</td>
                            <td>
                                @if(method_exists($post, 'trashed') && $post->trashed())
                                    <span class="badge bg-danger">Trashed</span>
                                @else
                                    <span class="badge bg-success">Active</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('posts.show', $post) }}" class="btn btn-sm btn-outline-primary">View</a>

                                @unless(method_exists($post, 'trashed') && $post->trashed())
                                    <a href="#" class="btn btn-sm btn-outline-secondary">Edit</a>

                                    <form action="#" method="POST" class="d-inline" onsubmit="return confirm('Move post to trash?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-outline-warning">Trash</button>
                                    </form>
                                @else
                                    <form action="{{ route('posts.restore', $post) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('PATCH')
                                        <button class="btn btn-sm btn-outline-success" onclick="return confirm('Restore this post?')">Restore</button>
                                    </form>

                                    <form action="{{ route('posts.forceDelete', $post) }}" method="POST" class="d-inline" onsubmit="return confirm('Permanently delete? This cannot be undone.')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-outline-danger">Delete Permanently</button>
                                    </form>
                                @endunless
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-4">No posts found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-3">
        {{ $posts->withQueryString()->links() }}
    </div>
</div>
@endsection
