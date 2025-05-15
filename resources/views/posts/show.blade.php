@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $post->title }}</h1>
    <img src="{{ asset('images/' . $post->image) }}" alt="Post Image" style="max-width: 400px; margin-bottom: 20px;">
    <p>{{ $post->description }}</p>
    <a href="{{ route('posts.index') }}" class="btn btn-primary">Back to Posts</a>
    <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-secondary">Edit Post</a>
</div>
@endsection
