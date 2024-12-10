@extends('layouts.app')

@section('content')
<div class="container my-4">
    <h1 class="text-center">My Profile</h1>

    <!-- 个人信息卡片 -->
    <div class="card shadow-sm mt-4">
        <div class="card-body text-center">
            <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <!-- 显示头像 -->
                <div class="mb-3">
                    <img src="{{ $user->avatar ? asset('storage/' . $user->avatar) : 'https://via.placeholder.com/150' }}" alt="Avatar" class="rounded-circle mb-3" width="150" height="150">
                </div>

                <!-- 上传头像 -->
                <div class="mb-3">
                    <label for="avatar" class="form-label">Change Avatar</label>
                    <input type="file" name="avatar" id="avatar" class="form-control">
                </div>

                <!-- 修改用户名 -->
                <div class="mb-3">
                    <label for="name" class="form-label">Username</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ $user->name }}" required>
                </div>

                <button type="submit" class="btn btn-primary">Update Profile</button>
            </form>
        </div>
    </div>

    <!-- 用户博客列表 -->
    <div class="mt-4">
        <h3>Your Blogs</h3>
        @forelse($user->blogs as $blog)
            <div class="card mb-3">
                <div class="card-body">
                    <h5 class="card-title">{{ $blog->title }}</h5>
                    <p class="card-text">{{ Str::limit($blog->content, 100, '...') }}</p>
                    <a href="{{ route('blogs.show', $blog) }}" class="btn btn-sm btn-primary">View</a>
                    <form action="{{ route('blogs.destroy', $blog) }}" method="POST" class="d-inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </div>
            </div>
        @empty
            <p>You have not published any blogs yet.</p>
        @endforelse
    </div>
</div>
@endsection
