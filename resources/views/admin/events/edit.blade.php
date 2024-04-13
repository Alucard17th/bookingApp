@extends('layouts.app')

@push('styles')
@endpush

@section('content')
<div class="container">
    <div class="row mb-3">
        <!-- ADD RETURTN BUTTON -->
        <a href="{{ route('events.index') }}" class="">Back to Events</a>
    </div>
    <div class="card">
        <div class="card-header">
            New Event
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route('events.update', $event->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ $event->name }}"
                                required>
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $name }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="form-group">
                            <label for="date">Date</label>
                            <input type="date" class="form-control" id="date" name="date" value="{{ $event->date }}"
                                required>
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="3"
                                required>{{ $event->description }}</textarea>
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="form-group">
                            <label for="time">Time</label>
                            <input type="time" class="form-control" id="time" name="time" value="{{ $event->time }}">
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="form-group">
                            <label for="location">Location</label>
                            <input type="text" class="form-control" id="location" name="location"
                                value="{{ $event->location }}" required>
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="form-group">
                            <label for="cost">Cost</label>
                            <input type="text" class="form-control" id="cost" name="cost" value="{{ $event->cost }}">
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="form-group">
                            <label for="image">Image</label>
                            <input type="file" class="form-control-file" id="image" name="image" accept="image/*">
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select class="form-select" id="status" name="status" required>
                                <option value="active" {{ $event->status == 'active' ? 'selected' : '' }}>Active
                                </option>
                                <option value="inactive" {{ $event->status == 'inactive' ? 'selected' : '' }}>Inactive
                                </option>
                            </select>
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="form-group" id="max_participants_input">
                            <label for="max_participants">Max Participants</label>
                            <input type="number" class="form-control" id="max_participants" name="max_participants" value="{{ $event->max_participants }}">
                            @error('max_participants')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $max_participants }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary float-start">Update</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
@endpush