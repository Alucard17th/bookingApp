@extends('layouts.app')

@push('styles')
<style>
    .attendees {
        overflow-y: auto;
        padding: 10px;
        border-radius: 5px;
    }

    .event-image{
        height: 200px !important;
    }
</style>

@endpush

@section('content')
<div class="container">
    <div class="row mb-3">
        <!-- ADD RETURTN BUTTON -->
        <a href="{{ route('events.index') }}" class="">Back to Events</a>
    </div>
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">{{ $event->name }}</h5>
        </div>

        <div class="card-body">
            <div class="row">
                <div class="col-6">
                    <p class="card-text"><strong>Description:</strong> {{ $event->description }}</p>
                    <p class="card-text"><strong>Date:</strong> {{ $event->date }}</p>
                    <p class="card-text"><strong>Time:</strong> {{ $event->time }}</p>
                    <p class="card-text"><strong>Location:</strong> {{ $event->location }}</p>
                    <p class="card-text"><strong>Status:</strong> {{ $event->status }}</p>
                    <p class="card-text"><strong>Cost:</strong> {{ $event->cost }}</p>
                    <p class="card-text"><strong>Max Participants:</strong> {{ $event->max_participants ? $event->max_participants : 'Unlimited' }}</p>
                    <p class="card-text"><strong>Participants:</strong> {{ $event->bookings->count() }} / {{ $event->max_participants }}</p>
                </div>

                <div class="col-6">
                    @if($event->image)
                    <img src="{{$event->getImagePathAttribute()}}" alt="Event Image" class="img-fluid rounded d-block event-image">
                    @else
                    <p>No image available</p>
                    @endif
                </div>
            </div>

            <hr>

            <div class="row mt-3 attendees">
                <div class="col-12">
                    <p class="card-text"><strong>Attendees:</strong></p>
                    <ul class="list-unstyled">
                        @foreach($event->bookings as $attendee)
                        <li>
                            {{$attendee->name}} : 
                            <span class="badge bg-warning text-dark"><i class="fa fa-envelope me-2"></i>{{$attendee->email}}</span>
                            <span class="badge bg-warning text-dark"><i class="fa fa-phone me-2"></i>{{$attendee->phone}}</span>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
@endpush