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
    <form method="POST" action="{{ route('profile.update', $user->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="card">
            <div class="card-header">
                Profile Settings
            </div>

            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}"
                                required>
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}"
                                required>
                        </div>

                        <div class="form-group">
                            <label for="avatar">Avatar</label>
                            <input type="file" class="form-control-file" id="avatar" name="avatar" accept="image/*">
                        </div>
                    </div>
                    <div class="col-6 d-flex align-items-center justify-content-center">
                        <div class="form-group image-preview">
                            <label>Avatar Preview</label>
                            <img class="img-thumbnail img-fluid profile-image" src="{{ Storage::url($user->avatar) }}"
                                alt="{{ $user->name }}">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card my-3">
            <div class="card-header">
                Company Settings
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
                            <input type="text" class="form-control" id="phone" name="phone" value="{{ $user->phone }}">
                        </div>

                        <div class="form-group">
                            <label for="logo">Logo</label>
                            <input type="file" class="form-control-file" id="logo" name="logo" accept="image/*">
                        </div>
                    </div>
                    <div class="col-6 d-flex align-items-center justify-content-center">
                        <div class="form-group image-preview">
                            <label>Logo Preview</label>
                            <img class="img-thumbnail img-fluid company-image" src="{{ Storage::url($user->logo) }}"
                                alt="{{ $user->company_name }}">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Update Profile</button>

    </form>
</div>
@endsection

@push('scripts')
@endpush