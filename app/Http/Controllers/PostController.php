<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller;
use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function __construct()
    {
        // Apply authentication middleware for methods that require authentication
        $this->middleware('auth')->except(['index', 'show']);
        $this->middleware('permission:create posts')->only(['create', 'store']);
        $this->middleware('permission:edit posts')->only(['edit', 'update']);
        $this->middleware('permission:delete posts')->only(['destroy']);
    }

    public function index()
    {
        // Get all posts
        $posts = Post::with('categories', 'tags')->paginate(10);
        return view('posts.index', compact('posts'));
    }

    public function create()
    {
        // Get categories and tags for the form
        $categories = Category::all();
        $tags = Tag::all();
        return view('posts.create', compact('categories', 'tags'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'has_affiliate_links' => 'nullable|boolean',
            'affiliate_disclaimer' => 'nullable|string',
            'affiliate_product_url' => 'nullable|url',
        ]);

        // Store the new post
        $post = Post::create($request->all());

        // Attach categories and tags
        $post->categories()->sync($request->category_ids);
        $post->tags()->sync($request->tag_ids);

        return redirect()->route('posts.index')->with('success', 'Post created successfully!');
    }

    public function edit(Post $post)
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('posts.edit', compact('post', 'categories', 'tags'));
    }

    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'has_affiliate_links' => 'nullable|boolean',
            'affiliate_disclaimer' => 'nullable|string',
            'affiliate_product_url' => 'nullable|url',
        ]);

        // Update the post
        $post->update($request->all());

        // Update categories and tags
        $post->categories()->sync($request->category_ids);
        $post->tags()->sync($request->tag_ids);

        return redirect()->route('posts.index')->with('success', 'Post updated successfully!');
    }

    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }
}
