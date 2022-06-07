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
            <span class="mb-3 text-4xl">The team:</span><br>
            <p class="text-xl font-bold">Andrei Decuseara</p>
            <p class="text-xl font-bold">Olaru Andra</p>
            <p class="text-xl font-bold">Alex Kover</p>
            <p class="text-xl font-bold">Gabriel Mitrea</p>
        </h1>
        <div class='outer-scratch'>
            <div class="inner-scratch">

                <div class="flex items-center justify-center w-full text-center background grain ">
                    <div class="flex flex-col w-full text-center">
                        <a href="/reservations" class="z-10 px-4 py-2 m-auto mb-8 font-bold text-white bg-yellow-500 rounded hover:bg-green-700">
                            GO TO OUR APP
                        </a>
                        <div class="z-10 m-auto">
                            <div class="xl:w-96">
                            <select class="form-input form-select" aria-label="Default select example">
                                <option selected>Select your db connection</option>
                                <option value="1">Europe</option>
                                <option value="2">USA</option>
                            </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </body>
</html>
