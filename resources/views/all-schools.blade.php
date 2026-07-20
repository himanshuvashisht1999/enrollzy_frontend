@extends('layouts.app')
@section('content')
<main class="about-hero-section ptb-70">
      <div class="bg-square">
        <img src="{{ asset('assets/images/banner-square-img.svg') }}" alt="" />
      </div>
      <div class="container">
        <div class="about-hero-container">
          <img src="{{ asset('assets/images/school-banner-img.png') }}" alt="All Schools" />

          <!-- Centered Badge -->
          <div class="about-us-badge-wrapper">
            <button class="about-us-badge">All Schools</button>
            <p>Explore our complete list of schools across India.</p>
          </div>

          <!-- Green Down Arrow Button -->
          <button class="about-scroll-btn" aria-label="Scroll Down">
            <img style="width: 49px; height: 62px" src="{{ asset('assets/images/inner-banner-down-arror.png') }}" alt="" />
          </button>
        </div>
      </div>
    </main>

    <!-- Breadcrumb path -->
    <div class="py-3" style="background-color: #f9ad0b14">
        <div class="container d-flex justify-content-between align-items-center flex-wrap gap-2">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0" style="font-size: 13.5px; font-weight: 500;">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-decoration-none text-muted"><i class="fa-solid fa-house me-1"></i> Home</a></li>
                    <li class="breadcrumb-item active text-primary" aria-current="page">Schools</li>
                </ol>
            </nav>
        </div>
    </div>

    <!-- Main Content Section -->
    <section class="py-5" style="background-color: #FAFBFD;">
        <div class="container">
            
            <!-- School Hero Intro Card -->
            <div class="school-hero-card mb-4">
                <h2 class="school-hero-title">Top Boarding Schools in India 2026-27: Fees, Admissions, Rankings & Reviews</h2>
                <p class="school-hero-text">We've curated a list of best Boarding Schools in India, sorted by rankings based on academic excellence, infrastructure, extracurriculars, teacher quality, and real parent reviews.</p>
            </div>

            <!-- Global Search Bar & Filter Summary Bar -->
            <div class="bg-white rounded-4 p-4 border shadow-sm mb-4">
                <form action="{{ route('all-schools') }}" method="GET" class="row g-3 align-items-center">
                    <div class="col-md-9">
                        <div class="input-group">
                            <span class="input-group-text bg-white border-end-0"><i class="fa-solid fa-magnifying-glass text-muted"></i></span>
                            <input type="text" name="search" class="form-control border-start-0 ps-0" placeholder="Search schools by name, city, state, board (e.g. Doon, Dehradun, CBSE)..." value="{{ request('search') }}">
                        </div>
                    </div>
                    <div class="col-md-3 d-flex gap-2">
                        <button type="submit" class="btn btn-primary w-100 fw-bold rounded-pill">
                            Search Schools
                        </button>
                        @if(request()->hasAny(['search', 'region', 'state', 'city', 'board', 'class', 'ownership', 'school_type', 'gender']))
                        <a href="{{ route('all-schools') }}" class="btn btn-outline-danger text-nowrap rounded-pill px-3" title="Clear All Filters">
                            <i class="fa-solid fa-rotate-left"></i> Reset
                        </a>
                        @endif
                    </div>
                </form>

                @if(request()->hasAny(['search', 'region', 'state', 'city', 'board', 'class', 'ownership', 'school_type', 'gender']))
                <div class="d-flex flex-wrap align-items-center gap-2 mt-3 pt-3 border-top" style="font-size: 13px;">
                    <span class="text-muted fw-bold">Active Filters:</span>
                    @if(request('search'))
                        <span class="badge bg-primary-subtle text-primary border rounded-pill px-3 py-1">Search: "{{ request('search') }}"</span>
                    @endif
                    @foreach((array)request('region') as $r)
                        <span class="badge bg-light text-dark border rounded-pill px-3 py-1">Region: {{ $r }}</span>
                    @endforeach
                    @foreach((array)request('state') as $s)
                        <span class="badge bg-light text-dark border rounded-pill px-3 py-1">State: {{ $s }}</span>
                    @endforeach
                    @foreach((array)request('city') as $c)
                        <span class="badge bg-light text-dark border rounded-pill px-3 py-1">City: {{ $c }}</span>
                    @endforeach
                    @foreach((array)request('board') as $b)
                        <span class="badge bg-light text-dark border rounded-pill px-3 py-1">Board: {{ $b }}</span>
                    @endforeach
                    @foreach((array)request('class') as $cl)
                        <span class="badge bg-light text-dark border rounded-pill px-3 py-1">Class: {{ $cl }}</span>
                    @endforeach
                    @foreach((array)request('ownership') as $o)
                        <span class="badge bg-light text-dark border rounded-pill px-3 py-1">Ownership: {{ $o }}</span>
                    @endforeach
                    @foreach((array)request('school_type') as $st)
                        <span class="badge bg-light text-dark border rounded-pill px-3 py-1">Type: {{ $st }}</span>
                    @endforeach
                    @foreach((array)request('gender') as $g)
                        <span class="badge bg-light text-dark border rounded-pill px-3 py-1">Gender: {{ $g }}</span>
                    @endforeach
                    <a href="{{ route('all-schools') }}" class="text-danger ms-auto fw-bold text-decoration-none" style="font-size: 12px;">Clear All Filters</a>
                </div>
                @endif
            </div>

            <div class="row g-4">
                <!-- Left Sidebar Filters Form -->
                <div class="col-lg-3 col-md-4">
                    <form action="{{ route('all-schools') }}" method="GET" id="schoolsFilterSidebarForm">
                        @if(request('search'))
                            <input type="hidden" name="search" value="{{ request('search') }}">
                        @endif

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
                                            @foreach(['North India', 'South India', 'East India', 'West India', 'Central India'] as $idx => $reg)
                                            <div class="form-check mb-2">
                                                <input class="form-check-input" type="checkbox" name="region[]" value="{{ $reg }}" id="reg{{ $idx }}" onchange="this.form.submit()" {{ in_array($reg, (array)request('region', [])) ? 'checked' : '' }}>
                                                <label class="form-check-label ms-1" for="reg{{ $idx }}">{{ $reg }}</label>
                                            </div>
                                            @endforeach
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
                                        <div class="filter-checklist" style="max-height: 200px; overflow-y: auto;">
                                            @foreach(['Tamil Nadu', 'Karnataka', 'Andhra Pradesh', 'Rajasthan', 'Punjab', 'Himachal Pradesh', 'Haryana', 'Uttarakhand', 'Delhi'] as $idx => $st)
                                            <div class="form-check mb-2">
                                                <input class="form-check-input" type="checkbox" name="state[]" value="{{ $st }}" id="st{{ $idx }}" onchange="this.form.submit()" {{ in_array($st, (array)request('state', [])) ? 'checked' : '' }}>
                                                <label class="form-check-label ms-1" for="st{{ $idx }}">{{ $st }}</label>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- City Accordion -->
                            <div class="filter-group-card mb-3">
                                <div class="filter-group-header d-flex justify-content-between align-items-center" data-bs-toggle="collapse" data-bs-target="#filterCity" aria-expanded="true">
                                    <span>City</span>
                                    <i class="fa-solid fa-chevron-down"></i>
                                </div>
                                <div class="collapse show" id="filterCity">
                                    <div class="filter-group-body">
                                        <div class="filter-checklist" style="max-height: 200px; overflow-y: auto;">
                                            @foreach(['Bangalore', 'Dehradun', 'Hyderabad', 'Panchgani', 'Varanasi', 'Nainital', 'Patna', 'Jaipur', 'Chandigarh'] as $idx => $cy)
                                            <div class="form-check mb-2">
                                                <input class="form-check-input" type="checkbox" name="city[]" value="{{ $cy }}" id="cy{{ $idx }}" onchange="this.form.submit()" {{ in_array($cy, (array)request('city', [])) ? 'checked' : '' }}>
                                                <label class="form-check-label ms-1" for="cy{{ $idx }}">{{ $cy }}</label>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Class Accordion -->
                            <div class="filter-group-card mb-3">
                                <div class="filter-group-header d-flex justify-content-between align-items-center" data-bs-toggle="collapse" data-bs-target="#filterClass" aria-expanded="true">
                                    <span>Class</span>
                                    <i class="fa-solid fa-chevron-down"></i>
                                </div>
                                <div class="collapse show" id="filterClass">
                                    <div class="filter-group-body">
                                        <div class="filter-checklist" style="max-height: 200px; overflow-y: auto;">
                                            @foreach(['Toddlers', 'Pre Nursery', 'Nursery', 'LKG', 'UKG', 'Class 1', 'Class 2', 'Class 6', 'Class 10', 'Class 12'] as $idx => $cl)
                                            <div class="form-check mb-2">
                                                <input class="form-check-input" type="checkbox" name="class[]" value="{{ $cl }}" id="cl{{ $idx }}" onchange="this.form.submit()" {{ in_array($cl, (array)request('class', [])) ? 'checked' : '' }}>
                                                <label class="form-check-label ms-1" for="cl{{ $idx }}">{{ $cl }}</label>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Board Accordion -->
                            <div class="filter-group-card mb-3">
                                <div class="filter-group-header d-flex justify-content-between align-items-center" data-bs-toggle="collapse" data-bs-target="#filterBoard" aria-expanded="true">
                                    <span>Board</span>
                                    <i class="fa-solid fa-chevron-down"></i>
                                </div>
                                <div class="collapse show" id="filterBoard">
                                    <div class="filter-group-body">
                                        <div class="filter-checklist">
                                            @foreach(['CBSE', 'ICSE/CISE', 'State Board', 'NIOS', 'IB', 'IGCSE'] as $idx => $bd)
                                            <div class="form-check mb-2">
                                                <input class="form-check-input" type="checkbox" name="board[]" value="{{ $bd }}" id="bd{{ $idx }}" onchange="this.form.submit()" {{ in_array($bd, (array)request('board', [])) ? 'checked' : '' }}>
                                                <label class="form-check-label ms-1" for="bd{{ $idx }}">{{ $bd }}</label>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Ownership Accordion -->
                            <div class="filter-group-card mb-3">
                                <div class="filter-group-header d-flex justify-content-between align-items-center" data-bs-toggle="collapse" data-bs-target="#filterOwnership" aria-expanded="true">
                                    <span>Ownership</span>
                                    <i class="fa-solid fa-chevron-down"></i>
                                </div>
                                <div class="collapse show" id="filterOwnership">
                                    <div class="filter-group-body">
                                        <div class="filter-checklist">
                                            @foreach(['Government', 'Private'] as $idx => $own)
                                            <div class="form-check mb-2">
                                                <input class="form-check-input" type="checkbox" name="ownership[]" value="{{ $own }}" id="own{{ $idx }}" onchange="this.form.submit()" {{ in_array($own, (array)request('ownership', [])) ? 'checked' : '' }}>
                                                <label class="form-check-label ms-1" for="own{{ $idx }}">{{ $own }}</label>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- School Type Accordion -->
                            <div class="filter-group-card mb-3">
                                <div class="filter-group-header d-flex justify-content-between align-items-center" data-bs-toggle="collapse" data-bs-target="#filterSchoolType" aria-expanded="true">
                                    <span>School Type</span>
                                    <i class="fa-solid fa-chevron-down"></i>
                                </div>
                                <div class="collapse show" id="filterSchoolType">
                                    <div class="filter-group-body">
                                        <div class="filter-checklist">
                                            @foreach(['Weekly Boarding', 'Day Boarding', 'Full Boarding'] as $idx => $st)
                                            <div class="form-check mb-2">
                                                <input class="form-check-input" type="checkbox" name="school_type[]" value="{{ $st }}" id="sct{{ $idx }}" onchange="this.form.submit()" {{ in_array($st, (array)request('school_type', [])) ? 'checked' : '' }}>
                                                <label class="form-check-label ms-1" for="sct{{ $idx }}">{{ $st }}</label>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Gender Accordion -->
                            <div class="filter-group-card mb-3">
                                <div class="filter-group-header d-flex justify-content-between align-items-center" data-bs-toggle="collapse" data-bs-target="#filterGender" aria-expanded="true">
                                    <span>Gender</span>
                                    <i class="fa-solid fa-chevron-down"></i>
                                </div>
                                <div class="collapse show" id="filterGender">
                                    <div class="filter-group-body">
                                        <div class="filter-checklist">
                                            @foreach(['Coed', 'Boys', 'Girls'] as $idx => $gen)
                                            <div class="form-check mb-2">
                                                <input class="form-check-input" type="checkbox" name="gender[]" value="{{ $gen }}" id="gen{{ $idx }}" onchange="this.form.submit()" {{ in_array($gen, (array)request('gender', [])) ? 'checked' : '' }}>
                                                <label class="form-check-label ms-1" for="gen{{ $idx }}">{{ $gen }}</label>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary w-100 fw-bold rounded-pill mt-3">
                                Apply Filters
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Right catalog list grid -->
                <div class="col-lg-9 col-md-8">
                    <!-- Title header info -->
                    <div class="catalog-header-bar d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">
                        <div class="d-flex align-items-center gap-2">
                            <span class="fw-bold" style="font-size: 16px; color: #3771C8;">Boarding Schools in India</span>
                            <span class="text-muted" style="font-size: 14px;">- {{ $schools->total() }} Schools Found</span>
                        </div>
                    </div>

                    <!-- Schools Grid row -->
                    @if($schools->count() > 0)
                    <div class="row row-cols-1 row-cols-md-2 g-4">
                        @foreach($schools as $school)
                        <div class="col">
                            <div class="school-card">
                                <div class="swiper school-image-swiper">
                                    <div class="swiper-wrapper">
                                        <div class="swiper-slide">
                                            <a href="{{ route('school.detail', $school->slug) }}">
                                                <img src="{{ $school->cover_image_url ? (str_starts_with($school->cover_image_url, 'http') ? $school->cover_image_url : rtrim(env('BACKEND_URL', 'http://127.0.0.1:8001'), '/') . '/' . ltrim($school->cover_image_url, '/')) : asset('assets/images/about_team_meeting.png') }}" alt="{{ $school->name }} Cover">
                                            </a>
                                        </div>
                                    </div>
                                    <div class="swiper-pagination"></div>
                                    <span class="school-rating-badge"><i class="fa-solid fa-star"></i> {{ $school->average_rating ?? '4.5' }}</span>
                                    @if($school->minority_type || $school->brand_type)
                                    <span class="school-gender-badge">{{ $school->minority_type ?? $school->brand_type }}</span>
                                    @endif
                                </div>
                                <div class="school-info-body">
                                    <div class="school-identity-row">
                                        <div class="school-logo-box" style="width: 48px; height: 48px; flex-shrink: 0;">
                                            <img src="{{ $school->logo_url ? (str_starts_with($school->logo_url, 'http') ? $school->logo_url : rtrim(env('BACKEND_URL', 'http://127.0.0.1:8001'), '/') . '/' . ltrim($school->logo_url, '/')) : asset('assets/images/school-card-logo.png') }}" alt="{{ $school->name }} Logo" style="object-fit: contain;">
                                        </div>
                                        <div class="school-identity-text">
                                            <h3 class="school-name"><a href="{{ route('school.detail', $school->slug) }}" class="text-dark text-decoration-none">{{ $school->name }}</a></h3>
                                            @php
                                                $locations = array_merge((array)($school->cities_present_in ?? []), (array)($school->states_present_in ?? []));
                                                $locationText = !empty($locations) ? implode(', ', array_filter($locations)) : ($school->head_office_location ?? 'India');
                                            @endphp
                                            <span class="school-location"><i class="fa-solid fa-location-dot me-1 text-muted"></i> {{ $locationText }}</span>
                                        </div>
                                    </div>
                                    <div class="school-stats-grid">
                                        <div class="school-stat-col">
                                            <span class="school-stat-lbl">Annual Fees</span>
                                            <span class="school-stat-val">Contact School</span>
                                        </div>
                                        <div class="school-stat-col">
                                            <span class="school-stat-lbl">Board</span>
                                            <span class="school-stat-val underlined">{{ is_array($school->education_boards_supported) ? implode(', ', $school->education_boards_supported) : ($school->education_boards_supported ?? 'CBSE') }}</span>
                                        </div>
                                        <div class="school-stat-col">
                                            <span class="school-stat-lbl">Classes</span>
                                            <span class="school-stat-val">{{ is_array($school->education_levels_supported) ? implode(', ', $school->education_levels_supported) : ($school->education_levels_supported ?? 'Nursery to 12') }}</span>
                                        </div>
                                        <div class="school-stat-col">
                                            <span class="school-stat-lbl">Established</span>
                                            <span class="school-stat-val">{{ $school->established_year ?? 'N/A' }}</span>
                                        </div>
                                    </div>
                                    <p class="school-card-desc">{{ Str::limit($school->meta_description ?? strip_tags($school->about_organisation ?? ''), 160, '...') }}</p>
                                    <div class="school-card-actions">
                                        <a href="{{ route('school.detail', $school->slug) }}" class="btn-school-call text-decoration-none text-center"><i class="fa-solid fa-eye me-1"></i> View Details</a>
                                        <a href="{{ route('school.detail', $school->slug) }}" class="btn-school-callback text-decoration-none text-center">Apply Now <i class="fa-solid fa-chevron-right ms-1" style="font-size: 9px;"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <div class="mt-4">
                        {{ $schools->appends(request()->query())->links('pagination::bootstrap-5') }}
                    </div>
                    @else
                    <div class="bg-white rounded-4 p-5 text-center border shadow-sm">
                        <i class="fa-solid fa-school-flag text-muted mb-3" style="font-size: 3rem;"></i>
                        <h4 class="fw-bold text-dark">No Schools Found</h4>
                        <p class="text-muted mb-4">No schools matched your search criteria or selected filters.</p>
                        <a href="{{ route('all-schools') }}" class="btn btn-primary rounded-pill px-4">
                            <i class="fa-solid fa-rotate-left me-1"></i> Reset Filters
                        </a>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection
