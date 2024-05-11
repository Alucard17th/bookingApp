@extends('layouts.app')

@push('styles')
<style>
.card-border-dark-blue {
    border-bottom: 5px solid #1642b9 !important;
}

.number-dark-blue {
    margin-bottom: 1.3rem;
    font-size: 24px;
    font-weight: 600;
    color: #1642b9;
}

.card-border-orange {
    border-bottom: 5px solid #EE7B11 !important;
}

.number-orange {
    margin-bottom: 1.3rem;
    font-size: 24px;
    font-weight: 600;
    color: #EE7B11;
}

.card-border-blue {
    border-bottom: 5px solid #92ACF2 !important;
}

.number-blue {
    margin-bottom: 1.3rem;
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
                    <h5 class="card-title p-3">{{ __('Dashboard') }}</h5>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    <div class="row">
                        <div class="col-6">
                            <div class="card card-border-dark-blue">
                                <div class="card-body">
                                    <div class="number-dark-blue">{{ $totalServicesCount }}</div>
                                    <h3>{{ __('Services') }}</h3>
                                </div>
                            </div>
                        </div>

                        <div class="col-6">
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
                            <div class="card card-border-orange">
                                <div class="card-title h5 p-3">{{ __('Appointments') }}</div>
                                <div class="card-body">
                                    <div id="appointment-status-chart"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">

                            <div class="card card-border-dark-blue">
                                <div class="card-title h5 px-3 pt-3">{{ __('Last Appointments') }}</div>
                                <div class="card-body">
                                    <table class="bk-table">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Date</th>
                                                <th>Service</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($lastAppointments as $appointment)
                                            <tr class="align-middle">
                                                <td>{{ $appointment->name }}</td>
                                                <td>{{ $appointment->date }} - {{ $appointment->time }}</td>
                                                <td>{{ $appointment->service->name }}</td>
                                                <td class="d-flex flex-column align-items-center">
                                                    <a href="{{ route('appointments.show', $appointment->id) }}"
                                                        class="btn btn-primary btn-sm"><i class="fas fa-eye"></i></a>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-5">
                        <div class="col-12">
                            <div class="card-title h5">{{ __('Last Added Services') }}</div>
                            <div class="card card-border-orange">
                                <div class="card-body">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Name</th>
                                                <th>Description</th>
                                                <th>Duration</th>
                                                <th>Cost</th>
                                                <th>Location</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach(auth()->user()->services->take(5) as $service)
                                            <tr>
                                                <td>{{ $service->id }}</td>
                                                <td>{{ $service->name }}</td>
                                                <td>{{ \Illuminate\Support\Str::limit($service->description,20) }}</td>
                                                <td>{{ $service->duration }} min</td>
                                                <td>{{ $service->cost }} $</td>
                                                <td>{{ ucfirst($service->location) }}</td>
                                                <td class="d-flex flex-column align-items-center">
                                                    <a href="{{ route('services.show', $service->id) }}"
                                                        class="btn btn-primary btn-sm"><i class="fas fa-eye"></i></a>
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
document.addEventListener('DOMContentLoaded', function() {
    var serviceOptions = @json($serviceOptions);
    var chartService = new ApexCharts(document.querySelector("#service-chart"), serviceOptions);
    chartService.render();

    var optionsAppointments = @json($optionsAppointments);
    var chartAppointment = new ApexCharts(document.querySelector("#appointment-chart"), optionsAppointments);
    chartAppointment.render();

    var optionsAppointmentsStatus = @json($appointmentsByStatus);
    var chartAppointmentStatus = new ApexCharts(document.querySelector("#appointment-status-chart"),
        optionsAppointmentsStatus);
    chartAppointmentStatus.render();
})
</script>
@endpush