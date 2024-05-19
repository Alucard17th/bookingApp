@extends('layouts.front')
@push('styles')
<style>
section {
    line-height: 30px;
}
</style>
@endpush

@section('content')
<section class="pricing overflow-hidden">
    <!-- <div class="container position-relative">
        <div class="row">
            <div class="col-md-12 col-lg-12 mb-4 mb-md-0">
    
            </div>
        </div>
    </div> -->
    <section class="py-5 bg-light">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-4 mb-lg-0">
                    <h1 class="display-3 fw-bold">Crafting a Smoother <span class="bk-orange">Appointment </span>Journey
                    </h1>
                    <p class="lead my-4">
                        Learn how we can help you streamline your schedule and enhance your client experience.
                    </p>
                    <!-- <a class="btn btn-warning btn-hover-secondery text-capitalize position-relative" href="">Get Started</a> -->
                </div>
                <div class="col-lg-6"><img alt="" class="img-fluid" src="{{asset('assets/images/date_picker.svg')}}">
                </div>
            </div>
            <div class="row mt-5 d-flex align-items-center justify-content-start text-center">
                <div class="col-md-4 col-sm-6 mb-3 mb-md-0">
                    <div class="mb-3">
                        <svg class="bi bi-calendar-event" fill="currentColor" height="48" viewbox="0 0 16 16" width="48"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M11 6.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1z">
                            </path>
                            <path
                                d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z">
                            </path>
                        </svg>
                    </div>
                    <h4>Integrity</h4>
                    <p>Years of expertise in website design</p>
                </div>
                <div class="col-md-4 col-sm-6 mb-3 mb-md-0">
                    <div class="mb-3">
                        <svg class="bi bi-people-fill" fill="currentColor" height="48" viewbox="0 0 16 16" width="48"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1H7Zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm-5.784 6A2.238 2.238 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.325 6.325 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1h4.216ZM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5Z">
                            </path>
                        </svg>
                    </div>
                    <h4>Customer Focus</h4>
                    <p>Users believe our code snippets</p>
                </div>
                <div class="col-md-4 col-sm-6">
                    <div class="mb-3">
                        <svg class="bi bi-brightness-high-fill" fill="currentColor" height="48" viewbox="0 0 16 16"
                            width="48" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M12 8a4 4 0 1 1-8 0 4 4 0 0 1 8 0zM8 0a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 0zm0 13a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 13zm8-5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2a.5.5 0 0 1 .5.5zM3 8a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2A.5.5 0 0 1 3 8zm10.657-5.657a.5.5 0 0 1 0 .707l-1.414 1.415a.5.5 0 1 1-.707-.708l1.414-1.414a.5.5 0 0 1 .707 0zm-9.193 9.193a.5.5 0 0 1 0 .707L3.05 13.657a.5.5 0 0 1-.707-.707l1.414-1.414a.5.5 0 0 1 .707 0zm9.193 2.121a.5.5 0 0 1-.707 0l-1.414-1.414a.5.5 0 0 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .707zM4.464 4.465a.5.5 0 0 1-.707 0L2.343 3.05a.5.5 0 1 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .708z">
                            </path>
                        </svg>
                    </div>
                    <h4>Innovation</h4>
                    <p>Great efforts to take Designing Next Level</p>
                </div>
            </div>
        </div>
    </section>
    <section class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-5">
                    <span class="text-muted">Our Story</span>
                    <h2 class="display-5 fw-bold">About Me</h2>
                    <div class="d-flex align-items-center py-2">
                        <div class="rounded-circle overflow-hidden"><img
                                src="{{asset('assets/images/nrdDll.png')}}"
                                class="img-fluid" width="500">
                        </div>
                        <div class="name ps-3">
                            <h6 class="text-dark fs-5">Noureddine Eddallal</h6>
                            <small class="d-block blue-light fw-500 fs-8 pb-0">Full Stack Developer</small>
                            <p class="d-block fs-9 pb-0">
                                10-year experienced Web Developer, freelancing
                                with passion for PHP, Laravel, WordPress, and
                                JavaScript. Embracing challenges, seeing
                                problems as gateways. Ambitious, boundarypushing, crafting top-notch user experiences.
                                Client satisfaction drives me. Let's make a lasting
                                impact!
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 offset-md-1">
                    <p class="lead">{{config('app.name')}} was born out of a shared frustration with the cumbersome and
                        inefficient
                        ways appointments were being managed. We envisioned a world where
                        scheduling appointments was a seamless and stress-free experience for both businesses and
                        clients.
                    </p>
                    <p class="lead">That's why we created {{config('app.name')}}
                        a user-friendly platform that simplifies appointment scheduling and streamlines operations.
                    </p>
                </div>
            </div>
        </div>
    </section>
    <section class="py-5">
        <div class="container">
            <div class="row gx-4 align-items-center">
                <div class="col-md-6">
                    <div class="me-md-2 me-lg-5"><img class="img-fluid rounded-3"
                            src="{{asset('assets/images/schedule.svg')}}"></div>
                </div>
                <div class="col-md-6">
                    <div class="ms-md-2 ms-lg-5 mt-5 mt-md-0">
                        <span class="text-muted">Our Vision</span>
                        <h2 class="display-5 fw-bold">Our Mission and Values</h2>
                        <p class="lead">
                            Our mission is to empower businesses and clients with a simple,
                            secure, and reliable appointment management solution.
                        <ul>
                            <li>Customer Focus: We prioritize exceeding client expectations and delivering exceptional
                                service.</li>
                            <li>Innovation: We constantly strive to improve and develop user-friendly solutions that
                                address evolving needs.</li>
                            <li>Integrity: We conduct ourselves with honesty and transparency in every interaction.</li>
                        </ul>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</section>
@endsection