@extends('layouts.front')
@section('content')
<!------------------------------>
<!--- Welcome Card Start--------->
<!------------------------------>
<section class="service position-relative overflow-hidden" id="howitworks">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="card-title mb-0">Subscription Successful!</h5>
                        <i class="fas fa-check-circle text-success"></i>
                    </div>
                    <div class="card-body">
                        <p class="card-text">Thank you for subscribing to {{ config('app.name') }}! Your payment has
                            been processed successfully.</p>
                        <p class="card-text">You can now access to the features of our platform.</p>
                        <a href="{{ route('dashboard') }}" class="btn btn-primary">Go to Dashboard</a>
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