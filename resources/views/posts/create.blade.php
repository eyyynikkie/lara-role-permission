@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold mb-6">Create Post</h1>

    <form action="{{ route('posts.store') }}" method="POST" class="space-y-6">
        @csrf

        <div>
            <label for="title" class="block text-sm font-semibold">Title</label>
            <input type="text" name="title" id="title" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" value="{{ old('title') }}" required>
        </div>

        <div>
            <label for="category_id" class="block text-sm font-semibold">Category</label>
            <select name="category_id" id="category_id" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                <option value="">Select Category</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="tags" class="block text-sm font-semibold">Tags</label>
            <select name="tags[]" id="tags" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" multiple>
                @foreach($tags as $tag)
                    <option value="{{ $tag->id }}" {{ in_array($tag->id, old('tags', [])) ? 'selected' : '' }}>{{ $tag->name }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="content" class="block text-sm font-semibold">Content</label>
            <textarea name="content" id="content" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" rows="5" required>{{ old('content') }}</textarea>
        </div>

        <div class="flex items-center space-x-2">
            <label for="is_published" class="text-sm font-semibold">Published</label>
            <input type="checkbox" name="is_published" id="is_published" class="form-checkbox" value="1" {{ old('is_published') ? 'checked' : '' }}>
        </div>

        <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded-md mt-4 hover:bg-blue-600">Create</button>
    </form>
</div>
@endsection
