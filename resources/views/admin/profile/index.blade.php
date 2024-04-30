@extends('layouts.app')

@push('styles')
<style>
.profile-image {
    height: 200px !important;
}

.company-image {
    height: 200px !important;
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
            <button class="nav-link active" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile"
                type="button" role="tab" aria-controls="pills-profile" aria-selected="true">Profile</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="pills-business-tab" data-bs-toggle="pill" data-bs-target="#pills-business"
                type="button" role="tab" aria-controls="pills-business" aria-selected="false">Business</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-contact"
                type="button" role="tab" aria-controls="pills-contact" aria-selected="false">Contact</button>
        </li>
    </ul>
    <div class="tab-content" id="pills-tabContent">
        <div class="tab-pane fade show active" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
            <form method="POST" action="{{ route('profile.update', $user->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-6">
                        <div class="card-header mb-3">
                            <h4 class="card-title">Profile Settings</h4>
                        </div>

                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text" class="form-control" id="name" name="name"
                                            value="{{ $user->name }}" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" class="form-control" id="email" name="email"
                                            value="{{ $user->email }}" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="avatar">Avatar</label>
                                        <input type="file" class="form-control-file" id="avatar" name="avatar"
                                            accept="image/*">
                                    </div>
                                </div>
                                <div class="col-6 d-flex align-items-center justify-content-center">
                                    @if($user->avatar)
                                    <div class="form-group image-preview">
                                        <label>Avatar Preview</label>
                                        <img class="img-thumbnail img-fluid profile-image"
                                            src="{{ Storage::url($user->avatar) }}" alt="{{ $user->name }}">
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    @if($user->subscription)
                    <div class="col-6">
                        <div class="card">
                            <div class="card-header">
                                Subscription
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="mb-2">
                                        <label class="fw-bold me-2">Subscription</label>
                                        {{ $user->subscription->subscription_id }}
                                    </div>
                                    <div class="mb-2">
                                        <label class="fw-bold me-2">Start Date</label>
                                        {{ $user->subscription->start_date }}
                                    </div>
                                    <div class="mb-2">
                                        <label class="fw-bold me-2">End Date</label>
                                        {{ $user->subscription->end_date }}
                                    </div>
                                    <div class="mb-2">
                                        <label class="fw-bold me-2">Next Billing Date</label>
                                        {{ $user->subscription->end_date }}
                                    </div>
                                    <div class="mb-2">
                                        <label class="fw-bold me-2">Plan</label>
                                        {{ $user->subscription->plan_id }}
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                    @endif
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="company_name">Company Name</label>
                                <input type="text" class="form-control" id="company_name" name="company_name"
                                    value="{{ $user->company_name }}">
                            </div>

                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea class="form-control" id="description" name="description"
                                    rows="3">{{ $user->description }}</textarea>
                            </div>

                            <div class="form-group">
                                <label for="address">Address</label>
                                <input type="text" class="form-control" id="address" name="address"
                                    value="{{ $user->address }}">
                            </div>

                            <div class="form-group">
                                <label for="phone">Phone</label>
                                <input type="text" class="form-control" id="phone" name="phone"
                                    value="{{ $user->phone }}">
                            </div>

                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="logo">Logo</label>
                                        <input type="file" class="form-control-file" id="logo" name="logo"
                                            accept="image/*">
                                    </div>
                                </div>
                                <div class="col-6">
                                    @if($user->logo)
                                    <div class="form-group image-preview">
                                        <label>Logo Preview</label>
                                        <img class="img-thumbnail img-fluid company-image"
                                            src="{{ Storage::url($user->logo) }}" alt="{{ $user->company_name }}">
                                    </div>
                                    @endif
                                </div>
                            </div>

                        </div>

                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Update Profile</button>
            </form>
        </div>
        <div class="tab-pane fade" id="pills-business" role="tabpanel" aria-labelledby="pills-business-tab">
            <form>
                @csrf
                @php
                    $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
                @endphp
                <table class="table-borderless">
                    <tbody>
                        @foreach($days as $day)
                        <tr>
                            <td>{{ $day }}</td>
                            <td>
                                <div class="form-group">
                                    <input type="time" class="form-control" name="startHour[{{ $day }}]" id="startHour">
                                </div>
                            </td>
                            <td>
                                <div class="form-group">
                                   <input type="time" class="form-control" name="endHour[{{ $day }}]" id="endHour">
                                </div>
                            </td>
                            <td>
                                <div class="form-group">
                                    <button type="button" class="btn btn-danger">X</button>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <button type="submit" class="btn btn-primary">Save</button>
            </form>
        </div>
        <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
            Contact
        </div>
    </div>

</div>
@endsection

@push('scripts')
@endpush