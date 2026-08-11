@extends('layouts.app')

@section('content')
<main class="about-hero-section ptb-70">
      <div class="bg-square">
        <img src="assets/images/banner-square-img.svg" alt="" />
      </div>
      <div class="container">
        <div class="about-hero-container">
          <img src="assets/images/top-exam-img.png" alt="" />

          <!-- Centered Badge (Placed outside card to prevent clipping) -->
          <div class="about-us-badge-wrapper">
            <button class="about-us-badge">Top Exams</button>
            <p>Explore our complete list of universities.</p>
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

    <!-- Partner Logos Band -->
     <div class="univ-partner-band">
      <div class="container">
      <div class="swiper exam-logo-swiper" style="padding: 20px 0;">
        <div class="swiper-wrapper align-items-center">
          @foreach($exams as $exam)
            @php
              $logoUrl = $exam->logo
                ? (str_starts_with($exam->logo, 'http') ? $exam->logo : rtrim(env('BACKEND_URL', 'http://127.0.0.1:8001'), '/') . '/' . ltrim($exam->logo, '/'))
                : asset('assets/images/jee-main-logo.png');
            @endphp
            <div class="swiper-slide d-flex justify-content-center">
              <a href="{{ route('exam.detail', $exam->slug) }}" class="univ-logo-circle d-flex align-items-center justify-content-center bg-white shadow-sm" style="width: 100px; height: 100px; border-radius: 50%; padding: 10px; overflow: hidden; border: 1px solid #eee; text-decoration: none;" title="{{ $exam->name }}">
                <img src="{{ $logoUrl }}" alt="{{ $exam->name }}" style="max-width: 100%; max-height: 100%; object-fit: contain;" onerror="this.src='{{ asset('assets/images/jee-main-logo.png') }}'" />
              </a>
            </div>
          @endforeach
        </div>
      </div>
      
      <script>
        document.addEventListener('DOMContentLoaded', function () {
          if (typeof Swiper !== 'undefined') {
            new Swiper('.exam-logo-swiper', {
              slidesPerView: 3,
              spaceBetween: 20,
              loop: true,
              autoplay: {
                delay: 2500,
                disableOnInteraction: false,
              },
              breakpoints: {
                576: { slidesPerView: 4, spaceBetween: 20 },
                768: { slidesPerView: 6, spaceBetween: 30 },
                992: { slidesPerView: 8, spaceBetween: 30 },
                1200: { slidesPerView: 9, spaceBetween: 30 },
              }
            });
          }
        });
      </script>
      </div>
    </div>

    <!-- Breadcrumb path -->
    <div class="py-3" style="background-color: #f9ad0b14">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0" style="font-size: 13.5px; font-weight: 500;">
                    <li class="breadcrumb-item"><a href="#" class="text-decoration-none text-muted"><i class="fa-solid fa-house me-1"></i> Home</a></li>
                    <li class="breadcrumb-item active text-primary" aria-current="page">Exams</li>
                </ol>
            </nav>
        </div>
    </div>

    <!-- Main Catalog Section -->
    <section class="univ-catalog-section">
        <div class="container">
            <form method="GET" action="{{ route('top-exams') }}" id="examFilterForm">
            <div class="row g-4">
                <!-- Left Sidebar Filters -->
                <div class="col-lg-3 col-md-4">
                    <!-- Showing Count Card -->
                    <div class="showing-count-card mb-3">
                        Showing <span class="text-primary fw-bold">{{ $exams->total() }}</span> Exams
                    </div>

                    <!-- Sidebar Filter wrapper -->
                    <div class="filter-sidebar-wrapper">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h4 class="fw-bold mb-0" style="font-size: 15px; color: #0D1B2A;">Filters By</h4>
                            <a href="{{ route('top-exams') }}" class="text-decoration-none text-primary fw-bold" style="font-size: 13px;">Reset All</a>
                        </div>

                        <!-- Search -->
                        <div class="filter-group-card mb-3">
                            <div class="filter-group-header d-flex justify-content-between align-items-center" data-bs-toggle="collapse" data-bs-target="#filterSearch" aria-expanded="true">
                                <span>Search Exams</span>
                                <i class="fa-solid fa-chevron-down"></i>
                            </div>
                            <div class="collapse show" id="filterSearch">
                                <div class="filter-group-body">
                                    <div class="filter-search-wrapper">
                                        <i class="fa-solid fa-magnifying-glass"></i>
                                        <input type="text" name="search" id="examSearchInput" placeholder="Search by name..." class="form-control" value="{{ request('search') }}">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Category of Exams Accordion Block -->
                        @if($allCategories->isNotEmpty())
                        <div class="filter-group-card mb-3">
                            <div class="filter-group-header d-flex justify-content-between align-items-center" data-bs-toggle="collapse" data-bs-target="#filterCategory" aria-expanded="true">
                                <span>Category of Exams</span>
                                <i class="fa-solid fa-chevron-down"></i>
                            </div>
                            <div class="collapse show" id="filterCategory">
                                <div class="filter-group-body">
                                    <div class="filter-checklist">
                                        @foreach($allCategories as $cat)
                                        <div class="form-check d-flex align-items-center justify-content-between mb-2">
                                            <div>
                                                <input class="form-check-input filter-checkbox" type="checkbox" name="category[]" value="{{ $cat }}" id="cat_{{ Str::slug($cat) }}"
                                                    {{ in_array($cat, (array) request('category', [])) ? 'checked' : '' }}>
                                                <label class="form-check-label ms-1" for="cat_{{ Str::slug($cat) }}">{{ $cat }}</label>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif

                        <!-- Exam Type Accordion Block -->
                        @if($allExamTypes->isNotEmpty())
                        <div class="filter-group-card mb-3">
                            <div class="filter-group-header d-flex justify-content-between align-items-center" data-bs-toggle="collapse" data-bs-target="#filterExamType" aria-expanded="false">
                                <span>Exam Type</span>
                                <i class="fa-solid fa-chevron-down"></i>
                            </div>
                            <div class="collapse {{ request('exam_type') ? 'show' : '' }}" id="filterExamType">
                                <div class="filter-group-body">
                                    <div class="filter-checklist">
                                        @foreach($allExamTypes as $type)
                                        <div class="form-check d-flex align-items-center justify-content-between mb-2">
                                            <div>
                                                <input class="form-check-input filter-radio" type="radio" name="exam_type" value="{{ $type }}" id="type_{{ Str::slug($type) }}"
                                                    {{ request('exam_type') === $type ? 'checked' : '' }}>
                                                <label class="form-check-label ms-1" for="type_{{ Str::slug($type) }}">{{ $type }}</label>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif

                        <!-- Conducting Body Type Accordion Block -->
                        @if($allConductingBodyTypes->isNotEmpty())
                        <div class="filter-group-card mb-3">
                            <div class="filter-group-header d-flex justify-content-between align-items-center" data-bs-toggle="collapse" data-bs-target="#filterConducting" aria-expanded="false">
                                <span>Conducting Body</span>
                                <i class="fa-solid fa-chevron-down"></i>
                            </div>
                            <div class="collapse {{ request('conducting_body_type') ? 'show' : '' }}" id="filterConducting">
                                <div class="filter-group-body">
                                    <div class="filter-checklist">
                                        @foreach($allConductingBodyTypes as $bodyType)
                                        <div class="form-check d-flex align-items-center justify-content-between mb-2">
                                            <div>
                                                <input class="form-check-input filter-radio" type="radio" name="conducting_body_type" value="{{ $bodyType }}" id="body_{{ Str::slug($bodyType) }}"
                                                    {{ request('conducting_body_type') === $bodyType ? 'checked' : '' }}>
                                                <label class="form-check-label ms-1" for="body_{{ Str::slug($bodyType) }}">{{ $bodyType }}</label>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif

                        <!-- Featured Exams -->
                        <div class="filter-group-card">
                            <div class="filter-group-body pt-2">
                                <div class="form-check d-flex align-items-center gap-2 mb-0">
                                    <input class="form-check-input filter-checkbox" type="checkbox" name="featured" value="1" id="featuredFilter"
                                        {{ request('featured') ? 'checked' : '' }}>
                                    <label class="form-check-label fw-semibold" for="featuredFilter" style="font-size: 13.5px;">Featured Exams Only</label>
                                </div>
                            </div>
                        </div>

                        <!-- Apply Button -->
                        <button type="submit" class="btn btn-primary w-100 mt-3" style="border-radius: 8px; font-size: 14px; font-weight: 600;">
                            <i class="fa-solid fa-filter me-1"></i> Apply Filters
                        </button>

                    </div>
                </div>

                <!-- Right catalog listing grid -->
                <div class="col-lg-9 col-md-8">
                    <!-- Sorting & active filter row -->
                    <div class="catalog-header-bar d-flex justify-content-between align-items-center flex-wrap gap-3">
                        <div class="d-flex align-items-center gap-2 flex-wrap">
                            <span class="text-muted fw-bold" style="font-size: 13.5px;">Active Filters:</span>

                            @php
                                $hasActiveFilters = request()->filled('search') || request()->filled('category') || request()->filled('exam_type') || request()->filled('conducting_body_type') || request()->boolean('featured');
                            @endphp

                            @if(!$hasActiveFilters)
                                <span class="filter-pill bg-light text-secondary border">All Exams</span>
                            @endif

                            @if(request()->filled('search'))
                                <span class="filter-pill">
                                    Search: {{ request('search') }}
                                    <a href="{{ route('top-exams', request()->except(['search', 'page'])) }}" class="text-white ms-1"><i class="fa-solid fa-xmark"></i></a>
                                </span>
                            @endif

                            @foreach((array) request('category', []) as $activeCat)
                                @php
                                    $remCategories = array_values(array_filter((array) request('category', []), fn($c) => $c !== $activeCat));
                                    $remParams = request()->except(['category', 'page']);
                                    if (!empty($remCategories)) {
                                        $remParams['category'] = $remCategories;
                                    }
                                @endphp
                                <span class="filter-pill">
                                    {{ $activeCat }}
                                    <a href="{{ route('top-exams', $remParams) }}" class="text-white ms-1"><i class="fa-solid fa-xmark"></i></a>
                                </span>
                            @endforeach

                            @if(request()->filled('exam_type'))
                                <span class="filter-pill">
                                    Type: {{ request('exam_type') }}
                                    <a href="{{ route('top-exams', request()->except(['exam_type', 'page'])) }}" class="text-white ms-1"><i class="fa-solid fa-xmark"></i></a>
                                </span>
                            @endif

                            @if(request()->filled('conducting_body_type'))
                                <span class="filter-pill">
                                    Body: {{ request('conducting_body_type') }}
                                    <a href="{{ route('top-exams', request()->except(['conducting_body_type', 'page'])) }}" class="text-white ms-1"><i class="fa-solid fa-xmark"></i></a>
                                </span>
                            @endif

                            @if(request()->boolean('featured'))
                                <span class="filter-pill">
                                    Featured
                                    <a href="{{ route('top-exams', request()->except(['featured', 'page'])) }}" class="text-white ms-1"><i class="fa-solid fa-xmark"></i></a>
                                </span>
                            @endif

                            @if($hasActiveFilters)
                                <a href="{{ route('top-exams') }}" class="btn btn-link btn-sm text-danger text-decoration-none ms-2 p-0" style="font-size: 12.5px; font-weight: 600;">
                                    <i class="fa-solid fa-trash-can me-1"></i>Clear All
                                </a>
                            @endif
                        </div>

                        <select name="sort" class="form-select catalog-sort-select" onchange="this.form.submit()" style="max-width: 180px;">
                            <option value="latest" {{ request('sort','latest') === 'latest' ? 'selected' : '' }}>Latest</option>
                            <option value="name" {{ request('sort') === 'name' ? 'selected' : '' }}>Alphabetical</option>
                            <option value="featured" {{ request('sort') === 'featured' ? 'selected' : '' }}>Featured First</option>
                        </select>
                    </div>

                    <!-- Cards Row Grid -->
                    <div class="row row-cols-1 row-cols-md-2 g-4 uni-detail-col mt-1">
                        @forelse($exams as $exam)
                        <div class="col">
                            <div class="exam-card">
                                @if($exam->featured_exam)
                                    <span class="exam-card-mode-badge" style="background-color: #3771C8; color: #fff;">⭐ Featured</span>
                                @endif

                                <div class="exam-card-logo">
                                    @if($exam->logo)
                                        <img src="{{ str_starts_with($exam->logo, 'http') ? $exam->logo : rtrim(env('BACKEND_URL', 'http://127.0.0.1:8001'), '/') . '/' . ltrim($exam->logo, '/') }}" alt="{{ $exam->name }}" style="max-height: 45px; max-width: 130px; object-fit: contain;">
                                    @else
                                        <img src="{{ asset('assets/images/jee-main-logo.png') }}" alt="{{ $exam->name }}" style="max-height: 45px; max-width: 130px; object-fit: contain;">
                                    @endif
                                </div>

                                <h3 class="exam-card-title">
                                    <a href="{{ route('exam.detail', $exam->slug) }}" class="text-decoration-none text-dark">
                                        {{ $exam->name }} @if($exam->short_name) - ({{ $exam->short_name }}) @endif
                                    </a>
                                </h3>

                                <p class="exam-card-meta">
                                    UG &bull; <span class="conducting-body">{{ $exam->conducting_authority_name ?? $exam->conducting_body_type ?? 'NTA' }}</span> &bull; 
                                    <span style="color: #F9AD0B;">
                                        @if(is_array($exam->exam_category) && count($exam->exam_category))
                                            {{ implode(', ', $exam->exam_category) }}
                                        @elseif(is_string($exam->exam_category))
                                            {{ $exam->exam_category }}
                                        @else
                                            General
                                        @endif
                                    </span>
                                </p>

                                <div class="exam-card-dates-box">
                                    <div class="exam-date-row">
                                        <span class="exam-date-label">Results</span>
                                        <span class="exam-date-value">Declared / TBA</span>
                                    </div>
                                    <div class="exam-date-row highlighted">
                                        <span class="exam-date-label">Exam Frequency</span>
                                        <span class="exam-date-value">{{ $exam->exam_frequency ?? 'Once a year' }}</span>
                                    </div>
                                    <div class="exam-date-row">
                                        <span class="exam-date-label">Registration</span>
                                        <span class="exam-date-value">Open</span>
                                    </div>
                                </div>

                                <div class="exam-card-actions">
                                    <a href="{{ route('exam.detail', $exam->slug) }}" class="btn-exam-details text-decoration-none">
                                        <i class="fa-regular fa-eye me-1"></i>View Details
                                    </a>
                                    <a href="{{ route('exam.detail', $exam->slug) }}" class="btn-exam-apply text-decoration-none">
                                        Apply Now <i class="fa-solid fa-chevron-right ms-1" style="font-size:9px;"></i>
                                    </a>
                                </div>

                                @if($exam->sections && count($exam->sections))
                                    <div class="exam-card-links-grid">
                                        @foreach($exam->sections->take(6) as $index => $sec)
                                            <a href="{{ route('exam.detail', $exam->slug) }}#{{ $sec->slug }}" class="exam-pill-link {{ $index == 3 ? 'span-2' : '' }}">{{ $sec->title }}</a>
                                        @endforeach
                                    </div>
                                @else
                                    <div class="exam-card-links-grid">
                                        <a href="{{ route('exam.detail', $exam->slug) }}" class="exam-pill-link">Admit Card</a>
                                        <a href="{{ route('exam.detail', $exam->slug) }}" class="exam-pill-link">Analysis</a>
                                        <a href="{{ route('exam.detail', $exam->slug) }}" class="exam-pill-link">Answer Key</a>
                                        <a href="{{ route('exam.detail', $exam->slug) }}" class="exam-pill-link span-2">Application Form</a>
                                        <a href="{{ route('exam.detail', $exam->slug) }}" class="exam-pill-link span-1">Process</a>
                                    </div>
                                @endif
                            </div>
                        </div>
                        @empty
                        <div class="col-12 text-center py-5">
                            <i class="fa-solid fa-magnifying-glass text-muted mb-3" style="font-size: 40px;"></i>
                            <p class="text-muted fw-semibold">No exams found for the selected filters.</p>
                            <a href="{{ route('top-exams') }}" class="btn btn-outline-primary btn-sm mt-2">Clear Filters</a>
                        </div>
                        @endforelse
                    </div>

                    <!-- Pagination -->
                    <div class="inner-pagination-wrapper d-flex justify-content-center mt-4">
                        {{ $exams->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            </div>
            </form>
        </div>
    </section>

    <!-- Curved Footer Section -->

   

    <!-- Curved Footer Section -->
    <footer class="footer-gradient-wrapper ptb-70 ">


        <!-- Floating Asterisk Shape -->


        <div class="container">
            <div class="footer-card">
                <div class="row g-5">
                    <!-- Left Column: Branding, Contact & Socials -->
                    <div class="col-lg-4">
                        <!-- Brand Logo -->
                        <a href="#" class="d-flex align-items-center mb-3 text-decoration-none">
                            <img src="assets/images/logo.svg" alt="" style="    width: 246px;">
                        </a>
                        <!-- Tech description -->
                        <p class="text-muted mb-4"
                            style="font-size: 14px; line-height: 1.5; font-weight: 500;color: #777777 !important;">
                            Enrollzy, a DPIIT-recognized education technology platform, enables students to explore,
                            compare, and access quality education opportunities with transparency and confidence.
                        </p>

                        <!-- Contact lists -->
                        <div class="footer-contact-item">
                            <span class="footer-contact-label">CONTACT US:</span>
                            <a href="mailto:info@enrollzy.com"
                                class="footer-contact-value text-decoration-none">info@enrollzy.com</a>
                        </div>
                        <div class="footer-contact-item d-flex align-items-start">
                            <span class="footer-contact-label mt-1">OUR ADDRESS:</span>
                            <span class="footer-contact-value" style="max-width: 220px; line-height: 1.4;">
                                Workaholics Workzone, SCO 364-365-366 Second Floor, Sector 34A, Chandigarh, 160022
                            </span>
                        </div>

                        <!-- Socials -->
                        <div class="footer-contact-item d-flex align-items-center gap-2 mt-4">
                            <span class="footer-contact-label">CONNECT US:</span>
                            <div class="social-icons-list">
                                <a href="#" class="social-icon-circle social-twitter">
                                    <img src="assets/images/twitter-icon.png" alt="">
                                </a>
                                <a href="#" class="social-icon-circle social-instagram">
                                    <img src="assets/images/footer-insta-icon.png" alt="">
                                </a>
                                <a href="#" class="social-icon-circle social-facebook">
                                    <img src="assets/images/footer-facebook-icon.png" alt="">
                                </a>
                                <a href="#" class="social-icon-circle social-linkedin">
                                    <img src="assets/images/footer-linkdin-icon.png" alt="">
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Right Column: Banner & link directory -->
                    <div class="col-lg-8">
                        <!-- Top Banner SVG illustration -->
                        <div class="footer-banner-box">
                            <img src="assets/images/footer-rect-img.png" alt="" style="width: 100%;">
                        </div>

                        <!-- 4 columns directories -->
                        <div class="row row-cols-2 row-cols-sm-4 g-4">
                            <!-- Col 1 -->
                            <div class="col">
                                <h3 class="footer-link-heading mb-3">
                                    Universities <span class="footer-heading-line"></span>
                                </h3>
                                <ul class="footer-links">
                                    <li><a href="#">Partner Universities</a></li>
                                    <li><a href="#">Online Universities</a></li>
                                    <li><a href="#">Top Ranked Universities</a></li>
                                    <li><a href="#">University Comparison</a></li>
                                    <li><a href="#">Trending Programs</a></li>
                                </ul>
                            </div>
                            <!-- Col 2 -->
                            <div class="col">
                                <h3 class="footer-link-heading mb-3">
                                    Student Support <span class="footer-heading-line"></span>
                                </h3>
                                <ul class="footer-links">
                                    <li><a href="#">Partner Universities</a></li>
                                    <li><a href="#">Online Universities</a></li>
                                    <li><a href="#">Top Ranked Universities</a></li>
                                    <li><a href="#">University Comparison</a></li>
                                    <li><a href="#">Trending Programs</a></li>
                                </ul>
                            </div>
                            <!-- Col 3 -->
                            <div class="col">
                                <h3 class="footer-link-heading mb-3">
                                    Student Support <span class="footer-heading-line"></span>
                                </h3>
                                <ul class="footer-links">
                                    <li><a href="#">Partner Universities</a></li>
                                    <li><a href="#">Online Universities</a></li>
                                    <li><a href="#">Top Ranked Universities</a></li>
                                    <li><a href="#">University Comparison</a></li>
                                    <li><a href="#">Trending Programs</a></li>
                                </ul>
                            </div>
                            <!-- Col 4 -->
                            <div class="col">
                                <h3 class="footer-link-heading mb-3">
                                    Universities <span class="footer-heading-line"></span>
                                </h3>
                                <ul class="footer-links">
                                    <li><a href="#">Partner Universities</a></li>
                                    <li><a href="#">Online Universities</a></li>
                                    <li><a href="#">Top Ranked Universities</a></li>
                                    <li><a href="#">University Comparison</a></li>
                                    <li><a href="#">Trending Programs</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Footer Divider -->
                <div class="footer-divider"></div>

                <!-- Copyright row -->
                <p class="footer-copyright">
                    © 2026 Uniband8 Education Technology Pvt. Ltd. <br> All Rights Reserved.
                </p>
            </div>
        </div>
    </footer>
    <div class="footer-vector">
        <img src="assets/images/footer-vector.png" alt="">
    </div>
    <div class="bottom-gradient-div ptb-70 pt-0"></div>
    <!-- Bootstrap Bundle JS -->
    

    <!-- Swiper Slider JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Hero Image Swiper
            const heroSwiper = new Swiper('.hero-swiper', {
                slidesPerView: 1,
                spaceBetween: 0,
                loop: true,
                autoplay: {
                    delay: 4000,
                    disableOnInteraction: false,
                },
                pagination: {
                    el: '.carousel-dots',
                    bulletClass: 'dot',
                    bulletActiveClass: 'active',
                    clickable: true,
                }
            });

            // Student Insights & Feedback Swiper
            const feedbackSwiper = new Swiper('.feedback-swiper', {
                slidesPerView: 1,
                spaceBetween: 24,
                loop: true,
                navigation: {
                    nextEl: '.feedback-next-btn',
                    prevEl: '.feedback-prev-btn',
                },
                breakpoints: {
                    768: {
                        slidesPerView: 2,
                    },
                    992: {
                        slidesPerView: 3,
                    }
                }
            });
        });
        (function () {
            const slider = document.getElementById('perfectUnivTabs');
            if (!slider) return;
            let isDown = false;
            let startX;
            let scrollLeft;
            let moved = false;

            slider.addEventListener('mousedown', (e) => {
                isDown = true;
                moved = false;
                slider.classList.add('dragging');
                startX = e.pageX - slider.offsetLeft;
                scrollLeft = slider.scrollLeft;
            });

            slider.addEventListener('mouseleave', () => {
                isDown = false;
                slider.classList.remove('dragging');
            });

            slider.addEventListener('mouseup', () => {
                isDown = false;
                slider.classList.remove('dragging');
            });

            slider.addEventListener('mousemove', (e) => {
                if (!isDown) return;
                e.preventDefault();
                const x = e.pageX - slider.offsetLeft;
                const walk = x - startX;
                if (Math.abs(walk) > 5) moved = true; // threshold so clicks still register as clicks
                slider.scrollLeft = scrollLeft - walk;
            });

            // Prevent tab click from firing right after a drag
            slider.addEventListener('click', (e) => {
                if (moved) {
                    e.preventDefault();
                    e.stopPropagation();
                }
            }, true);
        })();


        // Exam Filters Auto-Submit & Radio Toggle Script
        document.addEventListener('DOMContentLoaded', function() {
            const filterForm = document.getElementById('examFilterForm');
            if (!filterForm) return;

            // Auto submit on checkbox change
            const filterCheckboxes = filterForm.querySelectorAll('.filter-checkbox');
            filterCheckboxes.forEach(function(cb) {
                cb.addEventListener('change', function() {
                    filterForm.submit();
                });
            });

            // Handle radio buttons: allow unchecking on click and auto submit on change
            const filterRadios = filterForm.querySelectorAll('.filter-radio');
            filterRadios.forEach(function(radio) {
                radio.addEventListener('click', function(e) {
                    if (this.dataset.wasChecked === "true") {
                        this.checked = false;
                        this.dataset.wasChecked = "false";
                        // Clear name attribute momentarily or uncheck then submit
                        filterForm.submit();
                    } else {
                        // Mark all radios in same group as false
                        filterForm.querySelectorAll(`input[name="${this.name}"]`).forEach(r => r.dataset.wasChecked = "false");
                        this.dataset.wasChecked = "true";
                        filterForm.submit();
                    }
                });

                if (radio.checked) {
                    radio.dataset.wasChecked = "true";
                }
            });

            // Auto submit on search enter key
            const searchInput = document.getElementById('examSearchInput');
            if (searchInput) {
                searchInput.addEventListener('keydown', function(e) {
                    if (e.key === 'Enter') {
                        e.preventDefault();
                        filterForm.submit();
                    }
                });
            }
        });
    </script>

@endsection