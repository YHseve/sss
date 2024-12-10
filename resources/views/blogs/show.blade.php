@extends('layouts.app')

@section('content')
<div class="container my-4">
    <div class="card shadow-sm">
        <div class="card-body">
            <h1 class="card-title">{{ $blog->title }}</h1>
            <p class="text-muted">By {{ $blog->user->name }} | {{ $blog->created_at->format('M d, Y') }}</p>
            <hr>
            <p class="card-text">{{ $blog->content }}</p>
        </div>
    </div>
    <div class="mt-4">
        <h3>Comments</h3>
        @forelse($blog->comments as $comment)
            <div class="card mb-3">
                <div class="card-body">
                    <p class="mb-0"><strong>{{ $comment->user->name }}</strong>:</p>
                    <p class="mb-0">{{ $comment->content }}</p>
                    <small class="text-muted">{{ $comment->created_at->diffForHumans() }}</small>
                </div>
            </div>
        @empty
            <p>No comments yet.</p>
        @endforelse

        @auth
        <form action="{{ route('comments.store', $blog) }}" method="POST" class="mt-3">
            @csrf
            <textarea name="content" class="form-control" rows="3" placeholder="Add a comment..." required></textarea>
            <button type="submit" class="btn btn-primary mt-2">Submit Comment</button>
        </form>
        @else
        <p class="text-muted">Please <a href="{{ route('login') }}">login</a> to comment.</p>
        @endauth
    </div>
</div>
@endsection
