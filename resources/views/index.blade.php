@extends('layouts.app')
@section('content')
<!-- Main Content Section -->
    <main class="pb-5 hero-sec">
        <div class="bg-square">
            <img src="assets/images/banner-square-img.svg" alt="">
        </div>
        <div class="container position-relative">
            <div class="row align-items-center">
                <!-- Left Column (Content & Search) -->
                <div class="col-lg-6 col-12 text-center text-lg-start">
                    <!-- Marketplace Badge -->
                    <div class="mb-4">
                        <span class="marketplace-badge">India's no.1 Education Market place</span>
                    </div>

                    <!-- Main Heading -->
                    <h1 class="hero-title">
                        Find your path.<br>
                        <span class="text-orange">Learn, Apply,</span><br>
                        <span class="fst-italic">Get Hired.</span>
                    </h1>

                    <!-- Search Capsule -->
                    <div class="search-bar-container mx-auto mx-lg-0 ">
                        <div class="dropdown">
                            <button class="search-dropdown" type="button" id="searchFilterDropdown"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <span>Looking for..</span>
                                <i class="fa-solid fa-chevron-down" style="color: rgb(0, 0, 0);"></i>
                            </button>
                            <ul class="dropdown-menu border-0 shadow-sm" aria-labelledby="searchFilterDropdown">
                                <li><a class="dropdown-item" href="#">Colleges</a></li>
                                <li><a class="dropdown-item" href="#">Courses</a></li>
                                <li><a class="dropdown-item" href="#">Mentors</a></li>
                                <li><a class="dropdown-item" href="#">Schools</a></li>
                            </ul>
                        </div>

                        <input type="text" class="search-input" placeholder="Search courses, colleges, mentor"
                            aria-label="Search text">
                        <button class="search-btn" type="submit" aria-label="Submit Search">
                            Search
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-arrow-right" viewBox="0 0 16 16">
                                <path fill-rule="evenodd"
                                    d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8" />
                            </svg>
                        </button>
                    </div>

                    <!-- Search Tags -->
                    <div class=" d-flex flex-wrap justify-content-center justify-content-lg-start"
                        style="margin-bottom:41px">
                        <a href="#" class="tag-pill">Top University</a>
                        <a href="#" class="tag-pill">Top Schools</a>
                        <a href="#" class="tag-pill">Top Schools</a>
                        <a href="#" class="tag-pill">Top Schools</a>
                    </div>

                    <!-- Statistics Cards -->
                    <div class="stats-container mb-4">
                        <div class="stat-card">
                            <span class="stat-number">2800+</span>
                            <span class="stat-label">Institution</span>
                        </div>
                        <div class="stat-card">
                            <span class="stat-number">1.2L+</span>
                            <span class="stat-label">Student Enrolled</span>
                        </div>
                        <div class="stat-card">
                            <span class="stat-number">4500+</span>
                            <span class="stat-label">Scholarship's</span>
                        </div>
                    </div>
                </div>

                <!-- Right Column (Robot Hand Image & Carousel Slider) -->
                <div class="col-lg-6 col-12 d-flex flex-column align-items-center">
                    <div class="hero-image-card swiper hero-swiper mb-4" style="overflow: hidden;">
                        <div class="swiper-wrapper">
                            <!-- Slide 1 -->
                            <div class="swiper-slide d-flex align-items-center justify-content-center">
                                <img src="assets/images/banner-image.svg" alt="Futuristic Glowing Cybernetic Hand"
                                    class="img-fluid hero-slide-img"
                                    style="border-radius: 20px; object-fit: cover; width: 100%; height: 100%;">
                            </div>
                            <!-- Slide 2 -->
                            <div class="swiper-slide d-flex align-items-center justify-content-center">
                                <img src="assets/images/banner-image.svg" alt="Expert Mentor"
                                    class="img-fluid hero-slide-img"
                                    style="border-radius: 20px; object-fit: cover; width: 100%; height: 100%;">
                            </div>
                            <!-- Slide 3 -->
                            <div class="swiper-slide d-flex align-items-center justify-content-center">
                                <img src="assets/images/banner-image.svg" alt="Academic Guide"
                                    class="img-fluid hero-slide-img"
                                    style="border-radius: 20px; object-fit: cover; width: 100%; height: 100%;">
                            </div>
                        </div>
                    </div>
                    <!-- Carousel Pagination Dots -->
                    <div class="carousel-dots"></div>
                </div>
            </div>
        </div>
    </main>


    <!-- Categories Section -->
    <section class="categories-section ptb-70">
        <div class="container">
            <!-- Section Header -->
            <div class="text-center heading-card">
                <span class="marketplace-badge mb-3">India's no.1 Market place</span>
                <div class="heading-with-lines d-flex align-items-center justify-content-center gap-3 mb-3">
                    <span class="heading-line d-none d-md-block"></span>
                    <h2 class="section-title mb-0">Everything education, in one marketplace</h2>
                    <span class="heading-line d-none d-md-block"></span>
                </div>
                <p class="section-subtitle mx-auto text-muted">
                    From your first school admission to your first job offer — we cover every milestone of your
                    education journey.
                </p>
            </div>

            <!-- Categories Grid -->
            <div class="row row-cols-2 row-cols-sm-3 row-cols-md-4 row-cols-lg-7 category-row justify-content-center">

                <!-- Row 1, Card 1: Schools -->
                <div class="col">
                    <div class="category-card">
                        <div class="category-icon-wrapper" style="background-color:#FCD8CB33;">
                            <img src="assets/images/education-list-icon.svg" alt="">
                        </div>
                        <h3 class="category-name">Schools</h3>
                        <span class="category-count">850+ listed</span>
                    </div>
                </div>

                <!-- Row 1, Card 2: Coaching -->
                <div class="col">
                    <div class="category-card">
                        <div class="category-icon-wrapper" style="background-color: #09FF6333;">
                            <img src="assets/images/education-list-icon.svg" alt="">
                        </div>
                        <h3 class="category-name">Coaching</h3>
                        <span class="category-count">62+ listed</span>
                    </div>
                </div>

                <!-- Row 1, Card 3: Universities -->
                <div class="col">
                    <div class="category-card">
                        <div class="category-icon-wrapper" style="background-color: #83CBFF33;">
                            <img src="assets/images/education-list-icon.svg" alt="">
                        </div>
                        <h3 class="category-name">Universities</h3>
                        <span class="category-count">850+ listed</span>
                    </div>
                </div>

                <!-- Row 1, Card 4: Mentors -->
                <div class="col">
                    <div class="category-card">
                        <div class="category-icon-wrapper" style="background-color: #FFCC0033;">
                            <img src="assets/images/education-list-icon.svg" alt="">
                        </div>
                        <h3 class="category-name">Mentors</h3>
                        <span class="category-count">850+ listed</span>
                    </div>
                </div>

                <!-- Row 1, Card 5: Scholarships -->
                <div class="col">
                    <div class="category-card">
                        <div class="category-icon-wrapper" style="background-color:#FCD8CB33;">
                            <img src="assets/images/education-list-icon.svg" alt="">
                        </div>
                        <h3 class="category-name">Scholarships</h3>
                        <span class="category-count">850+ listed</span>
                    </div>
                </div>

                <!-- Row 1, Card 6: Internships -->
                <div class="col">
                    <div class="category-card">
                        <div class="category-icon-wrapper" style="background-color:#FCD8CB33;">
                            <img src="assets/images/education-list-icon.svg" alt="">
                        </div>
                        <h3 class="category-name">Internships</h3>
                        <span class="category-count">4500+ listed</span>
                    </div>
                </div>

                <!-- Row 1, Card 7: Schools -->
                <div class="col">
                    <div class="category-card">
                        <div class="category-icon-wrapper" style="background-color:#FCD8CB33;">
                            <img src="assets/images/education-list-icon.svg" alt="">
                        </div>
                        <h3 class="category-name">Schools</h3>
                        <span class="category-count">850+ listed</span>
                    </div>
                </div>

                <!-- Row 2, Card 8: Schools -->
                <div class="col">
                    <div class="category-card">
                        <div class="category-icon-wrapper " style="background-color:#FCD8CB33;">
                            <img src="assets/images/education-list-icon.svg" alt="">
                        </div>
                        <h3 class="category-name">Schools</h3>
                        <span class="category-count">850+ listed</span>
                    </div>
                </div>

                <!-- Row 2, Card 9: Coaching -->
                <div class="col">
                    <div class="category-card">
                        <div class="category-icon-wrapper" style="background-color: #09FF6333;">
                            <img src="assets/images/education-list-icon.svg" alt="">
                        </div>
                        <h3 class="category-name">Coaching</h3>
                        <span class="category-count">62+ listed</span>
                    </div>
                </div>

                <!-- Row 2, Card 10: Universities -->
                <div class="col">
                    <div class="category-card">
                        <div class="category-icon-wrapper " style="background-color:#FCD8CB33;">
                            <img src="assets/images/education-list-icon.svg" alt="">
                        </div>
                        <h3 class="category-name">Universities</h3>
                        <span class="category-count">850+ listed</span>
                    </div>
                </div>

                <!-- Row 2, Card 11: Mentors -->
                <div class="col">
                    <div class="category-card">
                        <div class="category-icon-wrapper" style="background-color:#FCD8CB33;">
                            <img src="assets/images/education-list-icon.svg" alt="">
                        </div>
                        <h3 class="category-name">Mentors</h3>
                        <span class="category-count">850+ listed</span>
                    </div>
                </div>

                <!-- Row 2, Card 12: Scholarships -->
                <div class="col">
                    <div class="category-card">
                        <div class="category-icon-wrapper " style="background-color:#FCD8CB33;">
                            <img src="assets/images/education-list-icon.svg" alt="">
                        </div>
                        <h3 class="category-name">Scholarships</h3>
                        <span class="category-count">850+ listed</span>
                    </div>
                </div>

                <!-- Row 2, Card 13: Internships -->
                <div class="col">
                    <div class="category-card">
                        <div class="category-icon-wrapper " style="background-color:#FCD8CB33;">
                            <img src="assets/images/education-list-icon.svg" alt="">
                        </div>
                        <h3 class="category-name">Internships</h3>
                        <span class="category-count">4500+ listed</span>
                    </div>
                </div>

                <!-- Row 2, Card 14: Schools -->
                <div class="col">
                    <div class="category-card">
                        <div class="category-icon-wrapper " style="background-color:#FCD8CB33;">
                            <img src="assets/images/education-list-icon.svg" alt="">
                        </div>
                        <h3 class="category-name">Schools</h3>
                        <span class="category-count">850+ listed</span>
                    </div>
                </div>

            </div>

            <!-- View More Action Button -->
            <div class="text-center">
                <button class="btn btn-enrollzy btn-enrollzy-lg" type="button">
                    View More
                    <i class="fa-solid fa-arrow-right-long" style="color: #fff;"></i>
                </button>
            </div>
    </section>

    <!-- Boarding School Section -->
    <div class="grad-main"
        style="background: linear-gradient(180deg, rgba(191, 219, 247, 0) 0%, rgb(191 219 247 / 17%) 50%, rgba(191, 219, 247, 0) 100%);">
        <section class="boarding-schools-section ptb-70">
            <div class="container">
                <!-- Section Header -->
                <div class="text-center mb-5">
                    <div class="heading-with-lines d-flex align-items-center justify-content-center gap-3 mb-3">
                        <span class="heading-line d-none d-md-block"></span>
                        <h2 class="section-title mb-0">BOARDING SCHOOL</h2>
                        <span class="heading-line d-none d-md-block"></span>
                    </div>
                    <p class="section-subtitle mx-auto text-muted" style="max-width: 900px;">
                        Explore India's leading boarding schools and discover institutions designed to shape academic
                        excellence, leadership, character, and future success. Compare schools, curriculum, facilities,
                        campus life, and admissions — all in one place.
                    </p>
                </div>

                <!-- School Cards Grid -->
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-6 g-4 mb-5 justify-content-center">
                    <!-- Card 1 -->
                    <div class="col">
                        <div class="institution-card position-relative">
                            <span class="rating-badge position-absolute">
                                <span>4.5 <span class="star-icon">★</span></span>
                            </span>
                            <div class="institution-logo-wrapper mx-auto mb-3">
                                <img src="assets/images/boarding-school-logo.png" alt="">
                            </div>
                            <span class="badge-capsule mb-2">rashtriya indian</span>
                            <div class="card-info-text">jaipur, rajasthan &nbsp; CBSE</div>
                            <div class="card-info-text mb-3 fw-bold">3rd - 12th</div>
                            <a href="#" class="btn btn-enrollzy btn-enrollzy-sm w-100">
                                APPLY NOW
                                <i class="fa-solid fa-arrow-right-long" style="color: #fff;"></i>
                            </a>
                        </div>
                    </div>
                    <!-- Card 2 -->
                    <div class="col">
                        <div class="institution-card position-relative">
                            <span class="rating-badge position-absolute">
                                <span>4.5 <span class="star-icon">★</span></span>
                            </span>
                            <div class="institution-logo-wrapper mx-auto mb-3">
                                <img src="assets/images/boarding-school-logo.png" alt="">
                            </div>
                            <span class="badge-capsule mb-2">rashtriya indian</span>
                            <div class="card-info-text">jaipur, rajasthan &nbsp; CBSE</div>
                            <div class="card-info-text mb-3 fw-bold">3rd - 12th</div>
                            <a href="#" class="btn btn-enrollzy btn-enrollzy-sm w-100">
                                APPLY NOW
                                <i class="fa-solid fa-arrow-right-long" style="color: #fff;"></i>
                            </a>
                        </div>
                    </div>
                    <!-- Card 3 -->
                    <div class="col">
                        <div class="institution-card position-relative">
                            <span class="rating-badge position-absolute">
                                <span>4.5 <span class="star-icon">★</span></span>
                            </span>
                            <div class="institution-logo-wrapper mx-auto mb-3">
                                <img src="assets/images/boarding-school-logo.png" alt="">
                            </div>
                            <span class="badge-capsule mb-2">rashtriya indian</span>
                            <div class="card-info-text">jaipur, rajasthan &nbsp; CBSE</div>
                            <div class="card-info-text mb-3 fw-bold">3rd - 12th</div>
                            <a href="#" class="btn btn-enrollzy btn-enrollzy-sm w-100">
                                APPLY NOW
                                <i class="fa-solid fa-arrow-right-long" style="color: #fff;"></i>
                            </a>
                        </div>
                    </div>
                    <!-- Card 4 -->
                    <div class="col">
                        <div class="institution-card position-relative">
                            <span class="rating-badge position-absolute">
                                <span>4.5 <span class="star-icon">★</span></span>
                            </span>
                            <div class="institution-logo-wrapper mx-auto mb-3">
                                <img src="assets/images/boarding-school-logo.png" alt="">
                            </div>
                            <span class="badge-capsule mb-2">rashtriya indian</span>
                            <div class="card-info-text">jaipur, rajasthan &nbsp; CBSE</div>
                            <div class="card-info-text mb-3 fw-bold">3rd - 12th</div>
                            <a href="#" class="btn btn-enrollzy btn-enrollzy-sm w-100">
                                APPLY NOW
                                <i class="fa-solid fa-arrow-right-long" style="color: #fff;"></i>
                            </a>
                        </div>
                    </div>
                    <!-- Card 5 -->
                    <div class="col">
                        <div class="institution-card position-relative">
                            <span class="rating-badge position-absolute">
                                <span>4.5 <span class="star-icon">★</span></span>
                            </span>
                            <div class="institution-logo-wrapper mx-auto mb-3">
                                <img src="assets/images/boarding-school-logo.png" alt="">
                            </div>
                            <span class="badge-capsule mb-2">rashtriya indian</span>
                            <div class="card-info-text">jaipur, rajasthan &nbsp; CBSE</div>
                            <div class="card-info-text mb-3 fw-bold">3rd - 12th</div>
                            <a href="#" class="btn btn-enrollzy btn-enrollzy-sm w-100">
                                APPLY NOW
                                <i class="fa-solid fa-arrow-right-long" style="color: #fff;"></i>
                            </a>
                        </div>
                    </div>
                    <!-- Card 6 -->
                    <div class="col">
                        <div class="institution-card position-relative">
                            <span class="rating-badge position-absolute">
                                <span>4.5 <span class="star-icon">★</span></span>
                            </span>
                            <div class="institution-logo-wrapper mx-auto mb-3">
                                <img src="assets/images/boarding-school-logo.png" alt="">
                            </div>
                            <span class="badge-capsule mb-2">rashtriya indian</span>
                            <div class="card-info-text">jaipur, rajasthan &nbsp; CBSE</div>
                            <div class="card-info-text mb-3 fw-bold">3rd - 12th</div>
                            <a href="#" class="btn btn-enrollzy btn-enrollzy-sm w-100">
                                APPLY NOW
                                <i class="fa-solid fa-arrow-right-long" style="color: #fff;"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- View More Button -->
                <div class="text-center">
                    <button class="btn btn-enrollzy btn-enrollzy-lg" type="button">
                        View More
                        <i class="fa-solid fa-arrow-right-long" style="color: #fff;"></i>
                    </button>
                </div>
            </div>
        </section>

        <!-- Coaching Institutes Section -->
        <section class="coaching-institutes-section ptb-70">
            <div class="container">
                <!-- Section Header -->
                <div class="text-center mb-5">
                    <div class="heading-with-lines d-flex align-items-center justify-content-center gap-3 mb-3">
                        <span class="heading-line d-none d-md-block"></span>
                        <h2 class="section-title mb-0">COACHING INSTITUTES</h2>
                        <span class="heading-line d-none d-md-block"></span>
                    </div>
                    <p class="section-subtitle mx-auto text-muted" style="max-width: 900px;">
                        Discover leading coaching institutes that help students prepare for competitive exams and future
                        success through expert mentorship, structured learning, and proven outcomes.
                    </p>
                </div>

                <!-- Coaching Cards Grid -->
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-6 g-4 mb-5 justify-content-center">
                    <!-- Card 1: ALLEN -->
                    <div class="col">
                        <div class="institution-card position-relative">
                            <span class="rating-badge position-absolute">
                                <span>4.5 <span class="star-icon">★</span></span>
                            </span>
                            <div class="institution-logo-wrapper mx-auto mb-3">
                                <img src="assets/images/boarding-school-logo.png" alt="">
                            </div>
                            <span class="badge-capsule mb-2">ALLEN</span>
                            <div class="card-info-text">sikar, rajasthan</div>
                            <div class="card-info-text "
                                style="font-size: 10px; font-weight: 700; color: #000000;margin-bottom: 13px;">
                                NEET <span>|</span> IIT-JEE <span>|</span> NDA <span>|</span> CA/CS</div>
                            <a href="#" class="btn btn-enrollzy btn-enrollzy-sm w-100">
                                APPLY NOW
                                <i class="fa-solid fa-arrow-right-long" style="color: #fff;"></i>
                            </a>
                        </div>
                    </div>
                    <!-- Card 2: AKASH -->
                    <div class="col">
                        <div class="institution-card position-relative">
                            <span class="rating-badge position-absolute">
                                <span>4.5 <span class="star-icon">★</span></span>
                            </span>
                            <div class="institution-logo-wrapper mx-auto mb-3">
                                <img src="assets/images/boarding-school-logo.png" alt="">
                            </div>
                            <span class="badge-capsule mb-2">AKASH</span>
                            <div class="card-info-text">sikar, rajasthan</div>
                            <div class="card-info-text "
                                style="font-size: 10px; font-weight: 700; color: #000000;margin-bottom: 13px;">
                                NEET <span>|</span> IIT-JEE <span>|</span> NDA <span>|</span> CA/CS</div>
                            <a href="#" class="btn btn-enrollzy btn-enrollzy-sm w-100">
                                APPLY NOW
                                <i class="fa-solid fa-arrow-right-long" style="color: #fff;"></i>
                            </a>
                        </div>
                    </div>
                    <!-- Card 3: UNACADEMY -->
                    <div class="col">
                        <div class="institution-card position-relative">
                            <span class="rating-badge position-absolute">
                                <span>4.5 <span class="star-icon">★</span></span>
                            </span>
                            <div class="institution-logo-wrapper mx-auto mb-3">
                                <img src="assets/images/boarding-school-logo.png" alt="">
                            </div>
                            <span class="badge-capsule mb-2">UNACADEMY</span>
                            <div class="card-info-text">sikar, rajasthan</div>
                            <div class="card-info-text "
                                style="font-size: 10px; font-weight: 700; color: #000000;margin-bottom: 13px;">
                                NEET <span>|</span> IIT-JEE <span>|</span> NDA <span>|</span> CA/CS</div>
                            <a href="#" class="btn btn-enrollzy btn-enrollzy-sm w-100">
                                APPLY NOW
                                <i class="fa-solid fa-arrow-right-long" style="color: #fff;"></i>
                            </a>
                        </div>
                    </div>
                    <!-- Card 4: PHYSICS WALLAH -->
                    <div class="col">
                        <div class="institution-card position-relative">
                            <span class="rating-badge position-absolute">
                                <span>4.5 <span class="star-icon">★</span></span>
                            </span>
                            <div class="institution-logo-wrapper mx-auto mb-3">
                                <img src="assets/images/boarding-school-logo.png" alt="">
                            </div>
                            <span class="badge-capsule mb-2">ALPHYSICS WALLAHLEN</span>
                            <div class="card-info-text">sikar, rajasthan</div>
                            <div class="card-info-text "
                                style="font-size: 10px; font-weight: 700; color: #000000;margin-bottom: 13px;">
                                NEET <span>|</span> IIT-JEE <span>|</span> NDA <span>|</span> CA/CS</div>
                            <a href="#" class="btn btn-enrollzy btn-enrollzy-sm w-100">
                                APPLY NOW
                                <i class="fa-solid fa-arrow-right-long" style="color: #fff;"></i>
                            </a>
                        </div>
                    </div>
                    <!-- Card 5: SRI CHAITANYA -->
                    <div class="col">
                        <div class="institution-card position-relative">
                            <span class="rating-badge position-absolute">
                                <span>4.5 <span class="star-icon">★</span></span>
                            </span>
                            <div class="institution-logo-wrapper mx-auto mb-3">
                                <img src="assets/images/boarding-school-logo.png" alt="">
                            </div>
                            <span class="badge-capsule mb-2">SRI CHAITANYA</span>
                            <div class="card-info-text">sikar, rajasthan</div>
                            <div class="card-info-text "
                                style="font-size: 10px; font-weight: 700; color: #000000;margin-bottom: 13px;">
                                NEET <span>|</span> IIT-JEE <span>|</span> NDA <span>|</span> CA/CS</div>
                            <a href="#" class="btn btn-enrollzy btn-enrollzy-sm w-100">
                                APPLY NOW
                                <i class="fa-solid fa-arrow-right-long" style="color: #fff;"></i>
                            </a>
                        </div>
                    </div>
                    <!-- Card 6: WHITERAY -->
                    <div class="col">
                        <div class="institution-card position-relative">
                            <span class="rating-badge position-absolute">
                                <span>4.5 <span class="star-icon">★</span></span>
                            </span>
                            <div class="institution-logo-wrapper mx-auto mb-3">
                                <img src="assets/images/boarding-school-logo.png" alt="">
                            </div>
                            <span class="badge-capsule mb-2">WHITERAY</span>
                            <div class="card-info-text">sikar, rajasthan</div>
                            <div class="card-info-text "
                                style="font-size: 10px; font-weight: 700; color: #000000;margin-bottom: 13px;">
                                NEET <span>|</span> IIT-JEE <span>|</span> NDA <span>|</span> CA/CS</div>
                            <a href="#" class="btn btn-enrollzy btn-enrollzy-sm w-100">
                                APPLY NOW
                                <i class="fa-solid fa-arrow-right-long" style="color: #fff;"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- View More Button -->
                <div class="text-center">
                    <button class="btn btn-enrollzy btn-enrollzy-lg" type="button">
                        View More
                        <i class="fa-solid fa-arrow-right-long" style="color: #fff;"></i>
                    </button>
                </div>
            </div>
        </section>
    </div>

    <!-- Journey Section -->
    <section class="journey-section ptb-70">
        <div class="blue-shadow">
            <img src="assets/images/journey-blue-shadow.png" alt="">
        </div>
        <div class="pink-shadow">
            <img src="assets/images/journey-pink-shadow.png" alt="">
        </div>
        <div class="container-fluid">
            <!-- Section Header -->
            <div class="text-center mb-5">
                <span class="marketplace-badge mb-3">Why choose enrollzy</span>
                <div class="heading-with-lines d-flex align-items-center justify-content-center gap-3 mb-3">
                    <span class="heading-line d-none d-md-block"></span>
                    <h2 class="section-title mb-0">Your step-by-step journey to success</h2>
                    <span class="heading-line d-none d-md-block"></span>
                </div>
                <p class="section-subtitle mx-auto text-muted" style="max-width: 900px;">
                    We guide you from school to your dream career with personalised milestones, resources, and mentors
                    at every stage.
                </p>
            </div>

            <!-- Journey Steps Grid -->
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-6 g-4  mt-5 justify-content-center"
                style="margin-bottom:57px !important">
                <!-- Step 1 -->
                <div class="col journey-step-col">
                    <div class="journey-icon-wrapper">
                        <!-- Book SVG -->
                        <img src="assets/images/step-img-1.png" alt="">
                    </div>
                    <h3 class="journey-step-title">Explore & Discover</h3>
                    <p class="journey-step-desc">Find your interests and aptitude <br> through guided assessments</p>
                </div>

                <!-- Step 2 -->
                <div class="col journey-step-col">
                    <div class="journey-icon-wrapper">
                        <!-- Cap SVG -->
                        <img src="assets/images/step-img-2.png" alt="">
                    </div>
                    <h3 class="journey-step-title">Choose Institution</h3>
                    <p class="journey-step-desc">Compare & apply to best-fit <br> schools, coaching, or colleges</p>
                </div>
                <!-- Step 3 -->
                <div class="col journey-step-col">
                    <div class="journey-icon-wrapper">
                        <!-- Trophy SVG -->
                        <img src="assets/images/step-img-3.png" alt="">
                    </div>
                    <h3 class="journey-step-title">Secure Funding</h3>
                    <p class="journey-step-desc">Apply for scholarships & financial <br> aid through Enrollzy</p>
                </div>
                <!-- Step 4 -->
                <div class="col journey-step-col">
                    <div class="journey-icon-wrapper">
                        <!-- Books SVG -->
                        <img src="assets/images/step-img-4.png" alt="">
                    </div>
                    <h3 class="journey-step-title">Skill Up</h3>
                    <p class="journey-step-desc">Take certifications and courses <br> alongside academics</p>
                </div>
                <!-- Step 5 -->
                <div class="col journey-step-col">
                    <div class="journey-icon-wrapper">
                        <!-- Mentors SVG -->
                        <img src="assets/images/step-img-5.png" alt="">
                    </div>
                    <h3 class="journey-step-title">Get a Mentor</h3>
                    <p class="journey-step-desc">1:1 sessions with industry experts <br> and alumni</p>
                </div>
                <!-- Step 6 -->
                <div class="col journey-step-col">
                    <div class="journey-icon-wrapper">
                        <!-- Briefcase SVG -->
                        <img src="assets/images/step-img-6.png" alt="">
                    </div>
                    <h3 class="journey-step-title">Land the Job</h3>
                    <p class="journey-step-desc">Internships, placements, and <br> career support on one platform</p>
                </div>
            </div>

            <!-- Start Journey Button -->
            <div class="text-center">
                <a href="#" class="btn btn-enrollzy btn-enrollzy-lg">
                    Start your Journey
                    <i class="fa-solid fa-arrow-right-long" style="color: #fff;"></i>
                </a>
            </div>
        </div>
    </section>

    <!-- Scholarships Section -->
    <section class="scholarships-section ptb-70"
        style="    background: linear-gradient(180deg, #FFFFFF 0%, #f8fbfd 49%, #f8fbfd 100%);">
        <div class="container">
            <!-- Section Header -->
            <div class="text-center mb-5">
                <span class="marketplace-badge mb-3">Scholarships & Benefits</span>
                <div class="heading-with-lines d-flex align-items-center justify-content-center gap-3 mb-3">
                    <span class="heading-line d-none d-md-block"></span>
                    <h2 class="section-title mb-0">Don't miss out on free money</h2>
                    <span class="heading-line d-none d-md-block"></span>
                </div>
                <p class="section-subtitle mx-auto text-muted" style="max-width: 900px;">
                    4,500+ scholarships worth over ₹200 Cr available. We match you automatically based on your profile.
                </p>
            </div>

            <!-- Scholarship Cards Grid -->
            <div class="row row-cols-1 row-cols-md-3 g-4 mb-5">
                <!-- Card 1 -->
                <div class="col">
                    <div class="scholarship-card">
                        <div>
                            <h3 class="scholarship-title">PM Scholarship Scheme</h3>
                            <a href="#" class="scholarship-authority">Government of India · Central Sector Scheme</a>
                            <span class="scholarship-amount">₹75,000 <span
                                    style="font-size: 1rem; color: #777777; font-weight: 500;">/year</span></span>
                            <div class="scholarship-meta-row">
                                <span class="scholarship-meta-item">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor"
                                        class="bi bi-mortarboard-fill text-muted" viewBox="0 0 16 16">
                                        <path
                                            d="M8.211 2.047a.5.5 0 0 0-.422 0l-7.135 3.7A.5.5 0 0 0 0 6.18v3.135a2.5 2.5 0 0 0 .768 1.77L8 15.8l7.232-4.715A2.5 2.5 0 0 0 16 9.315V6.18a.5.5 0 0 0-.654-.473L8.211 2.047z" />
                                    </svg>
                                    Merit-based
                                </span>
                                <span class="scholarship-meta-item">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor"
                                        class="bi bi-alarm-fill text-muted" viewBox="0 0 16 16">
                                        <path
                                            d="M6 .5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 .5.5v.5H6zM.86 5.387A2.5 2.5 0 1 1 4.387 1.86l.294.294a8.5 8.5 0 0 0-4.062 4.062l.241-.241zM11.613 1.86a2.5 2.5 0 1 1 3.527 3.527l-.241-.241a8.5 8.5 0 0 0-4.062-4.062zM8.5 5.5a.5.5 0 0 0-1 0v3.362l-1.429 2.38a.5.5 0 1 0 .858.514l1.5-2.5A.5.5 0 0 0 8.5 9zM8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16" />
                                    </svg>
                                    Dec 31, 2026
                                </span>
                            </div>
                            <div class="scholarship-badges-row">
                                <span class="badge-stream">Any stream</span>
                                <span class="badge-income">Income &lt; ₹8L</span>
                            </div>
                        </div>
                        <a href="#" class="btn btn-enrollzy btn-enrollzy-md w-100">
                            Check eligibility & Apply
                            <i class="fa-solid fa-arrow-right-long" style="color: #fff;"></i>
                        </a>
                    </div>
                </div>
                <!-- Card 2 -->
                <div class="col">
                    <div class="scholarship-card">
                        <div>
                            <h3 class="scholarship-title">Tata Scholarship for Engineering</h3>
                            <a href="#" class="scholarship-authority">Government of India · Central Sector Scheme</a>
                            <span class="scholarship-amount">₹75,000 <span
                                    style="font-size: 1rem; color: #777777; font-weight: 500;">/year</span></span>
                            <div class="scholarship-meta-row">
                                <span class="scholarship-meta-item">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor"
                                        class="bi bi-mortarboard-fill text-muted" viewBox="0 0 16 16">
                                        <path
                                            d="M8.211 2.047a.5.5 0 0 0-.422 0l-7.135 3.7A.5.5 0 0 0 0 6.18v3.135a2.5 2.5 0 0 0 .768 1.77L8 15.8l7.232-4.715A2.5 2.5 0 0 0 16 9.315V6.18a.5.5 0 0 0-.654-.473L8.211 2.047z" />
                                    </svg>
                                    Merit-based
                                </span>
                                <span class="scholarship-meta-item">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor"
                                        class="bi bi-alarm-fill text-muted" viewBox="0 0 16 16">
                                        <path
                                            d="M6 .5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 .5.5v.5H6zM.86 5.387A2.5 2.5 0 1 1 4.387 1.86l.294.294a8.5 8.5 0 0 0-4.062 4.062l.241-.241zM11.613 1.86a2.5 2.5 0 1 1 3.527 3.527l-.241-.241a8.5 8.5 0 0 0-4.062-4.062zM8.5 5.5a.5.5 0 0 0-1 0v3.362l-1.429 2.38a.5.5 0 1 0 .858.514l1.5-2.5A.5.5 0 0 0 8.5 9zM8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16" />
                                    </svg>
                                    Dec 31, 2026
                                </span>
                            </div>
                            <div class="scholarship-badges-row">
                                <span class="badge-stream">Any stream</span>
                                <span class="badge-income">Income &lt; ₹8L</span>
                            </div>
                        </div>
                        <a href="#" class="btn btn-enrollzy btn-enrollzy-md w-100">
                            Check eligibility & Apply
                            <i class="fa-solid fa-arrow-right-long" style="color: #fff;"></i>
                        </a>
                    </div>
                </div>
                <!-- Card 3 -->
                <div class="col">
                    <div class="scholarship-card">
                        <div>
                            <h3 class="scholarship-title">Inspire Scholarship for Science</h3>
                            <a href="#" class="scholarship-authority">Government of India · Central Sector Scheme</a>
                            <span class="scholarship-amount">₹75,000 <span
                                    style="font-size: 1rem; color: #777777; font-weight: 500;">/year</span></span>
                            <div class="scholarship-meta-row">
                                <span class="scholarship-meta-item">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor"
                                        class="bi bi-mortarboard-fill text-muted" viewBox="0 0 16 16">
                                        <path
                                            d="M8.211 2.047a.5.5 0 0 0-.422 0l-7.135 3.7A.5.5 0 0 0 0 6.18v3.135a2.5 2.5 0 0 0 .768 1.77L8 15.8l7.232-4.715A2.5 2.5 0 0 0 16 9.315V6.18a.5.5 0 0 0-.654-.473L8.211 2.047z" />
                                    </svg>
                                    Merit-based
                                </span>
                                <span class="scholarship-meta-item">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor"
                                        class="bi bi-alarm-fill text-muted" viewBox="0 0 16 16">
                                        <path
                                            d="M6 .5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 .5.5v.5H6zM.86 5.387A2.5 2.5 0 1 1 4.387 1.86l.294.294a8.5 8.5 0 0 0-4.062 4.062l.241-.241zM11.613 1.86a2.5 2.5 0 1 1 3.527 3.527l-.241-.241a8.5 8.5 0 0 0-4.062-4.062zM8.5 5.5a.5.5 0 0 0-1 0v3.362l-1.429 2.38a.5.5 0 1 0 .858.514l1.5-2.5A.5.5 0 0 0 8.5 9zM8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16" />
                                    </svg>
                                    Dec 31, 2026
                                </span>
                            </div>
                            <div class="scholarship-badges-row">
                                <span class="badge-stream">Any stream</span>
                                <span class="badge-income">Income &lt; ₹8L</span>
                            </div>
                        </div>
                        <a href="#" class="btn btn-enrollzy btn-enrollzy-md w-100">
                            Check eligibility & Apply
                            <i class="fa-solid fa-arrow-right-long" style="color: #fff;"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- View More Button -->
            <div class="text-center">
                <button class="btn btn-enrollzy btn-enrollzy-lg" type="button">
                    View More
                    <i class="fa-solid fa-arrow-right-long" style="color: #fff;"></i>
                </button>
            </div>
        </div>
    </section>

    <!-- Trending Section -->
    <section class="trending-section ptb-70">
        <div class="container">
            <!-- Section Header -->
            <div class="text-center" style="margin-bottom: 57px;">
                <div class="heading-with-lines d-flex align-items-center justify-content-center gap-3 mb-3">
                    <span class="heading-line d-none d-md-block"></span>
                    <h2 class="section-title mb-0">Trending Learning Opportunities</h2>
                    <span class="heading-line d-none d-md-block"></span>
                </div>
                <p class="section-subtitle mx-auto text-muted" style="max-width: 900px;">
                    Explore our popular certificates, credentials, and achievements.
                </p>
            </div>

            <!-- Outer 3 Columns Grid -->
            <div class="row row-cols-1 row-cols-lg-3 g-4">

                <!-- Column 1: Trending Skills -->
                <div class="col">
                    <div class="trending-column-container trending-border-blue">
                        <div class="trending-column-header text-primary">
                            <h3 class="trending-header-title mb-0">Trending Skills</h3>
                            <span class="trending-header-arrow"><i class="fa-solid fa-arrow-right-long"></i></span>
                        </div>
                        <div class="row row-cols-2" style="gap: 15px 0px;">
                            <!-- Skill Card 1 -->
                            <div class="col">
                                <div class="skill-list-card">
                                    <div class="skill-card-icon-wrapper">
                                        <img src="assets/images/trending-ai-img.png" alt="">
                                    </div>
                                    <h4 class="skill-card-title">Artificial Intelligence & Generative AI</h4>
                                    <ul class="skill-list">
                                        <li class="skill-list-item">Learn AI tools</li>
                                        <li class="skill-list-item">automation</li>
                                        <li class="skill-list-item">prompt engineering</li>
                                        <li class="skill-list-item">future-ready AI technologies.</li>
                                    </ul>
                                </div>
                            </div>
                            <!-- Skill Card 2 -->
                            <div class="col">
                                <div class="skill-list-card">
                                    <div class="skill-card-icon-wrapper">
                                        <img src="assets/images/trending-ai-img.png" alt="">
                                    </div>
                                    <h4 class="skill-card-title">Data Science & Analytics</h4>
                                    <ul class="skill-list">
                                        <li class="skill-list-item">Learn AI tools</li>
                                        <li class="skill-list-item">automation</li>
                                        <li class="skill-list-item">prompt engineering</li>
                                        <li class="skill-list-item">future-ready AI technologies.</li>
                                    </ul>
                                </div>
                            </div>
                            <!-- Skill Card 3 -->
                            <div class="col">
                                <div class="skill-list-card">
                                    <div class="skill-card-icon-wrapper">
                                        <img src="assets/images/trending-ai-img.png" alt="">
                                    </div>
                                    <h4 class="skill-card-title">Cybersecurity & Ethical Hacking</h4>
                                    <ul class="skill-list">
                                        <li class="skill-list-item">Learn AI tools</li>
                                        <li class="skill-list-item">automation</li>
                                        <li class="skill-list-item">prompt engineering</li>
                                        <li class="skill-list-item">future-ready AI technologies.</li>
                                    </ul>
                                </div>
                            </div>
                            <!-- Skill Card 4 -->
                            <div class="col">
                                <div class="skill-list-card">
                                    <div class="skill-card-icon-wrapper">
                                        <img src="assets/images/trending-ai-img.png" alt="">
                                    </div>
                                    <h4 class="skill-card-title">Cloud Computing & DevOps</h4>
                                    <ul class="skill-list">
                                        <li class="skill-list-item">Learn AI tools</li>
                                        <li class="skill-list-item">automation</li>
                                        <li class="skill-list-item">prompt engineering</li>
                                        <li class="skill-list-item">future-ready AI technologies.</li>
                                    </ul>
                                </div>
                            </div>
                            <!-- Skill Card 5 -->
                            <div class="col">
                                <div class="skill-list-card">
                                    <div class="skill-card-icon-wrapper">
                                        <img src="assets/images/trending-ai-img.png" alt="">
                                    </div>
                                    <h4 class="skill-card-title">Cybersecurity & Ethical Hacking</h4>
                                    <ul class="skill-list">
                                        <li class="skill-list-item">Learn AI tools</li>
                                        <li class="skill-list-item">automation</li>
                                        <li class="skill-list-item">prompt engineering</li>
                                        <li class="skill-list-item">future-ready AI technologies.</li>
                                    </ul>
                                </div>
                            </div>
                            <!-- Skill Card 6 -->
                            <div class="col">
                                <div class="skill-list-card">
                                    <div class="skill-card-icon-wrapper">
                                        <img src="assets/images/trending-ai-img.png" alt="">
                                    </div>
                                    <h4 class="skill-card-title">Cloud Computing & DevOps</h4>
                                    <ul class="skill-list">
                                        <li class="skill-list-item">Learn AI tools</li>
                                        <li class="skill-list-item">automation</li>
                                        <li class="skill-list-item">prompt engineering</li>
                                        <li class="skill-list-item">future-ready AI technologies.</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Column 2: Free Courses -->
                <div class="col">
                    <div class="trending-column-container trending-border-yellow">
                        <div class="trending-column-header text-warning">
                            <h3 class="trending-header-title mb-0" style="color: #F9AD0B;">Free Courses
                            </h3>
                            <span class="trending-header-arrow"><i class="fa-solid fa-arrow-right-long"></i></span>
                        </div>
                        <div class="row row-cols-2" style="gap: 15px 0px;">
                            <!-- Course Card 1 -->
                            <div class="col">
                                <div class="skill-list-card">
                                    <div class="skill-card-icon-wrapper">
                                        <img src="assets/images/trending-ai-img.png" alt="">
                                    </div>
                                    <h4 class="skill-card-title">Artificial Intelligence & Generative AI</h4>
                                    <ul class="skill-list">
                                        <li class="skill-list-item">Learn AI tools</li>
                                        <li class="skill-list-item">automation</li>
                                        <li class="skill-list-item">prompt engineering</li>
                                        <li class="skill-list-item">future-ready AI technologies.</li>
                                    </ul>
                                </div>
                            </div>
                            <!-- Course Card 2 -->
                            <div class="col">
                                <div class="skill-list-card">
                                    <div class="skill-card-icon-wrapper">
                                        <img src="assets/images/trending-ai-img.png" alt="">
                                    </div>
                                    <h4 class="skill-card-title">Data Science & Analytics</h4>
                                    <ul class="skill-list">
                                        <li class="skill-list-item">Learn AI tools</li>
                                        <li class="skill-list-item">automation</li>
                                        <li class="skill-list-item">prompt engineering</li>
                                        <li class="skill-list-item">future-ready AI technologies.</li>
                                    </ul>
                                </div>
                            </div>
                            <!-- Course Card 3 -->
                            <div class="col">
                                <div class="skill-list-card">
                                    <div class="skill-card-icon-wrapper">
                                        <img src="assets/images/trending-ai-img.png" alt="">
                                    </div>
                                    <h4 class="skill-card-title">Cybersecurity & Ethical Hacking</h4>
                                    <ul class="skill-list">
                                        <li class="skill-list-item">Learn AI tools</li>
                                        <li class="skill-list-item">automation</li>
                                        <li class="skill-list-item">prompt engineering</li>
                                        <li class="skill-list-item">future-ready AI technologies.</li>
                                    </ul>
                                </div>
                            </div>
                            <!-- Course Card 4 -->
                            <div class="col">
                                <div class="skill-list-card">
                                    <div class="skill-card-icon-wrapper">
                                        <img src="assets/images/trending-ai-img.png" alt="">
                                    </div>
                                    <h4 class="skill-card-title">Cloud Computing & DevOps</h4>
                                    <ul class="skill-list">
                                        <li class="skill-list-item">Learn AI tools</li>
                                        <li class="skill-list-item">automation</li>
                                        <li class="skill-list-item">prompt engineering</li>
                                        <li class="skill-list-item">future-ready AI technologies.</li>
                                    </ul>
                                </div>
                            </div>
                            <!-- Course Card 5 -->
                            <div class="col">
                                <div class="skill-list-card">
                                    <div class="skill-card-icon-wrapper">
                                        <img src="assets/images/trending-ai-img.png" alt="">
                                    </div>
                                    <h4 class="skill-card-title">Cybersecurity & Ethical Hacking</h4>
                                    <ul class="skill-list">
                                        <li class="skill-list-item">Learn AI tools</li>
                                        <li class="skill-list-item">automation</li>
                                        <li class="skill-list-item">prompt engineering</li>
                                        <li class="skill-list-item">future-ready AI technologies.</li>
                                    </ul>
                                </div>
                            </div>
                            <!-- Course Card 6 -->
                            <div class="col">
                                <div class="skill-list-card">
                                    <div class="skill-card-icon-wrapper">
                                        <img src="assets/images/trending-ai-img.png" alt="">
                                    </div>
                                    <h4 class="skill-card-title">Cloud Computing & DevOps</h4>
                                    <ul class="skill-list">
                                        <li class="skill-list-item">Learn AI tools</li>
                                        <li class="skill-list-item">automation</li>
                                        <li class="skill-list-item">prompt engineering</li>
                                        <li class="skill-list-item">future-ready AI technologies.</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Column 3: Trending Programmes -->
                <div class="col">
                    <div class="trending-column-container trending-border-dark">
                        <div class="trending-column-header text-dark">
                            <h3 class="trending-header-title mb-0" style="color: #000;">Trending Programmes</h3>
                            <span class="trending-header-arrow"><i class="fa-solid fa-arrow-right-long"></i></span>
                        </div>
                        <div class="row row-cols-2" style="gap: 15px 0px;">
                            <!-- Programme Card 1 -->
                            <div class="col">
                                <div class="skill-list-card">
                                    <div class="skill-card-icon-wrapper">
                                        <img src="assets/images/trending-ai-img.png" alt="">
                                    </div>
                                    <h4 class="skill-card-title">Artificial Intelligence & Generative AI</h4>
                                    <ul class="skill-list">
                                        <li class="skill-list-item">Learn AI tools</li>
                                        <li class="skill-list-item">automation</li>
                                        <li class="skill-list-item">prompt engineering</li>
                                        <li class="skill-list-item">future-ready AI technologies.</li>
                                    </ul>
                                </div>
                            </div>
                            <!-- Programme Card 2 -->
                            <div class="col">
                                <div class="skill-list-card">
                                    <div class="skill-card-icon-wrapper">
                                        <img src="assets/images/trending-ai-img.png" alt="">
                                    </div>
                                    <h4 class="skill-card-title">Data Science & Analytics</h4>
                                    <ul class="skill-list">
                                        <li class="skill-list-item">Learn AI tools</li>
                                        <li class="skill-list-item">automation</li>
                                        <li class="skill-list-item">prompt engineering</li>
                                        <li class="skill-list-item">future-ready AI technologies.</li>
                                    </ul>
                                </div>
                            </div>
                            <!-- Programme Card 3 -->
                            <div class="col">
                                <div class="skill-list-card">
                                    <div class="skill-card-icon-wrapper">
                                        <img src="assets/images/trending-ai-img.png" alt="">
                                    </div>
                                    <h4 class="skill-card-title">Cybersecurity & Ethical Hacking</h4>
                                    <ul class="skill-list">
                                        <li class="skill-list-item">Learn AI tools</li>
                                        <li class="skill-list-item">automation</li>
                                        <li class="skill-list-item">prompt engineering</li>
                                        <li class="skill-list-item">future-ready AI technologies.</li>
                                    </ul>
                                </div>
                            </div>
                            <!-- Programme Card 4 -->
                            <div class="col">
                                <div class="skill-list-card">
                                    <div class="skill-card-icon-wrapper">
                                        <img src="assets/images/trending-ai-img.png" alt="">
                                    </div>
                                    <h4 class="skill-card-title">Cloud Computing & DevOps</h4>
                                    <ul class="skill-list">
                                        <li class="skill-list-item">Learn AI tools</li>
                                        <li class="skill-list-item">automation</li>
                                        <li class="skill-list-item">prompt engineering</li>
                                        <li class="skill-list-item">future-ready AI technologies.</li>
                                    </ul>
                                </div>
                            </div>
                            <!-- Programme Card 5 -->
                            <div class="col">
                                <div class="skill-list-card">
                                    <div class="skill-card-icon-wrapper">
                                        <img src="assets/images/trending-ai-img.png" alt="">
                                    </div>
                                    <h4 class="skill-card-title">Cybersecurity & Ethical Hacking</h4>
                                    <ul class="skill-list">
                                        <li class="skill-list-item">Learn AI tools</li>
                                        <li class="skill-list-item">automation</li>
                                        <li class="skill-list-item">prompt engineering</li>
                                        <li class="skill-list-item">future-ready AI technologies.</li>
                                    </ul>
                                </div>
                            </div>
                            <!-- Programme Card 6 -->
                            <div class="col">
                                <div class="skill-list-card">
                                    <div class="skill-card-icon-wrapper">
                                        <img src="assets/images/trending-ai-img.png" alt="">
                                    </div>
                                    <h4 class="skill-card-title">Cloud Computing & DevOps</h4>
                                    <ul class="skill-list">
                                        <li class="skill-list-item">Learn AI tools</li>
                                        <li class="skill-list-item">automation</li>
                                        <li class="skill-list-item">prompt engineering</li>
                                        <li class="skill-list-item">future-ready AI technologies.</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="text-center" style="margin-top: 57px;">
                <button class="btn btn-enrollzy btn-enrollzy-lg" type="button">
                    View More
                    <i class="fa-solid fa-arrow-right-long" style="color: #fff;"></i>
                </button>
            </div>
        </div>
    </section>

    <!-- Expert Mentors Section -->
    <section class="mentors-section ptb-70">
        <div class="container">
            <!-- Section Header -->
            <div class="text-center mb-5">
                <div class="heading-with-lines d-flex align-items-center justify-content-center gap-3 mb-3">
                    <span class="heading-line d-none d-md-block"></span>
                    <h2 class="section-title mb-0">Expert Mentors</h2>
                    <span class="heading-line d-none d-md-block"></span>
                </div>
                <p class="section-subtitle mx-auto text-muted" style="max-width: 900px;">
                    Learn from experienced professionals, industry leaders, and academic mentors dedicated to student
                    success.
                </p>
            </div>

            <!-- Mentors Grid -->
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-2 row-cols-lg-4 g-4 mb-5">
                <!-- Mentor 1 -->
                <div class="col">
                    <div class="mentor-card">
                        <div class="mentor-img-wrapper">
                            <img src="assets/images/mentor-img-1.png" alt="Abhishek Sharma" class="mentor-img">
                        </div>
                        <div class="mentor-card-body">
                            <div>
                                <h3 class="mentor-name">Abhishek Sharma</h3>
                                <p class="mentor-title">Product Manager · Google · IIM-A</p>
                                <div class="mentor-tags-row mb-3">
                                    <span class="badge-mentor-tag mentor-tag-blue">MBA Prep</span>
                                    <span class="badge-mentor-tag mentor-tag-orange">Product</span>
                                    <span class="badge-mentor-tag mentor-tag-green">Startups</span>
                                </div>
                            </div>
                            <div>
                                <div class="mentor-rating-row mb-3">
                                    <div class="mentor-rating">
                                        <span class="star-rating">★★★★★</span>
                                        <span class="rating-value ms-1">4.9</span>
                                    </div>
                                    <span class="mentor-sessions">280 sessions</span>
                                </div>
                                <div class="mentor-footer">
                                    <span class="mentor-price">₹500<span
                                            style="font-size: 0.72rem; color: #777777; font-weight: 600;">/min</span></span>
                                    <a href="#" class="btn btn-enrollzy btn-enrollzy-sm">
                                        Book session
                                        <i class="fa-solid fa-arrow-right-long"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Mentor 2 -->
                <div class="col">
                    <div class="mentor-card">
                        <div class="mentor-img-wrapper">
                            <img src="assets/images/mentor-img-2.png" alt="Abhishek Sharma" class="mentor-img">
                        </div>
                        <div class="mentor-card-body">
                            <div>
                                <h3 class="mentor-name">Abhishek Sharma</h3>
                                <p class="mentor-title">Product Manager · Google · IIM-A</p>
                                <div class="mentor-tags-row mb-3">
                                    <span class="badge-mentor-tag mentor-tag-blue">MBA Prep</span>
                                    <span class="badge-mentor-tag mentor-tag-orange">Product</span>
                                    <span class="badge-mentor-tag mentor-tag-green">Startups</span>
                                </div>
                            </div>
                            <div>
                                <div class="mentor-rating-row mb-3">
                                    <div class="mentor-rating">
                                        <span class="star-rating">★★★★★</span>
                                        <span class="rating-value ms-1">4.9</span>
                                    </div>
                                    <span class="mentor-sessions">280 sessions</span>
                                </div>
                                <div class="mentor-footer">
                                    <span class="mentor-price">₹500<span
                                            style="font-size: 0.72rem; color: #777777; font-weight: 600;">/min</span></span>
                                    <a href="#" class="btn btn-enrollzy btn-enrollzy-sm">
                                        Book session
                                        <i class="fa-solid fa-arrow-right-long"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Mentor 3 -->
                <div class="col">
                    <div class="mentor-card">
                        <div class="mentor-img-wrapper">
                            <img src="assets/images/mentor-img-3.png" alt="Abhishek Sharma" class="mentor-img">
                        </div>
                        <div class="mentor-card-body">
                            <div>
                                <h3 class="mentor-name">Abhishek Sharma</h3>
                                <p class="mentor-title">Product Manager · Google · IIM-A</p>
                                <div class="mentor-tags-row mb-3">
                                    <span class="badge-mentor-tag mentor-tag-blue">MBA Prep</span>
                                    <span class="badge-mentor-tag mentor-tag-orange">Product</span>
                                    <span class="badge-mentor-tag mentor-tag-green">Startups</span>
                                </div>
                            </div>
                            <div>
                                <div class="mentor-rating-row mb-3">
                                    <div class="mentor-rating">
                                        <span class="star-rating">★★★★★</span>
                                        <span class="rating-value ms-1">4.9</span>
                                    </div>
                                    <span class="mentor-sessions">280 sessions</span>
                                </div>
                                <div class="mentor-footer">
                                    <span class="mentor-price">₹500<span
                                            style="font-size: 0.72rem; color: #777777; font-weight: 600;">/min</span></span>
                                    <a href="#" class="btn btn-enrollzy btn-enrollzy-sm">
                                        Book session
                                        <i class="fa-solid fa-arrow-right-long"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Mentor 4 -->
                <div class="col">
                    <div class="mentor-card">
                        <div class="mentor-img-wrapper">
                            <img src="assets/images/mentor-img-4.png" alt="Abhishek Sharma" class="mentor-img">
                        </div>
                        <div class="mentor-card-body">
                            <div>
                                <h3 class="mentor-name">Abhishek Sharma</h3>
                                <p class="mentor-title">Product Manager · Google · IIM-A</p>
                                <div class="mentor-tags-row mb-3">
                                    <span class="badge-mentor-tag mentor-tag-blue">MBA Prep</span>
                                    <span class="badge-mentor-tag mentor-tag-orange">Product</span>
                                    <span class="badge-mentor-tag mentor-tag-green">Startups</span>
                                </div>
                            </div>
                            <div>
                                <div class="mentor-rating-row mb-3">
                                    <div class="mentor-rating">
                                        <span class="star-rating">★★★★★</span>
                                        <span class="rating-value ms-1">4.9</span>
                                    </div>
                                    <span class="mentor-sessions">280 sessions</span>
                                </div>
                                <div class="mentor-footer">
                                    <span class="mentor-price">₹500<span
                                            style="font-size: 0.72rem; color: #777777; font-weight: 600;">/min</span></span>
                                    <a href="#" class="btn btn-enrollzy btn-enrollzy-sm">
                                        Book session
                                        <i class="fa-solid fa-arrow-right-long"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- View More Button -->
            <div class="text-center">
                <button class="btn btn-enrollzy btn-enrollzy-lg" type="button">
                    View More
                    <i class="fa-solid fa-arrow-right-long" style="color: #fff;"></i>
                </button>
            </div>
        </div>
    </section>

    <!-- FAQ Zone Section -->
    <section class="faq-zone-section ptb-70">
        <div class="container">
            <!-- Section Header -->
            <div class="text-center mb-5">
                <div class="heading-with-lines d-flex align-items-center justify-content-center gap-3 mb-3">
                    <span class="heading-line d-none d-md-block"></span>
                    <h2 class="section-title mb-0">The FAQ Zone</h2>
                    <span class="heading-line d-none d-md-block"></span>
                </div>
                <p class="section-subtitle mx-auto text-muted" style="max-width: 900px;">
                    What our students and parents have to say about their experience with us.
                </p>
            </div>

            <!-- FAQ Accordion -->
            <div class="accordion accordion-flush mx-auto mb-5" id="faqZoneAccordion" style="max-width: 900px;">
                <!-- FAQ Item 1 -->
                <div class="accordion-item">
                    <h3 class="accordion-header" id="headingOne">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                            How does Enrollzy help students choose the right course or university?
                        </button>
                    </h3>
                    <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne"
                        data-bs-parent="#faqZoneAccordion">
                        <div class="accordion-body">
                            Enrollzy offers personalized matching algorithms, detailed institution comparison tools,
                            expert mentor advice, and comprehensive resource guides to help you evaluate and choose the
                            best path.
                        </div>
                    </div>
                </div>
                <!-- FAQ Item 2 -->
                <div class="accordion-item">
                    <h3 class="accordion-header" id="headingTwo">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            Can I compare universities and courses on Enrollzy?
                        </button>
                    </h3>
                    <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                        data-bs-parent="#faqZoneAccordion">
                        <div class="accordion-body">
                            Yes, students can compare universities based on fees, placements, rankings, approvals,
                            scholarships, course structure, and career opportunities before making a decision.
                        </div>
                    </div>
                </div>
                <!-- FAQ Item 3 -->
                <div class="accordion-item">
                    <h3 class="accordion-header" id="headingThree">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                            Does Enrollzy provide admission assistance?
                        </button>
                    </h3>
                    <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree"
                        data-bs-parent="#faqZoneAccordion">
                        <div class="accordion-body">
                            Yes, Enrollzy offers admission support including application form filling, document review,
                            and guidance through the admission processes of partner schools and colleges.
                        </div>
                    </div>
                </div>
                <!-- FAQ Item 4 -->
                <div class="accordion-item">
                    <h3 class="accordion-header" id="headingFour">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                            Can I talk to alumni or industry experts before taking admission?
                        </button>
                    </h3>
                    <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour"
                        data-bs-parent="#faqZoneAccordion">
                        <div class="accordion-body">
                            Yes, you can schedule 1:1 mentorship sessions with verified alumni and industry leaders on
                            the Enrollzy platform to get real insights before committing.
                        </div>
                    </div>
                </div>
                <!-- FAQ Item 5 -->
                <div class="accordion-item">
                    <h3 class="accordion-header" id="headingFive">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                            Lorem ipsum dolor sit ame
                        </button>
                    </h3>
                    <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive"
                        data-bs-parent="#faqZoneAccordion">
                        <div class="accordion-body">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt.
                        </div>
                    </div>
                </div>
                <!-- FAQ Item 6 -->
                <div class="accordion-item">
                    <h3 class="accordion-header" id="headingSix">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                            Lorem ipsum dolor sit ame
                        </button>
                    </h3>
                    <div id="collapseSix" class="accordion-collapse collapse" aria-labelledby="headingSix"
                        data-bs-parent="#faqZoneAccordion">
                        <div class="accordion-body">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt.
                        </div>
                    </div>
                </div>
                <!-- FAQ Item 7 -->
                <div class="accordion-item">
                    <h3 class="accordion-header" id="headingSeven">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseSeven" aria-expanded="true" aria-controls="collapseSeven">
                            Lorem ipsum dolor sit ame
                        </button>
                    </h3>
                    <div id="collapseSeven" class="accordion-collapse collapse show" aria-labelledby="headingSeven"
                        data-bs-parent="#faqZoneAccordion">
                        <div class="accordion-body">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt.
                        </div>
                    </div>
                </div>
            </div>

            <!-- View More Button -->
            <div class="text-center">
                <button class="btn btn-enrollzy btn-enrollzy-lg" type="button">
                    View More
                    <i class="fa-solid fa-arrow-right-long" style="color: #fff;"></i>
                </button>
            </div>
        </div>
    </section>

    <!-- Top Exams Section -->
    <section class="top-exams-section ptb-70">
        <div class="container">
            <!-- Section Header -->
            <div class="text-center mb-5">
                <div class="heading-with-lines d-flex align-items-center justify-content-center gap-3 mb-3">
                    <span class="heading-line d-none d-md-block"></span>
                    <h2 class="section-title mb-0">Top Exams</h2>
                    <span class="heading-line d-none d-md-block"></span>
                </div>
                <p class="section-subtitle mx-auto text-muted" style="max-width: 900px;">
                    Prepare for the top competitive exams in the country.
                </p>
            </div>

            <!-- Exams Grid -->
            <div class="row row-cols-1 row-cols-md-3 g-5 mb-5 justify-content-center">
                <!-- Exam 1 -->
                <div class="col text-center">
                    <div class="exam-icon-wrapper">
                        <!-- Notebook Icon SVG -->
                        <img src="assets/images/top-exam-icon-1.png" alt="">
                    </div>
                    <h3 class="exam-title">Joint Entrance Examination <br> MAINS</h3>
                    <p class="exam-desc">Find your interests and aptitude <br> through guided assessments</p>
                </div>
                <!-- Exam 2 -->
                <div class="col text-center">
                    <div class="exam-icon-wrapper">
                        <!-- School Icon SVG -->
                        <img src="assets/images/top-exam-icon-2.png" alt="">
                    </div>
                    <h3 class="exam-title">National Eligibility cum Entrance <br> Test (Undergraduate)</h3>
                    <p class="exam-desc">Find your interests and aptitude <br> through guided assessments</p>
                </div>
                <!-- Exam 3 -->
                <div class="col text-center">
                    <div class="exam-icon-wrapper">
                        <!-- Trophy Icon SVG -->
                        <img src="assets/images/top-exam-icon-3.png" alt="">
                    </div>
                    <h3 class="exam-title">Graduate Aptitude Test in <br> Engineering</h3>
                    <p class="exam-desc">Find your interests and aptitude <br> through guided assessments</p>
                </div>
                <!-- Exam 4 -->
                <div class="col text-center">
                    <div class="exam-icon-wrapper">
                        <!-- Stacked Books Icon SVG -->
                        <img src="assets/images/top-exam-icon-4.png" alt="">
                    </div>
                    <h3 class="exam-title">National Eligibility cum <br> Entrance Test – Postgraduate</h3>
                    <p class="exam-desc">Find your interests and aptitude <br> through guided assessments</p>
                </div>
                <!-- Exam 5 -->
                <div class="col text-center">
                    <div class="exam-icon-wrapper">
                        <!-- Laptop Users Icon SVG -->
                        <img src="assets/images/top-exam-icon-5.png" alt="">
                    </div>
                    <h3 class="exam-title">Common University Entrance <br> Test – Postgraduate</h3>
                    <p class="exam-desc">Find your interests and aptitude <br> through guided assessments</p>
                </div>
                <!-- Exam 6 -->
                <div class="col text-center">
                    <div class="exam-icon-wrapper">
                        <!-- Briefcase Icon SVG -->
                        <img src="assets/images/top-exam-icon-6.png" alt="">
                    </div>
                    <h3 class="exam-title">Xavier Aptitude Test</h3>
                    <p class="exam-desc">Find your interests and aptitude <br> through guided assessments</p>
                </div>
            </div>

            <!-- View More Button -->
            <div class="text-center" style="margin-top: 57px;">
                <button class="btn btn-enrollzy btn-enrollzy-lg" type="button">
                    View More
                    <i class="fa-solid fa-arrow-right-long" style="color: #fff;"></i>
                </button>
            </div>
        </div>
    </section>

    <div class="grad-main"
        style="background: linear-gradient(180deg, rgba(191, 219, 247, 0) 0%, rgb(191 219 247 / 30%) 50%, rgba(191, 219, 247, 0) 100%)">
        <!-- Questions & Answers Section -->
        <section class="qa-section ptb-70">
            <div class="container">
                <!-- Section Header -->
                <div class="text-center mb-5">
                    <div class="heading-with-lines d-flex align-items-center justify-content-center gap-3 mb-3">
                        <span class="heading-line d-none d-md-block"></span>
                        <h2 class="section-title mb-0">Questions & Answers</h2>
                        <span class="heading-line d-none d-md-block"></span>
                    </div>
                    <p class="section-subtitle mx-auto text-muted" style="max-width: 900px;">
                        Here are some of the most commonly asked questions by our prospective students.
                    </p>
                </div>

                <!-- Q&A Content Row -->
                <div class="row g-5 align-items-center">
                    <!-- Left Column: Image with Badges -->
                    <div class="col-lg-5">
                        <img src="assets/images/qa-img.png" alt="">
                    </div>

                    <!-- Right Column: Question Cards -->
                    <div class="col-lg-7">
                        <!-- Card 1 -->
                        <div class="qa-right-card-box-main">
                            <div class="qa-question-card">
                                <h3 class="qa-question-text">Can I compare universities and courses on Enrollzy?</h3>
                                <p class="qa-answer-text">
                                    Yes, students can compare universities based on fees, placements, rankings,
                                    approvals,
                                    scholarships, course structure, and career opportunities before making a decision.
                                </p>
                            </div>
                            <!-- Card 2 -->
                            <div class="qa-right-card-box">
                                <div class="qa-question-card">
                                    <h3 class="qa-question-text">Can I compare universities and courses on Enrollzy?
                                    </h3>
                                    <p class="qa-answer-text">
                                        Yes, students can compare universities based on fees, placements, rankings,
                                        approvals,
                                        scholarships, course structure, and career opportunities before making a
                                        decision.
                                    </p>
                                </div>
                                <!-- Card 3 -->
                                <div class="qa-right-card-box">
                                    <div class="qa-question-card">
                                        <h3 class="qa-question-text">Can I compare universities and courses on Enrollzy?
                                        </h3>
                                        <p class="qa-answer-text">
                                            Yes, students can compare universities based on fees, placements, rankings,
                                            approvals,
                                            scholarships, course structure, and career opportunities before making a
                                            decision.
                                        </p>
                                    </div>
                                    <!-- Card 4 (Collapsed) -->
                                    <div class="qa-right-card-box">
                                        <div class="qa-question-card">
                                            <h3 class="qa-question-text">Can I compare universities and courses on
                                                Enrollzy?</h3>
                                            <p class="qa-answer-text">
                                                Yes, students can compare universities based on fees, placements,
                                                rankings, approvals,
                                                scholarships, course structure, and career opportunities before making a
                                                decision.
                                            </p>
                                        </div>
                                    </div>
                                    <!-- Card 5 (Collapsed) -->
                                    <div class="qa-right-card-box">
                                        <div class="qa-question-card">
                                            <h3 class="qa-question-text">Can I compare universities and courses on
                                                Enrollzy?</h3>
                                            <p class="qa-answer-text">
                                                Yes, students can compare universities based on fees, placements,
                                                rankings, approvals,
                                                scholarships, course structure, and career opportunities before making a
                                                decision.
                                            </p>
                                        </div>
                                    </div>
                                    <!-- Card 6 (Collapsed) -->
                                    <div class="qa-right-card-box">
                                        <div class="qa-question-card">
                                            <h3 class="qa-question-text">Can I compare universities and courses on
                                                Enrollzy?</h3>
                                            <p class="qa-answer-text">
                                                Yes, students can compare universities based on fees, placements,
                                                rankings, approvals,
                                                scholarships, course structure, and career opportunities before making a
                                                decision.
                                            </p>
                                        </div>
                                    </div>
                                    <!-- Card 7 (Collapsed) -->
                                    <div class="qa-right-card-box">
                                        <div class="qa-question-card">
                                            <h3 class="qa-question-text">Can I compare universities and courses on
                                                Enrollzy?</h3>
                                            <p class="qa-answer-text">
                                                Yes, students can compare universities based on fees, placements,
                                                rankings, approvals,
                                                scholarships, course structure, and career opportunities before making a
                                                decision.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Book Now Button -->
                        </div>

                    </div>
                    <div class="col-md-12"></div>
                    <div class="text-center mt-5">
                        <a href="#" class="btn btn-enrollzy btn-enrollzy-lg">
                            Book Now
                            <i class="fa-solid fa-arrow-right-long" style="color: #fff;"></i>
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <!-- Our Latest Blog Section -->
        <section class="blog-section ptb-70">
            <div class="container">
                <!-- Section Header -->
                <div class="text-center mb-5">
                    <div class="heading-with-lines d-flex align-items-center justify-content-center gap-3 mb-3">
                        <span class="heading-line d-none d-md-block"></span>
                        <h2 class="section-title mb-0">Our Latest Blog</h2>
                        <span class="heading-line d-none d-md-block"></span>
                    </div>
                    <p class="section-subtitle mx-auto text-muted" style="max-width: 900px;">
                        What our students and parents have to say about their experience with us.
                    </p>
                </div>

                <!-- Blog Grid -->
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-2 row-cols-lg-4 g-4 mb-5">
                    <!-- Blog 1 -->
                    <div class="col">
                        <div class="blog-card">
                            <div class="blog-img-wrapper">
                                <img src="assets/images/blog-img-1.png" alt="BBA vs BCom vs BA" class="blog-img">
                            </div>
                            <div class="blog-card-body">
                                <div>
                                    <span class="blog-tag">Technology</span>
                                    <h3 class="blog-title">BBA vs BCom vs BA: Which Course is Better for Your Care...
                                    </h3>
                                </div>
                                <a href="#" class="btn btn-enrollzy btn-enrollzy-md w-100">
                                    Read more
                                    <i class="fa-solid fa-arrow-right-long" style="color: #fff;"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <!-- Blog 2 -->
                    <div class="col">
                        <div class="blog-card">
                            <div class="blog-img-wrapper">
                                <img src="assets/images/blog-img-2.png" alt="Best Online Courses" class="blog-img">
                            </div>
                            <div class="blog-card-body">
                                <div>
                                    <span class="blog-tag">Technology</span>
                                    <h3 class="blog-title">Best Online Courses After Graduation for High Salary Ca...
                                    </h3>
                                </div>
                                <a href="#" class="btn btn-enrollzy btn-enrollzy-md w-100">
                                    Read more
                                    <i class="fa-solid fa-arrow-right-long" style="color: #fff;"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <!-- Blog 3 -->
                    <div class="col">
                        <div class="blog-card">
                            <div class="blog-img-wrapper">
                                <img src="assets/images/blog-img-3.png" alt="Best AI Courses" class="blog-img">
                            </div>
                            <div class="blog-card-body">
                                <div>
                                    <span class="blog-tag">Technology</span>
                                    <h3 class="blog-title">Best AI Courses After 12th?</h3>
                                </div>
                                <a href="#" class="btn btn-enrollzy btn-enrollzy-md w-100">
                                    Read more
                                    <i class="fa-solid fa-arrow-right-long" style="color: #fff;"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <!-- Blog 4 -->
                    <div class="col">
                        <div class="blog-card">
                            <div class="blog-img-wrapper">
                                <img src="assets/images/blog-img-4.png" alt="Online MBA in India" class="blog-img">
                            </div>
                            <div class="blog-card-body">
                                <div>
                                    <span class="blog-tag">Technology</span>
                                    <h3 class="blog-title">Online MBA in India: Complete Guide 2026 (Fees, College...
                                    </h3>
                                </div>
                                <a href="#" class="btn btn-enrollzy btn-enrollzy-md w-100">
                                    Read more
                                    <i class="fa-solid fa-arrow-right-long" style="color: #fff;"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- View More Button -->
                <div class="text-center">
                    <button class="btn btn-enrollzy btn-enrollzy-lg" type="button">
                        View More
                        <i class="fa-solid fa-arrow-right-long" style="color: #fff;"></i>
                    </button>
                </div>
            </div>
        </section>
    </div>

    <!-- Testimonials Section -->
    <section class="testimonials-section ptb-70" style="background-color: #FFFCF8;">
        <div class="container">
            <!-- Section Header -->
            <div class="text-center mb-5">
                <div class="heading-with-lines d-flex align-items-center justify-content-center gap-3 mb-3">
                    <span class="heading-line d-none d-md-block"></span>
                    <h2 class="section-title mb-0">Testimonials</h2>
                    <span class="heading-line d-none d-md-block"></span>
                </div>
                <p class="section-subtitle mx-auto text-muted" style="max-width: 900px;">
                    What our students and parents have to say about their experience with us.
                </p>
            </div>

            <!-- Video Cards Grid -->
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-2 row-cols-lg-4 g-4 mb-5">
                <!-- Video 1 -->
                <div class="col">
                    <div class="testimonial-card" style="background-image: url('assets/images/mentor_1.png');">
                        <div class="testimonial-overlay"></div>
                        <button class="play-icon-btn" type="button">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                                class="bi bi-play-fill" viewBox="0 0 16 16">
                                <path
                                    d="m11.596 8.697-6.363 3.692c-.54.313-1.233-.066-1.233-.697V4.308c0-.63.692-1.01 1.233-.696l6.363 3.692a.802.802 0 0 1 0 1.393z" />
                            </svg>
                        </button>
                        <div class="testimonial-card-body">
                            <h3 class="testimonial-name">Abhishek sharma</h3>
                            <p class="testimonial-sub">PHD Admission Success</p>
                            <div class="testimonial-rating">★★★★★</div>
                        </div>
                    </div>
                </div>
                <!-- Video 2 -->
                <div class="col">
                    <div class="testimonial-card" style="background-image: url('assets/images/mentor_2.png');">
                        <div class="testimonial-overlay"></div>
                        <button class="play-icon-btn" type="button">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                                class="bi bi-play-fill" viewBox="0 0 16 16">
                                <path
                                    d="m11.596 8.697-6.363 3.692c-.54.313-1.233-.066-1.233-.697V4.308c0-.63.692-1.01 1.233-.696l6.363 3.692a.802.802 0 0 1 0 1.393z" />
                            </svg>
                        </button>
                        <div class="testimonial-card-body">
                            <h3 class="testimonial-name">Abhishek sharma</h3>
                            <p class="testimonial-sub">PHD Admission Success</p>
                            <div class="testimonial-rating">★★★★★</div>
                        </div>
                    </div>
                </div>
                <!-- Video 3 -->
                <div class="col">
                    <div class="testimonial-card" style="background-image: url('assets/images/mentor_3.png');">
                        <div class="testimonial-overlay"></div>
                        <button class="play-icon-btn" type="button">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                                class="bi bi-play-fill" viewBox="0 0 16 16">
                                <path
                                    d="m11.596 8.697-6.363 3.692c-.54.313-1.233-.066-1.233-.697V4.308c0-.63.692-1.01 1.233-.696l6.363 3.692a.802.802 0 0 1 0 1.393z" />
                            </svg>
                        </button>
                        <div class="testimonial-card-body">
                            <h3 class="testimonial-name">Abhishek sharma</h3>
                            <p class="testimonial-sub">PHD Admission Success</p>
                            <div class="testimonial-rating">★★★★★</div>
                        </div>
                    </div>
                </div>
                <!-- Video 4 -->
                <div class="col">
                    <div class="testimonial-card" style="background-image: url('assets/images/mentor_4.png');">
                        <div class="testimonial-overlay"></div>
                        <button class="play-icon-btn" type="button">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                                class="bi bi-play-fill" viewBox="0 0 16 16">
                                <path
                                    d="m11.596 8.697-6.363 3.692c-.54.313-1.233-.066-1.233-.697V4.308c0-.63.692-1.01 1.233-.696l6.363 3.692a.802.802 0 0 1 0 1.393z" />
                            </svg>
                        </button>
                        <div class="testimonial-card-body">
                            <h3 class="testimonial-name">Abhishek sharma</h3>
                            <p class="testimonial-sub">PHD Admission Success</p>
                            <div class="testimonial-rating">★★★★★</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- View More Button -->
            <div class="text-center" style="margin-top:76px;">
                <button class="btn btn-enrollzy btn-enrollzy-lg" type="button">
                    View More
                    <i class="fa-solid fa-arrow-right-long" style="color: #fff;"></i>
                </button>
            </div>
        </div>
    </section>

    <!-- Student Insights & Feedback Section -->
    <section class="feedback-section ptb-70" style="background:#FFFCF8;">
        <div class="container">
            <div class="text-center mb-5">
                <div class="heading-with-lines d-flex align-items-center justify-content-center gap-3 mb-3">
                    <span class="heading-line d-none d-md-block"></span>
                    <h2 class="section-title mb-0">Student Insights & Feedback</h2>
                    <span class="heading-line d-none d-md-block"></span>
                </div>
                <p class="section-subtitle mx-auto text-muted" style="max-width: 900px;">
                    What our students and parents have to say about their experience with us.
                </p>
            </div>

            <!-- Section Header + Nav Buttons -->
            <div class="d-flex justify-content-between align-items-center mb-5 flex-wrap gap-3">

                <div class="carousel-nav-container"
                    style="width: 100%;justify-content:space-between;padding:0px 50px 0px 50px;">
                    <a href="#" class="carousel-nav-btn feedback-prev-btn">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-arrow-left" viewBox="0 0 16 16">
                            <path fill-rule="evenodd"
                                d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8" />
                        </svg>
                    </a>
                    <a href="#" class="carousel-nav-btn feedback-next-btn">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-arrow-right" viewBox="0 0 16 16">
                            <path fill-rule="evenodd"
                                d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8" />
                        </svg>
                    </a>
                </div>
            </div>

            <!-- Feedback Cards Swiper -->
            <div class="swiper feedback-swiper" style="overflow: hidden;padding:0px 50px 100px 50px;">
                <div class="swiper-wrapper">
                    <!-- Feedback 1 -->
                    <div class="swiper-slide h-auto">
                        <div class="feedback-card">
                            <div>
                                <div class="feedback-rating">★★★★★</div>
                                <p class="feedback-text">
                                    Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo
                                    minus id quod maxime placeat facere possimus.
                                </p>
                            </div>
                            <div class="feedback-author-row">
                                <img src="assets/images/mentor_2.png" alt="User Profile" class="feedback-avatar">
                                <div>
                                    <h4 class="feedback-author-name">Serhiy Hipskyy</h4>
                                    <span class="feedback-author-title">CEO Universal</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Feedback 2 -->
                    <div class="swiper-slide h-auto">
                        <div class="feedback-card">
                            <div>
                                <div class="feedback-rating">★★★★★</div>
                                <p class="feedback-text">
                                    Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo
                                    minus id quod maxime placeat facere possimus.
                                </p>
                            </div>
                            <div class="feedback-author-row">
                                <img src="assets/images/mentor_3.png" alt="User Profile" class="feedback-avatar">
                                <div>
                                    <h4 class="feedback-author-name">Justus Menke</h4>
                                    <span class="feedback-author-title">CEO Eronaman</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Feedback 3 -->
                    <div class="swiper-slide h-auto">
                        <div class="feedback-card">
                            <div>
                                <div class="feedback-rating">★★★★★</div>
                                <p class="feedback-text">
                                    Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo
                                    minus id quod maxime placeat facere possimus.
                                </p>
                            </div>
                            <div class="feedback-author-row">
                                <img src="assets/images/mentor_4.png" alt="User Profile" class="feedback-avatar">
                                <div>
                                    <h4 class="feedback-author-name">Britain Eriksen</h4>
                                    <span class="feedback-author-title">CEO Universal</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Feedback 1 -->
                    <div class="swiper-slide h-auto">
                        <div class="feedback-card">
                            <div>
                                <div class="feedback-rating">★★★★★</div>
                                <p class="feedback-text">
                                    Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo
                                    minus id quod maxime placeat facere possimus.
                                </p>
                            </div>
                            <div class="feedback-author-row">
                                <img src="assets/images/mentor_2.png" alt="User Profile" class="feedback-avatar">
                                <div>
                                    <h4 class="feedback-author-name">Serhiy Hipskyy</h4>
                                    <span class="feedback-author-title">CEO Universal</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Feedback 2 -->
                    <div class="swiper-slide h-auto">
                        <div class="feedback-card">
                            <div>
                                <div class="feedback-rating">★★★★★</div>
                                <p class="feedback-text">
                                    Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo
                                    minus id quod maxime placeat facere possimus.
                                </p>
                            </div>
                            <div class="feedback-author-row">
                                <img src="assets/images/mentor_3.png" alt="User Profile" class="feedback-avatar">
                                <div>
                                    <h4 class="feedback-author-name">Justus Menke</h4>
                                    <span class="feedback-author-title">CEO Eronaman</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Feedback 3 -->
                    <div class="swiper-slide h-auto">
                        <div class="feedback-card">
                            <div>
                                <div class="feedback-rating">★★★★★</div>
                                <p class="feedback-text">
                                    Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo
                                    minus id quod maxime placeat facere possimus.
                                </p>
                            </div>
                            <div class="feedback-author-row">
                                <img src="assets/images/mentor_4.png" alt="User Profile" class="feedback-avatar">
                                <div>
                                    <h4 class="feedback-author-name">Britain Eriksen</h4>
                                    <span class="feedback-author-title">CEO Universal</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- View More Button -->
            <div class="text-center">
                <button class="btn btn-enrollzy btn-enrollzy-lg" type="button">
                    View More
                    <i class="fa-solid fa-arrow-right-long" style="color: #fff;"></i>
                </button>
            </div>
        </div>
    </section>

    <!-- Find The Perfect University For You Section -->
    <section class="perfect-university-section ptb-70" style="padding-bottom: 27px;">
        <div class="container">
            <!-- Section Header -->
            <div class="text-center mb-4">
                <div class="heading-with-lines d-flex align-items-center justify-content-center gap-3 mb-3">
                    <span class="heading-line d-none d-md-block"></span>
                    <h2 class="section-title mb-0">Find The Perfect University For You</h2>
                    <span class="heading-line d-none d-md-block"></span>
                </div>
                <p class="section-subtitle mx-auto text-muted" style="max-width: 900px;">
                    Discover top universities, exams, and opportunities in your preferred field.
                </p>
            </div>

            <!-- Category Tabs Navigation -->
            <div class="mb-5 m-auto">
                <ul class="perfect-univ-tabs nav  m-auto" role="tablist" id="perfectUnivTabs">
                    <li role="presentation"><a href="#tab-medical" class="perfect-univ-tab active" data-bs-toggle="tab"
                            role="tab" aria-selected="true">&lt; Medical</a></li>
                    <li role="presentation"><a href="#tab-science" class="perfect-univ-tab" data-bs-toggle="tab"
                            role="tab" aria-selected="false">Science</a></li>
                    <li role="presentation"><a href="#tab-hotel" class="perfect-univ-tab" data-bs-toggle="tab"
                            role="tab" aria-selected="false">Hotel Management</a></li>
                    <li role="presentation"><a href="#tab-it" class="perfect-univ-tab" data-bs-toggle="tab" role="tab"
                            aria-selected="false">Information Technology</a></li>
                    <li role="presentation"><a href="#tab-arts" class="perfect-univ-tab" data-bs-toggle="tab" role="tab"
                            aria-selected="false">Arts & Humanities</a></li>
                    <li role="presentation"><a href="#tab-agri" class="perfect-univ-tab" data-bs-toggle="tab" role="tab"
                            aria-selected="false">Agriculture</a></li>
                    <li role="presentation"><a href="#tab-law" class="perfect-univ-tab" data-bs-toggle="tab" role="tab"
                            aria-selected="false">Law</a></li>
                    <li role="presentation"><a href="#tab-pharmacy" class="perfect-univ-tab" data-bs-toggle="tab"
                            role="tab" aria-selected="false">Pharmacy</a></li>
                    <li role="presentation"><a href="#tab-education" class="perfect-univ-tab" data-bs-toggle="tab"
                            role="tab" aria-selected="false">Education &gt;</a></li>
                </ul>
            </div>

            <!-- Perfect Match Box Grid -->
            <div class="tab-content">
                <div class="tab-pane fade show active" id="tab-medical" role="tabpanel">
                    <div class="row row-cols-1 row-cols-lg-3 g-4">
                        <!-- Column 1: Featured Colleges -->
                        <div class="col">
                            <div class="perfect-match-box">
                                <div class="perfect-match-header">
                                    <h3 class="perfect-match-title mb-0">Featured Colleges</h3>
                                    <a href="#" class="btn-view-all-link">View all</a>
                                </div>
                                <div class="perfect-badges-grid">
                                    <span class="badge-univ-pill">Chitkara University</span>
                                    <span class="badge-univ-pill">Parul University</span>
                                    <span class="badge-univ-pill">K.R. Mangalam University</span>
                                    <span class="badge-univ-pill">Chandigarh University</span>
                                    <span class="badge-univ-pill">K.R. Mangalam University</span>
                                    <span class="badge-univ-pill">Chandigarh University</span>
                                    <span class="badge-univ-pill">Lovely University</span>
                                    <span class="badge-univ-pill">Sanskriti University</span>
                                    <span class="badge-univ-pill">Lovely University</span>
                                    <span class="badge-univ-pill">Sanskriti University</span>
                                    <span class="badge-univ-pill">Lovely University</span>
                                    <span class="badge-univ-pill">Sanskriti University</span>
                                    <span class="badge-univ-pill">Lovely University</span>
                                    <span class="badge-univ-pill">Sanskriti University</span>
                                    <span class="badge-univ-pill">Lovely University</span>
                                    <span class="badge-univ-pill">Sanskriti University</span>
                                </div>
                            </div>
                        </div>

                        <!-- Column 2: Important Exams & Top States -->
                        <div class="col">
                            <div class="d-flex flex-column gap-4 h-100">
                                <!-- Box A: Important Exams -->
                                <div class="perfect-match-box" style="flex: 1;">
                                    <div class="perfect-match-header">
                                        <h3 class="perfect-match-title mb-0">Important Exams</h3>
                                        <a href="#" class="btn-view-all-link">View all</a>
                                    </div>
                                    <div class="perfect-badges-grid"
                                        style="padding: 10px 12px;border-radius: 10px;background-color: #fff;border: 1px solid #DDDDDD;">
                                        <span class="badge-univ-pill">JEE Main</span>
                                        <span class="badge-univ-pill">JEE Advanced</span>
                                        <span class="badge-univ-pill">EAMCET</span>
                                        <span class="badge-univ-pill">WBJEE</span>
                                    </div>
                                </div>
                                <!-- Box B: Top States -->
                                <div class="perfect-match-box" style="flex: 1;">
                                    <div class="perfect-match-header" style="margin-bottom:10px;">
                                        <h3 class="perfect-match-title mb-0">Top States</h3>
                                        <a href="#" class="btn-view-all-link">View all</a>
                                    </div>
                                    <div class="perfect-badges-grid"
                                        style="padding: 10px 12px;border-radius: 10px;background-color: #fff;border: 1px solid #DDDDDD;">
                                        <span class="badge-univ-pill">Maharashtra</span>
                                        <span class="badge-univ-pill">Tamilnadu</span>
                                        <span class="badge-univ-pill">Uttar Pradesh</span>
                                        <span class="badge-univ-pill">Punjab</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Column 3: Related Courses -->
                        <div class="col">
                            <div class="perfect-match-box">
                                <div class="perfect-match-header">
                                    <h3 class="perfect-match-title mb-0">Related Courses</h3>
                                    <a href="#" class="btn-view-all-link">View all</a>
                                </div>
                                <div class="perfect-badges-grid">
                                    <span class="badge-univ-pill">B tech</span>
                                    <span class="badge-univ-pill">M tech</span>
                                    <span class="badge-univ-pill">Bachelor of Engineering</span>
                                    <span class="badge-univ-pill">Civil Engineering</span>
                                    <span class="badge-univ-pill">Lovely University</span>
                                    <span class="badge-univ-pill">Sanskriti University</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="tab-science" role="tabpanel">
                    <div class="row row-cols-1 row-cols-lg-3 g-4">
                        <!-- Column 1: Featured Colleges -->
                        <div class="col">
                            <div class="perfect-match-box">
                                <div class="perfect-match-header">
                                    <h3 class="perfect-match-title mb-0">Featured Colleges</h3>
                                    <a href="#" class="btn-view-all-link">View all</a>
                                </div>
                                <div class="perfect-badges-grid">
                                    <span class="badge-univ-pill">Chitkara University</span>
                                    <span class="badge-univ-pill">Parul University</span>
                                    <span class="badge-univ-pill">K.R. Mangalam University</span>
                                    <span class="badge-univ-pill">Chandigarh University</span>
                                    <span class="badge-univ-pill">K.R. Mangalam University</span>
                                    <span class="badge-univ-pill">Chandigarh University</span>
                                    <span class="badge-univ-pill">Lovely University</span>
                                    <span class="badge-univ-pill">Sanskriti University</span>
                                    <span class="badge-univ-pill">Lovely University</span>
                                    <span class="badge-univ-pill">Sanskriti University</span>
                                    <span class="badge-univ-pill">Lovely University</span>
                                    <span class="badge-univ-pill">Sanskriti University</span>
                                    <span class="badge-univ-pill">Lovely University</span>
                                    <span class="badge-univ-pill">Sanskriti University</span>
                                    <span class="badge-univ-pill">Lovely University</span>
                                    <span class="badge-univ-pill">Sanskriti University</span>
                                </div>
                            </div>
                        </div>

                        <!-- Column 2: Important Exams & Top States -->
                        <div class="col">
                            <div class="d-flex flex-column gap-4 h-100">
                                <!-- Box A: Important Exams -->
                                <div class="perfect-match-box" style="flex: 1;">
                                    <div class="perfect-match-header">
                                        <h3 class="perfect-match-title mb-0">Important Exams</h3>
                                        <a href="#" class="btn-view-all-link">View all</a>
                                    </div>
                                    <div class="perfect-badges-grid">
                                        <span class="badge-univ-pill">JEE Main</span>
                                        <span class="badge-univ-pill">JEE Advanced</span>
                                        <span class="badge-univ-pill">EAMCET</span>
                                        <span class="badge-univ-pill">WBJEE</span>
                                    </div>
                                </div>
                                <!-- Box B: Top States -->
                                <div class="perfect-match-box" style="flex: 1;">
                                    <div class="perfect-match-header">
                                        <h3 class="perfect-match-title mb-0">Top States</h3>
                                        <a href="#" class="btn-view-all-link">View all</a>
                                    </div>
                                    <div class="perfect-badges-grid">
                                        <span class="badge-univ-pill">Maharashtra</span>
                                        <span class="badge-univ-pill">Tamilnadu</span>
                                        <span class="badge-univ-pill">Uttar Pradesh</span>
                                        <span class="badge-univ-pill">Punjab</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Column 3: Related Courses -->
                        <div class="col">
                            <div class="perfect-match-box">
                                <div class="perfect-match-header">
                                    <h3 class="perfect-match-title mb-0">Related Courses</h3>
                                    <a href="#" class="btn-view-all-link">View all</a>
                                </div>
                                <div class="perfect-badges-grid">
                                    <span class="badge-univ-pill">B tech</span>
                                    <span class="badge-univ-pill">M tech</span>
                                    <span class="badge-univ-pill">Bachelor of Engineering</span>
                                    <span class="badge-univ-pill">Civil Engineering</span>
                                    <span class="badge-univ-pill">Lovely University</span>
                                    <span class="badge-univ-pill">Sanskriti University</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="tab-hotel" role="tabpanel">
                    <div class="row row-cols-1 row-cols-lg-3 g-4">
                        <!-- Column 1: Featured Colleges -->
                        <div class="col">
                            <div class="perfect-match-box">
                                <div class="perfect-match-header">
                                    <h3 class="perfect-match-title mb-0">Featured Colleges</h3>
                                    <a href="#" class="btn-view-all-link">View all</a>
                                </div>
                                <div class="perfect-badges-grid">
                                    <span class="badge-univ-pill">Chitkara University</span>
                                    <span class="badge-univ-pill">Parul University</span>
                                    <span class="badge-univ-pill">K.R. Mangalam University</span>
                                    <span class="badge-univ-pill">Chandigarh University</span>
                                    <span class="badge-univ-pill">K.R. Mangalam University</span>
                                    <span class="badge-univ-pill">Chandigarh University</span>
                                    <span class="badge-univ-pill">Lovely University</span>
                                    <span class="badge-univ-pill">Sanskriti University</span>
                                    <span class="badge-univ-pill">Lovely University</span>
                                    <span class="badge-univ-pill">Sanskriti University</span>
                                    <span class="badge-univ-pill">Lovely University</span>
                                    <span class="badge-univ-pill">Sanskriti University</span>
                                    <span class="badge-univ-pill">Lovely University</span>
                                    <span class="badge-univ-pill">Sanskriti University</span>
                                    <span class="badge-univ-pill">Lovely University</span>
                                    <span class="badge-univ-pill">Sanskriti University</span>
                                </div>
                            </div>
                        </div>

                        <!-- Column 2: Important Exams & Top States -->
                        <div class="col">
                            <div class="d-flex flex-column gap-4 h-100">
                                <!-- Box A: Important Exams -->
                                <div class="perfect-match-box" style="flex: 1;">
                                    <div class="perfect-match-header">
                                        <h3 class="perfect-match-title mb-0">Important Exams</h3>
                                        <a href="#" class="btn-view-all-link">View all</a>
                                    </div>
                                    <div class="perfect-badges-grid">
                                        <span class="badge-univ-pill">JEE Main</span>
                                        <span class="badge-univ-pill">JEE Advanced</span>
                                        <span class="badge-univ-pill">EAMCET</span>
                                        <span class="badge-univ-pill">WBJEE</span>
                                    </div>
                                </div>
                                <!-- Box B: Top States -->
                                <div class="perfect-match-box" style="flex: 1;">
                                    <div class="perfect-match-header">
                                        <h3 class="perfect-match-title mb-0">Top States</h3>
                                        <a href="#" class="btn-view-all-link">View all</a>
                                    </div>
                                    <div class="perfect-badges-grid">
                                        <span class="badge-univ-pill">Maharashtra</span>
                                        <span class="badge-univ-pill">Tamilnadu</span>
                                        <span class="badge-univ-pill">Uttar Pradesh</span>
                                        <span class="badge-univ-pill">Punjab</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Column 3: Related Courses -->
                        <div class="col">
                            <div class="perfect-match-box">
                                <div class="perfect-match-header">
                                    <h3 class="perfect-match-title mb-0">Related Courses</h3>
                                    <a href="#" class="btn-view-all-link">View all</a>
                                </div>
                                <div class="perfect-badges-grid">
                                    <span class="badge-univ-pill">B tech</span>
                                    <span class="badge-univ-pill">M tech</span>
                                    <span class="badge-univ-pill">Bachelor of Engineering</span>
                                    <span class="badge-univ-pill">Civil Engineering</span>
                                    <span class="badge-univ-pill">Lovely University</span>
                                    <span class="badge-univ-pill">Sanskriti University</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="tab-it" role="tabpanel">
                    <div class="row row-cols-1 row-cols-lg-3 g-4">
                        <!-- Column 1: Featured Colleges -->
                        <div class="col">
                            <div class="perfect-match-box">
                                <div class="perfect-match-header">
                                    <h3 class="perfect-match-title mb-0">Featured Colleges</h3>
                                    <a href="#" class="btn-view-all-link">View all</a>
                                </div>
                                <div class="perfect-badges-grid">
                                    <span class="badge-univ-pill">Chitkara University</span>
                                    <span class="badge-univ-pill">Parul University</span>
                                    <span class="badge-univ-pill">K.R. Mangalam University</span>
                                    <span class="badge-univ-pill">Chandigarh University</span>
                                    <span class="badge-univ-pill">K.R. Mangalam University</span>
                                    <span class="badge-univ-pill">Chandigarh University</span>
                                    <span class="badge-univ-pill">Lovely University</span>
                                    <span class="badge-univ-pill">Sanskriti University</span>
                                    <span class="badge-univ-pill">Lovely University</span>
                                    <span class="badge-univ-pill">Sanskriti University</span>
                                    <span class="badge-univ-pill">Lovely University</span>
                                    <span class="badge-univ-pill">Sanskriti University</span>
                                    <span class="badge-univ-pill">Lovely University</span>
                                    <span class="badge-univ-pill">Sanskriti University</span>
                                    <span class="badge-univ-pill">Lovely University</span>
                                    <span class="badge-univ-pill">Sanskriti University</span>
                                </div>
                            </div>
                        </div>

                        <!-- Column 2: Important Exams & Top States -->
                        <div class="col">
                            <div class="d-flex flex-column gap-4 h-100">
                                <!-- Box A: Important Exams -->
                                <div class="perfect-match-box" style="flex: 1;">
                                    <div class="perfect-match-header">
                                        <h3 class="perfect-match-title mb-0">Important Exams</h3>
                                        <a href="#" class="btn-view-all-link">View all</a>
                                    </div>
                                    <div class="perfect-badges-grid">
                                        <span class="badge-univ-pill">JEE Main</span>
                                        <span class="badge-univ-pill">JEE Advanced</span>
                                        <span class="badge-univ-pill">EAMCET</span>
                                        <span class="badge-univ-pill">WBJEE</span>
                                    </div>
                                </div>
                                <!-- Box B: Top States -->
                                <div class="perfect-match-box" style="flex: 1;">
                                    <div class="perfect-match-header">
                                        <h3 class="perfect-match-title mb-0">Top States</h3>
                                        <a href="#" class="btn-view-all-link">View all</a>
                                    </div>
                                    <div class="perfect-badges-grid">
                                        <span class="badge-univ-pill">Maharashtra</span>
                                        <span class="badge-univ-pill">Tamilnadu</span>
                                        <span class="badge-univ-pill">Uttar Pradesh</span>
                                        <span class="badge-univ-pill">Punjab</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Column 3: Related Courses -->
                        <div class="col">
                            <div class="perfect-match-box">
                                <div class="perfect-match-header">
                                    <h3 class="perfect-match-title mb-0">Related Courses</h3>
                                    <a href="#" class="btn-view-all-link">View all</a>
                                </div>
                                <div class="perfect-badges-grid">
                                    <span class="badge-univ-pill">B tech</span>
                                    <span class="badge-univ-pill">M tech</span>
                                    <span class="badge-univ-pill">Bachelor of Engineering</span>
                                    <span class="badge-univ-pill">Civil Engineering</span>
                                    <span class="badge-univ-pill">Lovely University</span>
                                    <span class="badge-univ-pill">Sanskriti University</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="tab-arts" role="tabpanel">
                    <div class="row row-cols-1 row-cols-lg-3 g-4">
                        <!-- Column 1: Featured Colleges -->
                        <div class="col">
                            <div class="perfect-match-box">
                                <div class="perfect-match-header">
                                    <h3 class="perfect-match-title mb-0">Featured Colleges</h3>
                                    <a href="#" class="btn-view-all-link">View all</a>
                                </div>
                                <div class="perfect-badges-grid">
                                    <span class="badge-univ-pill">Chitkara University</span>
                                    <span class="badge-univ-pill">Parul University</span>
                                    <span class="badge-univ-pill">K.R. Mangalam University</span>
                                    <span class="badge-univ-pill">Chandigarh University</span>
                                    <span class="badge-univ-pill">K.R. Mangalam University</span>
                                    <span class="badge-univ-pill">Chandigarh University</span>
                                    <span class="badge-univ-pill">Lovely University</span>
                                    <span class="badge-univ-pill">Sanskriti University</span>
                                    <span class="badge-univ-pill">Lovely University</span>
                                    <span class="badge-univ-pill">Sanskriti University</span>
                                    <span class="badge-univ-pill">Lovely University</span>
                                    <span class="badge-univ-pill">Sanskriti University</span>
                                    <span class="badge-univ-pill">Lovely University</span>
                                    <span class="badge-univ-pill">Sanskriti University</span>
                                    <span class="badge-univ-pill">Lovely University</span>
                                    <span class="badge-univ-pill">Sanskriti University</span>
                                </div>
                            </div>
                        </div>

                        <!-- Column 2: Important Exams & Top States -->
                        <div class="col">
                            <div class="d-flex flex-column gap-4 h-100">
                                <!-- Box A: Important Exams -->
                                <div class="perfect-match-box" style="flex: 1;">
                                    <div class="perfect-match-header">
                                        <h3 class="perfect-match-title mb-0">Important Exams</h3>
                                        <a href="#" class="btn-view-all-link">View all</a>
                                    </div>
                                    <div class="perfect-badges-grid">
                                        <span class="badge-univ-pill">JEE Main</span>
                                        <span class="badge-univ-pill">JEE Advanced</span>
                                        <span class="badge-univ-pill">EAMCET</span>
                                        <span class="badge-univ-pill">WBJEE</span>
                                    </div>
                                </div>
                                <!-- Box B: Top States -->
                                <div class="perfect-match-box" style="flex: 1;">
                                    <div class="perfect-match-header">
                                        <h3 class="perfect-match-title mb-0">Top States</h3>
                                        <a href="#" class="btn-view-all-link">View all</a>
                                    </div>
                                    <div class="perfect-badges-grid">
                                        <span class="badge-univ-pill">Maharashtra</span>
                                        <span class="badge-univ-pill">Tamilnadu</span>
                                        <span class="badge-univ-pill">Uttar Pradesh</span>
                                        <span class="badge-univ-pill">Punjab</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Column 3: Related Courses -->
                        <div class="col">
                            <div class="perfect-match-box">
                                <div class="perfect-match-header">
                                    <h3 class="perfect-match-title mb-0">Related Courses</h3>
                                    <a href="#" class="btn-view-all-link">View all</a>
                                </div>
                                <div class="perfect-badges-grid">
                                    <span class="badge-univ-pill">B tech</span>
                                    <span class="badge-univ-pill">M tech</span>
                                    <span class="badge-univ-pill">Bachelor of Engineering</span>
                                    <span class="badge-univ-pill">Civil Engineering</span>
                                    <span class="badge-univ-pill">Lovely University</span>
                                    <span class="badge-univ-pill">Sanskriti University</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="tab-agri" role="tabpanel">
                    <div class="row row-cols-1 row-cols-lg-3 g-4">
                        <!-- Column 1: Featured Colleges -->
                        <div class="col">
                            <div class="perfect-match-box">
                                <div class="perfect-match-header">
                                    <h3 class="perfect-match-title mb-0">Featured Colleges</h3>
                                    <a href="#" class="btn-view-all-link">View all</a>
                                </div>
                                <div class="perfect-badges-grid">
                                    <span class="badge-univ-pill">Chitkara University</span>
                                    <span class="badge-univ-pill">Parul University</span>
                                    <span class="badge-univ-pill">K.R. Mangalam University</span>
                                    <span class="badge-univ-pill">Chandigarh University</span>
                                    <span class="badge-univ-pill">K.R. Mangalam University</span>
                                    <span class="badge-univ-pill">Chandigarh University</span>
                                    <span class="badge-univ-pill">Lovely University</span>
                                    <span class="badge-univ-pill">Sanskriti University</span>
                                    <span class="badge-univ-pill">Lovely University</span>
                                    <span class="badge-univ-pill">Sanskriti University</span>
                                    <span class="badge-univ-pill">Lovely University</span>
                                    <span class="badge-univ-pill">Sanskriti University</span>
                                    <span class="badge-univ-pill">Lovely University</span>
                                    <span class="badge-univ-pill">Sanskriti University</span>
                                    <span class="badge-univ-pill">Lovely University</span>
                                    <span class="badge-univ-pill">Sanskriti University</span>
                                </div>
                            </div>
                        </div>

                        <!-- Column 2: Important Exams & Top States -->
                        <div class="col">
                            <div class="d-flex flex-column gap-4 h-100">
                                <!-- Box A: Important Exams -->
                                <div class="perfect-match-box" style="flex: 1;">
                                    <div class="perfect-match-header">
                                        <h3 class="perfect-match-title mb-0">Important Exams</h3>
                                        <a href="#" class="btn-view-all-link">View all</a>
                                    </div>
                                    <div class="perfect-badges-grid">
                                        <span class="badge-univ-pill">JEE Main</span>
                                        <span class="badge-univ-pill">JEE Advanced</span>
                                        <span class="badge-univ-pill">EAMCET</span>
                                        <span class="badge-univ-pill">WBJEE</span>
                                    </div>
                                </div>
                                <!-- Box B: Top States -->
                                <div class="perfect-match-box" style="flex: 1;">
                                    <div class="perfect-match-header">
                                        <h3 class="perfect-match-title mb-0">Top States</h3>
                                        <a href="#" class="btn-view-all-link">View all</a>
                                    </div>
                                    <div class="perfect-badges-grid">
                                        <span class="badge-univ-pill">Maharashtra</span>
                                        <span class="badge-univ-pill">Tamilnadu</span>
                                        <span class="badge-univ-pill">Uttar Pradesh</span>
                                        <span class="badge-univ-pill">Punjab</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Column 3: Related Courses -->
                        <div class="col">
                            <div class="perfect-match-box">
                                <div class="perfect-match-header">
                                    <h3 class="perfect-match-title mb-0">Related Courses</h3>
                                    <a href="#" class="btn-view-all-link">View all</a>
                                </div>
                                <div class="perfect-badges-grid">
                                    <span class="badge-univ-pill">B tech</span>
                                    <span class="badge-univ-pill">M tech</span>
                                    <span class="badge-univ-pill">Bachelor of Engineering</span>
                                    <span class="badge-univ-pill">Civil Engineering</span>
                                    <span class="badge-univ-pill">Lovely University</span>
                                    <span class="badge-univ-pill">Sanskriti University</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="tab-law" role="tabpanel">
                    <div class="row row-cols-1 row-cols-lg-3 g-4">
                        <!-- Column 1: Featured Colleges -->
                        <div class="col">
                            <div class="perfect-match-box">
                                <div class="perfect-match-header">
                                    <h3 class="perfect-match-title mb-0">Featured Colleges</h3>
                                    <a href="#" class="btn-view-all-link">View all</a>
                                </div>
                                <div class="perfect-badges-grid">
                                    <span class="badge-univ-pill">Chitkara University</span>
                                    <span class="badge-univ-pill">Parul University</span>
                                    <span class="badge-univ-pill">K.R. Mangalam University</span>
                                    <span class="badge-univ-pill">Chandigarh University</span>
                                    <span class="badge-univ-pill">K.R. Mangalam University</span>
                                    <span class="badge-univ-pill">Chandigarh University</span>
                                    <span class="badge-univ-pill">Lovely University</span>
                                    <span class="badge-univ-pill">Sanskriti University</span>
                                    <span class="badge-univ-pill">Lovely University</span>
                                    <span class="badge-univ-pill">Sanskriti University</span>
                                    <span class="badge-univ-pill">Lovely University</span>
                                    <span class="badge-univ-pill">Sanskriti University</span>
                                    <span class="badge-univ-pill">Lovely University</span>
                                    <span class="badge-univ-pill">Sanskriti University</span>
                                    <span class="badge-univ-pill">Lovely University</span>
                                    <span class="badge-univ-pill">Sanskriti University</span>
                                </div>
                            </div>
                        </div>

                        <!-- Column 2: Important Exams & Top States -->
                        <div class="col">
                            <div class="d-flex flex-column gap-4 h-100">
                                <!-- Box A: Important Exams -->
                                <div class="perfect-match-box" style="flex: 1;">
                                    <div class="perfect-match-header">
                                        <h3 class="perfect-match-title mb-0">Important Exams</h3>
                                        <a href="#" class="btn-view-all-link">View all</a>
                                    </div>
                                    <div class="perfect-badges-grid">
                                        <span class="badge-univ-pill">JEE Main</span>
                                        <span class="badge-univ-pill">JEE Advanced</span>
                                        <span class="badge-univ-pill">EAMCET</span>
                                        <span class="badge-univ-pill">WBJEE</span>
                                    </div>
                                </div>
                                <!-- Box B: Top States -->
                                <div class="perfect-match-box" style="flex: 1;">
                                    <div class="perfect-match-header">
                                        <h3 class="perfect-match-title mb-0">Top States</h3>
                                        <a href="#" class="btn-view-all-link">View all</a>
                                    </div>
                                    <div class="perfect-badges-grid">
                                        <span class="badge-univ-pill">Maharashtra</span>
                                        <span class="badge-univ-pill">Tamilnadu</span>
                                        <span class="badge-univ-pill">Uttar Pradesh</span>
                                        <span class="badge-univ-pill">Punjab</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Column 3: Related Courses -->
                        <div class="col">
                            <div class="perfect-match-box">
                                <div class="perfect-match-header">
                                    <h3 class="perfect-match-title mb-0">Related Courses</h3>
                                    <a href="#" class="btn-view-all-link">View all</a>
                                </div>
                                <div class="perfect-badges-grid">
                                    <span class="badge-univ-pill">B tech</span>
                                    <span class="badge-univ-pill">M tech</span>
                                    <span class="badge-univ-pill">Bachelor of Engineering</span>
                                    <span class="badge-univ-pill">Civil Engineering</span>
                                    <span class="badge-univ-pill">Lovely University</span>
                                    <span class="badge-univ-pill">Sanskriti University</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="tab-pharmacy" role="tabpanel">
                    <div class="row row-cols-1 row-cols-lg-3 g-4">
                        <!-- Column 1: Featured Colleges -->
                        <div class="col">
                            <div class="perfect-match-box">
                                <div class="perfect-match-header">
                                    <h3 class="perfect-match-title mb-0">Featured Colleges</h3>
                                    <a href="#" class="btn-view-all-link">View all</a>
                                </div>
                                <div class="perfect-badges-grid">
                                    <span class="badge-univ-pill">Chitkara University</span>
                                    <span class="badge-univ-pill">Parul University</span>
                                    <span class="badge-univ-pill">K.R. Mangalam University</span>
                                    <span class="badge-univ-pill">Chandigarh University</span>
                                    <span class="badge-univ-pill">K.R. Mangalam University</span>
                                    <span class="badge-univ-pill">Chandigarh University</span>
                                    <span class="badge-univ-pill">Lovely University</span>
                                    <span class="badge-univ-pill">Sanskriti University</span>
                                    <span class="badge-univ-pill">Lovely University</span>
                                    <span class="badge-univ-pill">Sanskriti University</span>
                                    <span class="badge-univ-pill">Lovely University</span>
                                    <span class="badge-univ-pill">Sanskriti University</span>
                                    <span class="badge-univ-pill">Lovely University</span>
                                    <span class="badge-univ-pill">Sanskriti University</span>
                                    <span class="badge-univ-pill">Lovely University</span>
                                    <span class="badge-univ-pill">Sanskriti University</span>
                                </div>
                            </div>
                        </div>

                        <!-- Column 2: Important Exams & Top States -->
                        <div class="col">
                            <div class="d-flex flex-column gap-4 h-100">
                                <!-- Box A: Important Exams -->
                                <div class="perfect-match-box" style="flex: 1;">
                                    <div class="perfect-match-header">
                                        <h3 class="perfect-match-title mb-0">Important Exams</h3>
                                        <a href="#" class="btn-view-all-link">View all</a>
                                    </div>
                                    <div class="perfect-badges-grid">
                                        <span class="badge-univ-pill">JEE Main</span>
                                        <span class="badge-univ-pill">JEE Advanced</span>
                                        <span class="badge-univ-pill">EAMCET</span>
                                        <span class="badge-univ-pill">WBJEE</span>
                                    </div>
                                </div>
                                <!-- Box B: Top States -->
                                <div class="perfect-match-box" style="flex: 1;">
                                    <div class="perfect-match-header">
                                        <h3 class="perfect-match-title mb-0">Top States</h3>
                                        <a href="#" class="btn-view-all-link">View all</a>
                                    </div>
                                    <div class="perfect-badges-grid">
                                        <span class="badge-univ-pill">Maharashtra</span>
                                        <span class="badge-univ-pill">Tamilnadu</span>
                                        <span class="badge-univ-pill">Uttar Pradesh</span>
                                        <span class="badge-univ-pill">Punjab</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Column 3: Related Courses -->
                        <div class="col">
                            <div class="perfect-match-box">
                                <div class="perfect-match-header">
                                    <h3 class="perfect-match-title mb-0">Related Courses</h3>
                                    <a href="#" class="btn-view-all-link">View all</a>
                                </div>
                                <div class="perfect-badges-grid">
                                    <span class="badge-univ-pill">B tech</span>
                                    <span class="badge-univ-pill">M tech</span>
                                    <span class="badge-univ-pill">Bachelor of Engineering</span>
                                    <span class="badge-univ-pill">Civil Engineering</span>
                                    <span class="badge-univ-pill">Lovely University</span>
                                    <span class="badge-univ-pill">Sanskriti University</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="tab-education" role="tabpanel">
                    <div class="row row-cols-1 row-cols-lg-3 g-4">
                        <!-- Column 1: Featured Colleges -->
                        <div class="col">
                            <div class="perfect-match-box">
                                <div class="perfect-match-header">
                                    <h3 class="perfect-match-title mb-0">Featured Colleges</h3>
                                    <a href="#" class="btn-view-all-link">View all</a>
                                </div>
                                <div class="perfect-badges-grid">
                                    <span class="badge-univ-pill">Chitkara University</span>
                                    <span class="badge-univ-pill">Parul University</span>
                                    <span class="badge-univ-pill">K.R. Mangalam University</span>
                                    <span class="badge-univ-pill">Chandigarh University</span>
                                    <span class="badge-univ-pill">K.R. Mangalam University</span>
                                    <span class="badge-univ-pill">Chandigarh University</span>
                                    <span class="badge-univ-pill">Lovely University</span>
                                    <span class="badge-univ-pill">Sanskriti University</span>
                                    <span class="badge-univ-pill">Lovely University</span>
                                    <span class="badge-univ-pill">Sanskriti University</span>
                                    <span class="badge-univ-pill">Lovely University</span>
                                    <span class="badge-univ-pill">Sanskriti University</span>
                                    <span class="badge-univ-pill">Lovely University</span>
                                    <span class="badge-univ-pill">Sanskriti University</span>
                                    <span class="badge-univ-pill">Lovely University</span>
                                    <span class="badge-univ-pill">Sanskriti University</span>
                                </div>
                            </div>
                        </div>

                        <!-- Column 2: Important Exams & Top States -->
                        <div class="col">
                            <div class="d-flex flex-column gap-4 h-100">
                                <!-- Box A: Important Exams -->
                                <div class="perfect-match-box" style="flex: 1;">
                                    <div class="perfect-match-header">
                                        <h3 class="perfect-match-title mb-0">Important Exams</h3>
                                        <a href="#" class="btn-view-all-link">View all</a>
                                    </div>
                                    <div class="perfect-badges-grid">
                                        <span class="badge-univ-pill">JEE Main</span>
                                        <span class="badge-univ-pill">JEE Advanced</span>
                                        <span class="badge-univ-pill">EAMCET</span>
                                        <span class="badge-univ-pill">WBJEE</span>
                                    </div>
                                </div>
                                <!-- Box B: Top States -->
                                <div class="perfect-match-box" style="flex: 1;">
                                    <div class="perfect-match-header">
                                        <h3 class="perfect-match-title mb-0">Top States</h3>
                                        <a href="#" class="btn-view-all-link">View all</a>
                                    </div>
                                    <div class="perfect-badges-grid">
                                        <span class="badge-univ-pill">Maharashtra</span>
                                        <span class="badge-univ-pill">Tamilnadu</span>
                                        <span class="badge-univ-pill">Uttar Pradesh</span>
                                        <span class="badge-univ-pill">Punjab</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Column 3: Related Courses -->
                        <div class="col">
                            <div class="perfect-match-box">
                                <div class="perfect-match-header">
                                    <h3 class="perfect-match-title mb-0">Related Courses</h3>
                                    <a href="#" class="btn-view-all-link">View all</a>
                                </div>
                                <div class="perfect-badges-grid">
                                    <span class="badge-univ-pill">B tech</span>
                                    <span class="badge-univ-pill">M tech</span>
                                    <span class="badge-univ-pill">Bachelor of Engineering</span>
                                    <span class="badge-univ-pill">Civil Engineering</span>
                                    <span class="badge-univ-pill">Lovely University</span>
                                    <span class="badge-univ-pill">Sanskriti University</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="compare-banner">
        <div class="container">
            <div class="row align-items-center g-4">
                <div class="col-md-8 d-flex align-items-center gap-4 flex-wrap flex-md-nowrap">
                    <div class="qa-avatars-row">
                        <img src="assets/images/compare-banner-img.png" alt="">
                    </div>
                    <div>
                        <h3 class="compare-banner-heading">Confused Between Colleges?</h3>
                        <p class="compare-banner-sub mb-0">Compare fees, placements & courses in one-click!</p>
                    </div>
                </div>
                <div class="col-md-4 text-md-end">
                    <a href="#" class="btn btn-enrollzy btn-enrollzy-white btn-enrollzy-md">
                        Compare Now
                        <i class="fa-solid fa-arrow-right-long" style="color: #000;"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Compare Banner & Trending Courses Section -->
    <section class="compare-courses-section ptb-70">
        <div class="container">
            <!-- Part A: Confused Between Colleges Banner -->


            <!-- Part B: Trending Courses -->
            <div class="text-center" style="margin-bottom: 57px;">
                <span class="marketplace-badge mb-3">Trending Courses</span>
                <div class="heading-with-lines d-flex align-items-center justify-content-center gap-3 mb-3">
                    <span class="heading-line d-none d-md-block"></span>
                    <h2 class="section-title mb-0">Build skills employers actually want</h2>
                    <span class="heading-line d-none d-md-block"></span>
                </div>
                <p class="section-subtitle mx-auto text-muted" style="max-width: 900px;">
                    Prepare for the top competitive exams in the country.
                </p>
            </div>

            <!-- Course Cards Grid -->
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-6 g-3 mb-5">
                <!-- Course 1 -->
                <div class="col">
                    <div class="course-card">
                        <img src="assets/images/training-course-img.png" alt="Course circular icon"
                            class="course-img-circular">
                        <h3 class="course-title">AI & Machine Learning</h3>
                        <span class="course-instructor">Andrew Ng · Coursera</span>
                        <div class="course-footer">
                            <span class="star-rating">★★★★★ <span class="text-dark">4.9</span></span>
                            <span class="text-primary">₹3,499</span>
                        </div>
                    </div>
                </div>
                <!-- Course 2 -->
                <div class="col">
                    <div class="course-card">
                        <img src="assets/images/training-course-img.png" alt="Course circular icon"
                            class="course-img-circular">
                        <h3 class="course-title">Full Stack Web Dev</h3>
                        <span class="course-instructor">Andrew Ng · Coursera</span>
                        <div class="course-footer">
                            <span class="star-rating">★★★★★ <span class="text-dark">4.9</span></span>
                            <span class="text-primary">₹3,499</span>
                        </div>
                    </div>
                </div>
                <!-- Course 3 -->
                <div class="col">
                    <div class="course-card">
                        <img src="assets/images/training-course-img.png" alt="Course circular icon"
                            class="course-img-circular">
                        <h3 class="course-title">Full Stack Web Dev</h3>
                        <span class="course-instructor">Andrew Ng · Coursera</span>
                        <div class="course-footer">
                            <span class="star-rating">★★★★★ <span class="text-dark">4.9</span></span>
                            <span class="text-primary">₹3,499</span>
                        </div>
                    </div>
                </div>
                <!-- Course 4 -->
                <div class="col">
                    <div class="course-card">
                        <img src="assets/images/training-course-img.png" alt="Course circular icon"
                            class="course-img-circular">
                        <h3 class="course-title">UI/UX Design</h3>
                        <span class="course-instructor">Andrew Ng · Coursera</span>
                        <div class="course-footer">
                            <span class="star-rating">★★★★★ <span class="text-dark">4.9</span></span>
                            <span class="text-primary">₹3,499</span>
                        </div>
                    </div>
                </div>
                <!-- Course 5 -->
                <div class="col">
                    <div class="course-card">
                        <img src="assets/images/training-course-img.png" alt="Course circular icon"
                            class="course-img-circular">
                        <h3 class="course-title">Digital Marketing</h3>
                        <span class="course-instructor">Andrew Ng · Coursera</span>
                        <div class="course-footer">
                            <span class="star-rating">★★★★★ <span class="text-dark">4.9</span></span>
                            <span class="text-primary">₹3,499</span>
                        </div>
                    </div>
                </div>
                <!-- Course 6 -->
                <div class="col">
                    <div class="course-card">
                        <img src="assets/images/training-course-img.png" alt="Course circular icon"
                            class="course-img-circular">
                        <h3 class="course-title">AI & Machine Learning</h3>
                        <span class="course-instructor">Andrew Ng · Coursera</span>
                        <div class="course-footer">
                            <span class="star-rating">★★★★★ <span class="text-dark">4.9</span></span>
                            <span class="text-primary">₹3,499</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- View More Button -->
            <div class="text-center">
                <button class="btn btn-enrollzy btn-enrollzy-lg" type="button">
                    View More
                    <i class="fa-solid fa-arrow-right-long" style="color: #fff;"></i>
                </button>
            </div>
        </div>
    </section>


    <!-- Let's Get in Touch Section -->

    <section class="contact-section ptb-70">
        <div class="container">
            <div class="row g-5 align-items-center">
                <!-- Left Column: Sliced Photo + Overlays -->
                <div class="col-lg-5">
                    <div class="contact-sliced-container">
                        <img src="assets/images/get-in-touch-img.png" alt="">
                    </div>
                </div>

                <!-- Right Column: Let's Get in Touch Form -->
                <div class="col-lg-7">
                    <div class="contact-form-wrapper p-4 p-md-5 rounded-4 shadow-sm border">
                        <h2 class="section-title mb-2 text-start" style="font-size: 2.2rem;">Let’s Get in Touch</h2>
                        <p class="text-muted mb-4">Leave us a message and our advisors will get back to you shortly.
                        </p>

                        <form>
                            <div class="row g-3 mb-3">
                                <div class="col-md-6">
                                    <label for="studentName" class="form-label">Student Name</label>
                                    <input type="text" class="form-control" id="studentName"
                                        placeholder="Enter your name">
                                </div>
                                <div class="col-md-6">
                                    <label for="studentPhone" class="form-label">Student Phone Number</label>
                                    <input type="tel" class="form-control" id="studentPhone"
                                        placeholder="Enter your Phone Number">
                                </div>
                            </div>
                            <div class="row g-3 mb-4">
                                <div class="col-md-6">
                                    <label for="lookingFor" class="form-label">I'm looking for</label>
                                    <select class="form-select" id="lookingFor">
                                        <option selected>School Admission</option>
                                        <option value="1">Coaching Institutes</option>
                                        <option value="2">Scholarships Info</option>
                                        <option value="3">1:1 Mentorship</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="sessionTime" class="form-label">Preferred session time</label>
                                    <select class="form-select" id="sessionTime">
                                        <option selected>Today, 3PM - 5PM</option>
                                        <option value="1">Tomorrow, 10AM - 12PM</option>
                                        <option value="2">Tomorrow, 3PM - 5PM</option>
                                        <option value="3">Saturday, 11AM - 1PM</option>
                                    </select>
                                </div>
                            </div>
                            <div class=" text-center">
                                <button type="submit" class="btn btn-enrollzy btn-enrollzy-lg">
                                    Book my free session
                                    <i class="fa-solid fa-arrow-right-long"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>



    <!-- Curved Footer Section -->
@endsection
