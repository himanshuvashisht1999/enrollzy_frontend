@extends('layouts.app')
@section('content')
@php
  $pageTitle = isset($heroPillLabel) && !empty($heroPillLabel) ? $heroPillLabel : ((request('is_top') == '1' || request('is_top') == 'true') ? 'Top Universities' : 'All University');
  $pageSubtitle = (request('is_top') == '1' || request('is_top') == 'true') ? 'Explore top universities across India.' : 'Explore our complete list of universities.';
@endphp
  <!-- Main Content Section -->
  <main class="about-hero-section ptb-70">
    <div class="bg-square">
      <img src="assets/images/banner-square-img.svg" alt="" />
    </div>
    <div class="container">
      <div class="about-hero-container">
        <img src="assets/images/university-banner-img.png" alt="" />

        <!-- Centered Badge (Placed outside card to prevent clipping) -->
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
  <!-- Partner Logos Band -->
  <div class="univ-partner-band">
    <div class="container">
      <div class="univ-partner-logos-row">
        <!-- Logo 1 -->
        <div class="univ-logo-circle">
          <img src="assets/images/uni-icon.png" alt="" />
        </div>
        <!-- Logo 2 -->
        <div class="univ-logo-circle">
          <img src="assets/images/uni-icon.png" alt="" />
        </div>
        <!-- Logo 3 -->
        <div class="univ-logo-circle">
          <img src="assets/images/uni-icon.png" alt="" />
        </div>
        <!-- Logo 4 -->
        <div class="univ-logo-circle">
          <img src="assets/images/uni-icon.png" alt="" />
        </div>
        <!-- Logo 5 (Repeated for density) -->
        <div class="univ-logo-circle">
          <img src="assets/images/uni-icon.png" alt="" />
        </div>
        <!-- Logo 6 -->
        <div class="univ-logo-circle">
          <img src="assets/images/uni-icon.png" alt="" />
        </div>
        <!-- Logo 7 -->
        <div class="univ-logo-circle">
          <img src="assets/images/uni-icon.png" alt="" />
        </div>
        <!-- Logo 8 -->
        <div class="univ-logo-circle">
          <img src="assets/images/uni-icon.png" alt="" />
        </div>
        <!-- Logo 9 -->
        <div class="univ-logo-circle">
          <img src="assets/images/uni-icon.png" alt="" />
        </div>
      </div>
    </div>
  </div>

  <!-- Breadcrumb path -->
  <div class="py-3" style="background-color: #f9ad0b14">
    <div class="container">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0" style="font-size: 13.5px; font-weight: 500; color: #000">
          <li class="breadcrumb-item">
            <a href="{{ route('home') }}" class="text-decoration-none" style="color: #000"><i class="fa-solid fa-house me-1"></i> Home</a>
          </li>
          <li class="breadcrumb-item active text-primary" aria-current="page">
            {{ $pageTitle }}
          </li>
        </ol>
      </nav>
    </div>
  </div>

  <!-- Main Catalog Section -->
  <section class="univ-catalog-section">
    <div class="container">
      <div class="row g-4">

        <!-- Left Sidebar Filters -->
        <div class="col-lg-3 col-md-4">
          <div class="showing-count-card mb-3">
            Showing <span class="text-primary fw-bold">{{ $universities->total() }}</span> {{ $pageTitle }}
          </div>

          <form action="{{ request('is_top') ? route('top.universities') : route('university') }}" method="GET" id="univFilterForm">
            @if(request('search'))
              <input type="hidden" name="search" value="{{ request('search') }}">
            @endif
            @if(request('is_top'))
              <input type="hidden" name="is_top" value="{{ request('is_top') }}">
            @endif
            <div class="filter-sidebar-wrapper">
              <div class="d-flex justify-content-between align-items-center mb-3">
                <h4 class="fw-bold mb-0" style="font-size: 15px; color: #0d1b2a">Filters By</h4>
                <a href="{{ request('is_top') ? route('top.universities') : route('university') }}" class="text-decoration-none text-primary fw-bold"
                  style="font-size: 13px">Reset All</a>
              </div>

              <!-- Region -->
              <div class="filter-group-card mb-3">
                <div class="filter-group-header d-flex justify-content-between align-items-center"
                  data-bs-toggle="collapse" data-bs-target="#filterRegions" aria-expanded="true">
                  <span>Region</span>
                  <i class="fa-solid fa-chevron-down"></i>
                </div>
                <div class="collapse show" id="filterRegions">
                  <div class="filter-group-body">
                    <div class="filter-checklist">
                      @foreach(['North India', 'South India', 'East India', 'West India', 'Central India'] as $idx => $reg)
                        <div class="form-check mb-2">
                          <input class="form-check-input" type="checkbox" name="region[]" value="{{ $reg }}"
                            id="ureg{{ $idx }}" onchange="this.form.submit()" {{ in_array($reg, (array) request('region', [])) ? 'checked' : '' }}>
                          <label class="form-check-label ms-1" for="ureg{{ $idx }}">{{ $reg }}</label>
                        </div>
                      @endforeach
                    </div>
                  </div>
                </div>
              </div>

              <!-- State -->
              <div class="filter-group-card mb-3">
                <div class="filter-group-header d-flex justify-content-between align-items-center"
                  data-bs-toggle="collapse" data-bs-target="#filterState" aria-expanded="false">
                  <span>State</span>
                  <i class="fa-solid fa-chevron-down"></i>
                </div>
                <div class="collapse" id="filterState">
                  <div class="filter-group-body">
                    <div class="filter-checklist" style="max-height:200px;overflow-y:auto;">
                      @foreach(['Uttarakhand', 'Rajasthan', 'Uttar Pradesh', 'Maharashtra', 'Karnataka', 'Tamil Nadu', 'Delhi', 'Gujarat', 'Himachal Pradesh', 'Punjab', 'West Bengal', 'Bihar', 'Madhya Pradesh', 'Telangana', 'Kerala', 'Andhra Pradesh'] as $idx => $st)
                        <div class="form-check mb-2">
                          <input class="form-check-input" type="checkbox" name="state[]" value="{{ $st }}"
                            id="ust{{ $idx }}" onchange="this.form.submit()" {{ in_array($st, (array) request('state', [])) ? 'checked' : '' }}>
                          <label class="form-check-label ms-1" for="ust{{ $idx }}">{{ $st }}</label>
                        </div>
                      @endforeach
                    </div>
                  </div>
                </div>
              </div>

              <!-- City -->
              <div class="filter-group-card mb-3">
                <div class="filter-group-header d-flex justify-content-between align-items-center"
                  data-bs-toggle="collapse" data-bs-target="#filterCity" aria-expanded="false">
                  <span>City</span>
                  <i class="fa-solid fa-chevron-down"></i>
                </div>
                <div class="collapse" id="filterCity">
                  <div class="filter-group-body">
                    <div class="filter-checklist" style="max-height:200px;overflow-y:auto;">
                      @foreach(['Dehradun', 'Delhi', 'Bengaluru', 'Mumbai', 'Hyderabad', 'Chennai', 'Pune', 'Jaipur', 'Ahmedabad', 'Chandigarh', 'Lucknow', 'Kolkata', 'Bhopal', 'Indore', 'Patna'] as $idx => $cy)
                        <div class="form-check mb-2">
                          <input class="form-check-input" type="checkbox" name="city[]" value="{{ $cy }}" id="ucy{{ $idx }}"
                            onchange="this.form.submit()" {{ in_array($cy, (array) request('city', [])) ? 'checked' : '' }}>
                          <label class="form-check-label ms-1" for="ucy{{ $idx }}">{{ $cy }}</label>
                        </div>
                      @endforeach
                    </div>
                  </div>
                </div>
              </div>

              <!-- University Type -->
              <div class="filter-group-card mb-3">
                <div class="filter-group-header d-flex justify-content-between align-items-center"
                  data-bs-toggle="collapse" data-bs-target="#filterUnivType" aria-expanded="true">
                  <span>University Type</span>
                  <i class="fa-solid fa-chevron-down"></i>
                </div>
                <div class="collapse show" id="filterUnivType">
                  <div class="filter-group-body">
                    <div class="filter-checklist">
                      @foreach(['Central', 'State', 'Deemed', 'Private', 'Autonomous'] as $idx => $ut)
                        <div class="form-check mb-2">
                          <input class="form-check-input" type="checkbox" name="university_type[]" value="{{ $ut }}"
                            id="uut{{ $idx }}" onchange="this.form.submit()" {{ in_array($ut, (array) request('university_type', [])) ? 'checked' : '' }}>
                          <label class="form-check-label ms-1" for="uut{{ $idx }}">{{ $ut }}</label>
                        </div>
                      @endforeach
                    </div>
                  </div>
                </div>
              </div>

              <!-- Ownership -->
              <div class="filter-group-card mb-3">
                <div class="filter-group-header d-flex justify-content-between align-items-center"
                  data-bs-toggle="collapse" data-bs-target="#filterOwnership" aria-expanded="false">
                  <span>Ownership</span>
                  <i class="fa-solid fa-chevron-down"></i>
                </div>
                <div class="collapse" id="filterOwnership">
                  <div class="filter-group-body">
                    <div class="filter-checklist">
                      @foreach(['Private', 'Government', 'Trust'] as $idx => $own)
                        <div class="form-check mb-2">
                          <input class="form-check-input" type="checkbox" name="ownership[]" value="{{ $own }}"
                            id="uown{{ $idx }}" onchange="this.form.submit()" {{ in_array($own, (array) request('ownership', [])) ? 'checked' : '' }}>
                          <label class="form-check-label ms-1" for="uown{{ $idx }}">{{ $own }}</label>
                        </div>
                      @endforeach
                    </div>
                  </div>
                </div>
              </div>

              <!-- Level / Programs -->
              <div class="filter-group-card mb-3">
                <div class="filter-group-header d-flex justify-content-between align-items-center"
                  data-bs-toggle="collapse" data-bs-target="#filterLevel" aria-expanded="false">
                  <span>Program Level</span>
                  <i class="fa-solid fa-chevron-down"></i>
                </div>
                <div class="collapse" id="filterLevel">
                  <div class="filter-group-body">
                    <div class="filter-checklist">
                      @foreach(['Diploma', 'UG', 'PG', 'PhD', 'MBA', 'B.Tech', 'M.Tech'] as $idx => $lv)
                        <div class="form-check mb-2">
                          <input class="form-check-input" type="checkbox" name="level[]" value="{{ $lv }}"
                            id="ulv{{ $idx }}" onchange="this.form.submit()" {{ in_array($lv, (array) request('level', [])) ? 'checked' : '' }}>
                          <label class="form-check-label ms-1" for="ulv{{ $idx }}">{{ $lv }}</label>
                        </div>
                      @endforeach
                    </div>
                  </div>
                </div>
              </div>

              <button type="submit" class="btn btn-primary w-100 fw-bold rounded-pill mt-2">Apply Filters</button>
            </div>
          </form>
        </div>

        <!-- Right Catalog Grid -->
        <div class="col-lg-9 col-md-8">

          <!-- Search Bar -->
          <form action="{{ route('university') }}" method="GET" class="mb-3">
            @foreach(request()->except('search') as $key => $val)
              @if(is_array($val))
                @foreach($val as $v)
                  <input type="hidden" name="{{ $key }}[]" value="{{ $v }}">
                @endforeach
              @else
                <input type="hidden" name="{{ $key }}" value="{{ $val }}">
              @endif
            @endforeach
            <div class="input-group">
              <span class="input-group-text bg-white border-end-0"><i
                  class="fa-solid fa-magnifying-glass text-muted"></i></span>
              <input type="text" name="search" class="form-control border-start-0 ps-0"
                placeholder="Search universities by name, location..." value="{{ request('search') }}">
              <button class="btn btn-primary px-4 fw-bold" type="submit">Search</button>
            </div>
          </form>

          <!-- Active Filters Bar -->
          @php
            $activeFilters = [];
            foreach (['region', 'state', 'city', 'university_type', 'ownership', 'level'] as $fk) {
              foreach ((array) request($fk, []) as $fv) {
                $activeFilters[$fk][] = $fv;
              }
            }
            if (request('search'))
              $activeFilters['search'][] = request('search');
          @endphp
          @if(!empty($activeFilters))
            <div class="d-flex flex-wrap align-items-center gap-2 mb-3">
              <span class="fw-bold small text-muted">Active Filters:</span>
              @foreach($activeFilters as $fk => $fvs)
                @foreach($fvs as $fv)
                  <span class="badge rounded-pill px-3 py-2"
                    style="background:#eef3ff;color:#1a3a7c;font-size:12px;border:1px solid #b6ccff;">
                    {{ $fv }}
                    <a href="{{ url()->current() . '?' . http_build_query(array_merge_recursive(request()->except($fk), [])) }}"
                      class="text-danger ms-1" title="Remove" style="text-decoration:none;">&times;</a>
                  </span>
                @endforeach
              @endforeach
              <a href="{{ route('university') }}" class="btn btn-sm btn-outline-secondary rounded-pill">Clear All</a>
            </div>
          @endif

          <!-- Count + Sort Row -->
          <div class="catalog-header-bar d-flex justify-content-between align-items-center flex-wrap gap-3 mb-3">
            <span class="text-muted" style="font-size:13.5px;">Showing
              <strong>{{ $universities->firstItem() }}–{{ $universities->lastItem() }}</strong> of
              <strong>{{ $universities->total() }}</strong> universities</span>
            <select class="form-select catalog-sort-select" style="max-width:200px;">
              <option selected>Recommended</option>
              <option>NIRF Rank</option>
              <option>NAAC Grade</option>
            </select>
          </div>

          <!-- Cards Grid -->
          <div class="row row-cols-1 row-cols-md-2 g-4 uni-detail-col align-items-stretch">
            @forelse($universities as $university)
              @php
                $logoUrl = $university->logo_url
                  ? (str_starts_with($university->logo_url, 'http') ? $university->logo_url : rtrim(env('BACKEND_URL', 'http://127.0.0.1:8001'), '/') . '/' . ltrim($university->logo_url, '/'))
                  : asset('assets/images/uni-icon.png');
                $levels = is_string($university->levels_offered) ? json_decode($university->levels_offered, true) : ($university->levels_offered ?? []);
                $levels = is_array($levels) ? $levels : [];
                $levelStr = !empty($levels) ? implode(', ', array_filter($levels, 'is_string')) : 'UG & PG';
              @endphp
              <div class="col d-flex">
                <div class="univ-card w-100" style="text-align:left; cursor:pointer;"
                  onclick="window.location='{{ route('university.detail', $university->slug) }}'">
                  @if($university->nirf_rank_overall)
                    <span class="univ-ranking-badge"><img src="{{ asset('assets/images/star-icon.png') }}" alt="" /> NIRF
                      #{{ $university->nirf_rank_overall }}</span>
                  @endif

                  {{-- Header: Logo + Name/Meta side by side --}}
                  <div class="d-flex align-items-start gap-3 mb-3 mt-3">
                    <div class="univ-card-logo flex-shrink-0" style="margin:0;">
                      <img src="{{ $logoUrl }}" alt="{{ $university->name }} Logo"
                        onerror="this.src='{{ asset('assets/images/uni-icon.png') }}'">
                    </div>
                    <div style="min-width:0;">
                      <h3 class="univ-card-name" style="margin-bottom:4px;">
                        {{ $university->brand_name ?? $university->name }}
                      </h3>
                      <p class="univ-card-meta" style="margin-bottom:4px;font-size:12px;">
                        <i class="fa-solid fa-location-dot me-1 text-muted"></i>
                        {{ Str::limit($university->head_office_location ?? 'India', 40) }}
                      </p>
                      <div class="d-flex flex-wrap gap-1">
                        @if($university->ownership_type)
                          <span class="badge"
                            style="background:#eef3ff;color:#1a3a7c;font-size:10px;font-weight:500;">{{ $university->ownership_type }}</span>
                        @endif
                        @if($university->university_type)
                          <span class="badge"
                            style="background:#fff4e6;color:#a04000;font-size:10px;font-weight:500;">{{ $university->university_type }}</span>
                        @endif
                        @if($university->naac_grade)
                          <span class="badge" style="background:#e8f8f0;color:#1a7c4a;font-size:10px;font-weight:500;">NAAC
                            {{ $university->naac_grade }}</span>
                        @endif
                      </div>
                    </div>
                  </div>

                  {{-- Stats --}}
                  <div class="univ-card-stats">
                    <div class="univ-stat-row">
                      <span class="univ-stat-label">Programs:</span>
                      <span class="univ-stat-value">{{ Str::limit($levelStr, 35) }}</span>
                    </div>
                    <div class="univ-stat-row">
                      <span class="univ-stat-label">Established:</span>
                      <span class="univ-stat-value">{{ $university->established_year ?? 'N/A' }}</span>
                    </div>
                    @if($university->number_of_campuses)
                      <div class="univ-stat-row">
                        <span class="univ-stat-label">Campuses:</span>
                        <span class="univ-stat-value">{{ $university->number_of_campuses }}</span>
                      </div>
                    @endif
                  </div>

                  {{-- Action Buttons --}}
                  <div class="univ-card-actions">
                    <button class="btn-action-compare" style="background-color:#f3f3f3;border:1px solid #dcdcdc;"
                      onclick="event.stopPropagation();">
                      <img src="{{ asset('assets/images/compare-icon.png') }}" alt="" /> Compare
                    </button>
                    <a href="{{ route('contact', ['from_org' => $university->brand_name ?? $university->name]) }}#contact-form"
                      class="btn-action-brochure text-decoration-none text-white d-inline-flex align-items-center justify-content-center"
                      onclick="event.stopPropagation();" style="background-color: #f39c12; color: #fff !important;">
                      Enquire <img src="{{ asset('assets/images/download-icon.png') }}" alt="" />
                    </a>
                    <a href="{{ route('contact', ['from_org' => $university->brand_name ?? $university->name, 'looking_for' => 'Admission']) }}#contact-form"
                      class="btn-action-apply text-decoration-none text-white d-inline-flex align-items-center justify-content-center"
                      onclick="event.stopPropagation();">
                      Apply Now <img src="{{ asset('assets/images/right-icon.png') }}" alt="" />
                    </a>
                  </div>

                  {{-- Footer Links --}}
                  <div class="univ-card-footer-links" onclick="event.stopPropagation();">
                    <a href="{{ route('university.detail', $university->slug) }}#overview">Overview</a>
                    <span class="separator">|</span>
                    <a href="{{ route('university.detail', $university->slug) }}#admissions">Admission</a>
                    <span class="separator">|</span>
                    <a href="{{ route('university.detail', $university->slug) }}#fee-structure">Courses</a>
                    <span class="separator">|</span>
                    <a href="{{ route('university.detail', $university->slug) }}#address-contact">Ranking</a>
                  </div>
                </div>
              </div>
            @empty
              <div class="col-12 text-center py-5">
                <div class="p-5 bg-white rounded-4 shadow-sm border">
                  <i class="fa-solid fa-university fa-3x text-muted mb-3"></i>
                  <h4>No Universities Found</h4>
                  <p class="text-muted">Try adjusting your filters or search term.</p>
                  <a href="{{ route('university') }}" class="btn btn-primary rounded-pill px-4">Reset Filters</a>
                </div>
              </div>
            @endforelse
          </div>

          <!-- Pagination -->
          <div class="mt-4">
            {{ $universities->appends(request()->query())->links('pagination::bootstrap-5') }}
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Curved Footer Section -->
@endsection