@extends('layouts.app')
@section('content')
<main class="about-hero-section ptb-70">
        <div class="bg-square">
            <img src="assets/images/banner-square-img.svg" alt="" />
        </div>
        <div class="container">
            <div class="about-hero-container">
                <img src="assets/images/scholarship-page-banner-img.png" alt="" />

                <!-- Centered Badge (Placed outside card to prevent clipping) -->
                <div class="about-us-badge-wrapper">
                    <button class="about-us-badge">Scholarships & Benefits</button>
                    <p>Check out the top student benefits and programs designed for your success.</p>
                </div>

                <!-- Green Down Arrow Button -->
                <button class="about-scroll-btn" aria-label="Scroll Down">
                    <img style="width: 49px; height: 62px" src="assets/images/inner-banner-down-arror.png" alt="" />
                </button>
            </div>
        </div>
    </main>
    <!-- Breadcrumb path -->
    <div class="py-3" style="background-color: #f9ad0b14">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0" style="font-size: 13.5px; font-weight: 500;">
                    <li class="breadcrumb-item"><a href="#" class="text-decoration-none text-muted"><i class="fa-solid fa-house me-1"></i> Home</a></li>
                    <li class="breadcrumb-item active text-primary" aria-current="page">Scholarship</li>
                </ol>
            </nav>
        </div>
    </div>

    <!-- Main Content Grid -->
    <div style="background-color: #FAFBFD; padding: 45px 0;">
        <div class="container">

            <!-- Filter Panel Box -->
            <div class="sb-filter-card">
                <div class="sb-filter-header">
                    <div>
                        <h1 class="sb-filter-title">Scholarships & Benefits</h1>
                        <p class="sb-filter-subtitle">Find the perfect scholarship for your education</p>
                    </div>
                    <div class="sb-search-wrapper">
                        <i class="fa-solid fa-magnifying-glass"></i>
                        <input type="text" placeholder="Search scholarships..." class="form-control">
                    </div>
                </div>

                <div class="sb-filter-row">
                    <div class="sb-selects-group">
                        <select class="form-select sb-filter-select">
                            <option>Class</option>
                            <option>Class 9</option>
                            <option>Class 10</option>
                            <option>Class 11</option>
                            <option>Class 12</option>
                        </select>
                        <select class="form-select sb-filter-select">
                            <option>Gender</option>
                            <option>Boys</option>
                            <option>Girls</option>
                            <option>Coed</option>
                        </select>
                        <select class="form-select sb-filter-select">
                            <option>State</option>
                            <option>Uttarakhand</option>
                            <option>Rajasthan</option>
                            <option>Punjab</option>
                        </select>
                        <select class="form-select sb-filter-select">
                            <option>Status</option>
                            <option>Live</option>
                            <option>Upcoming</option>
                            <option>Closed</option>
                        </select>
                        <select class="form-select sb-filter-select">
                            <option>Scholarship Year</option>
                            <option selected>2026</option>
                            <option>2027</option>
                        </select>
                    </div>

                    <div class="sb-buttons-group">
                        <button class="btn btn-light btn-sb-reset">Reset</button>
                        <button class="btn btn-primary btn-sb-apply">Apply Filters</button>
                    </div>
                </div>
            </div>

            <!-- Scholarship cards grid -->
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">

                <!-- Card 1 -->
                <div class="col">
                    <div class="sb-card">
                        <div class="sb-card-banner">
                            <span class="sb-badge-live">Live</span>
                            <span class="sb-badge-deadline">Deadline: 20 Jul 2026</span>
                            <img src="assets/images/scholarship-card-img.png" alt="School Scholarship & Academic Support">
                        </div>
                        <div class="sb-card-body">
                            <h3 class="sb-card-title">School Scholarship & Academic Support</h3>
                            <div class="sb-reward-badge">
                                <i class="fa-regular fa-lightbulb"></i> Upto INR 30,000
                            </div>
                            <p class="sb-card-text">Students from Classes 9th to 12th can explore merit-based scholarships, academic excellence rewards, and special support programs designed to encourage bright young learners. We help students identify suitable scholarship opportunities that recognize talent, improve accessibility to quality education, and motivate academic growth from an early stage.</p>
                            <a href="#" class="btn-sb-learnmore">Learn more <i class="fa-solid fa-chevron-right" style="font-size: 8px;"></i></a>
                        </div>
                    </div>
                </div>

                <!-- Card 2 -->
                <div class="col">
                    <div class="sb-card">
                        <div class="sb-card-banner">
                            <img src="assets/images/scholarship-card-img.png" alt="Scholarships for NEET & IIT-JEE Aspirants">
                        </div>
                        <div class="sb-card-body">
                            <h3 class="sb-card-title">Scholarships for NEET & IIT-JEE Aspirants</h3>
                            <div class="sb-reward-badge">
                                <i class="fa-regular fa-lightbulb"></i> Upto INR 30,000
                            </div>
                            <p class="sb-card-text">We support deserving NEET and IIT-JEE aspirants with scholarship opportunities based on academic performance, entrance exam scores, and competitive potential. From coaching support benefits to university scholarship programs, students can access financial assistance that helps reduce the burden of quality preparation and higher education expenses.</p>
                            <a href="#" class="btn-sb-learnmore">Learn more <i class="fa-solid fa-chevron-right" style="font-size: 8px;"></i></a>
                        </div>
                    </div>
                </div>

                <!-- Card 3 -->
                <div class="col">
                    <div class="sb-card">
                        <div class="sb-card-banner">
                            <img src="assets/images/scholarship-card-img.png" alt="Scholarship Guidance & Support">
                        </div>
                        <div class="sb-card-body">
                            <h3 class="sb-card-title">Scholarship Guidance & Support</h3>
                            <div class="sb-reward-badge">
                                <i class="fa-regular fa-lightbulb"></i> Upto INR 30,000
                            </div>
                            <p class="sb-card-text">Finding the right scholarship can be confusing, but our expert counselors simplify the process for you. From eligibility checks and documentation support to application guidance and university coordination, we assist students at every step of their scholarship journey.</p>
                            <a href="#" class="btn-sb-learnmore">Learn more <i class="fa-solid fa-chevron-right" style="font-size: 8px;"></i></a>
                        </div>
                    </div>
                </div>

                <!-- Card 4 -->
                <div class="col">
                    <div class="sb-card">
                        <div class="sb-card-banner">
                            <img src="assets/images/scholarship-card-img.png" alt="Turning Hard Work into Opportunities">
                        </div>
                        <div class="sb-card-body">
                            <h3 class="sb-card-title">Turning Hard Work into Opportunities</h3>
                            <div class="sb-reward-badge">
                                <i class="fa-regular fa-lightbulb"></i> Upto INR 30,000
                            </div>
                            <p class="sb-card-text">Students from Classes 9th to 12th can explore merit-based scholarships, academic excellence rewards, and special support programs designed to encourage bright young learners. We help students identify suitable scholarship opportunities that recognize talent, improve accessibility to quality education, and motivate academic growth from an early stage.</p>
                            <a href="#" class="btn-sb-learnmore">Learn more <i class="fa-solid fa-chevron-right" style="font-size: 8px;"></i></a>
                        </div>
                    </div>
                </div>

                <!-- Card 5 -->
                <div class="col">
                    <div class="sb-card">
                        <div class="sb-card-banner">
                            <img src="assets/images/scholarship-card-img.png" alt="Empowering Future Women Leaders">
                        </div>
                        <div class="sb-card-body">
                            <h3 class="sb-card-title">Empowering Future Women Leaders</h3>
                            <div class="sb-reward-badge">
                                <i class="fa-regular fa-lightbulb"></i> Upto INR 30,000
                            </div>
                            <p class="sb-card-text">Students from Classes 9th to 12th can explore merit-based scholarships, academic excellence rewards, and special support programs designed to encourage bright young learners. We help students identify suitable scholarship opportunities that recognize talent, improve accessibility to quality education, and motivate academic growth from an early stage.</p>
                            <a href="#" class="btn-sb-learnmore">Learn more <i class="fa-solid fa-chevron-right" style="font-size: 8px;"></i></a>
                        </div>
                    </div>
                </div>

                <!-- Card 6 -->
                <div class="col">
                    <div class="sb-card">
                        <div class="sb-card-banner">
                            <img src="assets/images/scholarship-card-img.png" alt="Minority & Government Scholarship Support">
                        </div>
                        <div class="sb-card-body">
                            <h3 class="sb-card-title">Minority & Government Scholarship Support</h3>
                            <div class="sb-reward-badge">
                                <i class="fa-regular fa-lightbulb"></i> Upto INR 30,000
                            </div>
                            <p class="sb-card-text">Students from Classes 9th to 12th can explore merit-based scholarships, academic excellence rewards, and special support programs designed to encourage bright young learners. We help students identify suitable scholarship opportunities that recognize talent, improve accessibility to quality education, and motivate academic growth from an early stage.</p>
                            <a href="#" class="btn-sb-learnmore">Learn more <i class="fa-solid fa-chevron-right" style="font-size: 8px;"></i></a>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>

    <!-- Curved Footer Section -->
    
    
    <!-- Bootstrap Bundle JS -->
@endsection
