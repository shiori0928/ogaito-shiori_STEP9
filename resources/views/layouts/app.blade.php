<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>@yield('title')</title>

<!-- Bootstrap -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body class="bg-light">

<!-- ヘッダー -->
<header class="bg-white border-bottom py-2">
    <div class="container d-flex justify-content-between align-items-center">

        <!-- 左：サイト名 -->
        <div class="fw-bold">
            Cytech EC
        </div>

        <!-- 右：全部まとめる -->
        <div class="d-flex align-items-center gap-2">

            <a href="{{ route('products.index') }}" class="btn btn-outline-primary btn-sm">
                Home
            </a>

            <a href="{{ route('mypage.index') }}" class="btn btn-outline-secondary btn-sm">
                マイページ
            </a>

            @auth
                <span class="ms-2">
                    ログインユーザー：{{ Auth::user()->name }}
                </span>

                <form action="{{ route('logout') }}" method="POST" class="mb-0">
                    @csrf
                    <button type="submit" class="btn btn-danger btn-sm">
                        ログアウト
                    </button>
                </form>
            @endauth

        </div>

    </div>
</header>

<!-- メイン -->
<main class="container py-4">
    @yield('content')
</main>

<!-- フッター -->
<footer class="bg-white border-top text-center py-4 mt-5">

    <div class="mb-3">
        <a href="{{ route('contact') }}" class="btn btn-warning btn-sm">
            お問い合わせ
        </a>
    </div>

    <div>
        <a href="{{ route('products.index') }}" class="me-3">Home</a>
        <a href="{{ route('mypage.index') }}">マイページ</a>
    </div>

</footer>

</body>
</html>