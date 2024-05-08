<form method="POST" action="{{ route('profile.update', $user->id) }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="row">
        <div class="col-lg-8">
            <div class="card-header mb-3">
                <h3 class="fw-bold">Profile Settings</h4>
            </div>

            <div class="card shadow p-3 mb-5 bg-white rounded border-0">
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
                            @if($user->avatar)
                            <div class="form-group image-preview">
                                <label>Avatar Preview</label>
                                <img class="img-thumbnail img-fluid profile-image border-0" src="{{ Storage::url($user->avatar) }}"
                                    alt="{{ $user->name }}">
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @if($user->subscription)
        <div class="col-lg-4">
            <div class="card-header mb-3">
                <h3 class="fw-bold">Subscription</h4>
            </div>
            <div class="card shadow p-3 mb-5 bg-white rounded border-0">
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

    <div class="card-header mb-3">
            <h3 class="fw-bold">Business</h4>
        </div>
    <div class="card shadow p-3 mb-5 bg-white rounded border-0">
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
                        <input type="text" class="form-control" id="address" name="address" value="{{ $user->address }}">
                    </div>

                    <div class="form-group">
                        <label for="phone">Phone</label>
                        <input type="text" class="form-control" id="phone" name="phone" value="{{ $user->phone }}">
                    </div>

                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="logo">Logo</label>
                                <input type="file" class="form-control-file" id="logo" name="logo" accept="image/*">
                            </div>
                        </div>
                       
                        
                    </div>

                </div>

                <div class="col-6 d-flex align-items-center justify-content-center">
                    @if($user->logo)
                    <div class="form-group image-preview company-image" style="background-image: url({{ Storage::url($user->logo) }});">
                        <label>Logo Preview</label>
                        <!-- <img class="img-thumbnail img-fluid company-image" src="{{ Storage::url($user->logo) }}"
                            alt="{{ $user->company_name }}"> -->
                    </div>
                    @endif
                </div>

            </div>
        </div>
    </div>

    <button type="submit" class="btn btn-primary">Update Profile</button>
</form>