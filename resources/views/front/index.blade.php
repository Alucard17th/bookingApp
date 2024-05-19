@extends('layouts.front')
@push('styles')
<style>
.modal-dialog {
    max-width: 800px;
    margin: 30px auto;
}
.modal-body {
    position: relative;
    padding: 0px;
}
.close {
    position: absolute;
    right: -30px;
    top: 0;
    z-index: 999;
    font-size: 2rem;
    font-weight: normal;
    color: #fff;
    opacity: 1;
}

.team-card-text{
    color: #fff !important;
}

</style>
@endpush

@section('content')
   
 <!-- Loadingscreen Start -->
 <div id="loadingscreen">
    <div class="spinner"></div>
    <!-- <a class="cancel" href="#">Canel</a> -->
</div>
<!-- Loadingscreen End -->
<!--- Hero Banner Start--------->
<section class="hero-banner position-relative overflow-hidden">
    <div class="container">
        <div class="row d-flex flex-wrap align-items-center">
            <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                <div class="position-relative left-hero-color">
                    <h1 class="mb-0 fw-bold">
                    Simplify Your Business Schedule with the <span class="bk-orange">Best</span> Online Appointment Scheduling Software
                    </h1>
                    <div class="text-muted py-3">Manage appointments effortlessly, streamline communication, 
                        and grow your business with our user-friendly appointment scheduling software.</div>
                    <form action="" class="py-2 mb-2">
                        <div class="row">
                            <div class="col-8">
                                <input type="text" class="form-control border-0 shadow-lg"
                                    placeholder="Enter your Email">
                            </div>
                            <div class="col-4">
                                <button class="btn btn-warning btn-hover-secondery">Get Started</button>
                            </div>
                        </div>
                    </form>
                    <button type="button" class="link-primary border-0 bg-transparent text-decoration-underline video-btn" data-src="https://www.youtube.com/embed/NFWSFbqL0A0"
                        data-bs-toggle="modal" data-bs-target="#exampleModal">
                        <span class="d-inline-block me-2"><i class="ti ti-playstation-triangle"></i></span>Discover
                    </button>
                </div>
            </div>
            <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                <div class="position-relative right-hero-color">
                    <script src="https://unpkg.com/@dotlottie/player-component@latest/dist/dotlottie-player.mjs"
                        type="module"></script>

                    <dotlottie-player src="https://lottie.host/f3bf4ccb-bb37-4e08-9625-94c8349613f2/dk2JEAYsGn.json"
                        background="transparent" speed="1" style="width: 636px; height: 636px;" loop autoplay>
                    </dotlottie-player>
                    <!-- <img src="../assets/images/hero/right-image.svg" class="img-fluid"> -->
                </div>
            </div>
        </div>
    </div>
</section>
<!--- Hero Banner End--------->

<!--- Service sectin Start------>
<section class="service position-relative overflow-hidden" id="howitworks">
    <div class="container position-relative">
        <img src="{{asset('assets/images/service/dot-shape.png')}}" class="shape position-absolute">
        <div class="row">
            <div class="col-12"><small class="fs-7 d-block">Working Process</small></div>
            <div
                class="col-12 d-xxl-flex d-xl-flex d-lg-flex d-md-flex d-sm-block d-block align-items-center justify-content-xxl-between justify-content-xl-between justify-content-lg-between justify-content-md-between justify-content-sm-between justify-content-sm-center ">
                <h2 class="fs-2 text-black mb-0">How it works</h2>
            </div>
        </div>
        <div class="row d-flex flex-wrap justify-content-center step-row">
            <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6 col-sm-6 col-12 text-center col-service">
                <div class="card border-0 shadow">
                    <div class="card-body">
                        <img src="{{asset('assets/images/icons/calendar.png')}}" alt="">
                        <h5 class="mb-0 fw-500">Step 1</h5>
                        <h3 class="fs-4">Set Up Your Availability in Minutes</h3>
                        <p class="fs-7 mb-0 fw-500">
                            Simply define your work hours and synchronize them with your existing calendar. 
                            This ensures your booking page only displays the times you're truly available, 
                            saving you and your clients valuable time.
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6 col-sm-6 col-12 text-center col-service">
                <div class="card border-0 shadow">
                    <div class="card-body">
                        <img src="{{asset('assets/images/icons/social.png')}}" alt="">
                        <h5 class="mb-0 fw-500">Step 2</h5>
                        <h3 class="fs-4">Share Your Booking Link & Get Found</h3>
                        <p class="fs-7 mb-0 fw-500">
                            Spread the word! Share your booking link through email, text messages, social media platforms, 
                            or embed it directly on your website. This makes it easy for potential clients to find you and schedule 
                            appointments at their convenience.
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6 col-sm-6 col-12 text-center col-service">
                <div class="card border-0 shadow">
                    <div class="card-body">
                        <img src="{{asset('assets/images/icons/thank-you.png')}}" alt="">
                        <h5 class="mb-0 fw-500">Step 3</h5>
                        <h3 class="fs-4">Manage Bookings & Focus on What Matters</h3>
                        <p class="fs-7 mb-0 fw-500">
                            As clients book appointments, they'll automatically appear on your central dashboard. 
                            This streamlined system allows you to manage your schedule efficiently and focus on delivering a 
                            fantastic service to each client.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--- Service sectin Start------>

