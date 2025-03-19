<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>商品購入</title>
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
    <h2>商品購入画面</h2>
    <div class="row mt-4">
        <div class="col-md-6">
            <img src="{{ $item->image_url }}" alt="商品画像" class="img-fluid">
            <h4 class="mt-3">{{ $item->title }}</h4>
            <p>価格: ¥{{ number_format($item->price) }}</p>
        </div>
        <div class="col-md-6">
            <form action="/purchase/{{ $item->id }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="payment_method" class="form-label">支払い方法</label>
                    <select name="payment_method" class="form-select" required>
                        <option value="">選択してください</option>
                        <option value="コンビニ払い">コンビニ払い</option>
                        <option value="クレジットカード">クレジットカード</option>
                    </select>
                </div>
                <div class="mb-3">
                <h5>配送先</h5>
                @if($address)
                <p>〒{{ $address->postal_code }}<br>{{ $address->address_line1 }} {{ $address->address_line2 }}</p>
                <a href="/purchase/address/{{ $item->id }}">変更する</a>
                @else
                <p>住所情報が登録されていません。</p>
                <a href="/mypage/address">住所を登録する</a>
                @endif
                </div>
                <button type="submit" class="btn btn-danger w-100">購入する</button>
            </form>
        </div>
    </div>
</div>
</body>
</html>
