<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    /**
     * Show the user login form.
     */
    public function showLoginForm()
    {
        return view('auth.login-password');
    }

    /**
     * Handle user login via mobile & password.
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'mobile' => ['required', 'digits:10'],
            'password' => ['required'],
        ]);

        if (Auth::attempt(['mobile' => $credentials['mobile'], 'password' => $credentials['password']])) {
            $request->session()->regenerate();
            session(['simple_auth' => true]);

            return redirect()->intended(route('home'));
        }

        return back()->withErrors([
            'mobile' => 'The provided credentials do not match our records.',
        ])->onlyInput('mobile');
    }

    /**
     * Handle user logout.
     */
    public function logout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }

    /**
     * Send OTP to Mobile (Direct / Fallback API)
     */
    public function sendOtp(Request $request)
    {
        $request->validate([
            'mobile' => ['required', 'digits:10'],
        ]);

        $mobile = $request->mobile;
        // Generate a 6-digit OTP
        $otp = rand(100000, 999999);

        // Store OTP and mobile in session
        session([
            'mobile' => $mobile,
            'otp' => $otp
        ]);

        $authKey = env('MSG91_AUTH_KEY', '509095AeRzdoYXdas69e1d083P1');
        
        // Try sending SMS via MSG91 API if needed
        try {
            if ($authKey) {
                Http::withoutVerifying()->get("https://control.msg91.com/api/v5/otp", [
                    'authkey' => $authKey,
                    'mobile' => '91' . $mobile,
                    'otp' => $otp,
                ]);
            }
        } catch (\Exception $e) {
            // Silence SMS failure on dev environment
        }

        return response()->json([
            'success' => true,
            'message' => 'OTP has been sent to +91 ' . $mobile,
            'mock_otp' => $otp // Return OTP for easy testing
        ]);
    }

    /**
     * Handle user registration.
     */
    public function register(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'mobile' => ['required', 'digits:10', 'unique:users,mobile'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'mobile' => $request->mobile,
            'password' => Hash::make($request->password),
            'email' => null,
        ]);

        Auth::login($user);

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'redirect' => route('home')
            ]);
        }

        return redirect()->route('home')->with('success', 'Registration successful!');
    }

    public function loginOtpSubmit(Request $request)
    {
        $request->validate([
            'mobile' => ['required', 'digits:10'],
        ]);

        session([
            'mobile' => $request->mobile,
            'otp_type' => 'login'
        ]);

        return $this->sendOtp($request);
    }

    public function showVerifyOtp()
    {
        if (!session('mobile')) {
            return redirect()->route('login-otp');
        }
        return view('auth.verify-otp');
    }

    /**
     * Verify OTP (Supports both Direct OTP Code and MSG91 Widget Access Token)
     */
    public function verifyOtp(Request $request)
    {
        // 1. Direct OTP Code verification
        if ($request->has('otp')) {
            $request->validate([
                'otp' => 'required',
                'mobile' => 'required|digits:10'
            ]);

            $sessionOtp = session('otp');
            $sessionMobile = session('mobile', $request->mobile);

            // Allow matching session OTP or testing fallback '123456'
            if ($request->otp == $sessionOtp || $request->otp == '123456') {
                $phone = $request->mobile;
                
                $user = User::where('mobile', $phone)->first();
                if (!$user) {
                    // Auto-register new user
                    $user = User::create([
                        'name' => null,
                        'mobile' => $phone,
                        'password' => Hash::make(Str::random(10)),
                        'email' => null,
                    ]);
                }

                Auth::login($user, true);
                session(['simple_auth' => true]);
                session()->forget(['otp', 'mobile', 'otp_type']);

                return response()->json([
                    'success' => true,
                    'redirect' => route('home')
                ]);
            }

            return response()->json([
                'success' => false,
                'message' => 'Invalid OTP code entered. Please try again.'
            ], 422);
        }

        // 2. MSG91 Widget Token verification
        if ($request->has('token')) {
            $request->validate([
                'token' => 'required'
            ]);

            $authKey = env('MSG91_AUTH_KEY', '509095AeRzdoYXdas69e1d083P1');
            $response = Http::withoutVerifying()->withHeaders([
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ])->withBody(json_encode([
                'authkey' => $authKey,
                'access-token' => $request->token
            ]), 'application/json')->post('https://control.msg91.com/api/v5/widget/verifyAccessToken');

            $data = $response->json();

            if ($response->successful() && ($data['type'] ?? '') == 'success') {
                $mobile = $data['message'] ?? '';
                if (!$mobile) {
                    return response()->json(['success' => false, 'message' => 'Invalid response from MSG91'], 422);
                }

                $phone = substr($mobile, -10);
                $user = User::where('mobile', $phone)->first();
                
                if (!$user) {
                    $user = User::create([
                        'name' => null,
                        'mobile' => $phone,
                        'password' => Hash::make(Str::random(10)),
                        'email' => null,
                    ]);
                }

                Auth::login($user, true);
                session(['simple_auth' => true]);
                session()->forget(['mobile', 'otp_type']); 

                return response()->json([
                    'success' => true,
                    'redirect' => route('home')
                ]);
            }

            return response()->json([
                'success' => false,
                'message' => $data['message'] ?? 'OTP verification failed. Please try again.'
            ], 422);
        }

        return response()->json([
            'success' => false,
            'message' => 'Missing OTP code or verification token.'
        ], 422);
    }
}
