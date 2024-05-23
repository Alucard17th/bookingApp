@extends('layouts.booking')

@push('styles')
<!-- Import style from public folder -->
<link
    href="https://www.jqueryscript.net/demo/Beautiful-Multifunctional-Calendar-Plugin-For-jQuery-PIGNOSE-Calender/src/css/pignose.calender.css"
    rel="stylesheet">

<link rel="stylesheet" href="{{ asset('js/pg-calendar-master/dist/css/pignose.calendar.css') }}">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bs-stepper/dist/css/bs-stepper.min.css">
<style>
.pignose-calendar {
    max-width: 100% !important;
    margin-left: 0px !important;
    margin-right: 0px !important;
    width: 100% !important;
}

.pignose-calendar .pignose-calendar-unit.pignose-calendar-unit-disabled a {
    text-decoration: line-through !important;
}

.box {
    padding: 5px 10px;
    background-color: #f2f2f2;
    /* Grey background color */
    width: fit-content;
}


#overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    /* Semi-transparent black background */
    z-index: 9999;
    /* Make sure it's above other content */
}

.logo {
    border-radius: 50%;
    border: 1px solid #fff0f0;
    padding: 5px;
    width: 100px;
    height: 100px;
    object-fit: cover;
    object-position: center;
}

.active .bs-stepper-circle,
.nav-pills .nav-link.active {
    background-color: #1642B9 !important;
}

.nav-link.active {
    color: #fff !important;
}

.nav-link {
    color: #1642B9 !important;
}

.bk-blue {
    color: #1642B9 !important
}

.bk-bg-blue {
    background-color: #1642B9 !important;
    color: #fff !important
}

.text-start {
    font-size: 0.98rem !important;
}

/* RATING */
.wrap {
	width: 250px;
	height: 50px;
	/* background: #fff; */
	/* position: absolute; */
	/* top: 50%; */
	/* left: 50%; */
	/* transform: translate(-50%,-50%); */
	border-radius: 10px;
}
.stars {
	width: fit-content;
	margin: 0 auto;
	cursor: pointer;
}
.star {
	color: #1642B9 !important;
}
.rate {
	height: 50px;
	margin-left: -5px;
	padding: 5px;
	font-size: 25px;
	position: relative;
	cursor: pointer;
}
.rate input[type="radio"] {
	opacity: 0;
	position: absolute;
	top: 50%;
	left: 50%;
	transform: translate(-50%,0%);
	pointer-events: none;
}
.star-over::after {
	font-family: 'Font Awesome 5 Free';
  font-weight: 900;
	font-size: 16px;
	content: "\f005";
	display: inline-block;
	color: #d3dcff;
	z-index: 1;
	position: absolute;
	top: 17px;
	left: 10px;
}

.rate:nth-child(1) .face::after {
	content: "\f119"; /* ☹ */
}
.rate:nth-child(2) .face::after {
	content: "\f11a"; /* 😐 */
}
.rate:nth-child(3) .face::after {
	content: "\f118"; /* 🙂 */
}
.rate:nth-child(4) .face::after {
	content: "\f580"; /* 😊 */
}
.rate:nth-child(5) .face::after {
	content: "\f59a"; /* 😄 */
}
.face {
	opacity: 0;
	position: absolute;
	width: 35px;
	height: 35px;
	background: #1642B9 ;
	border-radius: 5px;
	top: -50px;
	left: 2px;
	transition: 0.2s;
	pointer-events: none;
}
.face::before {
	font-family: 'Font Awesome 5 Free';
  font-weight: 900;
	content: "\f0dd";
	display: inline-block;
	color: #1642B9 ;
	z-index: 1;
	position: absolute;
	left: 9px;
	bottom: -15px;
}
.face::after {
	font-family: 'Font Awesome 5 Free';
  font-weight: 900;
	display: inline-block;
	color: #fff;
	z-index: 1;
	position: absolute;
	left: 5px;
	top: -1px;
}

.rate:hover .face {
	opacity: 1;
}
</style>
@endpush

@php
    $layoutData = ['user' => $user];
@endphp

