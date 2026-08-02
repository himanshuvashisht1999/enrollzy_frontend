@extends('layouts.app')

@push('css')
<link rel="stylesheet" href="{{ asset('assets/css/login/login-otp.css') }}">
@endpush

@section('content')

<section class="login-section py-5">
    <div class="container">
        <div class="row align-items-center justify-content-center min-vh-75">

            <!-- LEFT IMAGE -->
            <div class="col-lg-6 d-none d-lg-flex justify-content-center">
                <div class="login-illustration floating">
                    <img 
                        src="{{ asset('assets/images/auth/register.png') }}" 
                        alt="Register Illustration">
                </div>
            </div>

            <!-- RIGHT FORM -->
            <div class="col-lg-6 col-md-8">
                <div class="login-card">

                    <h2 class="mb-4 text-center">Create Your Account</h2>

                    <!-- STEP 1: MOBILE NUMBER -->
                    <div id="stepMobile" class="mb-4">
                        <label for="mobileInput" class="form-label fw-bold small text-muted">Enter your 10-digit Mobile Number</label>
                        <div class="otp-input-group mb-3">
                            <span class="country-code">
                                <i class="fa-solid fa-phone me-1"></i> +91
                            </span>
                            <input
                                type="tel"
                                id="mobileInput"
                                class="form-control"
                                placeholder="9876543210"
                                maxlength="10"
                                required>
                        </div>
                        
                        <button type="button" id="sendOtpBtn" class="btn btn-theme-one w-100 btn-lg mb-3" onclick="handleSendOtp()">
                            <i class="fas fa-paper-plane me-2"></i> Register with OTP
                        </button>
                    </div>

                    <!-- STEP 2: OTP VERIFICATION INPUT (Localhost & Fallback) -->
                    <div id="stepOtp" class="mb-4" style="display: none;">
                        <div class="alert alert-info text-center py-2 small mb-3">
                            OTP sent to <strong id="sentMobileDisplay">+91 </strong>
                        </div>

                        <label for="otpInput" class="form-label fw-bold small text-muted">Enter 6-Digit OTP</label>
                        <div class="otp-input-group mb-3">
                            <span class="country-code">
                                <i class="fa-solid fa-key me-1"></i>
                            </span>
                            <input
                                type="text"
                                id="otpInput"
                                class="form-control text-center fw-bold"
                                placeholder="• • • • • •"
                                maxlength="6"
                                style="letter-spacing: 5px; font-size: 1.2rem;"
                                required>
                        </div>

                        <button type="button" id="verifyOtpBtn" class="btn btn-theme-one w-100 btn-lg mb-2" onclick="handleVerifyOtp()">
                            <i class="fas fa-check-circle me-2"></i> Verify & Register
                        </button>

                        <div class="text-center mt-2">
                            <a href="javascript:void(0)" onclick="resetStep()" class="text-muted small">← Change Mobile Number</a>
                        </div>
                    </div>

                    <div class="divider">or</div>

                    <div class="alt-login">
                        <a href="{{ route('login') }}" class="alt-btn text-center password w-100">
                            🔐 Using Password
                        </a>
                    </div>

                    <p class="signup-text mt-4 text-center">
                        Already have an account?
                        <a href="{{ route('login') }}" class="fw-bold">Sign In</a>
                    </p>

                </div>
            </div>

        </div>
    </div>
</section>

