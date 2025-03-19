<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>商品出品</title>
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
                <li class="nav-item"><a href="/mypage" class="nav-link">マイページ</a></li>
                <li class="nav-item"><a href="/sell" class="btn btn-light ms-2">出品</a></li>
            </ul>
        </div>
    </div>
</nav>

<div class="container mt-4">
    <h2>商品を出品する</h2>
    <form action="/sell" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="image_url" class="form-label">商品画像</label>
            <input type="file" name="image_url" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="title" class="form-label">商品名</label>
            <input type="text" name="title" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">商品説明</label>
            <textarea name="description" rows="4" class="form-control" required></textarea>
        </div>
        <div class="mb-3">
            <label for="category" class="form-label">カテゴリー</label>
            <select name="category" class="form-select" required>
                <option value="">選択してください</option>
                @foreach (['ファッション', '家電', 'インテリア', 'コスメ', '本', 'ゲーム'] as $category)
                    <option value="{{ $category }}">{{ $category }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="condition" class="form-label">商品の状態</label>
            <select name="condition" class="form-select" required>
                <option value="">選択してください</option>
                <option value="新品・未使用">新品・未使用</option>
                <option value="目立った傷や汚れなし">目立った傷や汚れなし</option>
                <option value="やや傷や汚れあり">やや傷や汚れあり</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="price" class="form-label">販売価格（円）</label>
            <input type="number" name="price" class="form-control" min="0" required>
        </div>
        <button type="submit" class="btn btn-danger w-100">出品する</button>
    </form>
</div>
</body>
</html>
