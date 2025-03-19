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
    <header>
        <nav>
            <a href="/">トップ</a>
            @auth
                <a href="/mypage">マイページ</a>
                <form action="/logout" method="POST" style="display:inline;">
                    @csrf
                    <button type="submit">ログアウト</button>
                </form>
            @else
                <a href="/login">ログイン</a>
                <a href="/register">新規登録</a>
            @endauth
        </nav>
    </header>

    <main>
        @yield('content')
    </main>

    <footer>
        <small>&copy; フリマサイト</small>
    </footer>
</body>
</html>
