@extends('layouts.app')

@push('styles')
@endpush

@section('content')
<div class="container">
    <div class="row mb-3">
        <!-- ADD RETURTN BUTTON -->
        <a href="{{ route('bookings.index') }}" class="">Back to Bookings</a>
    </div>
    <div class="card">
        <div class="card-header">
            Booking Details
        </div>
        <div class="card-body">
            <p><strong>Name:</strong> {{ $booking->name }}</p>
            <p><strong>Email:</strong> {{ $booking->email }}</p>
            <p><strong>Phone:</strong> {{ $booking->phone }}</p>
            <p><strong>Date:</strong> {{ $booking->date }}</p>
            <p><strong>Time:</strong> {{ $booking->time }}</p>
            <p><strong>Event:</strong> {{ $booking->event->name }}</p>
        </div>
    </div>
</div>
@endsection

@push('scripts')
@endpush