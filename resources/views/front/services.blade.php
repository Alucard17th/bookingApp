@extends('layouts.front')
@push('styles')
<style>
.card-img-top {
    object-fit: cover;
    height: 200px;
}

.service-card:hover{
    transform: scale(1.005);
    transition: 0.2s;
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.12), 0 4px 8px rgba(0, 0, 0, 0.06);

}
</style>
@endpush

@section('content')
<section class="pricing position-relative overflow-hidden" id="pricing">
    <div class="container position-relative">
        <div class="row">
            <div class="col-md-4 col-lg-3 mb-4 mb-md-0">
                <div class="card shadow-lg border-0">
                    <div class="card-header border-0 d-flex justify-content-between align-items-center p-4">
                        <h5 class="card-title mb-0">Filter Services</h5>
                        <button class="btn btn-sm btn-light collapsed" data-bs-toggle="collapse"
                            data-bs-target="#filterCollapse">-
                            <i class="fas fa-filter"></i>
                        </button>
                    </div>
                    <div class="collapse show border-0" id="filterCollapse">
                        <div class="card-body p-4">
                            @if(request('locationFilter') || request('durationFilter') || request('costFilterMin') || request('costFilterMax'))
                            <div class="row mb-3">
                                <div class="col-12">
                                    <a href="{{ route('front.services') }}" class="btn-light">
                                        X Reset Filters
                                    </a>
                                </div>
                            </div>
                            @endif
                            <form id="filterForm" action="{{ route('front.services.search') }}" method="GET">
                                <div class="mb-3">
                                    <label for="locationFilter" class="form-label fs-8">Location</label>
                                    <select class="form-select" id="locationFilter" name="locationFilter">
                                        <option value="">All Locations</option>
                                        <option value="remote" @if (request('locationFilter') == 'remote') selected @endif>Remote</option>
                                        <option value="in-person" @if (request('locationFilter') == 'in-person') selected @endif>In-Person</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="durationFilter" class="form-label fs-8">Duration (Minutes)</label>
                                    <input type="number" class="form-control" 
                                    id="durationFilter" min="0" name="durationFilter"
                                    value="{{ request('durationFilter') }}">
                                </div>
                                <div class="mb-3">
                                    <label for="costFilter" class="form-label fs-8">Cost Range</label>
                                    <div class="row">
                                        <div class="col">
                                            <input type="number" class="form-control" id="costFilterMin"
                                                placeholder="Min" name="costFilterMin" value="{{ request('costFilterMin') }}">
                                        </div>
                                        <div class="col">
                                            <input type="number" class="form-control" id="costFilterMax"
                                                placeholder="Max" name="costFilterMax" value="{{ request('costFilterMax') }}">
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">Apply Filters</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-8 col-lg-9">
                <div class="row row-cols-1 row-cols-md-2 g-4">
                    @foreach ($services as $service)
                    <div class="col">
                        <div class="card shadow-lg border-0 h-100 service-card p-0">
                            <!-- <img src="{{$service->getImagePathAttribute() }}" class="card-img-top" alt="{{ $service->name }}"> -->
                            <div class="card-body p-4">
                                <h5 class="card-title d-flex align-items-center mb-4">
                                    <img class="img-fluid rounded me-2" style="width: 75px; height: 75px;"
                                    src="{{$service->user->logo != null ? asset('storage/'.$service->user->logo) : 'https://archive.org/download/placeholder-image/placeholder-image.jpg' }}" alt="" />
                                    {{ $service->name }}
                                </h5>
                                <p class="card-text">{{ Illuminate\Support\Str::limit($service->description, 50) }}</p>
                                <div class="d-flex align-items-center">
                                    <div>
                                        <div class="">
                                            <span class="badge mb-1 text-black fw-bolder" style="background-color: #1642b93d">
                                                Cost: ${{ $service->cost }}
                                            </span>
                                        </div>
                                        <span class="badge bg-primary me-1 mb-1">
                                            <i class="fas fa-clock"></i> {{ $service->duration }} minutes
                                        </span>
                                        
                                        @if ($service->location === 'remote')
                                        <span class="badge bg-warning">
                                            <i class="fas fa-globe"></i> Remote
                                        </span>
                                        @else
                                        <span class="badge bg-secondary">
                                            <i class="fas fa-map-marker-alt"></i> {{ ucfirst($service->location) }}
                                        </span>
                                        @endif
                                    </div>
                                    <a href="{{ route('front.service.single', $service->id) }}" class="btn bk-bg-blue text-white w-75">View Details</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    <div class="row mt-5 w-100">
                        <div class="col d-flex justify-content-end">
                            {{ $services->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection