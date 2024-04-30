@extends('layouts.auth')
@push('styles')
<style>
.register-left-col {
    background: #f2f2f2 !important;
}
</style>
@endpush
@section('content')
<div class="container-fluid register-container vh-100" style="margin-bottom: -100px;">
    <div class="row justify-content-center">
        <div class="col-lg-6 register-left-col d-flex align-items-center justify-content-center vh-100" style="background: #EE7B11 !important;">
            <img src="../assets/images/register.svg" class="img-fluid w-75">
        </div>
        <div class="col-lg-6 pt-5 px-4 vh-100">
            <div class="welcome-to-register d-flex justify-space-between mb-5">
                <h1>Welcome to <img src="../assets/images/logo.png" class="img-fluid ms-2"></h1>
            </div>
            <div class="create-an-accout">
                <h2>Register</h2>
                <div class="text-muted">Our free plan includes most features and 50 bookings. No credit card is needed.</div>
                <form method="POST" action="{{ route('register') }}" class="mt-5">
                    @csrf
                    <div class="row mb-2">
                        <label for="name" class="col-md-4 col-form-label text-muted">{{ __('Name') }}</label>
                        <div class="col-md-6">
                            <input id="name" type="text" class="h-75 form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-2">
                        <label for="email" class="col-md-4 col-form-label text-muted">{{ __('Email Address') }}</label>
                        <div class="col-md-6">
                            <input id="email" type="email" class="h-75 form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-2">
                        <label for="password" class="col-md-4 col-form-label text-muted">{{ __('Password') }}</label>
                        <div class="col-md-6">
                            <input id="password" type="password" class="h-75 form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-2">
                        <label for="password-confirm" class="col-md-4 col-form-label text-muted">{{ __('Confirm Password') }}</label>
                        <div class="col-md-6">
                            <input id="password-confirm" type="password" class="h-75 form-control" name="password_confirmation" required autocomplete="new-password">
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-6 offset-md-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                <label class="form-check-label" for="remember">
                                    By signing up, you agree to our <a href="#">Terms and Conditions</a> and <a href="#">Privacy Policy</a>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-8 offset-md-4">
                            <button type="submit" class="btn bk-bg-orange btn-hover-secondery text-capitalize w-75">
                                {{ __('Register') }}
                            </button>
                            @if (Route::has('password.request'))
                                <a class="btn btn-link bk-blue" href="{{ route('login') }}">
                                    {{ __('Already have an account?') }}
                                </a>
                            @endif
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection