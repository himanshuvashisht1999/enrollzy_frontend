<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class UserController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();
        $totalBookings = DB::table('bookings')->where('user_id', $user->id)->count();
        $upcomingBookings = DB::table('bookings')
            ->join('expert_slots', 'bookings.slot_id', '=', 'expert_slots.id')
            ->where('bookings.user_id', $user->id)
            ->where('expert_slots.date', '>=', date('Y-m-d'))
            ->count();

        return view('user.dashboard', compact('user', 'totalBookings', 'upcomingBookings'));
    }

    public function profile()
    {
        $user = Auth::user();
        return view('user.profile', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'mobile' => 'nullable|string|max:20',
            'dob' => 'nullable|date',
            'gender' => 'nullable|string',
            'country' => 'nullable|string',
            'state' => 'nullable|string',
            'city' => 'nullable|string',
            'pincode' => 'nullable|string',
        ]);

        User::where('id', $user->id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'dob' => $request->dob,
            'gender' => $request->gender,
            'country' => $request->country,
            'state' => $request->state,
            'city' => $request->city,
            'pincode' => $request->pincode,
        ]);

        return redirect()->route('user.profile')->with('success', 'Profile updated successfully.');
    }

    public function bookings()
    {
        $user = Auth::user();
        $bookings = DB::table('bookings')
            ->select('bookings.*', 'experts.name as expert_name', 'expert_slots.date as slot_date', 'expert_slots.start_time', 'expert_slots.end_time', 'expert_slots.mode')
            ->leftJoin('experts', 'bookings.expert_id', '=', 'experts.id')
            ->leftJoin('expert_slots', 'bookings.slot_id', '=', 'expert_slots.id')
            ->where('bookings.user_id', $user->id)
            ->orderBy('bookings.created_at', 'desc')
            ->get();

        return view('user.bookings', compact('bookings'));
    }
}
