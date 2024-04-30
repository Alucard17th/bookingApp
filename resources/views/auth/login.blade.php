@extends('layouts.auth')

@section('content')
<div class="container login-container vh-100 d-grid">
    <div class="row justify-content-center align-items-center">
        <div class="col-lg-6">
            <div class="card bk-shadow">
                <div class="card-body py-3">
                    <div class="row mb-2">
                        <div class="col-md-12 text-center">
                            <img src="../assets/images/logo.png" class="img-fluid login-image">
                        </div>
                    </div>
                    <form method="POST" action="{{ route('login') }}" class="mt-5">
                        @csrf

                        <div class="row mb-2">
                            <label for="email" class="col-md-4 col-form-label text-md-end text-muted">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="h-75 form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-2">
                            <label for="password" class="col-md-4 col-form-label text-md-end text-muted">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="h-75 form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-2">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn bk-bg-orange text-capitalize w-75 mb-2">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link bk-blue" href="{{ route('register') }}">
                                            Register now
                                    </a>
                                    <a class="btn btn-link bk-blue" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
