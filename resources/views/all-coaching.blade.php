@extends('layouts.app')
@section('content')
@php
  $pageTitle = isset($heroPillLabel) && !empty($heroPillLabel) ? $heroPillLabel : ((request('is_top') == '1' || request('is_top') == 'true') ? 'Top Coaching Institutes' : 'All Coaching Institutes');
  $pageSubtitle = (request('is_top') == '1' || request('is_top') == 'true') ? 'Explore top coaching institutes across India.' : 'Explore our complete list of coaching institutes across India.';
@endphp
    <main class="about-hero-section ptb-70">
        <div class="bg-square">
            <img src="assets/images/banner-square-img.svg" alt="" />
        </div>
        <div class="container">
            <div class="about-hero-container">
                <img src="assets/images/school-banner-img.png" alt="" />

                <!-- Centered Badge -->
                <div class="about-us-badge-wrapper">
                    <button class="about-us-badge">{{ $pageTitle }}</button>
                    <p>{{ $pageSubtitle }}</p>
                </div>

                <!-- Green Down Arrow Button -->
                <button class="about-scroll-btn" aria-label="Scroll Down">
                    <img style="width: 49px; height: 62px" src="assets/images/inner-banner-down-arror.png" alt="" />
                </button>
            </div>
        </div>
    </main>

    <!-- Breadcrumb path & Explore Button -->
    <div class="py-3" style="background-color: #f9ad0b14">
        <div class="container d-flex justify-content-between align-items-center flex-wrap gap-2">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0" style="font-size: 13.5px; font-weight: 500;">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-decoration-none text-muted"><i
                                class="fa-solid fa-house me-1"></i> Home</a></li>
                    <li class="breadcrumb-item active text-primary" aria-current="page">{{ $pageTitle }}</li>
                </ol>
            </nav>
        </div>
    </div>
    <div style="background-color: #3771C812;padding: 20px 0px;text-align: center;">
        <a href="#coaching-catalog" class="btn btn-primary rounded-pill px-4"
            style="background-color: #3771C8; border: none; font-size: 14px; font-weight: bold; height: 34px; display: inline-flex; align-items: center; justify-content: center;">Explore
            Coaching Institutes</a>
    </div>

    <!-- Main Content Section -->
    <section class="py-5" id="coaching-catalog" style="background-color: #FAFBFD;">
        <div class="container">
            <!-- Hero Intro Card -->
            <div class="school-hero-card mb-4">
                <h2 class="school-hero-title">Top Coaching Institutes in India 2026-27: Fees, Admissions, Rankings & Reviews
                </h2>
                <p class="school-hero-text">We've curated a list of top Coaching Institutes in India for 2026-27, evaluated
                    on academic performance, faculty experience, study material quality, student success rates, and parent
                    reviews.</p>
            </div>

            <!-- Global Search Bar & Active Filters -->
            <div class="bg-white rounded-4 p-4 border shadow-sm mb-4">
                <form action="{{ request('is_top') ? route('top.coaching') : route('all.coaching') }}" method="GET" class="row g-3 align-items-center">
                    @if(request('is_top'))
                        <input type="hidden" name="is_top" value="{{ request('is_top') }}">
                    @endif
                    <div class="col-md-9">
                        <div class="input-group">
                            <span class="input-group-text bg-white border-end-0"><i
                                    class="fa-solid fa-magnifying-glass text-muted"></i></span>
                            <input type="text" name="search" class="form-control border-start-0 ps-0"
                                placeholder="Search coaching institutes by name, city, state, course (e.g. Physics Wallah, Kota, JEE, NEET)..."
                                value="{{ request('search') }}">
                        </div>
                    </div>
                    <div class="col-md-3 d-flex gap-2">
                        <button type="submit" class="btn btn-primary w-100 fw-bold rounded-pill"
                            style="background-color: #3771C8; border: none;">
                            Search Coaching
                        </button>
                        @if(request()->hasAny(['search', 'region', 'state', 'city', 'area', 'board', 'class', 'ownership', 'school_type', 'gender']))
                            <a href="{{ request('is_top') ? route('top.coaching') : route('all.coaching') }}" class="btn btn-outline-danger text-nowrap rounded-pill px-3"
                                title="Clear All Filters">
                                <i class="fa-solid fa-rotate-left"></i> Reset
                            </a>
                        @endif
                    </div>
                </form>

                @if(request()->hasAny(['search', 'region', 'state', 'city', 'area', 'board', 'class', 'ownership', 'school_type', 'gender']))
                    <div class="d-flex flex-wrap align-items-center gap-2 mt-3 pt-3 border-top" style="font-size: 13px;">
                        <span class="text-muted fw-bold">Active Filters:</span>
                        @if(request('search'))
                            <span class="badge bg-primary-subtle text-primary border rounded-pill px-3 py-1">Search:
                                "{{ request('search') }}"</span>
                        @endif
                        @foreach((array) request('region') as $r)
                            <span class="badge bg-light text-dark border rounded-pill px-3 py-1">Region: {{ $r }}</span>
                        @endforeach
                        @foreach((array) request('state') as $s)
                            <span class="badge bg-light text-dark border rounded-pill px-3 py-1">State: {{ $s }}</span>
                        @endforeach
                        @foreach((array) request('city') as $c)
                            <span class="badge bg-light text-dark border rounded-pill px-3 py-1">City: {{ $c }}</span>
                        @endforeach
                        @foreach((array) request('area') as $a)
                            <span class="badge bg-light text-dark border rounded-pill px-3 py-1">Area: {{ $a }}</span>
                        @endforeach
                        @foreach((array) request('board') as $b)
                            <span class="badge bg-light text-dark border rounded-pill px-3 py-1">Exam/Board: {{ $b }}</span>
                        @endforeach
                        @foreach((array) request('class') as $cl)
                            <span class="badge bg-light text-dark border rounded-pill px-3 py-1">Class: {{ $cl }}</span>
                        @endforeach
                        @foreach((array) request('ownership') as $o)
                            <span class="badge bg-light text-dark border rounded-pill px-3 py-1">Ownership: {{ $o }}</span>
                        @endforeach
                        @foreach((array) request('school_type') as $st)
                            <span class="badge bg-light text-dark border rounded-pill px-3 py-1">Type: {{ $st }}</span>
                        @endforeach
                        @foreach((array) request('gender') as $g)
                            <span class="badge bg-light text-dark border rounded-pill px-3 py-1">Gender: {{ $g }}</span>
                        @endforeach
                        <a href="{{ route('all.coaching') }}" class="text-danger ms-auto fw-bold text-decoration-none"
                            style="font-size: 12px;">Clear All Filters</a>
                    </div>
                @endif
            </div>

            <div class="row g-4">
                <!-- Left Sidebar Filters -->
                <div class="col-lg-3 col-md-4">
                    <form action="{{ request('is_top') ? route('top.coaching') : route('all.coaching') }}" method="GET" id="coachingFilterSidebarForm">
                        @if(request('search'))
                            <input type="hidden" name="search" value="{{ request('search') }}">
                        @endif
                        @if(request('is_top'))
                            <input type="hidden" name="is_top" value="{{ request('is_top') }}">
                        @endif

                        <div class="filter-sidebar-wrapper">

                            <!-- Regions Accordion -->
                            <div class="filter-group-card mb-3">
                                <div class="filter-group-header d-flex justify-content-between align-items-center"
                                    data-bs-toggle="collapse" data-bs-target="#filterRegions" aria-expanded="true">
                                    <span>Regions</span>
                                    <i class="fa-solid fa-chevron-down"></i>
                                </div>
                                <div class="collapse show" id="filterRegions">
                                    <div class="filter-group-body">
                                        <div class="filter-checklist">
                                            @foreach(['North India', 'South India', 'East India', 'West India', 'Central India'] as $idx => $reg)
                                                <div class="form-check mb-2">
                                                    <input class="form-check-input" type="checkbox" name="region[]"
                                                        value="{{ $reg }}" id="reg{{ $idx }}" onchange="this.form.submit()" {{ in_array($reg, (array) request('region', [])) ? 'checked' : '' }}>
                                                    <label class="form-check-label ms-1" for="reg{{ $idx }}">{{ $reg }}</label>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- State Accordion -->
                            <div class="filter-group-card mb-3">
                                <div class="filter-group-header d-flex justify-content-between align-items-center"
                                    data-bs-toggle="collapse" data-bs-target="#filterState" aria-expanded="true">
                                    <span>State</span>
                                    <i class="fa-solid fa-chevron-down"></i>
                                </div>
                                <div class="collapse show" id="filterState">
                                    <div class="filter-group-body">
                                        <div class="filter-checklist" style="max-height: 200px; overflow-y: auto;">
                                            @foreach(['Uttar Pradesh', 'Rajasthan', 'Chandigarh', 'Karnataka', 'Telangana', 'Delhi', 'Punjab', 'Haryana', 'Maharashtra', 'Tamil Nadu'] as $idx => $st)
                                                <div class="form-check mb-2">
                                                    <input class="form-check-input" type="checkbox" name="state[]"
                                                        value="{{ $st }}" id="st{{ $idx }}" onchange="this.form.submit()" {{ in_array($st, (array) request('state', [])) ? 'checked' : '' }}>
                                                    <label class="form-check-label ms-1" for="st{{ $idx }}">{{ $st }}</label>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- City Accordion -->
                            <div class="filter-group-card mb-3">
                                <div class="filter-group-header d-flex justify-content-between align-items-center"
                                    data-bs-toggle="collapse" data-bs-target="#filterCity" aria-expanded="true">
                                    <span>City</span>
                                    <i class="fa-solid fa-chevron-down"></i>
                                </div>
                                <div class="collapse show" id="filterCity">
                                    <div class="filter-group-body">
                                        <div class="filter-checklist" style="max-height: 200px; overflow-y: auto;">
                                            @foreach(['Noida', 'Kota', 'Chandigarh', 'Bengaluru', 'Hyderabad', 'New Delhi', 'Jaipur', 'Patna', 'Lucknow', 'Pune'] as $idx => $cy)
                                                <div class="form-check mb-2">
                                                    <input class="form-check-input" type="checkbox" name="city[]"
                                                        value="{{ $cy }}" id="cy{{ $idx }}" onchange="this.form.submit()" {{ in_array($cy, (array) request('city', [])) ? 'checked' : '' }}>
                                                    <label class="form-check-label ms-1" for="cy{{ $idx }}">{{ $cy }}</label>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Area Accordion -->
                            <div class="filter-group-card mb-3">
                                <div class="filter-group-header d-flex justify-content-between align-items-center"
                                    data-bs-toggle="collapse" data-bs-target="#filterArea" aria-expanded="false">
                                    <span>Area</span>
                                    <i class="fa-solid fa-chevron-down"></i>
                                </div>
                                <div class="collapse" id="filterArea">
                                    <div class="filter-group-body">
                                        <div class="filter-checklist">
                                            @foreach(['Sector 34', 'Sector 20', 'Indra Vihar', 'Mansarovar', 'Rohini', 'Kukatpally'] as $idx => $ar)
                                                <div class="form-check mb-2">
                                                    <input class="form-check-input" type="checkbox" name="area[]"
                                                        value="{{ $ar }}" id="ar{{ $idx }}" onchange="this.form.submit()" {{ in_array($ar, (array) request('area', [])) ? 'checked' : '' }}>
                                                    <label class="form-check-label ms-1" for="ar{{ $idx }}">{{ $ar }}</label>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Class Accordion -->
                            <div class="filter-group-card mb-3">
                                <div class="filter-group-header d-flex justify-content-between align-items-center"
                                    data-bs-toggle="collapse" data-bs-target="#filterClass" aria-expanded="true">
                                    <span>Class / Target Level</span>
                                    <i class="fa-solid fa-chevron-down"></i>
                                </div>
                                <div class="collapse show" id="filterClass">
                                    <div class="filter-group-body">
                                        <div class="filter-checklist">
                                            @foreach(['Class 8', 'Class 9', 'Class 10', 'Class 11', 'Class 12', 'Target / Dropper', 'Foundation'] as $idx => $cl)
                                                <div class="form-check mb-2">
                                                    <input class="form-check-input" type="checkbox" name="class[]"
                                                        value="{{ $cl }}" id="cl{{ $idx }}" onchange="this.form.submit()" {{ in_array($cl, (array) request('class', [])) ? 'checked' : '' }}>
                                                    <label class="form-check-label ms-1" for="cl{{ $idx }}">{{ $cl }}</label>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Board Accordion -->
                            <div class="filter-group-card mb-3">
                                <div class="filter-group-header d-flex justify-content-between align-items-center"
                                    data-bs-toggle="collapse" data-bs-target="#filterBoard" aria-expanded="true">
                                    <span>Exam / Board</span>
                                    <i class="fa-solid fa-chevron-down"></i>
                                </div>
                                <div class="collapse show" id="filterBoard">
                                    <div class="filter-group-body">
                                        <div class="filter-checklist">
                                            @foreach(['JEE Main & Advanced', 'NEET-UG', 'CBSE', 'ICSE', 'State Board', 'CUET', 'Olympiad'] as $idx => $bd)
                                                <div class="form-check mb-2">
                                                    <input class="form-check-input" type="checkbox" name="board[]"
                                                        value="{{ $bd }}" id="bd{{ $idx }}" onchange="this.form.submit()" {{ in_array($bd, (array) request('board', [])) ? 'checked' : '' }}>
                                                    <label class="form-check-label ms-1" for="bd{{ $idx }}">{{ $bd }}</label>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Ownership Accordion -->
                            <div class="filter-group-card mb-3">
                                <div class="filter-group-header d-flex justify-content-between align-items-center"
                                    data-bs-toggle="collapse" data-bs-target="#filterOwnership" aria-expanded="false">
                                    <span>Ownership</span>
                                    <i class="fa-solid fa-chevron-down"></i>
                                </div>
                                <div class="collapse" id="filterOwnership">
                                    <div class="filter-group-body">
                                        <div class="filter-checklist">
                                            @foreach(['Private', 'Government', 'Trust'] as $idx => $ow)
                                                <div class="form-check mb-2">
                                                    <input class="form-check-input" type="checkbox" name="ownership[]"
                                                        value="{{ $ow }}" id="ow{{ $idx }}" onchange="this.form.submit()" {{ in_array($ow, (array) request('ownership', [])) ? 'checked' : '' }}>
                                                    <label class="form-check-label ms-1" for="ow{{ $idx }}">{{ $ow }}</label>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Coaching Type Accordion -->
                            <div class="filter-group-card mb-3">
                                <div class="filter-group-header d-flex justify-content-between align-items-center"
                                    data-bs-toggle="collapse" data-bs-target="#filterCoachingType" aria-expanded="false">
                                    <span>Coaching Type / Mode</span>
                                    <i class="fa-solid fa-chevron-down"></i>
                                </div>
                                <div class="collapse" id="filterCoachingType">
                                    <div class="filter-group-body">
                                        <div class="filter-checklist">
                                            @foreach(['Classroom', 'Online', 'Hybrid', 'Chain', 'Franchise', 'Independent'] as $idx => $ct)
                                                <div class="form-check mb-2">
                                                    <input class="form-check-input" type="checkbox" name="school_type[]"
                                                        value="{{ $ct }}" id="ct{{ $idx }}" onchange="this.form.submit()" {{ in_array($ct, (array) request('school_type', [])) ? 'checked' : '' }}>
                                                    <label class="form-check-label ms-1" for="ct{{ $idx }}">{{ $ct }}</label>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Gender Accordion -->
                            <div class="filter-group-card mb-3">
                                <div class="filter-group-header d-flex justify-content-between align-items-center"
                                    data-bs-toggle="collapse" data-bs-target="#filterGender" aria-expanded="false">
                                    <span>Gender</span>
                                    <i class="fa-solid fa-chevron-down"></i>
                                </div>
                                <div class="collapse" id="filterGender">
                                    <div class="filter-group-body">
                                        <div class="filter-checklist">
                                            @foreach(['Coed', 'Boys', 'Girls'] as $idx => $gd)
                                                <div class="form-check mb-2">
                                                    <input class="form-check-input" type="checkbox" name="gender[]"
                                                        value="{{ $gd }}" id="gd{{ $idx }}" onchange="this.form.submit()" {{ in_array($gd, (array) request('gender', [])) ? 'checked' : '' }}>
                                                    <label class="form-check-label ms-1" for="gd{{ $idx }}">{{ $gd }}</label>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </form>
                </div>

                <!-- Right catalog list grid -->
                <div class="col-lg-9 col-md-8">
                    <!-- Title header info -->
                    <div class="catalog-header-bar d-flex justify-content-between align-items-center flex-wrap gap-3 mb-3">
                        <div class="d-flex align-items-center gap-2">
                            <span class="fw-bold" style="font-size: 16px; color: #3771C8;">Coaching Institutes in
                                India</span>
                            <span class="text-muted" style="font-size: 16px;">- {{ $coachings->total() }} Coaching
                                Institutes | Updated at : {{ now()->format('d M Y, h:i a') }}</span>
                        </div>
                    </div>

                    <!-- Coaching Institutes Grid row -->
                    <div class="row row-cols-1 row-cols-md-2 g-4">
                        @forelse($coachings as $coaching)
                            @php
                                $locArray = [];
                                $cities = is_array($coaching->cities_present_in) ? $coaching->cities_present_in : (is_string($coaching->cities_present_in) ? json_decode($coaching->cities_present_in, true) : []);
                                $states = is_array($coaching->states_present_in) ? $coaching->states_present_in : (is_string($coaching->states_present_in) ? json_decode($coaching->states_present_in, true) : []);
                                if (!empty($cities))
                                    $locArray = array_merge($locArray, (array) $cities);
                                if (!empty($states))
                                    $locArray = array_merge($locArray, (array) $states);
                                $locationStr = !empty($locArray) ? implode(', ', array_unique($locArray)) : ($coaching->head_office_location ?? 'India');

                                $boards = is_array($coaching->education_boards_supported) ? $coaching->education_boards_supported : (is_string($coaching->education_boards_supported) ? json_decode($coaching->education_boards_supported, true) : []);
                                $boardsStr = !empty($boards) ? implode(', ', $boards) : 'JEE, NEET, Foundation';

                                $classes = is_array($coaching->education_levels_supported) ? $coaching->education_levels_supported : (is_string($coaching->education_levels_supported) ? json_decode($coaching->education_levels_supported, true) : []);
                                $classesStr = !empty($classes) ? implode(', ', $classes) : 'Class 8 - 12, Droppers';
                            @endphp
                            <div class="col">
                                <div class="school-card">
                                    <div class="swiper school-image-swiper">
                                        <div class="swiper-wrapper">
                                            <div class="swiper-slide">
                                                <a href="{{ route('coaching.detail', $coaching->slug) }}">
                                                    <img src="{{ $coaching->cover_image_url ? (str_starts_with($coaching->cover_image_url, 'http') ? $coaching->cover_image_url : rtrim(env('BACKEND_URL', 'http://127.0.0.1:8001'), '/') . '/' . ltrim($coaching->cover_image_url, '/')) : asset('assets/images/about_team_meeting.png') }}"
                                                        alt="{{ $coaching->name }} Cover">
                                                </a>
                                            </div>
                                        </div>
                                        <div class="swiper-pagination"></div>
                                        <span class="school-rating-badge"><i class="fa-solid fa-star"></i>
                                            {{ $coaching->average_rating ?? '4.5' }}</span>
                                        @if($coaching->minority_type || $coaching->brand_type)
                                            <span
                                                class="school-gender-badge">{{ $coaching->minority_type ?? $coaching->brand_type }}</span>
                                        @endif
                                        <button class="btn-school-compare">Compare</button>
                                    </div>
                                    <div class="school-info-body">
                                        <div class="school-identity-row">
                                            <div class="school-logo-box" style="width: 48px; height: 48px; flex-shrink: 0;">
                                                <img src="{{ $coaching->logo_url ? (str_starts_with($coaching->logo_url, 'http') ? $coaching->logo_url : rtrim(env('BACKEND_URL', 'http://127.0.0.1:8001'), '/') . '/' . ltrim($coaching->logo_url, '/')) : asset('assets/images/school-card-logo.png') }}"
                                                    alt="{{ $coaching->name }} Logo" style="object-fit: contain;">
                                            </div>
                                            <div class="school-identity-text">
                                                <h3 class="school-name"><a
                                                        href="{{ route('coaching.detail', $coaching->slug) }}"
                                                        class="text-dark text-decoration-none">{{ $coaching->name }}</a></h3>
                                                <span class="school-location"><i
                                                        class="fa-solid fa-location-dot me-1 text-muted"></i>
                                                    {{ Str::limit($locationStr, 40) }}</span>
                                            </div>
                                        </div>
                                        <div class="school-stats-grid">
                                            <div class="school-stat-col">
                                                <span class="school-stat-lbl">Annual Fees</span>
                                                <span class="school-stat-val">Ask</span>
                                            </div>
                                            <div class="school-stat-col">
                                                <span class="school-stat-lbl">Exams / Boards</span>
                                                <span class="school-stat-val underlined">{{ Str::limit($boardsStr, 20) }}</span>
                                            </div>
                                            <div class="school-stat-col">
                                                <span class="school-stat-lbl">Classes</span>
                                                <span class="school-stat-val">{{ Str::limit($classesStr, 20) }}</span>
                                            </div>
                                            <div class="school-stat-col">
                                                <span class="school-stat-lbl">Established</span>
                                                <span class="school-stat-val">{{ $coaching->established_year ?? 'N/A' }}</span>
                                            </div>
                                        </div>
                                        <p class="school-card-desc">
                                            {{ Str::limit(strip_tags($coaching->about_organisation ?? $coaching->meta_description ?? ''), 160, '...') }}
                                        </p>
                                        <div class="school-card-actions">
                                            <button type="button" class="btn-school-call" data-bs-toggle="modal"
                                                data-bs-target="#callInstituteModal" data-org-name="{{ $coaching->name }}"
                                                data-org-phone="{{ $coaching->helpdesk_contact_number ?? '+91 1800-123-4567' }}"><i
                                                    class="fa-solid fa-phone"></i> Call Institute</button>
                                            <button type="button" class="btn-school-callback" data-bs-toggle="modal"
                                                data-bs-target="#requestCallbackModal"
                                                data-org-name="{{ $coaching->name }}">Request a Callback <i
                                                    class="fa-solid fa-chevron-right ms-1" style="font-size: 9px;"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-12 text-center py-5">
                                <div class="p-5 bg-white rounded-4 shadow-sm border">
                                    <i class="fa-solid fa-graduation-cap fa-3x text-muted mb-3"></i>
                                    <h4>No Coaching Institutes Found</h4>
                                    <p class="text-muted">We couldn't find any coaching institutes matching your search or
                                        filter criteria.</p>
                                    <a href="{{ route('all.coaching') }}" class="btn btn-primary rounded-pill px-4 mt-2"
                                        style="background-color: #3771C8; border: none;">Clear All Filters</a>
                                </div>
                            </div>
                        @endforelse
                    </div>
                    <div class="mt-4">
                        {{ $coachings->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection