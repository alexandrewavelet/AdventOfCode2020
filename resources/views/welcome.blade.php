<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Advent of Code</title>

        <!-- Styles -->
        <link href="css/main.css" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">

    </head>
    <body>
        <div class="flex-center position-ref full-height">
            <div class="content">
                <div class="title m-b-md">
                    Advent of Code 2020
                </div>

                <div class="links">
                    @foreach ($days as $number => $day)
                        <a href="{{ route('day', ['number' => $number]) }}">{{ $day }}</a>
                    @endforeach
                </div>

                <div class="links">
                    <a href="https://www.youtube.com/watch?v=oHg5SJYRHA0">Never</a>
                    <a href="https://www.youtube.com/watch?v=oHg5SJYRHA0">Gonna</a>
                    <a href="https://www.youtube.com/watch?v=oHg5SJYRHA0">Give</a>
                    <a href="https://www.youtube.com/watch?v=oHg5SJYRHA0">You</a>
                    <a href="https://www.youtube.com/watch?v=oHg5SJYRHA0">Up</a>
                </div>
            </div>
        </div>
    </body>
</html>
