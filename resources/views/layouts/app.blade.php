<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Hexlet Blog - @yield('title')</title>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="csrf-param" content="_token" />
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <script src="{{ asset('js/app.js') }}"></script>
    </head>
    <body>
        <nav>
            <a href="{{ route('welcome') }}">Анализатор страниц</a>
            <a href="{{ route('welcome') }}">Главная</a>
            <a href="{{ route('urls.index') }}">Сайты</a>
        </nav>
        <div class="container mt-4">
            <div>
                @yield('content')
            </div>
        </div>
    </body>
</html>