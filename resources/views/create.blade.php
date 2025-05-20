@extends('layout')

@section('content')
    <h1>Create a New Post</h1>
    <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="title">Title:</label>
            <input type="text" name="title" id="title" class="form-control">
        </div>
        <div class="form-group">
            <label for="description">Description:</label>
            <textarea name="description" id="description" class="form-control"></textarea>
        </div>

        <div>
            <label for="image">Upload image</label>
            <input type="file" name="image" id="image" accept="image/*">
        </div>

        <button type="submit" class="btn btn-success">Publish</button>
    </form>
@endsection
