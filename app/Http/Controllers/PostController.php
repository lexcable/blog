<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
// Show all posts
public function index() {
    $posts = Post::orderBy('created_at', 'desc')->get();
    return view('posts.index', ['posts' => $posts]);
}

// Show form to create a post
public function create() {
    return view('posts.create');
}

// Store a new post
public function store(Request $request) {
    // Validate the input
    $request->validate([
        'title' => 'required',
        'description' => 'required',
        'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);

    // Handle image upload
    $file_name = time() . '.' . request()->image->getClientOriginalExtension();
    request()->image->move(public_path('images'), $file_name);

    // Create and save the new post
    $post = new Post;
    $post->title = $request->title;
    $post->description = $request->description;
    $post->image = $file_name;
    $post->save();

    // Redirect to the posts index page with a success message
    return redirect()->route('posts.index')->with('success', 'Post created successfully.');
}

// Show a single post
public function show($id) {
    $post = Post::findOrFail($id);
    return view('posts.show', ['post' => $post]);
}

// Show form to edit a post
public function edit($id) {
    $post = Post::findOrFail($id);
    return view('posts.edit', ['post' => $post]);
}

// Update a post
public function update(Request $request, $id) {
    $request->validate([
        'title' => 'required',
        'description' => 'required',
        'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);

    $post = Post::findOrFail($id);
    $post->title = $request->title;
    $post->description = $request->description;

    if ($request->hasFile('image')) {
        $file_name = time() . '.' . $request->image->getClientOriginalExtension();
        $request->image->move(public_path('images'), $file_name);
        $post->image = $file_name;
    }

    $post->save();

    return redirect()->route('posts.index')->with('success', 'Post updated successfully.');
}

// Delete a post
public function destroy($id) {
    $post = Post::findOrFail($id);
    $post->delete();

    return redirect()->route('posts.index')->with('success', 'Post deleted successfully.');
}
}
