@extends('layouts.app')

@section('meta_title', $benefit->title . ' - Scholarships & Benefits | Enrollzy')
@section('meta_description', Str::limit(strip_tags($benefit->content), 160))

@section('content')
<main>
    <!-- Breadcrumb path -->
    <div class="py-3" style="background-color: #f9ad0b14">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0" style="font-size: 13.5px; font-weight: 500;">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-decoration-none text-muted"><i class="fa-solid fa-house me-1"></i> Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('scholarships') }}" class="text-decoration-none text-muted">Scholarships & Benefits</a></li>
                    <li class="breadcrumb-item active text-primary" aria-current="page">{{ Str::limit($benefit->title, 35) }}</li>
                </ol>
            </nav>
        </div>
    </div>

    <!-- Scholarship Detail Header -->
    <section class="py-5" style="background: linear-gradient(135deg, #0F59C7 0%, #083880 100%); color: #fff;">
        <div class="container">
            <div class="row align-items-center g-4">
                <div class="col-lg-8">
                    <div class="d-flex flex-wrap align-items-center gap-2 mb-3">
                        <span class="badge bg-success px-3 py-2 rounded-pill"><i class="fa-solid fa-circle-check me-1"></i> Verified Program</span>
                        <span class="badge bg-warning text-dark px-3 py-2 rounded-pill"><i class="fa-solid fa-lightbulb me-1"></i> {{ $benefit->reward_amount ?: 'Up to INR 30,000' }}</span>
                    </div>
                    <h1 class="display-6 fw-bold mb-3">{{ $benefit->title }}</h1>
                    <p class="lead text-white-50 mb-4" style="max-width: 750px;">
                        Explore complete eligibility requirements, financial aid details, and step-by-step application guidance for this student benefit program.
                    </p>
                    <div class="d-flex flex-wrap gap-3">
                        <a href="#applySection" class="btn btn-warning btn-lg fw-bold text-dark px-4 rounded-pill">
                            <i class="fa-solid fa-paper-plane me-2"></i> Apply for Assistance
                        </a>
                        <a href="{{ route('scholarships') }}" class="btn btn-outline-light btn-lg px-4 rounded-pill">
                            <i class="fa-solid fa-arrow-left me-2"></i> Back to Scholarships
                        </a>
                    </div>
                </div>
                <div class="col-lg-4 text-center">
                    <div class="p-4 bg-white rounded-4 shadow text-dark d-inline-block w-100" style="max-width: 320px;">
                        <img src="{{ $benefit->icon ? (str_starts_with($benefit->icon, 'http') ? $benefit->icon : (file_exists(public_path($benefit->icon)) ? asset($benefit->icon) : rtrim(env('BACKEND_URL', 'http://127.0.0.1:8001'), '/') . '/' . ltrim($benefit->icon, '/'))) : asset('assets/images/scholarship-card-img.png') }}" alt="{{ $benefit->title }}" class="img-fluid mb-3" style="max-height: 120px; object-fit: contain;">
                        <h6 class="text-muted small text-uppercase fw-bold mb-1">Benefit Reward</h6>
                        <div class="h3 fw-bold text-primary mb-3">{{ $benefit->reward_amount ?: 'Up to INR 30,000' }}</div>
                        <a href="#applySection" class="btn btn-enrollzy btn-enrollzy-sm w-100">Get Free Assistance</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Main Content Body -->
    <section class="py-5" style="background-color: #FAFBFD;">
        <div class="container">
            <div class="row g-4">
                <!-- Main Detail Column -->
                <div class="col-lg-8">
                    <!-- Overview Card -->
                    <div class="card border-0 shadow-sm rounded-4 mb-4">
                        <div class="card-body p-4 p-md-5">
                            <h3 class="fw-bold text-dark mb-4 pb-2 border-bottom">
                                <i class="fa-solid fa-circle-info text-primary me-2"></i> Program Overview
                            </h3>
                            <div class="fs-6 text-secondary lh-lg mb-4">
                                {!! nl2br(e($benefit->content)) !!}
                            </div>

                            <div class="p-4 rounded-4 bg-light border mb-4">
                                <h5 class="fw-bold text-dark mb-3"><i class="fa-solid fa-list-check text-success me-2"></i> Key Highlights</h5>
                                <ul class="list-unstyled mb-0 d-grid gap-2">
                                    <li class="d-flex align-items-start gap-2">
                                        <i class="fa-solid fa-check-circle text-success mt-1"></i>
                                        <span>Direct guidance for application and documentation requirements.</span>
                                    </li>
                                    <li class="d-flex align-items-start gap-2">
                                        <i class="fa-solid fa-check-circle text-success mt-1"></i>
                                        <span>Available for eligible school, competitive exam, and university students.</span>
                                    </li>
                                    <li class="d-flex align-items-start gap-2">
                                        <i class="fa-solid fa-check-circle text-success mt-1"></i>
                                        <span>Expert 1:1 assistance from Enrollzy educational counselors.</span>
                                    </li>
                                </ul>
                            </div>

                            <h4 class="fw-bold text-dark mb-3"><i class="fa-solid fa-graduation-cap text-primary me-2"></i> Eligibility & Requirements</h4>
                            <p class="text-muted mb-4">
                                Eligibility is evaluated based on academic merit, current course level, and institution criteria. Interested students can submit their query below to receive personalized verification from our counseling team.
                            </p>

                            <h4 class="fw-bold text-dark mb-3"><i class="fa-solid fa-map-location-dot text-primary me-2"></i> Application Process</h4>
                            <ol class="ps-3 text-secondary lh-lg mb-0">
                                <li>Submit your application request form using the instant inquiry panel.</li>
                                <li>Our education advisor verifies your academic profile and eligibility.</li>
                                <li>Get step-by-step assistance in preparing documents and final submission.</li>
                            </ol>
                        </div>
                    </div>
                </div>

                <!-- Sidebar Inquiry Form -->
                <div class="col-lg-4" id="applySection">
                    <div class="card border-0 shadow-sm rounded-4 sticky-top" style="top: 90px;">
                        <div class="card-body p-4">
                            <h4 class="fw-bold text-dark mb-2">Apply for Assistance</h4>
                            <p class="text-muted small mb-4">Fill in your details to get instant assistance from an Enrollzy counselor.</p>

                            @if(session('success'))
                                <div class="alert alert-success border-0 small rounded-3 mb-3">
                                    <i class="fa-solid fa-circle-check me-1"></i> {{ session('success') }}
                                </div>
                            @endif

                            <form action="{{ route('contact.submit') }}" method="POST">
                                @csrf
                                <input type="hidden" name="subject" value="Scholarship Inquiry: {{ $benefit->title }}">
                                <div class="mb-3">
                                    <label class="form-label fw-semibold small text-muted">Full Name *</label>
                                    <input type="text" name="name" class="form-control" required placeholder="Enter your full name">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-semibold small text-muted">Mobile Number *</label>
                                    <input type="tel" name="phone" class="form-control" required placeholder="e.g. 9876543210">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-semibold small text-muted">Email Address *</label>
                                    <input type="email" name="email" class="form-control" required placeholder="name@example.com">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-semibold small text-muted">Message / Education Level</label>
                                    <textarea name="message" class="form-control" rows="3" placeholder="e.g. Currently in Class 12, seeking scholarship guidance..."></textarea>
                                </div>
                                <button type="submit" class="btn btn-enrollzy w-100 py-2">
                                    Submit Application Request <i class="fa-solid fa-paper-plane ms-2"></i>
                                </button>
                            </form>

                            <hr class="my-4">
                            <div class="d-flex align-items-center gap-3">
                                <div class="rounded-circle bg-light p-3 text-primary">
                                    <i class="fa-solid fa-headset fa-xl"></i>
                                </div>
                                <div>
                                    <div class="fw-bold small text-dark">Need Immediate Guidance?</div>
                                    <div class="text-muted small">Our counselors are online 9 AM - 7 PM</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Related Scholarships -->
            @if(isset($relatedBenefits) && $relatedBenefits->count() > 0)
            <div class="mt-5 pt-4 border-top">
                <h3 class="fw-bold text-dark mb-4">Other Top Scholarships & Programs</h3>
                <div class="row row-cols-1 row-cols-md-3 g-4">
                    @foreach($relatedBenefits as $rel)
                    <div class="col">
                        <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden">
                            <div class="p-4 text-center bg-light border-bottom">
                                <img src="{{ $rel->icon ? (str_starts_with($rel->icon, 'http') ? $rel->icon : (file_exists(public_path($rel->icon)) ? asset($rel->icon) : rtrim(env('BACKEND_URL', 'http://127.0.0.1:8001'), '/') . '/' . ltrim($rel->icon, '/'))) : asset('assets/images/scholarship-card-img.png') }}" alt="{{ $rel->title }}" style="max-height: 80px; object-fit: contain;">
                            </div>
                            <div class="card-body p-4 d-flex flex-column">
                                <span class="badge bg-warning text-dark me-auto mb-2">{{ $rel->reward_amount ?: 'Up to INR 30,000' }}</span>
                                <h5 class="fw-bold text-dark mb-2">
                                    <a href="{{ route('scholarship.detail', $rel->id) }}" class="text-dark text-decoration-none">{{ Str::limit($rel->title, 45) }}</a>
                                </h5>
                                <p class="text-muted small flex-grow-1 mb-4">{{ Str::limit(strip_tags($rel->content), 90) }}</p>
                                <a href="{{ route('scholarship.detail', $rel->id) }}" class="btn btn-outline-primary btn-sm rounded-pill mt-auto">
                                    Learn More <i class="fa-solid fa-chevron-right ms-1" style="font-size: 10px;"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif
        </div>
    </section>
</main>
@endsection