<!--- Our Service sectin Start------>
<section class="our-service position-relative overflow-hidden">
    <div class="container">

        <div class="row">
            <div class="col-xxl-8 col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                <!-- <img src="../assets/images/booking-service-2.png" class="img-fluid"> -->
                <script src="https://unpkg.com/@dotlottie/player-component@latest/dist/dotlottie-player.mjs"
                    type="module"></script>

                <dotlottie-player src="https://lottie.host/7011a20c-dc54-42c2-a13a-d1886dd9b8ff/K5Y5ZVB9Gn.json"
                    background="transparent" speed="1" style="width: 550px; height: 550px;" loop autoplay>
                </dotlottie-player>
            </div>
            <div
                class="col-xxl-4 col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 ps-xxl-0 ps-xl-0 ps-lg-3 ps-md-3 ps-sm-3 ps-3">
                <small class="fs-7 d-block">Why Choose Us</small>
                <h2 class="text-black mb-0">Ensure the success of your business meetings through efficient online appointment booking system.</h2>
                <p class="mb-0 fw-500 fs-7">
                    Our user-friendly appointment calendar software keeps your schedule organized in one central location.
                    Schedule appointments, set automated reminders for both you and your contacts,
                    and access important details – all at your fingertips.
                    This eliminates the stress of juggling appointments and ensures you stay on top of your busy schedule.
                </p>
                <ul class="list-unstyled mb-0 pl-0">
                    <li class="d-flex flex-wrap align-items-start">
                        <i class="ti ti-circle-check fs-4 pe-2"></i>
                        <span class="fs-7 text-black">Manage appointments efficiently with a centralized calendar.</span>
                    </li>
                    <li class="d-flex flex-wrap align-items-start">
                        <i class="ti ti-circle-check fs-4 pe-2"></i>
                        <span class="fs-7 text-black">Offer clients a seamless online booking experience.</span>
                    </li>
                    <li class="d-flex flex-wrap align-items-start">
                        <i class="ti ti-circle-check fs-4 pe-2"></i>
                        <span class="fs-7 text-black">Reduce no-shows with automated appointment reminders.</span>
                    </li>
                    <li class="d-flex flex-wrap align-items-start">
                        <i class="ti ti-circle-check fs-4 pe-2"></i>
                        <span class="fs-7 text-black">Free up valuable time for you and your staff to focus on core tasks.</span>
                    </li>
                </ul>
                <a href="#price-plan" 
                class="btn btn-warning btn-hover-secondery text-capitalize mt-2 w-auto contact-btn position-relative">
                    Get Started
                </a>
            </div>
        </div>
    </div>
</section>
<!--- Our Service sectin End---->