@section('content')
<div class="container-fluid px-5">
    <div class="row">

        <div class="col-lg-3">
            <div class="row d-flex align-items-center g-0 mb-2">
                <div class="col-4">
                    <img class="img-fluid rounded" src="{{ asset('storage/'.$user->logo) }}" alt="" />
                </div>
                <div class="col-8">
                    <div class="my-4 text-capitalize h4 text-center">{{$user->company_name}}</div>
                </div>
            </div>
            
            <div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                <button class="nav-link active text-start nav-item" id="v-pills-book-tab" data-bs-toggle="pill"
                    data-bs-target="#v-pills-book" type="button" role="tab" aria-controls="v-pills-book"
                    aria-selected="true">Book</button>
                <button class="nav-link text-start nav-item" id="v-pills-reviews-tab" data-bs-toggle="pill"
                    data-bs-target="#v-pills-reviews" type="button" role="tab" aria-controls="v-pills-reviews"
                    aria-selected="false">Reviews</button>
                <!-- <button class="nav-link text-start nav-item" id="v-pills-messages-tab" data-bs-toggle="pill"
                    data-bs-target="#v-pills-messages" type="button" role="tab" aria-controls="v-pills-messages"
                    aria-selected="false">Messages</button>
                <button class="nav-link text-start nav-item" id="v-pills-settings-tab" data-bs-toggle="pill"
                    data-bs-target="#v-pills-settings" type="button" role="tab" aria-controls="v-pills-settings"
                    aria-selected="false">Settings</button> -->
            </div>
        </div>

        <div class="col-lg-6">
            <div class="mb-5 p-4 bg-white shadow-sm">
                <div class="tab-content" id="v-pills-tabContent">
                    <div class="tab-pane fade show active" id="v-pills-book" role="tabpanel"
                        aria-labelledby="v-pills-book-tab">
                        <h3>Form validation</h3>
                        <div id="stepperForm" class="bs-stepper linear">
                            <div class="bs-stepper-header" role="tablist">
                                <div class="step active" data-target="#test-form-1">
                                    <button type="button" class="step-trigger" role="tab" id="stepperFormTrigger1"
                                        aria-controls="test-form-1" aria-selected="true">
                                        <span class="bs-stepper-circle">1</span>
                                        <span class="bs-stepper-label">Services</span>
                                    </button>
                                </div>
                                <div class="bs-stepper-line"></div>
                                <div class="step" data-target="#test-form-2">
                                    <button type="button" class="step-trigger" role="tab" id="stepperFormTrigger2"
                                        aria-controls="test-form-2" aria-selected="false" disabled="disabled">
                                        <span class="bs-stepper-circle">2</span>
                                        <span class="bs-stepper-label">Date & Time</span>
                                    </button>
                                </div>
                                <div class="bs-stepper-line"></div>
                                <div class="step" data-target="#test-form-3">
                                    <button type="button" class="step-trigger" role="tab" id="stepperFormTrigger3"
                                        aria-controls="test-form-3" aria-selected="false" disabled="disabled">
                                        <span class="bs-stepper-circle">3</span>
                                        <span class="bs-stepper-label">Your Details</span>
                                    </button>
                                </div>
                            </div>
                            <div class="bs-stepper-content">
                                <form class="needs-validation" method="POST" id="bookingForm"
                                    action="{{ route('front.service.booking.store') }}">
                                    @csrf
                                    <div id="test-form-1" role="tabpanel"
                                        class="bs-stepper-pane fade active dstepper-block"
                                        aria-labelledby="stepperFormTrigger1">
                                        <div class="row">
                                            <div class="col-3">
                                                <img class="img-fluid rounded" src="{{ asset('storage/'.$user->avatar) }}" alt="" />
                                            </div>
                                            <div class="col-9">
                                                <h4 class="text-capitalize">{{$user->name}}</h4>
                                            </div>
                                            <div class="col-12 mt-3">
                                                <div class="list-group">
                                                    <a href="#" data-serviceid="{{$service->id}}"
                                                        class="list-group-item list-group-item-action list-group-item-light service-item">
                                                        <div class="text-dark fw-bold text-capitalize">
                                                            {{$service->name}}</div>
                                                        <div class="text-muted">{{$service->duration}} mins -
                                                            {{$service->cost}} $</div>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="test-form-2" role="tabpanel" class="bs-stepper-pane fade dstepper-none"
                                        aria-labelledby="stepperFormTrigger2">
                                        <a id="" type="button" class="link-primary my-2 btn-previous-form">
                                            <i class="fas fa-chevron-left me-2"></i>
                                            Select Another Service
                                        </a>
                                        <div class="row">
                                            <div class="col-lg-8">
                                                <div class="calender"></div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="box"></div>
                                                <div class="availabilities mt-3"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="test-form-3" role="tabpanel" class="bs-stepper-pane fade dstepper-none"
                                        aria-labelledby="stepperFormTrigger3">
                                        <div class="form-inputs-step px-5">
                                            <a id="selectAnotherAvailability" type="button" class="link-primary my-2">
                                                <i class="fas fa-chevron-left me-2"></i>
                                                Select Another Availability
                                            </a>
                                            <input type="hidden" name="service_id" id="service_id"
                                                value="{{ $service->id }}">
                                            <div class="form-group">
                                                <label for="name">Name</label>
                                                <input type="text" class="form-control" id="name" name="name" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="email">Email</label>
                                                <input type="email" class="form-control" id="email" name="email"
                                                    required>
                                            </div>
                                            <div class="form-group">
                                                <label for="phone">Phone</label>
                                                <input type="text" class="form-control" id="phone" name="phone"
                                                    required>
                                            </div>
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="date">Date</label>
                                                        <input type="date" class="form-control" id="date" name="date" required
                                                            readonly>
                                                    </div>
                                                </div>

                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="time">Time</label>
                                                        <input type="text" class="form-control" id="time" name="time" required
                                                            readonly>
                                                    </div>
                                                </div>
                                            </div>
                                           
                                            <button
                                                class="btn btn-primary btn-previous-form mt-5 bk-bg-blue">Previous</button>
                                            <button type="submit"
                                                class="btn btn-primary mt-5 bk-bg-blue">Submit</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="v-pills-reviews" role="tabpanel"
                        aria-labelledby="v-pills-reviews-tab">
                        <div class="row">
                            @if($user->reviews->count() == 0)
                            <div class="col-12 text-center">
                                <img src="{{asset('assets/images/logo.png')}}" class="img-fluid login-image">
                                <div class="no-comments mt-5">
                                    <i class="fas fa-frown"></i>
                                    <h4>No reviews yet</h4>
                                    <p>Would you like to share your feedback? Leave a review about your experience.</p>
                                    <button type="button" class="btn bk-bg-blue" data-bs-toggle="modal"
                                        data-bs-target="#exampleModal">
                                        Leave a Review
                                    </button>
                                </div>
                            </div>
                            @else
                            <div class="col-12">
                                <div class="d-flex justify-content-between">
                                    <h4>Reviews</h4>
                                    <button type="button" class="btn bk-bg-blue float-end" data-bs-toggle="modal"
                                            data-bs-target="#exampleModal">
                                            Leave a Review
                                    </button>
                                </div>
                                <ul class="list-unstyled mt-5">
                                    @foreach($user->reviews as $review)
                                    <li class="media my-4">
                                        <div class="media-body">
                                            <h5 class="mt-0 mb-1">{{$review->name}}</h5>
                                            <div class="text-muted">{{$review->created_at}}</div>
                                            <div>{{$review->review}}</div>
                                            <div>
                                                @for($i = 0; $i < 5; $i++)
                                                    @if($i < $review->rating)
                                                        <i class="fas fa-star star"></i>
                                                    @else
                                                        <i class="far fa-star star"></i>
                                                    @endif
                                                @endfor
                                            </div>
                                        </div>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                            @endif
                        </div>
                    </div>
                    <!-- <div class="tab-pane fade" id="v-pills-messages" role="tabpanel"
                        aria-labelledby="v-pills-messages-tab">...</div>
                    <div class="tab-pane fade" id="v-pills-settings" role="tabpanel"
                        aria-labelledby="v-pills-settings-tab">...</div> -->
                </div>
            </div>
        </div>

        <div class="col-lg-3">
            <div class="card border-0 p-2">
                <div class="card-body">
                    <h5>Working Hours</h5>
                    <table class="w-100">
                        @foreach($user->workingHours as $workingHour)
                        <tr>
                            <td
                                class="@if (strtolower(substr($workingHour->day, 0,3)) == strtolower(date('D'))) bk-blue fw-bold @endif">
                                {{ substr($workingHour->day, 0,3) }}
                            </td>
                            <td style="width:25px; height:38px"></td>
                            <td
                                class="@if (strtolower(substr($workingHour->day, 0,3)) == strtolower(date('D'))) bk-blue fw-bold @endif">
                                {{ $workingHour->start_hour }} - {{ $workingHour->end_hour }}
                            </td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('reviews.store') }}" method="POST" id="reviewForm" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="user_id" id="user_id" value="{{ $user->id }}">
                            <div class="form-group">
                                <label for="rating">Rating</label>
                                <div class="wrap">
                                    <div class="stars">
                                        <label class="rate">
                                            <input type="radio" name="rating" id="star1" value="1">
                                            <div class="face"></div>
                                            <i class="far fa-star star one-star"></i>
                                        </label>
                                        <label class="rate">
                                            <input type="radio" name="rating" id="star2" value="2">
                                            <div class="face"></div>
                                            <i class="far fa-star star two-star"></i>
                                        </label>
                                        <label class="rate">
                                            <input type="radio" name="rating" id="star3" value="3">
                                            <div class="face"></div>
                                            <i class="far fa-star star three-star"></i>
                                        </label>
                                        <label class="rate">
                                            <input type="radio" name="rating" id="star4" value="4">
                                            <div class="face"></div>
                                            <i class="far fa-star star four-star"></i>
                                        </label>
                                        <label class="rate">
                                            <input type="radio" name="rating" id="star5" value="5">
                                            <div class="face"></div>
                                            <i class="far fa-star star five-star"></i>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            <div class="form-group">
                                <label for="review">Review</label>
                                <textarea class="form-control" name="review" id="review" cols="30" rows="6"></textarea>
                            </div>
                            <button type="submit" class="btn bk-bg-blue">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<!-- <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script> -->
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
    integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous">
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.12.0/moment.min.js"></script>

