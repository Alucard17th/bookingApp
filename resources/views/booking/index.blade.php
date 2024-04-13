@extends('layouts.booking')

@push('styles')
<!-- Import style from public folder -->
<link
    href="https://www.jqueryscript.net/demo/Beautiful-Multifunctional-Calendar-Plugin-For-jQuery-PIGNOSE-Calender/src/css/pignose.calender.css"
    rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('js/pg-calendar-master/dist/css/pignose.calendar.css') }}">

<style>
.pignose-calendar {
    max-width: 100% !important;
}
.pignose-calendar .pignose-calendar-unit.pignose-calendar-unit-disabled a {
    text-decoration: line-through !important;
}

.box{
    padding: 5px 10px;
    background-color: #f2f2f2; /* Grey background color */
    width:fit-content;
}

.availability-option{
    width:fit-content;
    cursor:pointer;
    padding: 5px 10px;
}

.availability-option{
    background-color: #ee7b11;
    border-radius: 5px;
    color: #fff;
    margin-bottom: 10px;
}
.availability-option:hover{
    background-color: #1642B9;
    border-radius: 5px;
    border: 1px solid #1642B9;
    color: #fff;
}
.availability-option-selected{
    background-color: #1642B9;
    border-radius: 5px;
    border: 1px solid #1642B9;
    color: #fff;
}

.unavailable {
    text-decoration: line-through;
    background-color: #f2f2f2; /* Grey background color */
    color: #999;
    pointer-events: none;
}

#overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5); /* Semi-transparent black background */
    z-index: 9999; /* Make sure it's above other content */
}

</style>
@endpush

@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- EVENTS & SERVICES -->
        <div class="col-3">
            <div class="card">
                <table class="table table-borderless">
                    <tbody>
                        <tr>
                            <td><h5 class="fw-bold text-uppercase">{{ ucfirst($service->name) }}</h5></td>
                        </tr>
                        <tr>
                            <td>Location:</td>
                            <td><span class="fw-bold">{{ ucfirst($service->location) }}</span></td>
                        </tr>
                        <tr>
                            <td>Duration:</td>
                            <td><span class="fw-bold">{{ $service->duration }} <span class="text-muted">Min</span></span></td>
                        </tr>
                        <tr>
                            <td>Cost:</td>
                            <td><span class="fw-bold">{{ $service->cost }} <span class="text-muted">$</span></span></td>
                        </tr>
                        <tr>
                            <td>Phone:</td>
                            <td><span class="fw-bold">{{ $user->phone }}</span></td>
                        </tr>
                    </tbody>
                </table>
            </div>
         
        </div>

        <!-- CALENDAR -->
        <div class="col-6">
            <div class="calender"></div>
        </div>

        <!-- BOOKING -->
        <div class="col-3">
        @if($service->is_active)
            <div class="booking-info">
                <div class="box"></div>
                <div class="availabilities mt-3"></div>
                <div class="select-availability my-3"  style="display: none">
                    <button type="button" class="btn btn-primary">Select Availability</button>
                </div>
                

                <form method="POST" id="bookingForm" action="{{ route('front.service.booking.store') }}" style="display: none">
                    @csrf

                    <a id="selectAnotherAvailability" type="button" class="link-primary my-2">
                        <i class="fas fa-chevron-left me-2"></i>    
                        Select Another Availability
                    </a>

                    <input type="hidden" name="service_id" id="service_id" value="{{ $service->id }}">

                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>

                    <div class="form-group">
                        <label for="phone">Phone</label>
                        <input type="text" class="form-control" id="phone" name="phone" required>
                    </div>

                    <div class="form-group">
                        <label for="date">Date</label>
                        <input type="date" class="form-control" id="date" name="date" required readonly>
                    </div>

                    <div class="form-group">
                        <label for="time">Time</label>
                        <input type="text" class="form-control" id="time" name="time" required readonly>
                    </div>

                    <div class="form-group mt-3">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        @else
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-center">
                        <i class="fas fa-sad-tear fa-5x bk-custom-orange"></i>
                    </div>
                    <h4 class="text-center mt-3">We're Sorry!</h4>
                    <p class="text-center">Unfortunately, this service is unavailable at this time. Please check back later for updates or explore our other events.</p>
                </div>
            </div>
        @endif
        </div>
    </div>

    <div id="overlay" style="display: none;">
        <div style="display: flex; justify-content: center; align-items: center; width: 100%; height: 100%;">
            <img src="/assets/images/loading.svg" alt="" style="max-width: 200px;">
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.12.0/moment.min.js"></script>
<script src="{{ asset('js/pg-calendar-master/dist/js/pignose.calendar.js') }}"></script>
<script>
// when the document is ready
$(document).ready(function() {
    $(function() {
        $('.calender').pignoseCalendar({
            multiple: false,
            select: function(date, obj) {
                if(date[0] != null) {
                    $('.box').text('You selected ' +
                    (date[0] === null ? ' ' : date[0].format('MM-DD-YYYY')) +
                    '.');
                    generateAvailabilities(date[0].format('YYYY-MM-DD'));
                    $('#date').val(date[0].format('YYYY-MM-DD'));
                }else{
                    $('.box').text('');
                    $('.availabilities').empty();
                    $('#date').val('');
                }
            }
        });
    });
});

