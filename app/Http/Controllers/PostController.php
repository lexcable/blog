<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function index()
{
    $posts = Post::all();
    return view('index', compact('posts'));
}
public function create()
{
    return view('create');
}

public function store(Request $request)
{
    // Validate the incoming request data
    $data = $request->validate([
        'title'   => 'required|string|max:255',
        'content' => 'required|string',
        'image'   => 'nullable|image|max:2048',
    ]);

    // Temporary: dump what came through
    \Log::info('POST DATA', $data);

    // Create a new post instance
    $post = new Post();
    $post->title = $data['title'];
    $post->content = $data['content'];

    // Handle image upload if present
    if ($request->hasFile('image')) {
        $post->image = $request->file('image')->store('posts', 'public');
    }

    // Save the post
    $post->save();

    return redirect()->route('posts.index');
}

public function edit($id)
{
    $post = Post::findOrFail($id);
    return view('edit', compact('post'));
}

public function update(Request $request, $id)
{
    $post = Post::findOrFail($id);

    $data = $request->validate([
        'title'   => 'required|string|max:255',
        'content' => 'required|string',
        'image'   => 'nullable|image|max:2048',
    ]);

    if ($request->hasFile('image')) {
        if ($post->image) {
            Storage::disk('public')->delete($post->image);
        }
        $data['image'] = $request->file('image')->store('posts', 'public');
    }

    $post->update($data);

    return redirect()->route('posts.index');
}

public function destroy($id)
{
    $post = Post::findOrFail($id);
    $post->delete();

    return redirect()->route('posts.index');
}

}
