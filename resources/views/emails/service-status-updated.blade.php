@extends('layouts.email')
@push('styles') 
<style>
.content {
    padding: 20px;
}

.cta {
    text-align: center;
    margin-top: 20px;
}

.cta-action-p {
    margin-bottom: 50px;
}

.cta-action-btn {
    text-align: center;
    text-decoration: none;
    vertical-align: middle;
    user-select: none;
    background-color: #EE7B11;
    transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
    padding: 18px 35px;
    border-radius: 15px;
    font-size: 17px;
    cursor: pointer;
    color: #fff;
}

.cta-action-btn:hover {
    color: #fff;
    background-color: #000;
}

a {
    text-decoration: none;
    color: #333;
}


.features-list {
    display: flex;
}

.list {
    width: 60%;
}

.schedule-image {
    width: 40%;
    height: auto;
    display: block;
    margin: 0 auto;
}
</style>
@endpush

@section('content')
<div class="content">
    <h2>Welcome to {{config('app.name')}}, {{ $receiverName }}!</h2>
    <p>The service {{ $service->name }} has been {{ $status }}.</p>
</div>
<div class="cta">
    <p class="cta-action-p"><a href="#" class="cta-action-btn">See the service details</a></p>
</div>
<div class="thank-you">
    <p>Thank you for choosing {{config('app.name')}}! We look forward to helping you achieve your goals.</p>
    <p>Sincerely,</p>
    <p>The {{config('app.name')}} Team</p>
</div>
@endsection