async function generateAvailabilities(selectedDate) {
    $('#overlay').show();
    $('.availabilities').empty().off('click', '.availability-option');

    // Set the start and end time for availabilities, starting from 08:00
    var startTime = moment('{{ $service->start_time }}', 'HH:mm');
    var endTime = moment('{{ $service->end_time }}', 'HH:mm');

    // Define the buffer time (in minutes)
    var eventDuration = '{{ $service->duration }}';
    console.log('eventDuration', eventDuration)
    var bufferTime = '{{ $service->buffer_time }}';

    while (startTime.isBefore(endTime)) {
        // Adjust the end time to account for the buffer time
        var endTimeAdjusted = startTime.clone().add(40, 'minutes');

        // Check if the current time slot is available
        var isAvailable = await checkAvailability(selectedDate, startTime.format('HH:mm') + ' - ' + endTimeAdjusted.format('HH:mm'));
        
        var option = $('<div class="availability-option"></div>').text(startTime.format('HH:mm') + ' - ' + endTimeAdjusted.format('HH:mm'));
        // If the time slot is not available, disable the option
        console.log('isAvailable', isAvailable)
        if (!isAvailable) {
            option.addClass('unavailable');
            option.attr('title', 'This time slot is not available');
        }
        // Append the option to the list of availabilities
        $('.availabilities').append(option);

        // Move to the next start time, accounting for the buffer time
        // startTime.add(1, 'hour').add(bufferTime, 'minutes');
        startTime.add(eventDuration, 'minutes').add(bufferTime, 'minutes');
    }

    $('#overlay').hide();

    // Add click event to the availability options
    $('.availabilities').on('click', '.availability-option', function() {
        // Remove bg-primary from all options
        $('.availability-option').removeClass('availability-option-selected');
        // Add availability-option-selected to the clicked option
        $(this).addClass('availability-option-selected');
        $('.select-availability').show();
        $('#time').val($(this).text());
    });
}

// async function generateAvailabilities(selectedDate) {
//     $('#overlay').show();
//     $('.availabilities').empty().off('click', '.availability-option');

//     // Set the start and end time for availabilities
//     var startTime = moment('08:00', 'HH:mm');
//     var endTime = moment('17:00', 'HH:mm');

//     while (startTime.isBefore(endTime)) {
//         // Check if the current time slot is available
//         var isAvailable = await checkAvailability(selectedDate, startTime.format('HH:mm') + ' - ' + startTime.add(1, 'hour').format('HH:mm'));
//         startTime.subtract(1, 'hour');
//         var option = $('<div class="availability-option"></div>').text(startTime.format('HH:mm') + ' - ' + startTime.add(1, 'hour').format('HH:mm'));
//         // If the time slot is not available, disable the option
//         console.log('isAvailable', isAvailable)
//         if (!isAvailable) {
//             option.addClass('unavailable');
//             option.attr('title', 'This time slot is not available');
//         }
//         // Append the option to the list of availabilities
//         $('.availabilities').append(option);
//     }

//     $('#overlay').hide();

//     // Add click event to the availability options
//     $('.availabilities').on('click', '.availability-option', function() {
//         // Remove bg-primary from all options
//         $('.availability-option').removeClass('availability-option-selected');
//         // Add availability-option-selected to the clicked option
//         $(this).addClass('availability-option-selected');
//         $('.select-availability').show();
//         $('#time').val($(this).text());
//     });
// }

async function checkAvailability(date, time) {
    try {
        const response = await fetch(`/get-appointments/${date}`);
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        const data = await response.json();
        // Check if any appointment matches the selected time
        let availability = true;
        data.forEach(appointment => {
            if (appointment.time === time) {
                availability = false;
            }
        });
        return availability;
    } catch (error) {
        console.error('There was a problem with the fetch operation:', error);
        return false; // Handle the error case appropriately
    }
}

$('.select-availability').on('click', function() {
    $('#bookingForm').show();
    $('.select-availability').hide();
    $('.availabilities').hide();
})

$('#selectAnotherAvailability').on('click', function() {
    $('.select-availability').show();
    $('.availabilities').show();
    $('#bookingForm').hide();
})

</script>
@endpush