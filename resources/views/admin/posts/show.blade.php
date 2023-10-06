<!-- show.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">

        <!-- Display success message if it exists in the session -->
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <h1>{{ $post->title }}</h1>
        <p>{{ $post->content }}</p>

        @if($post->image)
            <img src="{{ $post->image }}" alt="Post Image" style="max-width: 100px;">
        @else
            No Image
        @endif

        <p><strong>Published:</strong> {{ $post->published ? 'Yes' : 'No' }}</p>
        <p><strong>Published At:</strong> {{ $post->published_at }}</p>

        <div class="mt-3">
            <a href="{{ route('admin.posts.edit', $post->id) }}" class="btn btn-primary">Edit</a>

            <form action="{{ route('admin.posts.destroy', $post->id) }}" method="POST" style="display: inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger"
                        onclick="return confirm('Are you sure you want to delete this post?')">Delete
                </button>
            </form>
        </div>
    </div>
@endsection
