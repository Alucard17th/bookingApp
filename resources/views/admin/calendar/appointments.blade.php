@extends('layouts.app')

@push('styles')
<style>
    .fc-daygrid-day-events, .fc-daygrid-event-harness{
        cursor: pointer;
    }
    .modal{
        z-index: 99999;
    }

    .fc .fc-col-header-cell-cushion{
        color: #1642b9 !important;
        text-decoration: none !important;
    }
    .fc-direction-ltr .fc-daygrid-event.fc-event-end, .fc-direction-rtl .fc-daygrid-event.fc-event-start{
        border-radius: 0 0.5rem 0.5rem 0;
        color: #1642b9 !important;
        background-color: #e7f6fd !important;
        margin-bottom: 3px;
        border: 1px solid #dee2e6;
    }
    .fc .fc-daygrid-day-number{
        color: #000 !important;
        text-decoration: none !important;
    }
    .fc-theme-standard td, .fc-theme-standard th {
        border: 1px solid #dee2e6;
    }
</style>
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

    <div class="modal" tabindex="-1" id="eventModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Appointment</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table>
                        <tr>
                            <td class="fw-bold pe-5 pb-4">Service:</td>
                            <td id="service-name" class="pb-4"></td>
                        </tr>
                        <tr>
                            <td class="fw-bold pe-5 pb-4">Name:</td>
                            <td id="appointment-name" class="pb-4"></td>
                        </tr>
                        <tr>
                            <td class="fw-bold pe-5 pb-4">Email:</td>
                            <td id="appointment-email" class="pb-4"></td>
                        </tr>
                        <tr>
                            <td class="fw-bold pe-5 pb-4">Phone:</td>
                            <td id="appointment-phone" class="pb-4"></td>
                        </tr>
                        <tr>
                            <td class="fw-bold pe-5 pb-4">Time:</td>
                            <td id="appointment-time" class="pb-4"></td>
                        </tr>
                        <tr>
                            <td class="fw-bold pe-5 pb-4">Date:</td>
                            <td id="appointment-date" class="pb-4"></td>
                        </tr>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
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
                        appointment
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
        weekNumbers: false,
        dayMaxEvents: true,
        initialView: 'dayGridMonth',
        initialDate: today,
        events: appointments,
        eventClick: function(info) {
            console.log(info.event.extendedProps.appointment);
            let options = {
                backdrop: 'static',
                keyboard: false,
                focus: false
            }
            var myModal = new bootstrap.Modal(document.getElementById('eventModal'), options)
            $("#service-name").text(info.event.extendedProps.appointment.service_name);
            $("#appointment-name").text(info.event.extendedProps.appointment.name);
            $("#appointment-email").text(info.event.extendedProps.appointment.email);
            $("#appointment-phone").text(info.event.extendedProps.appointment.phone);
            $("#appointment-time").text(info.event.extendedProps.appointment.time);
            $("#appointment-date").text(info.event.extendedProps.appointment.date);
            $('#fc-dom-9 > div.fc-popover-header > span.fc-popover-close.fc-icon.fc-icon-x').click()
            myModal.show()
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