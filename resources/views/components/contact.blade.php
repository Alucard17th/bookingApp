<form method="POST" action="{{ route('profile.update', $user->id) }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="row">
        <div class="col-lg-8">
            <div class="card shadow p-3 mb-5 bg-white rounded border-0">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="phone"><i class="me-1 fas fa-phone bk-blue"></i>Phone</label>
                                <input type="text" class="form-control" id="phone" name="phone"
                                    value="">
                            </div>
                            <div class="form-group">
                                <label for="email"><i class="me-1 fas fa-envelope bk-blue"></i>Email</label>
                                <input type="email" class="form-control" id="email" name="email"
                                    value="">
                            </div>
                            <div class="form-group">
                                <label for="website"><i class="me-1 fas fa-globe bk-blue"></i>Website</label>
                                <input type="text" class="form-control" id="website" name="website"
                                    value="">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="facebook"><i class="me-1 fab fa-facebook bk-blue"></i>Facebook</label>
                                <input type="text" class="form-control" id="facebook" name="facebook"
                                    value="" required>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="instagram"><i class="me-1 fab fa-instagram bk-blue"></i>Instagram</label>
                                <input type="text" class="form-control" id="instagram" name="instagram"
                                    value="" required>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="linkedin"><i class="me-1 fab fa-linkedin bk-blue"></i>Linkedin</label>
                                <input type="text" class="form-control" id="linkedin" name="linkedin"
                                    value="" required>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="twitter"><i class="me-1 fab fa-twitter bk-blue"></i>twitter</label>
                                <input type="text" class="form-control" id="twitter" name="twitter"
                                    value="" required>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <button type="submit" class="btn btn-primary">Update Profile</button>
</form>