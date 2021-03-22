@extends('layouts.external')

@section('content')
        <div class="app-auth-body mx-auto">
            <div class="app-auth-branding mb-2 mt-4">
                <a class="app-logo" href="{{ route('home') }}">
                    <img class="logo-icon" src="{{ asset('images/logo/te-logo.png') }}" alt="logo">
                </a>
            </div>
            <h2 class="auth-heading text-center mb-2">Log In</h2>

            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="auth-form-container text-left">
                <form class="auth-form login-form">
                    <div class="email mb-3">
                        <label for="email" class="col-md-4 col-form-label">{{ __('E-Mail Address') }}</label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                               name="email" value="{{ old('email') }}" required autocomplete="email"
                               placeholder="Type your E-mail..." autofocus>
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div><!--//form-group-->
                    <div class="password mb-3">
                        <label for="password" class="col-md-4 col-form-label">{{ __('Password') }}</label>
                        <input id="password" type="password"
                               class="form-control @error('password') is-invalid @enderror"
                               name="password" placeholder="Type your Password..."
                               required autocomplete="current-password">
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror

                        <div class="extra mt-3 row justify-content-between">
                            <div class="col-6">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember"
                                           id="remember" {{ old('remember') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div><!--//col-6-->
                            <div class="col-6">
                                <div class="forgot-password">
                                    @if (Route::has('password.request'))
                                        <a class="btn btn-link btn-sm" style="font-size: 0.7rem"
                                           href="{{ route('password.request') }}">
                                            {{ __('Forgot Your Password?') }}
                                        </a>
                                    @endif
                                </div>
                            </div><!--//col-6-->
                        </div><!--//extra-->
                    </div><!--//form-group-->
                    <div class="text-center">
                        <button type="submit" class="btn app-btn-primary btn-block theme-btn mx-auto">Log In</button>
                    </div>
                </form>

                <div class="auth-option text-center pt-5">No Account? Sign up
                    <a class="text-link" href="{{ route('register') }}">here</a>.
                </div>
            </div><!--//auth-form-container-->
            </form>
        </div><!--//auth-body-->
@endsection
