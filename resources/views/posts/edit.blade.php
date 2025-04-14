@extends('layouts.app')

@section('title', isset($post) ? 'Edit Post' : 'Create Post')

@section('header')
    {{ isset($post) ? 'Edit Post' : 'Create a New Post' }}
@endsection

@section('content')
    <div class="bg-white p-6 rounded shadow border border-purple-100">
        <form action="{{ isset($post) ? route('posts.update', $post) : route('posts.store') }}" method="POST">
            @csrf
            @if(isset($post))
                @method('PUT')
            @endif

            <!-- Title -->
            <div class="mb-4">
                <label for="title" class="block text-purple-700 font-medium">Title</label>
                <input type="text" id="title" name="title" value="{{ old('title', $post->title ?? '') }}" class="mt-1 block w-full p-2 border border-purple-300 rounded focus:outline-none focus:ring-2 focus:ring-purple-500" required>
                @error('title') <div class="text-red-500 text-sm mt-1">{{ $message }}</div> @enderror
            </div>

            <!-- Category -->
            <div class="mb-4">
                <label for="category" class="block text-purple-700 font-medium">Category</label>
                <select id="category" name="category_id" class="mt-1 block w-full p-2 border border-purple-300 rounded focus:outline-none focus:ring-2 focus:ring-purple-500">
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ (old('category_id', $post->category_id ?? '') == $category->id) ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                @error('category_id') <div class="text-red-500 text-sm mt-1">{{ $message }}</div> @enderror
            </div>

            <!-- Content -->
            <div class="mb-4">
                <label for="content" class="block text-purple-700 font-medium">Content</label>
                <textarea id="content" name="content" class="mt-1 block w-full p-2 border border-purple-300 rounded focus:outline-none focus:ring-2 focus:ring-purple-500" rows="6" required>{{ old('content', $post->content ?? '') }}</textarea>
                @error('content') <div class="text-red-500 text-sm mt-1">{{ $message }}</div> @enderror
            </div>

            <!-- Tags -->
            <div class="mb-4">
                <label for="tags" class="block text-purple-700 font-medium">Tags</label>
                <input type="text" id="tags" name="tags" value="{{ old('tags', implode(',', $post->tags->pluck('name')->toArray() ?? [])) }}" class="mt-1 block w-full p-2 border border-purple-300 rounded focus:outline-none focus:ring-2 focus:ring-purple-500">
                @error('tags') <div class="text-red-500 text-sm mt-1">{{ $message }}</div> @enderror
            </div>

            <!-- Published -->
            <div class="mb-4">
                <label for="is_published" class="inline-flex items-center text-purple-700 font-medium">
                    <input type="checkbox" id="is_published" name="is_published" {{ old('is_published', $post->is_published ?? false) ? 'checked' : '' }} class="text-purple-600 rounded focus:outline-none focus:ring-2 focus:ring-purple-500">
                    <span class="ml-2">Publish this post?</span>
                </label>
            </div>

            <!-- Submit Button -->
            <div class="mt-4">
                <button type="submit" class="bg-purple-300 hover:bg-purple-400 text-white py-2 px-4 rounded shadow">
                    {{ isset($post) ? 'Update Post' : 'Create Post' }}
                </button>
            </div>
        </form>
    </div>
@endsection