<!-- Portfolio section Start---->
<section class="portfolio position-relative bg-primary overflow-hidden" id="services">
    <div class="container position-relative">
        <div class="row">
            <div class="col-12"><small class="fs-7 d-block text-warning">For Everyone</small></div>
            <div
                class="col-12 d-xxl-flex d-xl-flex d-lg-flex d-md-flex d-sm-block d-block align-items-center justify-content-xxl-between justify-content-xl-between justify-content-lg-between justify-content-md-between justify-content-sm-between justify-content-sm-center ">
                <h2 class="fs-3 text-white mb-0">How teams can use our product<br> to manage their appointments.</h2>
            </div>
        </div>
        <div class="row d-flex flex-wrap justify-content-center step-row gy-4">
            <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-6 col-sm-6 col-12 text-center">
                <div class="card bg-transparent teams-card">
                    <div class="card-body p-3">
                        <div class="icon mx-auto rounded-circle d-flex justify-content-center align-items-center"><i
                                class="ti ti-briefcase text-white"></i></div>
                        <h3 class="fs-4 text-white">Small Business Owners</h3>
                        <p class="fs-7 mb-0 fw-500 team-card-text">{{config('app.name')}} is the best 
                            booking system for small business. You can schedule meetings with clients, 
                            consultations with vendors,
                            and other business-related appointments, ensuring efficient time management.</p>
                    </div>
                </div>
            </div>
            <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-6 col-sm-6 col-12 text-center">
                <div class="card bg-transparent teams-card">
                    <div class="card-body p-3">
                        <div class="icon  mx-auto rounded-circle d-flex justify-content-center align-items-center">
                            <i class="ti ti-user text-white"></i>
                        </div>
                        <h3 class="fs-4 text-white">Freelancers</h3>
                        <p class="fs-7 mb-0 fw-500 team-card-text">Freelancers can benefit from {{config('app.name')}} by
                            scheduling client
                            meetings, project consultations, and other work-related appointments. Use the
                            service to maintain a professional image and manage your workload effectively.</p>
                    </div>
                </div>
            </div>
            <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-6 col-sm-6 col-12 text-center">
                <div class="card bg-transparent teams-card">
                    <div class="card-body p-3">
                        <div class="icon mx-auto rounded-circle d-flex justify-content-center align-items-center"><i
                                class="ti ti-cut text-white"></i></div>
                        <h3 class="fs-4 text-white">Barber Shop</h3>
                        <p class="fs-7 mb-0 fw-500 team-card-text">
                        This all-in-one hair barber scheduling app is designed for hair salons, barbers, and stylists.
                        It can help you manage appointments
                        to simplify your day and keep your clients happy and satisfied. 
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-6 col-sm-6 col-12 text-center">
                <div class="card bg-transparent teams-card">
                    <div class="card-body p-3">
                        <div class="icon mx-auto rounded-circle d-flex justify-content-center align-items-center"><i
                                class="ti ti-brush text-white"></i></div>
                        <h3 class="fs-4 text-white">Beauty Salons</h3>
                        <p class="fs-7 mb-0 fw-500 team-card-text">The ideal beauty salon booking software and
                        salon reservation software for beauty. {{config('app.name')}} 
                        delivers a win-win situation for both you and your clients by simplifying appointment scheduling, boosting client satisfaction, and increasing efficiency.
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-6 col-sm-6 col-12 text-center">
                <div class="card bg-transparent teams-card">
                    <div class="card-body p-3">
                        <div class="icon mx-auto rounded-circle d-flex justify-content-center align-items-center"><i
                                class="ti ti-heart text-white"></i></div>
                        <h3 class="fs-4 text-white">Medical Practitioners</h3>
                        <p class="fs-7 mb-0 fw-500 team-card-text">
                            Streamline your practice and prioritize patient care with our medical scheduling software. 
                            Reduce appointment confusion, free up staff time, and improve patient satisfaction.  
                            This user-friendly app lets you manage appointments, 
                            send automated reminders, and access patient information – all in one place.
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-6 col-sm-6 col-12 text-center">
                <div class="card bg-transparent teams-card">
                    <div class="card-body p-3">
                        <div class="icon mx-auto rounded-circle d-flex justify-content-center align-items-center"><i
                                class="ti ti-home-2 text-white"></i></div>
                        <h3 class="fs-4 text-white">Dentists</h3>
                        <p class="fs-7 mb-0 fw-500 team-card-text">
                            Revamp your dental practice with our intuitive dental scheduling software! 
                            Eliminate appointment chaos and wasted time for your staff.  
                            Focus on providing exceptional dental care while our software keeps your practice running smoothly.
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-6 col-sm-6 col-12 text-center">
                <div class="card bg-transparent teams-card">
                    <div class="card-body p-3">
                        <div class="icon mx-auto rounded-circle d-flex justify-content-center align-items-center"><i
                                class="ti ti-book text-white"></i></div>
                        <h3 class="fs-4 text-white">Events Planners</h3>
                        <p class="fs-7 mb-0 fw-500 team-card-text">
                        Manage client communication, vendor bookings, venue logistics, and more – all from one central meeting scheduling tool.  
                        This intuitive platform helps you stay organized, save time, 
                        and impress clients with seamless event execution. 
                        Focus on creating unforgettable experiences, 
                        while we take care of the behind-the-scenes coordination.
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-6 col-sm-6 col-12 text-center">
                <div class="card bg-transparent teams-card">
                    <div class="card-body p-3">
                        <div class="icon mx-auto rounded-circle d-flex justify-content-center align-items-center"><i
                                class="ti ti-home text-white"></i></div>
                        <h3 class="fs-4 text-white">Spas and Massage Practitioners</h3>
                        <p class="fs-7 mb-0 fw-500 team-card-text">
                        All-in-one massage appointment scheduling 
                        software and spa booking software! Simplify your day by offering convenient online booking 
                        for both massages and spa services.  
                        Streamline appointments, reduces no-shows with automated reminders, 
                        and keeps your client information organized.
                        </p>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <div class="container position-relative">
        <div class="portfolio-wrap">
            <div class="owl-carousel owl-theme portfolio-slider">
                <div class="item"><a href="#"><img src="{{asset('assets/images/portfolio/Portfolio.png')}}" class="w-100"></a>
                </div>
                <div class="item"><a href="#"><img src="{{asset('assets/images/portfolio/Portfolio-2.png')}}" class="w-100"></a>
                </div>
                <div class="item"><a href="#"><img src="{{asset('assets/images/portfolio/Portfolio-3.png')}}" class="w-100"></a>
                </div>
                <div class="item"><a href="#"><img src="{{asset('assets/images/portfolio/Portfolio-4.png')}}" class="w-100"></a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Portfolio section End ----->

