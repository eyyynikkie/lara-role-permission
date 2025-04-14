@extends('layouts.app')

@section('title', 'All Posts')

@section('header')
    All Blog Posts
@endsection

@section('content')
<div class="mb-4">
    <a href="{{ route('posts.create') }}" class="bg-purple-300 hover:bg-purple-400 text-white py-2 px-4 rounded shadow">Create Post</a>
</div>

@if(session('success'))
    <div class="bg-green-200 border border-green-300 text-green-800 px-4 py-3 rounded mb-4">
        {{ session('success') }}
    </div>
@endif

<table class="w-full bg-white border border-pink-200 rounded-lg shadow-sm">
    <thead class="bg-pink-100">
        <tr>
            <th class="text-left px-4 py-2">Title</th>
            <th class="text-left px-4 py-2">Category</th>
            <th class="text-left px-4 py-2">Tags</th>
            <th class="text-left px-4 py-2">Published</th>
            <th class="text-left px-4 py-2">Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($posts as $post)
        <tr class="border-t border-pink-100">
            <td class="px-4 py-2">{{ $post->title }}</td>
            <td class="px-4 py-2">{{ $post->category->name }}</td>
            <td class="px-4 py-2">
                @foreach($post->tags as $tag)
                    <span class="bg-purple-100 text-purple-700 px-2 py-1 rounded text-sm mr-1">{{ $tag->name }}</span>
                @endforeach
            </td>
            <td class="px-4 py-2">{{ $post->is_published ? 'Yes' : 'No' }}</td>
            <td class="px-4 py-2">
                <a href="{{ route('posts.edit', $post) }}" class="bg-yellow-300 text-white py-1 px-3 rounded text-sm">Edit</a>
                <form action="{{ route('posts.destroy', $post) }}" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-300 text-white py-1 px-3 rounded text-sm">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<div class="mt-4">
    {{ $posts->links('pagination::tailwind') }}
</div>
@endsection
