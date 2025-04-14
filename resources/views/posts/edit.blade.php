@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold mb-6">Edit Post</h1>

    <form action="{{ route('posts.update', $post) }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')

        <div>
            <label for="title" class="block text-sm font-semibold">Title</label>
            <input type="text" name="title" id="title" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" value="{{ old('title', $post->title) }}" required>
        </div>

        <div>
            <label for="category_id" class="block text-sm font-semibold">Category</label>
            <select name="category_id" id="category_id" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ $post->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="tags" class="block text-sm font-semibold">Tags</label>
            <select name="tags[]" id="tags" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" multiple>
                @foreach($tags as $tag)
                    <option value="{{ $tag->id }}" {{ $post->tags->contains($tag->id) ? 'selected' : '' }}>{{ $tag->name }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="content" class="block text-sm font-semibold">Content</label>
            <textarea name="content" id="content" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" rows="5" required>{{ old('content', $post->content) }}</textarea>
        </div>

        <div class="flex items-center space-x-2">
            <label for="is_published" class="text-sm font-semibold">Published</label>
            <input type="checkbox" name="is_published" id="is_published" class="form-checkbox" value="1" {{ $post->is_published ? 'checked' : '' }}>
        </div>

        <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded-md mt-4 hover:bg-blue-600">Update</button>
    </form>
</div>
@endsection
