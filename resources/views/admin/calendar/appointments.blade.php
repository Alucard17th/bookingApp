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

    let appointments = [];
    // fetch events from a laravel route using ajax
    await $.ajax({
        url: "{{ route('user.appointments.json') }}",
        type: 'GET',
        dataType: 'json',
        success: function(data) {
            console.log('Appointments fetched successfully', data);
            data.forEach(function(appointment) {
                var timeRange = appointment.time;
                var parts = timeRange.split(" - ");
                var startTime = parts[0];
                appointments.push({
                    title: 'Appointment',
                    start: appointment.date + 'T' + startTime,
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
            console.log('Error fetching appointments');
        }
    })


    var calendar = new FullCalendar.Calendar(calendarEl, {
        height: '860px',
        width: '100%',
        timeZone: 'UTC',
        themeSystem: 'bootstrap5',
        // slotMinTime: "06:00:00",
        // slotMaxTime: "19:00:00",
        headerToolbar: {
            right: 'prev,next today',
            center: 'title',
            left: 'dayGridMonth,timeGridWeek,timeGridDay,listMonth'
        },
        weekNumbers: true,
        dayMaxEvents: true,
        initialView: 'dayGridMonth',
        initialDate: today,
        events: appointments,
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