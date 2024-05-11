@extends('layouts.app')
@push('styles')
<link rel="stylesheet" href="../libs/jonthornton-jquery-timepicker-18c2143/jquery.timepicker.min.css">
<style>
.profile-image {
    height: 200px !important;
}

.company-image {
    background-size: contain;
    height: 20rem;
    width: 20rem;
    background-repeat: no-repeat;
    background-position: center;
}
</style>
@endpush

@section('content')
<div class="container">
    <!-- <div class="row mb-3">
        <a href="{{ route('events.index') }}" class="">Back to Events</a>
    </div> -->
    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link text-muted"  data-bs-toggle="pill" data-bs-target="#pills-profile"
                type="button" role="tab" aria-controls="pills-profile" aria-selected="true">Profileee</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link text-muted" id="pills-working-hours-tab" data-bs-toggle="pill" data-bs-target="#pills-working-hours"
                type="button" role="tab" aria-controls="pills-working-hours" aria-selected="false">Working hours</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link text-muted" id="pills-breaks-tab" data-bs-toggle="pill" data-bs-target="#pills-breaks"
                type="button" role="tab" aria-controls="pills-breaks" aria-selected="false">Breaks</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link text-muted" id="pills-timeoff-tab" data-bs-toggle="pill" data-bs-target="#pills-timeoff"
                type="button" role="tab" aria-controls="pills-timeoff" aria-selected="false">Time off</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link text-muted" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-contact"
                type="button" role="tab" aria-controls="pills-contact" aria-selected="false">Contact</button>
        </li>
    </ul>
    <div class="tab-content" id="pills-tabContent">
        <div class="tab-pane fade show" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
            @include('components.profile', compact('user'))
        </div>
        <div class="tab-pane fade" id="pills-working-hours" role="tabpanel" aria-labelledby="pills-working-hours-tab">
            @include('components.profile-working-hours', compact('user', 'workingHours'))
        </div>
        <div class="tab-pane fade" id="pills-breaks" role="tabpanel" aria-labelledby="pills-breaks-tab">
            @include('components.profile-breaks', compact('user', 'workingHours'))
        </div>
        <div class="tab-pane fade" id="pills-timeoff" role="tabpanel" aria-labelledby="pills-timeoff-tab">
            @include('components.profile-timeoff', compact('user', 'workingHours'))
        </div>
        <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
            @include('components.contact', compact('user'))
        </div>
    </div>

</div>
@endsection
@push('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Retrieve the last active tab from local storage
        const lastActiveTab = localStorage.getItem('lastActiveTab');
        const pillsTab = document.getElementById('pills-tab');

        // If there's a last active tab, set it as active
        if (lastActiveTab) {
            const tabButton = document.querySelector(`[data-bs-target="${lastActiveTab}"]`);
            if (tabButton) {
                tabButton.classList.add('active');
                const tabPane = document.querySelector(lastActiveTab);
                if (tabPane) {
                    tabPane.classList.add('show', 'active');
                }
            }
        }else{
            const tabButton = document.querySelector(`[data-bs-target="#pills-profile"]`);
            if (tabButton) {
                tabButton.classList.add('active');
                const tabPane = document.querySelector('#pills-profile');
                if (tabPane) {
                    tabPane.classList.add('show', 'active');
                }
            }
        }

        // Add event listener to store the last active tab in local storage
        pillsTab.addEventListener('click', function(event) {
            const targetTab = event.target.dataset.bsTarget;
            if (targetTab) {
                localStorage.setItem('lastActiveTab', targetTab);
            }
        });
    });
</script>
@endpush