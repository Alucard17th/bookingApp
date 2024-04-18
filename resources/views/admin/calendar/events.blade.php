@extends('layouts.app')

@push('styles')
@endpush

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h5 class="card-title">Appointments</h5>
                    </div>
                </div>
                <div class="card-body">
                    <div class="calendar" id="calendar"></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.9/index.global.min.js'></script>
<script>
document.addEventListener('DOMContentLoaded', async function() {
    var today = new Date(); // Get current date
    var calendarEl = document.getElementById('calendar');

    let events = [];
    // fetch events from a laravel route using ajax
    await $.ajax({
        url: "{{ route('user.events.json') }}",
        type: 'GET',
        dataType: 'json',
        success: function(data) {
            console.log('Bookings fetched successfully', data);
            data.forEach(function(event) {
                events.push({
                    title: event.name,
                    start: event.date,
                    backgroundColor: '#e7f6fd',
                    borderColor: '#e7f6fd',
                    textColor: '#0369A1',
                    extendedProps: {
                        description: 'Type : '
                    }
                });
            })
        },
        error: function() {
            console.log('Error fetching events');
        }
    })


    var calendar = new FullCalendar.Calendar(calendarEl, {
        height: '860px',
        width: '100%',
        // slotMinTime: "06:00:00",
        // slotMaxTime: "19:00:00",
        initialView: 'dayGridMonth',
        initialDate: today,
        headerToolbar: {
            left: 'today',
            right: 'title,prev,next',
            center: 'timeGridDay,timeGridWeek,dayGridMonth'
        },
        events: events,
        eventClick: function(info) {
            // alert('Event: ' + info.event.title);
            // alert('Coordinates: ' + info.jsEvent.pageX + '<br>' + info.jsEvent.pageY);
            // alert('View: ' + info.view.type);
        },
        eventMouseEnter: async function(info) {

        },
        eventMouseLeave: function(info) {
            $(this).css('z-index', 8);
            $('#custom-tooltip').remove();
        },
        titleFormat: {
            year: 'numeric',
            month: 'long',
            day: 'numeric'
        },
        slotLabelFormat: {
            hour: 'numeric',
            minute: '2-digit',
            omitZeroMinute: false,
            hour12: false // Change to true if you want 12-hour format
        }
    });

    calendar.render();
})
</script>
@endpush