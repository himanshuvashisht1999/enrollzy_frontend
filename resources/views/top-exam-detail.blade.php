@extends('layouts.app')

@section('content')
<main class="about-hero-section ptb-70">
      <div class="bg-square">
        <img src="assets/images/banner-square-img.svg" alt="" />
      </div>
      <div class="container">
        <div class="about-hero-container">
          <img src="{{ $exam->cover_image ? env('BACKEND_URL') . '/' . $exam->cover_image : asset('assets/images/top-exam-img.png') }}" alt="{{ $exam->name }}" style="width:100%; object-fit:cover;" />

          <!-- Centered Badge (Placed outside card to prevent clipping) -->
          <div class="about-us-badge-wrapper">
            <button class="about-us-badge">{{ $exam->name }}</button>
            <p>{{ Str::limit(strip_tags($exam->about_exam), 100) }}</p>
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

    <!-- Breadcrumb path -->
    <div class="py-3" style="background-color: #f9ad0b14">
      <div class="container">
        <nav aria-label="breadcrumb">
          <ol
            class="breadcrumb mb-0"
            style="font-size: 13.5px; font-weight: 500"
          >
            <li class="breadcrumb-item">
              <a href="#" class="text-decoration-none text-muted"
                ><i class="fa-solid fa-house me-1"></i> Home</a
              >
            </li>
            <li class="breadcrumb-item active text-primary">
              <a
                href="top-exams.html"
                class="text-decoration-none active text-primary"
                >JEE Main</a
              >
            </li>
            <li class="breadcrumb-item active text-primary" aria-current="page">
              Info
            </li>
          </ol>
        </nav>
      </div>
    </div>

    <!-- Main Detail Page Section -->
    <section class="py-5" style="background-color: #fafbfd">
      <div class="container">
        <!-- Orange Announcement Banner -->
        <div class="exam-detail-banner">
          <div class="exam-detail-banner-content">
            <div class="exam-detail-banner-logo">
              <img src="{{ $exam->logo ? env('BACKEND_URL') . '/' . $exam->logo : asset('assets/images/top-exam-icon-1.png') }}" alt="{{ $exam->name }}" />
            </div>
            <span
              >JEE Main 2026 Session 2: Paper 2 Result (Out), Cutoff, JoSAA
              Counselling</span
            >
          </div>
          <div class="exam-detail-banner-actions">
            <a href="tel:1800-xxx-xxxx" class="btn-banner-counselling">
              <i class="fa-solid fa-phone"></i> Free Counselling
            </a>
            <a href="#" class="btn-banner-mockup">
              Get Free Mockup Test
              <i class="fa-solid fa-chevron-right" style="font-size: 9px"></i>
            </a>
          </div>
        </div>
      </div>
    </section>

    <section style="background-color: #3771c812">
      <div class="container">
        <!-- Slider Tabs -->
        <div class="exam-detail-tabs-bar" id="examDetailTabs">
          <button class="exam-detail-tab-btn active">Info</button>
          <button class="exam-detail-tab-btn">Answer Key</button>
          <button class="exam-detail-tab-btn">Result</button>
          <button class="exam-detail-tab-btn">Cutoff</button>
          <button class="exam-detail-tab-btn">College Predictor</button>
          <button class="exam-detail-tab-btn">Rank Predictor</button>
          <button class="exam-detail-tab-btn">Counselling</button>
          <button class="exam-detail-tab-btn">Analysis</button>
          <button class="exam-detail-tab-btn">Admit Card</button>
          <button class="exam-detail-tab-btn">Dates</button>
          <button class="exam-detail-tab-btn">Intimation</button>
        </div>
      </div>
    </section>
    <section class="py-5">
      <div class="container">
        <!-- Main grid -->
        <div class="row g-4">
          <!-- Left Sidebar Column -->
          <div class="col-lg-4 col-md-5">
            <!-- Upcoming Exams Widget -->
            <div class="detail-sidebar-card">
              <h4 class="detail-sidebar-card-title">Upcoming Exams</h4>
              <div class="upcoming-exams-list">
                <!-- Item 1 -->
                <a href="#" class="upcoming-exam-item">
                  <div class="upcoming-exam-logo">
                    <img src="assets/images/gate-logo.png" alt="" />
                  </div>
                  <div class="upcoming-exam-info">
                    <span class="upcoming-exam-name">Haryana LEET</span>
                    <span class="upcoming-exam-date"
                      ><i class="fa-regular fa-calendar me-1"></i> 8 jul,
                      2026-11 jul, 2026</span
                    >
                  </div>
                </a>
                <!-- Item 2 -->
                <a href="#" class="upcoming-exam-item">
                  <div class="upcoming-exam-logo">
                    <img src="assets/images/gate-logo.png" alt="" />
                  </div>
                  <div class="upcoming-exam-info">
                    <span class="upcoming-exam-name">Haryana LEET</span>
                    <span class="upcoming-exam-date"
                      ><i class="fa-regular fa-calendar me-1"></i> 8 jul,
                      2026-11 jul, 2026</span
                    >
                  </div>
                </a>
                <!-- Item 3 -->
                <a href="#" class="upcoming-exam-item">
                  <div class="upcoming-exam-logo">
                    <img src="assets/images/gate-logo.png" alt="" />
                  </div>
                  <div class="upcoming-exam-info">
                    <span class="upcoming-exam-name">Haryana LEET</span>
                    <span class="upcoming-exam-date"
                      ><i class="fa-regular fa-calendar me-1"></i> 8 jul,
                      2026-11 jul, 2026</span
                    >
                  </div>
                </a>
                <!-- Item 4 -->
                <a href="#" class="upcoming-exam-item">
                  <div class="upcoming-exam-logo">
                    <img src="assets/images/gate-logo.png" alt="" />
                  </div>
                  <div class="upcoming-exam-info">
                    <span class="upcoming-exam-name">Haryana LEET</span>
                    <span class="upcoming-exam-date"
                      ><i class="fa-regular fa-calendar me-1"></i> 8 jul,
                      2026-11 jul, 2026</span
                    >
                  </div>
                </a>
                <!-- Item 5 -->
                <a href="#" class="upcoming-exam-item">
                  <div class="upcoming-exam-logo">
                    <img src="assets/images/gate-logo.png" alt="" />
                  </div>
                  <div class="upcoming-exam-info">
                    <span class="upcoming-exam-name">Haryana LEET</span>
                    <span class="upcoming-exam-date"
                      ><i class="fa-regular fa-calendar me-1"></i> 8 jul,
                      2026-11 jul, 2026</span
                    >
                  </div>
                </a>
                <!-- Item 6 -->
                <a href="#" class="upcoming-exam-item">
                  <div class="upcoming-exam-logo">
                    <img src="assets/images/gate-logo.png" alt="" />
                  </div>
                  <div class="upcoming-exam-info">
                    <span class="upcoming-exam-name">Haryana LEET</span>
                    <span class="upcoming-exam-date"
                      ><i class="fa-regular fa-calendar me-1"></i> 8 jul,
                      2026-11 jul, 2026</span
                    >
                  </div>
                </a>
              </div>
            </div>

            <!-- News & Updates Widget -->
            <div class="detail-sidebar-card">
              <h4 class="detail-sidebar-card-title">News & Updates</h4>
              <div class="news-sidebar-list">
                <!-- Item 1 -->
                <a href="#" class="news-sidebar-item">
                  <h5 class="news-sidebar-title">
                    JEE Main Counselling 2026: JoSAA Dates, Registration, Seat
                    Allotment & Process
                  </h5>
                  <div class="news-sidebar-meta">
                    <span
                      ><i class="fa-regular fa-calendar me-1"></i> 8 jul,
                      2026-11 jul, 2026</span
                    >
                    <span class="author">Pershant Kumar</span>
                  </div>
                </a>
                <!-- Item 2 -->
                <a href="#" class="news-sidebar-item">
                  <h5 class="news-sidebar-title">
                    JEE Main Counselling 2026: JoSAA Dates, Registration, Seat
                    Allotment & Process
                  </h5>
                  <div class="news-sidebar-meta">
                    <span
                      ><i class="fa-regular fa-calendar me-1"></i> 8 jul,
                      2026-11 jul, 2026</span
                    >
                    <span class="author">Pershant Kumar</span>
                  </div>
                </a>
                <!-- Item 3 -->
                <a href="#" class="news-sidebar-item">
                  <h5 class="news-sidebar-title">
                    JEE Main Counselling 2026: JoSAA Dates, Registration, Seat
                    Allotment & Process
                  </h5>
                  <div class="news-sidebar-meta">
                    <span
                      ><i class="fa-regular fa-calendar me-1"></i> 8 jul,
                      2026-11 jul, 2026</span
                    >
                    <span class="author">Pershant Kumar</span>
                  </div>
                </a>
                <!-- Item 4 -->
                <a href="#" class="news-sidebar-item">
                  <h5 class="news-sidebar-title">
                    JEE Main Counselling 2026: JoSAA Dates, Registration, Seat
                    Allotment & Process
                  </h5>
                  <div class="news-sidebar-meta">
                    <span
                      ><i class="fa-regular fa-calendar me-1"></i> 8 jul,
                      2026-11 jul, 2026</span
                    >
                    <span class="author">Pershant Kumar</span>
                  </div>
                </a>
                <!-- Item 5 -->
                <a href="#" class="news-sidebar-item">
                  <h5 class="news-sidebar-title">
                    JEE Main Counselling 2026: JoSAA Dates, Registration, Seat
                    Allotment & Process
                  </h5>
                  <div class="news-sidebar-meta">
                    <span
                      ><i class="fa-regular fa-calendar me-1"></i> 8 jul,
                      2026-11 jul, 2026</span
                    >
                    <span class="author">Pershant Kumar</span>
                  </div>
                </a>
              </div>
            </div>

            <!-- Previous Year Papers Widget -->
            <div class="detail-sidebar-card">
              <h4 class="detail-sidebar-card-title">Previous Year Papers</h4>
              <div class="papers-sidebar-list">
                <!-- Item 1 -->
                <div class="paper-sidebar-item">
                  <h5 class="paper-sidebar-title">
                    JEE MAIN All Subject 28th Jan 2025 Shift 2 Sample Paper with
                    Solutions
                  </h5>
                  <a href="#" class="btn-paper-download">Downloads</a>
                </div>
                <!-- Item 2 -->
                <div class="paper-sidebar-item">
                  <h5 class="paper-sidebar-title">
                    JEE MAIN All Subject 28th Jan 2025 Shift 2 Sample Paper with
                    Solutions
                  </h5>
                  <a href="#" class="btn-paper-download">Downloads</a>
                </div>
                <!-- Item 3 -->
                <div class="paper-sidebar-item">
                  <h5 class="paper-sidebar-title">
                    JEE MAIN All Subject 28th Jan 2025 Shift 2 Sample Paper with
                    Solutions
                  </h5>
                  <a href="#" class="btn-paper-download">Downloads</a>
                </div>
                <!-- Item 4 -->
                <div class="paper-sidebar-item">
                  <h5 class="paper-sidebar-title">
                    JEE MAIN All Subject 28th Jan 2025 Shift 2 Sample Paper with
                    Solutions
                  </h5>
                  <a href="#" class="btn-paper-download">Downloads</a>
                </div>
                <!-- Item 5 -->
                <div class="paper-sidebar-item">
                  <h5 class="paper-sidebar-title">
                    JEE MAIN All Subject 28th Jan 2025 Shift 2 Sample Paper with
                    Solutions
                  </h5>
                  <a href="#" class="btn-paper-download">Downloads</a>
                </div>
              </div>
            </div>
          </div>

          <!-- Right Main Column -->
          <div class="col-lg-8 col-md-7">
            <!-- Related JEE Main Links Card -->
            <div class="related-links-card">
              <h3 class="related-links-title">Related JEE Main Links</h3>

              <div class="links-accordion-group">
                <!-- Accordion 1 (Expanded) -->
                <div class="links-accordion-item">
                  <div
                    class="links-accordion-header"
                    data-bs-toggle="collapse"
                    data-bs-target="#paperLinksBody"
                    aria-expanded="true"
                  >
                    <div class="links-accordion-header-left">
                      <i class="fa-regular fa-file-lines"></i>
                      <div style="display: flex; flex-direction: column">
                        <span class="links-accordion-label"
                          >Question Paper Links by Year</span
                        >
                        <span class="links-accordion-count">12 links</span>
                      </div>
                    </div>
                    <i class="fa-solid fa-chevron-down"></i>
                  </div>
                  <div class="collapse show" id="paperLinksBody">
                    <div class="links-accordion-body">
                      <div class="accordion-link-pills">
                        <a href="#" class="accordion-link-pill"
                          >JEE Mains Question Papers 2026
                          <i
                            class="fa-solid fa-arrow-up-right-from-square"
                            style="font-size: 10px"
                          ></i
                        ></a>
                        <a href="#" class="accordion-link-pill"
                          >JEE Mains Question Papers 2025
                          <i
                            class="fa-solid fa-arrow-up-right-from-square"
                            style="font-size: 10px"
                          ></i
                        ></a>
                        <a href="#" class="accordion-link-pill"
                          >JEE Mains Question Papers 2024
                          <i
                            class="fa-solid fa-arrow-up-right-from-square"
                            style="font-size: 10px"
                          ></i
                        ></a>
                      </div>
                      <div class="text-center">
                        <button
                          class="btn btn-primary btn-sm px-4 fw-bold rounded-pill"
                          style="
                            background-color: #3771c8;
                            border: none;
                            font-size: 14px;
                            height: 32px;
                          "
                        >
                          View more
                          <i
                            class="fa-solid fa-chevron-right ms-1"
                            style="font-size: 9px"
                          ></i>
                        </button>
                      </div>
                    </div>
                  </div>
                </div>

                <!-- Accordion 2 (Collapsed) -->
                <div class="links-accordion-item">
                  <div
                    class="links-accordion-header collapsed"
                    data-bs-toggle="collapse"
                    data-bs-target="#cutoffLinksBody"
                    aria-expanded="false"
                  >
                    <div class="links-accordion-header-left">
                      <i class="fa-regular fa-file-lines"></i>
                      <div style="display: flex; flex-direction: column">
                        <span class="links-accordion-label"
                          >Cutoff Links by Year</span
                        >
                        <span class="links-accordion-count">7 links</span>
                      </div>
                    </div>
                    <i class="fa-solid fa-chevron-down"></i>
                  </div>
                  <div class="collapse" id="cutoffLinksBody">
                    <div class="links-accordion-body">
                      <div class="accordion-link-pills">
                        <a href="#" class="accordion-link-pill"
                          >JEE Mains Cutoff 2026
                          <i
                            class="fa-solid fa-arrow-up-right-from-square"
                            style="font-size: 10px"
                          ></i
                        ></a>
                        <a href="#" class="accordion-link-pill"
                          >JEE Mains Cutoff 2025
                          <i
                            class="fa-solid fa-arrow-up-right-from-square"
                            style="font-size: 10px"
                          ></i
                        ></a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Trending Education News & Insights Card -->
            <div class="related-links-card">
              <h3 class="related-links-title">
                Trending Education News & Insights
              </h3>

              <div class="trending-news-list">
                <!-- News 1 -->
                <a href="#" class="trending-news-item">
                  <div class="trending-news-thumb">
                    <img src="assets/images/trending-edu-img-1.png" alt="" />
                  </div>
                  <div class="trending-news-content">
                    <h4 class="trending-news-headline">
                      NEET, JEE Admissions May Include 50% Board Exam <br />
                      Weightage Proposal
                    </h4>
                    <div class="trending-news-meta">
                      <span class="author fw-bold me-3">Pershant Kumar</span>
                      <span
                        ><i class="fa-regular fa-calendar me-1"></i> 8 jul,
                        2026-11 jul, 2026</span
                      >
                    </div>
                  </div>
                </a>
                <!-- News 2 -->
                <a href="#" class="trending-news-item">
                  <div class="trending-news-thumb">
                    <img src="assets/images/trending-edu-img-2.png" alt="" />
                  </div>
                  <div class="trending-news-content">
                    <h4 class="trending-news-headline">
                      NEET, JEE Admissions May Include 50% Board Exam <br />
                      Weightage Proposal
                    </h4>
                    <div class="trending-news-meta">
                      <span class="author fw-bold me-3">Pershant Kumar</span>
                      <span
                        ><i class="fa-regular fa-calendar me-1"></i> 8 jul,
                        2026-11 jul, 2026</span
                      >
                    </div>
                  </div>
                </a>
                <!-- News 3 -->
                <a href="#" class="trending-news-item">
                  <div class="trending-news-thumb">
                    <img src="assets/images/trending-edu-img-3.png" alt="" />
                  </div>
                  <div class="trending-news-content">
                    <h4 class="trending-news-headline">
                      NEET, JEE Admissions May Include 50% Board Exam
                      <br />Weightage Proposal
                    </h4>
                    <div class="trending-news-meta">
                      <span class="author fw-bold me-3">Pershant Kumar</span>
                      <span
                        ><i class="fa-regular fa-calendar me-1"></i> 8 jul,
                        2026-11 jul, 2026</span
                      >
                    </div>
                  </div>
                </a>
              </div>

              <div class="text-center mb-4">
                <a
                  href="#"
                  class="btn btn-primary fw-bold rounded-pill px-4"
                  style="
                    background-color: #3771c8;
                    border: none;
                    font-size: 13px;
                    height: 38px;
                    display: inline-flex;
                    align-items: center;
                    justify-content: center;
                    gap: 8px;
                  "
                >
                  View All News & Updates
                  <i
                    class="fa-solid fa-chevron-right"
                    style="font-size: 9px"
                  ></i>
                </a>
              </div>

              <!-- Vinay Singh Update Timestamp Line -->
            </div>
            <div
              class="pt-1 d-flex justify-content-between align-items-center"
              style="font-size: 13px; font-weight: 600; color: #718096"
            >
              <span
                >Updated on <span class="text-primary">5 May, 2026</span> by
                Vinay Singh</span
              >
            </div>

            <!-- What's New Yellow Card Section -->
            <div class="whats-new-yellow-card">
              <h3 class="whats-new-title">What's new?</h3>
              <div class="yellow-content-card">
                <p
                  class="fw-bold mb-2"
                  style="font-size: 13.5px; color: #0d1b2a"
                >
                  JEE Main Latest news and articles
                </p>

                <div class="whats-new-slider-container">
                  <!-- News card 1 -->
                  <div class="whats-new-news-card">
                    <h4 class="whats-new-card-title">
                      NEET, JEE Admissions May Include 50% Board Exam Weightage
                      Proposal
                    </h4>
                    <div class="whats-new-card-footer">
                      <span
                        ><i class="fa-regular fa-calendar me-1"></i> 25 Jun,
                        2026</span
                      >
                      <a href="#" class="fw-bold">Read more..</a>
                    </div>
                  </div>
                  <!-- News card 2 -->
                  <div class="whats-new-news-card">
                    <h4 class="whats-new-card-title">
                      NEET, JEE Admissions May Include 50% Board Exam Weightage
                      Proposal
                    </h4>
                    <div class="whats-new-card-footer">
                      <span
                        ><i class="fa-regular fa-calendar me-1"></i> 25 Jun,
                        2026</span
                      >
                      <a href="#" class="fw-bold">Read more..</a>
                    </div>
                  </div>
                  <!-- News card 3 -->
                  <div class="whats-new-news-card">
                    <h4 class="whats-new-card-title">
                      NEET, JEE Admissions May Include 50% Board Exam Weightage
                      Proposal
                    </h4>
                    <div class="whats-new-card-footer">
                      <span
                        ><i class="fa-regular fa-calendar me-1"></i> 25 Jun,
                        2026</span
                      >
                      <a href="#" class="fw-bold">Read more..</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Circle Avatar Cards Carousel -->
            <div class="circle-carousel-wrapper">
              <!-- Navigation Arrows -->
              <div class="carousel-nav-btn prev" id="circlePrevBtn">
                <i class="fa-solid fa-chevron-left"></i>
              </div>
              <div class="carousel-nav-btn next" id="circleNextBtn">
                <i class="fa-solid fa-chevron-right"></i>
              </div>

              <div class="circle-card-slider" id="circleCardSlider">
                <!-- Circle card 1 -->
                <div class="circle-carousel-item">
                  <div class="circle-carousel-avatar">
                    <img src="assets/images/training-course-img.png" alt="" />
                  </div>
                  <div class="d-flex justify-content-between">
                    <div class="circle-carousel-date-label">Exam Date</div>
                    <div class="circle-carousel-date-value">10 jul, 2026</div>
                  </div>
                  <a href="#" class="btn-circle-carousel-info"
                    >Exam Info
                    <i
                      class="fa-solid fa-chevron-right"
                      style="font-size: 8px"
                    ></i
                  ></a>
                </div>
                <div class="circle-carousel-item">
                  <div class="circle-carousel-avatar">
                    <img src="assets/images/training-course-img.png" alt="" />
                  </div>
                  <div class="d-flex justify-content-between">
                    <div class="circle-carousel-date-label">Exam Date</div>
                    <div class="circle-carousel-date-value">10 jul, 2026</div>
                  </div>
                  <a href="#" class="btn-circle-carousel-info"
                    >Exam Info
                    <i
                      class="fa-solid fa-chevron-right"
                      style="font-size: 8px"
                    ></i
                  ></a>
                </div>
                <div class="circle-carousel-item">
                  <div class="circle-carousel-avatar">
                    <img src="assets/images/training-course-img.png" alt="" />
                  </div>
                  <div class="d-flex justify-content-between">
                    <div class="circle-carousel-date-label">Exam Date</div>
                    <div class="circle-carousel-date-value">10 jul, 2026</div>
                  </div>
                  <a href="#" class="btn-circle-carousel-info"
                    >Exam Info
                    <i
                      class="fa-solid fa-chevron-right"
                      style="font-size: 8px"
                    ></i
                  ></a>
                </div>
                <div class="circle-carousel-item">
                  <div class="circle-carousel-avatar">
                    <img src="assets/images/training-course-img.png" alt="" />
                  </div>
                  <div class="d-flex justify-content-between">
                    <div class="circle-carousel-date-label">Exam Date</div>
                    <div class="circle-carousel-date-value">10 jul, 2026</div>
                  </div>
                  <a href="#" class="btn-circle-carousel-info"
                    >Exam Info
                    <i
                      class="fa-solid fa-chevron-right"
                      style="font-size: 8px"
                    ></i
                  ></a>
                </div>
                <div class="circle-carousel-item">
                  <div class="circle-carousel-avatar">
                    <img src="assets/images/training-course-img.png" alt="" />
                  </div>
                  <div class="d-flex justify-content-between">
                    <div class="circle-carousel-date-label">Exam Date</div>
                    <div class="circle-carousel-date-value">10 jul, 2026</div>
                  </div>
                  <a href="#" class="btn-circle-carousel-info"
                    >Exam Info
                    <i
                      class="fa-solid fa-chevron-right"
                      style="font-size: 8px"
                    ></i
                  ></a>
                </div>
                <div class="circle-carousel-item">
                  <div class="circle-carousel-avatar">
                    <img src="assets/images/training-course-img.png" alt="" />
                  </div>
                  <div class="d-flex justify-content-between">
                    <div class="circle-carousel-date-label">Exam Date</div>
                    <div class="circle-carousel-date-value">10 jul, 2026</div>
                  </div>
                  <a href="#" class="btn-circle-carousel-info"
                    >Exam Info
                    <i
                      class="fa-solid fa-chevron-right"
                      style="font-size: 8px"
                    ></i
                  ></a>
                </div>
               
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Swiper Slider scripts and slider tabs scripts -->
    <script>
      document.addEventListener("DOMContentLoaded", function () {
        // Horizontal scroll support for Exam Tabs bar
        const tabSlider = document.getElementById("examDetailTabs");
        if (tabSlider) {
          let isDown = false;
          let startX;
          let scrollLeft;
          tabSlider.addEventListener("mousedown", (e) => {
            isDown = true;
            tabSlider.style.cursor = "grabbing";
            startX = e.pageX - tabSlider.offsetLeft;
            scrollLeft = tabSlider.scrollLeft;
          });
          tabSlider.addEventListener("mouseleave", () => {
            isDown = false;
            tabSlider.style.cursor = "pointer";
          });
          tabSlider.addEventListener("mouseup", () => {
            isDown = false;
            tabSlider.style.cursor = "pointer";
          });
          tabSlider.addEventListener("mousemove", (e) => {
            if (!isDown) return;
            e.preventDefault();
            const x = e.pageX - tabSlider.offsetLeft;
            const walk = (x - startX) * 2;
            tabSlider.scrollLeft = scrollLeft - walk;
          });
        }

        // Circle avatar carousel manual controls
        const circleSlider = document.getElementById("circleCardSlider");
        const prevBtn = document.getElementById("circlePrevBtn");
        const nextBtn = document.getElementById("circleNextBtn");
        if (circleSlider && prevBtn && nextBtn) {
          prevBtn.addEventListener("click", function () {
            circleSlider.scrollBy({ left: -200, behavior: "smooth" });
          });
          nextBtn.addEventListener("click", function () {
            circleSlider.scrollBy({ left: 200, behavior: "smooth" });
          });
        }
      });
    </script>

    <!-- Bootstrap Bundle JS -->
    

    <!-- Swiper Slider JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script>
      document.addEventListener("DOMContentLoaded", function () {
        // Hero Image Swiper
        const heroSwiper = new Swiper(".hero-swiper", {
          slidesPerView: 1,
          spaceBetween: 0,
          loop: true,
          autoplay: {
            delay: 4000,
            disableOnInteraction: false,
          },
          pagination: {
            el: ".carousel-dots",
            bulletClass: "dot",
            bulletActiveClass: "active",
            clickable: true,
          },
        });

        // Student Insights & Feedback Swiper
        const feedbackSwiper = new Swiper(".feedback-swiper", {
          slidesPerView: 1,
          spaceBetween: 24,
          loop: true,
          navigation: {
            nextEl: ".feedback-next-btn",
            prevEl: ".feedback-prev-btn",
          },
          breakpoints: {
            768: {
              slidesPerView: 2,
            },
            992: {
              slidesPerView: 3,
            },
          },
        });
      });
      (function () {
        const slider = document.getElementById("perfectUnivTabs");
        if (!slider) return;
        let isDown = false;
        let startX;
        let scrollLeft;
        let moved = false;

        slider.addEventListener("mousedown", (e) => {
          isDown = true;
          moved = false;
          slider.classList.add("dragging");
          startX = e.pageX - slider.offsetLeft;
          scrollLeft = slider.scrollLeft;
        });

        slider.addEventListener("mouseleave", () => {
          isDown = false;
          slider.classList.remove("dragging");
        });

        slider.addEventListener("mouseup", () => {
          isDown = false;
          slider.classList.remove("dragging");
        });

        slider.addEventListener("mousemove", (e) => {
          if (!isDown) return;
          e.preventDefault();
          const x = e.pageX - slider.offsetLeft;
          const walk = x - startX;
          if (Math.abs(walk) > 5) moved = true; // threshold so clicks still register as clicks
          slider.scrollLeft = scrollLeft - walk;
        });

        // Prevent tab click from firing right after a drag
        slider.addEventListener(
          "click",
          (e) => {
            if (moved) {
              e.preventDefault();
              e.stopPropagation();
            }
          },
          true,
        );
      })();
      (function () {
        const megaMenu = document.querySelector(".mega-menu-wrapper");
        if (!megaMenu) return;

        const triggerItems = document.querySelectorAll(
          ".nav-item[data-tab-trigger]",
        );
        let hideTimeout;

        function showMenu(tabId) {
          clearTimeout(hideTimeout);
          megaMenu.classList.add("show-mega");

          // Switch tab sidebar and content panel
          const sidebarItem = megaMenu.querySelector(
            `.mega-sidebar-item[data-mega-tab="${tabId}"]`,
          );
          if (sidebarItem) {
            // Remove active classes
            megaMenu
              .querySelectorAll(".mega-sidebar-item")
              .forEach((i) => i.classList.remove("active"));
            megaMenu
              .querySelectorAll(".mega-tab-content")
              .forEach((pane) => pane.classList.remove("active"));

            // Set active
            sidebarItem.classList.add("active");
            const targetPane = megaMenu.querySelector("#" + tabId);
            if (targetPane) {
              targetPane.classList.add("active");
            }
          }
        }

        function hideMenu() {
          hideTimeout = setTimeout(() => {
            megaMenu.classList.remove("show-mega");
          }, 150); // delay to allow moving between trigger and menu
        }

        triggerItems.forEach((item) => {
          item.addEventListener("mouseenter", function () {
            const tabId = this.getAttribute("data-tab-trigger");
            showMenu(tabId);
          });

          item.addEventListener("mouseleave", function () {
            hideMenu();
          });
        });

        megaMenu.addEventListener("mouseenter", function () {
          clearTimeout(hideTimeout);
        });

        megaMenu.addEventListener("mouseleave", function () {
          hideMenu();
        });

        // Mega Menu inner sidebar tab switching on hover
        const sidebarItems = megaMenu.querySelectorAll(".mega-sidebar-item");
        sidebarItems.forEach((item) => {
          item.addEventListener("mouseenter", function () {
            // Remove active classes inside menu
            megaMenu
              .querySelectorAll(".mega-sidebar-item")
              .forEach((i) => i.classList.remove("active"));
            megaMenu
              .querySelectorAll(".mega-tab-content")
              .forEach((pane) => pane.classList.remove("active"));

            // Set active
            this.classList.add("active");
            const targetTabId = this.getAttribute("data-mega-tab");
            const targetPane = megaMenu.querySelector("#" + targetTabId);
            if (targetPane) {
              targetPane.classList.add("active");
            }
          });
        });
      })();
    </script>
  
@endsection