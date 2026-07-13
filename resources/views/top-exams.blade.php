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
                        
                        <!-- Card 1 (JEE Main) -->
                        <div class="col">
                            <div class="exam-card">
                                
                                <div class="exam-card-logo">
                                    <img src="assets/images/jee-main-logo.png" alt="">
                                </div>
                                <h3 class="exam-card-title">JEE Main - (Joint Entrance Examination Main)</h3>
                                <p class="exam-card-meta">UG &bull; <span class="conducting-body">National Testing Agency (NTA)</span> &bull; <span style="color: #F9AD0B;">Engineering</span></p>
                                
                                <div class="exam-card-dates-box">
                                    <div class="exam-date-row">
                                        <span class="exam-date-label">Results</span>
                                        <span class="exam-date-value">20 Apr, 2026 to 20 Apr, 2026</span>
                                    </div>
                                    <div class="exam-date-row highlighted">
                                        <span class="exam-date-label">Exam Date</span>
                                        <span class="exam-date-value">2 Apr, 2026 to 20 Apr, 2026</span>
                                    </div>
                                    <div class="exam-date-row">
                                        <span class="exam-date-label">Registration</span>
                                        <span class="exam-date-value">12 Mar, 2026 to 13 Mar, 2028</span>
                                    </div>
                                </div>

                                <div class="exam-card-actions">
                                    <button class="btn-exam-details"> <i class="fa-regular fa-eye"></i>View Details</button>
                                    <button class="btn-exam-apply">Apply Now <i class="fa-solid fa-chevron-right" style="font-size:9px;"></i></button>
                                </div>

                                <div class="exam-card-links-grid">
                                    <a href="#" class="exam-pill-link">Admit Card</a>
                                    <a href="#" class="exam-pill-link">Analysis</a>
                                    <a href="#" class="exam-pill-link">Answer Key</a>
                                    <a href="#" class="exam-pill-link span-2">Application-form-correction</a>
                                    <a href="#" class="exam-pill-link span-1">Application Process</a>
                                    <a href="#" class="exam-pill-link span-2">Application-form-correction</a>
                                    <a href="#" class="exam-pill-link span-1">Books</a>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="exam-card">
                                
                                <div class="exam-card-logo">
                                    <!-- Green check icon badge -->
                                     <img src="assets/images/gate-logo.png" alt="">
                                </div>
                                <h3 class="exam-card-title">GATE - (Graduate Aptitude Test in Engineering)</h3>
                                <p class="exam-card-meta">UG &bull; <span class="conducting-body">National Testing Agency (NTA)</span> &bull; <span style="color: #F9AD0B;">Engineering</span></p>
                                
                                <div class="exam-card-dates-box">
                                    <div class="exam-date-row">
                                        <span class="exam-date-label">Results</span>
                                        <span class="exam-date-value">20 Apr, 2026 to 20 Apr, 2026</span>
                                    </div>
                                    <div class="exam-date-row highlighted">
                                        <span class="exam-date-label">Exam Date</span>
                                        <span class="exam-date-value">2 Apr, 2026 to 20 Apr, 2026</span>
                                    </div>
                                    <div class="exam-date-row">
                                        <span class="exam-date-label">Registration</span>
                                        <span class="exam-date-value">12 Mar, 2026 to 13 Mar, 2028</span>
                                    </div>
                                </div>

                                <div class="exam-card-actions">
                                    <button class="btn-exam-details"> <i class="fa-regular fa-eye"></i>View Details</button>
                                    <button class="btn-exam-apply">Apply Now <i class="fa-solid fa-chevron-right" style="font-size:9px;"></i></button>
                                </div>

                                <div class="exam-card-links-grid">
                                    <a href="#" class="exam-pill-link">Admit Card</a>
                                    <a href="#" class="exam-pill-link">Analysis</a>
                                    <a href="#" class="exam-pill-link">Answer Key</a>
                                    <a href="#" class="exam-pill-link span-2">Application-form-correction</a>
                                    <a href="#" class="exam-pill-link span-1">Application Process</a>
                                    <a href="#" class="exam-pill-link span-2">Application-form-correction</a>
                                    <a href="#" class="exam-pill-link span-1">Books</a>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="exam-card">
                                <span class="exam-card-mode-badge">Online</span>
                                <div class="exam-card-logo">
                                    <img src="assets/images/jee-main-logo.png" alt="">
                                </div>
                                <h3 class="exam-card-title">JEE Main - (Joint Entrance Examination Main)</h3>
                                <p class="exam-card-meta">UG &bull; <span class="conducting-body">National Testing Agency (NTA)</span> &bull; <span style="color: #F9AD0B;">Engineering</span></p>
                                
                                <div class="exam-card-dates-box">
                                    <div class="exam-date-row">
                                        <span class="exam-date-label">Results</span>
                                        <span class="exam-date-value">20 Apr, 2026 to 20 Apr, 2026</span>
                                    </div>
                                    <div class="exam-date-row highlighted">
                                        <span class="exam-date-label">Exam Date</span>
                                        <span class="exam-date-value">2 Apr, 2026 to 20 Apr, 2026</span>
                                    </div>
                                    <div class="exam-date-row">
                                        <span class="exam-date-label">Registration</span>
                                        <span class="exam-date-value">12 Mar, 2026 to 13 Mar, 2028</span>
                                    </div>
                                </div>

                                <div class="exam-card-actions">
                                    <button class="btn-exam-details"> <i class="fa-regular fa-eye"></i>View Details</button>
                                    <button class="btn-exam-apply">Apply Now <i class="fa-solid fa-chevron-right" style="font-size:9px;"></i></button>
                                </div>

                                <div class="exam-card-links-grid">
                                    <a href="#" class="exam-pill-link">Admit Card</a>
                                    <a href="#" class="exam-pill-link">Analysis</a>
                                    <a href="#" class="exam-pill-link">Answer Key</a>
                                    <a href="#" class="exam-pill-link span-2">Application-form-correction</a>
                                    <a href="#" class="exam-pill-link span-1">Application Process</a>
                                    <a href="#" class="exam-pill-link span-2">Application-form-correction</a>
                                    <a href="#" class="exam-pill-link span-1">Books</a>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="exam-card">
                                <span class="exam-card-mode-badge">Online</span>
                                <div class="exam-card-logo">
                                    <!-- Green check icon badge -->
                                     <img src="assets/images/gate-logo.png" alt="">
                                </div>
                                <h3 class="exam-card-title">GATE - (Graduate Aptitude Test in Engineering)</h3>
                                <p class="exam-card-meta">UG &bull; <span class="conducting-body">National Testing Agency (NTA)</span> &bull; <span style="color: #F9AD0B;">Engineering</span></p>
                                
                                <div class="exam-card-dates-box">
                                    <div class="exam-date-row">
                                        <span class="exam-date-label">Results</span>
                                        <span class="exam-date-value">20 Apr, 2026 to 20 Apr, 2026</span>
                                    </div>
                                    <div class="exam-date-row highlighted">
                                        <span class="exam-date-label">Exam Date</span>
                                        <span class="exam-date-value">2 Apr, 2026 to 20 Apr, 2026</span>
                                    </div>
                                    <div class="exam-date-row">
                                        <span class="exam-date-label">Registration</span>
                                        <span class="exam-date-value">12 Mar, 2026 to 13 Mar, 2028</span>
                                    </div>
                                </div>

                                <div class="exam-card-actions">
                                    <button class="btn-exam-details"> <i class="fa-regular fa-eye"></i>View Details</button>
                                    <button class="btn-exam-apply">Apply Now <i class="fa-solid fa-chevron-right" style="font-size:9px;"></i></button>
                                </div>

                                <div class="exam-card-links-grid">
                                    <a href="#" class="exam-pill-link">Admit Card</a>
                                    <a href="#" class="exam-pill-link">Analysis</a>
                                    <a href="#" class="exam-pill-link">Answer Key</a>
                                    <a href="#" class="exam-pill-link span-2">Application-form-correction</a>
                                    <a href="#" class="exam-pill-link span-1">Application Process</a>
                                    <a href="#" class="exam-pill-link span-2">Application-form-correction</a>
                                    <a href="#" class="exam-pill-link span-1">Books</a>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="exam-card">
                                <span class="exam-card-mode-badge">Online</span>
                                <div class="exam-card-logo">
                                    <img src="assets/images/jee-main-logo.png" alt="">
                                </div>
                                <h3 class="exam-card-title">JEE Main - (Joint Entrance Examination Main)</h3>
                                <p class="exam-card-meta">UG &bull; <span class="conducting-body">National Testing Agency (NTA)</span> &bull; <span style="color: #F9AD0B;">Engineering</span></p>
                                
                                <div class="exam-card-dates-box">
                                    <div class="exam-date-row">
                                        <span class="exam-date-label">Results</span>
                                        <span class="exam-date-value">20 Apr, 2026 to 20 Apr, 2026</span>
                                    </div>
                                    <div class="exam-date-row highlighted">
                                        <span class="exam-date-label">Exam Date</span>
                                        <span class="exam-date-value">2 Apr, 2026 to 20 Apr, 2026</span>
                                    </div>
                                    <div class="exam-date-row">
                                        <span class="exam-date-label">Registration</span>
                                        <span class="exam-date-value">12 Mar, 2026 to 13 Mar, 2028</span>
                                    </div>
                                </div>

                                <div class="exam-card-actions">
                                    <button class="btn-exam-details"> <i class="fa-regular fa-eye"></i>View Details</button>
                                    <button class="btn-exam-apply">Apply Now <i class="fa-solid fa-chevron-right" style="font-size:9px;"></i></button>
                                </div>

                                <div class="exam-card-links-grid">
                                    <a href="#" class="exam-pill-link">Admit Card</a>
                                    <a href="#" class="exam-pill-link">Analysis</a>
                                    <a href="#" class="exam-pill-link">Answer Key</a>
                                    <a href="#" class="exam-pill-link span-2">Application-form-correction</a>
                                    <a href="#" class="exam-pill-link span-1">Application Process</a>
                                    <a href="#" class="exam-pill-link span-2">Application-form-correction</a>
                                    <a href="#" class="exam-pill-link span-1">Books</a>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="exam-card">
                                <span class="exam-card-mode-badge">Online</span>
                                <div class="exam-card-logo">
                                    <!-- Green check icon badge -->
                                     <img src="assets/images/gate-logo.png" alt="">
                                </div>
                                <h3 class="exam-card-title">GATE - (Graduate Aptitude Test in Engineering)</h3>
                                <p class="exam-card-meta">UG &bull; <span class="conducting-body">National Testing Agency (NTA)</span> &bull; <span style="color: #F9AD0B;">Engineering</span></p>
                                
                                <div class="exam-card-dates-box">
                                    <div class="exam-date-row">
                                        <span class="exam-date-label">Results</span>
                                        <span class="exam-date-value">20 Apr, 2026 to 20 Apr, 2026</span>
                                    </div>
                                    <div class="exam-date-row highlighted">
                                        <span class="exam-date-label">Exam Date</span>
                                        <span class="exam-date-value">2 Apr, 2026 to 20 Apr, 2026</span>
                                    </div>
                                    <div class="exam-date-row">
                                        <span class="exam-date-label">Registration</span>
                                        <span class="exam-date-value">12 Mar, 2026 to 13 Mar, 2028</span>
                                    </div>
                                </div>

                                <div class="exam-card-actions">
                                    <button class="btn-exam-details"> <i class="fa-regular fa-eye"></i>View Details</button>
                                    <button class="btn-exam-apply">Apply Now <i class="fa-solid fa-chevron-right" style="font-size:9px;"></i></button>
                                </div>

                                <div class="exam-card-links-grid">
                                    <a href="#" class="exam-pill-link">Admit Card</a>
                                    <a href="#" class="exam-pill-link">Analysis</a>
                                    <a href="#" class="exam-pill-link">Answer Key</a>
                                    <a href="#" class="exam-pill-link span-2">Application-form-correction</a>
                                    <a href="#" class="exam-pill-link span-1">Application Process</a>
                                    <a href="#" class="exam-pill-link span-2">Application-form-correction</a>
                                    <a href="#" class="exam-pill-link span-1">Books</a>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="exam-card">
                                <span class="exam-card-mode-badge">Online</span>
                                <div class="exam-card-logo">
                                    <img src="assets/images/jee-main-logo.png" alt="">
                                </div>
                                <h3 class="exam-card-title">JEE Main - (Joint Entrance Examination Main)</h3>
                                <p class="exam-card-meta">UG &bull; <span class="conducting-body">National Testing Agency (NTA)</span> &bull; <span style="color: #F9AD0B;">Engineering</span></p>
                                
                                <div class="exam-card-dates-box">
                                    <div class="exam-date-row">
                                        <span class="exam-date-label">Results</span>
                                        <span class="exam-date-value">20 Apr, 2026 to 20 Apr, 2026</span>
                                    </div>
                                    <div class="exam-date-row highlighted">
                                        <span class="exam-date-label">Exam Date</span>
                                        <span class="exam-date-value">2 Apr, 2026 to 20 Apr, 2026</span>
                                    </div>
                                    <div class="exam-date-row">
                                        <span class="exam-date-label">Registration</span>
                                        <span class="exam-date-value">12 Mar, 2026 to 13 Mar, 2028</span>
                                    </div>
                                </div>

                                <div class="exam-card-actions">
                                    <button class="btn-exam-details"> <i class="fa-regular fa-eye"></i>View Details</button>
                                    <button class="btn-exam-apply">Apply Now <i class="fa-solid fa-chevron-right" style="font-size:9px;"></i></button>
                                </div>

                                <div class="exam-card-links-grid">
                                    <a href="#" class="exam-pill-link">Admit Card</a>
                                    <a href="#" class="exam-pill-link">Analysis</a>
                                    <a href="#" class="exam-pill-link">Answer Key</a>
                                    <a href="#" class="exam-pill-link span-2">Application-form-correction</a>
                                    <a href="#" class="exam-pill-link span-1">Application Process</a>
                                    <a href="#" class="exam-pill-link span-2">Application-form-correction</a>
                                    <a href="#" class="exam-pill-link span-1">Books</a>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="exam-card">
                                <span class="exam-card-mode-badge">Online</span>
                                <div class="exam-card-logo">
                                    <!-- Green check icon badge -->
                                     <img src="assets/images/gate-logo.png" alt="">
                                </div>
                                <h3 class="exam-card-title">GATE - (Graduate Aptitude Test in Engineering)</h3>
                                <p class="exam-card-meta">UG &bull; <span class="conducting-body">National Testing Agency (NTA)</span> &bull; <span style="color: #F9AD0B;">Engineering</span></p>
                                
                                <div class="exam-card-dates-box">
                                    <div class="exam-date-row">
                                        <span class="exam-date-label">Results</span>
                                        <span class="exam-date-value">20 Apr, 2026 to 20 Apr, 2026</span>
                                    </div>
                                    <div class="exam-date-row highlighted">
                                        <span class="exam-date-label">Exam Date</span>
                                        <span class="exam-date-value">2 Apr, 2026 to 20 Apr, 2026</span>
                                    </div>
                                    <div class="exam-date-row">
                                        <span class="exam-date-label">Registration</span>
                                        <span class="exam-date-value">12 Mar, 2026 to 13 Mar, 2028</span>
                                    </div>
                                </div>

                                <div class="exam-card-actions">
                                    <button class="btn-exam-details"> <i class="fa-regular fa-eye"></i>View Details</button>
                                    <button class="btn-exam-apply">Apply Now <i class="fa-solid fa-chevron-right" style="font-size:9px;"></i></button>
                                </div>

                                <div class="exam-card-links-grid">
                                    <a href="#" class="exam-pill-link">Admit Card</a>
                                    <a href="#" class="exam-pill-link">Analysis</a>
                                    <a href="#" class="exam-pill-link">Answer Key</a>
                                    <a href="#" class="exam-pill-link span-2">Application-form-correction</a>
                                    <a href="#" class="exam-pill-link span-1">Application Process</a>
                                    <a href="#" class="exam-pill-link span-2">Application-form-correction</a>
                                    <a href="#" class="exam-pill-link span-1">Books</a>
                                </div>
                            </div>
                        </div>


                    </div>

                    <!-- Pagination -->
                    <div class="inner-pagination-wrapper">
              <nav aria-label="Catalog Page Navigation">
                <ul class="pagination">
                  <li class="page-item me-4">
                    <a class="page-link" href="#">Prev</a>
                  </li>
                  <li class="page-item active">
                    <a class="page-num active" href="#">1</a>
                  </li>
                  <li class="page-item"><a class="page-num" href="#">2</a></li>
                  <li class="page-item"><a class="page-num" href="#">3</a></li>
                  <li class="page-item"><a class="page-num" href="#">4</a></li>
                  <li class="page-item"><a class="page-num" href="#">5</a></li>
                  <li class="page-item">
                    <a class="page-num" href="#">6...</a>
                  </li>
                  <li class="page-item ms-4">
                    <a class="page-link " style="background-color: #3771C8;color: #fff;" href="#">Next</a>
                  </li>
                </ul>
              </nav>
            </div>

                </div>
            </div>
        </div>
    </section>

    <!-- Curved Footer Section -->

   

    <!-- Curved Footer Section -->
@endsection
