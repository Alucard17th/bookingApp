<form method="POST" action="{{ route('workinghours.update', auth()->user()->id) }}" id="workingHoursForm">
    @csrf
    @method('PUT')
    @php
    $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
    @endphp
    <div class="row">
        <div class="col-6">
            @if(count($workingHours) > 0)
            @foreach($workingHours as $day)
            <div class="row align-items-center working-hours-time-picker-row">
                <div class="col-md-2 fw-bold">
                    {{ $day->day }}
                </div>
                <div class="col-md-6 d-flex working-hours-time-picker">
                    <div class="form-group d-flex">
                        <input type="text" class="form-control time start" placeholder="--:--"
                        autocomplete="off" name="startHour[{{ $day->day }}]" id="startTimeInputId" value="{{ $day->start_hour }}">
                    </div>
                    <div class="separator" style="width: 10px;"></div>
                    <div class="form-group d-flex">
                        <input type="text" class="form-control time end" placeholder="--:--"
                        autocomplete="off" name="endHour[{{ $day->day }}]" id="endTimeInputId" value="{{ $day->end_hour }}">
                        <div class="separator" style="width: 10px;"></div>
                        <button type="button" class="btn btn-danger reset"><i class="fas fa-trash"></i></button>
                    </div>
                </div>
                <div class="col-md-12">
                    <span class="text-danger error-message" id="error-message-{{ $day }}"></span>
                </div>
            </div>
            @endforeach
            @else
                @foreach($days as $day)
                <div class="row align-items-center working-hours-time-picker-row">
                    <div class="col-md-2 fw-bold">
                        {{ $day }}
                    </div>
                    <div class="col-md-6 d-flex working-hours-time-picker">
                        <div class="form-group d-flex">
                            <input type="text" class="form-control time start" placeholder="--:--"
                            autocomplete="off" name="startHour[{{ $day }}]" id="startTimeInputId" value="">
                        </div>
                        <div class="separator" style="width: 10px;"></div>
                        <div class="form-group d-flex">
                            <input type="text" class="form-control time end" placeholder="--:--"
                            autocomplete="off" name="endHour[{{ $day }}]" id="endTimeInputId" value="">
                            <div class="separator" style="width: 10px;"></div>
                            <button type="button" class="btn btn-danger reset"><i class="fas fa-trash"></i></button>
                        </div>
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
        $('.working-hours-time-picker .time').timepicker({
            'showDuration': false,
            'minTime': '6:00am',
            'timeFormat': 'H:i',
            'disableTextInput': true,
            'listWidth': 1
        });

        var timePicker = document.querySelector('.working-hours-time-picker');
        var timeEndDatepair = new Datepair(timePicker);

        const resetButtons = document.querySelectorAll('.reset');
        resetButtons.forEach(button => button.addEventListener('click', handleResetClick));

        function handleResetClick(event) {
            const resetButton = event.target;
            const timePicker = resetButton.closest('.working-hours-time-picker-row');
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
            $('.working-hours-time-picker-row').each(function() {
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
    })


</script>
@endpush