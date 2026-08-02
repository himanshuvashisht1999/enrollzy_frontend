@extends('layouts.app')

@push('css')
<link rel="stylesheet" href="{{ asset('assets/css/login/login-password.css') }}">
@endpush

@section('content')
<section class="login-section py-5">
    <div class="container">
        <div class="row align-items-center justify-content-center min-vh-75">

            <!-- LEFT IMAGE -->
            <div class="col-lg-6 d-none d-lg-flex justify-content-center">
                <div class="login-illustration floating">
                    <img 
                        src="{{ asset('assets/images/auth/login-password.png') }}" 
                        alt="Login Password">
                </div>
            </div>

            <!-- RIGHT FORM -->
            <div class="col-lg-6 col-md-8">
                <div class="login-card">

                    <h2 class="mb-4 text-center">Login Your Account</h2>

                    <form action="{{ route('login') }}" method="POST">
                        @csrf

                        <!-- MOBILE -->
                        <div class="otp-input-group mb-3">
                            <span class="country-code">
                                <i class="fa-solid fa-phone"></i>
                            </span>
                            <input
                                type="text"
                                name="mobile"
                                value="{{ old('mobile') }}"
                                placeholder="Mobile Number"
                                required>
                        </div>
                        @error('mobile')
                            <div class="text-danger mb-2 small">{{ $message }}</div>
                        @enderror

                        <!-- PASSWORD -->
                        <div class="otp-input-group mb-4">
                            <span class="country-code">
                                <i class="fa-solid fa-lock"></i>
                            </span>
                            <input
                                type="password"
                                name="password"
                                placeholder="Enter password"
                                required>
                        </div>
                        @error('password')
                            <div class="text-danger mb-2 small">{{ $message }}</div>
                        @enderror

                        <button type="submit" class="btn btn-theme-one w-100 mb-3">
                            Login
                        </button>

                        <div class="text-end mb-3">
                            <a href="#" class="forgot-link small">
                                Forgot password?
                            </a>
                        </div>

                        <div class="divider">or</div>

                        <div class="alt-login">
                            <a href="{{ route('login-otp') }}" class="alt-btn text-center otp w-100">
                                📱 Using OTP
                            </a>
                        </div>

                        <p class="signup-text">
                            Don’t have an account?
                            <a href="{{ route('register') }}">Sign Up</a>
                        </p>

                    </form>

                </div>
            </div>

        </div>
    </div>
</section>
@endsection
