@extends('layouts.app')
@section('content')
    <!-- Hero Banner Section -->
    <main class="about-hero-section ptb-70">
        <div class="bg-square">
            <img src="{{ asset('assets/images/banner-square-img.svg') }}" alt="" />
        </div>
        <div class="container">
            <div class="about-hero-container">
                <img src="{{ asset('assets/images/scholarship-page-banner-img.png') }}" alt="1:1 Mentorship" />

                <!-- Centered Badge / Content Block -->
                <div class="about-us-badge-wrapper">
                    <button class="about-us-badge">1:1 Mentorship & Career Guidance</button>
                    <p>Connect with India's top alumni, industry leaders & expert counselors for personalized career direction.</p>
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
                    <li class="breadcrumb-item active text-primary" aria-current="page">Mentors</li>
                </ol>
            </nav>
        </div>
    </div>

    <!-- Main Content Section -->
    <div style="background-color: #FAFBFD; padding: 50px 0;">
        <div class="container">
            
            <!-- Search & Filter Card Header -->
            <div class="sb-filter-card mb-5">
                <div class="sb-filter-header">
                    <div>
                        <h1 class="sb-filter-title">Find Your Perfect Mentor</h1>
                        <p class="sb-filter-subtitle">Filter by domain, target college, or expertise</p>
                    </div>
                </div>

                <!-- Search Input Bar -->
                <form action="#" method="GET" class="row g-3 align-items-center mb-4">
                    <div class="col-md-6">
                        <div class="input-group">
                            <span class="input-group-text bg-white border-end-0"><i class="fa-solid fa-magnifying-glass text-muted"></i></span>
                            <input type="text" class="form-control border-start-0 ps-0" placeholder="Search mentor name, domain (e.g. MBA, Tech, Study Abroad)...">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <select class="form-select">
                            <option selected>All Expertise Domains</option>
                            <option>MBA & Business Prep</option>
                            <option>Engineering & Tech</option>
                            <option>Study Abroad Guidance</option>
                            <option>School Admissions</option>
                            <option>Career Transition</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <button type="submit" class="btn btn-enrollzy w-100">
                            Filter Mentors <i class="fa-solid fa-arrow-right-long ms-1"></i>
                        </button>
                    </div>
                </form>

                <!-- Category Quick Pills -->
                <div class="d-flex flex-wrap gap-2 pt-2 border-top">
                    <span class="text-muted fw-bold me-2 align-self-center" style="font-size: 13px;">Popular:</span>
                    <a href="#" class="badge bg-light text-dark border rounded-pill px-3 py-2 text-decoration-none">CAT / IIM Prep</a>
                    <a href="#" class="badge bg-light text-dark border rounded-pill px-3 py-2 text-decoration-none">JEE Mains & Advanced</a>
                    <a href="#" class="badge bg-light text-dark border rounded-pill px-3 py-2 text-decoration-none">Product Management</a>
                    <a href="#" class="badge bg-light text-dark border rounded-pill px-3 py-2 text-decoration-none">US / UK Admissions</a>
                    <a href="#" class="badge bg-light text-dark border rounded-pill px-3 py-2 text-decoration-none">Mock Interview Prep</a>
                </div>
            </div>

            <!-- Mentors Grid -->
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-2 row-cols-lg-4 g-4 mb-5">
                
                <!-- Mentor Card 1 -->
                <div class="col">
                    <div class="mentor-card h-100 d-flex flex-column shadow-sm rounded-4 bg-white overflow-hidden border">
                        <div class="mentor-img-wrapper position-relative" style="height: 240px; overflow: hidden; background-color: #f1f5f9;">
                            <img src="{{ asset('assets/images/mentor1.png') }}" alt="Aarav Sharma" style="width: 100%; height: 100%; object-fit: cover;">
                            <span class="badge bg-success position-absolute top-0 end-0 m-3 px-3 py-2 rounded-pill shadow-sm" style="font-size: 11px;">
                                <i class="fa-solid fa-circle me-1" style="font-size: 8px;"></i> Available Today
                            </span>
                        </div>
                        <div class="mentor-card-body p-4 text-center d-flex flex-column flex-grow-1">
                            <h3 class="mentor-name fw-bold fs-5 mb-1 text-dark">Aarav Sharma</h3>
                            <p class="mentor-title text-primary fw-semibold mb-2" style="font-size: 13px;">Senior Product Manager @ Google</p>
                            <p class="text-muted mb-3" style="font-size: 12px;"><i class="fa-solid fa-graduation-cap me-1"></i> IIM Ahmedabad Alumni</p>

                            <div class="mentor-badges d-flex flex-wrap justify-content-center gap-1 mb-3">
                                <span class="badge bg-light text-primary border" style="font-size: 11px;">MBA Prep</span>
                                <span class="badge bg-light text-dark border" style="font-size: 11px;">Product</span>
                                <span class="badge bg-light text-success border" style="font-size: 11px;">Mock Interview</span>
                            </div>

                            <div class="d-flex justify-content-between align-items-center mb-3 mentor-stats px-2 py-2 rounded-3 bg-light" style="font-size: 12px;">
                                <div class="text-warning fw-bold">
                                    <i class="fa-solid fa-star"></i> 4.9 <span class="text-muted font-normal">(140 reviews)</span>
                                </div>
                                <span class="text-muted fw-semibold">320+ Sessions</span>
                            </div>

                            <div class="d-flex justify-content-between align-items-center mt-auto pt-3 border-top">
                                <div class="mentor-price text-start">
                                    <span class="fs-5 fw-bold text-dark">₹499</span><span class="text-muted" style="font-size: 11px;"> /30 mins</span>
                                </div>
                                <a href="{{ route('mentor.detail', 1) }}" class="btn btn-enrollzy btn-enrollzy-sm rounded-pill">
                                    Book Session <i class="fa-solid fa-arrow-right-long ms-1"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Mentor Card 2 -->
                <div class="col">
                    <div class="mentor-card h-100 d-flex flex-column shadow-sm rounded-4 bg-white overflow-hidden border">
                        <div class="mentor-img-wrapper position-relative" style="height: 240px; overflow: hidden; background-color: #f1f5f9;">
                            <img src="{{ asset('assets/images/mentor_1.png') }}" alt="Priya Verma" style="width: 100%; height: 100%; object-fit: cover;">
                            <span class="badge bg-success position-absolute top-0 end-0 m-3 px-3 py-2 rounded-pill shadow-sm" style="font-size: 11px;">
                                <i class="fa-solid fa-circle me-1" style="font-size: 8px;"></i> Available Today
                            </span>
                        </div>
                        <div class="mentor-card-body p-4 text-center d-flex flex-column flex-grow-1">
                            <h3 class="mentor-name fw-bold fs-5 mb-1 text-dark">Priya Verma</h3>
                            <p class="mentor-title text-primary fw-semibold mb-2" style="font-size: 13px;">Lead Admissions Counselor</p>
                            <p class="text-muted mb-3" style="font-size: 12px;"><i class="fa-solid fa-graduation-cap me-1"></i> Ex-Harvard Scholar</p>

                            <div class="mentor-badges d-flex flex-wrap justify-content-center gap-1 mb-3">
                                <span class="badge bg-light text-primary border" style="font-size: 11px;">Study Abroad</span>
                                <span class="badge bg-light text-dark border" style="font-size: 11px;">SOP Review</span>
                                <span class="badge bg-light text-success border" style="font-size: 11px;">Scholarships</span>
                            </div>

                            <div class="d-flex justify-content-between align-items-center mb-3 mentor-stats px-2 py-2 rounded-3 bg-light" style="font-size: 12px;">
                                <div class="text-warning fw-bold">
                                    <i class="fa-solid fa-star"></i> 5.0 <span class="text-muted font-normal">(98 reviews)</span>
                                </div>
                                <span class="text-muted fw-semibold">210+ Sessions</span>
                            </div>

                            <div class="d-flex justify-content-between align-items-center mt-auto pt-3 border-top">
                                <div class="mentor-price text-start">
                                    <span class="fs-5 fw-bold text-dark">₹699</span><span class="text-muted" style="font-size: 11px;"> /30 mins</span>
                                </div>
                                <a href="{{ route('mentor.detail', 2) }}" class="btn btn-enrollzy btn-enrollzy-sm rounded-pill">
                                    Book Session <i class="fa-solid fa-arrow-right-long ms-1"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Mentor Card 3 -->
                <div class="col">
                    <div class="mentor-card h-100 d-flex flex-column shadow-sm rounded-4 bg-white overflow-hidden border">
                        <div class="mentor-img-wrapper position-relative" style="height: 240px; overflow: hidden; background-color: #f1f5f9;">
                            <img src="{{ asset('assets/images/mentor_2.png') }}" alt="Rohan Kulkarni" style="width: 100%; height: 100%; object-fit: cover;">
                        </div>
                        <div class="mentor-card-body p-4 text-center d-flex flex-column flex-grow-1">
                            <h3 class="mentor-name fw-bold fs-5 mb-1 text-dark">Rohan Kulkarni</h3>
                            <p class="mentor-title text-primary fw-semibold mb-2" style="font-size: 13px;">Software Architect @ Microsoft</p>
                            <p class="text-muted mb-3" style="font-size: 12px;"><i class="fa-solid fa-graduation-cap me-1"></i> IIT Bombay Alumni</p>

                            <div class="mentor-badges d-flex flex-wrap justify-content-center gap-1 mb-3">
                                <span class="badge bg-light text-primary border" style="font-size: 11px;">JEE Adv</span>
                                <span class="badge bg-light text-dark border" style="font-size: 11px;">Tech Careers</span>
                                <span class="badge bg-light text-success border" style="font-size: 11px;">Coding</span>
                            </div>

                            <div class="d-flex justify-content-between align-items-center mb-3 mentor-stats px-2 py-2 rounded-3 bg-light" style="font-size: 12px;">
                                <div class="text-warning fw-bold">
                                    <i class="fa-solid fa-star"></i> 4.8 <span class="text-muted font-normal">(112 reviews)</span>
                                </div>
                                <span class="text-muted fw-semibold">270+ Sessions</span>
                            </div>

                            <div class="d-flex justify-content-between align-items-center mt-auto pt-3 border-top">
                                <div class="mentor-price text-start">
                                    <span class="fs-5 fw-bold text-dark">₹399</span><span class="text-muted" style="font-size: 11px;"> /30 mins</span>
                                </div>
                                <a href="{{ route('mentor.detail', 3) }}" class="btn btn-enrollzy btn-enrollzy-sm rounded-pill">
                                    Book Session <i class="fa-solid fa-arrow-right-long ms-1"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Mentor Card 4 -->
                <div class="col">
                    <div class="mentor-card h-100 d-flex flex-column shadow-sm rounded-4 bg-white overflow-hidden border">
                        <div class="mentor-img-wrapper position-relative" style="height: 240px; overflow: hidden; background-color: #f1f5f9;">
                            <img src="{{ asset('assets/images/mentor1.png') }}" alt="Neha Kapoor" style="width: 100%; height: 100%; object-fit: cover;">
                        </div>
                        <div class="mentor-card-body p-4 text-center d-flex flex-column flex-grow-1">
                            <h3 class="mentor-name fw-bold fs-5 mb-1 text-dark">Neha Kapoor</h3>
                            <p class="mentor-title text-primary fw-semibold mb-2" style="font-size: 13px;">School Admissions Expert</p>
                            <p class="text-muted mb-3" style="font-size: 12px;"><i class="fa-solid fa-graduation-cap me-1"></i> 12+ Yrs Experience</p>

                            <div class="mentor-badges d-flex flex-wrap justify-content-center gap-1 mb-3">
                                <span class="badge bg-light text-primary border" style="font-size: 11px;">Boarding Schools</span>
                                <span class="badge bg-light text-dark border" style="font-size: 11px;">CBSE / ICSE</span>
                                <span class="badge bg-light text-success border" style="font-size: 11px;">Child Guidance</span>
                            </div>

                            <div class="d-flex justify-content-between align-items-center mb-3 mentor-stats px-2 py-2 rounded-3 bg-light" style="font-size: 12px;">
                                <div class="text-warning fw-bold">
                                    <i class="fa-solid fa-star"></i> 4.9 <span class="text-muted font-normal">(85 reviews)</span>
                                </div>
                                <span class="text-muted fw-semibold">190+ Sessions</span>
                            </div>

                            <div class="d-flex justify-content-between align-items-center mt-auto pt-3 border-top">
                                <div class="mentor-price text-start">
                                    <span class="fs-5 fw-bold text-dark">₹450</span><span class="text-muted" style="font-size: 11px;"> /30 mins</span>
                                </div>
                                <a href="{{ route('mentor.detail', 4) }}" class="btn btn-enrollzy btn-enrollzy-sm rounded-pill">
                                    Book Session <i class="fa-solid fa-arrow-right-long ms-1"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Why Choose 1:1 Mentorship Section -->
            <div class="bg-white rounded-4 p-4 p-md-5 border shadow-sm">
                <div class="text-center mb-4">
                    <span class="badge bg-primary-subtle text-primary rounded-pill px-3 py-2 mb-2 font-semibold">Why Choose Enrollzy Mentors?</span>
                    <h2 class="section-title">Get Answers Built For Your Future</h2>
                </div>
                <div class="row g-4 text-center">
                    <div class="col-md-3">
                        <div class="p-3">
                            <div class="rounded-circle bg-primary bg-opacity-10 text-primary mx-auto mb-3 d-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
                                <i class="fa-solid fa-shield-halved fs-4"></i>
                            </div>
                            <h5 class="fw-bold fs-6">100% Verified Mentors</h5>
                            <p class="text-muted" style="font-size: 13px;">Background verified credentials from top universities and global companies.</p>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="p-3">
                            <div class="rounded-circle bg-warning bg-opacity-10 text-warning mx-auto mb-3 d-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
                                <i class="fa-solid fa-video fs-4"></i>
                            </div>
                            <h5 class="fw-bold fs-6">Live 1:1 Video Calls</h5>
                            <p class="text-muted" style="font-size: 13px;">Interactive live sessions with screen sharing and resume feedback.</p>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="p-3">
                            <div class="rounded-circle bg-success bg-opacity-10 text-success mx-auto mb-3 d-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
                                <i class="fa-solid fa-calendar-check fs-4"></i>
                            </div>
                            <h5 class="fw-bold fs-6">Instant Booking</h5>
                            <p class="text-muted" style="font-size: 13px;">Select convenient date & time slots that fit your daily schedule.</p>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="p-3">
                            <div class="rounded-circle bg-info bg-opacity-10 text-info mx-auto mb-3 d-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
                                <i class="fa-solid fa-handshake-angle fs-4"></i>
                            </div>
                            <h5 class="fw-bold fs-6">Satisfaction Guarantee</h5>
                            <p class="text-muted" style="font-size: 13px;">Full support and refund policy if your booking requirement is not met.</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
