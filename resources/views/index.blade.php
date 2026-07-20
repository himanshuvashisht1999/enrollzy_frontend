@extends('layouts.app')
@section('content')
    <!-- Main Content Section -->
    <main class="pb-5 hero-sec">
        @php
            $firstHero = $heroSliders->first();
        @endphp
        <div class="bg-square">
            <img src="assets/images/banner-square-img.svg" alt="">
        </div>
        <div class="container position-relative">
            <div class="row align-items-center">
                <!-- Left Column (Content & Search) -->
                <div class="col-lg-6 col-12 text-center text-lg-start">
                    <!-- Marketplace Badge -->
                    <div class="mb-4">
                        <span
                            class="marketplace-badge">{{ $firstHero->badge_text ?? "India's no.1 Education Market place" }}</span>
                    </div>

                    <!-- Main Heading -->
                    <h1 class="hero-title">
                        {!! $firstHero->heading ?? 'Find your path.<br><span class="text-orange">Learn, Apply,</span><br><span class="fst-italic">Get Hired.</span>' !!}
                    </h1>
                    @if(!empty($firstHero->subheading))
                        <div class="hero-subtitle mb-4">
                            {!! $firstHero->subheading !!}
                        </div>
                    @endif

                    <!-- Search Capsule -->
                    <form action="{{ route('global.search') }}" method="GET" class="search-bar-container mx-auto mx-lg-0">
                        <div class="dropdown">
                            <button class="search-dropdown" type="button" id="searchFilterDropdown"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <span id="searchFilterLabel">Looking for..</span>
                                <i class="fa-solid fa-chevron-down" style="color: rgb(0, 0, 0);"></i>
                            </button>
                            <ul class="dropdown-menu border-0 shadow-sm" aria-labelledby="searchFilterDropdown">
                                <li><a class="dropdown-item" href="javascript:void(0)"
                                        onclick="document.getElementById('searchType').value='colleges'; document.getElementById('searchFilterLabel').innerText='Colleges';">Colleges</a>
                                </li>
                                <li><a class="dropdown-item" href="javascript:void(0)"
                                        onclick="document.getElementById('searchType').value='courses'; document.getElementById('searchFilterLabel').innerText='Courses';">Courses</a>
                                </li>
                                <li><a class="dropdown-item" href="javascript:void(0)"
                                        onclick="document.getElementById('searchType').value='mentors'; document.getElementById('searchFilterLabel').innerText='Mentors';">Mentors</a>
                                </li>
                                <li><a class="dropdown-item" href="javascript:void(0)"
                                        onclick="document.getElementById('searchType').value='schools'; document.getElementById('searchFilterLabel').innerText='Schools';">Schools</a>
                                </li>
                            </ul>
                            <input type="hidden" name="type" id="searchType" value="">
                        </div>

                        <input type="text" name="q" class="search-input" placeholder="Search courses, colleges, mentor"
                            aria-label="Search text">
                        <button class="search-btn" type="submit" aria-label="Submit Search">
                            Search
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-arrow-right" viewBox="0 0 16 16">
                                <path fill-rule="evenodd"
                                    d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8" />
                            </svg>
                        </button>
                    </form>

                    <!-- Search Tags -->
                    <div class=" d-flex flex-wrap justify-content-center justify-content-lg-start"
                        style="margin-bottom:41px">
                        <a href="{{ route('university') }}" class="tag-pill">Top University</a>
                        <a href="{{ route('all-schools') }}" class="tag-pill">Top Schools</a>
                        <a href="{{ route('top-exams') }}" class="tag-pill">Top Exams</a>
                        <a href="{{ route('all.coaching') }}" class="tag-pill">Top Courses</a>
                    </div>

                    <!-- Statistics Cards -->
                    <div class="stats-container mb-4">
                        <div class="stat-card">
                            <span
                                class="stat-number">{{ isset($firstHero->stat_1_count) && !empty($firstHero->stat_1_count) ? $firstHero->stat_1_count : ($totalInstitutionsCount > 0 ? $totalInstitutionsCount . '+' : '2800+') }}</span>
                            <span
                                class="stat-label">{{ isset($firstHero->stat_1_label) && !empty($firstHero->stat_1_label) ? $firstHero->stat_1_label : 'Institution' }}</span>
                        </div>
                        <div class="stat-card">
                            <span
                                class="stat-number">{{ isset($firstHero->stat_2_count) && !empty($firstHero->stat_2_count) ? $firstHero->stat_2_count : ($totalLeadsCount > 0 ? $totalLeadsCount . '+' : '1.2L+') }}</span>
                            <span
                                class="stat-label">{{ isset($firstHero->stat_2_label) && !empty($firstHero->stat_2_label) ? $firstHero->stat_2_label : 'Student Enrolled' }}</span>
                        </div>
                        <div class="stat-card">
                            <span
                                class="stat-number">{{ isset($firstHero->stat_3_count) && !empty($firstHero->stat_3_count) ? $firstHero->stat_3_count : ($totalExamsCount > 0 ? $totalExamsCount . '+' : '4500+') }}</span>
                            <span
                                class="stat-label">{{ isset($firstHero->stat_3_label) && !empty($firstHero->stat_3_label) ? $firstHero->stat_3_label : "Scholarship's" }}</span>
                        </div>
                    </div>
                </div>

                <!-- Right Column (Carousel Slider) -->
                <div class="col-lg-6 col-12 d-flex flex-column align-items-center">
                    <div class="hero-image-card swiper hero-swiper mb-4" style="overflow: hidden;">
                        <div class="swiper-wrapper">
                            @if($heroSliders->count() > 0)
                                @foreach($heroSliders as $slider)
                                    <div class="swiper-slide d-flex align-items-center justify-content-center">
                                        <img src="{{ env('BACKEND_URL') . '/' . $slider->image_path }}" alt="{{ $slider->heading }}"
                                            class="img-fluid hero-slide-img"
                                            style="border-radius: 20px; object-fit: cover; width: 100%; height: 100%;">
                                    </div>
                                @endforeach
                            @else
                                <!-- Fallback if no dynamic slides -->
                                <div class="swiper-slide d-flex align-items-center justify-content-center">
                                    <img src="assets/images/banner-image.svg" alt="Futuristic Glowing Cybernetic Hand"
                                        class="img-fluid hero-slide-img"
                                        style="border-radius: 20px; object-fit: cover; width: 100%; height: 100%;">
                                </div>
                                <div class="swiper-slide d-flex align-items-center justify-content-center">
                                    <img src="assets/images/banner-image.svg" alt="Expert Mentor"
                                        class="img-fluid hero-slide-img"
                                        style="border-radius: 20px; object-fit: cover; width: 100%; height: 100%;">
                                </div>
                            @endif
                        </div>
                        <!-- Carousel Navigation -->
                        <div class="d-flex justify-content-center mt-3">
                            <div class="carousel-dots d-flex gap-2">
                                <!-- Swiper pagination will be generated here -->
                            </div>
                        </div>
                    </div>
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
                            <img src="{{ asset('assets/images/education-list-icon.svg') }}" alt="">
                        </div>
                        <h3 class="category-name">Schools</h3>
                        <span class="category-count">{{ $schoolsCount ?? 0 }}+ listed</span>
                    </div>
                </div>

                <!-- Row 1, Card 2: Coaching -->
                <div class="col">
                    <div class="category-card">
                        <div class="category-icon-wrapper" style="background-color: #09FF6333;">
                            <img src="{{ asset('assets/images/education-list-icon.svg') }}" alt="">
                        </div>
                        <h3 class="category-name">Coaching</h3>
                        <span class="category-count">{{ $coachingCount ?? 0 }}+ listed</span>
                    </div>
                </div>

                <!-- Row 1, Card 3: Universities -->
                <div class="col">
                    <div class="category-card">
                        <div class="category-icon-wrapper" style="background-color: #83CBFF33;">
                            <img src="{{ asset('assets/images/education-list-icon.svg') }}" alt="">
                        </div>
                        <h3 class="category-name">Universities</h3>
                        <span class="category-count">{{ $universitiesCount ?? 0 }}+ listed</span>
                    </div>
                </div>

                <!-- Row 1, Card 4: Mentors -->
                <div class="col">
                    <div class="category-card">
                        <div class="category-icon-wrapper" style="background-color: #FFCC0033;">
                            <img src="{{ asset('assets/images/education-list-icon.svg') }}" alt="">
                        </div>
                        <h3 class="category-name">Mentors</h3>
                        <span class="category-count">{{ $mentorsCount ?? 0 }}+ listed</span>
                    </div>
                </div>

                <!-- Row 1, Card 5: Scholarships -->
                <div class="col">
                    <div class="category-card">
                        <div class="category-icon-wrapper" style="background-color:#FCD8CB33;">
                            <img src="{{ asset('assets/images/education-list-icon.svg') }}" alt="">
                        </div>
                        <h3 class="category-name">Scholarships</h3>
                        <span class="category-count">850+ listed</span>
                    </div>
                </div>

                <!-- Row 1, Card 6: Internships -->
                <div class="col">
                    <div class="category-card">
                        <div class="category-icon-wrapper" style="background-color:#FCD8CB33;">
                            <img src="{{ asset('assets/images/education-list-icon.svg') }}" alt="">
                        </div>
                        <h3 class="category-name">Internships</h3>
                        <span class="category-count">4500+ listed</span>
                    </div>
                </div>

                <!-- Row 1, Card 7: Schools (Duplicate in design) -->
                <div class="col">
                    <div class="category-card">
                        <div class="category-icon-wrapper" style="background-color:#FCD8CB33;">
                            <img src="{{ asset('assets/images/education-list-icon.svg') }}" alt="">
                        </div>
                        <h3 class="category-name">Schools</h3>
                        <span class="category-count">{{ $schoolsCount ?? 0 }}+ listed</span>
                    </div>
                </div>

                <!-- Row 2, Card 8: Schools -->
                <div class="col">
                    <div class="category-card">
                        <div class="category-icon-wrapper " style="background-color:#FCD8CB33;">
                            <img src="{{ asset('assets/images/education-list-icon.svg') }}" alt="">
                        </div>
                        <h3 class="category-name">Schools</h3>
                        <span class="category-count">{{ $schoolsCount ?? 0 }}+ listed</span>
                    </div>
                </div>

                <!-- Row 2, Card 9: Coaching -->
                <div class="col">
                    <div class="category-card">
                        <div class="category-icon-wrapper" style="background-color: #09FF6333;">
                            <img src="{{ asset('assets/images/education-list-icon.svg') }}" alt="">
                        </div>
                        <h3 class="category-name">Coaching</h3>
                        <span class="category-count">{{ $coachingCount ?? 0 }}+ listed</span>
                    </div>
                </div>

                <!-- Row 2, Card 10: Universities -->
                <div class="col">
                    <div class="category-card">
                        <div class="category-icon-wrapper" style="background-color: #83CBFF33;">
                            <img src="{{ asset('assets/images/education-list-icon.svg') }}" alt="">
                        </div>
                        <h3 class="category-name">Universities</h3>
                        <span class="category-count">{{ $universitiesCount ?? 0 }}+ listed</span>
                    </div>
                </div>

                <!-- Row 2, Card 11: Mentors -->
                <div class="col">
                    <div class="category-card">
                        <div class="category-icon-wrapper" style="background-color: #FFCC0033;">
                            <img src="{{ asset('assets/images/education-list-icon.svg') }}" alt="">
                        </div>
                        <h3 class="category-name">Mentors</h3>
                        <span class="category-count">{{ $mentorsCount ?? 0 }}+ listed</span>
                    </div>
                </div>

                <!-- Row 2, Card 12: Scholarships -->
                <div class="col">
                    <div class="category-card">
                        <div class="category-icon-wrapper" style="background-color:#FCD8CB33;">
                            <img src="{{ asset('assets/images/education-list-icon.svg') }}" alt="">
                        </div>
                        <h3 class="category-name">Scholarships</h3>
                        <span class="category-count">850+ listed</span>
                    </div>
                </div>

                <!-- Row 2, Card 13: Internships -->
                <div class="col">
                    <div class="category-card">
                        <div class="category-icon-wrapper" style="background-color:#FCD8CB33;">
                            <img src="{{ asset('assets/images/education-list-icon.svg') }}" alt="">
                        </div>
                        <h3 class="category-name">Internships</h3>
                        <span class="category-count">4500+ listed</span>
                    </div>
                </div>

                <!-- Row 2, Card 14: Schools -->
                <div class="col">
                    <div class="category-card">
                        <div class="category-icon-wrapper" style="background-color:#FCD8CB33;">
                            <img src="{{ asset('assets/images/education-list-icon.svg') }}" alt="">
                        </div>
                        <h3 class="category-name">Schools</h3>
                        <span class="category-count">{{ $schoolsCount ?? 0 }}+ listed</span>
                    </div>
                </div>

            </div>
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
                    @if(isset($boardingSchools) && $boardingSchools->count() > 0)
                        @foreach($boardingSchools as $school)
                            <div class="col">
                                <div class="institution-card position-relative h-100 d-flex flex-column">
                                    <span class="rating-badge position-absolute">
                                        <span>{{ $school->average_rating ?? '4.5' }} <span class="star-icon">★</span></span>
                                    </span>
                                    <div class="institution-logo-wrapper mx-auto mb-3"
                                        style="width: 80px; height: 80px; border-radius: 50%; overflow: hidden; display: flex; align-items: center; justify-content: center; background-color: #fff; border: 1px solid #eee;">
                                        <img src="{{ $school->logo_url ? env('BACKEND_URL') . '/' . $school->logo_url : asset('assets/images/boarding-school-logo.png') }}"
                                            alt="{{ $school->brand_name ?? $school->name }}"
                                            style="max-width: 100%; max-height: 100%;">
                                    </div>
                                    <span
                                        class="badge-capsule mb-2 mx-auto">{{ Str::limit($school->brand_name ?? $school->name, 20) }}</span>
                                    <div class="card-info-text text-center">
                                        {{ is_array($school->cities_present_in) ? ($school->cities_present_in[0] ?? 'Location') : ($school->cities_present_in ?? 'Location') }}
                                        &nbsp;
                                        {{ is_array($school->education_boards_supported) ? ($school->education_boards_supported[0] ?? 'CBSE') : ($school->education_boards_supported ?? 'CBSE') }}
                                    </div>
                                    <div class="card-info-text mb-3 fw-bold text-center">
                                        {{ is_array($school->education_levels_supported) ? ($school->education_levels_supported[0] ?? '3rd - 12th') : ($school->education_levels_supported ?? '3rd - 12th') }}
                                    </div>
                                    <a href="{{ route('school.detail', $school->slug ?? $school->id) }}"
                                        class="btn btn-enrollzy btn-enrollzy-sm w-100 mt-auto">
                                        APPLY NOW
                                        <i class="fa-solid fa-arrow-right-long" style="color: #fff;"></i>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="col-12 text-center py-5">
                            <p class="text-muted">No boarding schools found.</p>
                        </div>
                    @endif
                </div>

                <!-- View More Button -->
                <div class="text-center">
                    <a href="{{ route('blogs') }}"
                        class="btn btn-enrollzy btn-enrollzy-lg text-decoration-none text-white">View More <i
                            class="fa-solid fa-arrow-right-long"></i></a>
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
                    @foreach($coachingInstitutes as $coaching)
                        <div class="col">
                            <div class="institution-card position-relative h-100 d-flex flex-column">
                                <span class="rating-badge position-absolute">
                                    <span>{{ $coaching->average_rating ?? '4.5' }} <span class="star-icon">★</span></span>
                                </span>
                                <div class="institution-logo-wrapper mx-auto mb-3"
                                    style="width: 80px; height: 80px; border-radius: 50%; overflow: hidden; display: flex; align-items: center; justify-content: center; background-color: #fff; border: 1px solid #eee;">
                                    <img src="{{ $coaching->logo_url ? env('BACKEND_URL') . '/' . $coaching->logo_url : asset('assets/images/boarding-school-logo.png') }}"
                                        alt="{{ $coaching->brand_name ?? $coaching->name }}"
                                        style="max-width: 100%; max-height: 100%;">
                                </div>
                                <span
                                    class="badge-capsule mb-2 mx-auto">{{ Str::limit($coaching->brand_name ?? $coaching->name, 20) }}</span>
                                <div class="card-info-text text-center">
                                    {{ is_array($coaching->cities_present_in) ? ($coaching->cities_present_in[0] ?? 'City') : ($coaching->cities_present_in ?? 'City') }},
                                    {{ is_array($coaching->states_present_in) ? ($coaching->states_present_in[0] ?? 'State') : ($coaching->states_present_in ?? 'State') }}
                                </div>
                                <div class="card-info-text text-center"
                                    style="font-size: 10px; font-weight: 700; color: #000000;margin-bottom: 13px;">
                                    {{ is_array($coaching->education_boards_supported) ? implode(' | ', $coaching->education_boards_supported) : ($coaching->education_boards_supported ?? 'NEET | IIT-JEE | NDA') }}
                                </div>
                                <a href="{{ route('coaching.detail', $coaching->slug ?? $coaching->id) }}"
                                    class="btn btn-enrollzy btn-enrollzy-sm w-100 mt-auto">
                                    APPLY NOW
                                    <i class="fa-solid fa-arrow-right-long" style="color: #fff;"></i>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
                <!-- View More Button -->
                <div class="text-center">
                    <a href="{{ route('all.coaching') }}"
                        class="btn btn-enrollzy btn-enrollzy-lg text-decoration-none text-white">View More <i
                            class="fa-solid fa-arrow-right-long"></i></a>
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
                <a href="{{ route('blogs') }}" class="btn btn-enrollzy btn-enrollzy-lg text-decoration-none text-white">View
                    More <i class="fa-solid fa-arrow-right-long"></i></a>
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
            @if(isset($noteworthy_categories) && $noteworthy_categories->count() > 0)
                <div class="row row-cols-1 row-cols-lg-3 g-4">
                    @php
                        $borderClasses = ['trending-border-blue', 'trending-border-yellow', 'trending-border-black'];
                        $textClasses = ['text-primary', 'text-warning', 'text-dark'];
                    @endphp
                    @foreach ($noteworthy_categories->take(3) as $cIndex => $category)
                        @php
                            $borderClass = $borderClasses[$cIndex % 3];
                            $textClass = $textClasses[$cIndex % 3];
                        @endphp
                        <div class="col">
                            <div class="trending-column-container {{ $borderClass }}">
                                <div class="trending-column-header {{ $textClass }}">
                                    <h3 class="trending-header-title mb-0">{{ $category->name }}</h3>
                                    <span class="trending-header-arrow"><i class="fa-solid fa-arrow-right-long"></i></span>
                                </div>
                                <div class="row row-cols-2" style="gap: 15px 0px;">
                                    @foreach ($category->mentions->take(6) as $mention)
                                        <div class="col">
                                            <div class="skill-list-card">
                                                <div class="skill-card-icon-wrapper"
                                                    style="width: 44px; height: 44px; background-color: #0f172a; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-bottom: 15px; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
                                                    @if ($mention->image)
                                                        <img src="{{ env('BACKEND_URL') . '/' . $mention->image }}" alt=""
                                                            style="width: 22px; height: 22px; object-fit: contain; filter: brightness(0) invert(1);">
                                                    @else
                                                        <span class="text-white fw-bold" style="font-size: 12px;">AI</span>
                                                    @endif
                                                </div>
                                                <h4 class="skill-card-title" style="min-height: 48px;">{{ $mention->title }}</h4>
                                                <ul class="skill-list">
                                                    @if($mention->subtitle)
                                                        @foreach(explode("\n", str_replace("\r", "", $mention->subtitle)) as $item)
                                                            @if(trim($item) != '')
                                                                <li class="skill-list-item">{{ trim($item) }}</li>
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                </ul>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
            <div class="text-center" style="margin-top: 57px;">
                <a href="{{ route('blogs') }}" class="btn btn-enrollzy btn-enrollzy-lg text-decoration-none text-white">View
                    More <i class="fa-solid fa-arrow-right-long"></i></a>
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
                @foreach($mentors as $mentor)
                    <div class="col">
                        <div class="mentor-card h-100 d-flex flex-column">
                            <div class="mentor-img-wrapper" style="height: 250px; overflow: hidden;">
                                <img src="{{ $mentor->profile_photo ? env('BACKEND_URL') . '/' . $mentor->profile_photo : asset('assets/images/mentor1.png') }}"
                                    alt="{{ $mentor->first_name }} {{ $mentor->last_name }}"
                                    style="width: 100%; height: 100%; object-fit: cover;">
                            </div>
                            <div class="mentor-card-body text-center d-flex flex-column flex-grow-1">
                                <h3 class="mentor-name">{{ $mentor->first_name }} {{ $mentor->last_name }}</h3>
                                <p class="mentor-title">{{ $mentor->professional_headline ?? 'Expert Mentor' }}</p>

                                <div class="mentor-badges d-flex flex-wrap justify-content-center gap-2 mb-3">
                                    <span class="badge-tag tag-blue">MBA Prep</span>
                                    <span class="badge-tag tag-yellow">Product</span>
                                    <span class="badge-tag tag-green">Startups</span>
                                </div>

                                <div class="d-flex justify-content-between align-items-center mb-3 mentor-stats">
                                    <div class="rating-badge-plain">
                                        <div class="stars">
                                            <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i
                                                class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i
                                                class="fa-solid fa-star text-muted"></i>
                                        </div>
                                        <span class="ms-1 fw-bold">4.9</span>
                                    </div>
                                    <span class="sessions-count text-muted">280 sessions</span>
                                </div>

                                <div class="d-flex justify-content-between align-items-center mt-auto pt-2 border-top">
                                    <div class="mentor-price">
                                        <span class="price-amount">₹500</span><span class="price-unit">/min</span>
                                    </div>
                                    <a href="#" class="btn btn-enrollzy btn-enrollzy-sm px-3 rounded-pill">Book session <i
                                            class="fa-solid fa-arrow-right-long ms-1"
                                            style="color: #fff; font-size: 10px;"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <!-- View More Button -->
            <div class="text-center">
                <a href="{{ route('blogs') }}" class="btn btn-enrollzy btn-enrollzy-lg text-decoration-none text-white">View
                    More <i class="fa-solid fa-arrow-right-long"></i></a>
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
                @if(isset($faqs) && $faqs->count() > 0)
                    @foreach($faqs as $index => $faq)
                        <div class="accordion-item">
                            <h3 class="accordion-header" id="heading{{ $index }}">
                                <button class="accordion-button {{ $index === 0 ? '' : 'collapsed' }}" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#collapse{{ $index }}"
                                    aria-expanded="{{ $index === 0 ? 'true' : 'false' }}" aria-controls="collapse{{ $index }}">
                                    {{ $faq->question }}
                                </button>
                            </h3>
                            <div id="collapse{{ $index }}" class="accordion-collapse collapse {{ $index === 0 ? 'show' : '' }}"
                                aria-labelledby="heading{{ $index }}" data-bs-parent="#faqZoneAccordion">
                                <div class="accordion-body">
                                    {{ strip_tags($faq->answer) }}
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <p class="text-center text-muted">No FAQs found.</p>
                @endif
            </div>

            <!-- View More Button -->
            <div class="text-center">
                <a href="{{ url('faq') }}" class="btn btn-enrollzy btn-enrollzy-lg">
                    View More
                    <i class="fa-solid fa-arrow-right-long" style="color: #fff;"></i>
                </a>
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
            @if(isset($top_exams) && $top_exams->count() > 0)
                <div class="row row-cols-1 row-cols-md-3 g-5 mb-5 justify-content-center">
                    @foreach($top_exams as $exam)
                        <div class="col text-center">
                            <div class="exam-icon-wrapper">
                                @if($exam->logo)
                                    <img src="{{ env('BACKEND_URL') . '/' . $exam->logo }}" alt="{{ $exam->name }}"
                                        style="max-width:45px;max-height:45px;object-fit:contain;">
                                @else
                                    <img src="{{ asset('assets/images/top-exam-icon-1.png') }}" alt="{{ $exam->name }}">
                                @endif
                            </div>
                            <a href="{{ route('exam.detail', $exam->slug) }}" style="text-decoration: none;">
                                <h3 class="exam-title">{{ $exam->name }}</h3>
                            </a>
                            <p class="exam-desc">{{ Str::limit(strip_tags($exam->about_exam), 80) }}</p>
                        </div>
                    @endforeach
                </div>
            @endif

            <!-- View More Button -->
            <div class="text-center" style="margin-top: 57px;">
                <a href="{{ route('top-exams') }}" class="btn btn-enrollzy btn-enrollzy-lg">
                    View More
                    <i class="fa-solid fa-arrow-right-long" style="color: #fff;"></i>
                </a>
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
                        <h2 class="section-title mb-0">{!! $quesAnsSection->title ?? 'Questions & Answers' !!}</h2>
                        <span class="heading-line d-none d-md-block"></span>
                    </div>
                    <p class="section-subtitle mx-auto text-muted" style="max-width: 900px;">
                        {!! $quesAnsSection->subtitle ?? 'Here are some of the most commonly asked questions by our prospective students.' !!}
                    </p>
                </div>

                <!-- Q&A Content Row -->
                <div class="row g-5 align-items-center">
                    <!-- Left Column: Image with Badges -->
                    <div class="col-lg-5">
                        @if(isset($quesAnsSection) && !empty($quesAnsSection->image))
                            @php
                                if (\Illuminate\Support\Str::startsWith($quesAnsSection->image, ['http://', 'https://'])) {
                                    $imgUrl = $quesAnsSection->image;
                                } elseif (\Illuminate\Support\Str::startsWith($quesAnsSection->image, 'uploads/')) {
                                    $backendUrl = env('BACKEND_URL', 'http://127.0.0.1:8001');
                                    $imgUrl = rtrim($backendUrl, '/') . '/' . ltrim($quesAnsSection->image, '/');
                                } else {
                                    $imgUrl = asset($quesAnsSection->image);
                                }
                            @endphp
                            <img src="{{ $imgUrl }}" alt="{{ strip_tags($quesAnsSection->title ?? 'Questions & Answers') }}"
                                class="img-fluid"
                                style="border-radius: 20px; max-height: 480px; width: 100%; object-fit: cover;">
                        @else
                            <img src="{{ asset('assets/images/qa-img.png') }}" alt="Questions & Answers" class="img-fluid">
                        @endif
                    </div>

                    <!-- Right Column: Question Cards -->
                    <div class="col-lg-7">
                        <!-- Dynamic FAQ Cards -->
                        @if($faqs->count() > 0)
                            @foreach($faqs as $index => $faq)
                                <div class="{{ $index === 0 ? 'qa-right-card-box-main' : 'qa-right-card-box' }}">
                                    <div class="qa-question-card">
                                        <h3 class="qa-question-text">{{ $faq->question }}</h3>
                                        <p class="qa-answer-text">
                                            {{ strip_tags($faq->answer) }}
                                        </p>
                                    </div>
                            @endforeach

                                @foreach($faqs as $faq)
                                    </div>
                                @endforeach
                        @else
                            <div class="qa-right-card-box-main">
                                <div class="qa-question-card">
                                    <p>No FAQs available.</p>
                                </div>
                            </div>
                        @endif

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
                @if(isset($blogs) && $blogs->count() > 0)
                    @foreach($blogs as $blog)
                        <div class="col">
                            <div class="blog-card">
                                <div class="blog-img-wrapper">
                                    <img src="{{ $blog->image ? env('BACKEND_URL') . '/' . $blog->image : asset('assets/images/blog-img-1.png') }}"
                                        alt="{{ $blog->title }}" class="blog-img">
                                </div>
                                <div class="blog-card-body">
                                    <div>
                                        <span
                                            class="blog-tag">{{ $blog->category ? $blog->category->name : 'Uncategorized' }}</span>
                                        <h3 class="blog-title">{{ Str::limit($blog->title, 50) }}</h3>
                                    </div>
                                    <a href="{{ route('blog.detail', $blog->slug) }}"
                                        class="btn btn-enrollzy btn-enrollzy-md w-100">
                                        Read more
                                        <i class="fa-solid fa-arrow-right-long" style="color: #fff;"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <p class="text-center text-muted">No blogs found.</p>
                @endif
            </div>
            <!-- View More Button -->
            <div class="text-center">
                <a href="{{ route('blogs') }}" class="btn btn-enrollzy btn-enrollzy-lg text-decoration-none text-white">View
                    More <i class="fa-solid fa-arrow-right-long"></i></a>
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
                @if(isset($video_testimonials) && $video_testimonials->count() > 0)
                    @foreach($video_testimonials as $video)
                        <div class="col">
                            <div class="testimonial-card"
                                style="background-image: url('{{ $video->thumbnail ? env('BACKEND_URL') . '/' . $video->thumbnail : asset('assets/images/mentor_1.png') }}');">
                                <div class="testimonial-overlay"></div>
                                @if($video->video_url)
                                    <a href="{{ $video->video_url }}" target="_blank" style="text-decoration: none;">
                                @endif
                                    <button class="play-icon-btn" type="button">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                                            class="bi bi-play-fill" viewBox="0 0 16 16">
                                            <path
                                                d="m11.596 8.697-6.363 3.692c-.54.313-1.233-.066-1.233-.697V4.308c0-.63.692-1.01 1.233-.696l6.363 3.692a.802.802 0 0 1 0 1.393z" />
                                        </svg>
                                    </button>
                                    @if($video->video_url)
                                        </a>
                                    @endif
                                <div class="testimonial-card-body">
                                    <h3 class="testimonial-name">{{ $video->name }}</h3>
                                    <p class="testimonial-sub">{{ $video->course }}</p>
                                    <div class="testimonial-rating">★ ★ ★ ★ ★</div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <p class="text-center text-muted">No testimonials found.</p>
                @endif
            </div>

            <!-- View More Button -->
            <div class="text-center">
                <a href="{{ route('blogs') }}" class="btn btn-enrollzy btn-enrollzy-lg text-decoration-none text-white">View
                    More <i class="fa-solid fa-arrow-right-long"></i></a>
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
                    @if(isset($testimonials) && $testimonials->count() > 0)
                        @foreach($testimonials as $testimonial)
                            <div class="swiper-slide h-auto">
                                <div class="feedback-card h-100 d-flex flex-column">
                                    <div class="mb-auto">
                                        <div class="feedback-rating">
                                            @for($i = 1; $i <= 5; $i++)
                                                @if($i <= $testimonial->rating)
                                                    ★
                                                @else
                                                    ☆
                                                @endif
                                            @endfor
                                        </div>
                                        <p class="feedback-text">
                                            {{ $testimonial->content }}
                                        </p>
                                    </div>
                                    <div class="feedback-author-row mt-4">
                                        <img src="{{ $testimonial->image ? env('BACKEND_URL') . '/' . $testimonial->image : asset('assets/images/mentor_2.png') }}"
                                            alt="{{ $testimonial->name }}" class="feedback-avatar">
                                        <div>
                                            <h4 class="feedback-author-name">{{ $testimonial->name }}</h4>
                                            <span class="feedback-author-title">{{ $testimonial->role }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <p class="text-center w-100">No testimonials found.</p>
                    @endif
                </div>
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
                    <li role="presentation"><a href="#tab-science" class="perfect-univ-tab" data-bs-toggle="tab" role="tab"
                            aria-selected="false">Science</a></li>
                    <li role="presentation"><a href="#tab-hotel" class="perfect-univ-tab" data-bs-toggle="tab" role="tab"
                            aria-selected="false">Hotel Management</a></li>
                    <li role="presentation"><a href="#tab-it" class="perfect-univ-tab" data-bs-toggle="tab" role="tab"
                            aria-selected="false">Information Technology</a></li>
                    <li role="presentation"><a href="#tab-arts" class="perfect-univ-tab" data-bs-toggle="tab" role="tab"
                            aria-selected="false">Arts & Humanities</a></li>
                    <li role="presentation"><a href="#tab-agri" class="perfect-univ-tab" data-bs-toggle="tab" role="tab"
                            aria-selected="false">Agriculture</a></li>
                    <li role="presentation"><a href="#tab-law" class="perfect-univ-tab" data-bs-toggle="tab" role="tab"
                            aria-selected="false">Law</a></li>
                    <li role="presentation"><a href="#tab-pharmacy" class="perfect-univ-tab" data-bs-toggle="tab" role="tab"
                            aria-selected="false">Pharmacy</a></li>
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
                <a href="{{ route('blogs') }}" class="btn btn-enrollzy btn-enrollzy-lg text-decoration-none text-white">View
                    More <i class="fa-solid fa-arrow-right-long"></i></a>
            </div>
        </div>
    </section>


    <!-- Let's Get in Touch Section -->

    <section id="contact-section" class="contact-section ptb-70">
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
                        <p class="text-muted mb-4">Leave us a message and our advisors will get back to you shortly.</p>

                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show mb-4 p-3 shadow-sm border-0 bg-success text-white rounded-3" role="alert">
                                <h5 class="alert-heading fw-bold mb-1"><i class="fa-solid fa-circle-check me-2"></i> Request Received!</h5>
                                <span>{{ session('success') }}</span>
                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                            <script>
                                document.addEventListener("DOMContentLoaded", function() {
                                    const el = document.getElementById("contact-section");
                                    if(el) el.scrollIntoView({ behavior: "smooth" });
                                });
                            </script>
                        @endif

                        @if($errors->any())
                            <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
                                <ul class="mb-0 ps-3">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                            <script>
                                document.addEventListener("DOMContentLoaded", function() {
                                    const el = document.getElementById("contact-section");
                                    if(el) el.scrollIntoView({ behavior: "smooth" });
                                });
                            </script>
                        @endif

                        <form action="{{ route('contact.submit') }}" method="POST">
                            @csrf
                            <div class="row g-3 mb-3">
                                <div class="col-md-6">
                                    <label for="fullName" class="form-label fw-semibold">Full Name <span class="text-danger">*</span></label>
                                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="fullName" placeholder="Enter your name" value="{{ old('name') }}" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="phoneNumber" class="form-label fw-semibold">Phone Number <span class="text-danger">*</span></label>
                                    <input type="tel" name="phone" class="form-control @error('phone') is-invalid @enderror" id="phoneNumber" placeholder="Enter your Phone Number" value="{{ old('phone') }}" required>
                                </div>
                            </div>
                            <div class="row g-3 mb-3">
                                <div class="col-md-6">
                                    <label for="emailAddress" class="form-label fw-semibold">Email Address</label>
                                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="emailAddress" placeholder="Email address" value="{{ old('email') }}">
                                </div>
                                <div class="col-md-6">
                                    <label for="companyName" class="form-label fw-semibold">Company Name</label>
                                    <input type="text" name="company" class="form-control @error('company') is-invalid @enderror" id="companyName" placeholder="Company name" value="{{ old('company') }}">
                                </div>
                            </div>
                            <div class="row g-3 mb-3">
                                <div class="col-md-12">
                                    <label for="businessType" class="form-label fw-semibold">Business Type</label>
                                    <select name="type" class="form-select" id="businessType">
                                        <option value="School Admission" selected>School Admission</option>
                                        <option value="Coaching Institutes">Coaching Institutes</option>
                                        <option value="University Partner">University Partner</option>
                                        <option value="EdTech Partner">EdTech Partner</option>
                                    </select>
                                </div>
                            </div>
                            <div class="mb-4">
                                <label for="businessHelp" class="form-label fw-semibold">How can we help your business</label>
                                <textarea name="message" class="form-control @error('message') is-invalid @enderror" id="businessHelp" rows="3" placeholder="How can we help your business">{{ old('message') }}</textarea>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-enrollzy btn-enrollzy-lg">
                                    Submit Request
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