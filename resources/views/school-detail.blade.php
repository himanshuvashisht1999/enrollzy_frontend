@extends('layouts.app')

@section('content')
    <main class="about-hero-section ptb-70">
        <div class="bg-square">
            <img src="{{ asset('assets/images/banner-square-img.svg') }}" alt="" />
        </div>
        <div class="container">
            <div class="about-hero-container">
                <img src="{{ $school->cover_image_url ? (str_starts_with($school->cover_image_url, 'http') ? $school->cover_image_url : rtrim(env('BACKEND_URL', 'http://127.0.0.1:8001'), '/') . '/' . ltrim($school->cover_image_url, '/')) : asset('assets/images/school-detail-banner-img.png') }}"
                    alt="{{ $school->name }}" />

                <!-- Centered Badge -->
                <div class="about-us-badge-wrapper">
                    <button class="about-us-badge">{{ mb_strtoupper($school->name) }}</button>
                    <p><i class="fa-solid fa-location-dot me-1"></i>
                        {{ $location ?: ($school->head_office_location ?? 'India') }}</p>
                </div>

                <!-- Green Down Arrow Button -->
                <button class="about-scroll-btn" aria-label="Scroll Down">
                    <img style="width: 49px; height: 62px" src="{{ asset('assets/images/inner-banner-down-arror.png') }}"
                        alt="" />
                </button>
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
                    <li class="breadcrumb-item">
                        <a href="{{ route('all-schools') }}" class="text-decoration-none active text-primary">Schools</a>
                    </li>
                    <li class="breadcrumb-item active text-primary" aria-current="page">{{ $school->name }}</li>
                </ol>
            </nav>
        </div>
    </div>

    <!-- Main Content wrapper -->
    <div style="padding: 40px 0; padding-bottom: 0;">
        <div class="container">
            <!-- School Info Header Card -->
            <div class="sd-info-card">
                <div class="sd-title-row">
                    <div class="sd-title-box">
                        <h1 class="sd-title">{{ $school->name }}</h1>
                        <a href="#address-contact" class="sd-location"><i class="fa-solid fa-location-dot me-1"></i>
                            {{ $location ?: ($school->head_office_location ?? 'India') }}</a>
                    </div>
                    <span class="sd-status-badge">
                        <span class="sd-status-dot"></span> Status:
                        {{ $school->status == 1 ? 'Admissions Open' : 'Closed' }}
                    </span>
                </div>

                <div class="sd-meta-row">
                    <div class="sd-meta-item">
                        <i class="fa-solid fa-book-open"></i> Boards:
                        {{ !empty($boards) ? (is_array($boards) ? implode(', ', $boards) : $boards) : 'CBSE / International' }}
                    </div>
                    <div class="sd-meta-item">
                        <i class="fa-solid fa-graduation-cap"></i> Grades:
                        {{ !empty($grades) ? (is_array($grades) ? implode(', ', $grades) : $grades) : 'Primary to Higher Secondary' }}
                    </div>
                    <div class="sd-meta-item">
                        <i class="fa-solid fa-calendar-days"></i> Estd. {{ $school->established_year ?: 'N/A' }}
                    </div>
                </div>

                <div class="sd-views-row">
                    <i class="fa-regular fa-eye me-1"></i> {{ $school->total_reviews ?? '1,240' }} Views &nbsp;|&nbsp; <i
                        class="fa-solid fa-star text-warning me-1"></i> {{ $school->average_rating ?? '4.8' }} Rating
                </div>

                <h3 class="sd-about-title mt-4">About {{ $school->name }}</h3>
                <div class="sd-about-desc mb-0">
                    {!! $school->about_organisation ?: '<p>' . $school->name . ' is a premier educational institution committed to fostering academic excellence, holistic development, and character building.</p>' !!}
                </div>
            </div>
        </div>
    </div>

    <!-- Tab Pills Navigation -->
    <div style="background-color: #3771C812; padding: 20px 0px; margin-bottom: 40px;">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="sd-tab-navigation-wrapper">
                        <button class="sd-tab-nav-btn prev-btn" id="prevTabBtn" aria-label="Previous Tabs">
                            <i class="fa-solid fa-chevron-left"></i>
                        </button>
                        <div class="sd-tab-pills-row mb-0">
                            <button class="sd-tab-pill-btn active" data-tab-target="overview">Overview & Admission</button>
                            <button class="sd-tab-pill-btn" data-tab-target="admissions">Admission </button>
                            <button class="sd-tab-pill-btn" data-tab-target="fee-structure">Fee Structure</button>
                            <button class="sd-tab-pill-btn" data-tab-target="photos">Photos & Gallery</button>
                            <button class="sd-tab-pill-btn" data-tab-target="reviews">Reviews</button>
                            <button class="sd-tab-pill-btn" data-tab-target="placement">Placement</button>
                            <button class="sd-tab-pill-btn" data-tab-target="courses">Courses</button>
                            <button class="sd-tab-pill-btn" data-tab-target="scholarships">Scholarships</button>
                            <button class="sd-tab-pill-btn" data-tab-target="rankings">Rankings</button>
                            <button class="sd-tab-pill-btn" data-tab-target="nirf">NIRF Report</button>
                            <button class="sd-tab-pill-btn" data-tab-target="facilities">Facilities</button>
                            <button class="sd-tab-pill-btn" data-tab-target="gallery">Gallery</button>
                            <button class="sd-tab-pill-btn" data-tab-target="faculty">Faculty</button>
                            <button class="sd-tab-pill-btn" data-tab-target="routes">Admission Routes</button>
                        </div>
                        <button class="sd-tab-nav-btn next-btn" id="nextTabBtn" aria-label="Next Tabs">
                            <i class="fa-solid fa-chevron-right"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content Tab Containers -->
    <div class="school-detail-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 px-0">

                    <!-- Overview & Admission Section -->
                    <div class="sd-section-card" data-tab-content="overview">
                        <div class="row g-5">
                            <!-- Left Process Text -->
                            <div class="col-lg-7">
                                <h2 class="sd-section-title mb-4">Admission Process & Guidelines</h2>
                                <div style="font-size: 14px; line-height: 1.6; color: #4a5568">
                                    <p class="fw-bold mb-2">Step-by-Step Admission Procedure for {{ $school->name }}:</p>
                                    <ul class="ps-3 mb-4">
                                        <li class="mb-2"><strong>1. Registration:</strong> Submit the online registration
                                            form along with student birth certificate, academic report cards, and passport
                                            photographs.</li>
                                        <li class="mb-2"><strong>2. Aptitude Assessment & Interaction:</strong> Registered
                                            candidates will appear for an aptitude analysis and personal interaction
                                            session.</li>
                                        <li class="mb-2"><strong>3. Admission Confirmation:</strong> Provisional admission
                                            offer is issued upon meeting eligibility criteria and seat availability.</li>
                                        <li class="mb-2"><strong>4. Documentation & Verification:</strong> Submit mandatory
                                            verification documents (Aadhaar, Transfer Certificate, Medical Fitness).</li>
                                    </ul>

                                    <h4 class="fw-bold text-dark mb-2" style="font-size: 15px;">Eligibility Criteria</h4>
                                    <p class="mb-0">Admissions are open for eligible classes based on age criteria and
                                        previous class performance. Contact school counselors for detailed age cutoffs.</p>
                                </div>
                            </div>

                            <!-- Right Inquiry Form -->
                            <div class="col-lg-5">
                                <div class="sd-enquiry-card bg-white p-4 rounded-4 border shadow-sm"
                                    id="admission-enquiry-card">
                                    <h3 class="sd-enquiry-title fs-5 fw-bold mb-3 text-dark">Enquire About Admission</h3>

                                    @if(session('success'))
                                        <div class="alert alert-success alert-dismissible fade show mb-3" role="alert">
                                            <i class="fa-solid fa-circle-check me-1"></i> {{ session('success') }}
                                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                        </div>
                                    @endif

                                    <form action="{{ route('contact.submit') }}" method="POST" class="sd-enquiry-form">
                                        @csrf
                                        <input type="hidden" name="type" value="School Admission">
                                        <input type="hidden" name="company" value="{{ $school->name }}">

                                        <div class="mb-3">
                                            <label class="form-label fw-semibold" style="font-size: 13px;">Parent Name <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" name="name" id="parentNameInput"
                                                placeholder="Enter your name" class="form-control" required />
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label fw-semibold" style="font-size: 13px;">Phone Number
                                                <span class="text-danger">*</span></label>
                                            <input type="tel" name="phone" placeholder="Enter phone number"
                                                class="form-control" required />
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label fw-semibold" style="font-size: 13px;">Email
                                                Address</label>
                                            <input type="email" name="email" placeholder="Enter email address"
                                                class="form-control" />
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label fw-semibold" style="font-size: 13px;">Select Target
                                                Class</label>
                                            <select name="looking_for" id="enquiryClassSelect" class="form-select">
                                                <option value="Class 6 Admission" selected>Class 6 Admission</option>
                                                <option value="Class 7 Admission">Class 7 Admission</option>
                                                <option value="Class 8 Admission">Class 8 Admission</option>
                                                <option value="Class 9 Admission">Class 9 Admission</option>
                                                <option value="Class 11 Admission">Class 11 Admission</option>
                                            </select>
                                        </div>
                                        <div class="mb-4">
                                            <label class="form-label fw-semibold" style="font-size: 13px;">Message /
                                                Note</label>
                                            <textarea name="message" class="form-control" rows="2"
                                                placeholder="Any specific query for {{ $school->name }}..."></textarea>
                                        </div>
                                        <button type="submit" class="btn btn-primary w-100 fw-bold rounded-pill">
                                            Submit Enquiry <i class="fa-solid fa-paper-plane ms-1"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Admission Routes Tab -->
                    <div class="sd-section-card" data-tab-content="admissions">
                        <div class="sd-section-header d-flex justify-content-between align-items-center mb-4">
                            <h2 class="sd-section-title fs-4 fw-bold">Admission Routes & Session Status</h2>
                            <span class="badge bg-primary rounded-pill px-3 py-2">Academic Session 2026-2027</span>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-bordered align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th>Class / Program</th>
                                        <th>Academic Session</th>
                                        <th>Last Application Date</th>
                                        <th>Status</th>
                                        <th>Application Fee</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($school->admissionRoutes as $route)
                                        <tr>
                                            <td class="fw-bold">{{ $route->course->name ?? 'Standard Admission Route' }}</td>
                                            <td>2026-2027</td>
                                            <td>{{ $route->cutoff_year_wise ?? 'Rolling Admissions' }}</td>
                                            <td><span
                                                    class="badge bg-success">{{ $route->status == 1 ? 'Ongoing' : 'Closed' }}</span>
                                            </td>
                                            <td class="fw-bold">₹{{ number_format($route->application_fee ?? 2500) }}</td>
                                            <td>
                                                <button type="button" class="btn btn-primary btn-sm rounded-pill px-3 fw-bold"
                                                    onclick="applyNowHandler('{{ addslashes($route->course->name ?? 'Class 6') }}')">Apply
                                                    Now</button>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td class="fw-bold">General School Admission</td>
                                            <td>2026-2027</td>
                                            <td>Jul 31, 2026</td>
                                            <td><span class="badge bg-success">Ongoing</span></td>
                                            <td class="fw-bold">Contact School</td>
                                            <td>
                                                <button type="button" class="btn btn-primary btn-sm rounded-pill px-3 fw-bold"
                                                    onclick="applyNowHandler('General Admission')">Apply Now</button>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Fee Structure Tab -->
                    <div class="sd-section-card" data-tab-content="fee-structure">
                        <div class="sd-section-header d-flex justify-content-between align-items-center mb-4">
                            <h2 class="sd-section-title fs-4 fw-bold">Fees Structure (Academic Session 2026-2027)</h2>
                            <button class="btn btn-outline-primary btn-sm rounded-pill px-3">
                                <i class="fa-solid fa-download me-1"></i> Fee Details
                            </button>
                        </div>

                        <div class="row g-4">
                            <div class="col-lg-8">
                                @forelse($school->feeStructures as $fee)
                                    <div
                                        class="p-3 bg-white rounded-3 border mb-3 d-flex justify-content-between align-items-center">
                                        <div>
                                            <h5 class="fw-bold fs-6 mb-1">{{ $fee->course->name ?? 'Class Fee Structure' }}</h5>
                                            <span class="text-muted" style="font-size: 12px;">Session 2026-2027</span>
                                        </div>
                                        <span
                                            class="fs-5 fw-bold text-primary">₹{{ number_format($fee->total_tuition_fee ?? $fee->one_time_charges ?? 0) }}</span>
                                    </div>
                                @empty
                                    <div
                                        class="p-3 bg-white rounded-3 border mb-3 d-flex justify-content-between align-items-center">
                                        <div>
                                            <h5 class="fw-bold fs-6 mb-1">Annual Fee Structure (Classes 6 to 12)</h5>
                                            <span class="text-muted" style="font-size: 12px;">Includes Tuition, Boarding &
                                                Activities</span>
                                        </div>
                                        <span class="fs-6 fw-bold text-primary">Available On Request</span>
                                    </div>
                                @endforelse
                            </div>

                            <div class="col-lg-4">
                                <div class="bg-light p-4 rounded-4 text-center border">
                                    <i class="fa-solid fa-headset text-primary fs-1 mb-2"></i>
                                    <h4 class="fw-bold fs-6 mb-2">Have Questions About Fees?</h4>
                                    <p class="text-muted mb-3" style="font-size: 12px;">Connect directly with admission
                                        officers for fee breakdowns & scholarship offers.</p>
                                    <a href="tel:{{ $school->helpdesk_contact_number ?? '' }}"
                                        class="btn btn-primary btn-sm rounded-pill w-100 fw-bold">
                                        <i class="fa-solid fa-phone me-1"></i> Call Counselor
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Photos & Gallery Tab -->
                    <div class="sd-section-card" data-tab-content="photos">
                        <h2 class="sd-section-title fs-4 fw-bold mb-4">Photos & Campus Gallery</h2>
                        <div class="row g-3">
                            @if($school->cover_image_url)
                                <div class="col-md-6">
                                    <div class="rounded-4 overflow-hidden border shadow-sm" style="height: 250px;">
                                        <img src="{{ str_starts_with($school->cover_image_url, 'http') ? $school->cover_image_url : rtrim(env('BACKEND_URL', 'http://127.0.0.1:8001'), '/') . '/' . ltrim($school->cover_image_url, '/') }}"
                                            alt="{{ $school->name }}" style="width: 100%; height: 100%; object-fit: cover;" />
                                    </div>
                                </div>
                            @endif
                            @if($school->logo_url)
                                <div class="col-md-6">
                                    <div class="rounded-4 overflow-hidden border shadow-sm p-4 bg-white d-flex align-items-center justify-content-center"
                                        style="height: 250px;">
                                        <img src="{{ str_starts_with($school->logo_url, 'http') ? $school->logo_url : rtrim(env('BACKEND_URL', 'http://127.0.0.1:8001'), '/') . '/' . ltrim($school->logo_url, '/') }}"
                                            alt="{{ $school->name }} Logo" style="max-height: 180px; object-fit: contain;" />
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Reviews Section -->
                    <div class="sd-section-card" data-tab-content="reviews">
                        <h2 class="sd-section-title fs-4 fw-bold mb-4">Parent & Student Reviews</h2>
                        <div class="row g-4">
                            <div class="col-md-6">
                                <div class="p-4 bg-white rounded-4 border shadow-sm h-100">
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <span class="fw-bold">Rajesh Sharma (Parent)</span>
                                        <span class="text-warning" style="font-size: 12px;"><i
                                                class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i
                                                class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i
                                                class="fa-solid fa-star"></i></span>
                                    </div>
                                    <p class="text-muted mb-0" style="font-size: 13px;">"Outstanding school infrastructure,
                                        faculty, and sports facilities. My daughter has grown immensely confident!"</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="p-4 bg-white rounded-4 border shadow-sm h-100">
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <span class="fw-bold">Simran Kaur (Alumni)</span>
                                        <span class="text-warning" style="font-size: 12px;"><i
                                                class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i
                                                class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i
                                                class="fa-solid fa-star"></i></span>
                                    </div>
                                    <p class="text-muted mb-0" style="font-size: 13px;">"Great environment, excellent
                                        boarding facility, and dedicated teachers. Highly recommended!"</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Placement Tab -->
                    <div data-tab-content="placement">
                        <div class="univ-partner-band mb-0">
                            <div class="container">
                                <div class="univ-partner-logos-row">
                                    <!-- Logo 1 -->
                                    <div class="univ-logo-circle">
                                        <img src="/assets/images/uni-icon.png" alt="" />
                                    </div>
                                    <!-- Logo 2 -->
                                    <div class="univ-logo-circle">
                                        <img src="/assets/images/uni-icon.png" alt="" />
                                    </div>
                                    <!-- Logo 3 -->
                                    <div class="univ-logo-circle">
                                        <img src="/assets/images/uni-icon.png" alt="" />
                                    </div>
                                    <!-- Logo 4 -->
                                    <div class="univ-logo-circle">
                                        <img src="/assets/images/uni-icon.png" alt="" />
                                    </div>
                                    <!-- Logo 5 (Repeated for density) -->
                                    <div class="univ-logo-circle">
                                        <img src="/assets/images/uni-icon.png" alt="" />
                                    </div>
                                    <!-- Logo 6 -->
                                    <div class="univ-logo-circle">
                                        <img src="/assets/images/uni-icon.png" alt="" />
                                    </div>
                                    <!-- Logo 7 -->
                                    <div class="univ-logo-circle">
                                        <img src="/assets/images/uni-icon.png" alt="" />
                                    </div>
                                    <!-- Logo 8 -->
                                    <div class="univ-logo-circle">
                                        <img src="/assets/images/uni-icon.png" alt="" />
                                    </div>
                                    <!-- Logo 9 -->
                                    <div class="univ-logo-circle">
                                        <img src="/assets/images/uni-icon.png" alt="" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="sd-cta-banner">
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="sd-cta-banner-left">
                                            <div class="sd-cta-banner-logo">
                                                <i class="fa-solid fa-route"></i>
                                            </div>
                                            <h3 class="sd-cta-banner-title">Your Journey to Success Begins Here</h3>
                                        </div>

                                    </div>
                                    <div class="col-md-4 align-self-center">
                                        <button class="sd-cta-banner-btn" onclick="applyNowHandler('General Admission')">
                                            Check Eligibility Now <i class="fa-solid fa-arrow-right"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Top Banner -->
                        <div class="sd-section-card">


                            <div class="text-center mb-4">
                                <h2 class="sd-section-title fs-4 fw-bold mb-1">NIRF Placement Report</h2>
                                <p class="text-muted" style="font-size: 13px;">Official placement data as reported in NIRF
                                    submissions</p>
                            </div>

                            <!-- Filter Pills -->
                            <div class="sd-filter-pills-row">
                                <button class="sd-filter-pill-btn active"
                                    data-placement-filter="engineering">Engineering</button>
                                <button class="sd-filter-pill-btn" data-placement-filter="management">Management</button>
                                <button class="sd-filter-pill-btn" data-placement-filter="university">University</button>
                            </div>

                            <!-- UG Report Card (Accordion/Toggle) -->
                            <div class="sd-report-card">
                                <div class="sd-report-card-header d-flex justify-content-between align-items-center"
                                    data-bs-toggle="collapse" data-bs-target="#ugReportCollapse" aria-expanded="true">
                                    <h4 class="sd-report-card-title">UG <span>(4 Years) Report</span></h4>
                                    <i class="fa-solid fa-chevron-up toggle-icon"></i>
                                </div>
                                <div class="collapse show" id="ugReportCollapse">
                                    <div class="sd-report-table-container">
                                        <table class="sd-report-table">
                                            <thead>
                                                <tr>
                                                    <th>Particulars</th>
                                                    <th>2020</th>
                                                    <th>2019</th>
                                                    <th>2018</th>
                                                    <th>2017</th>
                                                    <th>2016</th>
                                                    <th>2015</th>
                                                    <th>2014</th>
                                                    <th>2013</th>
                                                    <th>2012</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>First Year Admitted</td>
                                                    <td>1118</td>
                                                    <td>1188</td>
                                                    <td>924</td>
                                                    <td>527</td>
                                                    <td>815</td>
                                                    <td>650</td>
                                                    <td>815</td>
                                                    <td>815</td>
                                                    <td>815</td>
                                                </tr>
                                                <tr>
                                                    <td>First Year Intake</td>
                                                    <td>1118</td>
                                                    <td>1188</td>
                                                    <td>924</td>
                                                    <td>527</td>
                                                    <td>815</td>
                                                    <td>650</td>
                                                    <td>815</td>
                                                    <td>815</td>
                                                    <td>815</td>
                                                </tr>
                                                <tr>
                                                    <td>Higher Studies</td>
                                                    <td>1118</td>
                                                    <td>1188</td>
                                                    <td>924</td>
                                                    <td>527</td>
                                                    <td>815</td>
                                                    <td>650</td>
                                                    <td>815</td>
                                                    <td>815</td>
                                                    <td>815</td>
                                                </tr>
                                                <tr>
                                                    <td>Median Salary</td>
                                                    <td>1118</td>
                                                    <td>1188</td>
                                                    <td>924</td>
                                                    <td>527</td>
                                                    <td>815</td>
                                                    <td>650</td>
                                                    <td>815</td>
                                                    <td>815</td>
                                                    <td>815</td>
                                                </tr>
                                                <tr>
                                                    <td>Student Placed</td>
                                                    <td>1118</td>
                                                    <td>1188</td>
                                                    <td>924</td>
                                                    <td>527</td>
                                                    <td>815</td>
                                                    <td>650</td>
                                                    <td>815</td>
                                                    <td>815</td>
                                                    <td>815</td>
                                                </tr>
                                                <tr>
                                                    <td>Graduated</td>
                                                    <td>1118</td>
                                                    <td>1188</td>
                                                    <td>924</td>
                                                    <td>527</td>
                                                    <td>815</td>
                                                    <td>650</td>
                                                    <td>815</td>
                                                    <td>815</td>
                                                    <td>815</td>
                                                </tr>
                                                <tr>
                                                    <td>Academic Year</td>
                                                    <td>1118</td>
                                                    <td>1188</td>
                                                    <td>924</td>
                                                    <td>527</td>
                                                    <td>815</td>
                                                    <td>650</td>
                                                    <td>815</td>
                                                    <td>815</td>
                                                    <td>815</td>
                                                </tr>
                                                <tr>
                                                    <td>Lateral Entry</td>
                                                    <td>1118</td>
                                                    <td>1188</td>
                                                    <td>924</td>
                                                    <td>527</td>
                                                    <td>815</td>
                                                    <td>650</td>
                                                    <td>815</td>
                                                    <td>815</td>
                                                    <td>815</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <!-- PG Report Card (Accordion/Toggle) -->
                            <div class="sd-report-card mb-0">
                                <div class="sd-report-card-header d-flex justify-content-between align-items-center collapsed"
                                    data-bs-toggle="collapse" data-bs-target="#pgReportCollapse" aria-expanded="false">
                                    <h4 class="sd-report-card-title">PG <span>(2 Years) Report</span></h4>
                                    <i class="fa-solid fa-chevron-down toggle-icon"></i>
                                </div>
                                <div class="collapse" id="pgReportCollapse">
                                    <div class="sd-report-table-container">
                                        <table class="sd-report-table">
                                            <thead>
                                                <tr>
                                                    <th>Particulars</th>
                                                    <th>2020</th>
                                                    <th>2019</th>
                                                    <th>2018</th>
                                                    <th>2017</th>
                                                    <th>2016</th>
                                                    <th>2015</th>
                                                    <th>2014</th>
                                                    <th>2013</th>
                                                    <th>2012</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>First Year Admitted</td>
                                                    <td>320</td>
                                                    <td>350</td>
                                                    <td>280</td>
                                                    <td>210</td>
                                                    <td>240</td>
                                                    <td>190</td>
                                                    <td>210</td>
                                                    <td>210</td>
                                                    <td>210</td>
                                                </tr>
                                                <tr>
                                                    <td>First Year Intake</td>
                                                    <td>350</td>
                                                    <td>350</td>
                                                    <td>300</td>
                                                    <td>240</td>
                                                    <td>240</td>
                                                    <td>200</td>
                                                    <td>240</td>
                                                    <td>240</td>
                                                    <td>240</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Courses Tab -->
                    <div class="sd-section-card" style="border: none;" data-tab-content="courses">
                        <!-- Flagship cards row -->
                        <div class="sd-flagship-row mb-4">
                            <div class="sd-flagship-card">
                                <div class="sd-flagship-label">Flagship Course</div>
                                <div class="sd-flagship-value">B.Tech in Computer Science and Engineering</div>
                            </div>
                            <div class="sd-flagship-card">
                                <div class="sd-flagship-label">Flagship Program</div>
                                <div class="sd-flagship-value">B.E. / B.Tech</div>
                            </div>
                            <div class="sd-flagship-card">
                                <div class="sd-flagship-label">Highest Placement</div>
                                <div class="sd-flagship-value">₹ 66.0 L</div>
                                <div class="sd-flagship-subvalue">
                                    <span class="sd-badge-light-yellow">B.Tech in Computer Science and Engineering</span>
                                </div>
                            </div>
                        </div>

                        <div>
                            <!-- Courses & Fees Card -->
                            <div class="sd-course-list-card">
                                <div class="sd-course-list-header">
                                    <div class="sd-course-university-info">
                                        <img src="/assets/images/uni-icon.png" alt="" />
                                        <div>
                                            <h4 class="sd-course-university-title">{{ $school->name }} Courses & Fees</h4>
                                            <div class="sd-course-university-sub">
                                                {{ $location ?: ($school->head_office_location ?? 'India') }}</div>
                                        </div>
                                    </div>
                                    <button class="sd-btn-download" style="border-radius: 100px;">
                                        <i class="fa-solid fa-download"></i> Download Report
                                    </button>
                                </div>

                                <div class="table-responsive" style="padding: 30px;border: 1px solid #dddddd;border-radius: 10px;">
                                    <table class="table align-middle mb-0">
                                        <thead class="table-light">
                                            <tr>
                                                <th>Courses</th>
                                                <th class="text-center">Total Fees</th>
                                                <th class="text-center">Eligibility</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <a href="#" class="text-decoration-none fw-bold text-primary">B.A.</a>
                                                    <div class="text-muted" style="font-size: 11px;">5 courses</div>
                                                </td>
                                                <td class="text-center ">₹ 3.16 L - ₹ 5.17 L</td>
                                                <td class="text-center ">10+2</td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <a href="#" class="text-decoration-none fw-bold text-primary">B.Sc.</a>
                                                    <div class="text-muted" style="font-size: 11px;">8 courses</div>
                                                </td>
                                                <td class="text-center ">₹ 3.16 L - ₹ 5.17 L</td>
                                                <td class="text-center ">10+2</td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <a href="#" class="text-decoration-none fw-bold text-primary">B.Tech</a>
                                                    <div class="text-muted" style="font-size: 11px;">12 courses</div>
                                                </td>
                                                <td class="text-center ">₹ 6.50 L - ₹ 12.80 L</td>
                                                <td class="text-center ">10+2 with PCM</td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <a href="#" class="text-decoration-none fw-bold text-primary">B.B.A.</a>
                                                    <div class="text-muted" style="font-size: 11px;">3 courses</div>
                                                </td>
                                                <td class="text-center ">₹ 3.16 L - ₹ 5.17 L</td>
                                                <td class="text-center ">10+2</td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <a href="#" class="text-decoration-none fw-bold text-primary">B.Com</a>
                                                    <div class="text-muted" style="font-size: 11px;">4 courses</div>
                                                </td>
                                                <td class="text-center ">₹ 3.16 L - ₹ 5.17 L</td>
                                                <td class="text-center ">10+2</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div style="padding: 30px;border: 1px solid #dddddd;border-radius: 10px;">  <h3 class="fw-bold fs-5 mb-4">All Courses at {{ $school->name }}</h3>
                            <div class="sd-course-grid">
                                @for ($i = 0; $i < 9; $i++)
                                    <div class="sd-course-card">
                                        <h4 class="sd-course-card-title">Bachelor of Computer Applications (BCA)</h4>
                                        <div class="sd-course-meta-grid">
                                            <div>
                                                <div class="sd-course-meta-label">Total Fees</div>
                                                <div class="sd-course-meta-value">₹ 5.12 L</div>
                                            </div>
                                            <div>
                                                <div class="sd-course-meta-label">Exam Accepted</div>
                                                <div class="sd-course-meta-value">--</div>
                                            </div>
                                            <div>
                                                <div class="sd-course-meta-label">Course Type</div>
                                                <div class="sd-course-meta-value">Full Time</div>
                                            </div>
                                            <div>
                                                <div class="sd-course-meta-label">Duration</div>
                                                <div class="sd-course-meta-value">3 Years</div>
                                            </div>
                                        </div>
                                        <button class="sd-course-apply-btn" onclick="applyNowHandler('BCA')">
                                            Apply Now <i class="fa-solid fa-arrow-right"></i>
                                        </button>
                                    </div>
                                @endfor
                            </div></div>
                            <!-- All Courses Grid -->
                           
                        </div>
                    </div>

                    <!-- Scholarships Tab -->
                    <div class="sd-section-card" data-tab-content="scholarships">
                        <div class="sd-info-section">
                            <h2 class="sd-info-title fs-4 mb-3">{{ $school->name }} Scholarships Overview</h2>
                            <p class="sd-info-text text-muted">
                                Scholarships at {{ $school->name }} are designed to reward merit, assist those in financial
                                need, and encourage special categories of students through fee concessions and targeted
                                awards. Most scholarships offer partial tuition fee waivers—typically ranging from 10% to
                                40%—according to academic performance, sports achievements, or social backgrounds.
                                Applicants can benefit from:
                            </p>
                            <ul class="sd-info-list text-muted">
                                <li>Merit-based waivers (board/CUET/entrance scores)</li>
                                <li>Need/EWS-based support (income thresholds, government post-matric)</li>
                                <li>Category-based schemes (domicile, single girl child, sports, defense wards, alumni)</li>
                            </ul>
                        </div>

                        <div class="sd-info-section">
                            <h3 class="sd-info-title fs-5 mb-2">{{ $school->name }} Eligibility</h3>
                            <p class="sd-info-text text-muted">
                                Eligibility criteria for scholarships generally reflect a commitment to both excellence and
                                inclusion. Most merit scholarships are awarded based on high scores in qualifying exams
                                (e.g., above 75%, 85%, or 95% aggregate) or competitive entrance tests. Need-based schemes
                                commonly consider annual family income thresholds set by government norms for EWS support.
                                Specific category scholarships may require proof of being a single girl child, state
                                domicile, or sports ranking at the state/national level. The university mandates maintenance
                                of a minimum CGPA 7.0 for ongoing benefits in most cases.
                            </p>
                        </div>

                        <div class="sd-info-section">
                            <h3 class="sd-info-title fs-5 mb-2">{{ $school->name }} Required Documents</h3>
                            <p class="sd-info-text text-muted">
                                Applicants must submit official documents to substantiate their eligibility for
                                scholarships. The following are typically required:
                            </p>
                            <ul class="sd-info-list text-muted">
                                <li>Qualifying exam marksheet (Class 12 or equivalent)</li>
                                <li>Entrance exam scorecard (if applicable)</li>
                                <li>Income certificate (for need/EWS-based)</li>
                                <li>Category certificate (SC/ST/OBC/EWS/sports/defense/single girl child)</li>
                                <li>Government-issued identity proof</li>
                            </ul>
                        </div>

                        <div class="sd-info-section">
                            <h3 class="sd-info-title fs-5 mb-2">{{ $school->name }} Application Process</h3>
                            <p class="sd-info-text text-muted">
                                Scholarship applications at {{ $school->name }} are accepted via the online admission portal
                                or directly through the institute's administrative office. Candidates should apply during
                                the relevant admissions cycle or semester window, ensuring all required documentation is
                                uploaded/attached before the published deadline. Failure to submit correct or complete
                                documents may result in disqualification from consideration.
                            </p>
                        </div>

                        <div class="sd-info-section">
                            <h3 class="sd-info-title fs-5 mb-3">{{ $school->name }} Scholarship Details</h3>
                            <p class="sd-info-text text-muted mb-3">
                                The table below summarizes the main scholarships offered at the Dehradun campus, including
                                key eligibility parameters and fee waiver benefits. Final awards may depend on document
                                verification and seat-type availability.
                            </p>

                            <div class="table-responsive">
                                <table class="table table-bordered align-middle mb-0">
                                    <thead class="table-light">
                                        <tr class="bg-primary text-white">
                                            <th class="bg-primary text-white">Scholarship Name</th>
                                            <th class="bg-primary text-white">Eligibility Criteria</th>
                                            <th class="bg-primary text-white">Benefit</th>
                                            <th class="bg-primary text-white">Notes (if any)</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="fw-bold">Academic Merit Scholarship</td>
                                            <td>Score >= 75% (some courses >= 85%/95%) in qualifying exam or top entrance
                                                merit</td>
                                            <td>10%-40% tuition fee waiver (fixed for entire course duration)</td>
                                            <td>Maintaining minimum CGPA 7.0 each semester is mandatory</td>
                                        </tr>
                                        <tr>
                                            <td class="fw-bold">Fee Concession for Female Candidates</td>
                                            <td>Any female student admitted to any course</td>
                                            <td>10% additional tuition fee waiver</td>
                                            <td>Applicable along with other scholarships</td>
                                        </tr>
                                        <tr>
                                            <td class="fw-bold">Fee Concession for Wards of Defense Personnel</td>
                                            <td>Fee Concession for Wards of Defense Personnel</td>
                                            <td>5% tuition fee waiver</td>
                                            <td>NA</td>
                                        </tr>
                                        <tr>
                                            <td class="fw-bold">Sports Scholarship</td>
                                            <td>State/National level sports achievement certification</td>
                                            <td>Tuition fee waiver percentage as per university discretion</td>
                                            <td>NA</td>
                                        </tr>
                                        <tr>
                                            <td class="fw-bold">Government Post Matric Scholarship</td>
                                            <td>Reserved category (SC/ST/OBC/EWS) as per government norms, income cutoff as
                                                notified</td>
                                            <td>As per government notification</td>
                                            <td>Renewal conditions apply</td>
                                        </tr>
                                        <tr>
                                            <td class="fw-bold">Sibling Discount</td>
                                            <td>Having a sibling currently enrolled at {{ $school->name }}</td>
                                            <td>Tuition fee concession (exact % NA)</td>
                                            <td>NA</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- CTA Banner at Bottom -->
                        <div class="sd-cta-banner mt-4 mb-0">
                            <div class="sd-cta-banner-left">
                                <div class="sd-cta-banner-logo">
                                    <i class="fa-solid fa-route"></i>
                                </div>
                                <h3 class="sd-cta-banner-title">Your Journey to Success Begins Here</h3>
                            </div>
                            <button class="sd-cta-banner-btn" onclick="applyNowHandler('General Admission')">
                                Check Eligibility Now <i class="fa-solid fa-arrow-right-long"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Rankings Tab -->
                    <div class="sd-section-card" data-tab-content="rankings">
                        <div class="text-center mb-4">
                            <h2 class="sd-section-title fs-4 fw-bold mb-1">{{ $school->name }} Ranking 2026</h2>
                            <p class="text-muted" style="font-size: 13px;">Official placement data as reported in NIRF
                                submissions</p>
                        </div>

                        <div class="sd-filter-pills-row">
                            <button class="sd-filter-pill-btn active" data-ranking-filter="all">All</button>
                            <button class="sd-filter-pill-btn" data-ranking-filter="nirf">NIRF</button>
                            <button class="sd-filter-pill-btn" data-ranking-filter="times">Times</button>
                        </div>

                        <!-- NIRF Section -->
                        <div class="mb-4" data-ranking-section="nirf">
                            <h3 class="fw-bold fs-5 mb-3">NIRF</h3>
                            <div class="table-responsive">
                                <table class="table table-bordered align-middle mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Category</th>
                                            <th class="text-center">2024</th>
                                            <th class="text-center">2023</th>
                                            <th class="text-center">2022</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="fw-bold">Engineering</td>
                                            <td class="text-center">52</td>
                                            <td class="text-center">42</td>
                                            <td class="text-center">58</td>
                                        </tr>
                                        <tr>
                                            <td class="fw-bold">Management</td>
                                            <td class="text-center">52</td>
                                            <td class="text-center">42</td>
                                            <td class="text-center">58</td>
                                        </tr>
                                        <tr>
                                            <td class="fw-bold">Overall</td>
                                            <td class="text-center">52</td>
                                            <td class="text-center">42</td>
                                            <td class="text-center">58</td>
                                        </tr>
                                        <tr>
                                            <td class="fw-bold">University</td>
                                            <td class="text-center">52</td>
                                            <td class="text-center">42</td>
                                            <td class="text-center">58</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- Times Section -->
                        <div data-ranking-section="times">
                            <h3 class="fw-bold fs-5 mb-3">Times</h3>
                            <div class="table-responsive">
                                <table class="table table-bordered align-middle mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Category</th>
                                            <th class="text-center">2023</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="fw-bold">University</td>
                                            <td class="text-center">601 - 800</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- NIRF Report Tab -->
                    <div class="sd-section-card" data-tab-content="nirf">
                        <!-- Approved Intake -->
                        <div class="p-4 bg-white border rounded-4 mb-4 shadow-sm">
                            <div class="d-flex justify-content-between align-items-start mb-3">
                                <div>
                                    <h3 class="fw-bold fs-5 mb-1">NIRF Sanctioned (Approved) Intake</h3>
                                    <p class="text-muted mb-0" style="font-size: 12px;">Official intake capacity as per NIRF
                                        guidelines</p>
                                </div>
                                <span class="border rounded px-3 py-1 font-monospace text-muted"
                                    style="font-size: 12px;">IOGO</span>
                            </div>

                            <div class="sd-filter-pills-row justify-content-center mb-3">
                                <button class="sd-filter-pill-btn active"
                                    data-nirf-intake-filter="engineering">Engineering</button>
                                <button class="sd-filter-pill-btn" data-nirf-intake-filter="management">Management</button>
                                <button class="sd-filter-pill-btn" data-nirf-intake-filter="university">University</button>
                            </div>

                            <h4 class="fw-bold fs-6 mb-3 text-dark">{{ $school->name }} - Engineering Report</h4>

                            <div class="table-responsive">
                                <table class="table table-bordered text-center align-middle mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th class="text-start">Program</th>
                                            <th>2020</th>
                                            <th>2019</th>
                                            <th>2018</th>
                                            <th>2017</th>
                                            <th>2016</th>
                                            <th>2015</th>
                                            <th>2014</th>
                                            <th>2013</th>
                                            <th>2012</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="text-start fw-bold">UG (4 Years)</td>
                                            <td>1118</td>
                                            <td>1188</td>
                                            <td>924</td>
                                            <td>527</td>
                                            <td>815</td>
                                            <td>650</td>
                                            <td>815</td>
                                            <td>815</td>
                                            <td>815</td>
                                        </tr>
                                        <tr>
                                            <td class="text-start fw-bold">PG (2 Years)</td>
                                            <td>1118</td>
                                            <td>1188</td>
                                            <td>924</td>
                                            <td>527</td>
                                            <td>815</td>
                                            <td>650</td>
                                            <td>815</td>
                                            <td>815</td>
                                            <td>815</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- Student Strength Report -->
                        <div class="p-4 bg-white border rounded-4 mb-4 shadow-sm">
                            <div class="d-flex justify-content-between align-items-start mb-3">
                                <div>
                                    <h3 class="fw-bold fs-5 mb-1">NIRF Student Strength Report</h3>
                                    <p class="text-muted mb-0" style="font-size: 12px;">Total Actual Student Strength</p>
                                </div>
                                <span class="border rounded px-3 py-1 font-monospace text-muted"
                                    style="font-size: 12px;">IOGO</span>
                            </div>

                            <div class="sd-filter-pills-row justify-content-center mb-3">
                                <button class="sd-filter-pill-btn active"
                                    data-nirf-strength-filter="engineering">Engineering</button>
                                <button class="sd-filter-pill-btn"
                                    data-nirf-strength-filter="management">Management</button>
                                <button class="sd-filter-pill-btn"
                                    data-nirf-strength-filter="university">University</button>
                            </div>

                            <h4 class="fw-bold fs-6 mb-3 text-dark">{{ $school->name }} - Engineering Report</h4>

                            <div class="table-responsive">
                                <table class="table table-bordered text-center align-middle mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th class="text-start">Program</th>
                                            <th>2020</th>
                                            <th>2019</th>
                                            <th>2018</th>
                                            <th>2017</th>
                                            <th>2016</th>
                                            <th>2015</th>
                                            <th>2014</th>
                                            <th>2013</th>
                                            <th>2012</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="text-start fw-bold">UG (4 Years)</td>
                                            <td>1118</td>
                                            <td>1188</td>
                                            <td>924</td>
                                            <td>527</td>
                                            <td>815</td>
                                            <td>650</td>
                                            <td>815</td>
                                            <td>815</td>
                                            <td>815</td>
                                        </tr>
                                        <tr>
                                            <td class="text-start fw-bold">PG (2 Years)</td>
                                            <td>1118</td>
                                            <td>1188</td>
                                            <td>924</td>
                                            <td>527</td>
                                            <td>815</td>
                                            <td>650</td>
                                            <td>815</td>
                                            <td>815</td>
                                            <td>815</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- Trends Row (Visual representations) -->
                        <div class="sd-trend-row">
                            <!-- Placement Rate Trend -->
                            <div class="sd-trend-card">
                                <div class="sd-trend-header">
                                    <h4 class="sd-trend-title">Placement Rate Trend (%)</h4>
                                    <span class="sd-trend-badge">Avg 46%</span>
                                </div>
                                <div class="sd-trend-chart-wrapper d-flex align-items-end justify-content-between pt-4"
                                    style="border-bottom: 2px solid #E2E8F0; border-left: 2px solid #E2E8F0; padding-left: 10px; padding-bottom: 5px;">
                                    <div class="d-flex flex-column align-items-center flex-grow-1">
                                        <div class="bg-primary opacity-50 rounded-top" style="width: 30px; height: 60px;">
                                        </div>
                                        <span class="text-muted mt-2" style="font-size: 10px;">2021</span>
                                    </div>
                                    <div class="d-flex flex-column align-items-center flex-grow-1">
                                        <div class="bg-primary opacity-60 rounded-top" style="width: 30px; height: 80px;">
                                        </div>
                                        <span class="text-muted mt-2" style="font-size: 10px;">2022</span>
                                    </div>
                                    <div class="d-flex flex-column align-items-center flex-grow-1">
                                        <div class="bg-primary opacity-70 rounded-top" style="width: 30px; height: 50px;">
                                        </div>
                                        <span class="text-muted mt-2" style="font-size: 10px;">2023</span>
                                    </div>
                                    <div class="d-flex flex-column align-items-center flex-grow-1">
                                        <div class="bg-primary opacity-80 rounded-top" style="width: 30px; height: 75px;">
                                        </div>
                                        <span class="text-muted mt-2" style="font-size: 10px;">2024</span>
                                    </div>
                                    <div class="d-flex flex-column align-items-center flex-grow-1">
                                        <div class="bg-primary rounded-top" style="width: 30px; height: 95px;"></div>
                                        <span class="text-muted mt-2" style="font-size: 10px;">2025</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Median Salary Trend -->
                            <div class="sd-trend-card">
                                <div class="sd-trend-header">
                                    <h4 class="sd-trend-title">Median Salary Trend (₹ LPA)</h4>
                                    <span class="sd-trend-badge" style="background-color: #FEF3C7; color: #D97706;">Avg 4.8
                                        LPA</span>
                                </div>
                                <div class="sd-trend-chart-wrapper d-flex align-items-end justify-content-between pt-4"
                                    style="border-bottom: 2px solid #E2E8F0; border-left: 2px solid #E2E8F0; padding-left: 10px; padding-bottom: 5px;">
                                    <div class="d-flex flex-column align-items-center flex-grow-1">
                                        <div class="bg-warning opacity-50 rounded-top" style="width: 30px; height: 50px;">
                                        </div>
                                        <span class="text-muted mt-2" style="font-size: 10px;">2021</span>
                                    </div>
                                    <div class="d-flex flex-column align-items-center flex-grow-1">
                                        <div class="bg-warning opacity-60 rounded-top" style="width: 30px; height: 65px;">
                                        </div>
                                        <span class="text-muted mt-2" style="font-size: 10px;">2022</span>
                                    </div>
                                    <div class="d-flex flex-column align-items-center flex-grow-1">
                                        <div class="bg-warning opacity-70 rounded-top" style="width: 30px; height: 80px;">
                                        </div>
                                        <span class="text-muted mt-2" style="font-size: 10px;">2023</span>
                                    </div>
                                    <div class="d-flex flex-column align-items-center flex-grow-1">
                                        <div class="bg-warning opacity-80 rounded-top" style="width: 30px; height: 75px;">
                                        </div>
                                        <span class="text-muted mt-2" style="font-size: 10px;">2024</span>
                                    </div>
                                    <div class="d-flex flex-column align-items-center flex-grow-1">
                                        <div class="bg-warning rounded-top" style="width: 30px; height: 110px;"></div>
                                        <span class="text-muted mt-2" style="font-size: 10px;">2025</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- Facilities Tab -->
                <div class="sd-section-card" data-tab-content="facilities">
                    <div class="sd-info-section">
                        <p class="sd-info-text text-muted">
                            Graphic Era University, located in Dehradun, Uttarakhand, India, is renowned for its excellent
                            infrastructure and facilities that cater to the holistic development of its students. The
                            university offers a wide range of facilities, including a well-stocked library, modern hostels,
                            and state-of-the-art sports complexes. Additionally, it provides a strong focus on technology
                            and innovation, with various research and development initiatives. The campus environment is
                            conducive to both academic and extracurricular activities, making it an attractive choice for
                            students.
                        </p>
                    </div>

                    <div class="sd-info-section">
                        <h3 class="sd-info-title fs-5 mb-2">Graphic Era University Facilities: Central Library</h3>
                        <p class="sd-info-text text-muted">
                            The central library at Graphic Era University is a cornerstone of its academic infrastructure.
                            It is stocked with over 174,700 technical books, along with periodicals, magazines, and national
                            and international publications. The library also features a separate digital library with more
                            than 1,200 journals, providing students with access to both print and online resources. The
                            library has a reading room with a seating capacity of 300, along with sections for audio-visual,
                            reprographic, and acquisition & technical services. The library uses advanced systems like OPAC,
                            barcoding, and ERP software for efficient management and access to resources.
                        </p>
                    </div>

                    <div class="sd-info-section">
                        <h3 class="sd-info-title fs-5 mb-2">Graphic Era University Facilities: Other Facilities</h3>
                        <p class="sd-info-text text-muted">
                            Graphic Era University offers a variety of facilities that support both academic and personal
                            development. These include spacious digital classrooms, well-equipped lecture halls, seminar
                            halls, and conference rooms. The campus is fully connected with Wi-Fi to facilitate seamless
                            learning and communication. Other amenities include a cafeteria that provides hygienically
                            prepared food, a medical clinic for health services, and banking facilities such as Punjab
                            National Bank and ATM. The university also runs a shuttle service to ensure convenient
                            transportation for students.
                        </p>
                    </div>

                    <div class="sd-info-section">
                        <h3 class="sd-info-title fs-5 mb-2">Graphic Era University Facilities: Sports & Recreation</h3>
                        <p class="sd-info-text text-muted">
                            Graphic Era University emphasizes physical fitness and recreation with a comprehensive sports
                            infrastructure. The campus features a state-of-the-art gym equipped with advanced cardio and
                            strength training equipment from leading brands like Life Fitness and Hammer Strength MTS. The
                            sports complex includes facilities for various indoor and outdoor games such as badminton,
                            basketball, cricket, football, tennis, volleyball, table tennis, billiards, chess, and carrom.
                            The athletic field caters to track and field events.
                        </p>
                    </div>

                    <div class="sd-info-section">
                        <h3 class="sd-info-title fs-5 mb-2">Graphic Era University Facilities: Innovation & Research</h3>
                        <p class="sd-info-text text-muted">
                            Graphic Era University is committed to fostering innovation and research through its facilities.
                            While specific details about research laboratories and projects are not fully disclosed, the
                            university emphasizes building a technology-enabled learning environment. This includes
                            state-of-the-art computer centers and digital classrooms that support e-learning platforms. The
                            focus on digital infrastructure and advanced teaching methods indicates a strong emphasis on
                            innovation and research.
                        </p>
                    </div>

                    <div class="sd-info-section">
                        <h3 class="sd-info-title fs-5 mb-2">Graphic Era University Hostel Facilities</h3>
                        <p class="sd-info-text text-muted">
                            The hostel facilities at Graphic Era University are designed to provide students with a
                            comfortable living environment. The hostels can accommodate over 1,500 students and offer
                            amenities such as 24/7 electricity and water supply, first aid facilities, and access to a
                            computer center in the girls' hostel. The hostels feature air-conditioned and
                            non-air-conditioned rooms, a mess providing hygienic food, laundry facilities, and a strong
                            focus on cleanliness and hygiene. Each hostel is well-guarded with 24/7 security to ensure
                            student safety.
                        </p>
                    </div>

                    <div class="sd-info-section">
                        <h3 class="sd-info-title fs-5 mb-2">Graphic Era University Events & Festivals</h3>
                        <p class="sd-info-text text-muted">
                            Graphic Era University hosts various events and festivals that contribute to the cultural and
                            social life of the campus. While specific details about these events are not widely documented,
                            the presence of a huge auditorium suggests a capacity for large-scale events such as seminars,
                            conferences, and cultural programs. These events play a crucial role in fostering community
                            engagement and student interaction.
                        </p>
                    </div>
                </div>

                <!-- Gallery Tab -->
                <div class="sd-section-card" data-tab-content="gallery">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h2 class="sd-section-title fs-4 fw-bold mb-0">Graphic Era University Gallery</h2>
                        <span class="text-muted" style="font-size: 13px;">15 photos &bull; 0 videos</span>
                    </div>

                    <!-- Album Filter Pills -->
                    <div class="sd-filter-pills-row sd-gallery-filter-row justify-content-start mb-4">
                        <button class="sd-filter-pill-btn active" data-gallery-filter="all">All Albums</button>
                        <button class="sd-filter-pill-btn" data-gallery-filter="convocation">Convocation</button>
                        <button class="sd-filter-pill-btn" data-gallery-filter="student-life">Student Life</button>
                        <button class="sd-filter-pill-btn" data-gallery-filter="students-work">Students Work</button>
                        <button class="sd-filter-pill-btn" data-gallery-filter="sports-day">Sports day</button>
                        <button class="sd-filter-pill-btn" data-gallery-filter="indoor-sports">Indoor Sports Block</button>
                        <button class="sd-filter-pill-btn" data-gallery-filter="campus">Campus</button>
                        <button class="sd-filter-pill-btn" data-gallery-filter="event">Event</button>
                    </div>

                    <!-- Gallery Grid -->
                    <div class="sd-gallery-grid">
                        <!-- 15 items with different albums for functional filtering -->
                        @php
                            $albums = ['convocation', 'student-life', 'students-work', 'sports-day', 'indoor-sports', 'campus', 'event'];
                            $albumNames = [
                                'convocation' => 'Convocation',
                                'student-life' => 'Student Life',
                                'students-work' => 'Students Work',
                                'sports-day' => 'Sports day',
                                'indoor-sports' => 'Indoor Sports Block',
                                'campus' => 'Campus',
                                'event' => 'Event'
                            ];
                        @endphp
                        @for ($i = 0; $i < 15; $i++)
                            @php
                                $albumKey = $albums[$i % count($albums)];
                                $albumName = $albumNames[$albumKey];
                            @endphp
                            <div class="sd-gallery-card" data-gallery-album="{{ $albumKey }}">
                                <div class="sd-gallery-img-wrapper">
                                    <img class="sd-gallery-img" src="{{ asset('assets/images/school-detail-banner-img.png') }}"
                                        alt="{{ $albumName }}" />
                                    <div class="sd-gallery-hover-overlay">
                                        <button class="sd-gallery-view-btn">View</button>
                                    </div>
                                </div>
                                <div class="sd-gallery-info">
                                    <div class="sd-gallery-title">
                                        <i class="fa-solid fa-camera text-muted"></i> {{ $albumName }}
                                    </div>
                                    <div class="sd-gallery-count">1 photo</div>
                                </div>
                            </div>
                        @endfor
                    </div>
                </div>

                <!-- Lightbox Modal Container -->
                <div id="sdLightbox" class="sd-lightbox">
                    <button class="sd-lightbox-close" id="sdLightboxClose">&times;</button>
                    <img class="sd-lightbox-content" id="sdLightboxImg" src="" alt="Lightbox View" />
                </div>

                <!-- Faculty Tab -->
                <div class="sd-section-card" data-tab-content="faculty">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h2 class="sd-section-title fs-4 fw-bold mb-0">Graphic Era University Faculty Details</h2>
                        <span class="text-primary fw-bold" style="font-size: 13px;">293 Members</span>
                    </div>

                    <div class="sd-faculty-grid">
                        @for ($i = 0; $i < 20; $i++)
                            <div class="sd-faculty-card">
                                <i class="fa-solid fa-circle-user fa-3x text-muted mb-2"></i>
                                <h4 class="sd-faculty-name">Dr. Pushpendra Kumar</h4>
                                <p class="sd-faculty-role mb-0">Professor</p>
                            </div>
                        @endfor
                    </div>
                </div>

                <!-- Routes Tab -->
                <div class="sd-section-card" data-tab-content="routes">
                    <div class="sd-course-list-header mb-4">
                        <div class="sd-course-university-info">
                            <img class="sd-course-university-logo"
                                src="{{ $school->logo_url ? (str_starts_with($school->logo_url, 'http') ? $school->logo_url : rtrim(env('BACKEND_URL', 'http://127.0.0.1:8001'), '/') . '/' . ltrim($school->logo_url, '/')) : asset('assets/images/university-default-logo.png') }}"
                                alt="Logo" />
                            <h4 class="sd-course-university-title">GUA Admission Program</h4>
                        </div>
                        <button class="sd-btn-download">
                            <i class="fa-solid fa-download"></i> Download Report
                        </button>
                    </div>

                    <div class="table-responsive">
                        <table class="table align-middle text-center mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th class="text-start">Course / Program</th>
                                    <th>Session</th>
                                    <th>Last Date</th>
                                    <th>Status</th>
                                    <th>Accepted Exam</th>
                                    <th>Fees</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="text-start fw-bold text-primary">MBA</td>
                                    <td>26-27</td>
                                    <td>31.08.26</td>
                                    <td><span
                                            class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-25 px-3 py-1 rounded-pill">Active</span>
                                    </td>
                                    <td>
                                        <span class="badge bg-light text-dark border px-2 py-1 mb-1">CAT</span>
                                        <span class="badge bg-light text-dark border px-2 py-1 mb-1">XAT</span>
                                        <span class="badge bg-light text-dark border px-2 py-1 mb-1">MAT</span>
                                        <span class="badge bg-light text-dark border px-2 py-1 mb-1">GEUCAT</span>
                                        <span class="badge bg-light text-dark border px-2 py-1">Graduation Merit
                                            Basis</span>
                                    </td>
                                    <td class="fw-bold">14,500</td>
                                    <td><button class="btn btn-primary btn-sm rounded-pill px-3 fw-bold"
                                            onclick="applyNowHandler('MBA')">Apply Now</button></td>
                                </tr>
                                <tr>
                                    <td class="text-start fw-bold text-primary">B-tech</td>
                                    <td>26-27</td>
                                    <td>31.08.26</td>
                                    <td><span
                                            class="badge bg-danger bg-opacity-10 text-danger border border-danger border-opacity-25 px-3 py-1 rounded-pill">Closed</span>
                                    </td>
                                    <td>
                                        <span class="badge bg-light text-dark border px-2 py-1 mb-1">CAT</span>
                                        <span class="badge bg-light text-dark border px-2 py-1 mb-1">XAT</span>
                                        <span class="badge bg-light text-dark border px-2 py-1 mb-1">MAT</span>
                                        <span class="badge bg-light text-dark border px-2 py-1">GEUCAT</span>
                                    </td>
                                    <td class="fw-bold">22,500</td>
                                    <td><button class="btn btn-primary btn-sm rounded-pill px-3 fw-bold"
                                            onclick="applyNowHandler('B-tech')">Apply Now</button></td>
                                </tr>
                                <tr>
                                    <td class="text-start fw-bold text-primary">B pharma</td>
                                    <td>26-27</td>
                                    <td>31.08.26</td>
                                    <td><span
                                            class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-25 px-3 py-1 rounded-pill">Active</span>
                                    </td>
                                    <td>
                                        <span class="badge bg-light text-dark border px-2 py-1 mb-1">CAT</span>
                                        <span class="badge bg-light text-dark border px-2 py-1 mb-1">XAT</span>
                                        <span class="badge bg-light text-dark border px-2 py-1 mb-1">MAT</span>
                                        <span class="badge bg-light text-dark border px-2 py-1">GEUCAT</span>
                                    </td>
                                    <td class="fw-bold">14,500</td>
                                    <td><button class="btn btn-primary btn-sm rounded-pill px-3 fw-bold"
                                            onclick="applyNowHandler('B pharma')">Apply Now</button></td>
                                </tr>
                                <tr>
                                    <td class="text-start fw-bold text-primary">M-tech</td>
                                    <td>26-27</td>
                                    <td>31.08.26</td>
                                    <td><span
                                            class="badge bg-danger bg-opacity-10 text-danger border border-danger border-opacity-25 px-3 py-1 rounded-pill">Closed</span>
                                    </td>
                                    <td>
                                        <span class="badge bg-light text-dark border px-2 py-1 mb-1">CAT</span>
                                        <span class="badge bg-light text-dark border px-2 py-1 mb-1">XAT</span>
                                        <span class="badge bg-light text-dark border px-2 py-1 mb-1">MAT</span>
                                        <span class="badge bg-light text-dark border px-2 py-1">GEUCAT</span>
                                    </td>
                                    <td class="fw-bold">22,500</td>
                                    <td><button class="btn btn-primary btn-sm rounded-pill px-3 fw-bold"
                                            onclick="applyNowHandler('M-tech')">Apply Now</button></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Address & Contact Section -->
                <div id="address-contact" class="sd-section-card">
                    <h2 class="sd-section-title fs-4 fw-bold mb-4">Address & Contact Information</h2>
                    <div class="row g-4 mb-4">
                        <div class="col-md-3 col-sm-6">
                            <div class="p-3 bg-white rounded-3 border text-center">
                                <i class="fa-solid fa-location-dot text-primary fs-4 mb-2"></i>
                                <h6 class="fw-bold mb-1">Location</h6>
                                <p class="text-muted mb-0" style="font-size: 12px;">
                                    {{ $school->head_office_location ?? $location ?: 'Dehradun, Uttarakhand' }}</p>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <div class="p-3 bg-white rounded-3 border text-center">
                                <i class="fa-solid fa-globe text-success fs-4 mb-2"></i>
                                <h6 class="fw-bold mb-1">Official Website</h6>
                                <p class="text-muted mb-0" style="font-size: 12px;">
                                    @if($school->official_website)
                                        <a href="{{ str_starts_with($school->official_website, 'http') ? $school->official_website : 'https://' . $school->official_website }}"
                                            target="_blank"
                                            class="text-decoration-none text-primary">{{ $school->official_website }}</a>
                                    @else
                                        Available On Request
                                    @endif
                                </p>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <div class="p-3 bg-white rounded-3 border text-center">
                                <i class="fa-solid fa-phone text-warning fs-4 mb-2"></i>
                                <h6 class="fw-bold mb-1">Phone Number</h6>
                                <p class="text-muted mb-0" style="font-size: 12px;">
                                    {{ $school->helpdesk_contact_number ?? 'Available On Request' }}</p>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <div class="p-3 bg-white rounded-3 border text-center">
                                <i class="fa-solid fa-envelope text-info fs-4 mb-2"></i>
                                <h6 class="fw-bold mb-1">Email ID</h6>
                                <p class="text-muted mb-0" style="font-size: 12px;">
                                    {{ $school->helpdesk_email ?? 'Available On Request' }}</p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const tabButtons = document.querySelectorAll(".sd-tab-pill-btn");
            const tabContents = document.querySelectorAll("[data-tab-content]");

            window.switchTab = function (targetTab) {
                tabButtons.forEach(btn => {
                    if (btn.getAttribute("data-tab-target") === targetTab) {
                        btn.classList.add("active");
                    } else {
                        btn.classList.remove("active");
                    }
                });

                tabContents.forEach(content => {
                    const attr = content.getAttribute("data-tab-content") || "";
                    const allowedTabs = attr.trim().split(/\s+/);
                    if (allowedTabs.includes(targetTab)) {
                        content.style.display = "block";
                    } else {
                        content.style.display = "none";
                    }
                });
            };

            tabButtons.forEach(btn => {
                btn.addEventListener("click", function () {
                    const target = this.getAttribute("data-tab-target");
                    window.switchTab(target);
                });
            });

            window.applyNowHandler = function (className) {
                window.switchTab("overview");

                if (className) {
                    const select = document.getElementById("enquiryClassSelect");
                    if (select) {
                        for (let i = 0; i < select.options.length; i++) {
                            if (select.options[i].value.toLowerCase().includes(className.toLowerCase())) {
                                select.selectedIndex = i;
                                break;
                            }
                        }
                    }
                }

                const card = document.getElementById("admission-enquiry-card");
                if (card) {
                    card.scrollIntoView({ behavior: "smooth" });
                    setTimeout(() => {
                        const input = document.getElementById("parentNameInput");
                        if (input) input.focus();
                    }, 400);
                }
            };

            // Default to 'overview'
            window.switchTab("overview");

            // Tab Navigation Button Scroll Logic
            const tabRow = document.querySelector(".sd-tab-pills-row");
            const prevBtn = document.getElementById("prevTabBtn");
            const nextBtn = document.getElementById("nextTabBtn");

            if (tabRow && prevBtn && nextBtn) {
                const scrollAmount = 200; // Amount to scroll in pixels

                prevBtn.addEventListener("click", function () {
                    tabRow.scrollBy({ left: -scrollAmount, behavior: "smooth" });
                });

                nextBtn.addEventListener("click", function () {
                    tabRow.scrollBy({ left: scrollAmount, behavior: "smooth" });
                });

                function updateNavButtons() {
                    // Check if scroll is at the beginning
                    prevBtn.disabled = tabRow.scrollLeft <= 1;

                    // Check if scroll is at the end
                    const isEnd = tabRow.scrollLeft + tabRow.clientWidth >= tabRow.scrollWidth - 1;
                    nextBtn.disabled = isEnd;

                    // Hide buttons if row content is fully visible without scrollbar
                    if (tabRow.scrollWidth <= tabRow.clientWidth) {
                        prevBtn.style.display = "none";
                        nextBtn.style.display = "none";
                    } else {
                        prevBtn.style.display = "flex";
                        nextBtn.style.display = "flex";
                    }
                }

                // Attach scroll and resize events
                tabRow.addEventListener("scroll", updateNavButtons);
                window.addEventListener("resize", updateNavButtons);

                // Initial check after contents/fonts load
                setTimeout(updateNavButtons, 200);
            }

            // Filter Pills Toggling
            document.querySelectorAll(".sd-filter-pill-btn").forEach(btn => {
                btn.addEventListener("click", function () {
                    const row = this.closest(".sd-filter-pills-row");
                    if (row) {
                        row.querySelectorAll(".sd-filter-pill-btn").forEach(b => b.classList.remove("active"));
                    }
                    this.classList.add("active");
                });
            });

            // Rankings Filter Toggling
            document.querySelectorAll("[data-ranking-filter]").forEach(btn => {
                btn.addEventListener("click", function () {
                    const filter = this.getAttribute("data-ranking-filter");
                    document.querySelectorAll("[data-ranking-section]").forEach(section => {
                        if (filter === "all" || section.getAttribute("data-ranking-section") === filter) {
                            section.style.display = "block";
                        } else {
                            section.style.display = "none";
                        }
                    });
                });
            });

            // Placement Filter Toggling
            const placementUGData = {
                engineering: [1118, 1188, 924, 527, 815, 650, 815, 815, 815],
                management: [240, 260, 210, 180, 200, 150, 180, 180, 180],
                university: [1850, 1920, 1600, 1200, 1400, 1100, 1300, 1300, 1300]
            };
            const placementPGData = {
                engineering: [320, 350, 280, 210, 240, 190, 210, 210, 210],
                management: [90, 110, 85, 70, 75, 60, 70, 70, 70],
                university: [450, 480, 390, 310, 350, 290, 310, 310, 310]
            };
            document.querySelectorAll("[data-placement-filter]").forEach(btn => {
                btn.addEventListener("click", function () {
                    const filter = this.getAttribute("data-placement-filter");
                    const ugRows = document.querySelectorAll("#ugReportCollapse tbody tr");
                    const pgRows = document.querySelectorAll("#pgReportCollapse tbody tr");

                    const ugVals = placementUGData[filter] || placementUGData.engineering;
                    const pgVals = placementPGData[filter] || placementPGData.engineering;

                    ugRows.forEach(row => {
                        const tds = row.querySelectorAll("td");
                        for (let i = 1; i < tds.length; i++) {
                            tds[i].textContent = ugVals[i - 1] || "-";
                        }
                    });
                    pgRows.forEach(row => {
                        const tds = row.querySelectorAll("td");
                        for (let i = 1; i < tds.length; i++) {
                            tds[i].textContent = pgVals[i - 1] || "-";
                        }
                    });
                });
            });

            // NIRF Intake and Strength Filter Toggling
            const nirfIntakeUG = {
                engineering: [1118, 1188, 924, 527, 815, 650, 815, 815, 815],
                management: [240, 260, 210, 180, 200, 150, 180, 180, 180],
                university: [1850, 1920, 1600, 1200, 1400, 1100, 1300, 1300, 1300]
            };
            const nirfIntakePG = {
                engineering: [320, 350, 280, 210, 240, 190, 210, 210, 210],
                management: [90, 110, 85, 70, 75, 60, 70, 70, 70],
                university: [450, 480, 390, 310, 350, 290, 310, 310, 310]
            };

            document.querySelectorAll("[data-nirf-intake-filter]").forEach(btn => {
                btn.addEventListener("click", function () {
                    const filter = this.getAttribute("data-nirf-intake-filter");
                    const card = this.closest(".p-4.bg-white.border.rounded-4");
                    if (!card) return;
                    const header = card.querySelector("h4.fw-bold");
                    if (header) {
                        header.textContent = `Graphic Era University - ${this.textContent} Report`;
                    }
                    const rows = card.querySelectorAll("table tbody tr");
                    const ugVals = nirfIntakeUG[filter] || nirfIntakeUG.engineering;
                    const pgVals = nirfIntakePG[filter] || nirfIntakePG.engineering;

                    if (rows[0]) {
                        const tds = rows[0].querySelectorAll("td");
                        for (let i = 1; i < tds.length; i++) tds[i].textContent = ugVals[i - 1] || "-";
                    }
                    if (rows[1]) {
                        const tds = rows[1].querySelectorAll("td");
                        for (let i = 1; i < tds.length; i++) tds[i].textContent = pgVals[i - 1] || "-";
                    }
                });
            });

            document.querySelectorAll("[data-nirf-strength-filter]").forEach(btn => {
                btn.addEventListener("click", function () {
                    const filter = this.getAttribute("data-nirf-strength-filter");
                    const card = this.closest(".p-4.bg-white.border.rounded-4");
                    if (!card) return;
                    const header = card.querySelector("h4.fw-bold");
                    if (header) {
                        header.textContent = `Graphic Era University - ${this.textContent} Report`;
                    }
                    const rows = card.querySelectorAll("table tbody tr");
                    const ugVals = nirfIntakeUG[filter] || nirfIntakeUG.engineering;
                    const pgVals = nirfIntakePG[filter] || nirfIntakePG.engineering;

                    if (rows[0]) {
                        const tds = rows[0].querySelectorAll("td");
                        for (let i = 1; i < tds.length; i++) tds[i].textContent = ugVals[i - 1] || "-";
                    }
                    if (rows[1]) {
                        const tds = rows[1].querySelectorAll("td");
                        for (let i = 1; i < tds.length; i++) tds[i].textContent = pgVals[i - 1] || "-";
                    }
                });
            });

            // Gallery Filters
            const galleryFilters = document.querySelectorAll("[data-gallery-filter]");
            const galleryCards = document.querySelectorAll("[data-gallery-album]");
            galleryFilters.forEach(filterBtn => {
                filterBtn.addEventListener("click", function () {
                    galleryFilters.forEach(btn => btn.classList.remove("active"));
                    this.classList.add("active");
                    const filterValue = this.getAttribute("data-gallery-filter");
                    galleryCards.forEach(card => {
                        if (filterValue === "all" || card.getAttribute("data-gallery-album") === filterValue) {
                            card.style.display = "block";
                        } else {
                            card.style.display = "none";
                        }
                    });
                });
            });

            // Gallery Lightbox
            const lightbox = document.getElementById("sdLightbox");
            const lightboxImg = document.getElementById("sdLightboxImg");
            const lightboxClose = document.getElementById("sdLightboxClose");

            document.querySelectorAll(".sd-gallery-card").forEach(card => {
                card.addEventListener("click", function () {
                    const img = this.querySelector(".sd-gallery-img");
                    if (img && lightbox && lightboxImg) {
                        lightboxImg.src = img.src;
                        lightbox.style.display = "flex";
                    }
                });
            });

            if (lightboxClose && lightbox) {
                lightboxClose.addEventListener("click", function () {
                    lightbox.style.display = "none";
                });
            }
            if (lightbox) {
                lightbox.addEventListener("click", function (e) {
                    if (e.target === lightbox) {
                        lightbox.style.display = "none";
                    }
                });
            }
        });
    </script>
@endsection