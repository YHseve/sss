@extends('layouts.app')

@section('content')
<div class="container my-4">
    <h1 class="text-center mb-4">All Blogs</h1>
    <div class="row">
        @forelse($blogs as $blog)
            <div class="col-md-4">
                <div class="card mb-3 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">{{ $blog->title }}</h5>
                        <p class="card-text">{{ Str::limit($blog->content, 100, '...') }}</p>
                        <a href="{{ route('blogs.show', $blog) }}" class="btn btn-primary btn-sm">Read More</a>
                    </div>
                    <div class="card-footer text-muted">
                        By {{ $blog->user->name }} | {{ $blog->created_at->format('M d, Y') }}
                    </div>
                </div>
            </div>
        @empty
            <p class="text-center">No blogs available. Be the first to create one!</p>
        @endforelse
    </div>
</div>
@endsection
