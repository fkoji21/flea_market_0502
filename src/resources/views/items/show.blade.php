<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>商品詳細</title>
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
        <div class="row">
            <div class="col-md-6">
                <img src="{{ $item->image_url }}" alt="商品画像" class="img-fluid">
            </div>
            <div class="col-md-6">
                <h3>{{ $item->title }}</h3>
                <p>ブランド: {{ $item->brand ?? 'ブランド不明' }}</p>
                <h4>¥{{ number_format($item->price) }} (税込)</h4>
                <a href="/purchase/{{ $item->id }}" class="btn btn-danger mb-3">購入手続きへ</a>

                <h5>商品説明</h5>
                <p>{{ $item->description }}</p>

                <h5>商品情報</h5>
                <ul>
                    <li>カテゴリー: {{ $item->category }}</li>
                    <li>商品の状態: {{ $item->condition }}</li>
                </ul>

                <h5>コメント</h5>
                <ul class="list-group mb-3">
                    @foreach ($item->comments as $comment)
                        <li class="list-group-item">
                            <strong>{{ $comment->user->name }}</strong>: {{ $comment->comment }}
                        </li>
                    @endforeach
                </ul>
                @auth
                <form action="/items/{{ $item->id }}/comment" method="POST">
                    @csrf
                    <div class="mb-3">
                        <textarea name="comment" rows="3" class="form-control" placeholder="コメントを入力"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">コメントを送信する</button>
                </form>
                @endauth
            </div>
        </div>
    </div>
</body>
</html>
