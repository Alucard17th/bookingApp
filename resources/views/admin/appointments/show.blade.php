@extends('layouts.app')

@push('styles')
@endpush

@section('content')
<div class="container">
    <div class="row mb-3">
        <!-- ADD RETURTN BUTTON -->
        <a href="{{ route('appointments.index') }}" class="">Back to Appointment</a>
    </div>
    <div class="card">
        <div class="card-header">
            Appointment Details
        </div>
        <div class="card-body">
            <p><strong>Name:</strong> {{ $appointment->name }}</p>
            <p><strong>Email:</strong> {{ $appointment->email }}</p>
            <p><strong>Phone:</strong> {{ $appointment->phone }}</p>
            <p><strong>Date:</strong> {{ $appointment->date }}</p>
            <p><strong>Time:</strong> {{ $appointment->time }}</p>
            <p><strong>Service:</strong> {{ $appointment->service->name }}</p>
        </div>
    </div>
</div>
@endsection

@push('scripts')
@endpush