@extends('layouts.app')

@push('styles')
<style>
    .day-label {
        cursor: pointer;
        padding: 0.5rem;
        margin-right: 0.5rem;
        border: 1px solid #ccc;
        border-radius: 4px;
        user-select: none;
    }

    .day-label.selected {
        background-color: #007bff;
        color: #fff;
    }
</style>
@endpush

@section('content')
<div class="container">
    <div class="row mb-3">
        <!-- ADD RETURTN BUTTON -->
        <a href="{{ route('services.index') }}" class="">Back to Events</a>
    </div>
    <div class="card">
        <div class="card-header">
            <a href="#" class="me-3" id="back-button" style="display: none" role="button"><i class="fas fa-arrow-left"></i></a>
            New Services
        </div>

        <div class="card-body" id="service-form-container">
            <form method="POST" action="{{ route('services.store') }}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="event_type" value="service">
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="col-6">
                        <div class="form-group">
                            <label for="duration">Duration</label>
                            <input type="number" class="form-control" id="duration" name="duration" required>
                            @error('duration')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="3"
                                required></textarea>
                            @error('description')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="form-group">
                            <label for="buffer_time">Buffer Time</label>
                            <input type="number" class="form-control" id="buffer_time" name="buffer_time" required>
                            @error('buffer_time')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
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
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="form-group">
                            <label for="cost">Location</label>
                            <select name="location" id="" class="form-select">
                                <option value="remote">Remote</option>
                                <option value="in-person">In-person</option>
                            </select>
                            @error('location')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
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
                    
                    <!-- 
                    <div class="form-group col-12">
                        <label class=mb-2>Days:</label><br>
                            <span class="day-label" data-day="Monday" role="button">Monday</span>
                            <span class="day-label" data-day="Tuesday">Tuesday</span>
                            <span class="day-label" data-day="Wednesday">Wednesday</span>
                            <span class="day-label" data-day="Thursday">Thursday</span>
                            <span class="day-label" data-day="Friday">Friday</span>
                            <span class="day-label" data-day="Saturday">Saturday</span>
                            <span class="day-label" data-day="Sunday">Sunday</span>
                        <input type="hidden" name="availabilities[0][days][]" value="">
                    </div> -->
                    
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
// when the document is ready
$(document).ready(function() {
  

    // Select the event type
    $('.select-event-type').on('click', function() {
        $('#event-form-container').toggle();
        $('.select-event-type-container').toggle();
        $('#back-button').toggle();
    })

    $('.select-service-type').on('click', function() {
        $('#service-form-container').toggle();
        $('.select-event-type-container').toggle();
        $('#back-button').toggle();
    })

    $('#back-button').on('click', function() {
        $('#event-form-container').hide();
        $('#service-form-container').hide();
        $('.select-event-type-container').show();
        $('#back-button').hide();
    })

    $('.day-label').on('click', function() {
        $(this).toggleClass('selected');
        var selectedDays = [];
        $('.day-label.selected').each(function() {
            selectedDays.push($(this).data('day'));
        });
        $(this).siblings('input').val(selectedDays);
    });
})

function addAvailability() {
    var container = document.getElementById('availabilities-container');
    var row = document.createElement('div');
    row.className = 'availability-row row';
    row.innerHTML = `
        <div class="form-group col-3">
            <label for="start_date_time">Start Date and Time:</label>
            <input type="time" class="form-control" name="availabilities[${container.childElementCount}][start_date_time]" required>
        </div>
        <div class="form-group col-3">
            <label for="end_date_time">End Date and Time:</label>
            <input type="time" class="form-control" name="availabilities[${container.childElementCount}][end_date_time]" required>
        </div>
    `;
    container.appendChild(row);
}
</script>
@endpush