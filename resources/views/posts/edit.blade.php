@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Post</h1>
    <section class="mt-3">
        <form method="POST" action="{{ route('posts.update', $post->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Error messages when data is invalid -->
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="card p-3">
                <label for="title">Title</label>
                <input class="form-control" type="text" name="title" value="{{ $post->title }}">

                <label for="description">Description</label>
                <textarea class="form-control" name="description" id="description" cols="30" rows="10">{{ $post->description }}</textarea>

                <label for="formFile" class="form-label">Change Image</label>
                <input class="form-control" type="file" name="image">

                @if($post->image)
                    <img src="{{ asset('images/' . $post->image) }}" alt="Post Image" style="max-width: 200px; margin-top: 10px;">
                @endif
            </div>

            <button class="btn btn-secondary m-3">Update</button>
        </form>
    </section>
</div>
@endsection
