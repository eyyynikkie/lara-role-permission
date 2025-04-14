@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-3xl font-bold mb-4">{{ $post->title }}</h1>
    
    <p class="text-sm font-semibold mb-2"><strong>Category:</strong> {{ $post->category->name }}</p>

    <div class="mb-4">
        <strong>Tags:</strong>
        @foreach($post->tags as $tag)
            <span class="inline-block bg-gray-200 text-gray-800 text-xs font-semibold px-3 py-1 rounded-full mr-2">{{ $tag->name }}</span>
        @endforeach
    </div>

    <div class="mb-4">
        <strong>Published:</strong> {{ $post->is_published ? 'Yes' : 'No' }}
    </div>

    <div class="mb-4">
        <strong>Affiliate Product URL:</strong>
        @if($post->affiliate_product_url)
            <a href="{{ $post->affiliate_product_url }}" target="_blank" class="text-blue-500 hover:underline">View Product</a>
        @else
            <span class="text-gray-500">No affiliate links.</span>
        @endif
    </div>

    <div class="mb-4">
        <strong>Content:</strong>
        <p class="whitespace-pre-wrap">{{ $post->content }}</p>
    </div>

    <div class="mb-4">
        <strong>Created At:</strong> {{ $post->created_at->format('F j, Y') }}
    </div>

    <div class="flex space-x-4">
        <a href="{{ route('posts.index') }}" class="bg-gray-300 text-gray-800 px-4 py-2 rounded-md hover:bg-gray-400">Back to Posts</a>
        <a href="{{ route('posts.edit', $post) }}" class="bg-yellow-400 text-white px-4 py-2 rounded-md hover:bg-yellow-500">Edit</a>
    </div>
</div>
@endsection
