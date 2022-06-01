<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Cinema</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    </head>
    <body class="effect">

        <h1 class="h1">
            <span class="span">Cinema mega project</span><br>
            <span class="text-4xl mb-3">The team:</span><br>
            <p class="text-xl font-bold">Andrei Decuseara</p>
            <p class="text-xl font-bold">Olaru Andra</p>
            <p class="text-xl font-bold">Alex</p>
            <p class="text-xl font-bold">Gabriel Mitrea</p>
        </h1>
        <div class='outer-scratch'>
            <div class="inner-scratch">
                <div class="background grain flex junstify-center items-center w-full text-center">
                   <a href="/movies" class="m-auto bg-yellow-500 z-10 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                       GO TO OUR APP
                    </a>
                </div>
            </div>
        </div>

    </body>
</html>
