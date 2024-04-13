@extends('layouts.app')

@push('styles')
@endpush

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between">
                <h5 class="card-title">Services</h5>
                <a href="{{ route('services.create') }}" class="btn add-btn">
                    <i class="fa fa-plus"></i> Add Service
                </a>
            </div>
        </div>

        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Duration</th>
                        <th>Cost</th>
                        <th>Location</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($services as $service)
                    <tr>
                        <td>{{ $service->id }}</td>
                        <td>{{ $service->name }}</td>
                        <td>{{ \Illuminate\Support\Str::limit($service->description,20) }}</td>
                        <td>{{ $service->duration }} min</td>
                        <td>{{ $service->cost }} $</td>
                        <td>{{ ucfirst($service->location) }}</td>
                        <td>
                            <a href="{{ route('services.show', $service->id) }}" class="btn btn-primary btn-sm"><i class="fas fa-eye"></i></a>
                            <a href="{{ route('services.edit', $service->id) }}" class="btn btn-info btn-sm"><i class="fas fa-edit"></i></a>
                            <form action="{{ route('services.destroy', $service->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this service?')"><i class="fas fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@push('scripts')
@endpush
