<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>フリマサイト</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@400;700&display=swap" rel="stylesheet">
    <style>
      body {
        font-family: 'Noto Sans JP', sans-serif;
      }
    </style>
</head>
<body>
    @if (!isset($hideHeader) || !$hideHeader)
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="/">COACHTECH</a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav ms-auto">
                    @auth
                        <li class="nav-item">
                            <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                                @csrf
                                <button type="submit" class="nav-link btn btn-link" style="padding:0; border:none; background:none; color:#fff; text-decoration:none;">
                                    ログアウト
                                </button>
                            </form>
                        </li>
                        <li class="nav-item"><a href="/mypage" class="nav-link">マイページ</a></li>
                        <li class="nav-item"><a href="/sell" class="btn btn-light ms-2">出品</a></li>
                    @else
                        <li class="nav-item"><a href="/login" class="nav-link">ログイン</a></li>
                        <li class="nav-item"><a href="/register" class="nav-link">新規登録</a></li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>
    @endif
    <main class="container mt-4">
        @yield('content')
    </main>

</body>
</html>