<!-- Pricing section Start------>
<section class="pricing position-relative overflow-hidden" id="pricing">
    <div class="container position-relative">
        <div class="row justify-content-center">
            <div class="col-xxl-6 col-xl-6 col-lg-12 col-md-12 col-sm-12 col-12 text-center">
                <small class="fs-7 d-block">Pricing Plan</small>
                <h2 class="fs-3 pricing-head text-black mb-0 position-relative">Our Packs</h2>
            </div>
        </div>

        <div class="row justify-content-center price-plan" id="price-plan">
            @foreach($products as $product)
            <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6 col-sm-6 col-12">
                <div
                    class="card position-relative shadow border-0 h-100 {{ $product->name == 'Standard' ? 'highlighted-card' : '' }}">
                    <div class="card-body pb-4 pt-4">
                        <small class="fs-7 d-block text-warning text-center">{{$product->name}}</small>
                        <h2 class="mb-4 text-center position-relative"><sub
                                class="fs-2 text-black">{{$product->price}}</sub><sup
                                class="fs-6 position-absolute">$</sup></h2>
                        <p class="fs-7 text-center fw-500">For individuals looking for a simple CRM solution</p>
                        <ul class="list-unstyled mb-0 pl-0">
                            <li class="d-flex align-items-start pb-2">
                                <i class="ti ti-circle-check bk-orange fs-4 pe-2"></i>
                                <span class="fs-7 text-black">{{$product->bookings}} Bookings</span>
                            </li>
                            @foreach(json_decode($product->features) as $key => $feature)

                            @switch($key)

                            @case('admin_dashboard')
                            <li class="d-flex align-items-start pb-2">
                                <i
                                    class="ti fs-4 pe-2 {{ $feature == 1 ? 'ti-circle-check bk-orange' : 'ti-circle-x text-muted' }}"></i>
                                <span class="fs-7 text-black">Admin Dashboard</span>
                            </li>
                            @break
                            @case('white_label')
                            <li class="d-flex align-items-start pb-2">
                                <i
                                    class="ti fs-4 pe-2 {{ $feature == 1 ? 'ti-circle-check bk-orange' : 'ti-circle-x text-muted' }}"></i>
                                <span class="fs-7 text-black">White Label</span>
                            </li>
                            @break
                            @case('list_in_booked_directory')
                            <li class="d-flex align-items-start pb-2">
                                <i
                                    class="ti fs-4 pe-2 {{ $feature == 1 ? 'ti-circle-check bk-orange' : 'ti-circle-x text-muted' }}"></i>
                                <span class="fs-7 text-black">List in Booked</span>
                            </li>
                            @break
                            @case('widget')
                            <li class="d-flex align-items-start pb-2">
                                <i
                                    class="ti fs-4 pe-2 {{ $feature == 1 ? 'ti-circle-check bk-orange' : 'ti-circle-x text-muted' }}"></i>
                                <span class="fs-7 text-black">Widget</span>
                            </li>
                            @break
                            @case('services_and_events_providers')
                            <li class="d-flex align-items-start pb-2">
                                <i class="ti ti-circle-check bk-orange fs-4 pe-2"></i>
                                <span class="fs-7 text-black">Services/Events Providers : {{ $feature }}</span>
                            </li>
                            @break
                            @default
                            @break
                            @endswitch
                            @endforeach

                        </ul>
                    </div>
                    <div class="card-action text-center pb-xxl-5 pb-xl-5 pb-lg-5 pb-md-4 pb-sm-4 pb-4">
                        <a href="{{ route('paddle.pay', ['price_id' => $product->paddle_price_id]) }}"
                            class="btn btn-warning btn-hover-secondery text-capitalize">Get Started</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
