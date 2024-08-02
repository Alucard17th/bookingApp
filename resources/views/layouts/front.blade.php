<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{config('app.name')}}</title>
    <link rel="icon" type="image/x-icon" href="{{asset('assets/images/fav-icon.png')}}"> 
    <link href="{{asset('libs/OwlCarousel-2/dist/assets/owl.carousel.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/iconfont/tabler-icons.css')}}" rel="stylesheet">
    <link href="{{asset('css/style.css')}}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{asset("vendor/cookie-consent/css/cookie-consent.css")}}">
    @paddleJS
    @stack('styles')
    
</head>

<body>
    <!------------------------------>
    <!-- Header Start -->
    <!------------------------------>
    <header class="main-header position-fixed w-100">
        <div class="container">
            <nav class="navbar navbar-expand-xl py-0">
                <div class="logo">
                    <a class="navbar-brand py-0 me-0" href="{{url('/')}}">
                        <div class="text-black fw-bold fs-4">
                            <span class="bk-orange">Z</span>en<span class="bk-bg-blue px-1 text-white">A</span>ppoint
                        </div>
                    </a>
                </div>
                <a class="d-inline-block d-lg-block d-xl-none d-xxl-none  nav-toggler text-decoration-none"
                    data-bs-toggle="offcanvas" href="#offcanvasExample" aria-controls="offcanvasExample">
                    <i class="ti ti-menu-2 text-warning"></i>
                </a>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <a class="nav-link text-capitalize" aria-current="page" href="{{url('/')}}#howitworks">How it works</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-capitalize" href="{{url('/')}}#services">Services</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-capitalize" href="{{url('/')}}#price-plan">Pricing</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-capitalize @if(request()->is('all-services')) active @endif" href="{{route('front.services')}}">Listings</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-capitalize" href="{{url('/')}}#faq">FAQ</a>
                        </li>
                    </ul>
                    <div class="d-flex align-items-center">
                        @if(!auth()->check())
                        <a class="text-capitalize me-3 login-btn" 
                            href="{{route('login')}}">login</a>
                        <a class="btn btn-warning btn-hover-secondery text-capitalize "
                            href="{{route('register')}}">register</a>
                        @else
                        <a class="text-capitalize me-3 login-btn" href="{{route('dashboard')}}">dashboard</a>
                        <form action="{{route('logout')}}" method="POST" id="logout-form">
                            @csrf
                            <button type="submit" class="btn btn-warning btn-hover-secondery text-capitalize ">logout</button>
                        </form>
                        @endif
                    </div>
                </div>
            </nav>
        </div>

        <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample"
            aria-labelledby="offcanvasExampleLabel">
            <div class="offcanvas-header">
                <div class="logo">
                    <a class="navbar-brand py-0 me-0" href="#"><img src="{{asset('assets/images/logo.png')}}" alt=""></a>
                </div>
                <button type="button" class="btn-close text-reset  ms-auto" data-bs-dismiss="offcanvas"
                    aria-label="Close"><i class="ti ti-x text-warning"></i></button>
            </div>
            <div class="offcanvas-body pt-0">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link text-capitalize" aria-current="page" href="#">Services</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-capitalize" href="#">Pricing</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-capitalize" href="#">Pricing </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-capitalize" href="#">Elements </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-capitalize" href="#">blog </a>
                    </li>
                </ul>
                <div class="login d-block align-items-center mt-3">
                    <a class="btn btn-warning text-capitalize w-100" href="#">contact us</a>
                </div>
            </div>
        </div>
    </header>
    <!------------------------------>
    <!-- Header End  -->
    <!------------------------------>

    @yield('content')

    <!------------------------------>
    <!-----Footer Start------------->
    <!------------------------------>
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6 col-sm-12">
                    <div class="footer-logo-col">
                        <a href="#">
                            <div class="text-white fw-bold fs-4">
                                <span class="bk-orange">Z</span>en<span class="bk-bg-blue">A</span>ppoint
                            </div>
                        </a>
                        <p class="blue-light mb-0 fs-7 fw-500">
                            {{config('app.name')}} offers a very simple, elegant, and secure solution for managing appointments. 
                            Effortlessly take control of your schedule, allowing clients to book appointments at their convenience.
                        </p>
                        <div class="callus text-white fw-500 fs-7">
                            <div class="blue-light">Join me here <a href="https://x.com/EddallalNordin"
                                    class="text-warning fw-500 fs-7 text-decoration-none" target="_blank">Noureddine Eddallal</a></div>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6 col-sm-12">
                    <h5 class="text-white">Social</h5>
                    <ul class="list-unstyled mb-0 pl-0">
                        <!-- <li><a href="#">Blog</a></li> -->
                        <li><a href="mailto:eddallal.noureddine@gmail.com">Support</a></li>
                    </ul>
                </div>
                <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6 col-sm-12">
                    <h5 class="text-white">Company</h5>
                    <ul class="list-unstyled mb-0 pl-0">
                        <li><a href="{{ route('front.about') }}">About</a></li>
                        <li><a href="{{ route('front.privacy') }}">Privacy Policy</a></li>
                        <li><a href="{{ route('front.terms') }}">Terms of Use</a></li>
                    </ul>
                </div>
                <!-- <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6 col-sm-12">
                    <div class="subscribe">
                        <h5 class="text-white">Subscribe</h5>
                        <p class="blue-light fw-500">Subscribe to get the latest news form us
                        </p>
                        <div class="input-group">
                            <input type="email" class="form-control br-15" placeholder="Enter email address"
                                aria-label="Enter email address" aria-describedby="button-addon2">
                            <button
                                class="btn btn-warning btn-hover-secondery ms-xxl-2 ms-xl-2 ls-lg-0 ms-md-0 ms-sm-0 ms-0"
                                type="button" id="button-addon2">Register</button>
                        </div>
                    </div>
                </div> -->
            </div>
            <div class="copyrights text-center blue-light  fw-500">@<span id="autodate">2023</span> - All Rights
                Reserved by <a href="https://adminmart.com/" class="blue-light text-decoration-none">adminmart.com</a>
                Dsitributed By <a href="https://themewagon.com" class="blue-light text-decoration-none">ThemeWagon</a>
            </div>
        </div>
    </footer>
    @include('cookie-consent::index')

    <!------------------------------>
    <!-------Footer End------------->
    <!------------------------------>
    <script src="{{asset('public/js/jquery.min.js')}}"></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <script src="{{asset('libs/OwlCarousel-2/dist/owl.carousel.min.js')}}"></script>
    <script src="{{asset('js/custom.js')}}"></script>
    <script>
    // when document is ready
    $(document).ready(function() {
        // Get the current URL hash
        var currentHash = window.location.hash;
        console.log(currentHash);

        // Get all navigation links
        var navLinks = document.querySelectorAll('.navbar-nav .nav-link');

        // Loop through each navigation link
        navLinks.forEach(function(link) {
            // Check if the link's href matches the current URL hash
            if (link.getAttribute('href') === currentHash) {
                // Add the "active" class to the link
                link.classList.add('active');
            }
        });

        navLinks.forEach(function(link) {
            // Add click event listener to each link
            link.addEventListener('click', function(event) {
                // Remove "active" class from all links
                navLinks.forEach(function(link) {
                    link.classList.remove('active');
                });

                // Add "active" class to the clicked link
                this.classList.add('active');
            });
        });
    });
    </script>

    @stack('scripts')
</body>

</html>