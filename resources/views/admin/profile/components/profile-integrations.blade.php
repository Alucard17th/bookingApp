<form method="POST" action="{{ route('profile.saveIntegrations', $user->id) }}" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-lg-8">
            <div class="card-header mb-3">
                <h3 class="fw-bold">Profile Settings</h4>
            </div>

            <div class="card shadow p-3 mb-5 bg-white rounded border-0">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="name">Google Calendar ID</label>
                                <input type="text" class="form-control" id="g_c_id" name="google_calendar_id"
                                    value="{{ $user->google_calendar_id }}" required>
                            </div>
                        </div>
                        <div class="col-lg-6 d-flex align-items-center">
                            <button type="button"
                                class="link-primary border-0 bg-transparent text-decoration-underline video-btn"
                                data-src="https://www.youtube.com/embed/NFWSFbqL0A0" data-bs-toggle="modal"
                                data-bs-target="#exampleModal">
                                <span class="d-inline-block me-2"><i
                                        class="ti ti-playstation-triangle"></i></span>How to get Google Calendar ID
                            </button>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary w-25">Update</button>
            </div>
        </div>
    </div>
</form>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl modal-dialog-scrollable pt-5">
        <div class="modal-content bg-transparent">
            <div class="modal-body">
                <div class="embed-responsive embed-responsive-16by9">
                    <iframe class="embed-responsive-item" src="" id="video" allowscriptaccess="always" allow="autoplay"
                        style="width: 100%; height: 70vh;"></iframe>
                </div>
            </div>
        </div>
    </div>
</div>