<!-- Pricing section End-------->

<!------ FAQ section Start------>
<section class="faq position-relative overflow-hidden" id="faq">
    <div class="container position-relative">
        <div class="row justify-content-center">
            <div class="col-12 text-center">
                <small class="fs-7 d-block">Frequently Asked Questions</small>
                <h2 class="fs-3 text-black mb-0">Want to ask something from us?</h2>
            </div>
        </div>
        <div class="accordion-block">
            <div class="accordion row" id="accordionPanelsStayOpenExample">
                <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                    <div class="accordion-item mb-3">
                        <h2 class="accordion-header" id="panelsStayOpen-headingOne">
                            <button class="accordion-button text-black fs-7" type="button" data-bs-toggle="collapse"
                                data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true"
                                aria-controls="panelsStayOpen-collapseOne">
                                How does our appointment scheduling software / booking platform help businesses manage appointments and bookings?
                            </button>
                        </h2>
                        <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show"
                            aria-labelledby="panelsStayOpen-headingOne">
                            <div class="accordion-body fs-7 fw-500 pt-0">
                                Our appointment scheduling software / booking platform provides businesses with a centralized solution 
                                to efficiently manage appointments, bookings, and client scheduling. 
                                It offers tools for online appointment scheduling, calendar integration, 
                                and customizable booking pages tailored to each business's specific needs.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item mb-3">
                        <h2 class="accordion-header" id="panelsStayOpen-headingTwo">
                            <button class="accordion-button collapsed text-black fs-7" type="button"
                                data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseTwo"
                                aria-expanded="false" aria-controls="panelsStayOpen-collapseTwo">
                                How does our platform handle booking confirmations and notifications?
                            </button>
                        </h2>
                        <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse"
                            aria-labelledby="panelsStayOpen-headingTwo">
                            <div class="accordion-body fs-7 fw-500 pt-0">
                                Our platform automates appointment confirmations and notifications, 
                                sending emails to both businesses and clients once a booking is made. 
                                It also provides email reminders and calendar events to ensure that both parties 
                                are informed and prepared for upcoming appointments. This helps to reduce appointment no-shows.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item mb-3">
                        <h2 class="accordion-header" id="panelsStayOpen-headingThree">
                            <button class="accordion-button collapsed text-black fs-7" type="button"
                                data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseThree"
                                aria-expanded="false" aria-controls="panelsStayOpen-collapseThree">
                                What are the benefits of having a custom booking page for clients?
                            </button>
                        </h2>
                        <div id="panelsStayOpen-collapseThree" class="accordion-collapse collapse"
                            aria-labelledby="panelsStayOpen-headingThree">
                            <div class="accordion-body fs-7 fw-500 pt-0">
                                A custom booking page allows businesses to showcase their brand identity and provide a 
                                seamless online appointment scheduling experience for clients. It enhances professionalism, promotes brand recognition, 
                                and simplifies the appointment scheduling process for both businesses and clients.
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                    <div class="accordion-item mb-3">
                        <h2 class="accordion-header" id="panelsStayOpen-headingfour">
                            <button class="accordion-button collapsed text-black fs-7" type="button"
                                data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapsefour"
                                aria-expanded="false" aria-controls="panelsStayOpen-collapsefour">
                                Can businesses integrate our platform with their existing tools and systems?
                            </button>
                        </h2>
                        <div id="panelsStayOpen-collapsefour" class="accordion-collapse collapse"
                            aria-labelledby="panelsStayOpen-headingfour">
                            <div class="accordion-body fs-7 fw-500 pt-0">
                            Yes, our appointment scheduling software / booking platform offers integrations with popular 
                            third-party applications such as CRM systems, email marketing tools, and payment gateways.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item mb-3">
                        <h2 class="accordion-header" id="panelsStayOpen-headingfive">
                            <button class="accordion-button collapsed text-black fs-7" type="button"
                                data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapsefive"
                                aria-expanded="false" aria-controls="panelsStayOpen-collapsefive">
                                What level of support is available to businesses using our platform?
                            </button>
                        </h2>
                        <div id="panelsStayOpen-collapsefive" class="accordion-collapse collapse"
                            aria-labelledby="panelsStayOpen-headingfour">
                            <div class="accordion-body fs-7 fw-500 pt-0">
                                We provide comprehensive support to businesses through various channels, including live
                                chat, email, and tutorials. Our dedicated support team is available to assist with any
                                questions or issues that may arise.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item mb-3">
                        <h2 class="accordion-header" id="panelsStayOpen-headingsix">
                            <button class="accordion-button collapsed text-black fs-7" type="button"
                                data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapsesix"
                                aria-expanded="false" aria-controls="panelsStayOpen-collapsesix">
                                What are the pricing options for businesses interested in using our platform?
                            </button>
                        </h2>
                        <div id="panelsStayOpen-collapsesix" class="accordion-collapse collapse"
                            aria-labelledby="panelsStayOpen-headingsix">
                            <div class="accordion-body fs-7 fw-500 pt-0">
                                We offer flexible pricing plans to accommodate businesses of all sizes. Our plans
                                include features such as unlimited bookings, custom
                                branding, and advanced integrations. Businesses can choose the plan that best suits
                                their needs and budget.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!------ FAQ section End------>

