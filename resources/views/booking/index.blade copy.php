@extends('layouts.app')

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
</style>
@endpush

@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- EVENTS & SERVICES -->
        <div class="col-3">
            <div class="row">
                <div class="col-12">
                    <a href="{{ route('services.show', $service->id) }}">
                        <h5>{{ $service->name }}</h5>
                    </a>
                </div>
                <div class="col-12">
                    {{$service->location}}
                </div>
                <div class="col-6">
                    {{$service->duration}}
                </div>
                <div class="col-6">
                    {{$service->cost}}
                </div>
                <div class="col-6">
                    {{$service->location}}
                </div>
            </div>
        </div>

        <!-- CALENDAR -->
        <div class="col-6">
            <div class="calender"></div>
        </div>

        <!-- BOOKING -->
        <div class="col-3">
            <div class="contact-info">
                <h3>Contact</h3>
                <p>Phone: {{$user->phone}}</p>
            </div>

            <div class="booking-info">
                <div class="box"></div>

                <form method="POST" action="{{ route('bookings.store') }}">
                    @csrf

                    <input type="hidden" name="event_id" id="eventID" value="{{ $event->id }}">

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

                    <div class="form-group d-none">
                        <label for="date">Date</label>
                        <input type="date" class="form-control" id="date" name="date" required>
                    </div>

                    <div class="form-group d-none">
                        <label for="date_start">Date Start</label>
                        <input type="date" class="form-control" id="date_start" name="date_start" required>
                    </div>

                    <div class="form-group d-none">
                        <label for="date_end">Date End</label>
                        <input type="date" class="form-control" id="date_end" name="date_end" required>
                    </div>

                    <div class="form-group mt-3">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>

                </form>

            </div>
        </div>
    </div>

    <div class="calendarx"></div>
</div>
@endsection

@push('scripts')
<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<!-- Import script from public folder scripts -->
<!-- Insert script from laravel resources folder -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.12.0/moment.min.js"></script>

<script src="{{ asset('js/pg-calendar-master/dist/js/pignose.calendar.js') }}"></script>
<!-- <script
    src="https://www.jqueryscript.net/demo/Beautiful-Multifunctional-Calendar-Plugin-For-jQuery-PIGNOSE-Calender/src/js/pignose.calender.js">
</script> -->
<script>
// when the document is ready
$(document).ready(function() {
    let bookings = <?= json_encode($event->bookings) ?>;
    var disabledRanges = [];

    bookings.forEach(function(booking) {
        // Check if both date_start and date_end are not null
        if (booking.date_start && booking.date_end) {
            // Add the disabled date range to the disabledRanges array
            disabledRanges.push([booking.date_start, booking.date_end]);
        } else if (booking.date_start) {
            // If only date_start is provided, disable that specific date
            disabledRanges.push([booking.date_start, booking.date_start]);
        }
    });

    // Check if the disabledDates array is correctly populated
    console.log('Disabled Dates:', disabledRanges);

    $(function() {
        $('.calender').pignoseCalendar({
            multiple: true,
            disabledRanges: disabledRanges,
                // ['2024-03-01', '2024-03-14'], // 2024-03-01 ~ 14
            select: function(date, obj) {
                $('.box').text('You selected ' +
                    (date[0] === null ? ' ' : date[0].format('YYYY-MM-DD')) +
                    ' - ' +
                    (date[1] === null ? ' ' : date[1].format('YYYY-MM-DD')) +
                    '.');
                $('#date').val(date[0].format('YYYY-MM-DD'));
                $('#date_start').val(date[0].format('YYYY-MM-DD'));
                $('#date_end').val(date[1].format('YYYY-MM-DD'));
            }
        });
        // $('.calender').pignoseCalendar({
        //     multiple: true,
        //     disabledRanges: disabledDates,
        //     disabledDates: [
        //         moment('2024-03-01'),
        //         moment('2024-03-04'),
        //         moment('2024-03-12'),
        //     ],
        //     select: function(date, obj) {
        //         $('.box').text('You selected ' +
        //             (date[0] === null ? ' ' : date[0].format('YYYY-MM-DD')) +
        //             ' - ' +
        //             (date[1] === null ? ' ' : date[1].format('YYYY-MM-DD')) +
        //             '.');
        //         $('#date').val(date[0].format('YYYY-MM-DD'));
        //         $('#date_start').val(date[0].format('YYYY-MM-DD'));
        //         $('#date_end').val(date[1].format('YYYY-MM-DD'));
        //     }
        // });

        
    });

  
});


</script>
@endpush