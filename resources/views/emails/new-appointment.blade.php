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
    font-size: 17px;
    cursor: pointer;
    color: #EE7B11;
}

.cta-action-btn:hover {
    text-decoration: underline;
}

a {
    text-decoration: none;
    color: #333;
}
</style>
@endpush

@section('content')
@if($receiver == 'owner')
<div class="content">
    <h2>Hi, {{ $user->name }}!</h2>
    <p>
        A new appointment has been created for the service : <b>{{ $service->name }}</b>
    </p>
    <h4>Appointment Details</h4>
    <p>
        <ul>
            <li>
                <b>Time:</b> {{ $appointment->date }} at {{ $appointment->time }}
            </li>
            <li>
                <b>Client:</b> {{ $appointment->name }}
            </li>
            <li>
                <b>Phone:</b> {{ $appointment->phone }}
            </li>
            <li>
                <b>Email:</b> {{ $appointment->email }}
            </li>
        </ul>
    </p>
</div>
<div class="cta">
    <p class="cta-action-p"><a href="{{ route('appointments.show', $appointment->id) }}" class="cta-action-btn">See on your dashboard</a></p>
    <p>Have questions? Don't hesitate to contact us at [your email address] or visit our Help Center at [link to
        help center].</p>
</div>
<div class="thank-you">
    <p>Thank you for choosing {{config('app.name')}}! We look forward to helping you achieve your goals.</p>
    <p>Sincerely,</p>
    <p>The {{config('app.name')}} Team</p>
</div>
@else
<div class="content">
    <h2>Hi, {{ $appointment->name }}!</h2>
    <p>
        You have a scheduled appointment for the service : <b>{{ $service->name }}</b>
    </p>
    <h4>Appointment Details</h4>
    <p>
        <ul>
            <li>
                <b>Time:</b> {{ $appointment->date }} at {{ $appointment->time }}
            </li>
            <li>
                <b>Phone:</b> {{ $appointment->phone }}
            </li>
            <li>
                <b>Email:</b> {{ $appointment->email }}
            </li>
        </ul>
    </p>
</div>
<div class="cta">
    <p>You can cancel or reschedule your appointment <a class="cta-action-btn" href="{{ route('front.appointment.display', $appointment->id) }}" target="_blank">here</a>.</p>
    <p>Have questions? Don't hesitate to contact us at [your email address] or visit our Help Center at [link to
        help center].</p>
</div>
@endif
@endsection