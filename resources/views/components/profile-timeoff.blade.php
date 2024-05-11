    @php
    $timeoffs = $user->timeoff;
    @endphp
    <div class="row mb-3">
        <div class="col-12">
            <a type="button" class="text-decoration-none" data-bs-toggle="modal" data-bs-target="#addTimeOff">
                Add time off
            </a>
        </div>
    </div>
    <div class="row">
        @foreach($timeoffs as $timeoff)
        @php
        $start_date = new DateTime($timeoff->start_date);
        $end_date = new DateTime($timeoff->end_date);
        $duration = $start_date->diff($end_date)->format('%a');
        @endphp
        <div class="col-8 time-off-card">
            <div class="row align-items-center mb-3">
                <div class="col-md-6">
                    <div class="fw-bold">{{ $timeoff->name }}</div>
                    <div class="text-muted">{{ $timeoff->start_date }} - {{ $timeoff->end_date }}</div>
                    @if($timeoff->start_time && $timeoff->end_time)
                    <div class="text-muted">{{ $timeoff->start_time }} - {{ $timeoff->end_time }}</div>
                    @endif
                </div>
                <div class="col-md-4 text-muted text-end">
                    {{ $duration }} @if($duration == 1) day @else days @endif
                </div>
                <div class="col-md-2 d-flex">
                    <button type="button" class="btn btn-primary edit-timeoff me-1" data-timeoff="{{ $timeoff }}"><i
                            class="fas fa-edit"></i></button>
                    <form action="{{ route('timeoffs.destroy', $timeoff->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger delete-timeoff" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fas fa-trash"></i></button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Create Modal -->
    <div class="modal" id="addTimeOff" tabindex="-1" aria-labelledby="addTimeOffLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addTimeOffLabel">Add time off</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('timeoffs.store') }}" method="POST" id="timeOffForm">
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="name">Title</label>
                                    <input type="text" class="form-control" id="name" name="name" required>
                                </div>
                            </div>
                            <div class="col-6 d-flex align-items-center">
                                <div class="form-group w-100">
                                    <label for="start_date">Start date</label>
                                    <input type="date" class="form-control" id="start_date" name="start_date" required>
                                </div>
                                <div class="form-group start-time-group ms-2" style="display: none">
                                    <label for="start_time">Start time</label>
                                    <input type="time" class="form-control" id="start_time" name="start_time">
                                </div>
                            </div>
                            <div class="col-6 d-flex align-items-center">
                                <div class="form-group w-100">
                                    <label for="end_date">End date</label>
                                    <input type="date" class="form-control" id="end_date" name="end_date" required>
                                </div>
                                <div class="form-group end-time-group ms-2" style="display: none">
                                    <label for="end_time">End time</label>
                                    <input type="time" class="form-control" id="end_time" name="end_time">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="all_day_check" checked>
                                        <label class="form-check-label" for="all_day_check">All day</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 d-flex justify-content-end">
                                <button type="button" class="btn btn-secondary me-2"
                                    data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Update Modal -->
    <div class="modal" id="editTimeOff" tabindex="-1" aria-labelledby="editTimeOffLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editTimeOffLabel">Add time off</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('timeoffs.update', 0) }}" method="POST" id="editTimeOffForm">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="name">Title</label>
                                    <input type="text" class="form-control" id="name" name="name" required>
                                </div>
                            </div>
                            <div class="col-6 d-flex align-items-center">
                                <div class="form-group w-100">
                                    <label for="start_date">Start date</label>
                                    <input type="date" class="form-control" id="start_date" name="start_date" required>
                                </div>
                                <div class="form-group start-time-group ms-2" style="display: none">
                                    <label for="start_time">Start time</label>
                                    <input type="time" class="form-control" id="start_time" name="start_time">
                                </div>
                            </div>
                            <div class="col-6 d-flex align-items-center">
                                <div class="form-group w-100">
                                    <label for="end_date">End date</label>
                                    <input type="date" class="form-control" id="end_date" name="end_date" required>
                                </div>
                                <div class="form-group end-time-group ms-2" style="display: none">
                                    <label for="end_time">End time</label>
                                    <input type="time" class="form-control" id="end_time" name="end_time">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="all_day_check" checked>
                                        <label class="form-check-label" for="all_day_check">All day</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 d-flex justify-content-end">
                                <button type="button" class="btn btn-secondary me-2"
                                    data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@push('scripts')
