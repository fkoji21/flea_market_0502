<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>プロフィール編集</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="/">COACHTECH</a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a href="/logout" class="nav-link">ログアウト</a></li>
                <li class="nav-item"><a href="/sell" class="btn btn-light ms-2">出品</a></li>
            </ul>
        </div>
    </div>
</nav>

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
</body>
</html>
