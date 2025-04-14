@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold mb-4">All Posts</h1>
    <a href="{{ route('posts.create') }}" class="bg-blue-500 text-white py-2 px-4 rounded mb-3 inline-block">Create Post</a>

    @if(session('success'))
        <div class="bg-green-500 text-white p-4 rounded mb-4">{{ session('success') }}</div>
    @endif

    <table class="min-w-full table-auto border-collapse">
        <thead>
            <tr>
                <th class="px-4 py-2 border-b text-left">Title</th>
                <th class="px-4 py-2 border-b text-left">Category</th>
                <th class="px-4 py-2 border-b text-left">Tags</th>
                <th class="px-4 py-2 border-b text-left">Published</th>
                <th class="px-4 py-2 border-b text-left">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($posts as $post)
                <tr>
                    <td class="px-4 py-2 border-b">{{ $post->title }}</td>
                    <td class="px-4 py-2 border-b">{{ $post->category->name }}</td>
                    <td class="px-4 py-2 border-b">
                        @foreach($post->tags as $tag)
                            <span class="inline-block bg-gray-200 text-gray-700 text-sm px-2 py-1 rounded mr-2">{{ $tag->name }}</span>
                        @endforeach
                    </td>
                    <td class="px-4 py-2 border-b">{{ $post->is_published ? 'Yes' : 'No' }}</td>
                    <td class="px-4 py-2 border-b">
                        <a href="{{ route('posts.edit', $post) }}" class="bg-yellow-500 text-white py-1 px-3 rounded text-sm mr-2">Edit</a>
                        <form action="{{ route('posts.destroy', $post) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 text-white py-1 px-3 rounded text-sm">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="mt-6">
        {{ $posts->links('pagination::tailwind') }}
    </div>
</div>
@endsection
