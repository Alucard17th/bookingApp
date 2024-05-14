<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>
    @stack('styles')
    <style>
    .footer-logo {
        width: 100px;
        margin-right: 20px;
    }

    footer .title {
        text-align: center;
        display: flex;
        align-items: center;
        flex-wrap: wrap;
    }

    footer .unsubscribe {
        text-align: center;
        color: #333;
    }

    footer .text-muted {
        text-align: center;
        color: #333;
    }

    body {
        font-family: sans-serif;
        margin: 0;
        padding: 0;
    }

    .container {
        max-width: 600px;
        margin: 20px auto;
        background-color: #fff;
    }

    .header {
        text-align: center;
        background-color: #EE7B11;
        width: 100%;
        padding: 20px 0;
    }

    .logo {
        width: 150px;
        height: auto;
        margin: 0 auto;
    }
    </style>
</head>

<body>

    <div class="container">

        <header class="header">
            <img src="{{asset('assets/images/logo.png')}}" alt="{{config('app.name')}} Logo" class="logo">
        </header>

        @yield('content')

        <hr>

        <footer>
            <div class="title">
                <img src="{{asset('assets/images/logo.png')}}" alt="{{config('app.name')}} Logo" class="footer-logo">
                <p class="footer-paragraph">
                    {{config('app.name')}} Easy Appointments Scheduling and Management
                </p>
            </div>
            <div class="unsubscribe">
                <a href="">Unsubscribe from emails</a>
            </div>
            <p class="text-muted">{{config('app.name')}} © 2024 All Rights Reserved</p>
        </footer>

</body>

</html>