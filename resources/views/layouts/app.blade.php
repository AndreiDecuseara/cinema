<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="shortcut icon" type="image/png" href="{{ asset('img/favicon.png') }}">
    <link rel="shortcut icon" sizes="192x192" href="{{ asset('img/favicon.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('img/favicon.png') }}">

    <title>Cinema</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Khula&family=Poppins&family=Nunito+Sans&display=swap" rel="stylesheet">

    {{-- Icons --}}
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">

    <!-- Styles -->
    @livewireStyles
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">

    @include('layouts.scripts.tailwind')

    @stack('head-js')
</head>

<body
    class="font-poppins"
    x-data="tailwindAlpineData()"
    x-on:resize.window="tailwind.currentBreakpoint = Tailwind.getCurrentBreakpoint();"
>
    @livewire('layouts.sidebar')
    @livewire('layouts.navbar')
    <main class="pt-20 print:pt-4 lg:main">
        {{ $slot }}
    </main>


    @livewireScripts

    <script src="{{ mix('js/app.js') }}"></script>
    @stack('js')
</body>

</html>