<script>
// once page is loaded
document.addEventListener('DOMContentLoaded', function() {
    $('.time-picker .time').timepicker({
        'showDuration': false,
        'minTime': '6:00am',
        'timeFormat': 'H:i',
        'disableTextInput': true,
        'listWidth': 1
    });

    var timePicker = document.querySelector('.time-picker');
    var timeEndDatepair = new Datepair(timePicker);

    const resetButtons = document.querySelectorAll('.reset');
    resetButtons.forEach(button => button.addEventListener('click', handleResetClick));

    function handleResetClick(event) {
        const resetButton = event.target;
        const timePicker = resetButton.closest('.time-picker-row');
        const startTimeInput = timePicker.querySelector('.start');
        const endTimeInput = timePicker.querySelector('.end');
        const errorMessage = timePicker.querySelector('.error-message');

        // Set start and end time inputs to "00:00"
        startTimeInput.value = '';
        startTimeInput.placeholder = '--:--';
        endTimeInput.value = '';
        endTimeInput.placeholder = '--:--';
        errorMessage.textContent = '';
    }

    $('#workingHoursForm').submit(function(event) {
        // Prevent the default form submission behavior
        event.preventDefault();

        // Validate start and end times for each day
        let isValid = true;
        $('.time-picker-row').each(function() {
            const startTimeInput = $(this).find('.start');
            const endTimeInput = $(this).find('.end');
            const errorMessage = $(this).find('.error-message');

            // Check if start time is before end time
            const startTime = startTimeInput.val();
            const endTime = endTimeInput.val();
            if (startTime && endTime && startTime >= endTime) {
                // Display error message
                errorMessage.text('End time must be greater than start time');
                isValid = false;
            } else {
                errorMessage.text('');
            }
            console.log('Start time:', startTime, 'End time:', endTime);
        });

        // If all validations passed, submit the form
        if (isValid) {
            this.submit();
        }
    });

    // Add button click event listener
    $('.add').click(function() {
        // Clone the time picker row
        const timePickerRow = $(this).closest('.time-picker-row');
        const clonedRow = timePickerRow.clone();

        // Clear the input values
        clonedRow.find('.start').val('');
        clonedRow.find('.end').val('');

        // Append the cloned row after the current row
        timePickerRow.after(clonedRow);

        // Initialize timepicker for the cloned row
        clonedRow.find('.time').timepicker({
            'showDuration': false,
            'minTime': '6:00am',
            'timeFormat': 'H:i',
            'disableTextInput': true,
            'listWidth': 1
        });

        // Reset button click event listener for the cloned row
        clonedRow.find('.reset').click(handleResetClick);
    });

    $('#all_day_check').change(function() {
        if ($(this).is(':checked')) {
            $('.start-time-group').hide();
            $('.end-time-group').hide();
        } else {
            $('.start-time-group').show();
            $('.end-time-group').show();
        }
    })

    const editButtons = document.querySelectorAll('.edit-timeoff');

    editButtons.forEach(button => {
        button.addEventListener('click', function() {
            const timeoffData = JSON.parse(this.getAttribute('data-timeoff'));
            const modal = document.getElementById('editTimeOff');
            const form = document.querySelector('#editTimeOffForm');
            $("#editTimeOffForm").attr('action', '{{ url('/timeoffs') }}/' + timeoffData.id);
            console.log(timeoffData);

            // Clean the modal inputs
            modal.querySelector('#name').value = '';
            modal.querySelector('#start_date').value = '';
            modal.querySelector('#end_date').value = '';

            // Clean the start and end time inputs
            modal.querySelector('#start_time').value = '';
            modal.querySelector('#end_time').value = '';

            // Populate modal inputs with timeoffData values
            modal.querySelector('#name').value = timeoffData.name;
            modal.querySelector('#start_date').value = timeoffData.start_date;
            modal.querySelector('#end_date').value = timeoffData.end_date;

            // If start_time and end_time are available, populate them as well
            if (timeoffData.start_time) {
                modal.querySelector('#start_time').value = timeoffData.start_time;
                modal.querySelector('.start-time-group').style.display = 'block';
            } else {
                modal.querySelector('.start-time-group').style.display = 'none';
            }
            if (timeoffData.end_time) {
                modal.querySelector('#end_time').value = timeoffData.end_time;
                modal.querySelector('.end-time-group').style.display = 'block';
            } else {
                modal.querySelector('.end-time-group').style.display = 'none';
            }

            // Show the modal
            const modalInstance = new bootstrap.Modal(modal);
            modalInstance.show();
        });
    });

})
</script>
@endpush