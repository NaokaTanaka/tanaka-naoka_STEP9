<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>@yield('title', 'Cytech EC')</title>
</head>

    <body>
        <!-- ヘッダー -->
        <header class=>
            <h1>Cytech EC</h1>

            <nav class="nav">
                <ul>
                    <li class="nav-item"><a href="{{ route('products') }}" class="btn btn-success mb-3">Home</a></li>
                    <li class="nav-item"><a href="{{ route('mypage') }}" class="btn btn-success mb-3">マイページ</a></li>
                    <li>ログインユーザー: {{ auth()->user()->name }}</li>
                    <li class="nav-item"><form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                    </form>
                    <a class="btn btn-outline-danger" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">ログアウト</a></li>
                </ul>
            </nav>
        </header>

        <div class="container">
            <div class="row justify-content-center">
                <!-- フラッシュメッセージの表示 -->
                @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
                @endif

                <!-- 各画面の中身 -->
                <div class="col-8">
                    @yield('content')
                </div>
            </div>
        </div>

        <footer>
            <div class=contact-btn>
                <a href="{{ route('contact') }}" class="btn btn-success contact">お問い合わせ</a>
            </div>
            <div class="footer-nav">
                <a href="{{ route('products') }}" class="btn btn-success mb-3">Home</a>
                <a href="{{ route('mypage') }}" class="btn btn-success mb-3">マイページ</a>
            </div>
            <hr>
            <p>&copy; 2024 Company,lnc</p>
        </footer>

    </body>
</html>