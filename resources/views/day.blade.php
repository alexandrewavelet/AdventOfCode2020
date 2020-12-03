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
        <?php /** @var App\Days\Day $day **/ ?>
        <div class="flex-center position-ref full-height">
            <div class="content">
                <div class="title m-b-md">Advent of code 2020</div>

                <h1>Day {{ $number }}: {{ $day->title }}</h1>

                {!! $day->description() !!}
                <a href="https://adventofcode.com/2020/day/{{ $number }}" target="_blank" rel="noopener noreferrer">
                    Read on Adventofcode
                </a>

                <h2>First puzzle</h2>
                {!! $day->firstPuzzle() !!}

                <h2>Second puzzle</h2>
                {!! $day->secondPuzzle() !!}

                <div class="links">
                    <a href="{{ route('welcome') }}">Return home</a>
                </div>
            </div>
        </div>
    </body>
</html>
