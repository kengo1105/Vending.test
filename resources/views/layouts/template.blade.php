<!doctype html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="{{ asset('css/common.css') }}" rel="stylesheet">
    <title>@yield('title')</title>
</head>
<body>
<script src="{{ asset('/js/common.js') }}"></script>
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <x-dropdown-link :href="route('logout')"
                onclick="event.preventDefault();
                    this.closest('form').submit();">
            ログアウト
        </x-dropdown-link>
    </form>
    <header>
        <h1 class="headline">
            <a>自動販売機</a>
        </h1>
    </header>
    <div class="container">
        @yield('content')
    </div>
</body>
</html>