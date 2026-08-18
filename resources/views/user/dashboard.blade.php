@extends('user.layout')

@section('dashboard_content')
<div class="card border-0 shadow-sm rounded-4 mb-4">
    <div class="card-body p-4">
        <h4 class="fw-bold mb-4">Welcome back, {{ auth()->user()->name ?? 'User' }}!</h4>
        
        <div class="row g-4">
            <div class="col-md-6">
                <div class="card bg-primary text-white border-0 rounded-4 shadow-sm h-100">
                    <div class="card-body p-4 d-flex align-items-center">
                        <div class="me-3">
                            <i class="fa-solid fa-calendar-check fa-3x opacity-75"></i>
                        </div>
                        <div>
                            <h2 class="fw-bold mb-0">{{ $totalBookings }}</h2>
                            <p class="mb-0 text-white-50">Total Sessions Booked</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card bg-success text-white border-0 rounded-4 shadow-sm h-100">
                    <div class="card-body p-4 d-flex align-items-center">
                        <div class="me-3">
                            <i class="fa-solid fa-calendar-days fa-3x opacity-75"></i>
                        </div>
                        <div>
                            <h2 class="fw-bold mb-0">{{ $upcomingBookings }}</h2>
                            <p class="mb-0 text-white-50">Upcoming Sessions</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-5">
            <h5 class="fw-bold mb-3">Quick Actions</h5>
            <div class="d-flex gap-3 flex-wrap">
                <a href="{{ route('experts') }}" class="btn btn-outline-primary rounded-pill px-4 py-2 fw-bold">
                    <i class="fa-solid fa-magnifying-glass me-2"></i> Find an Expert
                </a>
                <a href="{{ route('user.bookings') }}" class="btn btn-outline-secondary rounded-pill px-4 py-2 fw-bold">
                    <i class="fa-regular fa-calendar me-2"></i> View My Schedule
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
