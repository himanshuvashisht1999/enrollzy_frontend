@extends('layouts.app')
@section('content')
    <!-- Profile Header Banner -->
    <main class="about-hero-section ptb-70">
        <div class="bg-square">
            <img src="{{ asset('assets/images/banner-square-img.svg') }}" alt="" />
        </div>
        <div class="container">
            <div class="about-hero-container">
                <img src="{{ asset('assets/images/scholarship-page-banner-img.png') }}" alt="Mentor Profile" />

                <!-- Centered Badge / Profile Tag -->
                <div class="about-us-badge-wrapper">
                    <button class="about-us-badge"><i class="fa-solid fa-circle-check text-warning me-1"></i> Verified Expert Mentor</button>
                    <p>Aarav Sharma — Senior Product Manager @ Google | IIM Ahmedabad Alumni</p>
                </div>

                <!-- Green Down Arrow Button -->
                <button class="about-scroll-btn" aria-label="Scroll Down">
                    <img style="width: 49px; height: 62px" src="{{ asset('assets/images/inner-banner-down-arror.png') }}" alt="" />
                </button>
            </div>
        </div>
    </main>

    <!-- Breadcrumb -->
    <div class="py-3" style="background-color: #f9ad0b14">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0" style="font-size: 13.5px; font-weight: 500;">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-decoration-none text-muted"><i class="fa-solid fa-house me-1"></i> Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('mentors') }}" class="text-decoration-none text-muted">Mentors</a></li>
                    <li class="breadcrumb-item active text-primary" aria-current="page">Aarav Sharma</li>
                </ol>
            </nav>
        </div>
    </div>

    <!-- Main Detail Section -->
    <div style="background-color: #FAFBFD; padding: 50px 0;">
        <div class="container">
            <div class="row g-4">
                
                <!-- Left Column: Profile Bio & Details -->
                <div class="col-lg-8">
                    
                    <!-- Profile Summary Header Card -->
                    <div class="bg-white rounded-4 p-4 p-md-5 border shadow-sm mb-4">
                        <div class="d-flex flex-column flex-md-row align-items-center align-items-md-start gap-4">
                            <div class="position-relative">
                                <img src="{{ asset('assets/images/mentor1.png') }}" alt="Aarav Sharma" class="rounded-circle border border-4 border-white shadow-sm" style="width: 130px; height: 130px; object-fit: cover;">
                                <span class="badge bg-success position-absolute bottom-0 end-0 px-2 py-1 rounded-pill" style="font-size: 10px;">
                                    <i class="fa-solid fa-check"></i> Verified
                                </span>
                            </div>
                            <div class="text-center text-md-start flex-grow-1">
                                <h1 class="fw-bold fs-3 mb-1 text-dark">Aarav Sharma</h1>
                                <p class="text-primary fw-semibold mb-2 fs-6">Senior Product Manager @ Google</p>
                                <p class="text-muted mb-3" style="font-size: 14px;"><i class="fa-solid fa-graduation-cap me-1"></i> IIM Ahmedabad (MBA, 2018) | Ex-Flipkart, Ex-Amazon</p>
                                
                                <div class="d-flex flex-wrap justify-content-center justify-content-md-start gap-3 border-top pt-3" style="font-size: 13px;">
                                    <div><i class="fa-solid fa-star text-warning me-1"></i><strong>4.9</strong> (140 Reviews)</div>
                                    <div><i class="fa-solid fa-users text-primary me-1"></i><strong>320+</strong> Sessions Completed</div>
                                    <div><i class="fa-solid fa-briefcase text-success me-1"></i><strong>8+ Yrs</strong> Experience</div>
                                    <div><i class="fa-solid fa-language text-info me-1"></i> English, Hindi</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- About Me Card -->
                    <div class="bg-white rounded-4 p-4 p-md-5 border shadow-sm mb-4">
                        <h2 class="fs-4 fw-bold mb-3 text-dark"><i class="fa-solid fa-user me-2 text-primary"></i> About Me</h2>
                        <p class="text-muted leading-relaxed mb-4">
                            Hi! I am Aarav. I have over 8 years of experience in product strategy, consumer tech, and business operations. Having cleared CAT with a 99.8 percentile and graduated from IIM Ahmedabad, I have mentored 300+ students for top B-school admissions, GD-PI rounds, and Product Management transitions.
                        </p>
                        <p class="text-muted leading-relaxed mb-0">
                            Whether you need guidance on CAT preparation strategies, SOP and resume reviews, mock interviews, or career advice on breaking into top tech companies — I am here to help you navigate your journey with confidence!
                        </p>
                    </div>

                    <!-- Expertise Tags Card -->
                    <div class="bg-white rounded-4 p-4 p-md-5 border shadow-sm mb-4">
                        <h2 class="fs-4 fw-bold mb-3 text-dark"><i class="fa-solid fa-tags me-2 text-primary"></i> Areas of Expertise</h2>
                        <div class="d-flex flex-wrap gap-2">
                            <span class="badge bg-primary-subtle text-primary border rounded-pill px-3 py-2 fs-6">CAT / MBA Prep</span>
                            <span class="badge bg-warning-subtle text-dark border rounded-pill px-3 py-2 fs-6">IIM Interview Prep</span>
                            <span class="badge bg-success-subtle text-success border rounded-pill px-3 py-2 fs-6">Product Management</span>
                            <span class="badge bg-info-subtle text-info border rounded-pill px-3 py-2 fs-6">Resume & SOP Review</span>
                            <span class="badge bg-secondary-subtle text-dark border rounded-pill px-3 py-2 fs-6">Case Studies</span>
                            <span class="badge bg-danger-subtle text-danger border rounded-pill px-3 py-2 fs-6">Career Transition</span>
                        </div>
                    </div>

                    <!-- Education & Work Experience Card -->
                    <div class="bg-white rounded-4 p-4 p-md-5 border shadow-sm mb-4">
                        <h2 class="fs-4 fw-bold mb-4 text-dark"><i class="fa-solid fa-briefcase me-2 text-primary"></i> Work & Education History</h2>
                        
                        <div class="border-start border-3 border-primary ps-4 mb-4">
                            <h3 class="fs-6 fw-bold mb-1">Senior Product Manager — Google</h3>
                            <p class="text-muted mb-1" style="font-size: 13px;">2021 – Present | Bengaluru, India</p>
                            <p class="text-muted mb-0" style="font-size: 13px;">Leading core search & growth initiatives across APAC region.</p>
                        </div>

                        <div class="border-start border-3 border-secondary ps-4 mb-4">
                            <h3 class="fs-6 fw-bold mb-1">Product Manager — Flipkart</h3>
                            <p class="text-muted mb-1" style="font-size: 13px;">2018 – 2021 | Bengaluru, India</p>
                            <p class="text-muted mb-0" style="font-size: 13px;">Managed checkout conversion and payment funnel optimization.</p>
                        </div>

                        <div class="border-start border-3 border-warning ps-4">
                            <h3 class="fs-6 fw-bold mb-1">MBA (Post Graduate Diploma in Management) — IIM Ahmedabad</h3>
                            <p class="text-muted mb-1" style="font-size: 13px;">2016 – 2018 | Ahmedabad, India</p>
                            <p class="text-muted mb-0" style="font-size: 13px;">Specialization in Marketing & Strategy. CAT Percentile: 99.8%ile.</p>
                        </div>
                    </div>

                    <!-- Reviews & Feedback Card -->
                    <div class="bg-white rounded-4 p-4 p-md-5 border shadow-sm">
                        <h2 class="fs-4 fw-bold mb-4 text-dark"><i class="fa-solid fa-comments me-2 text-primary"></i> Student Reviews</h2>
                        
                        <div class="border-bottom pb-3 mb-3">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="fw-bold text-dark">Karan Malhotra</span>
                                <span class="text-warning" style="font-size: 12px;"><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i></span>
                            </div>
                            <p class="text-muted mb-0" style="font-size: 13px;">"Aarav sir gave me invaluable advice for my IIM Bangalore interview. His mock interview format was identical to the actual interview!"</p>
                        </div>

                        <div class="border-bottom pb-3 mb-3">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="fw-bold text-dark">Sneha Patel</span>
                                <span class="text-warning" style="font-size: 12px;"><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i></span>
                            </div>
                            <p class="text-muted mb-0" style="font-size: 13px;">"Got my resume reviewed by Aarav. The feedback was super actionable and helped me land product interviews!"</p>
                        </div>
                    </div>

                </div>

                <!-- Right Column: Booking Box Widget -->
                <div class="col-lg-4">
                    <div class="sticky-top" style="top: 100px;">
                        <div class="bg-white rounded-4 p-4 border shadow-sm">
                            <h3 class="fs-5 fw-bold mb-3 text-dark">Book 1:1 Session</h3>
                            
                            <div class="p-3 bg-light rounded-3 mb-3">
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="text-muted fw-medium" style="font-size: 14px;">Session Fee</span>
                                    <span class="fs-4 fw-bold text-primary">₹499 <small class="text-muted fs-6">/30 mins</small></span>
                                </div>
                            </div>

                            <form action="#" method="POST" class="mb-3">
                                <div class="mb-3">
                                    <label class="form-label fw-bold" style="font-size: 13px;">Select Session Type</label>
                                    <select class="form-select">
                                        <option selected>1:1 Career Guidance (30 mins)</option>
                                        <option>Mock Interview & Feedback (45 mins)</option>
                                        <option>Resume & SOP Review (60 mins)</option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-bold" style="font-size: 13px;">Select Preferred Date</label>
                                    <input type="date" class="form-control" value="{{ date('Y-m-d') }}">
                                </div>

                                <div class="mb-4">
                                    <label class="form-label fw-bold" style="font-size: 13px;">Select Available Time Slot</label>
                                    <div class="row g-2">
                                        <div class="col-6"><button type="button" class="btn btn-outline-primary w-100 btn-sm active">04:00 PM</button></div>
                                        <div class="col-6"><button type="button" class="btn btn-outline-primary w-100 btn-sm">05:30 PM</button></div>
                                        <div class="col-6"><button type="button" class="btn btn-outline-primary w-100 btn-sm">07:00 PM</button></div>
                                        <div class="col-6"><button type="button" class="btn btn-outline-primary w-100 btn-sm">08:30 PM</button></div>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-enrollzy btn-enrollzy-lg w-100 mb-2">
                                    Proceed To Book <i class="fa-solid fa-arrow-right-long ms-1"></i>
                                </button>
                            </form>

                            <div class="text-center text-muted" style="font-size: 11px;">
                                <i class="fa-solid fa-lock me-1"></i> 100% Secure Payment & Satisfaction Refund Guarantee
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
