<form method="POST" action="{{ route('profile.contact', $user->id) }}" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-lg-8">
            <div class="card shadow p-3 mb-5 bg-white rounded border-0">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="website"><i class="me-1 fas fa-globe bk-blue"></i>Website</label>
                                <input type="text" class="form-control" id="website" name="website"
                                    value="{{ $user->website }}">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="facebook"><i class="me-1 fab fa-facebook bk-blue"></i>Facebook</label>
                                <input type="text" class="form-control" id="facebook" name="facebook"
                                    value="{{ $user->facebook }}" required>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="instagram"><i class="me-1 fab fa-instagram bk-blue"></i>Instagram</label>
                                <input type="text" class="form-control" id="instagram" name="instagram"
                                    value="{{ $user->instagram }}" required>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="linkedin"><i class="me-1 fab fa-linkedin bk-blue"></i>Linkedin</label>
                                <input type="text" class="form-control" id="linkedin" name="linkedin"
                                    value="{{ $user->linkedin }}" required>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="twitter"><i class="me-1 fab fa-twitter bk-blue"></i>twitter</label>
                                <input type="text" class="form-control" id="twitter" name="twitter"
                                    value="{{ $user->twitter }}" required>
                            </div>
                        </div>
                        <div class="col-4 mt-3">
                            <button type="submit" class="btn btn-primary">Update Profile</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>