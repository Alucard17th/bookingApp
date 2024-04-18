@extends('layouts.app')

@push('styles')
@endpush

@section('content')
<div class="container-fluid">
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
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
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
                            <td>{{ $event->id }}</td>
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
                                <button class="btn btn-light btn-sm ms-3 copy-link-btn" 
                                    data-link="{{ url('/') }}/book-event/{{ $event->user->id }}/{{ $event->id }}" 
                                    data-toggle="tooltip" title="Tooltip text">
                                    <i class="fas fa-link me-2"></i>
                                    Get link
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Date</th>
                            <th>Time</th>
                            <th>Location</th>
                            <th>Attendees</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var copyLinkBtns = document.querySelectorAll('.copy-link-btn');

        copyLinkBtns.forEach(function(copyLinkBtn) {
            copyLinkBtn.addEventListener('click', function() {
                var link = this.getAttribute('data-link');
                
                // Create a temporary input element
                var tempInput = document.createElement('input');
                tempInput.value = link;
                document.body.appendChild(tempInput);
                
                // Select the input field
                tempInput.select();
                tempInput.setSelectionRange(0, 99999); /* For mobile devices */
                
                // Copy the text inside the input field
                document.execCommand('copy');
                
                // Remove the temporary input element
                document.body.removeChild(tempInput);

                console.log('Link copied to clipboard: ' + link);
            });
        });
    });
</script>
@endpush