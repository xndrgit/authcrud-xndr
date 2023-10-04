<!-- index.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Posts</h1>
        <table class="table">
            <thead>
            <tr>
                <th>Title</th>
                <th>Content</th>
                <th>Image</th>
                <th>Published</th>
                {{--                <th>Published At</th>--}}
                <th>Actions</th> <!-- Add Actions column -->
            </tr>
            </thead>
            <tbody>
            @foreach($posts as $post)
                <tr>
                    <td>{{ $post->title }}</td>
                    <td>{{ $post->content }}</td>
                    <td>
                        @if($post->image)
                            <img src="{{ $post->image }}" alt="Post Image" style="max-width: 100px;">
                        @else
                            No Image
                        @endif
                    </td>
                    <td>{{ $post->published ? 'Yes' : 'No' }}</td>
                    {{--                    <td>{{ $post->published_at }}</td>--}}
                    <td class="d-flex">
                        <a href="{{ route('admin.posts.show', $post->id) }}" class="btn btn-primary">Show</a>
                        <a href="{{ route('admin.posts.edit', $post->id) }}" class="btn btn-secondary">Edit</a>
                        <form action="{{ route('admin.posts.destroy', $post->id) }}" method="POST"
                              style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger"
                                    onclick="return confirm('Are you sure you want to delete this post?')">Delete
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection