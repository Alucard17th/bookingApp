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
        <!-- EVENT -->
        <div class="col-3">
            <div class="card">
                <div class="card-header">Event Details</div>
                <div class="card-body">
                    <table class="table table-borderless">
                        <tbody>
                            <tr>
                                <td><h5 class="fw-bold text-uppercase">{{ ucfirst($event->name) }}</h5></td>
                            </tr>
                            <tr>
                                <td>Location:</td>
                                <td><span class="fw-bold">{{ ucfirst($event->location) }}</span></td>
                            </tr>
                            <tr>
                                <td>Date:</td>
                                <td><span class="fw-bold">{{ $event->date }}</span></td>
                            </tr>
                            @if($event->time != '00:00:00')
                            <tr>
                                <td>Time:</td>
                                <td><span class="fw-bold">{{ $event->time }}</span></td>
                            </tr>
                            @endif
                            <tr>
                                <td>Cost:</td>
                                <td><span class="fw-bold">{{ $event->cost }} <span class="text-muted">$</span></span></td>
                            </tr>
                            <tr>
                                <td>Phone:</td>
                                <td><span class="fw-bold">{{ $user->phone }}</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- CALENDAR -->
        <div class="col-6">
            <div class="constructions text-small mb-3">
                <div class="alert" role="alert">
                    Please select or click on a day to book.
                </div>
            </div>
            <div class="calender"></div>
        </div>
        <!-- BOOKING FORM -->
        <div class="col-3">
            @if($event->user->canBeBooked())
                @if($event->status == 'active')
                    @if($event->bookings->count() <= $event->max_participants)
                    <div class="booking-info">
                        <div class="box"></div>
                        <div class="availabilities mt-3"></div>
                        <div class="select-availability my-3"  style="display: none">
                            <button type="button" class="btn btn-primary">Select Availability</button>
                        </div>

                        <form method="POST" id="bookingForm" action="{{ route('front.event.booking.store') }}" style="display: none">
                            @csrf
                            <input type="hidden" name="event_id" id="event_id" value="{{ $event->id }}">
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
                            <p class="text-center">Unfortunately, all available spots for this event have been filled. Please check back later for updates or explore our other events.</p>
                        </div>
                    </div>
                    @endif
                @else
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-center">
                            <i class="fas fa-sad-tear fa-5x bk-custom-orange"></i>
                        </div>
                        <h4 class="text-center mt-3">We're Sorry!</h4>
                        <p class="text-center">Unfortunately, this event has been cancelled. Please check back later for updates or explore our other events.</p>
                    </div>
                </div>
                @endif
            @else 
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-center">
                        <i class="fas fa-sad-tear fa-5x bk-custom-orange"></i>
                    </div>
                    <h4 class="text-center mt-3">We're Sorry!</h4>
                    <p class="text-center">Unfortunately, this event owner can not receive bookings. Please check back later for updates.</p>
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
            date: moment('{{ $event->date }}'),
            minDate: moment('{{ $event->date }}'),
            maxDate: moment('{{ $event->date }}'),
            select: function(date, obj) {
                if(date[0] != null) {
                    $('.box').text('You selected ' +
                    (date[0] === null ? ' ' : date[0].format('MM-DD-YYYY')) +
                    '.');
                    $('#date').val(date[0].format('YYYY-MM-DD'));
                    $('#bookingForm').show();
                }else{
                    $('.box').text('');
                    $('#date').val('');
                    $('#bookingForm').hide();
                }
            }
        });
    });
});
</script>
@endpush