@extends('layouts.app')

@push('styles')
<style>
.card-border-dark-blue {
    border-bottom: 5px solid #1642b9 !important;
}
.number-dark-blue{
    margin-bottom:1.3rem;
    font-size: 24px;
    font-weight: 600;
    color: #1642b9;
}

.card-border-orange {
    border-bottom: 5px solid #EE7B11 !important;
}
.number-orange{
    margin-bottom:1.3rem;
    font-size: 24px;
    font-weight: 600;
    color: #EE7B11;
}

.card-border-blue {
    border-bottom: 5px solid #92ACF2 !important;
}
.number-blue{
    margin-bottom:1.3rem;
    font-size: 24px;
    font-weight: 600;
    color: #92ACF2;
}
</style>
@endpush
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card">
                <div class="card-header"><h5 class="card-title">{{ __('Dashboard') }}</h5></div>
               
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="row">
                        <div class="col-3">
                            <div class="card card-border-dark-blue">
                                <div class="card-body">
                                    <div class="number-dark-blue">{{ $totalEventsCount }}</div>
                                    <h3>{{ __('Events') }}</h3>
                                </div>
                            </div>
                        </div>

                        <div class="col-3">
                            <div class="card card-border-dark-blue">
                                <div class="card-body">
                                    <div class="number-dark-blue">{{ $totalServicesCount }}</div>
                                    <h3>{{ __('Services') }}</h3>
                                </div>
                            </div>
                        </div>

                        <div class="col-3">
                            <div class="card card-border-orange">
                                <div class="card-body">
                                    <div class="number-orange">{{$totalBookingsCount}}</div>
                                    <h3>{{ __('Bookings') }}</h3>
                                </div>
                            </div>
                        </div>

                        <div class="col-3">
                            <div class="card card-border-blue">
                                <div class="card-body">
                                    <div class="number-blue ">{{$totalAppointments}}</div>
                                    <h3>{{ __('Appointments') }}</h3>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-5">
                        <div class="col-6">
                            <div class="card-title h5">{{ __('Events') }}</div>
                            <div class="card card-border-orange">
                                <div class="card-body">
                                <div id="event-chart"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="card-title h5">{{ __('Bookings') }}</div>
                            <div class="card card-border-dark-blue">
                                <div class="card-body">
                                <div id="booking-chart"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-5">
                        <div class="col-6">
                            <div class="card-title h5">{{ __('Services') }}</div>
                            <div class="card card-border-orange">
                                <div class="card-body">
                                <div id="service-chart"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="card-title h5">{{ __('Appointments') }}</div>
                            <div class="card card-border-dark-blue">
                                <div class="card-body">
                                <div id="appointment-chart"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-5">
                        <div class="col-6">
                            <div class="card-title h5">{{ __('Coming Events') }}</div>
                            <div class="card card-border-orange">
                                <div class="card-body">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Date</th>
                                                <th>Time</th>
                                                <th>Location</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($userComingEvents as $event)
                                            <tr>
                                                <td>{{ $event->name }}</td>
                                                <td>{{ $event->date }}</td>
                                                <td>{{ $event->time }}</td>
                                                <td>{{ $event->location }}</td>
                                                <td class="d-flex flex-column align-items-center">
                                                    <a href="{{ route('events.show', $event->id) }}" class="btn btn-primary btn-sm mb-1"><i class="fas fa-eye"></i></a>
                                                    <a href="{{ route('events.edit', $event->id) }}" class="btn btn-info btn-sm mb-1"><i class="fas fa-edit"></i></a>
                                                    <form action="{{ route('events.destroy', $event->id) }}" method="POST"
                                                        style="display: inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm"
                                                            onclick="return confirm('Are you sure you want to delete this event?')"><i class="fas fa-trash"></i></button>
                                                    </form>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="card-title h5">{{ __('Last Bookings') }}</div>
                            <div class="card card-border-dark-blue">
                                <div class="card-body">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Phone</th>
                                                <th>Date</th>
                                                <th>Time</th>
                                                <th>Event</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($lastBookings as $booking)
                                            <tr>
                                                <td>{{ $booking->name }}</td>
                                                <td>{{ $booking->phone }}</td>
                                                <td>{{ $booking->date }}</td>
                                                <td>{{ $booking->time }}</td>
                                                <td>{{ $booking->event->name }}</td>
                                                <td class="d-flex flex-column align-items-center">
                                                    <a href="{{ route('bookings.show', $booking->id) }}" class="btn btn-primary btn-sm mb-1"><i class="fas fa-eye"></i></a>
                                                    <a href="{{ route('bookings.edit', $booking->id) }}" class="btn btn-info btn-sm mb-1"><i class="fas fa-edit"></i></a>
                                                    <form action="{{ route('bookings.destroy', $booking->id) }}" method="POST"
                                                        style="display: inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm" 
                                                            onclick="return confirm('Are you sure you want to delete this booking?')"><i class="fas fa-trash"></i></button>
                                                    </form>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

<script>
    // when document is ready using javascript not jquery
document.addEventListener('DOMContentLoaded', function () {
    var options = @json($options);
    var chart = new ApexCharts(document.querySelector("#event-chart"), options);
    chart.render();

    var serviceOptions = @json($serviceOptions);
    var chartService = new ApexCharts(document.querySelector("#service-chart"), serviceOptions);
    chartService.render();

    var optionsBookings = @json($optionsBookings);
    var chartBooking = new ApexCharts(document.querySelector("#booking-chart"), optionsBookings);
    chartBooking.render();

    var optionsAppointments = @json($optionsAppointments);
    var chartBooking = new ApexCharts(document.querySelector("#appointment-chart"), optionsAppointments);
    chartBooking.render();
})
</script>
@endpush
