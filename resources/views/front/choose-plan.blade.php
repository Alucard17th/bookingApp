@extends('layouts.front')

@section('content')
<!------------------------------>
<!-- Pricing section Start------>
<!------------------------------>
<section class="pricing position-relative overflow-hidden" id="pricing">
    <div class="container position-relative">
        <div class="row justify-content-center">
            <div class="col-xxl-6 col-xl-6 col-lg-12 col-md-12 col-sm-12 col-12 text-center">
                <small class="fs-7 d-block">Pricing Plan</small>
                <h2 class="fs-3 pricing-head text-black mb-0 position-relative">Please choose your pricing plan</h2>
            </div>
        </div>
      
        <div class="row justify-content-center">
            <div class="col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mt-4">
                <div class="card position-relative shadow border-0 h-100">
                    <div class="card-body p-2">
                        <small class="fs-7 d-block text-warning text-center">For individuals</small>
                        <h2 class="mb-4 text-center position-relative"><sub class="fs-2 text-black">FREE</sub></h2>
                        <p class="fs-7 text-center fw-500">Get started for free and get {{$freeProducts[0]->bookings}} bookings</p>
                    </div>
                    <div class="card-action text-center pb-2">
                        <a href="{{ route('subscribe.create.checkout.session', ['product_id' => $freeProducts[0]->stripe_price_id]) }}" class="btn btn-warning btn-hover-secondery text-capitalize">Get Started</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="row justify-content-center price-plan">
            @foreach($products as $product)
            <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6 col-sm-6 col-12">
                <div class="card position-relative shadow border-0 h-100 {{ $product->name == 'Standard' ? 'highlighted-card' : '' }}">
                    <div class="card-body pb-4">
                        <small class="fs-7 d-block text-warning text-center">{{$product->name}}</small>
                        <h2 class="mb-4 text-center position-relative"><sub class="fs-2 text-black">{{$product->price}}</sub><sup
                                class="fs-6 position-absolute">$</sup></h2>
                        <p class="fs-7 text-center fw-500">For individuals looking for a simple CRM solution</p>
                        <ul class="list-unstyled mb-0 pl-0">
                            <li class="d-flex align-items-start">
                                <i class="ti ti-circle-check bk-orange fs-4 pe-2"></i>
                                <span class="fs-7 text-black">{{$product->bookings}} Bookings</span>
                            </li>
                            @foreach(json_decode($product->features) as $key => $feature)
                            
                                @switch($key)
                                    
                                    @case('admin_dashboard')
                                        <li class="d-flex align-items-start">
                                        <i class="ti fs-4 pe-2 {{ $feature == 1 ? 'ti-circle-check bk-orange' : 'ti-circle-x text-muted' }}"></i>
                                        <span class="fs-7 text-black">Admin Dashboard</span>
                                        </li>
                                        @break
                                    @case('white_label')
                                        <li class="d-flex align-items-start">
                                        <i class="ti fs-4 pe-2 {{ $feature == 1 ? 'ti-circle-check bk-orange' : 'ti-circle-x text-muted' }}"></i>
                                        <span class="fs-7 text-black">White Label</span>
                                        </li>
                                        @break
                                    @case('list_in_booked_directory')
                                        <li class="d-flex align-items-start">
                                        <i class="ti fs-4 pe-2 {{ $feature == 1 ? 'ti-circle-check bk-orange' : 'ti-circle-x text-muted' }}"></i>
                                        <span class="fs-7 text-black">List in Booked</span>
                                        </li>
                                        @break
                                    @case('widget')
                                        <li class="d-flex align-items-start">
                                        <i class="ti fs-4 pe-2 {{ $feature == 1 ? 'ti-circle-check bk-orange' : 'ti-circle-x text-muted' }}"></i>
                                        <span class="fs-7 text-black">Widget</span>
                                        </li>
                                        @break
                                    @case('services_and_events_providers')
                                        <li class="d-flex align-items-start">
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
                        <a href="{{ route('subscribe.create.checkout.session', ['product_id' => $product->stripe_price_id]) }}" class="btn btn-warning btn-hover-secondery text-capitalize">Get Started</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
<!------------------------------>
<!-- Pricing section End-------->
<!------------------------------>

<!------------------------------>
<!------ FAQ section Start------>
<!------------------------------>
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
                                How does our platform help businesses manage appointments and bookings?
                            </button>
                        </h2>
                        <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show"
                            aria-labelledby="panelsStayOpen-headingOne">
                            <div class="accordion-body fs-7 fw-500 pt-0">
                                Our platform provides businesses with a centralized solution to efficiently manage
                                appointments and bookings. It offers tools for scheduling, calendar integration, and
                                customizable booking pages tailored to each business's needs.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item mb-3">
                        <h2 class="accordion-header" id="panelsStayOpen-headingTwo">
                            <button class="accordion-button collapsed text-black fs-7" type="button"
                                data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseTwo"
                                aria-expanded="false" aria-controls="panelsStayOpen-collapseTwo">
                                What are the benefits of having a custom booking page for clients?
                            </button>
                        </h2>
                        <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse"
                            aria-labelledby="panelsStayOpen-headingTwo">
                            <div class="accordion-body fs-7 fw-500 pt-0">
                                A custom booking page allows businesses to showcase their brand identity and provide a
                                seamless booking experience for clients. It enhances professionalism, promotes brand
                                recognition, and simplifies the appointment scheduling process for both businesses and
                                clients.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item mb-3">
                        <h2 class="accordion-header" id="panelsStayOpen-headingThree">
                            <button class="accordion-button collapsed text-black fs-7" type="button"
                                data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseThree"
                                aria-expanded="false" aria-controls="panelsStayOpen-collapseThree">
                                How does our platform handle booking confirmations and notifications?
                            </button>
                        </h2>
                        <div id="panelsStayOpen-collapseThree" class="accordion-collapse collapse"
                            aria-labelledby="panelsStayOpen-headingThree">
                            <div class="accordion-body fs-7 fw-500 pt-0">
                                Our platform automatically sends confirmation emails to businesses and clients once a
                                booking is made. It also provides email reminders and calendar events to ensure that
                                both parties are informed and prepared for upcoming appointments.
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
                                Yes, our platform offers integrations with popular third-party applications such as CRM
                                systems, email marketing tools, and payment gateways. This allows businesses to
                                streamline their workflow and maximize efficiency.
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
                                include both free and premium options, with features such as unlimited bookings, custom
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
<!------------------------------>
<!------ FAQ section End------>
<!------------------------------>

@endsection