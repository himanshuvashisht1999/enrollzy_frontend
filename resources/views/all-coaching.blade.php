@extends('layouts.app')
@section('content')
<main class="about-hero-section ptb-70">
      <div class="bg-square">
        <img src="assets/images/banner-square-img.svg" alt="" />
      </div>
      <div class="container">
        <div class="about-hero-container">
          <img src="assets/images/school-banner-img.png" alt="" />

          <!-- Centered Badge (Placed outside card to prevent clipping) -->
          <div class="about-us-badge-wrapper">
            <button class="about-us-badge">All Coaching Institutes</button>
            <p>Explore our complete list of schools.</p>
          </div>

          <!-- Green Down Arrow Button -->
          <button class="about-scroll-btn" aria-label="Scroll Down">
            <img
              style="width: 49px; height: 62px"
              src="assets/images/inner-banner-down-arror.png"
              alt=""
            />
          </button>
        </div>
      </div>
    </main>

    <!-- Breadcrumb path & Explore Button -->
    <div class="py-3" style="background-color: #f9ad0b14">
        <div class="container d-flex justify-content-between align-items-center flex-wrap gap-2">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0" style="font-size: 13.5px; font-weight: 500;">
                    <li class="breadcrumb-item"><a href="#" class="text-decoration-none text-muted"><i class="fa-solid fa-house me-1"></i> Home</a></li>
                    <li class="breadcrumb-item active text-primary" aria-current="page">Coaching Institutes</li>
                </ol>
            </nav>
        </div>
    </div>
    <div style="background-color: #3771C812;padding: 20px 0px;text-align: center;">
    <a href="#" class="btn btn-primary rounded-pill px-4" style="background-color: #3771C8; border: none; font-size: 14px; font-weight: bold; height: 34px; display: inline-flex; align-items: center; justify-content: center;">Explore Coaching Institutes</a>

    </div>
    <!-- Main Content Section -->
    <section class="py-5" style="background-color: #FAFBFD;">
        <div class="container">
            <!-- School Hero Intro Card -->
            <div class="school-hero-card">
                <h2 class="school-hero-title">Top Coaching Institutes in India 2026-27: Fees, Admissions, Rankings & Reviews</h2>
                <p class="school-hero-text">We've curated a list of best Coaching Institutes in India for 2026-27, sorted by our default Rankings, a trusted system on a holistic evaluation of a school's academic excellence, infrastructure, extracurriculars, teacher quality, and real parent reviews (<a href="#" class="text-primary text-decoration-none">learn more</a>).</p>
                <p class="school-hero-text text-muted mb-0" style="font-size: 13px;">The top 10 Coaching Institutes in India include The Doon School, The Scindia School, Woodstock School, JAIN International Residential School, Aspyreom International Finishing School, Mussoorie International School, Welham Boys' School, The Academic City School - Bangalore, GD Goenka International School, Welham Girls' School. Scroll down to compare fees and admissions, read reviews, and apply to find the perfect school for your child.</p>
            </div>

            <div class="row g-4">
                <!-- Left Sidebar Filters -->
                <div class="col-lg-3 col-md-4">
                    <div class="filter-sidebar-wrapper">
                       
                        <!-- Regions Accordion -->
                        <div class="filter-group-card mb-3">
                            <div class="filter-group-header d-flex justify-content-between align-items-center" data-bs-toggle="collapse" data-bs-target="#filterRegions" aria-expanded="true">
                                <span>Regions</span>
                                <i class="fa-solid fa-chevron-down"></i>
                            </div>
                            <div class="collapse show" id="filterRegions">
                                <div class="filter-group-body">
                                    <div class="filter-checklist">
                                        <div class="form-check mb-2"><input class="form-check-input" type="checkbox" id="reg1"><label class="form-check-label ms-1" for="reg1">North India</label></div>
                                        <div class="form-check mb-2"><input class="form-check-input" type="checkbox" id="reg2"><label class="form-check-label ms-1" for="reg2">South India</label></div>
                                        <div class="form-check mb-2"><input class="form-check-input" type="checkbox" id="reg3"><label class="form-check-label ms-1" for="reg3">East India</label></div>
                                        <div class="form-check mb-2"><input class="form-check-input" type="checkbox" id="reg4"><label class="form-check-label ms-1" for="reg4">West India</label></div>
                                        <div class="form-check mb-2"><input class="form-check-input" type="checkbox" id="reg5"><label class="form-check-label ms-1" for="reg5">Central India</label></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- State Accordion -->
                        <div class="filter-group-card mb-3">
                            <div class="filter-group-header d-flex justify-content-between align-items-center" data-bs-toggle="collapse" data-bs-target="#filterState" aria-expanded="true">
                                <span>State</span>
                                <i class="fa-solid fa-chevron-down"></i>
                            </div>
                            <div class="collapse show" id="filterState">
                                <div class="filter-group-body">
                                    <div class="filter-search-wrapper mb-3">
                                        <i class="fa-solid fa-magnifying-glass"></i>
                                        <input type="text" placeholder="Search by state name" class="form-control">
                                    </div>
                                    <div class="filter-checklist" style=" overflow-y: auto;">
                                        <div class="form-check d-flex justify-content-between align-items-center mb-2"><div><input class="form-check-input" type="checkbox" id="st1"><label class="form-check-label ms-1" for="st1">Tamil Nadu</label></div><span class="text-muted" style="font-size: 11.5px;">(14)</span></div>
                                        <div class="form-check d-flex justify-content-between align-items-center mb-2"><div><input class="form-check-input" type="checkbox" id="st2"><label class="form-check-label ms-1" for="st2">Karnataka</label></div><span class="text-muted" style="font-size: 11.5px;">(14)</span></div>
                                        <div class="form-check d-flex justify-content-between align-items-center mb-2"><div><input class="form-check-input" type="checkbox" id="st3"><label class="form-check-label ms-1" for="st3">Andhra Pradesh</label></div><span class="text-muted" style="font-size: 11.5px;">(14)</span></div>
                                        <div class="form-check d-flex justify-content-between align-items-center mb-2"><div><input class="form-check-input" type="checkbox" id="st4"><label class="form-check-label ms-1" for="st4">Rajasthan</label></div><span class="text-muted" style="font-size: 11.5px;">(14)</span></div>
                                        <div class="form-check d-flex justify-content-between align-items-center mb-2"><div><input class="form-check-input" type="checkbox" id="st5"><label class="form-check-label ms-1" for="st5">Punjab</label></div><span class="text-muted" style="font-size: 11.5px;">(14)</span></div>
                                        <div class="form-check d-flex justify-content-between align-items-center mb-2"><div><input class="form-check-input" type="checkbox" id="st6"><label class="form-check-label ms-1" for="st6">Himachal Pradesh</label></div><span class="text-muted" style="font-size: 11.5px;">(14)</span></div>
                                        <div class="form-check d-flex justify-content-between align-items-center mb-2"><div><input class="form-check-input" type="checkbox" id="st7"><label class="form-check-label ms-1" for="st7">Haryana</label></div><span class="text-muted" style="font-size: 11.5px;">(14)</span></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- City Accordion -->
                        <div class="filter-group-card mb-3">
                            <div class="filter-group-header d-flex justify-content-between align-items-center" data-bs-toggle="collapse" data-bs-target="#filterCity" aria-expanded="false">
                                <span>City</span>
                                <i class="fa-solid fa-chevron-down"></i>
                            </div>
                            <div class="collapse" id="filterCity">
                                <div class="filter-group-body">
                                    <div class="filter-search-wrapper mb-3">
                                        <i class="fa-solid fa-magnifying-glass"></i>
                                        <input type="text" placeholder="Search by city name" class="form-control">
                                    </div>
                                    <div class="filter-checklist">
                                        <div class="form-check mb-2"><input class="form-check-input" type="checkbox" id="cy1"><label class="form-check-label ms-1" for="cy1">Bangalore</label></div>
                                        <div class="form-check mb-2"><input class="form-check-input" type="checkbox" id="cy2"><label class="form-check-label ms-1" for="cy2">Dehradun</label></div>
                                        <div class="form-check mb-2"><input class="form-check-input" type="checkbox" id="cy3"><label class="form-check-label ms-1" for="cy3">Hyderabad</label></div>
                                        <div class="form-check mb-2"><input class="form-check-input" type="checkbox" id="cy3"><label class="form-check-label ms-1" for="cy3">Panchgani</label></div>
                                        <div class="form-check mb-2"><input class="form-check-input" type="checkbox" id="cy3"><label class="form-check-label ms-1" for="cy3">Varanasi</label></div>
                                        <div class="form-check mb-2"><input class="form-check-input" type="checkbox" id="cy3"><label class="form-check-label ms-1" for="cy3">Nainital</label></div>
                                        <div class="form-check mb-2"><input class="form-check-input" type="checkbox" id="cy3"><label class="form-check-label ms-1" for="cy3">Patna</label></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Area Accordion -->
                        <div class="filter-group-card mb-3">
                            <div class="filter-group-header d-flex justify-content-between align-items-center" data-bs-toggle="collapse" data-bs-target="#filterArea" aria-expanded="false">
                                <span>Area</span>
                                <i class="fa-solid fa-chevron-down"></i>
                            </div>
                            <div class="collapse" id="filterArea">
                                <div class="filter-group-body">
                                    <div class="filter-search-wrapper mb-3">
                                        <i class="fa-solid fa-magnifying-glass"></i>
                                        <input type="text" placeholder="Search by area name" class="form-control">
                                    </div>
                                    <div class="filter-checklist">
                                        <div class="form-check mb-2"><input class="form-check-input" type="checkbox" id="ar1"><label class="form-check-label ms-1" for="ar1">Mansarovar, Jaipur</label></div>
                                        <div class="form-check mb-2"><input class="form-check-input" type="checkbox" id="ar2"><label class="form-check-label ms-1" for="ar2">Rohini, Delhi</label></div>
                                        <div class="form-check mb-2"><input class="form-check-input" type="checkbox" id="ar2"><label class="form-check-label ms-1" for="ar2">Vaishali Nagar, Jaipur</label></div>
                                        <div class="form-check mb-2"><input class="form-check-input" type="checkbox" id="ar2"><label class="form-check-label ms-1" for="ar2">Medchal, Jaipur</label></div>
                                        <div class="form-check mb-2"><input class="form-check-input" type="checkbox" id="ar2"><label class="form-check-label ms-1" for="ar2">Chandigarh, Punjab</label></div>
                                        <div class="form-check mb-2"><input class="form-check-input" type="checkbox" id="ar2"><label class="form-check-label ms-1" for="ar2">Mansarovar, Jaipur</label></div>
                                        <div class="form-check mb-2"><input class="form-check-input" type="checkbox" id="ar2"><label class="form-check-label ms-1" for="ar2">Mansarovar, Jaipur</label></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Annual Fees Accordion -->
                        <div class="filter-group-card mb-3">
                            <div class="filter-group-header d-flex justify-content-between align-items-center" data-bs-toggle="collapse" data-bs-target="#filterFees" aria-expanded="true">
                                <span>Annual Fees</span>
                                <i class="fa-solid fa-chevron-down"></i>
                            </div>
                            <div class="collapse show" id="filterFees">
                                <div class="filter-group-body">
                                    <span class="text-muted fw-bold d-block mb-2" style="font-size: 11px; text-transform: uppercase;">Suggestion</span>
                                    <div class="filter-checklist mb-3">
                                        <div class="form-check mb-2"><input class="form-check-input" type="radio" name="fee_sugg" id="fs1"><label class="form-check-label ms-1" for="fs1">Below 1 lakh</label></div>
                                        <div class="form-check mb-2"><input class="form-check-input" type="radio" name="fee_sugg" id="fs2"><label class="form-check-label ms-1" for="fs2">1 lakh to 2 lakhs</label></div>
                                        <div class="form-check mb-2"><input class="form-check-input" type="radio" name="fee_sugg" id="fs3"><label class="form-check-label ms-1" for="fs3">2 lakh to 3 lakhs</label></div>
                                        <div class="form-check mb-2"><input class="form-check-input" type="radio" name="fee_sugg" id="fs4"><label class="form-check-label ms-1" for="fs4">3 lakh to 5 lakhs</label></div>
                                        <div class="form-check mb-2"><input class="form-check-input" type="radio" name="fee_sugg" id="fs4"><label class="form-check-label ms-1" for="fs4">3 lakh to 5 lakhs</label></div>
                                        <div class="form-check mb-2"><input class="form-check-input" type="radio" name="fee_sugg" id="fs4"><label class="form-check-label ms-1" for="fs4">3 lakh to 5 lakhs</label></div>
                                        <div class="form-check mb-2"><input class="form-check-input" type="radio" name="fee_sugg" id="fs4"><label class="form-check-label ms-1" for="fs4">3 lakh to 5 lakhs</label></div>
                                    </div>
                                    <span class="text-muted fw-bold d-block mb-2" style="font-size: 11px; text-transform: uppercase;">Enter Manually</span>
                                    <div class="d-flex gap-2">
                                        <input type="text" placeholder="From" class="form-control text-center py-1" style="font-size: 12.5px; border-radius: 6px;">
                                        <input type="text" placeholder="To" class="form-control text-center py-1" style="font-size: 12.5px; border-radius: 6px;">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Class Accordion -->
                        <div class="filter-group-card mb-3">
                            <div class="filter-group-header d-flex justify-content-between align-items-center" data-bs-toggle="collapse" data-bs-target="#filterClass" aria-expanded="false">
                                <span>Class</span>
                                <i class="fa-solid fa-chevron-down"></i>
                            </div>
                            <div class="collapse" id="filterClass">
                                <div class="filter-group-body">
                                    <div class="filter-checklist">
                                        <div class="form-check mb-2"><input class="form-check-input" type="checkbox" id="cl1"><label class="form-check-label ms-1" for="cl1">Toddlers</label></div>
                                        <div class="form-check mb-2"><input class="form-check-input" type="checkbox" id="cl2"><label class="form-check-label ms-1" for="cl2">Pre Nursery</label></div>
                                        <div class="form-check mb-2"><input class="form-check-input" type="checkbox" id="cl3"><label class="form-check-label ms-1" for="cl3">Nursery</label></div>
                                        <div class="form-check mb-2"><input class="form-check-input" type="checkbox" id="cl3"><label class="form-check-label ms-1" for="cl3">LKG</label></div>
                                        <div class="form-check mb-2"><input class="form-check-input" type="checkbox" id="cl3"><label class="form-check-label ms-1" for="cl3">UKG</label></div>
                                        <div class="form-check mb-2"><input class="form-check-input" type="checkbox" id="cl3"><label class="form-check-label ms-1" for="cl3">Class 1</label></div>
                                        <div class="form-check mb-2"><input class="form-check-input" type="checkbox" id="cl3"><label class="form-check-label ms-1" for="cl3">Class 2</label></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Board Accordion -->
                        <div class="filter-group-card mb-3">
                            <div class="filter-group-header d-flex justify-content-between align-items-center" data-bs-toggle="collapse" data-bs-target="#filterBoard" aria-expanded="false">
                                <span>Board</span>
                                <i class="fa-solid fa-chevron-down"></i>
                            </div>
                            <div class="collapse" id="filterBoard">
                                <div class="filter-group-body">
                                    <div class="filter-checklist">
                                        <div class="form-check mb-2"><input class="form-check-input" type="checkbox" id="bd1"><label class="form-check-label ms-1" for="bd1">CBSE</label></div>
                                        <div class="form-check mb-2"><input class="form-check-input" type="checkbox" id="bd2"><label class="form-check-label ms-1" for="bd2">ICSE/CISE</label></div>
                                        <div class="form-check mb-2"><input class="form-check-input" type="checkbox" id="bd3"><label class="form-check-label ms-1" for="bd3">State Board</label></div>
                                        <div class="form-check mb-2"><input class="form-check-input" type="checkbox" id="bd3"><label class="form-check-label ms-1" for="bd3">NIOS</label></div>
                                        <div class="form-check mb-2"><input class="form-check-input" type="checkbox" id="bd3"><label class="form-check-label ms-1" for="bd3">Finland</label></div>
                                        <div class="form-check mb-2"><input class="form-check-input" type="checkbox" id="bd3"><label class="form-check-label ms-1" for="bd3">Finland</label></div>
                                        <div class="form-check mb-2"><input class="form-check-input" type="checkbox" id="bd3"><label class="form-check-label ms-1" for="bd3">Finland</label></div>
                                        <div class="form-check mb-2"><input class="form-check-input" type="checkbox" id="bd3"><label class="form-check-label ms-1" for="bd3">Finland</label></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Ownership Accordion -->
                        <div class="filter-group-card mb-3">
                            <div class="filter-group-header d-flex justify-content-between align-items-center" data-bs-toggle="collapse" data-bs-target="#filterOwnership" aria-expanded="false">
                                <span>Ownership</span>
                                <i class="fa-solid fa-chevron-down"></i>
                            </div>
                            <div class="collapse show" id="filterOwnership">
                                <div class="filter-group-body">
                                    <div class="filter-checklist">
                                        <div class="form-check d-flex justify-content-between align-items-center mb-2"><div><input class="form-check-input" type="checkbox" id="sct1"><label class="form-check-label ms-1" for="sct1">Goverment</label></div><span class="text-muted" style="font-size: 11px;">(28)</span></div>
                                        <div class="form-check d-flex justify-content-between align-items-center mb-2"><div><input class="form-check-input" type="checkbox" id="sct2" checked><label class="form-check-label ms-1" for="sct2">Private</label></div><span class="text-muted" style="font-size: 11px;">(1427)</span></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="filter-group-card mb-3">
                            <div class="filter-group-header d-flex justify-content-between align-items-center" data-bs-toggle="collapse" data-bs-target="#filterSchoolType" aria-expanded="true">
                                <span>School Type</span>
                                <i class="fa-solid fa-chevron-down"></i>
                            </div>
                            <div class="collapse show" id="filterSchoolType">
                                <div class="filter-group-body">
                                    <div class="filter-checklist">
                                        <div class="form-check d-flex justify-content-between align-items-center mb-2"><div><input class="form-check-input" type="checkbox" id="sct1"><label class="form-check-label ms-1" for="sct1">Weekly Boarding</label></div><span class="text-muted" style="font-size: 11px;">(28)</span></div>
                                        <div class="form-check d-flex justify-content-between align-items-center mb-2"><div><input class="form-check-input" type="checkbox" id="sct2" checked><label class="form-check-label ms-1" for="sct2">Day Boarding</label></div><span class="text-muted" style="font-size: 11px;">(1427)</span></div>
                                        <div class="form-check d-flex justify-content-between align-items-center mb-2"><div><input class="form-check-input" type="checkbox" id="sct3"><label class="form-check-label ms-1" for="sct3">Full Boarding</label></div><span class="text-muted" style="font-size: 11px;">(714)</span></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="filter-group-card mb-3">
                            <div class="filter-group-header d-flex justify-content-between align-items-center" data-bs-toggle="collapse" data-bs-target="#filterSchoolType" aria-expanded="true">
                                <span>Food Options</span>
                                <i class="fa-solid fa-chevron-down"></i>
                            </div>
                            <div class="collapse show" id="filterSchoolType">
                                <div class="filter-group-body">
                                    <div class="filter-checklist">
                                        <div class="form-check d-flex justify-content-between align-items-center mb-2"><div><input class="form-check-input" type="checkbox" id="sct1"><label class="form-check-label ms-1" for="sct1">Vegetarian</label></div><span class="text-muted" style="font-size: 11px;">(28)</span></div>
                                        <div class="form-check d-flex justify-content-between align-items-center mb-2"><div><input class="form-check-input" type="checkbox" id="sct2" checked><label class="form-check-label ms-1" for="sct2">Non Vegetarian</label></div><span class="text-muted" style="font-size: 11px;">(1427)</span></div>
                                        <div class="form-check d-flex justify-content-between align-items-center mb-2"><div><input class="form-check-input" type="checkbox" id="sct3"><label class="form-check-label ms-1" for="sct3">Eggetarian</label></div><span class="text-muted" style="font-size: 11px;">(714)</span></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="filter-group-card mb-3">
                            <div class="filter-group-header d-flex justify-content-between align-items-center" data-bs-toggle="collapse" data-bs-target="#filterSchoolType" aria-expanded="true">
                                <span>Gender</span>
                                <i class="fa-solid fa-chevron-down"></i>
                            </div>
                            <div class="collapse show" id="filterSchoolType">
                                <div class="filter-group-body">
                                    <div class="filter-checklist">
                                        <div class="form-check d-flex justify-content-between align-items-center mb-2"><div><input class="form-check-input" type="checkbox" id="sct1"><label class="form-check-label ms-1" for="sct1">Coed</label></div><span class="text-muted" style="font-size: 11px;">(28)</span></div>
                                        <div class="form-check d-flex justify-content-between align-items-center mb-2"><div><input class="form-check-input" type="checkbox" id="sct2" checked><label class="form-check-label ms-1" for="sct2">Boys</label></div><span class="text-muted" style="font-size: 11px;">(1427)</span></div>
                                        <div class="form-check d-flex justify-content-between align-items-center mb-2"><div><input class="form-check-input" type="checkbox" id="sct3"><label class="form-check-label ms-1" for="sct3">Girls</label></div><span class="text-muted" style="font-size: 11px;">(714)</span></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right catalog list grid -->
                <div class="col-lg-9 col-md-8">
                    <!-- Title header info -->
                    <div class="catalog-header-bar d-flex justify-content-between align-items-center flex-wrap gap-3">
                        <div class="d-flex align-items-center gap-2">
                            <span class="fw-bold" style="font-size: 16px; color: #3771C8;">Coaching Institutes in India</span>
                            <span class="text-muted" style="font-size: 16px;">- {{ $coachings->total() }} Coaching Institutes | Updated at : {{ now()->format('d M Y, h:i a') }}</span>
                        </div>
                    </div>

                    <!-- Coaching Institutes Grid row -->
                    <div class="row row-cols-1 row-cols-md-2 g-4">
                        @foreach($coachings as $coaching)
                        <div class="col">
                            <div class="school-card">
                                <div class="swiper school-image-swiper">
                                    <div class="swiper-wrapper">
                                        <div class="swiper-slide">
                                            <a href="{{ route('coaching.detail', $coaching->slug) }}">
                                                <img src="{{ $coaching->cover_image_url ? (str_starts_with($coaching->cover_image_url, 'http') ? $coaching->cover_image_url : rtrim(env('BACKEND_URL', 'http://127.0.0.1:8001'), '/') . '/' . ltrim($coaching->cover_image_url, '/')) : asset('assets/images/about_team_meeting.png') }}" alt="{{ $coaching->name }} Cover">
                                            </a>
                                        </div>
                                    </div>
                                    <div class="swiper-pagination"></div>
                                    <span class="school-rating-badge"><i class="fa-solid fa-star"></i> {{ $coaching->average_rating ?? '4.5' }}</span>
                                    @if($coaching->minority_type || $coaching->brand_type)
                                    <span class="school-gender-badge">{{ $coaching->minority_type ?? $coaching->brand_type }}</span>
                                    @endif
                                    <button class="btn-school-compare">Compare</button>
                                </div>
                                <div class="school-info-body">
                                    <div class="school-identity-row">
                                        <div class="school-logo-box" style="width: 48px; height: 48px; flex-shrink: 0;">
                                            <img src="{{ $coaching->logo_url ? (str_starts_with($coaching->logo_url, 'http') ? $coaching->logo_url : rtrim(env('BACKEND_URL', 'http://127.0.0.1:8001'), '/') . '/' . ltrim($coaching->logo_url, '/')) : asset('assets/images/school-card-logo.png') }}" alt="{{ $coaching->name }} Logo" style="object-fit: contain;">
                                        </div>
                                        <div class="school-identity-text">
                                            <h3 class="school-name"><a href="{{ route('coaching.detail', $coaching->slug) }}" class="text-dark text-decoration-none">{{ $coaching->name }}</a></h3>
                                            @php
                                                $locations = array_merge($coaching->cities_present_in ?? [], $coaching->states_present_in ?? []);
                                            @endphp
                                            <span class="school-location"><i class="fa-solid fa-location-dot me-1 text-muted"></i> {{ implode(', ', $locations) }}</span>
                                        </div>
                                    </div>
                                    <div class="school-stats-grid">
                                        <div class="school-stat-col">
                                            <span class="school-stat-lbl">Annual Fees</span>
                                            <span class="school-stat-val">Ask</span>
                                        </div>
                                        <div class="school-stat-col">
                                            <span class="school-stat-lbl">Board</span>
                                            <a href="#" class="school-stat-val underlined">{{ implode(', ', $coaching->education_boards_supported ?? []) }}</a>
                                        </div>
                                        <div class="school-stat-col">
                                            <span class="school-stat-lbl">Classes</span>
                                            <span class="school-stat-val">{{ implode(', ', $coaching->education_levels_supported ?? []) }}</span>
                                        </div>
                                        <div class="school-stat-col">
                                            <span class="school-stat-lbl">Established in</span>
                                            <span class="school-stat-val">{{ $coaching->established_year ?? 'N/A' }}</span>
                                        </div>
                                    </div>
                                    <p class="school-card-desc">{{ Str::limit($coaching->meta_description ?? strip_tags($coaching->about_organisation ?? ''), 200, '...') }}</p>
                                    <div class="school-card-actions">
                                        <button class="btn-school-call"><i class="fa-solid fa-phone"></i> Call School</button>
                                        <button class="btn-school-callback">Request a Callback <i class="fa-solid fa-chevron-right ms-1" style="font-size: 9px;"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <div class="mt-4">
                        {{ $coachings->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