<!-----Contact section Start---->
<section class="contact bg-primary position-relative overflow-hidden">
    <div class="container position-relative">
        <div class="dots-shape-left position-absolute"><img src="{{asset('assets/images/service/dot-shape.png')}}"></div>
        <div class="dots-shape-right position-absolute"><img src="{{asset('assets/images/service/dot-shape.png')}}"></div>
        <div class="row">
            <div class="col-xxl-5 col-xl-5 col-lg-5 col-md-12 col-sm-12 col-12">
                <small class="fs-7 d-block text-warning">Join us Now</small>
                <h2 class="fs-3 text-white mb-0">Ready to try {{config('app.name')}}?</h2>
                <div class="owl-carousel owl-theme testimonial">
                    <div class="item">
                        <div class="details position-relative">
                            <p class="fs-5 fw-light blue-light mb-4">
                                This software is amazing! Saved me tons of time managing appointments. Super easy to use and clients loves it.
                            </p>
                            <div class="d-flex align-items-center">
                                <div class="avtar-img rounded-circle overflow-hidden"><img
                                        src="{{asset('assets/images/contact/testimonial-image.png')}}" class="img-fluid">
                                </div>
                                <div class="name ps-3">
                                    <h6 class="text-white">Sarah S.</h6>
                                    <small class="d-block blue-light fw-500 fs-10 pb-0">Hairdresser</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="details position-relative">
                            <p class="fs-5 fw-light blue-light mb-4">
                                Great platform for my massage practice! Keeps my schedule organized and reduces no-shows with appointment reminders. Highly recommend!
                            </p>
                            <div class="d-flex align-items-center">
                                <div class="avtar-img rounded-circle overflow-hidden"><img
                                        src="{{asset('assets/images/contact/testimonial-image.png')}}" class="img-fluid">
                                </div>
                                <div class="name ps-3">
                                    <h6 class="text-white">David L.</h6>
                                    <small class="d-block blue-light fw-500 fs-10 pb-0">Massage Therapist</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xxl-7 col-xl-7 col-lg-7 col-md-12 col-sm-12 col-12">
                <form class="position-relative" method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="row ps-xxl-5 ps-xl-5 ps-lg-3 ps-md-0 ps-sm-0 ps-0">
                        <div class="col-12">
                            <div class="form-group">
                                <label class="form-label text-white fs-7 mb-3">User Name</label>
                                <input type="text" class="form-control border-0" placeholder="Enter your username"
                                    name="name">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label class="form-label text-white fs-7 mb-3">Email address</label>
                                <input type="email" class="form-control border-0" name="email"
                                    placeholder="Enter your email address">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label class="form-label text-white fs-7 mb-3">Password</label>
                                <input type="password" class="form-control border-0" name="password"
                                    placeholder="Enter your password">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label class="form-label text-white fs-7 mb-3">Confirm Password</label>
                                <input type="password" class="form-control border-0" name="password_confirmation"
                                    placeholder="Enter your password">
                            </div>
                        </div>

                        <div class="agree fs-7 fw-500">
                            By clicking on the Sign Up button, you agree to {{ config('app.name') }}<br><a href="{{ route('front.terms') }}"
                                class="text-warning text-decoration-none">terms and conditions of use.</a>
                        </div>
                        <div class="col-12">
                            <button
                                class="btn btn-warning btn-hover-secondery text-capitalize mt-2 w-auto contact-btn">Start now</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl modal-dialog-scrollable pt-5">
            <div class="modal-content bg-transparent">
                <div class="modal-body">
                    <div class="embed-responsive embed-responsive-16by9">
                        <iframe class="embed-responsive-item" src="" 
                        id="video"  allowscriptaccess="always" 
                        allow="autoplay" style="width: 100%; height: 70vh;"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>
