@extends('layouts.front')
@push('styles')
<style>
section {
    line-height: 30px;
}
</style>
@endpush

@section('content')
<section class="pricing position-relative overflow-hidden" id="pricing">
    <!-- <div class="container position-relative">
        <div class="row">
            <div class="col-md-12 col-lg-12 mb-4 mb-md-0">
    
            </div>
        </div>
    </div> -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-4 mb-lg-0">
                    <h1 class="display-3 fw-bold">Anyone, anywhere, can start <span
                            class="text-primary">Bootstrap</span></h1>
                    <p class="lead my-4">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam feugiat erat quis
                        pulvinar semper.</p><a class="btn btn-lg btn-primary" href="">Get Started</a>
                </div>
                <div class="col-lg-6"><img alt="" class="img-fluid" src="https://freefrontend.dev/assets/square.png">
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-md-3 col-sm-6 mb-3 mb-md-0">
                    <div class="mb-3">
                        <svg class="bi bi-globe-asia-australia" fill="currentColor" height="48" viewbox="0 0 16 16"
                            width="48" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="m10.495 6.92 1.278-.619a.483.483 0 0 0 .126-.782c-.252-.244-.682-.139-.932.107-.23.226-.513.373-.816.53l-.102.054c-.338.178-.264.626.1.736a.476.476 0 0 0 .346-.027ZM7.741 9.808V9.78a.413.413 0 1 1 .783.183l-.22.443a.602.602 0 0 1-.12.167l-.193.185a.36.36 0 1 1-.5-.516l.112-.108a.453.453 0 0 0 .138-.326ZM5.672 12.5l.482.233A.386.386 0 1 0 6.32 12h-.416a.702.702 0 0 1-.419-.139l-.277-.206a.302.302 0 1 0-.298.52l.761.325Z">
                            </path>
                            <path
                                d="M8 0a8 8 0 1 0 0 16A8 8 0 0 0 8 0ZM1.612 10.867l.756-1.288a1 1 0 0 1 1.545-.225l1.074 1.005a.986.986 0 0 0 1.36-.011l.038-.037a.882.882 0 0 0 .26-.755c-.075-.548.37-1.033.92-1.099.728-.086 1.587-.324 1.728-.957.086-.386-.114-.83-.361-1.2-.207-.312 0-.8.374-.8.123 0 .24-.055.318-.15l.393-.474c.196-.237.491-.368.797-.403.554-.064 1.407-.277 1.583-.973.098-.391-.192-.634-.484-.88-.254-.212-.51-.426-.515-.741a6.998 6.998 0 0 1 3.425 7.692 1.015 1.015 0 0 0-.087-.063l-.316-.204a1 1 0 0 0-.977-.06l-.169.082a1 1 0 0 1-.741.051l-1.021-.329A1 1 0 0 0 11.205 9h-.165a1 1 0 0 0-.945.674l-.172.499a1 1 0 0 1-.404.514l-.802.518a1 1 0 0 0-.458.84v.455a1 1 0 0 0 1 1h.257a1 1 0 0 1 .542.16l.762.49a.998.998 0 0 0 .283.126 7.001 7.001 0 0 1-9.49-3.409Z">
                            </path>
                        </svg>
                    </div>
                    <h4>Satisfied</h4>
                    <p>International clients that are satisfied</p>
                </div>
                <div class="col-md-3 col-sm-6 mb-3 mb-md-0">
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
                    <h4>Experience</h4>
                    <p>Years of expertise in website design</p>
                </div>
                <div class="col-md-3 col-sm-6 mb-3 mb-md-0">
                    <div class="mb-3">
                        <svg class="bi bi-people-fill" fill="currentColor" height="48" viewbox="0 0 16 16" width="48"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1H7Zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm-5.784 6A2.238 2.238 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.325 6.325 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1h4.216ZM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5Z">
                            </path>
                        </svg>
                    </div>
                    <h4>Trust</h4>
                    <p>Users believe our code snippets</p>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="mb-3">
                        <svg class="bi bi-brightness-high-fill" fill="currentColor" height="48" viewbox="0 0 16 16"
                            width="48" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M12 8a4 4 0 1 1-8 0 4 4 0 0 1 8 0zM8 0a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 0zm0 13a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 13zm8-5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2a.5.5 0 0 1 .5.5zM3 8a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2A.5.5 0 0 1 3 8zm10.657-5.657a.5.5 0 0 1 0 .707l-1.414 1.415a.5.5 0 1 1-.707-.708l1.414-1.414a.5.5 0 0 1 .707 0zm-9.193 9.193a.5.5 0 0 1 0 .707L3.05 13.657a.5.5 0 0 1-.707-.707l1.414-1.414a.5.5 0 0 1 .707 0zm9.193 2.121a.5.5 0 0 1-.707 0l-1.414-1.414a.5.5 0 0 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .707zM4.464 4.465a.5.5 0 0 1-.707 0L2.343 3.05a.5.5 0 1 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .708z">
                            </path>
                        </svg>
                    </div>
                    <h4>Strategy</h4>
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
                    <h2 class="display-5 fw-bold">About Us</h2>
                    <p class="lead">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor Lorem
                        ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor.</p>
                </div>
                <div class="col-md-6 offset-md-1">
                    <p class="lead">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                        incididunt ut labore et dolore magna aliqua Lorem ipsum dolor sit amet, consectetur adipiscing
                        elit, sed do eiusmod sed do eiusmod tempor incididunt ut labore et dolore magna aliqua Lorem
                        ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod.</p>
                    <p class="lead">ullamco laboris nisi ut a Lorem ipsum dolor sit amet,consectetur adipiscing eli
                        ncididunt ullamco laboris nisi ut a Lorem ipsum dolor sit amet,consectetur adipiscing el Lorem
                        ipsum dolor sit amet,consectetur adipiscing eli ncididunt ullamco laboris nisi ut a Lorem ipsum
                        dolor sit amet,consectetur adipiscing el.</p>
                </div>
            </div>
        </div>
    </section>
    <section class="py-5">
        <div class="container">
            <div class="row gx-4 align-items-center">
                <div class="col-md-6">
                    <div class="me-md-2 me-lg-5"><img class="img-fluid rounded-3"
                            src="https://freefrontend.dev/assets/square.png"></div>
                </div>
                <div class="col-md-6">
                    <div class="ms-md-2 ms-lg-5 mt-5 mt-md-0">
                        <span class="text-muted">Our Story</span>
                        <h2 class="display-5 fw-bold">About Us</h2>
                        <p class="lead">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                            incididunt ut labore et dolore magna aliqua.</p>
                        <p class="lead">Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut.</p>
                        <a class="btn btn-primary" href="#">Learn more</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</section>
@include('cookie-consent::index')

@endsection