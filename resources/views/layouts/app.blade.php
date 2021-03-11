<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Анализатор страниц</title>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="csrf-param" content="_token" />
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <script src="{{ asset('js/app.js') }}"></script>
    </head>
    <body class="min-vh-100 d-flex flex-column">
        <header>
            <nav class="navbar navbar-expand-md navbar-dark bg-dark p-2">
                <a class="navbar-brand" href="{{ route('welcome') }}">Анализатор страниц</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarMenu" aria-controls="navbarMenu" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarMenu">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item"><a class="nav-link" href="{{ route('welcome') }}">Главная</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('urls.index') }}">Сайты</a></li>
                    </ul>
                </div>
            </nav>
        </header>
        <main class="flex-grow-1">
            @yield('content')
        </main>
        <footer>
            <div class="container">
                <div class="row">
                    <div class="col-12 text-center">
                        <p>Vasileva Valentina</p>
                    </div>
                </div>
            </div>
        </footer>
        </div>
    </body>
</html>