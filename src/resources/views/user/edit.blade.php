@extends('layouts.app')

@section('title', 'プロフィール編集')

@section('content')
<div class="container mt-4">
    <h2>プロフィール編集</h2>
    <form action="/mypage/profile" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="profile_image" class="form-label">プロフィール画像</label>
            <input type="file" name="profile_image" class="form-control">
            @if ($user->profile_image)
                <div class="mt-2">
                    <img src="{{ $user->profile_image }}" width="100" class="rounded-circle" alt="現在の画像">
                </div>
            @endif
        </div>
        <div class="mb-3">
            <label for="name" class="form-label">ユーザー名</label>
            <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}" required>
        </div>
        <div class="mb-3">
            <label for="postal_code" class="form-label">郵便番号</label>
            <input type="text" name="postal_code" class="form-control" value="{{ old('postal_code', $user->postal_code) }}" required>
        </div>
        <div class="mb-3">
            <label for="address" class="form-label">住所</label>
            <input type="text" name="address" class="form-control" value="{{ old('address', $user->address) }}" required>
        </div>
        <button type="submit" class="btn btn-danger w-100">更新する</button>
    </form>
</div>
@endsection