<script src="{{ asset('js/pg-calendar-master/dist/js/pignose.calendar.js') }}"></script>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
    integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
</script>

<script src="https://cdn.jsdelivr.net/npm/bs-stepper/dist/js/bs-stepper.min.js"></script>

<script>
// when the document is ready
$(document).ready(function() {
    let workingHours = {!!json_encode($service->user->workingHours) !!};
    let userTimeOff = {!!json_encode($service->user->timeoff) !!};
    let userBreaks = {!!json_encode($service->user->breaks) !!};
    let serviceAppointments = {!!json_encode($service->appointments) !!};
    let allUserAppointments = {!!json_encode($allUserAppointments) !!};

    console.log('Working hours', workingHours);
    console.log('User time off', userTimeOff);
    console.log('User breaks', userBreaks);
    console.log('Service appointments', serviceAppointments);
    console.log('All Service appointments', allUserAppointments);

    var stepper = new Stepper(document.querySelector('.bs-stepper'))
    const nextButton = document.querySelectorAll('.btn-next-form');
    const prevButton = document.querySelectorAll('.btn-previous-form');
    nextButton.forEach(element => {
        element.addEventListener('click', function() {
            stepper.next()
        })
    })
    prevButton.forEach(element => {
        element.addEventListener('click', function() {
            stepper.previous()
        })
    })

    $('#selectAnotherAvailability').on('click', function() {
        stepper.previous()
    });

    const serviceItem = document.querySelectorAll('.service-item');
    let serviceItemID;
    serviceItem.forEach(element => {
        element.addEventListener('click', async function() {
            serviceItemID = element.dataset.serviceid
            $('#service_id').val(serviceItemID);
            const response = await fetch(`/user-service-json/`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    service_id: serviceItemID,
                    _token: "{{ csrf_token() }}"
                })
            });
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            const data = await response.json();

            showCalendarStep(data)
        })
    })

    console.log(userTimeOff);
    let disabledRanges = [];
    userTimeOff.forEach(timeOff => {
        // Construct the start date and end date strings
        const startDate = timeOff.start_date;
        const endDate = timeOff.end_date;

        // If start_time and end_time are provided and not null, include them in the date range
        if (timeOff.start_time == null && timeOff.end_time == null) {
            disabledRanges.push([startDate, endDate]);

        }
    });

    function showCalendarStep(data) {
        $('.calender').pignoseCalendar({
            multiple: false,
            disabledRanges: disabledRanges,
            select: function(date, obj) {
                if (date[0] != null) {
                    $('.box').text('You selected ' + (date[0] === null ? ' ' : date[0].format(
                        'MM-DD-YYYY')) + '.');
                    var selectedDayWorkingHours = workingHours.filter(function(item) {
                        return item.day === date[0].format('dddd');
                    });
                    generateAvailabilities(date[0].format('YYYY-MM-DD'), selectedDayWorkingHours[0], serviceItemID);
                    
                    $('#date').val(date[0].format('YYYY-MM-DD'));
                } else {
                    $('.box').text('');
                    $('.availabilities').empty();
                    // $('#date').val('');
                }
            }
        });
        stepper.next()
    }

    async function generateAvailabilities(selectedDate, workingDay, serviceID) {
        $('#overlay').show();
        $('.availabilities').empty().off('click', '.availability-option');
        var startTime = moment(workingDay.start_hour, 'HH:mm');
        var endTime = moment(workingDay.end_hour, 'HH:mm');
        // Define the buffer time (in minutes)
        var eventDuration = '{{ $service->duration }}';
        var bufferTime = '{{ $service->buffer_time }}';

        while (startTime.isBefore(endTime)) {
            // Adjust the end time to account for the buffer time
            var endTimeAdjusted = startTime.clone().add(eventDuration, 'minutes');
            // Check if the current time slot is available
            var isAvailable = await checkAvailability(selectedDate, startTime.format('HH:mm') + ' - ' +
                endTimeAdjusted.format('HH:mm'), serviceID);
            var option = $('<div class="availability-option"></div>').text(startTime.format('HH:mm') +
                ' - ' + endTimeAdjusted.format('HH:mm'));
            // If the time slot is not available, disable the option
            if (!isAvailable) {
                option.addClass('unavailable');
                option.attr('title', 'This time slot is not available');
            }
            // Append the option to the list of availabilities
            $('.availabilities').append(option);
            // Move to the next start time, accounting for the buffer time
            startTime.add(eventDuration, 'minutes').add(bufferTime, 'minutes');
        }

        $('#overlay').hide();
        // Add click event to the availability options
        $('.availabilities').on('click', '.availability-option', function() {
            $('.availability-option').removeClass('availability-option-selected');
            $(this).addClass('availability-option-selected');
            $('#time').val($(this).text());
            stepper.next()
        });
    }

    const isTimeInRange = (timePart1, timePart2, timeoffStartTime, timeoffEndTime) => {
        return timeoffStartTime.isBetween(timePart1, timePart2) ||
            timeoffEndTime.isBetween(timePart1, timePart2) ||
            timePart1.isBetween(timeoffStartTime, timeoffEndTime) ||
            timePart2.isBetween(timeoffStartTime, timeoffEndTime);
    };

    async function checkAvailability(date, time, serviceID) {
        try {
            let availability = true;
            var filteredAppointments = allUserAppointments.filter(function(appointment) {
                return appointment.service_id == serviceID;
            });
            filteredAppointments.forEach(appointment => {
                if (appointment.time == time && appointment.date == date) {
                    availability = false;
                }
            });
            userTimeOff.forEach(timeoff => {
                const startDate = new Date(timeoff.start_date);
                const endDate = new Date(timeoff.end_date);
                const targetDate = new Date(date);
                const timeoffStartTime = moment(timeoff.start_time, 'HH:mm');
                const timeoffEndTime = moment(timeoff.end_time, 'HH:mm');
                const timePart1 = moment(time.split(' -')[0] + ':00', 'HH:mm');
                const timePart2 = moment(time.split('- ')[1] + ':00', 'HH:mm');
                if (timeoff.end_time != null) {
                    if (targetDate >= startDate && targetDate <= endDate) {
                        if (isTimeInRange(timePart1, timePart2, timeoffStartTime, timeoffEndTime)) {
                            availability = false;
                            console.log('Target time is within the range date and time');
                        }
                    }
                } else {
                    if (targetDate >= startDate && targetDate <= endDate) {
                        availability = false;
                    }
                }
            });

            userBreaks.forEach(breaks => {
                const startTime = moment(breaks.start_time, 'HH:mm');
                const endTime = moment(breaks.end_time, 'HH:mm');
                const breakDayName = breaks.day;
                const targetDate = new Date(date);
                const timePart1 = moment(time.split(' -')[0] + ':00', 'HH:mm');
                const timePart2 = moment(time.split('- ')[1] + ':00', 'HH:mm');
                const fullDayName = targetDate.toLocaleDateString('en-US', { weekday: 'long' });

                if(breakDayName == fullDayName){
                    if (isTimeInRange(timePart1, timePart2, startTime, endTime)) {
                        availability = false;
                        console.log('Target time is within the range date and time');
                    }
                }
            })

            return availability;
        } catch (error) {
            console.error('There was a problem with the check availability operation:', error);
        }
    }
});
</script>

<script>
$(function() {
	
	$(document).on({
		mouseover: function(event) {
			$(this).find('.far').addClass('star-over');
			$(this).prevAll().find('.far').addClass('star-over');
		},
		mouseleave: function(event) {
			$(this).find('.far').removeClass('star-over');
			$(this).prevAll().find('.far').removeClass('star-over');
		}
	}, '.rate');

	$(document).on('click', '.rate', function() {
		if ( !$(this).find('.star').hasClass('rate-active') ) {
			$(this).siblings().find('.star').addClass('far').removeClass('fas rate-active');
			$(this).find('.star').addClass('rate-active fas').removeClass('far star-over');
			$(this).prevAll().find('.star').addClass('fas').removeClass('far star-over');
		} else {
			console.log('has');
		}
	});
	
});
</script>
@endpush