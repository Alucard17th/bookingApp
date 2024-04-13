@extends('layouts.app')

@push('styles')
@endpush

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between">
                <h5 class="card-title">Events</h5>
                <a href="{{ route('events.create') }}" class="btn add-btn">
                    <i class="fa fa-plus"></i>    
                Add Event</a>
            </div>
        </div>

        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Location</th>
                        <th>Attendees</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($events as $event)
                    <tr>
                        <td>{{ $event->name }}</td>
                        <td>{{ $event->description }}</td>
                        <td>{{ $event->date }}</td>
                        <td>{{ $event->time }}</td>
                        <td>{{ $event->location }}</td>
                        <td>{{ $event->bookings->count() }}</td>
                        <td>
                            <span class="badge bg-{{ $event->status == 'active' ? 'success' : 'danger' }}">{{ ucfirst($event->status) }}</span>
                        </td>
                        <td>
                            <a href="{{ route('events.show', $event->id) }}" class="btn btn-primary btn-sm"><i class="fas fa-eye"></i></a>
                            <a href="{{ route('events.edit', $event->id) }}" class="btn btn-info btn-sm"><i class="fas fa-edit"></i></a>
                            <form action="{{ route('events.destroy', $event->id) }}" method="POST"
                                style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('Are you sure you want to delete this event?')"><i class="fas fa-trash"></i></button>
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