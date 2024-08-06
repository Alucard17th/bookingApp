@extends('layouts.app')

@push('styles')
<style>
.table tr {
    cursor: pointer;
}
.hiddenRow {
    padding: 0 4px !important;
    background-color: #eeeeee;
    font-size: 13px;
}
</style>
@endpush

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between">
        <h5 class="card-title">Services</h5>
        <a href="{{ route('services.create') }}" class="btn add-btn">
            <i class="fa fa-plus"></i> Add Service
        </a>
    </div>
    <div class="table-responsive">
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
                <tr class="" data-toggle="collapse" data-target="#data-{{ $service->id }}" class="accordion-toggle">
                    <td>{{ $service->id }}</td>
                    <td>
                        @if($service->is_active == 0) 
                        <span class="badge bg-danger rounded rounded-pill" data-bs-toggle="tooltip" data-bs-placement="top" title="Cancelled" style="height:15px;">
                            <i class="d-none fas fa-times"></i>
                        </span>
                        @elseif($service->is_active == 1)
                        <span class="badge bg-success rounded rounded-pill" data-bs-toggle="tooltip" data-bs-placement="top" title="Active" style="height:15px;">
                            <i class="d-none fas fa-check"></i>
                        </span>
                        @endif
                        {{ $service->name }}
                    </td>
                    <td>{{ \Illuminate\Support\Str::limit($service->description,20) }}</td>
                    <td>{{ $service->duration }} min</td>
                    <td>{{ $service->cost }} $</td>
                    <td>{{ ucfirst($service->location) }}</td>
                    <td>
                        <a href="{{ route('services.show', $service->id) }}" class="btn btn-primary btn-sm"><i
                                class="fas fa-eye"></i></a>
                        <a href="{{ route('services.edit', $service->id) }}" class="btn btn-info btn-sm"><i
                                class="fas fa-edit"></i></a>
                        <form action="{{ route('services.destroy', $service->id) }}" method="POST"
                            style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm"
                                onclick="return confirm('Are you sure you want to delete this service?')"><i
                                    class="fas fa-trash"></i></button>
                        </form>
                        
                        <button class="btn btn-light btn-sm ms-3 copy-link-btn"
                            data-link="{{ url('/') }}/service-booking-single/{{ $service->id }}/{{ $service->user->id }}"
                            data-toggle="tooltip" title="Copy link to this service to share with customers." 
                            @if($service->is_active == 0) disabled @endif>
                            <i class="fas fa-link me-2"></i>
                            Get link
                        </button>
                    </td>
                </tr>
                <!-- <tr class="spacer" style="height:5px; background:0 0;"></tr> -->
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Duration</th>
                    <th>Cost</th>
                    <th>Location</th>
                    <th>Action</th>
                </tr>
            </tfoot>
        </table>
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
            $("#liveToast").toast("show");
        });
    });

    $('.accordian-body').on('show.bs.collapse', function () {
            $(this).closest("table")
                .find(".collapse.in")
                .not(this)
                .collapse('toggle')
        })
});
</script>
@endpush