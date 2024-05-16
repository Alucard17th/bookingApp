@extends('layouts.booking')

@push('styles')
@endpush

@section('content')
<div class="container-fluid px-5 py-5">
    <div class="row d-flex justify-content-center text-center">
        <div class="col-8">
            <div class="card">
                <div class="card-body">
                    <div class="header">
                        <h3>Your Appointment Details</h3>
                    </div>

                    <ul class="list-group">
                        @if (isset($appointment) && !empty($appointment))
                        <li class="list-group-item">
                            <span class="fw-bold">Date:</span> {{ $appointment->date }}
                        </li>
                        <li class="list-group-item">
                            <span class="fw-bold">Time:</span> {{ $appointment->time }}
                        </li>
                        <li class="list-group-item">
                            <ul class="list-unstyled">
                                <li><span class="fw-bold">Service:</span> {{ $appointment->service->name }}</li>
                                <li><span class="fw-bold">Provider:</span> {{ $appointment->service->user->name }}</li>
                            </ul>
                        </li>
                        @else
                        <p>No appointment data found.</p>
                        @endif
                    </ul>

                    @if (isset($appointment) && !empty($appointment) && $appointment->status != 'cancelled')
                    <form method="POST" action="{{ route('front.appointment.cancel') }}" class="mt-3">
                        @csrf
                        <input type="hidden" name="appointment_id" value="{{ $appointment->id }}">
                        <button type="submit" class="btn btn-danger"
                            onclick="return confirm('Are you sure you want to cancel this appointment?')">Cancel
                            Appointment</button>
                    </form>
                    @else
                    <p class="mt-3 mb-0 pb-0" style="color: #EE7B11;">Your appointment has been cancelled successfully.</p>
                    <div class="cta d-flex align-items-baseline justify-content-center">
                        <div class="finger me-2">
                            👉
                        </div>
                        <a 
                        href="{{ route('front.single.service.new.book', ['serviceId' => $appointment->service_id, 'id' => $appointment->service->user->id]) }}" 
                        type="submit" class="btn bk-bg-blue mt-3 text-white">Schedule New Appointment</a>
                    </div>
                       
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
@endpush