@extends('layouts.front')
@push('styles')
<style>
    .service-image {
        height: 75vh;
        margin-bottom: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
    }
    .description{
        line-height: 30px;
    }
</style>
@endpush

@section('content')
<section class="services position-relative overflow-hidden">
    <div class="container">
        <div class="row">
            <div class="col-md-6 mb-4 mb-md-0 text-center">
                <img src="{{$service->getImagePathAttribute() }}" class="img-fluid rounded-start shadow-sm service-image"
                    alt="{{ $service->name }}">
            </div>
            <div class="col-md-6">
                <h1 class="h2">{{ $service->name }}</h1>

                <a class="btn btn-warning btn-hover-secondery mb-3" href="{{ url('/') }}/service-booking-single/{{ $service->id }}/{{ $service->user->id }}">Book Now</a>

                <p class="lead mb-1 fs-9 description">Provider: <span class="fw-bold">{{ $service->user->name }}</span></p>

                <div class="d-flex align-items-center mb-3">
                    <div class="badge me-1 text-black fw-bolder" style="background-color: #1642b93d">
                        Cost: ${{ $service->cost }}
                    </div>
                    <div class="badge bg-primary me-1">
                        <i class="fas fa-clock"></i> {{ $service->duration }} minutes
                    </div>
                    @if ($service->location === 'remote')
                    <span class="badge bg-warning">
                        <i class="fas fa-globe"></i> Remote
                    </span>
                    @endif
                </div>
                <p class="lead mb-3 fs-7 description">{{ $service->description }}</p>
            </div>
        </div>
    </div>

</section>

@endsection