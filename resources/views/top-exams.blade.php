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
            <div class="row g-4">
                <!-- Left Sidebar Filters -->
                <div class="col-lg-3 col-md-4">
                    <!-- Showing Count Card -->
                    <div class="showing-count-card mb-3">
                        Showing <span class="text-primary fw-bold">307</span> Exams
                    </div>

                    <!-- Sidebar Filter wrapper -->
                    <div class="filter-sidebar-wrapper">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h4 class="fw-bold mb-0" style="font-size: 15px; color: #0D1B2A;">Filters By</h4>
                            <a href="#" class="text-decoration-none text-primary fw-bold" style="font-size: 13px;">Reset All</a>
                        </div>

                        <!-- Category of Exams Accordion Block -->
                        <div class="filter-group-card mb-3">
                            <div class="filter-group-header d-flex justify-content-between align-items-center" data-bs-toggle="collapse" data-bs-target="#filterCategory" aria-expanded="true">
                                <span>Category of Exams</span>
                                <i class="fa-solid fa-chevron-down"></i>
                            </div>
                            <div class="collapse show" id="filterCategory">
                                <div class="filter-group-body">
                                    <div class="filter-checklist">
                                        <div class="form-check d-flex align-items-center justify-content-between mb-2">
                                            <div>
                                                <input class="form-check-input" type="checkbox" id="cat1">
                                                <label class="form-check-label ms-1" for="cat1">Entrance</label>
                                            </div>
                                        </div>
                                        <div class="form-check d-flex align-items-center justify-content-between mb-2">
                                            <div>
                                                <input class="form-check-input" type="checkbox" id="cat2">
                                                <label class="form-check-label ms-1" for="cat2">Board</label>
                                            </div>
                                        </div>
                                        <div class="form-check d-flex align-items-center justify-content-between mb-2">
                                            <div>
                                                <input class="form-check-input" type="checkbox" id="cat3">
                                                <label class="form-check-label ms-1" for="cat3">Sarkari</label>
                                            </div>
                                        </div>
                                        <div class="form-check d-flex align-items-center justify-content-between mb-2">
                                            <div>
                                                <input class="form-check-input" type="checkbox" id="cat4">
                                                <label class="form-check-label ms-1" for="cat4">Counselling</label>
                                            </div>
                                        </div>
                                        <div class="form-check d-flex align-items-center justify-content-between mb-2">
                                            <div>
                                                <input class="form-check-input" type="checkbox" id="cat5">
                                                <label class="form-check-label ms-1" for="cat5">Study Abroad</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Streams of Exams Accordion Block -->
                        <div class="filter-group-card mb-3">
                            <div class="filter-group-header d-flex justify-content-between align-items-center" data-bs-toggle="collapse" data-bs-target="#filterStreams" aria-expanded="true">
                                <span>Streams of Exams</span>
                                <i class="fa-solid fa-chevron-down"></i>
                            </div>
                            <div class="collapse show" id="filterStreams">
                                <div class="filter-group-body">
                                    <div class="filter-search-wrapper mb-3">
                                        <i class="fa-solid fa-magnifying-glass"></i>
                                        <input type="text" placeholder="Search by streams" class="form-control">
                                    </div>
                                    <div class="filter-checklist">
                                        <div class="form-check d-flex align-items-center justify-content-between mb-2">
                                            <div>
                                                <input class="form-check-input" type="checkbox" id="stream1" checked>
                                                <label class="form-check-label ms-1" for="stream1" >Engineering</label>
                                            </div>
                                        </div>
                                        <div class="form-check d-flex align-items-center justify-content-between mb-2">
                                            <div>
                                                <input class="form-check-input" type="checkbox" id="stream2">
                                                <label class="form-check-label ms-1" for="stream2">Medical</label>
                                            </div>
                                        </div>
                                        <div class="form-check d-flex align-items-center justify-content-between mb-2">
                                            <div>
                                                <input class="form-check-input" type="checkbox" id="stream3">
                                                <label class="form-check-label ms-1" for="stream3">Law</label>
                                            </div>
                                        </div>
                                        <div class="form-check d-flex align-items-center justify-content-between mb-2">
                                            <div>
                                                <input class="form-check-input" type="checkbox" id="stream4">
                                                <label class="form-check-label ms-1" for="stream4">Management</label>
                                            </div>
                                        </div>
                                        <div class="form-check d-flex align-items-center justify-content-between mb-2">
                                            <div>
                                                <input class="form-check-input" type="checkbox" id="stream5">
                                                <label class="form-check-label ms-1" for="stream5">Design</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Course Groups Accordion Block -->
                        <div class="filter-group-card mb-3">
                            <div class="filter-group-header d-flex justify-content-between align-items-center" data-bs-toggle="collapse" data-bs-target="#filterCourseGroups" aria-expanded="false">
                                <span>Course Groups</span>
                                <i class="fa-solid fa-chevron-down"></i>
                            </div>
                            <div class="collapse" id="filterCourseGroups">
                                <div class="filter-group-body">
                                    <div class="filter-search-wrapper mb-3">
                                        <i class="fa-solid fa-magnifying-glass"></i>
                                        <input type="text" placeholder="Search By Courses" class="form-control">
                                    </div>
                                    <div class="filter-checklist">
                                        <div class="form-check d-flex align-items-center justify-content-between mb-2">
                                            <div>
                                                <input class="form-check-input" type="checkbox" id="cg1">
                                                <label class="form-check-label ms-1" for="cg1">B.E. / B.Tech</label>
                                            </div>
                                        </div>
                                        <div class="form-check d-flex align-items-center justify-content-between mb-2">
                                            <div>
                                                <input class="form-check-input" type="checkbox" id="cg2">
                                                <label class="form-check-label ms-1" for="cg2">MBA/PGDM</label>
                                            </div>
                                        </div>
                                        <div class="form-check d-flex align-items-center justify-content-between mb-2">
                                            <div>
                                                <input class="form-check-input" type="checkbox" id="cg3">
                                                <label class="form-check-label ms-1" for="cg3">LL.B.</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Level of Exams Accordion Block -->
                        <div class="filter-group-card mb-3">
                            <div class="filter-group-header d-flex justify-content-between align-items-center" data-bs-toggle="collapse" data-bs-target="#filterLevel" aria-expanded="false">
                                <span>Level of Exams</span>
                                <i class="fa-solid fa-chevron-down"></i>
                            </div>
                            <div class="collapse" id="filterLevel">
                                <div class="filter-group-body">
                                    <div class="filter-search-wrapper mb-3">
                                        <i class="fa-solid fa-magnifying-glass"></i>
                                        <input type="text" placeholder="Search By Degree" class="form-control">
                                    </div>
                                    <div class="filter-checklist">
                                        <div class="form-check d-flex align-items-center justify-content-between mb-2">
                                            <div>
                                                <input class="form-check-input" type="checkbox" id="lvl1">
                                                <label class="form-check-label ms-1" for="lvl1">UG</label>
                                            </div>
                                        </div>
                                        <div class="form-check d-flex align-items-center justify-content-between mb-2">
                                            <div>
                                                <input class="form-check-input" type="checkbox" id="lvl2">
                                                <label class="form-check-label ms-1" for="lvl2">PG</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Exam Recognize/States Accordion Block -->
                        <div class="filter-group-card mb-3">
                            <div class="filter-group-header d-flex justify-content-between align-items-center" data-bs-toggle="collapse" data-bs-target="#filterStates" aria-expanded="false">
                                <span>Exam Recognize/States</span>
                                <i class="fa-solid fa-chevron-down"></i>
                            </div>
                            <div class="collapse" id="filterStates">
                                <div class="filter-group-body">
                                    <div class="filter-search-wrapper mb-3">
                                        <i class="fa-solid fa-magnifying-glass"></i>
                                        <input type="text" placeholder="Search" class="form-control">
                                    </div>
                                    <div class="filter-checklist">
                                        <div class="form-check d-flex align-items-center justify-content-between mb-2">
                                            <div>
                                                <input class="form-check-input" type="checkbox" id="state1">
                                                <label class="form-check-label ms-1" for="state1">National</label>
                                            </div>
                                        </div>
                                        <div class="form-check d-flex align-items-center justify-content-between mb-2">
                                            <div>
                                                <input class="form-check-input" type="checkbox" id="state2">
                                                <label class="form-check-label ms-1" for="state2">State</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Institutes Accordion Block -->
                        <div class="filter-group-card">
                            <div class="filter-group-header d-flex justify-content-between align-items-center" data-bs-toggle="collapse" data-bs-target="#filterInstitutes" aria-expanded="false">
                                <span>Institutes</span>
                                <i class="fa-solid fa-chevron-down"></i>
                            </div>
                            <div class="collapse" id="filterInstitutes">
                                <div class="filter-group-body">
                                    <div class="filter-checklist">
                                        <div class="form-check d-flex align-items-center justify-content-between mb-2">
                                            <div>
                                                <input class="form-check-input" type="checkbox" id="inst1">
                                                <label class="form-check-label ms-1" for="inst1">Private</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- Right catalog listing grid -->
                <div class="col-lg-9 col-md-8">
                    <!-- Sorting & active filter row -->
                    <div class="catalog-header-bar d-flex justify-content-between align-items-center flex-wrap gap-3">
                        <div class="d-flex align-items-center gap-2 flex-wrap">
                            <span class="text-muted fw-bold" style="font-size: 13.5px;">Active Filters:</span>
                            <button class="filter-pill">
                                All Exams
                                <i class="fa-solid fa-xmark"></i>
                            </button>
                        </div>
                        <select class="form-select catalog-sort-select">
                            <option selected>Recommended</option>
                            <option>Popularity</option>
                            <option>Alphabetical</option>
                        </select>
                    </div>

                    <!-- Cards Row Grid -->
                    <div class="row row-cols-1 row-cols-md-2 g-4 uni-detail-col">
            @if(isset($exams) && $exams->count() > 0)
                @foreach($exams as $exam)
                <div class="col">
                    <div class="card h-100 border-0 p-3" style="border: 1px solid #E1E8F1 !important; border-radius: 12px; box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.05);">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-3">
                                <div class="icon-wrapper d-flex justify-content-center align-items-center rounded-circle me-3" style="width: 50px; height: 50px; border: 1px solid #E1E8F1; flex-shrink: 0;">
                                    @if($exam->logo)
                                        <img src="{{ env('BACKEND_URL') . '/' . $exam->logo }}" alt="{{ $exam->name }}" style="max-width:30px;max-height:30px;object-fit:contain;">
                                    @else
                                        <img src="{{ asset('assets/images/top-exam-icon-1.png') }}" alt="{{ $exam->name }}">
                                    @endif
                                </div>
                                <div>
                                    <h5 class="card-title fw-bold mb-1" style="font-size: 16px; color: #000;">
                                        <a href="{{ route('exam.detail', $exam->slug) }}" class="text-decoration-none text-dark">{{ $exam->name }}</a>
                                    </h5>
                                </div>
                            </div>
                            <p class="card-text text-muted" style="font-size: 13px; line-height: 1.5; margin-bottom: 20px;">
                                {{ Str::limit(strip_tags($exam->about_exam), 100) }}
                            </p>
                            <div class="d-flex justify-content-between align-items-center border-top pt-3 mt-auto">
                                <span style="font-size: 13px; font-weight: 500; color: #164081;">
                                    <i class="fa-regular fa-clock me-1"></i> {{ $exam->exam_frequency ?? 'Once a year' }}
                                </span>
                                <a href="{{ route('exam.detail', $exam->slug) }}" class="text-decoration-none fw-semibold" style="font-size: 13px; color: #2864C6;">
                                    Explore <i class="fa-solid fa-chevron-right" style="font-size: 10px; margin-left: 2px;"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            @else
                <div class="col-12 text-center">
                    <p>No exams found.</p>
                </div>
            @endif
          </div>
          <div class="inner-pagination-wrapper d-flex justify-content-center mt-4">
            {{ $exams->links('pagination::bootstrap-5') }}
          </div>

                </div>
            </div>
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
        (function () {
            const megaMenu = document.querySelector('.mega-menu-wrapper');
            if (!megaMenu) return;

            const triggerItems = document.querySelectorAll('.nav-item[data-tab-trigger]');
            let hideTimeout;

            function showMenu(tabId) {
                clearTimeout(hideTimeout);
                megaMenu.classList.add('show-mega');

                // Switch tab sidebar and content panel
                const sidebarItem = megaMenu.querySelector(`.mega-sidebar-item[data-mega-tab="${tabId}"]`);
                if (sidebarItem) {
                    // Remove active classes
                    megaMenu.querySelectorAll('.mega-sidebar-item').forEach(i => i.classList.remove('active'));
                    megaMenu.querySelectorAll('.mega-tab-content').forEach(pane => pane.classList.remove('active'));

                    // Set active
                    sidebarItem.classList.add('active');
                    const targetPane = megaMenu.querySelector('#' + tabId);
                    if (targetPane) {
                        targetPane.classList.add('active');
                    }
                }
            }

            function hideMenu() {
                hideTimeout = setTimeout(() => {
                    megaMenu.classList.remove('show-mega');
                }, 150); // delay to allow moving between trigger and menu
            }

            triggerItems.forEach(item => {
                item.addEventListener('mouseenter', function () {
                    const tabId = this.getAttribute('data-tab-trigger');
                    showMenu(tabId);
                });

                item.addEventListener('mouseleave', function () {
                    hideMenu();
                });
            });

            megaMenu.addEventListener('mouseenter', function () {
                clearTimeout(hideTimeout);
            });

            megaMenu.addEventListener('mouseleave', function () {
                hideMenu();
            });

            // Mega Menu inner sidebar tab switching on hover
            const sidebarItems = megaMenu.querySelectorAll('.mega-sidebar-item');
            sidebarItems.forEach(item => {
                item.addEventListener('mouseenter', function () {
                    // Remove active classes inside menu
                    megaMenu.querySelectorAll('.mega-sidebar-item').forEach(i => i.classList.remove('active'));
                    megaMenu.querySelectorAll('.mega-tab-content').forEach(pane => pane.classList.remove('active'));

                    // Set active
                    this.classList.add('active');
                    const targetTabId = this.getAttribute('data-mega-tab');
                    const targetPane = megaMenu.querySelector('#' + targetTabId);
                    if (targetPane) {
                        targetPane.classList.add('active');
                    }
                });
            });
        })();
    </script>

@endsection