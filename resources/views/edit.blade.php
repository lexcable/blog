@extends('layout')

@section('content')
    <h1>Edit Post</h1>
    <form action="{{ route('posts.update', $post->id) }}" method="POST"  enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="title">Title:</label>
            <input type="text" name="title" id="title" class="form-control" value="{{ $post->title }}">
        </div>
        <div class="form-group">
            <label for="description">Content:</label>
            <textarea name="description" id="description" class="form-control">{{ $post->content }}</textarea>
        </div>

        <div>
            <label for="image">Upload an image</label>
            <input type="file" name="image" id="image" accept="image/*">
        </div>
        <button type="submit" class="btn btn-success">Publish</button>
    </form>
@endsection
