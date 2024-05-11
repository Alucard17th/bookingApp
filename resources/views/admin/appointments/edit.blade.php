@extends('layouts.app')

@push('styles')
@endpush

@section('content')
<div class="container">
    <div class="row mb-3">
        <!-- ADD RETURTN BUTTON -->
        <a href="{{ route('appointments.index') }}" class="">Back to Appointments</a>
    </div>
    <div class="card">
        <div class="card-header">
            Edit Appointment
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route('appointments.update', $appointment->id) }}">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" name="name"
                                value="{{ $appointment->name }}" required>
                        </div>

                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email"
                                value="{{ $appointment->email }}" required>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="phone">Phone</label>
                            <input type="text" class="form-control" id="phone" name="phone"
                                value="{{ $appointment->phone }}" required>
                        </div>
                    </div>

                    <div class="col-3">
                        <div class="form-group">
                            <label for="date">Date</label>
                            <input type="date" class="form-control" id="date" name="date"
                                value="{{ $appointment->date }}" required>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label for="time">Time</label>
                            <input type="time" class="form-control" id="time" name="time"
                                value="{{ explode(' - ', $appointment->time)[0] }}" >
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="form-group">
                            <label for="date">Event</label>
                            <input type="hidden" class="form-control" name="service_id"
                                value="{{ $appointment->service->id }}" readonly>
                            <input type="text" class="form-control" name="service_name"
                                value="{{ $appointment->service->name }}" readonly>
                        </div>
                    </div>

                    <div class="col-6 d-flex align-items-end">
                        <div class="form-group">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" name="status"
                                @if($appointment->status == 'active' ) checked @endif>
                                <label class="form-check-label" for="flexSwitchCheckChecked">Active</label>
                            </div>
                        </div>
                    </div>

                </div>

                <button type="submit" class="btn btn-primary mt-3">Update</button>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
@endpush