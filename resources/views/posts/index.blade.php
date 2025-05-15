@extends('layouts.app')

@section('content')
<div class="container">
    <div class="titlebar">
        <a class="btn btn-primary float-end mt-3" href="{{ route('posts.create') }}" role="button">Add Post</a>
<h1>The Everyday Edits</h1>
    </div>

    <hr>

    <!-- Success message if a post is created successfully -->
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <!-- Display posts if they exist -->
    @if (count($posts) > 0)
        <div class="row row-cols-1 row-cols-md-3 g-4">
            @foreach ($posts as $post)
<div class="col">
    <div class="card h-100" style="width: 18rem;">
        <img src="{{ asset('images/'.$post->image) }}" class="card-img-top" alt="{{ $post->title }}" style="height: 150px; object-fit: cover;">
        <div class="card-body">
            <h5 class="card-title">{{ $post->title }}</h5>
            <p class="card-text">{{ $post->description }}</p>
        </div>
        <div class="card-footer text-end">
            <a class="btn btn-info btn-sm" href="{{ route('posts.show', $post->id) }}">Show</a>
            <a class="btn btn-primary btn-sm" href="{{ route('posts.edit', $post->id) }}">Edit</a>
            <form action="{{ route('posts.destroy', $post->id) }}" method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure to delete this post?')">Delete</button>
            </form>
        </div>
    </div>
</div>
            @endforeach
        </div>
    @else
        <p>No Posts found</p>
    @endif
</div>
@endsection
