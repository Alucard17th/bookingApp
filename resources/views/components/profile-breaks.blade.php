<form method="POST" action="{{ route('breaks.update', $user->id) }}" id="breaksForm">
    @csrf
    @method('PUT')
    @php
    $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
    @endphp
    <div class="row">
        <div class="col-6">
            @if(count($workingHours) > 0)
            @foreach($workingHours as $day)
                @if(count($day->breaks) > 0)
                    @foreach($day->breaks as $break)
                    <div class="row align-items-center breaks-time-picker-row">
                        <div class="col-md-2 fw-bold @if(!$loop->first) invisible @endif">
                            {{ $day->day }}
                        </div>
                        <div class="col-md-6 d-flex time-picker">
                            <div class="form-group d-flex">
                                <input type="text" class="form-control time start" placeholder="--:--"
                                autocomplete="off" name="startHour[{{ $day->day }}][]" id="startTimeInputId" value="{{ $break->start_time }}">
                            </div>
                            <div class="separator" style="width: 10px;"></div>
                            <div class="form-group d-flex">
                                <input type="text" class="form-control time end" placeholder="--:--"
                                autocomplete="off" name="endHour[{{ $day->day }}][]" id="endTimeInputId" value="{{ $break->end_time }}">
                                <div class="separator" style="width: 10px;"></div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            @if($loop->first)
                            <button type="button" class="btn btn-primary add-break me-1"><i class="fas fa-plus"></i></button>
                            @endif
                            <button type="button" class="btn btn-danger reset-break"><i class="fas fa-trash"></i></button>
                        </div>
                        <div class="col-md-12">
                            <span class="text-danger error-message" id="error-message-{{ $day }}"></span>
                        </div>
                    </div>
                    @endforeach
                @else
                    <div class="row align-items-center breaks-time-picker-row">
                        <div class="col-md-2 fw-bold">
                            {{ $day->day }}
                        </div>
                        <div class="col-md-6 d-flex time-picker">
                            <div class="form-group d-flex">
                                <input type="text" class="form-control time start" placeholder="--:--"
                                autocomplete="off" name="startHour[{{ $day->day }}][]" id="startTimeInputId" value="">
                            </div>
                            <div class="separator" style="width: 10px;"></div>
                            <div class="form-group d-flex">
                                <input type="text" class="form-control time end" placeholder="--:--"
                                autocomplete="off" name="endHour[{{ $day->day }}][]" id="endTimeInputId" value="">
                                <div class="separator" style="width: 10px;"></div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <button type="button" class="btn btn-primary add-break me-1"><i class="fas fa-plus"></i></button>
                            <button type="button" class="btn btn-danger reset-break"><i class="fas fa-trash"></i></button>
                        </div>
                        <div class="col-md-12">
                            <span class="text-danger error-message" id="error-message-{{ $day }}"></span>
                        </div>
                    </div>
                @endif
            @endforeach
            @else
                @foreach($days as $day)
                <div class="row align-items-center breaks-time-picker-row">
                    <div class="col-md-2 fw-bold">
                        {{ $day }}
                    </div>
                    <div class="col-md-6 d-flex time-picker">
                        <div class="form-group d-flex">
                            <input type="text" class="form-control time start" placeholder="--:--"
                            autocomplete="off" name="startHour[{{ $day }}][]" id="startTimeInputId" value="">
                        </div>
                        <div class="separator" style="width: 10px;"></div>
                        <div class="form-group d-flex">
                            <input type="text" class="form-control time end" placeholder="--:--"
                            autocomplete="off" name="endHour[{{ $day }}][]" id="endTimeInputId" value="">
                            <div class="separator" style="width: 10px;"></div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <button type="button" class="btn btn-primary add-break me-1"><i class="fas fa-plus"></i></button>
                        <button type="button" class="btn btn-danger reset-break"><i class="fas fa-trash"></i></button>
                    </div>
                    <div class="col-md-12">
                        <span class="text-danger error-message" id="error-message-{{ $day }}"></span>
                    </div>
                </div>
                @endforeach
            @endif
        </div>
        <div class="col-6">
            Days where time is --:-- will be ignored
        </div>
    </div>
        
    <button type="submit" class="btn btn-primary mt-3">Save</button>
</form>

@push('scripts')
<script src="../libs/jonthornton-jquery-timepicker-18c2143/jquery.timepicker.min.js"></script>
<script src="../libs/DatePair-2/dist/datepair.js"></script>
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
            const timePicker = resetButton.closest('.breaks-time-picker-row');
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

        $('#breaksForm').submit(function(event) {
            // Prevent the default form submission behavior
            event.preventDefault();

            // Validate start and end times for each day
            let isValid = true;
            $('.breaks-time-picker-row').each(function() {
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
        $('.add-break').click(function() {
            // Clone the time picker row
            const timePickerRow = $(this).closest('.breaks-time-picker-row');
            const clonedRow = timePickerRow.clone();

            // Clear the input values
            clonedRow.find('.start').val('');
            clonedRow.find('.end').val('');

            // Remove the day label and the "Add" button from the cloned row
            clonedRow.find('.fw-bold').addClass('invisible');
            clonedRow.find('.add-break').remove();

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

            clonedRow.find('.reset-break').click(function() {
                // Set start and end time inputs to "00:00"
                const startTimeInput = clonedRow.find('.start');
                const endTimeInput = clonedRow.find('.end');

                startTimeInput.val('');
                startTimeInput.attr('placeholder', '--:--');
                endTimeInput.val('');
                endTimeInput.attr('placeholder', '--:--');

                // Remove the cloned row
                clonedRow.remove();
            });
        });

        // Reset button click event listener for the initial rows
        $('.reset-break').click(function() {
            // Set start and end time inputs to "00:00"
            const timePickerRow = $(this).closest('.breaks-time-picker-row');
            const startTimeInput = timePickerRow.find('.start');
            const endTimeInput = timePickerRow.find('.end');

            startTimeInput.val('');
            startTimeInput.attr('placeholder', '--:--');
            endTimeInput.val('');
            endTimeInput.attr('placeholder', '--:--');
        });

    })
</script>
@endpush