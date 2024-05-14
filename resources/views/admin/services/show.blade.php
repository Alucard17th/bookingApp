@extends('layouts.app')

@push('styles')
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
                    <img src="{{$service->getImagePathAttribute()}}" alt="Service Image"
                        class="img-fluid rounded d-block service-image">
                    @else
                    <p>No image available</p>
                    @endif
                </div>
            </div>

            <hr>

            <div class="row mt-3">
                <div class="col-12">
                    <p class="card-text"><strong>Appointments:</strong></p>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Date</th>
                                    <th>Time</th>
                                    <th>Service</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($service->appointments as $appointment)
                                <tr>
                                    <td>{{ $appointment->id }}</td>
                                    <td>{{ $appointment->name }}</td>
                                    <td>{{ $appointment->email }}</td>
                                    <td>{{ $appointment->phone }}</td>
                                    <td>{{ $appointment->date }}</td>
                                    <td>{{ $appointment->time }}</td>
                                    <td>{{ $appointment->service->name }}</td>
                                    <td>
                                        <a href="{{ route('appointments.show', $appointment->id) }}"
                                            class="btn btn-primary btn-sm"><i class="fas fa-eye"></i></a>
                                        <a href="{{ route('appointments.edit', $appointment->id) }}"
                                            class="btn btn-info btn-sm"><i class="fas fa-edit"></i></a>
                                        <form action="{{ route('appointments.destroy', $appointment->id) }}"
                                            method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm"
                                                onclick="return confirm('Are you sure you want to delete this appointment?')"><i
                                                    class="fas fa-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Date</th>
                                    <th>Time</th>
                                    <th>Service</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
@endpush