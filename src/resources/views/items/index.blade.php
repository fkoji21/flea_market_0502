<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>商品一覧</title>
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
        <h1>おすすめ商品</h1>
        <div class="row">
            @foreach ($items as $item)
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <img src="{{ $item->image_url }}" class="card-img-top" alt="商品画像">
                        <div class="card-body">
                            <h5 class="card-title">{{ $item->title }}</h5>
                            <p class="card-text">{{ number_format($item->price) }}円</p>
                            <a href="/item/{{ $item->id }}" class="btn btn-primary">詳細を見る</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</body>
</html>
