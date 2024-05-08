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
            New Appointment
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route('appointments.store') }}">
                @csrf

                <div class="row">

                    <div class="col-6">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="form-group">
                            <label for="phone">Phone</label>
                            <input type="text" class="form-control" id="phone" name="phone" required>
                        </div>
                    </div>

                    <div class="col-6"></div>

                    <div class="col-6">
                        <div class="form-group">
                            <label for="time">Event</label>
                            <select name="service_id" id="service" class="form-select">
                                @foreach($services as $service)
                                <option value="{{ $service->id }}">{{ $service->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-3">
                        <div class="form-group">
                            <label for="date">Date</label>
                            <input type="date" class="form-control" id="date" name="date" required>
                        </div>
                    </div>

                    <div class="col-3">

                        <div class="form-group">
                            <label for="time">Time</label>
                            <input type="time" class="form-control" id="time" name="time" required>
                        </div>
                    </div>

                </div>

                <button type="submit" class="btn btn-primary mt-3">Create</button>
            </form>

        </div>
    </div>


</div>


@endsection

@push('scripts')
@endpush