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
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap"
        rel="stylesheet">

    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Styles -->
    <link href="{{asset('/css/app.css')}}" rel="stylesheet">
    @stack('styles')

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

</head>

<body>
    <div id="app">
        <div class="container-fluid">
            <nav class="navbar navbar-expand-xl py-0">
                <div class="logo">
                    <a class="navbar-brand py-0 me-0" href="{{url('/')}}"><img src="{{asset('assets/images/logo.png')}}"
                            alt="" class="mt-4"></a>
                </div>
                <a class="d-inline-block d-lg-block d-xl-none d-xxl-none  nav-toggler text-decoration-none"
                    data-bs-toggle="offcanvas" href="#offcanvasExample" aria-controls="offcanvasExample">
                    <i class="ti ti-menu-2 text-warning"></i>
                </a>
                <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
                    <div class="d-flex align-items-center">
                        @if(!auth()->check())
                        <a class="text-capitalize me-3 login-btn" href="{{route('login')}}">login</a>
                        <a class="btn btn-warning btn-hover-secondery text-capitalize "
                            href="{{route('register')}}">register</a>
                        @else
                        <a class="text-capitalize me-3 login-btn" href="{{route('dashboard')}}">dashboard</a>
                        <form action="{{route('logout')}}" method="POST" id="logout-form">
                            @csrf
                            <button type="submit"
                                class="btn btn-warning btn-hover-secondery text-capitalize ">logout</button>
                        </form>
                        @endif
                    </div>
                </div>
            </nav>
        </div>
        <main class="py-4 @if(request()->route()->getName() === 'login') bg-blue @endif" style="min-height: 100vh;">
            @yield('content')
        </main>
    </div>

    <footer>
        <p class="float-end mb-1">By <a href="https://github.com/abhishekbhatnagar">Booked</a></p>
    </footer>

    @stack('scripts')
</body>

</html>