<!-----Contact section End----->
@endsection

@push('scripts')
<script type="text/javascript">
    // document.getElementById("loadingscreen").classList.remove("hidden")
    window.addEventListener('load', onPageLoaded, false );
    window.addEventListener("pageshow", onPageShown, false);

    /* special event handler for ios Safari */
    function onPageShown(evt) {
        // check if the page has been loaded from cache entirely
        if (evt.persisted) {
            // emulate the page loaded event
            onPageLoaded();
        }
    }

    function onPageLoaded() {
        setTimeout(function() {
            document.getElementById("loadingscreen").classList.add("hidden");
        }, 1500); // 3000 milliseconds = 3 seconds
    }
</script>
<script>
$(document).ready(function() {
    // Gets the video src from the data-src on each button

    var $videoSrc;
    $('.video-btn').click(function() {
        $videoSrc = $(this).data("src");
    });
    console.log($videoSrc);

    // when the modal is opened autoplay it  
    $('#exampleModal').on('shown.bs.modal', function(e) {
        // set the video src to autoplay and not to show related video. Youtube related video is like a box of chocolates... you never know what you're gonna get
        $("#video").attr('src', $videoSrc + "?autoplay=1&amp;modestbranding=1&amp;showinfo=0");
    })

    // stop playing the youtube video when I close the modal
    $('#exampleModal').on('hide.bs.modal', function(e) {
        // a poor man's stop video
        $("#video").attr('src', $videoSrc);
    })
})
</script>
@endpush