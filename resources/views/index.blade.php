@extends('layout')

@section('content')
    <h1>The EndLess Edits.</h1>
    <a href="{{ route('posts.create') }}">
        <button type="button" style="padding: 8px 15px; border: none; background-color: #28a745; color: white; border-radius: 5px; cursor: pointer;">
            Create Post
        </button>
    </a>
    <ul style="list-style-type:none; padding:0;">
        @foreach ($posts as $post)
            <li>
                <div style="border: 1px solid #ccc; border-radius: 10px; padding: 15px; margin-bottom: 15px; position: relative; overflow: hidden;">
                    @if($post->image)
                        <img src="{{ asset('storage/' . $post->image) }}" alt="Post Image" style="width: 100px; height: 100px; object-fit: cover; border-radius: 10px; float: left; margin-right: 15px;">
                    @endif
                    <div style="margin-left: 120px;">
                        <h3 style="margin: 0;">{{ $post->title }}</h3>
                        <p>{{ $post->content }}</p>
                    </div>
                    <div style="position: absolute; bottom: 15px; right: 15px; display: flex; gap: 10px;">
                        <a href="{{ route('posts.edit', $post->id) }}">
                            <button type="button" style="padding: 5px 10px; border: none; background-color: #007bff; color: white; border-radius: 5px; cursor: pointer;">
                                Edit
                            </button>
                        </a>
                        <form action="{{ route('posts.destroy', $post->id) }}" method="POST" style="margin: 0;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" style="padding: 5px 10px; border: none; background-color: #dc3545; color: white; border-radius: 5px; cursor: pointer;">
                                Delete
                            </button>
                        </form>
                    </div>
                </div>
            </li>
        @endforeach
    </ul>
@endsection