<!-- MSG91 & Direct OTP Handler Scripts -->
<script type="text/javascript">
    let currentMobile = "";

    var configuration = {
        widgetId: "36666f6c696d323833353533",
        tokenAuth: "531665T6dGSx75SC386a2febdcP1",
        identifier: "", // Pass 91 + 10-digit number for India (+91)
        success: (data) => {
            console.log('MSG91 widget success:', data);
            if (data.message) {
                verifyTokenWithBackend(data.message);
            }
        },
        failure: (error) => {
            console.log('MSG91 widget failure:', error);
        }
    };

    function handleSendOtp() {
        let mobile = document.getElementById('mobileInput').value.trim();
        mobile = mobile.replace(/\D/g, '');

        if (!mobile || mobile.length !== 10) {
            Swal.fire({
                icon: 'warning',
                title: 'Invalid Mobile Number',
                text: 'Please enter a valid 10-digit mobile number.'
            });
            return;
        }

        currentMobile = mobile;
        // MSG91 parses '91' as country code (India +91) and the remaining 10 digits as number
        configuration.identifier = "91" + mobile;

        const isLocalhost = window.location.hostname === 'localhost' || window.location.hostname === '127.0.0.1';

        // Launch MSG91 widget ONLY on production domain (not localhost)
        if (!isLocalhost && typeof initSendOTP === 'function') {
            try {
                initSendOTP(configuration);
                return;
            } catch(e) {
                console.warn('MSG91 widget launch failed, falling back to direct OTP.', e);
            }
        }

        // Direct OTP Flow for Localhost & Fallback
        Swal.fire({
            title: 'Sending OTP...',
            text: 'Please wait while we send the verification code.',
            allowOutsideClick: false,
            didOpen: () => { Swal.showLoading(); }
        });

        fetch("{{ route('send.otp') }}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ mobile: mobile })
        })
        .then(res => res.json())
        .then(data => {
            Swal.close();
            if (data.success) {
                document.getElementById('sentMobileDisplay').innerText = "+91 " + mobile;
                document.getElementById('stepMobile').style.display = 'none';
                document.getElementById('stepOtp').style.display = 'block';

                let infoMsg = data.message;
                if (data.mock_otp) {
                    infoMsg += `<br><br><span class="badge bg-success p-2 fs-6">Testing OTP Code: ${data.mock_otp}</span>`;
                }

                Swal.fire({
                    icon: 'success',
                    title: 'OTP Sent!',
                    html: infoMsg,
                    timer: 4000
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: data.message || 'Failed to send OTP.'
                });
            }
        })
        .catch(err => {
            Swal.close();
            console.error('Send OTP Error:', err);
            document.getElementById('sentMobileDisplay').innerText = "+91 " + mobile;
            document.getElementById('stepMobile').style.display = 'none';
            document.getElementById('stepOtp').style.display = 'block';
        });
    }

    function handleVerifyOtp() {
        const otp = document.getElementById('otpInput').value.trim();
        if (!otp || otp.length < 4) {
            Swal.fire({
                icon: 'warning',
                title: 'Enter OTP',
                text: 'Please enter the 6-digit OTP code.'
            });
            return;
        }

        Swal.fire({
            title: 'Verifying OTP...',
            allowOutsideClick: false,
            didOpen: () => { Swal.showLoading(); }
        });

        fetch("{{ route('otp.verify.submit') }}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({
                otp: otp,
                mobile: currentMobile
            })
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                Swal.fire({
                    icon: 'success',
                    title: 'Welcome!',
                    text: 'Account created and logged in successfully.',
                    timer: 1500,
                    showConfirmButton: false
                }).then(() => {
                    window.location.href = data.redirect || "{{ route('home') }}";
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Verification Failed',
                    text: data.message || 'Invalid OTP code. Please try again.'
                });
            }
        })
        .catch(err => {
            console.error('Verify OTP Error:', err);
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Something went wrong during verification.'
            });
        });
    }

    function verifyTokenWithBackend(token) {
        Swal.fire({
            title: 'Logging in...',
            allowOutsideClick: false,
            didOpen: () => { Swal.showLoading(); }
        });

        fetch("{{ route('otp.verify.submit') }}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ token: token })
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                Swal.fire({
                    icon: 'success',
                    title: 'Welcome!',
                    text: 'Account created and logged in successfully.',
                    timer: 1500,
                    showConfirmButton: false
                }).then(() => {
                    window.location.href = data.redirect || "{{ route('home') }}";
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: data.message || 'Registration failed.'
                });
            }
        });
    }

    function resetStep() {
        document.getElementById('stepOtp').style.display = 'none';
        document.getElementById('stepMobile').style.display = 'block';
        document.getElementById('otpInput').value = '';
    }
</script>
<script type="text/javascript" src="https://verify.msg91.com/otp-provider.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@endsection
