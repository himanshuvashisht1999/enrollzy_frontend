@extends('layouts.app')

@section('content')
<div class="container py-5" style="margin-top: 80px;">
    <div class="row">
        <!-- Sidebar -->
        <div class="col-md-3 mb-4">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body p-0">
                    <div class="p-4 text-center border-bottom bg-light rounded-top-4">
                        <div class="bg-primary text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-2" style="width: 60px; height: 60px; font-size: 24px;">
                            {{ strtoupper(substr(auth()->user()->name ?? 'U', 0, 1)) }}
                        </div>
                        <h5 class="fw-bold mb-0">{{ auth()->user()->name ?? 'User' }}</h5>
                        <p class="text-muted small mb-0">{{ auth()->user()->email }}</p>
                    </div>
                    <div class="list-group list-group-flush rounded-bottom-4">
                        <a href="{{ route('user.dashboard') }}" class="list-group-item list-group-item-action py-3 border-0 {{ request()->routeIs('user.dashboard') ? 'active fw-bold' : '' }}">
                            <i class="fa-solid fa-gauge me-2"></i> Dashboard Overview
                        </a>
                        <a href="{{ route('user.bookings') }}" class="list-group-item list-group-item-action py-3 border-0 {{ request()->routeIs('user.bookings') ? 'active fw-bold' : '' }}">
                            <i class="fa-solid fa-calendar-check me-2"></i> My Bookings
                        </a>
                        <a href="{{ route('user.profile') }}" class="list-group-item list-group-item-action py-3 border-0 {{ request()->routeIs('user.profile') ? 'active fw-bold' : '' }}">
                            <i class="fa-solid fa-user-pen me-2"></i> Edit Profile
                        </a>
                        <form action="{{ route('logout') }}" method="POST" class="m-0">
                            @csrf
                            <button type="submit" class="list-group-item list-group-item-action py-3 border-0 text-danger rounded-bottom-4">
                                <i class="fa-solid fa-right-from-bracket me-2"></i> Logout
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="col-md-9">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm" role="alert">
                    <i class="fa-solid fa-circle-check me-2"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm" role="alert">
                    <i class="fa-solid fa-circle-exclamation me-2"></i> {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @yield('dashboard_content')
        </div>
    </div>
</div>
@endsection
