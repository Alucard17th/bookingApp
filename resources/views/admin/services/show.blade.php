@extends('layouts.app')

@push('styles')
<style>
    .availabilities {
        overflow-y: auto;
        padding: 10px;
        border-radius: 5px;
    }

    .service-image{
        height: 200px !important;
    }
</style>

@endpush

@section('content')
<div class="container">
    <div class="row mb-3">
        <!-- ADD RETURTN BUTTON -->
        <a href="{{ route('services.index') }}" class="">Back to Services</a>
    </div>
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">{{ $service->name }}</h5>
        </div>

        <div class="card-body">
            <div class="row">
                <div class="col-6">
                    <p class="card-text"><strong>Description:</strong> {{ $service->description }}</p>
                    <p class="card-text"><strong>Duration:</strong> {{ $service->duration }}</p>
                    <p class="card-text"><strong>Buffer Time:</strong> {{ $service->buffer_time }}</p>
                    <p class="card-text"><strong>Cost:</strong> {{ $service->cost }}</p>
                    <p class="card-text"><strong>Location:</strong> {{ $service->location }}</p>
                    <p class="card-text"><strong>Status:</strong> {{ $service->is_active ? 'Active' : 'Inactive' }}</p>
                </div>

                <div class="col-6">
                    @if($service->image)
                    <img src="{{$service->getImagePathAttribute()}}" alt="Service Image" class="img-fluid rounded d-block service-image">
                    @else
                    <p>No image available</p>
                    @endif
                </div>
            </div>

            <hr>

            <!-- <div class="row mt-3 availabilities">
                <div class="col-12">
                    <p class="card-text"><strong>Availabilities:</strong></p>
                    <ul class="list-unstyled">
                        @foreach($service->availabilities as $availabilitie)
                        <li>{{$availabilitie->start_at}} - {{$availabilitie->end_at}}</li>
                        @endforeach
                    </ul>
                </div>
            </div> -->

            <div class="row mt-3 availabilities">
                <div class="col-12">
                    <p class="card-text"><strong>Appointments:</strong></p>
                    <ul class="list-unstyled">
                        @foreach($service->appointments as $appointment)
                        <li class="mb-2">{{$appointment->name}} : 
                            <span class="badge bg-warning text-dark"><i class="fa fa-clock me-2"></i>{{$appointment->date}} | {{$appointment->time}}</span>

                            
                            <span class="badge bg-warning text-dark"><i class="fa fa-envelope me-2"></i>{{$appointment->email}}</span>
                            <span class="badge bg-warning text-dark"><i class="fa fa-phone me-2"></i>{{$appointment->phone}}</span>
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