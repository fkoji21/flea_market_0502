<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>送付先住所変更</title>
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
    <h2>住所の変更</h2>
    <form action="/purchase/address/{{ $item_id }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="postal_code" class="form-label">郵便番号</label>
            <input type="text" name="postal_code" class="form-control" value="{{ old('postal_code', $address->postal_code ?? '') }}" required>
        </div>
        <div class="mb-3">
            <label for="address_line1" class="form-label">住所</label>
            <input type="text" name="address_line1" class="form-control" value="{{ old('address_line1', $address->address_line1 ?? '') }}" required>
        </div>
        <div class="mb-3">
            <label for="address_line2" class="form-label">建物名</label>
            <input type="text" name="address_line2" class="form-control" value="{{ old('address_line2', $address->address_line2 ?? '') }}">
        </div>
        <button type="submit" class="btn btn-danger w-100">更新する</button>
    </form>
</div>
</body>
</html>
