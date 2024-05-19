@extends('layouts.app')
@push('styles')
<link rel="stylesheet" href="{{asset('libs/jonthornton-jquery-timepicker-18c2143/jquery.timepicker.min.css')}}">
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
                type="button" role="tab" aria-controls="pills-profile" aria-selected="true">Profile</button>
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
        <li class="nav-item" role="presentation">
            <button class="nav-link text-muted" id="pills-integrations-tab" data-bs-toggle="pill" data-bs-target="#pills-integrations"
                type="button" role="tab" aria-controls="pills-integrations" aria-selected="false">Integrations</button>
        </li>
    </ul>
    <div class="tab-content" id="pills-tabContent">
        <div class="tab-pane fade show" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
            @include('admin.profile.components.profile', compact('user'))
        </div>
        <div class="tab-pane fade" id="pills-working-hours" role="tabpanel" aria-labelledby="pills-working-hours-tab">
            @include('admin.profile.components.profile-working-hours', compact('user', 'workingHours'))
        </div>
        <div class="tab-pane fade" id="pills-breaks" role="tabpanel" aria-labelledby="pills-breaks-tab">
            @include('admin.profile.components.profile-breaks', compact('user', 'workingHours'))
        </div>
        <div class="tab-pane fade" id="pills-timeoff" role="tabpanel" aria-labelledby="pills-timeoff-tab">
            @include('admin.profile.components.profile-timeoff', compact('user', 'workingHours'))
        </div>
        <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
            @include('admin.profile.components.profile-contact', compact('user'))
        </div>
        <div class="tab-pane fade" id="pills-integrations" role="tabpanel" aria-labelledby="pills-integrations-tab">
            @include('admin.profile.components.profile-integrations', compact('user'))
        </div>
    </div>

</div>
@endsection
@push('scripts')
<script src="{{asset('libs/jonthornton-jquery-timepicker-18c2143/jquery.timepicker.min.js')}}"></script>
<script src="{{asset('libs/DatePair-2/dist/datepair.js')}}"></script>
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
<script>
$(document).ready(function() {
    // Gets the video src from the data-src on each button

    var $videoSrc;
    $('.video-btn').click(function() {
        $videoSrc = $(this).data("src");
    });
    console.log($videoSrc);

    // when the modal is opened autoplay it  
    $('#exampleModal').on('shown.bs.modal', function(e) {
        // set the video src to autoplay and not to show related video. Youtube related video is like a box of chocolates... you never know what you're gonna get
        $("#video").attr('src', $videoSrc + "?autoplay=1&amp;modestbranding=1&amp;showinfo=0");
    })

    // stop playing the youtube video when I close the modal
    $('#exampleModal').on('hide.bs.modal', function(e) {
        // a poor man's stop video
        $("#video").attr('src', $videoSrc);
    })
})
</script>
@endpush