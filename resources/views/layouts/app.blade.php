<!DOCTYPE html>
<html lang="ja">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <link href="{{ asset('css/style.css') }}" rel="stylesheet">
        <title>@yield('title')</title>
    </head>

    <body>
        <div id="app" class="wrapper">

            <div class="header container-fluid py-2">
                <div class="d-flex justify-content-between align-items-center col-md-12 px-3">
                    <div class="d-flex align-items-center">
                        <h1><a href="{{ url('/') }}">

                                出欠管理システム
                            </a></h1>
                    </div>
                    <div class="d-flex align-items-center">

                        <ul class="login_menu d-flex list-unstyled">
                            @guest
                            <li>
                                <a class="button square_min" href="{{ route('login') }}">

                                    ログイン</a>
                            </li>
                            @if (Route::has('register'))
                            <li>
                                <a class="button square_min" href="{{ route('register') }}">

                                    管理者登録</a>
                            </li>
                            @endif
                            @else
                            <li>
                                <a class="button square_min" href="{{ route('logout') }}" onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                                    ログアウト
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                    </div>
                    </li>
                    @endguest
                    </ul>
                </div>
            </div>
        </div>


        <div class="content container-fluid mt-2">

            <nav aria-label="breadcrumb col-md-12">
                <ol class="breadcrumb">
                    @yield('breadcrumb')
                </ol>
            </nav>

            <div class="my-4 col-md-12">
                @yield('content')
            </div>

        </div>

        </div>
    </body>
</html>
