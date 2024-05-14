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
    <h2>Welcome to {{config('app.name')}}, {{ $user->name }}!</h2>
    <p>We're thrilled to have you join our community. {{config('app.name')}} is here to help you schedule
        appointments and easily manage them.</p>
    <div class="features-list">
        <div class="list">
            <p>Now you can easily:</p>
            <ul>
                <li>
                    <a href="#">Manage appointments: Reschedule or cancel existing appointments, all in one
                        place.</a>
                </li>
                <li>
                    <a href="#">Update your profile: Keep your information up-to-date for a smooth experience.</a>
                </li>
                <li>
                    <a href="#">Track your history: See your past appointments for reference.</a>
                </li>
            </ul>
        </div>
        <div class="schedule-image">
            <script src="https://unpkg.com/@dotlottie/player-component@latest/dist/dotlottie-player.mjs" type="module">
            </script>

            <dotlottie-player src="https://lottie.host/f3bf4ccb-bb37-4e08-9625-94c8349613f2/dk2JEAYsGn.json"
                background="transparent" speed="1" style="" loop autoplay>
            </dotlottie-player>
        </div>
    </div>
</div>
<div class="cta">
    <p class="cta-action-p"><a href="#" class="cta-action-btn">Get Started</a></p>
    <p>Have questions? Don't hesitate to contact us at [your email address] or visit our Help Center at [link to
        help center].</p>
</div>
<div class="thank-you">
    <p>Thank you for choosing {{config('app.name')}}! We look forward to helping you achieve your goals.</p>
    <p>Sincerely,</p>
    <p>The {{config('app.name')}} Team</p>
</div>
@endsection