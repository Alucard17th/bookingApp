<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap" rel="stylesheet">
    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Styles -->
    <link href="{{asset('css/app.css')}}" rel="stylesheet">
    @stack('styles')
    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <style>
        .bk-bg-orange{
            background-color: #EE7B11 !important;
            color: #ffffff !important;
            font-size: 16px !important;
            font-weight: 800 !important;
        }
        .bk-bg-orange:hover{
            background-color: #FF9B00 !important;

        }
    </style>
</head>
<body >
    <div id="app">
        <main class="vh-100" style="margin-bottom: -100px;">
            @yield('content')
        </main>
    </div>

    <!-- <footer>
        <p class="float-end mb-1">By <a href="https://github.com/abhishekbhatnagar">Booked</a></p>
    </footer> -->

    @stack('scripts')
</body>
</html>
