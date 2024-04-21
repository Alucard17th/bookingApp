@extends('layouts.front')
@section('content')
<!------------------------------>
<!--- Welcome Card Start--------->
<!------------------------------>
<section class="service position-relative overflow-hidden" id="howitworks">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mt-4">
                <div class="card position-relative shadow border-0 h-100">
                    <div class="card-body p-2">
                        <small class="fs-7 d-block text-warning text-center">Subscription Successful!</small>
                        <h2 class="mb-4 text-center position-relative"><sub class="fs-2 text-black">Welcome</sub></h2>
                        <p class="fs-7 text-center fw-500">Thank you for subscribing to Booked! Your payment has been processed successfully.</p>
                        <p class="fs-7 text-center fw-500">Go to your dashboard and create your first service/event.</p>
                    </div>
                    <div class="card-action text-center pb-2">
                        <a href="{{ route('dashboard') }}" class="btn btn-warning btn-hover-secondery text-capitalize">Go to Dashboard</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!------------------------------>
<!--- Welcome Card End--------->
<!------------------------------>
@endsection