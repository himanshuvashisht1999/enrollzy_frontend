@extends('layouts.app')

@section('content')
<main class="about-hero-section ptb-70">
        <div class="bg-square">
            <img src="{{ asset('assets/images/banner-square-img.svg') }}" alt="" />
        </div>
        <div class="container">
            <div class="about-hero-container">
                <img src="{{ $school->cover_image_url ? (str_starts_with($school->cover_image_url, 'http') ? $school->cover_image_url : env('BACKEND_URL') . '/' . ltrim($school->cover_image_url, '/')) : asset('assets/images/school-detail-banner-img.png') }}" alt="{{ $school->name }}" />

                <!-- Centered Badge -->
                <div class="about-us-badge-wrapper">
                    <button class="about-us-badge">{{ mb_strtoupper($school->name) }}</button>
                    <p><i class="fa-solid fa-location-dot me-1"></i> {{ $location ?: ($school->head_office_location ?? 'India') }}</p>
                </div>

                <!-- Green Down Arrow Button -->
                <button class="about-scroll-btn" aria-label="Scroll Down">
                    <img style="width: 49px; height: 62px" src="{{ asset('assets/images/inner-banner-down-arror.png') }}" alt="" />
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
                        <a href="{{ route('home') }}" class="text-decoration-none text-muted"><i class="fa-solid fa-house me-1"></i>
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
                        <a href="#address-contact" class="sd-location"><i class="fa-solid fa-location-dot me-1"></i> {{ $location ?: ($school->head_office_location ?? 'India') }}</a>
                    </div>
                    <span class="sd-status-badge">
                        <span class="sd-status-dot"></span> Status: {{ $school->status == 1 ? 'Admissions Open' : 'Closed' }}
                    </span>
                </div>

                <div class="sd-meta-row">
                    <div class="sd-meta-item">
                        <i class="fa-solid fa-book-open"></i> Boards: {{ !empty($boards) ? (is_array($boards) ? implode(', ', $boards) : $boards) : 'CBSE / International' }}
                    </div>
                    <div class="sd-meta-item">
                        <i class="fa-solid fa-graduation-cap"></i> Grades: {{ !empty($grades) ? (is_array($grades) ? implode(', ', $grades) : $grades) : 'Primary to Higher Secondary' }}
                    </div>
                    <div class="sd-meta-item">
                        <i class="fa-solid fa-calendar-days"></i> Estd. {{ $school->established_year ?: 'N/A' }}
                    </div>
                </div>

                <div class="sd-views-row">
                    <i class="fa-regular fa-eye me-1"></i> {{ $school->total_reviews ?? '1,240' }} Views &nbsp;|&nbsp; <i class="fa-solid fa-star text-warning me-1"></i> {{ $school->average_rating ?? '4.8' }} Rating
                </div>

                <h3 class="sd-about-title mt-4">About {{ $school->name }}</h3>
                <div class="sd-about-desc mb-0">{!! $school->about_organisation ?: '<p>'.$school->name.' is a premier educational institution committed to fostering academic excellence, holistic development, and character building.</p>' !!}</div>
            </div>
        </div>
    </div>

    <!-- Tab Pills Navigation -->
    <div style="background-color: #3771C812; padding: 20px 0px; margin-bottom: 40px;">
        <div class="sd-tab-pills-row mb-0">
            <button class="sd-tab-pill-btn active" data-tab-target="overview">Overview & Admission</button>
            <button class="sd-tab-pill-btn" data-tab-target="admissions">Admission Routes</button>
            <button class="sd-tab-pill-btn" data-tab-target="fee-structure">Fee Structure</button>
            <button class="sd-tab-pill-btn" data-tab-target="photos">Photos & Gallery</button>
            <button class="sd-tab-pill-btn" data-tab-target="reviews">Reviews</button>
        </div>
    </div>

    <!-- Main Content Tab Containers -->
    <div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    
                    <!-- Overview & Admission Section -->
                    <div class="sd-section-card" data-tab-content="overview">
                        <div class="row g-5">
                            <!-- Left Process Text -->
                            <div class="col-lg-7">
                                <h2 class="sd-section-title mb-4">Admission Process & Guidelines</h2>
                                <div style="font-size: 14px; line-height: 1.6; color: #4a5568">
                                    <p class="fw-bold mb-2">Step-by-Step Admission Procedure for {{ $school->name }}:</p>
                                    <ul class="ps-3 mb-4">
                                        <li class="mb-2"><strong>1. Registration:</strong> Submit the online registration form along with student birth certificate, academic report cards, and passport photographs.</li>
                                        <li class="mb-2"><strong>2. Aptitude Assessment & Interaction:</strong> Registered candidates will appear for an aptitude analysis and personal interaction session.</li>
                                        <li class="mb-2"><strong>3. Admission Confirmation:</strong> Provisional admission offer is issued upon meeting eligibility criteria and seat availability.</li>
                                        <li class="mb-2"><strong>4. Documentation & Verification:</strong> Submit mandatory verification documents (Aadhaar, Transfer Certificate, Medical Fitness).</li>
                                    </ul>

                                    <h4 class="fw-bold text-dark mb-2" style="font-size: 15px;">Eligibility Criteria</h4>
                                    <p class="mb-0">Admissions are open for eligible classes based on age criteria and previous class performance. Contact school counselors for detailed age cutoffs.</p>
                                </div>
                            </div>

                            <!-- Right Inquiry Form -->
                            <div class="col-lg-5">
                                <div class="sd-enquiry-card bg-white p-4 rounded-4 border shadow-sm" id="admission-enquiry-card">
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
                                            <label class="form-label fw-semibold" style="font-size: 13px;">Parent Name <span class="text-danger">*</span></label>
                                            <input type="text" name="name" id="parentNameInput" placeholder="Enter your name" class="form-control" required />
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label fw-semibold" style="font-size: 13px;">Phone Number <span class="text-danger">*</span></label>
                                            <input type="tel" name="phone" placeholder="Enter phone number" class="form-control" required />
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label fw-semibold" style="font-size: 13px;">Email Address</label>
                                            <input type="email" name="email" placeholder="Enter email address" class="form-control" />
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label fw-semibold" style="font-size: 13px;">Select Target Class</label>
                                            <select name="looking_for" id="enquiryClassSelect" class="form-select">
                                                <option value="Class 6 Admission" selected>Class 6 Admission</option>
                                                <option value="Class 7 Admission">Class 7 Admission</option>
                                                <option value="Class 8 Admission">Class 8 Admission</option>
                                                <option value="Class 9 Admission">Class 9 Admission</option>
                                                <option value="Class 11 Admission">Class 11 Admission</option>
                                            </select>
                                        </div>
                                        <div class="mb-4">
                                            <label class="form-label fw-semibold" style="font-size: 13px;">Message / Note</label>
                                            <textarea name="message" class="form-control" rows="2" placeholder="Any specific query for {{ $school->name }}..."></textarea>
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
                                        <td><span class="badge bg-success">{{ $route->status == 1 ? 'Ongoing' : 'Closed' }}</span></td>
                                        <td class="fw-bold">₹{{ number_format($route->application_fee ?? 2500) }}</td>
                                        <td>
                                            <button type="button" class="btn btn-primary btn-sm rounded-pill px-3 fw-bold" onclick="applyNowHandler('{{ addslashes($route->course->name ?? 'Class 6') }}')">Apply Now</button>
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
                                            <button type="button" class="btn btn-primary btn-sm rounded-pill px-3 fw-bold" onclick="applyNowHandler('General Admission')">Apply Now</button>
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
                                <div class="p-3 bg-white rounded-3 border mb-3 d-flex justify-content-between align-items-center">
                                    <div>
                                        <h5 class="fw-bold fs-6 mb-1">{{ $fee->course->name ?? 'Class Fee Structure' }}</h5>
                                        <span class="text-muted" style="font-size: 12px;">Session 2026-2027</span>
                                    </div>
                                    <span class="fs-5 fw-bold text-primary">₹{{ number_format($fee->total_tuition_fee ?? $fee->one_time_charges ?? 0) }}</span>
                                </div>
                                @empty
                                <div class="p-3 bg-white rounded-3 border mb-3 d-flex justify-content-between align-items-center">
                                    <div>
                                        <h5 class="fw-bold fs-6 mb-1">Annual Fee Structure (Classes 6 to 12)</h5>
                                        <span class="text-muted" style="font-size: 12px;">Includes Tuition, Boarding & Activities</span>
                                    </div>
                                    <span class="fs-6 fw-bold text-primary">Available On Request</span>
                                </div>
                                @endforelse
                            </div>

                            <div class="col-lg-4">
                                <div class="bg-light p-4 rounded-4 text-center border">
                                    <i class="fa-solid fa-headset text-primary fs-1 mb-2"></i>
                                    <h4 class="fw-bold fs-6 mb-2">Have Questions About Fees?</h4>
                                    <p class="text-muted mb-3" style="font-size: 12px;">Connect directly with admission officers for fee breakdowns & scholarship offers.</p>
                                    <a href="tel:{{ $school->helpdesk_contact_number ?? '' }}" class="btn btn-primary btn-sm rounded-pill w-100 fw-bold">
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
                                    <img src="{{ str_starts_with($school->cover_image_url, 'http') ? $school->cover_image_url : env('BACKEND_URL') . '/' . ltrim($school->cover_image_url, '/') }}" alt="{{ $school->name }}" style="width: 100%; height: 100%; object-fit: cover;" />
                                </div>
                            </div>
                            @endif
                            @if($school->logo_url)
                            <div class="col-md-6">
                                <div class="rounded-4 overflow-hidden border shadow-sm p-4 bg-white d-flex align-items-center justify-content-center" style="height: 250px;">
                                    <img src="{{ str_starts_with($school->logo_url, 'http') ? $school->logo_url : env('BACKEND_URL') . '/' . ltrim($school->logo_url, '/') }}" alt="{{ $school->name }} Logo" style="max-height: 180px; object-fit: contain;" />
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
                                        <span class="text-warning" style="font-size: 12px;"><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i></span>
                                    </div>
                                    <p class="text-muted mb-0" style="font-size: 13px;">"Outstanding school infrastructure, faculty, and sports facilities. My daughter has grown immensely confident!"</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="p-4 bg-white rounded-4 border shadow-sm h-100">
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <span class="fw-bold">Simran Kaur (Alumni)</span>
                                        <span class="text-warning" style="font-size: 12px;"><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i></span>
                                    </div>
                                    <p class="text-muted mb-0" style="font-size: 13px;">"Great environment, excellent boarding facility, and dedicated teachers. Highly recommended!"</p>
                                </div>
                            </div>
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
                                    <p class="text-muted mb-0" style="font-size: 12px;">{{ $school->head_office_location ?? $location ?: 'Dehradun, Uttarakhand' }}</p>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6">
                                <div class="p-3 bg-white rounded-3 border text-center">
                                    <i class="fa-solid fa-globe text-success fs-4 mb-2"></i>
                                    <h6 class="fw-bold mb-1">Official Website</h6>
                                    <p class="text-muted mb-0" style="font-size: 12px;">
                                        @if($school->official_website)
                                            <a href="{{ str_starts_with($school->official_website, 'http') ? $school->official_website : 'https://' . $school->official_website }}" target="_blank" class="text-decoration-none text-primary">{{ $school->official_website }}</a>
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
                                    <p class="text-muted mb-0" style="font-size: 12px;">{{ $school->helpdesk_contact_number ?? 'Available On Request' }}</p>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6">
                                <div class="p-3 bg-white rounded-3 border text-center">
                                    <i class="fa-solid fa-envelope text-info fs-4 mb-2"></i>
                                    <h6 class="fw-bold mb-1">Email ID</h6>
                                    <p class="text-muted mb-0" style="font-size: 12px;">{{ $school->helpdesk_email ?? 'Available On Request' }}</p>
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

            window.switchTab = function(targetTab) {
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

            window.applyNowHandler = function(className) {
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
        });
    </script>
@endsection
