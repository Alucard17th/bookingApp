<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="icon" type="image/x-icon" href="{{asset('assets/images/fav-icon.png')}}"> 
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

    <!-- DataTable Styles -->
    <link href="https://cdn.datatables.net/2.0.3/css/dataTables.bootstrap5.css" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <!-- {{ config('app.name', 'Laravel') }} -->
                    <div class="logo">
                        <a class="navbar-brand py-0 me-0" href="{{url('/')}}">
                            <div class="text-black fw-bold fs-4">
                                <span class="bk-orange">Z</span>en<span class="bk-bg-blue px-1 text-white">A</span>ppoint
                            </div>
                        </a>
                    </div>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                            <li class="nav-item">
                                <a class="btn btn-secondery text-capitalize text-white me-3"
                                    href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @endif

                            @if (Route::has('register'))
                            <!-- <li class="nav-item">
                                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                    </li> -->
                            <li class="nav-item">
                                <a class="btn btn-secondery text-capitalize text-white"
                                    href="{{route('register')}}">register</a>
                            </li>
                            @endif
                        @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                data-bs-toggle="dropdown" aria-haspopup="" aria-expanded="false" v-pre>
                                <i class="fas fa-bell iconClass">
                                    @if(Auth()->user()->unreadNotifications->count() > 0)
                                    <i class="fas fa-circle text-danger iconClassCircle"></i>
                                    @endif
                                </i>
                            </a>

                            @if(Auth()->user()->unreadNotifications->count() > 0)
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown" 
                            style="min-width: 15rem; max-height: 400px; overflow-y: auto;">
                                <div class="d-flex justify-content-between align-items-center px-2 py-0">
                                    <h6 class="mb-0">Notifications</h6>
                                    <a class="bk-orange" href="{{route('markAllNotificationsAsRead')}}"><i class="fas fa-check"></i> Mark all as read</a>
                                </div>
                                <hr class="dropdown-divider">
                                @foreach(Auth()->user()->unreadNotifications as $notification)
                                <a class="dropdown-item" href="{{ $notification->data['url'] }}"> 
                                    {{ $notification->data['message'] }}  <br>
                                    <small class="text-muted"> {{ $notification->created_at->diffForHumans() }} </small>
                                </a>
                                <hr class="dropdown-divider">
                                @endforeach
                            </div>
                            @else
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown" style="min-width: 15rem;">
                                <div class="d-flex justify-content-between align-items-center px-2 py-0">
                                    <h6 class="mb-0">No new notifications</h6>
                                </div>
                            </div>
                            @endif
                        </li>
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        <div class="container-fluid">
            <div class="row">
                <div class="col-2 sidebar-collapsed">
                    <div class="sidebar">
                        @auth
                        @include('includes.sidebar')
                        @endauth
                    </div>
                </div>

                <div class="col-10 content-collapsed">
                    <main class="py-4 @if(request()->route()->getName() === 'login') bg-blue @endif"
                        style="min-height: 100vh;">
                        @if(auth()->user() && !auth()->user()->canBeBooked())
                        <div class="container">
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <strong>Oh snap!</strong> You can't receive any bookings. You have reached the limit.
                                <!-- <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button> -->
                            </div>
                        </div>
                        @endif
                        @yield('content')
                    </main>
                </div>
            </div>

            <div class="toast-container position-fixed bottom-0 end-0 p-3">
                <div id="liveToast" class="toast bg-dark text-white" role="alert" 
                aria-live="assertive" aria-atomic="true" data-bs-delay="3000">
                    <div class="toast-body">
                    <button type="button" class="btn-close btn-close-white me-2 m-auto close float-end" data-bs-dismiss="toast" aria-label="Close"></button>
                        Link copied to clipboard
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
    @stack('scripts')
    <!-- DataTables Scripts -->
    <script src="https://cdn.datatables.net/2.0.3/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.0.3/js/dataTables.bootstrap5.js"></script>
    <script>
    $(document).ready(function() {

        // Check if there is an element with the table class
        var tablesElement = document.querySelectorAll('.table');

        // Proceed with initialization if the element exists
        tablesElement.forEach(function(tableElement) {
            if (tableElement) {
                new DataTable(tableElement, {
                    "order": [
                        [0, "desc"]
                    ],
                    initComplete: function() {
                        this.api()
                            .columns()
                            .every(function() {
                                let column = this;
                                let columnContent = column.header().textContent
                                // Check if column footer exists
                                if (column.footer() && columnContent != 'Action' && columnContent != 'ID') {
                                    let title = column.footer().textContent;

                                    // Create input element
                                    let input = document.createElement('input');
                                    input.classList.add('form-control');
                                    input.placeholder = title;
                                    column.footer().replaceChildren(input);

                                    // Event listener for user input
                                    input.addEventListener('keyup', () => {
                                        if (column.search() !== this.value) {
                                            column.search(input.value).draw();
                                        }
                                    });
                                    input.addEventListener('click', (e) => {
                                        e.stopPropagation();
                                    });
                                    const parentElement = input.parentElement;
                                    parentElement.addEventListener('click', (e) => {
                                        e.stopPropagation();
                                    })
                                }else{
                                    column.footer().replaceChildren();
                                    column.footer().addEventListener('click', (e) => {
                                        e.stopPropagation();
                                    })
                                }
                            });

                        var r = $('.table tfoot tr');
                        r.find('th').each(function() {
                            $(this).css('padding', 8);
                        });
                        $('.table thead').append(r);
                        $('#search_0').css('text-align', 'center');
                    }
                });
            } else {
                console.log('No element with class "table" found.');
            }
        })
        

        $('.toggle-sidebar').click(function() {
            $('.sidebar-collapsed').toggleClass('sidebar-expanded');
            $('.content-collapsed').toggleClass('content-expanded');
        });
    })
    </script>

</body>

</html>