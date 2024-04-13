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
            <a href="#" class="me-3" id="back-button" style="display: none" role="button"><i class="fas fa-arrow-left"></i></a>
            New Event
        </div>


        <div class="card-body" id="event-form-container">
            <form method="POST" action="{{ route('events.store') }}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="event_type" value="event">
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" name="name" required>
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
                            <input type="date" class="form-control" id="date" name="date" required>
                            @error('date')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $date }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-6 mt-3">
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="3"
                                required></textarea>
                            @error('description')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $description }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-6 mt-3">
                        <div class="form-group">
                            <label for="time">Time</label>
                            <input type="time" class="form-control" id="time" name="time">
                            @error('time')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $time }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="form-group">
                            <label for="location">Location</label>
                            <input type="text" class="form-control" id="location" name="location" required>
                            @error('location')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $location }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="form-group">
                            <label for="cost">Cost</label>
                            <input type="number" class="form-control" id="cost" name="cost" required>
                            @error('cost')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $cost }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="form-group">
                            <label for="max_participants">Max Participants</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="is_limited" id="is_limited1" onclick="toggleMaxParticipantsInput(false)" checked>
                                <label class="form-check-label" for="is_limited1">
                                    Unlimited places
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="is_limited" id="is_limited2" onclick="toggleMaxParticipantsInput(true)">
                                <label class="form-check-label" for="is_limited2">
                                    Limited places
                                </label>
                            </div>
                        </div>

                        <div class="form-group" id="max_participants_input" style="display: none">
                            <label for="max_participants">Max Participants</label>
                            <input type="number" class="form-control" id="max_participants" name="max_participants">
                            @error('max_participants')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $max_participants }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="form-group">
                            <label for="image">Image</label>
                            <input type="file" class="form-control-file" id="image" name="image" accept="image/*">
                            @error('image')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6 mt-3">
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Create</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    function toggleMaxParticipantsInput(showInput) {
        if (showInput) {
            document.getElementById('max_participants_input').style.display = 'block';
        } else {
            document.getElementById('max_participants_input').style.display = 'none';
        }
    }
</script>
@endpush