<x-layouts.app title="Trashed Posts">

    <x-post-header
        title="Trashed Posts"
        subtitle="Soft deleted posts"
    />

    @forelse($trashedPosts as $post)
        <x-post-card :post="$post" trashed />
    @empty
        <x-empty-state message="Trash is empty" />
    @endforelse

</x-layouts.app>
