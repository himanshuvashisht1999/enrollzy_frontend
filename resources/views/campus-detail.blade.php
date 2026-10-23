@extends('layouts.app')

@section('content')
    <main class="about-hero-section ptb-70">
        <div class="bg-square">
            <img src="{{ asset('assets/images/banner-square-img.svg') }}" alt="" />
        </div>
        <div class="container">
            <div class="about-hero-container" style="position: relative; overflow: hidden; border-radius: 20px;">
                <img src="{{ $campus->organisation && $campus->organisation->cover_image_url ? (str_starts_with($campus->organisation->cover_image_url, 'http') ? $campus->organisation->cover_image_url : rtrim(env('BACKEND_URL', 'http://127.0.0.1:8001'), '/') . '/' . ltrim($campus->organisation->cover_image_url, '/')) : asset('assets/images/school-detail-banner-img.png') }}"
                    alt="{{ $campus->campus_name }}" style="width: 100%; height: 400px; object-fit: cover;" />

                <!-- Centered Badge -->
                <div class="about-us-badge-wrapper" style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); text-align: center; color: white;">
                    <button class="about-us-badge" style="background: rgba(255, 255, 255, 0.9); border: none; padding: 10px 20px; border-radius: 30px; font-weight: bold; font-size: 24px; color: #333;">
                        {{ mb_strtoupper($campus->campus_name) }}
                    </button>
                    <p class="mt-3" style="font-size: 18px; text-shadow: 1px 1px 4px rgba(0,0,0,0.8);"><i class="fa-solid fa-location-dot me-1"></i>
                        {{ $campus->city }}, {{ $campus->state }}
                    </p>
                </div>
            </div>
        </div>
    </main>

    <!-- Breadcrumbs navigation -->
    <div class="py-3" style="background-color: #f9ad0b14">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0" style="font-size: 14px; font-weight: 500">
                    <li class="breadcrumb-item">
                        <a href="{{ route('home') }}" class="text-decoration-none text-muted"><i
                                class="fa-solid fa-house me-1"></i>
                            Home</a>
                    </li>
                    <li class="breadcrumb-item active text-primary" aria-current="page">{{ $campus->campus_name }}</li>
                </ol>
            </nav>
        </div>
    </div>

    <!-- Main Content wrapper -->
    <div class="container py-5">
        <div class="row">
            <div class="col-lg-8">
                <div class="card shadow-sm border-0 mb-4 rounded-4">
                    <div class="card-body p-4">
                        <h3 class="fw-bold mb-3">About {{ $campus->campus_name }}</h3>
                        <p class="text-muted" style="line-height: 1.8;">
                            {!! $campus->about_institute ?: 'No detailed information available for this campus.' !!}
                        </p>
                        
                        <h4 class="fw-bold mt-5 mb-3">Campus Infrastructure</h4>
                        <div class="row g-4 mt-2">
                            <div class="col-md-4">
                                <div class="d-flex align-items-center">
                                    <div class="bg-light rounded p-3 me-3 text-primary">
                                        <i class="fas fa-building fa-2x"></i>
                                    </div>
                                    <div>
                                        <h6 class="mb-0 fw-bold">Area</h6>
                                        <small class="text-muted">{{ $campus->campus_area_acres ?: 'N/A' }} {{ $campus->campus_area_unit }}</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="d-flex align-items-center">
                                    <div class="bg-light rounded p-3 me-3 text-primary">
                                        <i class="fas fa-chalkboard-teacher fa-2x"></i>
                                    </div>
                                    <div>
                                        <h6 class="mb-0 fw-bold">Classrooms</h6>
                                        <small class="text-muted">{{ $campus->classrooms_count ?: 'N/A' }}</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="d-flex align-items-center">
                                    <div class="bg-light rounded p-3 me-3 text-primary">
                                        <i class="fas fa-book-reader fa-2x"></i>
                                    </div>
                                    <div>
                                        <h6 class="mb-0 fw-bold">Library</h6>
                                        <small class="text-muted">{{ $campus->library_available ? 'Available' : 'N/A' }}</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4">
                <div class="card shadow-sm border-0 rounded-4">
                    <div class="card-body p-4">
                        <h5 class="fw-bold mb-4">Contact Info</h5>
                        <ul class="list-unstyled mb-0">
                            <li class="mb-3 d-flex">
                                <i class="fas fa-map-marker-alt text-primary mt-1 me-3"></i>
                                <span class="text-muted">{{ $campus->full_address }}</span>
                            </li>
                            <li class="mb-3 d-flex">
                                <i class="fas fa-envelope text-primary mt-1 me-3"></i>
                                <span class="text-muted">{{ $campus->campus_email ?: 'N/A' }}</span>
                            </li>
                            @if($campus->campus_website)
                            <li class="mb-3 d-flex">
                                <i class="fas fa-globe text-primary mt-1 me-3"></i>
                                <a href="{{ $campus->campus_website }}" target="_blank" class="text-decoration-none">{{ $campus->campus_website }}</a>
                            </li>
                            @endif
                        </ul>
                        <button class="btn btn-primary w-100 mt-3 py-2 rounded-3 fw-bold">Apply Now</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
