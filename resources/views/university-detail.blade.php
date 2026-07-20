@extends('layouts.app')

@section('content')
<main class="about-hero-section ptb-70">
        <div class="bg-square">
            <img src="{{ asset('assets/images/banner-square-img.svg') }}" alt="" />
        </div>
        <div class="container">
            <div class="about-hero-container">
                <img src="{{ $university->cover_image_url ? (str_starts_with($university->cover_image_url, 'http') ? $university->cover_image_url : rtrim(env('BACKEND_URL', 'http://127.0.0.1:8001'), '/') . '/' . ltrim($university->cover_image_url, '/')) : asset('assets/images/school-detail-banner-img.png') }}" alt="{{ $university->name }}" />

                <!-- Centered Badge -->
                <div class="about-us-badge-wrapper">
                    <button class="about-us-badge">{{ mb_strtoupper($university->name) }}</button>
                    <p><i class="fa-solid fa-location-dot me-1"></i> {{ $location ?: ($university->head_office_location ?? 'India') }}</p>
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
                        <a href="{{ route('university') }}" class="text-decoration-none active text-primary">Universities</a>
                    </li>
                    <li class="breadcrumb-item active text-primary" aria-current="page">{{ $university->name }}</li>
                </ol>
            </nav>
        </div>
    </div>

    <!-- Main Content wrapper -->
    <div style="padding: 40px 0; padding-bottom: 0;">
        <div class="container">
            <!-- University Info Header Card -->
            <div class="sd-info-card">
                <div class="sd-title-row">
                    <div class="sd-title-box">
                        <h1 class="sd-title">{{ $university->name }}</h1>
                        <a href="#address-contact" class="sd-location"><i class="fa-solid fa-location-dot me-1"></i> {{ $location ?: ($university->head_office_location ?? 'India') }}</a>
                    </div>
                    <span class="sd-status-badge">
                        <span class="sd-status-dot"></span> Status: {{ $university->status == 1 ? 'Admissions Open' : 'Closed' }}
                    </span>
                </div>

                <div class="sd-meta-row">
                    <div class="sd-meta-item">
                        <i class="fa-solid fa-graduation-cap"></i> Type: {{ $university->university_type ?: 'Autonomous' }}
                    </div>
                    <div class="sd-meta-item">
                        <i class="fa-solid fa-building"></i> Ownership: {{ $university->ownership_type ?: 'Private' }}
                    </div>
                    <div class="sd-meta-item">
                        <i class="fa-solid fa-calendar-days"></i> Estd. {{ $university->established_year ?: 'N/A' }}
                    </div>
                </div>

                <div class="sd-views-row">
                    @if($university->nirf_rank_overall)
                        <i class="fa-solid fa-star text-warning me-1"></i> NIRF Rank: <strong>#{{ $university->nirf_rank_overall }}</strong> &nbsp;|&nbsp;
                    @endif
                    <i class="fa-regular fa-eye me-1"></i> {{ $university->total_reviews ?? '1,890' }} Views
                </div>

                <h3 class="sd-about-title mt-4">About {{ $university->name }}</h3>
                <div class="sd-about-desc mb-0">{!! $university->about_organisation ?: '<p>'.$university->name.' is a premier educational institution committed to fostering academic excellence, research, and holistic development.</p>' !!}</div>
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
                                    <p class="fw-bold mb-2">Step-by-Step Admission Procedure for {{ $university->name }}:</p>
                                    <ul class="ps-3 mb-4">
                                        <li class="mb-2"><strong>1. Registration & Application:</strong> Fill the online registration form and upload academic scores, entrance exam scorecard (JEE/CAT/GATE/CUET etc.).</li>
                                        <li class="mb-2"><strong>2. Cutoff/Entrance Merit:</strong> Merit lists are published based on entrance examinations or academic percentages.</li>
                                        <li class="mb-2"><strong>3. Counseling & Document Verification:</strong> Seat allocation counseling sessions followed by certificate verification.</li>
                                        <li class="mb-2"><strong>4. Admission Fee Payment:</strong> Confirm admission by submitting the semester fee.</li>
                                    </ul>

                                    <h4 class="fw-bold text-dark mb-2" style="font-size: 15px;">Eligibility Criteria</h4>
                                    <p class="mb-0">Admissions are open for eligible undergraduate (UG), postgraduate (PG), and doctoral programs. Please contact the counselors or verify specific program eligibility criteria.</p>
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
                                        <input type="hidden" name="type" value="University Admission">
                                        <input type="hidden" name="company" value="{{ $university->name }}">
                                        
                                        <div class="mb-3">
                                            <label class="form-label fw-semibold" style="font-size: 13px;">Applicant Name <span class="text-danger">*</span></label>
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
                                            <label class="form-label fw-semibold" style="font-size: 13px;">Select Program Interested</label>
                                            <select name="looking_for" id="enquiryClassSelect" class="form-select">
                                                <option value="B.Tech Admission" selected>B.Tech Admission</option>
                                                <option value="MBA Admission">MBA Admission</option>
                                                <option value="BBA Admission">BBA Admission</option>
                                                <option value="BCA/MCA Admission">BCA/MCA Admission</option>
                                                <option value="M.Tech Admission">M.Tech Admission</option>
                                                <option value="Ph.D Admission">Ph.D Admission</option>
                                                <option value="General UG Admission">General UG Admission</option>
                                                <option value="General PG Admission">General PG Admission</option>
                                            </select>
                                        </div>
                                        <div class="mb-4">
                                            <label class="form-label fw-semibold" style="font-size: 13px;">Message / Note</label>
                                            <textarea name="message" class="form-control" rows="2" placeholder="Any specific query for {{ $university->name }}..."></textarea>
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
                                        <th>Course / Program</th>
                                        <th>Academic Session</th>
                                        <th>Last Application Date</th>
                                        <th>Status</th>
                                        <th>Application Fee</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($university->admissionRoutes as $route)
                                    <tr>
                                        <td class="fw-bold">{{ $route->course->name ?? 'Undergraduate Programs' }}</td>
                                        <td>2026-2027</td>
                                        <td>{{ $route->cutoff_year_wise ?? 'Rolling Admissions' }}</td>
                                        <td><span class="badge bg-success">{{ $route->status == 1 ? 'Ongoing' : 'Closed' }}</span></td>
                                        <td class="fw-bold">₹{{ number_format($route->application_fee ?? 1500) }}</td>
                                        <td>
                                            <button type="button" class="btn btn-primary btn-sm rounded-pill px-3 fw-bold" onclick="applyNowHandler('{{ addslashes($route->course->name ?? 'B.Tech') }}')">Apply Now</button>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td class="fw-bold">General Admissions</td>
                                        <td>2026-2027</td>
                                        <td>Jul 31, 2026</td>
                                        <td><span class="badge bg-success">Ongoing</span></td>
                                        <td class="fw-bold">Contact University</td>
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
                                @forelse($university->feeStructures as $fee)
                                <div class="p-3 bg-white rounded-3 border mb-3 d-flex justify-content-between align-items-center">
                                    <div>
                                        <h5 class="fw-bold fs-6 mb-1">{{ $fee->course->name ?? 'Course Fee Structure' }}</h5>
                                        <span class="text-muted" style="font-size: 12px;">Session 2026-2027</span>
                                    </div>
                                    <span class="fs-5 fw-bold text-primary">₹{{ number_format($fee->total_tuition_fee ?? $fee->one_time_charges ?? 0) }}</span>
                                </div>
                                @empty
                                <div class="p-3 bg-white rounded-3 border mb-3 d-flex justify-content-between align-items-center">
                                    <div>
                                        <h5 class="fw-bold fs-6 mb-1">Annual Fee Structure (Tuition + Admin Fee)</h5>
                                        <span class="text-muted" style="font-size: 12px;">Courses vary from B.Tech, MBA, BCA</span>
                                    </div>
                                    <span class="fs-6 fw-bold text-primary">Available On Request</span>
                                </div>
                                @endforelse
                            </div>

                            <div class="col-lg-4">
                                <div class="bg-light p-4 rounded-4 text-center border">
                                    <i class="fa-solid fa-headset text-primary fs-1 mb-2"></i>
                                    <h4 class="fw-bold fs-6 mb-2">Have Questions About Fees?</h4>
                                    <p class="text-muted mb-3" style="font-size: 12px;">Connect directly with university counselors for detailed scholarship information.</p>
                                    <a href="tel:{{ $university->helpdesk_contact_number ?? '' }}" class="btn btn-primary btn-sm rounded-pill w-100 fw-bold">
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
                            @if($university->cover_image_url)
                            <div class="col-md-6">
                                <div class="rounded-4 overflow-hidden border shadow-sm" style="height: 250px;">
                                    <img src="{{ str_starts_with($university->cover_image_url, 'http') ? $university->cover_image_url : rtrim(env('BACKEND_URL', 'http://127.0.0.1:8001'), '/') . '/' . ltrim($university->cover_image_url, '/') }}" alt="{{ $university->name }}" style="width: 100%; height: 100%; object-fit: cover;" />
                                </div>
                            </div>
                            @endif
                            @if($university->logo_url)
                            <div class="col-md-6">
                                <div class="rounded-4 overflow-hidden border shadow-sm p-4 bg-white d-flex align-items-center justify-content-center" style="height: 250px;">
                                    <img src="{{ str_starts_with($university->logo_url, 'http') ? $university->logo_url : rtrim(env('BACKEND_URL', 'http://127.0.0.1:8001'), '/') . '/' . ltrim($university->logo_url, '/') }}" alt="{{ $university->name }} Logo" style="max-height: 180px; object-fit: contain;" />
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>

                    <!-- Reviews Section -->
                    <div class="sd-section-card" data-tab-content="reviews">
                        <h2 class="sd-section-title fs-4 fw-bold mb-4">Student & Alumni Reviews</h2>
                        <div class="row g-4">
                            <div class="col-md-6">
                                <div class="p-4 bg-white rounded-4 border shadow-sm h-100">
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <span class="fw-bold">Aman Rawat (B.Tech Student)</span>
                                        <span class="text-warning" style="font-size: 12px;"><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i></span>
                                    </div>
                                    <p class="text-muted mb-0" style="font-size: 13px;">"Amazing academic rigor, experienced faculty, and outstanding campus placement cell. Recommended for everyone!"</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="p-4 bg-white rounded-4 border shadow-sm h-100">
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <span class="fw-bold">Neha Sen (MBA Alumni)</span>
                                        <span class="text-warning" style="font-size: 12px;"><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star-o"></i></span>
                                    </div>
                                    <p class="text-muted mb-0" style="font-size: 13px;">"Highly collaborative environment, great industrial exposure, and supportive community. Hostels are clean."</p>
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
                                    <p class="text-muted mb-0" style="font-size: 12px;">{{ $university->head_office_location ?? $location ?: 'Dehradun, Uttarakhand' }}</p>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6">
                                <div class="p-3 bg-white rounded-3 border text-center">
                                    <i class="fa-solid fa-globe text-success fs-4 mb-2"></i>
                                    <h6 class="fw-bold mb-1">Official Website</h6>
                                    <p class="text-muted mb-0" style="font-size: 12px;">
                                        @if($university->official_website)
                                            <a href="{{ str_starts_with($university->official_website, 'http') ? $university->official_website : 'https://' . $university->official_website }}" target="_blank" class="text-decoration-none text-primary">{{ $university->official_website }}</a>
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
                                    <p class="text-muted mb-0" style="font-size: 12px;">{{ $university->helpdesk_contact_number ?? 'Available On Request' }}</p>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6">
                                <div class="p-3 bg-white rounded-3 border text-center">
                                    <i class="fa-solid fa-envelope text-info fs-4 mb-2"></i>
                                    <h6 class="fw-bold mb-1">Email ID</h6>
                                    <p class="text-muted mb-0" style="font-size: 12px;">{{ $university->helpdesk_email ?? 'Available On Request' }}</p>
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
