<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Day {{ $number }}</title>

        <!-- Styles -->
        <link href="/css/main.css" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            <div class="content">
                <div class="title m-b-md">Advent of code 2020</div>

                <h1>Day {{ $number }}</h1>

                @yield('day')

                <div class="links">
                    <a href="{{ route('welcome') }}">Return home</a>
                </div>
            </div>
        </div>
    </body>
</html>
