@extends('layouts.app')
@section('content')
    <!-- Main Content Section -->
    @php $secHeroBanner = $homepageSections['hero_banner'] ?? null; @endphp
    @if(!isset($secHeroBanner) || (isset($secHeroBanner->is_visible) && $secHeroBanner->is_visible))
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
                                class="marketplace-badge">{{ !empty($secHeroBanner->cta_title) ? $secHeroBanner->cta_title : (!empty($firstHero->badge_text) ? $firstHero->badge_text : "India's no.1 Market place") }}</span>
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
                        <form action="{{ route('global.search') }}" method="GET" class="search-bar-container position-relative mx-auto mx-lg-0" id="heroSearchForm">
                            <div class="dropdown">
                                <button class="search-dropdown" type="button" id="searchFilterDropdown"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    <span id="searchFilterLabel">Looking for..</span>
                                    <i class="fa-solid fa-chevron-down" style="color: rgb(0, 0, 0);"></i>
                                </button>
                                <ul class="dropdown-menu border-0 shadow-sm" aria-labelledby="searchFilterDropdown">
                                    <li><a class="dropdown-item" href="javascript:void(0)"
                                            onclick="setSearchType('', 'Looking for..');">All
                                            Categories</a>
                                    </li>
                                    <li><a class="dropdown-item" href="javascript:void(0)"
                                            onclick="setSearchType('colleges', 'Colleges');">Colleges</a>
                                    </li>
                                    <li><a class="dropdown-item" href="javascript:void(0)"
                                            onclick="setSearchType('coaching', 'Coaching');">Coaching</a>
                                    </li>
                                    <li><a class="dropdown-item" href="javascript:void(0)"
                                            onclick="setSearchType('mentors', 'Mentors');">Mentors</a>
                                    </li>
                                    <li><a class="dropdown-item" href="javascript:void(0)"
                                            onclick="setSearchType('schools', 'Schools');">Schools</a>
                                    </li>
                                </ul>
                                <input type="hidden" name="type" id="searchType" value="">
                            </div>

                            <input type="text" name="q" id="heroSearchInput" class="search-input" placeholder="Search coaching, colleges, mentor..."
                                aria-label="Search text" autocomplete="off">
                            <button class="search-btn" type="submit" id="heroSearchBtn" aria-label="Submit Search">
                                Search
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-arrow-right" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd"
                                        d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8" />
                                </svg>
                            </button>
                            <div id="liveSearchResults" class="live-search-dropdown shadow-lg rounded-3 bg-white border"
                                style="display:none; position:absolute; top:calc(100% + 8px); left:0; right:0; z-index:1060; overflow:hidden;">
                            </div>
                        </form>

                        <div class=" d-flex flex-wrap justify-content-center justify-content-lg-start"
                            style="margin-bottom:41px">
                            <a href="{{ !empty($firstHero->pill_1_url) ? (str_starts_with($firstHero->pill_1_url, 'http') ? $firstHero->pill_1_url : url($firstHero->pill_1_url)) : route('top.universities') }}" class="tag-pill">
                                {{ !empty($firstHero->pill_1_label) ? $firstHero->pill_1_label : 'Top Universities' }}
                            </a>
                            <a href="{{ !empty($firstHero->pill_2_url) ? (str_starts_with($firstHero->pill_2_url, 'http') ? $firstHero->pill_2_url : url($firstHero->pill_2_url)) : route('top.schools') }}" class="tag-pill">
                                {{ !empty($firstHero->pill_2_label) ? $firstHero->pill_2_label : 'Top Schools' }}
                            </a>
                            <a href="{{ !empty($firstHero->pill_3_url) ? (str_starts_with($firstHero->pill_3_url, 'http') ? $firstHero->pill_3_url : url($firstHero->pill_3_url)) : route('top-exams') }}" class="tag-pill">
                                {{ !empty($firstHero->pill_3_label) ? $firstHero->pill_3_label : 'Top Exams' }}
                            </a>
                            <a href="{{ !empty($firstHero->pill_4_url) ? (str_starts_with($firstHero->pill_4_url, 'http') ? $firstHero->pill_4_url : url($firstHero->pill_4_url)) : route('top.coaching') }}" class="tag-pill">
                                {{ !empty($firstHero->pill_4_label) ? $firstHero->pill_4_label : 'Top Courses' }}
                            </a>
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
                                    class="stat-number">{{ isset($firstHero->stat_2_count) && !empty($firstHero->stat_2_count) ? $firstHero->stat_2_count : ($totalLeadsCount > 0 ? $totalLeadsCount . '+' : '10000+') }}</span>
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
                                            <img src="{{ str_starts_with($slider->image_path, 'http') ? $slider->image_path : rtrim(env('BACKEND_URL', 'http://127.0.0.1:8001'), '/') . '/' . ltrim($slider->image_path, '/') }}"
                                                alt="{{ $slider->heading }}" class="img-fluid hero-slide-img"
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
    @endif




    
    <!-- Dynamic Section Rendering Driven by Manage Homepage Sections (sort_order) -->
    @php $renderedSectionKeys = []; @endphp
    @if(isset($homepageSectionsOrdered) && count($homepageSectionsOrdered) > 0)
        @foreach($homepageSectionsOrdered as $secItem)
            @if(!empty($secItem->is_visible) && $secItem->section_key !== 'hero_banner')
                @switch($secItem->section_key)
                    @case('marketplace')
                        @if(!in_array('marketplace', $renderedSectionKeys))
                            @php $renderedSectionKeys[] = 'marketplace'; @endphp
<!-- Categories Section -->
    @php $secMarketplace = $homepageSections['marketplace'] ?? null; @endphp
    @if(!isset($secMarketplace) || (isset($secMarketplace->is_visible) && $secMarketplace->is_visible))
        @php
            $secSettings = isset($secMarketplace->settings) ? (is_array($secMarketplace->settings) ? $secMarketplace->settings : json_decode($secMarketplace->settings ?? '[]', true)) : [];
            $itemsVis = $secSettings['items_visibility'] ?? [];
        @endphp
        <section class="categories-section ptb-70">
            <div class="container">
                <!-- Section Header -->
                <div class="text-center heading-card">
                    <span
                        class="marketplace-badge mb-3">{{ !empty($secSettings['badge_text']) ? $secSettings['badge_text'] : (!empty($secMarketplace->cta_title) ? $secMarketplace->cta_title : "India's no.1 Market place") }}</span>
                    <div class="heading-with-lines d-flex align-items-center justify-content-center gap-3 mb-3">
                        <span class="heading-line d-none d-md-block"></span>
                        <h2 class="section-title mb-0">
                            {{ !empty($secMarketplace->title) ? $secMarketplace->title : "Everything education, in one marketplace" }}
                        </h2>
                        <span class="heading-line d-none d-md-block"></span>
                    </div>
                    <p class="section-subtitle mx-auto text-muted">
                        {!! !empty($secMarketplace->subtitle) ? $secMarketplace->subtitle : "From your first school admission to your first job offer — we cover every milestone of your education journey." !!}
                    </p>
                </div>

                @php
                    $marketplaceItems = [
                        'schools' => ['name' => 'Schools', 'count' => ($schoolsCount ?? 0) . '+ listed', 'bgColor' => '#FCD8CB33', 'url' => route('all-schools')],
                        'coaching' => ['name' => 'Coaching', 'count' => ($coachingCount ?? 0) . '+ listed', 'bgColor' => '#09FF6333', 'url' => route('all.coaching')],
                        'universities' => ['name' => 'Universities', 'count' => ($universitiesCount ?? 0) . '+ listed', 'bgColor' => '#83CBFF33', 'url' => route('university')],
                        'colleges' => ['name' => 'Colleges', 'count' => ($collegesCount > 0 ? $collegesCount : $universitiesCount) . '+ listed', 'bgColor' => '#FFCC0033', 'url' => route('university')],
                        'mentors' => ['name' => 'Mentors', 'count' => ($mentorsCount ?? 0) . '+ listed', 'bgColor' => '#FFCC0033', 'url' => route('mentors')],
                        'scholarships' => ['name' => 'Scholarships', 'count' => ($scholarshipsCount ?? 850) . '+ listed', 'bgColor' => '#FCD8CB33', 'url' => route('scholarships')],
                        'internships' => ['name' => 'Internships', 'count' => ($internshipsCount ?? 4500) . '+ listed', 'bgColor' => '#FCD8CB33', 'url' => '#'],
                        'top_exams' => ['name' => 'Top Exams', 'count' => ($totalExamsCount ?? 0) . '+ listed', 'bgColor' => '#83CBFF33', 'url' => route('top-exams')],
                        'exam_bodies' => ['name' => 'Exam Bodies', 'count' => ($examBodiesCount > 0 ? $examBodiesCount : 12) . '+ listed', 'bgColor' => '#09FF6333', 'url' => '#'],
                        'counselling_bodies' => ['name' => 'Counselling Bodies', 'count' => ($counsellingBodiesCount > 0 ? $counsellingBodiesCount : 8) . '+ listed', 'bgColor' => '#FCD8CB33', 'url' => '#'],
                        'regulatory_bodies' => ['name' => 'Regulatory Bodies', 'count' => ($regulatoryBodiesCount > 0 ? $regulatoryBodiesCount : 10) . '+ listed', 'bgColor' => '#FFCC0033', 'url' => '#'],
                        'govt_agencies' => ['name' => 'Govt Agencies', 'count' => ($govAgenciesCount > 0 ? $govAgenciesCount : 6) . '+ listed', 'bgColor' => '#83CBFF33', 'url' => '#'],
                        'blogs' => ['name' => 'Blogs & Guidance', 'count' => ($blogsCount ?? 0) . '+ published', 'bgColor' => '#09FF6333', 'url' => route('blogs')],
                        'all_institutions' => ['name' => 'All Institutions', 'count' => ($totalInstitutionsCount ?? 0) . '+ listed', 'bgColor' => '#FCD8CB33', 'url' => route('university')],
                    ];
                @endphp

                <!-- Categories Grid -->
                <div class="row row-cols-2 row-cols-sm-3 row-cols-md-4 row-cols-lg-7 category-row justify-content-center">
                    @foreach($marketplaceItems as $key => $item)
                        @if(!isset($itemsVis[$key]) || $itemsVis[$key] == '1' || $itemsVis[$key] === true)
                            <div class="col">
                                <a href="{{ $item['url'] }}" class="text-decoration-none">
                                    <div class="category-card">
                                        <div class="category-icon-wrapper" style="background-color: {{ $item['bgColor'] }};">
                                            <img src="{{ asset('assets/images/education-list-icon.svg') }}" alt="{{ $item['name'] }}">
                                        </div>
                                        <h3 class="category-name">{{ $item['name'] }}</h3>
                                        <span class="category-count">{{ $item['count'] }}</span>
                                    </div>
                                </a>
                            </div>
                        @endif
                    @endforeach
                </div>

                <!-- Optional CTA Button -->
                @if(!empty($secMarketplace->cta_title) && !empty($secMarketplace->cta_url))
                    <div class="text-center mt-5">
                        <a href="{{ str_starts_with($secMarketplace->cta_url, 'http') ? $secMarketplace->cta_url : url($secMarketplace->cta_url) }}"
                            class="btn btn-enrollzy btn-enrollzy-lg text-white text-decoration-none">
                            {{ $secMarketplace->cta_title }}
                            <i class="fa-solid fa-arrow-right-long ms-1"></i>
                        </a>
                    </div>
                @endif
            </div>
        </section>
    @endif
                        @endif
                        @break

                    @case('institute_marquee')
                        @if(!in_array('institute_marquee', $renderedSectionKeys))
                            @php $renderedSectionKeys[] = 'institute_marquee'; @endphp
<!-- Boarding School Section -->
    @php $secInstituteMarquee = $homepageSections['institute_marquee'] ?? null; @endphp
    @if(!isset($secInstituteMarquee) || (isset($secInstituteMarquee->is_visible) && $secInstituteMarquee->is_visible))
        <div class="grad-main"
            style="background: linear-gradient(180deg, rgba(191, 219, 247, 0) 0%, rgb(191 219 247 / 17%) 50%, rgba(191, 219, 247, 0) 100%);">
            <section class="boarding-schools-section ptb-70">
                <div class="container">
                    <!-- Section Header -->
                    <div class="text-center mb-5">
                        <div class="heading-with-lines d-flex align-items-center justify-content-center gap-3 mb-3">
                            <span class="heading-line d-none d-md-block"></span>
                            <h2 class="section-title mb-0">
                                {{ !empty($secInstituteMarquee->title) ? $secInstituteMarquee->title : "BOARDING SCHOOL" }}</h2>
                            <span class="heading-line d-none d-md-block"></span>
                        </div>
                        <p class="section-subtitle mx-auto text-muted" style="max-width: 900px;">
                            {!! !empty($secInstituteMarquee->subtitle) ? $secInstituteMarquee->subtitle : "Explore India's leading boarding schools and discover institutions designed to shape academic excellence, leadership, character, and future success. Compare schools, curriculum, facilities, campus life, and admissions — all in one place." !!}
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
                                            <img src="{{ $school->logo_url ? (str_starts_with($school->logo_url, 'http') ? $school->logo_url : rtrim(env('BACKEND_URL', 'http://127.0.0.1:8001'), '/') . '/' . ltrim($school->logo_url, '/')) : asset('assets/images/boarding-school-logo.png') }}"
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
                        @if(!empty($secInstituteMarquee->cta_title) && !empty($secInstituteMarquee->cta_url))
                            <a href="{{ str_starts_with($secInstituteMarquee->cta_url, 'http') ? $secInstituteMarquee->cta_url : url($secInstituteMarquee->cta_url) }}"
                                class="btn btn-enrollzy btn-enrollzy-lg text-decoration-none text-white">
                                {{ $secInstituteMarquee->cta_title }} <i class="fa-solid fa-arrow-right-long"></i>
                            </a>
                        @else
                            <a href="{{ route('all-schools') }}"
                                class="btn btn-enrollzy btn-enrollzy-lg text-decoration-none text-white">
                                View More <i class="fa-solid fa-arrow-right-long"></i>
                            </a>
                        @endif
                    </div>
                </div>
            </section>
        </div>
    @endif
                        @endif
                        @break

                    @case('school_marquee')
                        @if(!in_array('school_marquee', $renderedSectionKeys))
                            @php $renderedSectionKeys[] = 'school_marquee'; @endphp
<!-- Coaching Institutes Section -->
    @php $secSchoolMarquee = $homepageSections['school_marquee'] ?? null; @endphp
    @if(!isset($secSchoolMarquee) || (isset($secSchoolMarquee->is_visible) && $secSchoolMarquee->is_visible))
        <section class="coaching-institutes-section ptb-70">
            <div class="container">
                <!-- Section Header -->
                <div class="text-center mb-5">
                    <div class="heading-with-lines d-flex align-items-center justify-content-center gap-3 mb-3">
                        <span class="heading-line d-none d-md-block"></span>
                        <h2 class="section-title mb-0">
                            {{ !empty($secSchoolMarquee->title) ? $secSchoolMarquee->title : "COACHING INSTITUTES" }}</h2>
                        <span class="heading-line d-none d-md-block"></span>
                    </div>
                    <p class="section-subtitle mx-auto text-muted" style="max-width: 900px;">
                        {!! !empty($secSchoolMarquee->subtitle) ? $secSchoolMarquee->subtitle : "Discover leading coaching institutes that help students prepare for competitive exams and future success through expert mentorship, structured learning, and proven outcomes." !!}
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
                                    <img src="{{ $coaching->logo_url ? (str_starts_with($coaching->logo_url, 'http') ? $coaching->logo_url : rtrim(env('BACKEND_URL', 'http://127.0.0.1:8001'), '/') . '/' . ltrim($coaching->logo_url, '/')) : asset('assets/images/boarding-school-logo.png') }}"
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
    @endif
    </div>
                        @endif
                        @break

                    @case('why_choose_us')
                        @if(!in_array('why_choose_us', $renderedSectionKeys))
                            @php $renderedSectionKeys[] = 'why_choose_us'; @endphp
<!-- Journey Section -->
    @php $secWhyChooseUs = $homepageSections['why_choose_us'] ?? null; @endphp
    @if(!isset($secWhyChooseUs) || (isset($secWhyChooseUs->is_visible) && $secWhyChooseUs->is_visible))
        <section class="journey-section ptb-70">
            <div class="blue-shadow">
                <img src="assets/images/journey-blue-shadow.png" alt="">
            </div>
            <div class="pink-shadow">
                <img src="assets/images/journey-pink-shadow.png" alt="">
            </div>
            <div class="container-fluid">
                @php 
                                $whySettings = is_array($secWhyChooseUs->settings ?? null) ? $secWhyChooseUs->settings : json_decode($secWhyChooseUs->settings ?? '[]', true);
                    $badgeText = !empty($whySettings['badge_text']) ? $whySettings['badge_text'] : "Why choose enrollzy";
                @endphp
                <div class="text-center mb-5">
                    <span class="marketplace-badge mb-3">{{ $badgeText }}</span>
                    <div class="heading-with-lines d-flex align-items-center justify-content-center gap-3 mb-3">
                        <span class="heading-line d-none d-md-block"></span>
                        <h2 class="section-title mb-0">
                            {{ !empty($secWhyChooseUs->title) ? $secWhyChooseUs->title : "Your step-by-step journey to success" }}
                        </h2>
                        <span class="heading-line d-none d-md-block"></span>
                    </div>
                    <p class="section-subtitle mx-auto text-muted" style="max-width: 900px;">
                        {!! !empty($secWhyChooseUs->subtitle) ? $secWhyChooseUs->subtitle : "We guide you from school to your dream career with personalised milestones, resources, and mentors at every stage." !!}
                    </p>
                </div>

                <!-- Journey Steps Grid -->
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-6 g-4 mt-5 justify-content-center"
                    style="margin-bottom:57px !important">
                    @if(isset($home_services) && count($home_services) > 0)
                        @foreach($home_services as $index => $item)
                            <div class="col journey-step-col">
                                <div class="journey-icon-wrapper"
                                    style="width: 72px; height: 72px; min-width: 72px; min-height: 72px; border-radius: 50%; display: inline-flex; align-items: center; justify-content: center; overflow: hidden; background: #ffffff; border: 1px solid rgba(15, 89, 199, 0.15); margin: 0 auto 15px auto; box-shadow: 0px 4px 12px rgba(15, 89, 199, 0.08);">
                                    @if(!empty($item->image))
                                        <img src="{{ str_starts_with($item->image, 'http') ? $item->image : (file_exists(public_path($item->image)) ? asset($item->image) : rtrim(env('BACKEND_URL', 'http://127.0.0.1:8001'), '/') . '/' . ltrim($item->image, '/')) }}"
                                            alt="{{ $item->title }}"
                                            style="max-width: 100%; max-height: 100%; width: 100%; height: 100%; object-fit: cover; border-radius: 50%;">
                                    @else
                                        <img src="{{ asset('assets/images/step-img-' . (($index % 6) + 1) . '.png') }}"
                                            alt="{{ $item->title }}"
                                            style="max-width: 100%; max-height: 100%; width: 100%; height: 100%; object-fit: contain;">
                                    @endif
                                </div>
                                <h3 class="journey-step-title">{{ $item->title }}</h3>
                                <p class="journey-step-desc"
                                    style="display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden;">
                                    {!! strip_tags($item->description) !!}</p>
                                @if(!empty($item->footer_text))
                                    <span class="d-block mt-1 text-primary fw-semibold"
                                        style="font-size: 11px;">{{ Str::limit($item->footer_text, 35) }}</span>
                                @endif
                            </div>
                        @endforeach
                    @else
                        <!-- Step 1 -->
                        <div class="col journey-step-col">
                            <div class="journey-icon-wrapper">
                                <!-- Book SVG -->
                                <img src="assets/images/step-img-1.png" alt="Explore & Discover">
                            </div>
                            <h3 class="journey-step-title">Explore & Discover</h3>
                            <p class="journey-step-desc">Find your interests and aptitude <br> through guided assessments</p>
                        </div>

                        <!-- Step 2 -->
                        <div class="col journey-step-col">
                            <div class="journey-icon-wrapper">
                                <!-- Cap SVG -->
                                <img src="assets/images/step-img-2.png" alt="Choose Institution">
                            </div>
                            <h3 class="journey-step-title">Choose Institution</h3>
                            <p class="journey-step-desc">Compare & apply to best-fit <br> schools, coaching, or colleges</p>
                        </div>
                        <!-- Step 3 -->
                        <div class="col journey-step-col">
                            <div class="journey-icon-wrapper">
                                <!-- Trophy SVG -->
                                <img src="assets/images/step-img-3.png" alt="Secure Funding">
                            </div>
                            <h3 class="journey-step-title">Secure Funding</h3>
                            <p class="journey-step-desc">Apply for scholarships & financial <br> aid through Enrollzy</p>
                        </div>
                        <!-- Step 4 -->
                        <div class="col journey-step-col">
                            <div class="journey-icon-wrapper">
                                <!-- Books SVG -->
                                <img src="assets/images/step-img-4.png" alt="Skill Up">
                            </div>
                            <h3 class="journey-step-title">Skill Up</h3>
                            <p class="journey-step-desc">Take certifications and courses <br> alongside academics</p>
                        </div>
                        <!-- Step 5 -->
                        <div class="col journey-step-col">
                            <div class="journey-icon-wrapper">
                                <!-- Mentors SVG -->
                                <img src="assets/images/step-img-5.png" alt="Get a Mentor">
                            </div>
                            <h3 class="journey-step-title">Get a Mentor</h3>
                            <p class="journey-step-desc">1:1 sessions with industry experts <br> and alumni</p>
                        </div>
                        <!-- Step 6 -->
                        <div class="col journey-step-col">
                            <div class="journey-icon-wrapper">
                                <!-- Briefcase SVG -->
                                <img src="assets/images/step-img-6.png" alt="Land the Job">
                            </div>
                            <h3 class="journey-step-title">Land the Job</h3>
                            <p class="journey-step-desc">Internships, placements, and <br> career support on one platform</p>
                        </div>
                    @endif
                </div>

                @if(!empty($secWhyChooseUs->cta_url) || !empty($secWhyChooseUs->cta_title))
                    <!-- Start Journey Button -->
                    <div class="text-center">
                        <a href="{{ !empty($secWhyChooseUs->cta_url) ? $secWhyChooseUs->cta_url : '#' }}"
                            class="btn btn-enrollzy btn-enrollzy-lg">
                            {{ !empty($secWhyChooseUs->cta_title) ? $secWhyChooseUs->cta_title : 'Start your Journey' }}
                            <i class="fa-solid fa-arrow-right-long" style="color: #fff;"></i>
                        </a>
                    </div>
                @endif
            </div>
        </section>
    @endif
                        @endif
                        @break

                    @case('specialized_courses')
                        @if(!in_array('specialized_courses', $renderedSectionKeys))
                            @php $renderedSectionKeys[] = 'specialized_courses'; @endphp
<!-- Scholarships Section -->
    @php $secSpecialized = $homepageSections['specialized_courses'] ?? null; @endphp
    @if(!isset($secSpecialized) || (isset($secSpecialized->is_visible) && $secSpecialized->is_visible))
        <section class="scholarships-section ptb-70"
            style="    background: linear-gradient(180deg, #FFFFFF 0%, #f8fbfd 49%, #f8fbfd 100%);">
            <div class="container">
                <!-- Section Header -->
                <div class="text-center mb-5">
                    <span
                        class="marketplace-badge mb-3">{{ !empty($secSpecialized->cta_title) ? $secSpecialized->cta_title : "Scholarships & Benefits" }}</span>
                    <div class="heading-with-lines d-flex align-items-center justify-content-center gap-3 mb-3">
                        <span class="heading-line d-none d-md-block"></span>
                        <h2 class="section-title mb-0">
                            {{ !empty($secSpecialized->title) ? $secSpecialized->title : "Don't miss out on free money" }}</h2>
                        <span class="heading-line d-none d-md-block"></span>
                    </div>
                    <p class="section-subtitle mx-auto text-muted" style="max-width: 900px;">
                        {!! !empty($secSpecialized->subtitle) ? $secSpecialized->subtitle : "4,500+ scholarships worth over ₹200 Cr available. We match you automatically based on your profile." !!}
                    </p>
                </div>

                <!-- Scholarship Cards Grid -->
                <div class="row row-cols-1 row-cols-md-3 g-4 mb-5">
                    @if(isset($featuredScholarships) && count($featuredScholarships) > 0)
                        @foreach($featuredScholarships as $scholarship)
                            @php
                                $reward = 'Up to ₹50,000 / year';
                                if (!empty($scholarship->max_amount) && $scholarship->max_amount > 0) {
                                    $prefix = $scholarship->amount_prefix ?? 'Up to';
                                    $suffix = $scholarship->amount_suffix ?? '/ year';
                                    $reward = trim($prefix . ' ₹' . number_format($scholarship->max_amount, 0) . ' ' . $suffix);
                                }
                                $icon = $scholarship->provider_logo ?: ($scholarship->card_icon ?: $scholarship->featured_image);
                            @endphp
                            <div class="col">
                                <div class="scholarship-card h-100 d-flex flex-column justify-content-between">
                                    <div>
                                        <div class="d-flex align-items-center gap-3 mb-3">
                                            @if($icon)
                                                <div
                                                    style="width: 48px; height: 48px; min-width: 48px; border-radius: 50%; overflow: hidden; background: #fff; border: 1px solid #eee; display: flex; align-items: center; justify-content: center;">
                                                    <img src="{{ str_starts_with($icon, 'http') ? $icon : (file_exists(public_path($icon)) ? asset($icon) : rtrim(env('BACKEND_URL', 'http://127.0.0.1:8001'), '/') . '/' . ltrim($icon, '/')) }}"
                                                        alt="{{ $scholarship->title }}"
                                                        style="max-width: 100%; max-height: 100%; object-fit: contain;">
                                                </div>
                                            @endif
                                            <div>
                                                <h3 class="scholarship-title mb-0" style="font-size: 1.1rem;">
                                                    <a href="{{ route('scholarship.detail', $scholarship->slug ?? $scholarship->id) }}"
                                                        class="text-dark text-decoration-none">{{ $scholarship->title }}</a>
                                                </h3>
                                                @if($scholarship->provider_name)
                                                    <small class="text-muted d-block" style="font-size: 12px;">{{ $scholarship->provider_name }}</small>
                                                @endif
                                            </div>
                                        </div>
                                        <span class="scholarship-amount d-block mb-2">{{ $reward }}</span>
                                        <p class="text-muted mb-3"
                                            style="font-size: 13px; line-height: 1.5; display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden;">
                                            {!! strip_tags($scholarship->short_description ?: ($scholarship->overview ?: $scholarship->about_scholarship)) !!}
                                        </p>
                                        <div class="scholarship-badges-row mb-3">
                                            <span class="badge-stream">{{ $scholarship->category ?: 'Any stream' }}</span>
                                            <span class="badge-income">{{ $scholarship->scholarship_type ?: 'Merit-based' }}</span>
                                        </div>
                                    </div>
                                    <a href="{{ route('scholarship.detail', $scholarship->slug ?? $scholarship->id) }}"
                                        class="btn btn-enrollzy btn-enrollzy-md w-100 mt-auto">
                                        Check eligibility & Apply
                                        <i class="fa-solid fa-arrow-right-long" style="color: #fff;"></i>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    @elseif(isset($home_benefits) && count($home_benefits) > 0)
                        @foreach($home_benefits as $benefit)
                            @php
                                $reward = $benefit->reward_amount ?: 'Upto INR 30,000';
                                $contentLower = strtolower($benefit->content);
                                $titleLower = strtolower($benefit->title);
                                $fullText = $titleLower . ' ' . $contentLower;

                                $stream = 'Any stream';
                                if (str_contains($fullText, 'engineering') || str_contains($fullText, 'neet') || str_contains($fullText, 'jee') || str_contains($fullText, 'science')) {
                                    $stream = 'Science / Tech';
                                } elseif (str_contains($fullText, 'commerce') || str_contains($fullText, 'mba') || str_contains($fullText, 'bba')) {
                                    $stream = 'Management';
                                }

                                $income = 'Merit-based';
                                if (str_contains($fullText, 'income') || str_contains($fullText, 'minority') || str_contains($fullText, 'welfare')) {
                                    $income = 'Income < ₹8L';
                                }
                            @endphp
                            <div class="col">
                                <div class="scholarship-card h-100 d-flex flex-column justify-content-between">
                                    <div>
                                        <div class="d-flex align-items-center gap-3 mb-3">
                                            @if($benefit->icon)
                                                <div
                                                    style="width: 48px; height: 48px; min-width: 48px; border-radius: 50%; overflow: hidden; background: #fff; border: 1px solid #eee; display: flex; align-items: center; justify-content: center;">
                                                    <img src="{{ str_starts_with($benefit->icon, 'http') ? $benefit->icon : (file_exists(public_path($benefit->icon)) ? asset($benefit->icon) : rtrim(env('BACKEND_URL', 'http://127.0.0.1:8001'), '/') . '/' . ltrim($benefit->icon, '/')) }}"
                                                        alt="{{ $benefit->title }}"
                                                        style="max-width: 100%; max-height: 100%; object-fit: contain;">
                                                </div>
                                            @endif
                                            <h3 class="scholarship-title mb-0" style="font-size: 1.1rem;">
                                                <a href="{{ route('scholarship.detail', $benefit->id) }}"
                                                    class="text-dark text-decoration-none">{{ $benefit->title }}</a>
                                            </h3>
                                        </div>
                                        <span class="scholarship-amount d-block mb-2">{{ $reward }}</span>
                                        <p class="text-muted mb-3"
                                            style="font-size: 13px; line-height: 1.5; display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden;">
                                            {!! strip_tags($benefit->content) !!}
                                        </p>
                                        <div class="scholarship-badges-row mb-3">
                                            <span class="badge-stream">{{ $stream }}</span>
                                            <span class="badge-income">{{ $income }}</span>
                                        </div>
                                    </div>
                                    <a href="{{ route('scholarship.detail', $benefit->id) }}"
                                        class="btn btn-enrollzy btn-enrollzy-md w-100 mt-auto">
                                        Check eligibility & Apply
                                        <i class="fa-solid fa-arrow-right-long" style="color: #fff;"></i>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <!-- Fallback Card 1 -->
                        <div class="col">
                            <div class="scholarship-card">
                                <div>
                                    <h3 class="scholarship-title">PM Scholarship Scheme</h3>
                                    <a href="#" class="scholarship-authority">Government of India · Central Sector Scheme</a>
                                    <span class="scholarship-amount">₹75,000 <span
                                            style="font-size: 1rem; color: #777777; font-weight: 500;">/year</span></span>
                                    <div class="scholarship-meta-row">
                                        <span class="scholarship-meta-item">Merit-based</span>
                                        <span class="scholarship-meta-item">Dec 31, 2026</span>
                                    </div>
                                    <div class="scholarship-badges-row">
                                        <span class="badge-stream">Any stream</span>
                                        <span class="badge-income">Income &lt; ₹8L</span>
                                    </div>
                                </div>
                                <a href="{{ route('scholarships') }}" class="btn btn-enrollzy btn-enrollzy-md w-100 mt-3">
                                    Check eligibility & Apply
                                    <i class="fa-solid fa-arrow-right-long" style="color: #fff;"></i>
                                </a>
                            </div>
                        </div>
                    @endif
                </div>

                <!-- View More Button -->
                <div class="text-center">
                    <a href="{{ route('scholarships') }}"
                        class="btn btn-enrollzy btn-enrollzy-lg text-decoration-none text-white">View
                        More <i class="fa-solid fa-arrow-right-long"></i></a>
                </div>
            </div>
        </section>
    @endif
                        @endif
                        @break

                    @case('noteworthy_mentions')
                        @if(!in_array('noteworthy_mentions', $renderedSectionKeys))
                            @php $renderedSectionKeys[] = 'noteworthy_mentions'; @endphp
<!-- Trending Section -->
    @php $secNoteworthy = $homepageSections['noteworthy_mentions'] ?? null; @endphp
    @if(!isset($secNoteworthy) || (isset($secNoteworthy->is_visible) && $secNoteworthy->is_visible))
        <section class="trending-section ptb-70">
            <div class="container">
                <!-- Section Header -->
                <div class="text-center" style="margin-bottom: 57px;">
                    <div class="heading-with-lines d-flex align-items-center justify-content-center gap-3 mb-3">
                        <span class="heading-line d-none d-md-block"></span>
                        <h2 class="section-title mb-0">
                            {{ !empty($secNoteworthy->title) ? $secNoteworthy->title : "Trending Learning Opportunities" }}</h2>
                        <span class="heading-line d-none d-md-block"></span>
                    </div>
                    <p class="section-subtitle mx-auto text-muted" style="max-width: 900px;">
                        {!! !empty($secNoteworthy->subtitle) ? $secNoteworthy->subtitle : "Explore our popular certificates, credentials, and achievements." !!}
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
                                                            <img src="{{ str_starts_with($mention->image, 'http') ? $mention->image : (file_exists(public_path($mention->image)) ? asset($mention->image) : rtrim(env('BACKEND_URL', 'http://127.0.0.1:8001'), '/') . '/' . ltrim($mention->image, '/')) }}"
                                                                alt="{{ $mention->title }}"
                                                                style="width: 22px; height: 22px; object-fit: contain; filter: brightness(0) invert(1);">
                                                        @else
                                                            <span class="text-white fw-bold" style="font-size: 12px;">AI</span>
                                                        @endif
                                                    </div>
                                                    <h4 class="skill-card-title" style="min-height: 48px;">
                                                        @if(!empty($mention->url))
                                                            <a href="{{ $mention->url }}" target="_blank"
                                                                class="text-dark text-decoration-none">{{ $mention->title }}</a>
                                                        @else
                                                            {{ $mention->title }}
                                                        @endif
                                                    </h4>
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
                @if(!empty($secNoteworthy->cta_url))
                    <div class="text-center" style="margin-top: 57px;">
                        <a href="{{ $secNoteworthy->cta_url }}"
                            class="btn btn-enrollzy btn-enrollzy-lg text-decoration-none text-white">
                            {{ !empty($secNoteworthy->cta_title) ? $secNoteworthy->cta_title : 'View More' }}
                            <i class="fa-solid fa-arrow-right-long"></i>
                        </a>
                    </div>
                @endif
            </div>
        </section>
    @endif
                        @endif
                        @break

                    @case('expert_carousel')
                        @if(!in_array('expert_carousel', $renderedSectionKeys))
                            @php $renderedSectionKeys[] = 'expert_carousel'; @endphp
<!-- Expert Mentors Section -->
    @php $secMentors = $homepageSections['expert_carousel'] ?? $homepageSections['talk_to_alumni'] ?? null; @endphp
    @if(!isset($secMentors) || (isset($secMentors->is_visible) && $secMentors->is_visible))
        <section class="mentors-section ptb-70">
            <div class="container">
                <!-- Section Header -->
                <div class="text-center mb-5">
                    <div class="heading-with-lines d-flex align-items-center justify-content-center gap-3 mb-3">
                        <span class="heading-line d-none d-md-block"></span>
                        <h2 class="section-title mb-0">{{ !empty($secMentors->title) ? $secMentors->title : "Expert Mentors" }}
                        </h2>
                        <span class="heading-line d-none d-md-block"></span>
                    </div>
                    <p class="section-subtitle mx-auto text-muted" style="max-width: 900px;">
                        {!! !empty($secMentors->subtitle) ? $secMentors->subtitle : "Learn from experienced professionals, industry leaders, and academic mentors dedicated to student success." !!}
                    </p>
                </div>

                <!-- Mentors Grid -->
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-2 row-cols-lg-4 g-4 mb-5">
                    @foreach($mentors as $mentor)
                        <div class="col">
                            <div class="mentor-card h-100 d-flex flex-column">
                                <div class="mentor-img-wrapper" style="height: 250px; overflow: hidden;">
                                    <img src="{{ $mentor->profile_photo ? (str_starts_with($mentor->profile_photo, 'http') ? $mentor->profile_photo : rtrim(env('BACKEND_URL', 'http://127.0.0.1:8001'), '/') . '/' . ltrim($mentor->profile_photo, '/')) : asset('assets/images/mentor1.png') }}"
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
                                            <span class="price-amount">₹{{ number_format($mentor->price_per_min ?? 500, 0) }}</span><span class="price-unit">/min</span>
                                        </div>
                                        <a href="{{ route('mentor.detail', $mentor->id) }}" class="btn btn-enrollzy btn-enrollzy-sm px-3 rounded-pill">Book session <i
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
                    <a href="{{ !empty($secMentors->cta_url) ? (str_starts_with($secMentors->cta_url, 'http') ? $secMentors->cta_url : url($secMentors->cta_url)) : route('mentors') }}" class="btn btn-enrollzy btn-enrollzy-lg text-decoration-none text-white">
                        {{ !empty($secMentors->cta_title) ? $secMentors->cta_title : 'View More' }} <i class="fa-solid fa-arrow-right-long"></i>
                    </a>
                </div>
            </div>
        </section>
    @endif
                        @endif
                        @break

                    @case('faq')
                        @if(!in_array('faq', $renderedSectionKeys))
                            @php $renderedSectionKeys[] = 'faq'; @endphp
<!-- FAQ Zone Section -->
    @php $secFaq = $homepageSections['faq'] ?? null; @endphp
    @if(!isset($secFaq) || (isset($secFaq->is_visible) && $secFaq->is_visible))
        <section class="faq-zone-section ptb-70">
            <div class="container">
                <!-- Section Header -->
                <div class="text-center mb-5">
                    <div class="heading-with-lines d-flex align-items-center justify-content-center gap-3 mb-3">
                        <span class="heading-line d-none d-md-block"></span>
                        <h2 class="section-title mb-0">{{ !empty($secFaq->title) ? $secFaq->title : "The FAQ Zone" }}</h2>
                        <span class="heading-line d-none d-md-block"></span>
                    </div>
                    <p class="section-subtitle mx-auto text-muted" style="max-width: 900px;">
                        {!! !empty($secFaq->subtitle) ? $secFaq->subtitle : "Get quick answers about trending programs, skills, certifications, and free courses." !!}
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
    @endif
                        @endif
                        @break

                    @case('trending_skills')
                        @if(!in_array('trending_skills', $renderedSectionKeys))
                            @php $renderedSectionKeys[] = 'trending_skills'; @endphp
<!-- Trending Skills & Top Exams Section -->
    @php $secTrendingSkills = $homepageSections['trending_skills'] ?? null; @endphp
    @if(!isset($secTrendingSkills) || (isset($secTrendingSkills->is_visible) && $secTrendingSkills->is_visible))
        <section class="top-exams-section ptb-70">
            <div class="container">
                <!-- Section Header -->
                <div class="text-center mb-5">
                    <div class="heading-with-lines d-flex align-items-center justify-content-center gap-3 mb-3">
                        <span class="heading-line d-none d-md-block"></span>
                        <h2 class="section-title mb-0">
                            {{ !empty($secTrendingSkills->title) ? $secTrendingSkills->title : "Trending Skills & Top Exams" }}
                        </h2>
                        <span class="heading-line d-none d-md-block"></span>
                    </div>
                    <p class="section-subtitle mx-auto text-muted" style="max-width: 900px;">
                        {!! !empty($secTrendingSkills->subtitle) ? $secTrendingSkills->subtitle : "Explore in-demand skills, certifications, and prepare for top competitive exams." !!}
                    </p>
                </div>

                <!-- Dynamic Trending Skills Badges from Admin -->
                @if(isset($trending_skills) && count($trending_skills) > 0)
                    <div class="mb-5 text-center">
                        <div class="d-flex flex-wrap justify-content-center gap-2">
                            @foreach($trending_skills as $skill)
                                @if(!empty($skill->url))
                                    <a href="{{ $skill->url }}" target="_blank"
                                        class="badge bg-light text-primary border border-primary-subtle px-3 py-2 fs-6 rounded-pill text-decoration-none shadow-sm transition-all">
                                        <i class="fa-solid fa-bolt text-warning me-1"></i> {{ $skill->name }}
                                    </a>
                                @else
                                    <span class="badge bg-light text-dark border px-3 py-2 fs-6 rounded-pill shadow-sm">
                                        <i class="fa-solid fa-bolt text-warning me-1"></i> {{ $skill->name }}
                                    </span>
                                @endif
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- Exams Grid -->
                @if(isset($top_exams) && $top_exams->count() > 0)
                    <div class="row row-cols-1 row-cols-md-3 g-5 mb-5 justify-content-center">
                        @foreach($top_exams as $exam)
                            <div class="col text-center">
                                <div class="exam-icon-wrapper">
                                    @if($exam->logo)
                                        <img src="{{ str_starts_with($exam->logo, 'http') ? $exam->logo : rtrim(env('BACKEND_URL', 'http://127.0.0.1:8001'), '/') . '/' . ltrim($exam->logo, '/') }}"
                                            alt="{{ $exam->name }}" style="max-width:45px;max-height:45px;object-fit:contain;">
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
    @endif
                        @endif
                        @break

                    @case('ques_ans')
                        @if(!in_array('ques_ans', $renderedSectionKeys))
                            @php $renderedSectionKeys[] = 'ques_ans'; @endphp
<!-- Questions & Answers Section -->
    @php $secQuesAns = $homepageSections['ques_ans'] ?? null; @endphp
    @if(!isset($secQuesAns) || (isset($secQuesAns->is_visible) && $secQuesAns->is_visible))
        <div class="grad-main"
            style="background: linear-gradient(180deg, rgba(191, 219, 247, 0) 0%, rgb(191 219 247 / 30%) 50%, rgba(191, 219, 247, 0) 100%)">
            <section class="qa-section ptb-70">
                <div class="container">
                    <!-- Section Header -->
                    <div class="text-center mb-5">
                        <div class="heading-with-lines d-flex align-items-center justify-content-center gap-3 mb-3">
                            <span class="heading-line d-none d-md-block"></span>
                            <h2 class="section-title mb-0">
                                {{ !empty($secQuesAns->title) ? $secQuesAns->title : "Questions & Answers" }}</h2>
                            <span class="heading-line d-none d-md-block"></span>
                        </div>
                        <p class="section-subtitle mx-auto text-muted" style="max-width: 900px;">
                            {!! !empty($secQuesAns->subtitle) ? $secQuesAns->subtitle : "Here are some of the most commonly asked questions by our prospective students." !!}
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
            </section>
        </div>
    @endif
                        @endif
                        @break

                    @case('blogs')
                        @if(!in_array('blogs', $renderedSectionKeys))
                            @php $renderedSectionKeys[] = 'blogs'; @endphp
<!-- Our Latest Blog Section -->
    @php $secBlogs = $homepageSections['blogs'] ?? null; @endphp
    @if(!isset($secBlogs) || (isset($secBlogs->is_visible) && $secBlogs->is_visible))
        <section class="blog-section ptb-70">
            <div class="container">
                <!-- Section Header -->
                <div class="text-center mb-5">
                    <div class="heading-with-lines d-flex align-items-center justify-content-center gap-3 mb-3">
                        <span class="heading-line d-none d-md-block"></span>
                        <h2 class="section-title mb-0">{{ !empty($secBlogs->title) ? $secBlogs->title : "Our Latest Blog" }}
                        </h2>
                        <span class="heading-line d-none d-md-block"></span>
                    </div>
                    <p class="section-subtitle mx-auto text-muted" style="max-width: 900px;">
                        {!! !empty($secBlogs->subtitle) ? $secBlogs->subtitle : "What our students and parents have to say about their experience with us." !!}
                    </p>
                </div>

                <!-- Blog Grid -->
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-2 row-cols-lg-4 g-4 mb-5">
                    @if(isset($blogs) && $blogs->count() > 0)
                        @foreach($blogs as $blog)
                            <div class="col">
                                <div class="blog-card">
                                    <div class="blog-img-wrapper">
                                        <img src="{{ $blog->image ? (str_starts_with($blog->image, 'http') ? $blog->image : rtrim(env('BACKEND_URL', 'http://127.0.0.1:8001'), '/') . '/' . ltrim($blog->image, '/')) : asset('assets/images/blog-img-1.png') }}"
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
    @endif
                        @endif
                        @break

                    @case('video_testimonials')
                        @if(!in_array('video_testimonials', $renderedSectionKeys))
                            @php $renderedSectionKeys[] = 'video_testimonials'; @endphp
<!-- Testimonials Section (Video Testimonials) -->
    @php $secVideoTestimonials = $homepageSections['video_testimonials'] ?? null; @endphp
    @if((!isset($secVideoTestimonials) || (isset($secVideoTestimonials->is_visible) && $secVideoTestimonials->is_visible)) && isset($video_testimonials) && $video_testimonials->count() > 0)
        <section class="testimonials-section ptb-70" style="background-color: #FFFCF8;">
            <div class="container">
                <!-- Section Header -->
                <div class="text-center mb-5">
                    <div class="heading-with-lines d-flex align-items-center justify-content-center gap-3 mb-3">
                        <span class="heading-line d-none d-md-block"></span>
                        <h2 class="section-title mb-0">
                            {{ !empty($secVideoTestimonials->title) ? $secVideoTestimonials->title : "Testimonials" }}</h2>
                        <span class="heading-line d-none d-md-block"></span>
                    </div>
                    <p class="section-subtitle mx-auto text-muted" style="max-width: 900px;">
                        {!! !empty($secVideoTestimonials->subtitle) ? $secVideoTestimonials->subtitle : "What our students and parents have to say about their experience with us." !!}
                    </p>
                </div>

                <!-- Video Cards Grid -->
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-2 row-cols-lg-4 g-4 {{ !empty($secVideoTestimonials->cta_title) ? 'mb-5' : '' }}">
                    @foreach($video_testimonials as $video)
                        <div class="col">
                            <div class="testimonial-card"
                                style="background-image: url('{{ $video->thumbnail ? (str_starts_with($video->thumbnail, 'http') ? $video->thumbnail : rtrim(env('BACKEND_URL', 'http://127.0.0.1:8001'), '/') . '/' . ltrim($video->thumbnail, '/')) : asset('assets/images/mentor_1.png') }}');">
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
                </div>

                <!-- View More Button (Shows only if cta_title/label is defined) -->
                @if(!empty($secVideoTestimonials->cta_title))
                    <div class="text-center">
                        <a href="{{ !empty($secVideoTestimonials->cta_url) ? (str_starts_with($secVideoTestimonials->cta_url, 'http') ? $secVideoTestimonials->cta_url : url($secVideoTestimonials->cta_url)) : route('blogs') }}" class="btn btn-enrollzy btn-enrollzy-lg text-decoration-none text-white">
                            {{ $secVideoTestimonials->cta_title }} <i class="fa-solid fa-arrow-right-long"></i>
                        </a>
                    </div>
                @endif
            </div>
        </section>
    @endif
                        @endif
                        @break

                    @case('testimonials')
                        @if(!in_array('testimonials', $renderedSectionKeys))
                            @php $renderedSectionKeys[] = 'testimonials'; @endphp
<!-- Student Insights & Feedback Section -->
    @php $secTestimonials = $homepageSections['testimonials'] ?? null; @endphp
    @if((!isset($secTestimonials) || (isset($secTestimonials->is_visible) && $secTestimonials->is_visible)) && isset($testimonials) && $testimonials->count() > 0)
        <section class="feedback-section ptb-70" style="background:#FFFCF8;">
            <div class="container">
                <div class="text-center mb-5">
                    <div class="heading-with-lines d-flex align-items-center justify-content-center gap-3 mb-3">
                        <span class="heading-line d-none d-md-block"></span>
                        <h2 class="section-title mb-0">
                            {{ !empty($secTestimonials->title) ? $secTestimonials->title : "Student Insights & Feedback" }}</h2>
                        <span class="heading-line d-none d-md-block"></span>
                    </div>
                    <p class="section-subtitle mx-auto text-muted" style="max-width: 900px;">
                        {!! !empty($secTestimonials->subtitle) ? $secTestimonials->subtitle : "What our students and parents have to say about their experience with us." !!}
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
                <div class="swiper feedback-swiper" style="overflow: hidden;padding:0px 50px 0px 50px;">
                    <div class="swiper-wrapper">
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
                                        <img src="{{ $testimonial->image ? (str_starts_with($testimonial->image, 'http') ? $testimonial->image : rtrim(env('BACKEND_URL', 'http://127.0.0.1:8001'), '/') . '/' . ltrim($testimonial->image, '/')) : asset('assets/images/mentor_2.png') }}"
                                            alt="{{ $testimonial->name }}" class="feedback-avatar">
                                        <div>
                                            <h4 class="feedback-author-name">{{ $testimonial->name }}</h4>
                                            <span class="feedback-author-title">{{ $testimonial->role }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- View More Button (Shows only if cta_title/label is defined) -->
                @if(!empty($secTestimonials->cta_title))
                    <div class="text-center mt-5">
                        <a href="{{ !empty($secTestimonials->cta_url) ? (str_starts_with($secTestimonials->cta_url, 'http') ? $secTestimonials->cta_url : url($secTestimonials->cta_url)) : '#' }}" class="btn btn-enrollzy btn-enrollzy-lg text-decoration-none text-white">
                            {{ $secTestimonials->cta_title }} <i class="fa-solid fa-arrow-right-long"></i>
                        </a>
                    </div>
                @endif
            </div>
        </section>
    @endif
                        @endif
                        @break

                    @case('university_grid')
                        @if(!in_array('university_grid', $renderedSectionKeys))
                            @php $renderedSectionKeys[] = 'university_grid'; @endphp
<!-- Find The Perfect University For You Section -->
    @php $secUnivGrid = $homepageSections['university_grid'] ?? null; @endphp
    @if(!isset($secUnivGrid) || (isset($secUnivGrid->is_visible) && $secUnivGrid->is_visible))
        <section class="perfect-university-section ptb-70" style="padding-bottom: 27px;">
            <div class="container">
                <!-- Section Header -->
                <div class="text-center mb-4">
                    <div class="heading-with-lines d-flex align-items-center justify-content-center gap-3 mb-3">
                        <span class="heading-line d-none d-md-block"></span>
                        <h2 class="section-title mb-0">
                            {{ !empty($secUnivGrid->title) ? $secUnivGrid->title : "Leading Universities" }}</h2>
                        <span class="heading-line d-none d-md-block"></span>
                    </div>
                    <p class="section-subtitle mx-auto text-muted" style="max-width: 900px;">
                        {!! !empty($secUnivGrid->subtitle) ? $secUnivGrid->subtitle : "Discover leading universities offering world-class education, industry-relevant curriculum, and strong career opportunities." !!}
                    </p>
                </div>

                <!-- Category Tabs Navigation -->
                <div class="mb-5 m-auto">
                    <ul class="perfect-univ-tabs nav m-auto" role="tablist" id="perfectUnivTabs">
                        @if(isset($dbStreamTabs) && $dbStreamTabs->count() > 0)
                            @foreach($dbStreamTabs as $tab)
                                <li role="presentation">
                                    <a href="#tab-{{ $tab->key }}" class="perfect-univ-tab {{ $loop->first ? 'active' : '' }}" data-bs-toggle="tab" role="tab" aria-selected="{{ $loop->first ? 'true' : 'false' }}">
                                        {{ $tab->name }}
                                    </a>
                                </li>
                            @endforeach
                        @endif
                    </ul>
                </div>

                <!-- Perfect Match Box Grid -->
                <div class="tab-content">
                    @if(isset($streamData) && count($streamData) > 0)
                        @foreach($streamData as $sKey => $sVal)
                            <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" id="tab-{{ $sKey }}" role="tabpanel">
                                <div class="row row-cols-1 row-cols-lg-3 g-4">
                                    <!-- Column 1: Featured Colleges -->
                                    <div class="col">
                                        <div class="perfect-match-box">
                                            <div class="perfect-match-header">
                                                <h3 class="perfect-match-title mb-0">Featured Colleges</h3>
                                                <a href="{{ route('university') }}" class="btn-view-all-link">View all</a>
                                            </div>
                                            <div class="perfect-badges-grid">
                                                @if(isset($sVal['colleges']) && $sVal['colleges']->count() > 0)
                                                    @foreach($sVal['colleges'] as $univ)
                                                        <a href="{{ route('university.detail', $univ->slug ?? $univ->id) }}" class="badge-univ-pill text-decoration-none text-dark d-inline-block">
                                                            {{ Str::limit($univ->brand_name ?? $univ->name, 25) }}
                                                        </a>
                                                    @endforeach
                                                @endif
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
                                                    <a href="{{ route('top-exams') }}" class="btn-view-all-link">View all</a>
                                                </div>
                                                <div class="perfect-badges-grid" style="padding: 10px 12px;border-radius: 10px;background-color: #fff;border: 1px solid #DDDDDD;">
                                                    @foreach($sVal['exams'] as $ex)
                                                        <a href="{{ route('top-exams', ['search' => $ex]) }}" class="badge-univ-pill text-decoration-none text-dark d-inline-block">
                                                            {{ $ex }}
                                                        </a>
                                                    @endforeach
                                                </div>
                                            </div>
                                            <!-- Box B: Top States -->
                                            <div class="perfect-match-box" style="flex: 1;">
                                                <div class="perfect-match-header" style="margin-bottom:10px;">
                                                    <h3 class="perfect-match-title mb-0">Top States</h3>
                                                    <a href="{{ route('university') }}" class="btn-view-all-link">View all</a>
                                                </div>
                                                <div class="perfect-badges-grid" style="padding: 10px 12px;border-radius: 10px;background-color: #fff;border: 1px solid #DDDDDD;">
                                                    @foreach($sVal['states'] as $st)
                                                        <a href="{{ route('university', ['state' => $st]) }}" class="badge-univ-pill text-decoration-none text-dark d-inline-block">
                                                            {{ $st }}
                                                        </a>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Column 3: Related Courses -->
                                    <div class="col">
                                        <div class="perfect-match-box">
                                            <div class="perfect-match-header">
                                                <h3 class="perfect-match-title mb-0">Related Courses</h3>
                                                <a href="{{ route('university') }}" class="btn-view-all-link">View all</a>
                                            </div>
                                            <div class="perfect-badges-grid">
                                                @foreach($sVal['courses'] as $crs)
                                                    <a href="{{ route('university', ['search' => $crs]) }}" class="badge-univ-pill text-decoration-none text-dark d-inline-block">
                                                        {{ $crs }}
                                                    </a>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>         </div>
                <!-- View More Button (Shows only if cta_title/label is defined) -->
                @if(!empty($secUnivGrid->cta_title))
                    @php
                        $univCtaUrl = route('university');
                        if (!empty($secUnivGrid->cta_url)) {
                            $uStr = $secUnivGrid->cta_url;
                            if (str_contains($uStr, 'university') || str_contains($uStr, 'universities')) {
                                $univCtaUrl = route('university');
                            } elseif (str_starts_with($uStr, 'http')) {
                                $univCtaUrl = $uStr;
                            } else {
                                $univCtaUrl = url($uStr);
                            }
                        }
                    @endphp
                    <div class="text-center mt-5">
                        <a href="{{ $univCtaUrl }}" class="btn btn-enrollzy btn-enrollzy-lg text-decoration-none text-white">
                            {{ $secUnivGrid->cta_title }} <i class="fa-solid fa-arrow-right-long"></i>
                        </a>
                    </div>
                @endif
            </div>
        </section>
    @endif
                        @endif
                        @break

                    @case('trending_courses')
                        @if(!in_array('trending_courses', $renderedSectionKeys))
                            @php $renderedSectionKeys[] = 'trending_courses'; @endphp
<!-- Compare Banner & Trending Courses Section -->
    @php $secUnivComp = $homepageSections['university_comparison'] ?? null; @endphp
    @if(!isset($secUnivComp) || (isset($secUnivComp->is_visible) && $secUnivComp->is_visible))
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
                        <button type="button" class="btn btn-enrollzy btn-enrollzy-white btn-enrollzy-md" data-bs-toggle="modal" data-bs-target="#courseSelectionModal">
                            Compare Now
                            <i class="fa-solid fa-arrow-right-long" style="color: #000;"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        @include('partials.compare-modal')

        @php $secTrendingCourses = $homepageSections['trending_courses'] ?? null; @endphp
        @if(!isset($secTrendingCourses) || (isset($secTrendingCourses->is_visible) && $secTrendingCourses->is_visible))
            <section class="compare-courses-section ptb-70">
                <div class="container">
                    <!-- Part B: Trending Courses Header -->
                    <div class="text-center" style="margin-bottom: 57px;">
                        <span class="marketplace-badge mb-3">Trending Courses</span>
                        <div class="heading-with-lines d-flex align-items-center justify-content-center gap-3 mb-3">
                            <span class="heading-line d-none d-md-block"></span>
                            <h2 class="section-title mb-0">
                                {{ !empty($secTrendingCourses->title) ? $secTrendingCourses->title : "Build skills employers actually want" }}
                            </h2>
                            <span class="heading-line d-none d-md-block"></span>
                        </div>
                        <p class="section-subtitle mx-auto text-muted" style="max-width: 900px;">
                            {!! !empty($secTrendingCourses->subtitle) ? $secTrendingCourses->subtitle : "Prepare for the top competitive exams and professional career courses in the country." !!}
                        </p>
                    </div>

                    <!-- Course Cards Grid -->
                    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-6 g-3 mb-5">
                        @if(isset($trendingCourses) && $trendingCourses->count() > 0)
                            @foreach($trendingCourses as $course)
                                <div class="col">
                                    <a href="{{ !empty($course->url) ? (str_starts_with($course->url, 'http') ? $course->url : url($course->url)) : route('university', ['search' => $course->name]) }}" class="text-decoration-none text-dark">
                                        <div class="course-card h-100">
                                            <img src="{{ !empty($course->image) ? asset($course->image) : 'assets/images/training-course-img.png' }}" alt="{{ $course->name }}" class="course-img-circular">
                                            <h3 class="course-title" title="{{ $course->name }}">{{ Str::limit($course->name, 22) }}</h3>
                                            <span class="course-instructor">{{ $course->instructor ?? 'Featured Course' }}</span>
                                            <div class="course-footer">
                                                <span class="star-rating">★★★★★ <span class="text-dark">{{ $course->rating ?? '4.9' }}</span></span>
                                                <span class="text-primary">{{ $course->price ?? 'Popular' }}</span>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        @endif
                    </div>

                    <!-- View More Button (Shows only if cta_title is set in admin Homepage Sections) -->
                    @if(!empty($secTrendingCourses->cta_title))
                        <div class="text-center">
                            <a href="{{ !empty($secTrendingCourses->cta_url) ? (str_starts_with($secTrendingCourses->cta_url, 'http') ? $secTrendingCourses->cta_url : url($secTrendingCourses->cta_url)) : route('university') }}" class="btn btn-enrollzy btn-enrollzy-lg text-decoration-none text-white">
                                {{ $secTrendingCourses->cta_title }} <i class="fa-solid fa-arrow-right-long"></i>
                            </a>
                        </div>
                    @endif
                </div>
            </section>
        @endif
    @endif
                        @endif
                        @break

                    @case('student_form')
                        @if(!in_array('student_form', $renderedSectionKeys))
                            @php $renderedSectionKeys[] = 'student_form'; @endphp
<!-- Let's Get in Touch Section (Student Form) -->
    @php $secStudentForm = $homepageSections['student_form'] ?? null; @endphp
    @if(!isset($secStudentForm) || (isset($secStudentForm->is_visible) && $secStudentForm->is_visible))
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
                            <h2 class="section-title mb-2 text-start" style="font-size: 2.2rem;">
                                {{ !empty($secStudentForm->title) ? $secStudentForm->title : "Let’s Get in Touch" }}</h2>
                            <p class="text-muted mb-4">
                                {!! !empty($secStudentForm->subtitle) ? $secStudentForm->subtitle : "Leave us a message and our advisors will get back to you shortly." !!}
                            </p>

                            @if(session('success'))
                                <div class="alert alert-success alert-dismissible fade show mb-4 p-3 shadow-sm border-0 bg-success text-white rounded-3"
                                    role="alert">
                                    <h5 class="alert-heading fw-bold mb-1"><i class="fa-solid fa-circle-check me-2"></i> Request
                                        Received!</h5>
                                    <span>{{ session('success') }}</span>
                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                                <script>
                                    document.addEventListener("DOMContentLoaded", function () {
                                        const el = document.getElementById("contact-section");
                                        if (el) el.scrollIntoView({ behavior: "smooth" });
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
                                    document.addEventListener("DOMContentLoaded", function () {
                                        const el = document.getElementById("contact-section");
                                        if (el) el.scrollIntoView({ behavior: "smooth" });
                                    });
                                </script>
                            @endif

                            <form action="{{ route('contact.submit') }}" method="POST">
                                @csrf
                                <div class="row g-3 mb-3">
                                    <div class="col-md-6">
                                        <label for="studentName" class="form-label fw-semibold">Student Name <span class="text-danger">*</span></label>
                                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="studentName" placeholder="Enter Student Name" value="{{ old('name') }}" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="phoneNumber" class="form-label fw-semibold">Mobile number <span class="text-danger">*</span></label>
                                        <input type="tel" name="phone" class="form-control @error('phone') is-invalid @enderror" id="phoneNumber" placeholder="Enter Mobile Number" value="{{ old('phone') }}" required>
                                    </div>
                                </div>
                                <div class="mb-4">
                                    <label for="programmeInterested" class="form-label fw-semibold">Programme interested in? <span class="text-danger">*</span></label>
                                    <select name="programme" class="form-select @error('programme') is-invalid @enderror" id="programmeInterested" required>
                                        <option value="" disabled {{ old('programme') ? '' : 'selected' }}>Select Programme</option>
                                        <option value="School" {{ old('programme') == 'School' ? 'selected' : '' }}>School</option>
                                        <option value="Coaching" {{ old('programme') == 'Coaching' ? 'selected' : '' }}>Coaching</option>
                                        <option value="UG" {{ old('programme') == 'UG' ? 'selected' : '' }}>UG</option>
                                        <option value="PG" {{ old('programme') == 'PG' ? 'selected' : '' }}>PG</option>
                                        <option value="Doctorate" {{ old('programme') == 'Doctorate' ? 'selected' : '' }}>Doctorate</option>
                                    </select>
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
    @endif
                        @endif
                        @break

                @endswitch
            @endif
        @endforeach
    @endif

    @if(empty($renderedSectionKeys))

<!-- Categories Section -->
    @php $secMarketplace = $homepageSections['marketplace'] ?? null; @endphp
    @if(!isset($secMarketplace) || (isset($secMarketplace->is_visible) && $secMarketplace->is_visible))
        @php
            $secSettings = isset($secMarketplace->settings) ? (is_array($secMarketplace->settings) ? $secMarketplace->settings : json_decode($secMarketplace->settings ?? '[]', true)) : [];
            $itemsVis = $secSettings['items_visibility'] ?? [];
        @endphp
        <section class="categories-section ptb-70">
            <div class="container">
                <!-- Section Header -->
                <div class="text-center heading-card">
                    <span
                        class="marketplace-badge mb-3">{{ !empty($secSettings['badge_text']) ? $secSettings['badge_text'] : (!empty($secMarketplace->cta_title) ? $secMarketplace->cta_title : "India's no.1 Market place") }}</span>
                    <div class="heading-with-lines d-flex align-items-center justify-content-center gap-3 mb-3">
                        <span class="heading-line d-none d-md-block"></span>
                        <h2 class="section-title mb-0">
                            {{ !empty($secMarketplace->title) ? $secMarketplace->title : "Everything education, in one marketplace" }}
                        </h2>
                        <span class="heading-line d-none d-md-block"></span>
                    </div>
                    <p class="section-subtitle mx-auto text-muted">
                        {!! !empty($secMarketplace->subtitle) ? $secMarketplace->subtitle : "From your first school admission to your first job offer — we cover every milestone of your education journey." !!}
                    </p>
                </div>

                @php
                    $marketplaceItems = [
                        'schools' => ['name' => 'Schools', 'count' => ($schoolsCount ?? 0) . '+ listed', 'bgColor' => '#FCD8CB33', 'url' => route('all-schools')],
                        'coaching' => ['name' => 'Coaching', 'count' => ($coachingCount ?? 0) . '+ listed', 'bgColor' => '#09FF6333', 'url' => route('all.coaching')],
                        'universities' => ['name' => 'Universities', 'count' => ($universitiesCount ?? 0) . '+ listed', 'bgColor' => '#83CBFF33', 'url' => route('university')],
                        'colleges' => ['name' => 'Colleges', 'count' => ($collegesCount > 0 ? $collegesCount : $universitiesCount) . '+ listed', 'bgColor' => '#FFCC0033', 'url' => route('university')],
                        'mentors' => ['name' => 'Mentors', 'count' => ($mentorsCount ?? 0) . '+ listed', 'bgColor' => '#FFCC0033', 'url' => route('mentors')],
                        'scholarships' => ['name' => 'Scholarships', 'count' => ($scholarshipsCount ?? 850) . '+ listed', 'bgColor' => '#FCD8CB33', 'url' => route('scholarships')],
                        'internships' => ['name' => 'Internships', 'count' => ($internshipsCount ?? 4500) . '+ listed', 'bgColor' => '#FCD8CB33', 'url' => '#'],
                        'top_exams' => ['name' => 'Top Exams', 'count' => ($totalExamsCount ?? 0) . '+ listed', 'bgColor' => '#83CBFF33', 'url' => route('top-exams')],
                        'exam_bodies' => ['name' => 'Exam Bodies', 'count' => ($examBodiesCount > 0 ? $examBodiesCount : 12) . '+ listed', 'bgColor' => '#09FF6333', 'url' => '#'],
                        'counselling_bodies' => ['name' => 'Counselling Bodies', 'count' => ($counsellingBodiesCount > 0 ? $counsellingBodiesCount : 8) . '+ listed', 'bgColor' => '#FCD8CB33', 'url' => '#'],
                        'regulatory_bodies' => ['name' => 'Regulatory Bodies', 'count' => ($regulatoryBodiesCount > 0 ? $regulatoryBodiesCount : 10) . '+ listed', 'bgColor' => '#FFCC0033', 'url' => '#'],
                        'govt_agencies' => ['name' => 'Govt Agencies', 'count' => ($govAgenciesCount > 0 ? $govAgenciesCount : 6) . '+ listed', 'bgColor' => '#83CBFF33', 'url' => '#'],
                        'blogs' => ['name' => 'Blogs & Guidance', 'count' => ($blogsCount ?? 0) . '+ published', 'bgColor' => '#09FF6333', 'url' => route('blogs')],
                        'all_institutions' => ['name' => 'All Institutions', 'count' => ($totalInstitutionsCount ?? 0) . '+ listed', 'bgColor' => '#FCD8CB33', 'url' => route('university')],
                    ];
                @endphp

                <!-- Categories Grid -->
                <div class="row row-cols-2 row-cols-sm-3 row-cols-md-4 row-cols-lg-7 category-row justify-content-center">
                    @foreach($marketplaceItems as $key => $item)
                        @if(!isset($itemsVis[$key]) || $itemsVis[$key] == '1' || $itemsVis[$key] === true)
                            <div class="col">
                                <a href="{{ $item['url'] }}" class="text-decoration-none">
                                    <div class="category-card">
                                        <div class="category-icon-wrapper" style="background-color: {{ $item['bgColor'] }};">
                                            <img src="{{ asset('assets/images/education-list-icon.svg') }}" alt="{{ $item['name'] }}">
                                        </div>
                                        <h3 class="category-name">{{ $item['name'] }}</h3>
                                        <span class="category-count">{{ $item['count'] }}</span>
                                    </div>
                                </a>
                            </div>
                        @endif
                    @endforeach
                </div>

                <!-- Optional CTA Button -->
                @if(!empty($secMarketplace->cta_title) && !empty($secMarketplace->cta_url))
                    <div class="text-center mt-5">
                        <a href="{{ str_starts_with($secMarketplace->cta_url, 'http') ? $secMarketplace->cta_url : url($secMarketplace->cta_url) }}"
                            class="btn btn-enrollzy btn-enrollzy-lg text-white text-decoration-none">
                            {{ $secMarketplace->cta_title }}
                            <i class="fa-solid fa-arrow-right-long ms-1"></i>
                        </a>
                    </div>
                @endif
            </div>
        </section>
    @endif

<!-- Boarding School Section -->
    @php $secInstituteMarquee = $homepageSections['institute_marquee'] ?? null; @endphp
    @if(!isset($secInstituteMarquee) || (isset($secInstituteMarquee->is_visible) && $secInstituteMarquee->is_visible))
        <div class="grad-main"
            style="background: linear-gradient(180deg, rgba(191, 219, 247, 0) 0%, rgb(191 219 247 / 17%) 50%, rgba(191, 219, 247, 0) 100%);">
            <section class="boarding-schools-section ptb-70">
                <div class="container">
                    <!-- Section Header -->
                    <div class="text-center mb-5">
                        <div class="heading-with-lines d-flex align-items-center justify-content-center gap-3 mb-3">
                            <span class="heading-line d-none d-md-block"></span>
                            <h2 class="section-title mb-0">
                                {{ !empty($secInstituteMarquee->title) ? $secInstituteMarquee->title : "BOARDING SCHOOL" }}</h2>
                            <span class="heading-line d-none d-md-block"></span>
                        </div>
                        <p class="section-subtitle mx-auto text-muted" style="max-width: 900px;">
                            {!! !empty($secInstituteMarquee->subtitle) ? $secInstituteMarquee->subtitle : "Explore India's leading boarding schools and discover institutions designed to shape academic excellence, leadership, character, and future success. Compare schools, curriculum, facilities, campus life, and admissions — all in one place." !!}
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
                                            <img src="{{ $school->logo_url ? (str_starts_with($school->logo_url, 'http') ? $school->logo_url : rtrim(env('BACKEND_URL', 'http://127.0.0.1:8001'), '/') . '/' . ltrim($school->logo_url, '/')) : asset('assets/images/boarding-school-logo.png') }}"
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
                        @if(!empty($secInstituteMarquee->cta_title) && !empty($secInstituteMarquee->cta_url))
                            <a href="{{ str_starts_with($secInstituteMarquee->cta_url, 'http') ? $secInstituteMarquee->cta_url : url($secInstituteMarquee->cta_url) }}"
                                class="btn btn-enrollzy btn-enrollzy-lg text-decoration-none text-white">
                                {{ $secInstituteMarquee->cta_title }} <i class="fa-solid fa-arrow-right-long"></i>
                            </a>
                        @else
                            <a href="{{ route('all-schools') }}"
                                class="btn btn-enrollzy btn-enrollzy-lg text-decoration-none text-white">
                                View More <i class="fa-solid fa-arrow-right-long"></i>
                            </a>
                        @endif
                    </div>
                </div>
            </section>
        </div>
    @endif

<!-- Coaching Institutes Section -->
    @php $secSchoolMarquee = $homepageSections['school_marquee'] ?? null; @endphp
    @if(!isset($secSchoolMarquee) || (isset($secSchoolMarquee->is_visible) && $secSchoolMarquee->is_visible))
        <section class="coaching-institutes-section ptb-70">
            <div class="container">
                <!-- Section Header -->
                <div class="text-center mb-5">
                    <div class="heading-with-lines d-flex align-items-center justify-content-center gap-3 mb-3">
                        <span class="heading-line d-none d-md-block"></span>
                        <h2 class="section-title mb-0">
                            {{ !empty($secSchoolMarquee->title) ? $secSchoolMarquee->title : "COACHING INSTITUTES" }}</h2>
                        <span class="heading-line d-none d-md-block"></span>
                    </div>
                    <p class="section-subtitle mx-auto text-muted" style="max-width: 900px;">
                        {!! !empty($secSchoolMarquee->subtitle) ? $secSchoolMarquee->subtitle : "Discover leading coaching institutes that help students prepare for competitive exams and future success through expert mentorship, structured learning, and proven outcomes." !!}
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
                                    <img src="{{ $coaching->logo_url ? (str_starts_with($coaching->logo_url, 'http') ? $coaching->logo_url : rtrim(env('BACKEND_URL', 'http://127.0.0.1:8001'), '/') . '/' . ltrim($coaching->logo_url, '/')) : asset('assets/images/boarding-school-logo.png') }}"
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
    @endif
    </div>

<!-- Journey Section -->
    @php $secWhyChooseUs = $homepageSections['why_choose_us'] ?? null; @endphp
    @if(!isset($secWhyChooseUs) || (isset($secWhyChooseUs->is_visible) && $secWhyChooseUs->is_visible))
        <section class="journey-section ptb-70">
            <div class="blue-shadow">
                <img src="assets/images/journey-blue-shadow.png" alt="">
            </div>
            <div class="pink-shadow">
                <img src="assets/images/journey-pink-shadow.png" alt="">
            </div>
            <div class="container-fluid">
                @php 
                                $whySettings = is_array($secWhyChooseUs->settings ?? null) ? $secWhyChooseUs->settings : json_decode($secWhyChooseUs->settings ?? '[]', true);
                    $badgeText = !empty($whySettings['badge_text']) ? $whySettings['badge_text'] : "Why choose enrollzy";
                @endphp
                <div class="text-center mb-5">
                    <span class="marketplace-badge mb-3">{{ $badgeText }}</span>
                    <div class="heading-with-lines d-flex align-items-center justify-content-center gap-3 mb-3">
                        <span class="heading-line d-none d-md-block"></span>
                        <h2 class="section-title mb-0">
                            {{ !empty($secWhyChooseUs->title) ? $secWhyChooseUs->title : "Your step-by-step journey to success" }}
                        </h2>
                        <span class="heading-line d-none d-md-block"></span>
                    </div>
                    <p class="section-subtitle mx-auto text-muted" style="max-width: 900px;">
                        {!! !empty($secWhyChooseUs->subtitle) ? $secWhyChooseUs->subtitle : "We guide you from school to your dream career with personalised milestones, resources, and mentors at every stage." !!}
                    </p>
                </div>

                <!-- Journey Steps Grid -->
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-6 g-4 mt-5 justify-content-center"
                    style="margin-bottom:57px !important">
                    @if(isset($home_services) && count($home_services) > 0)
                        @foreach($home_services as $index => $item)
                            <div class="col journey-step-col">
                                <div class="journey-icon-wrapper"
                                    style="width: 72px; height: 72px; min-width: 72px; min-height: 72px; border-radius: 50%; display: inline-flex; align-items: center; justify-content: center; overflow: hidden; background: #ffffff; border: 1px solid rgba(15, 89, 199, 0.15); margin: 0 auto 15px auto; box-shadow: 0px 4px 12px rgba(15, 89, 199, 0.08);">
                                    @if(!empty($item->image))
                                        <img src="{{ str_starts_with($item->image, 'http') ? $item->image : (file_exists(public_path($item->image)) ? asset($item->image) : rtrim(env('BACKEND_URL', 'http://127.0.0.1:8001'), '/') . '/' . ltrim($item->image, '/')) }}"
                                            alt="{{ $item->title }}"
                                            style="max-width: 100%; max-height: 100%; width: 100%; height: 100%; object-fit: cover; border-radius: 50%;">
                                    @else
                                        <img src="{{ asset('assets/images/step-img-' . (($index % 6) + 1) . '.png') }}"
                                            alt="{{ $item->title }}"
                                            style="max-width: 100%; max-height: 100%; width: 100%; height: 100%; object-fit: contain;">
                                    @endif
                                </div>
                                <h3 class="journey-step-title">{{ $item->title }}</h3>
                                <p class="journey-step-desc"
                                    style="display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden;">
                                    {!! strip_tags($item->description) !!}</p>
                                @if(!empty($item->footer_text))
                                    <span class="d-block mt-1 text-primary fw-semibold"
                                        style="font-size: 11px;">{{ Str::limit($item->footer_text, 35) }}</span>
                                @endif
                            </div>
                        @endforeach
                    @else
                        <!-- Step 1 -->
                        <div class="col journey-step-col">
                            <div class="journey-icon-wrapper">
                                <!-- Book SVG -->
                                <img src="assets/images/step-img-1.png" alt="Explore & Discover">
                            </div>
                            <h3 class="journey-step-title">Explore & Discover</h3>
                            <p class="journey-step-desc">Find your interests and aptitude <br> through guided assessments</p>
                        </div>

                        <!-- Step 2 -->
                        <div class="col journey-step-col">
                            <div class="journey-icon-wrapper">
                                <!-- Cap SVG -->
                                <img src="assets/images/step-img-2.png" alt="Choose Institution">
                            </div>
                            <h3 class="journey-step-title">Choose Institution</h3>
                            <p class="journey-step-desc">Compare & apply to best-fit <br> schools, coaching, or colleges</p>
                        </div>
                        <!-- Step 3 -->
                        <div class="col journey-step-col">
                            <div class="journey-icon-wrapper">
                                <!-- Trophy SVG -->
                                <img src="assets/images/step-img-3.png" alt="Secure Funding">
                            </div>
                            <h3 class="journey-step-title">Secure Funding</h3>
                            <p class="journey-step-desc">Apply for scholarships & financial <br> aid through Enrollzy</p>
                        </div>
                        <!-- Step 4 -->
                        <div class="col journey-step-col">
                            <div class="journey-icon-wrapper">
                                <!-- Books SVG -->
                                <img src="assets/images/step-img-4.png" alt="Skill Up">
                            </div>
                            <h3 class="journey-step-title">Skill Up</h3>
                            <p class="journey-step-desc">Take certifications and courses <br> alongside academics</p>
                        </div>
                        <!-- Step 5 -->
                        <div class="col journey-step-col">
                            <div class="journey-icon-wrapper">
                                <!-- Mentors SVG -->
                                <img src="assets/images/step-img-5.png" alt="Get a Mentor">
                            </div>
                            <h3 class="journey-step-title">Get a Mentor</h3>
                            <p class="journey-step-desc">1:1 sessions with industry experts <br> and alumni</p>
                        </div>
                        <!-- Step 6 -->
                        <div class="col journey-step-col">
                            <div class="journey-icon-wrapper">
                                <!-- Briefcase SVG -->
                                <img src="assets/images/step-img-6.png" alt="Land the Job">
                            </div>
                            <h3 class="journey-step-title">Land the Job</h3>
                            <p class="journey-step-desc">Internships, placements, and <br> career support on one platform</p>
                        </div>
                    @endif
                </div>

                @if(!empty($secWhyChooseUs->cta_url) || !empty($secWhyChooseUs->cta_title))
                    <!-- Start Journey Button -->
                    <div class="text-center">
                        <a href="{{ !empty($secWhyChooseUs->cta_url) ? $secWhyChooseUs->cta_url : '#' }}"
                            class="btn btn-enrollzy btn-enrollzy-lg">
                            {{ !empty($secWhyChooseUs->cta_title) ? $secWhyChooseUs->cta_title : 'Start your Journey' }}
                            <i class="fa-solid fa-arrow-right-long" style="color: #fff;"></i>
                        </a>
                    </div>
                @endif
            </div>
        </section>
    @endif

<!-- Scholarships Section -->
    @php $secSpecialized = $homepageSections['specialized_courses'] ?? null; @endphp
    @if(!isset($secSpecialized) || (isset($secSpecialized->is_visible) && $secSpecialized->is_visible))
        <section class="scholarships-section ptb-70"
            style="    background: linear-gradient(180deg, #FFFFFF 0%, #f8fbfd 49%, #f8fbfd 100%);">
            <div class="container">
                <!-- Section Header -->
                <div class="text-center mb-5">
                    <span
                        class="marketplace-badge mb-3">{{ !empty($secSpecialized->cta_title) ? $secSpecialized->cta_title : "Scholarships & Benefits" }}</span>
                    <div class="heading-with-lines d-flex align-items-center justify-content-center gap-3 mb-3">
                        <span class="heading-line d-none d-md-block"></span>
                        <h2 class="section-title mb-0">
                            {{ !empty($secSpecialized->title) ? $secSpecialized->title : "Don't miss out on free money" }}</h2>
                        <span class="heading-line d-none d-md-block"></span>
                    </div>
                    <p class="section-subtitle mx-auto text-muted" style="max-width: 900px;">
                        {!! !empty($secSpecialized->subtitle) ? $secSpecialized->subtitle : "4,500+ scholarships worth over ₹200 Cr available. We match you automatically based on your profile." !!}
                    </p>
                </div>

                <!-- Scholarship Cards Grid -->
                <div class="row row-cols-1 row-cols-md-3 g-4 mb-5">
                    @if(isset($featuredScholarships) && count($featuredScholarships) > 0)
                        @foreach($featuredScholarships as $scholarship)
                            @php
                                $reward = 'Up to ₹50,000 / year';
                                if (!empty($scholarship->max_amount) && $scholarship->max_amount > 0) {
                                    $prefix = $scholarship->amount_prefix ?? 'Up to';
                                    $suffix = $scholarship->amount_suffix ?? '/ year';
                                    $reward = trim($prefix . ' ₹' . number_format($scholarship->max_amount, 0) . ' ' . $suffix);
                                }
                                $icon = $scholarship->provider_logo ?: ($scholarship->card_icon ?: $scholarship->featured_image);
                            @endphp
                            <div class="col">
                                <div class="scholarship-card h-100 d-flex flex-column justify-content-between">
                                    <div>
                                        <div class="d-flex align-items-center gap-3 mb-3">
                                            @if($icon)
                                                <div
                                                    style="width: 48px; height: 48px; min-width: 48px; border-radius: 50%; overflow: hidden; background: #fff; border: 1px solid #eee; display: flex; align-items: center; justify-content: center;">
                                                    <img src="{{ str_starts_with($icon, 'http') ? $icon : (file_exists(public_path($icon)) ? asset($icon) : rtrim(env('BACKEND_URL', 'http://127.0.0.1:8001'), '/') . '/' . ltrim($icon, '/')) }}"
                                                        alt="{{ $scholarship->title }}"
                                                        style="max-width: 100%; max-height: 100%; object-fit: contain;">
                                                </div>
                                            @endif
                                            <div>
                                                <h3 class="scholarship-title mb-0" style="font-size: 1.1rem;">
                                                    <a href="{{ route('scholarship.detail', $scholarship->slug ?? $scholarship->id) }}"
                                                        class="text-dark text-decoration-none">{{ $scholarship->title }}</a>
                                                </h3>
                                                @if($scholarship->provider_name)
                                                    <small class="text-muted d-block" style="font-size: 12px;">{{ $scholarship->provider_name }}</small>
                                                @endif
                                            </div>
                                        </div>
                                        <span class="scholarship-amount d-block mb-2">{{ $reward }}</span>
                                        <p class="text-muted mb-3"
                                            style="font-size: 13px; line-height: 1.5; display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden;">
                                            {!! strip_tags($scholarship->short_description ?: ($scholarship->overview ?: $scholarship->about_scholarship)) !!}
                                        </p>
                                        <div class="scholarship-badges-row mb-3">
                                            <span class="badge-stream">{{ $scholarship->category ?: 'Any stream' }}</span>
                                            <span class="badge-income">{{ $scholarship->scholarship_type ?: 'Merit-based' }}</span>
                                        </div>
                                    </div>
                                    <a href="{{ route('scholarship.detail', $scholarship->slug ?? $scholarship->id) }}"
                                        class="btn btn-enrollzy btn-enrollzy-md w-100 mt-auto">
                                        Check eligibility & Apply
                                        <i class="fa-solid fa-arrow-right-long" style="color: #fff;"></i>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    @elseif(isset($home_benefits) && count($home_benefits) > 0)
                        @foreach($home_benefits as $benefit)
                            @php
                                $reward = $benefit->reward_amount ?: 'Upto INR 30,000';
                                $contentLower = strtolower($benefit->content);
                                $titleLower = strtolower($benefit->title);
                                $fullText = $titleLower . ' ' . $contentLower;

                                $stream = 'Any stream';
                                if (str_contains($fullText, 'engineering') || str_contains($fullText, 'neet') || str_contains($fullText, 'jee') || str_contains($fullText, 'science')) {
                                    $stream = 'Science / Tech';
                                } elseif (str_contains($fullText, 'commerce') || str_contains($fullText, 'mba') || str_contains($fullText, 'bba')) {
                                    $stream = 'Management';
                                }

                                $income = 'Merit-based';
                                if (str_contains($fullText, 'income') || str_contains($fullText, 'minority') || str_contains($fullText, 'welfare')) {
                                    $income = 'Income < ₹8L';
                                }
                            @endphp
                            <div class="col">
                                <div class="scholarship-card h-100 d-flex flex-column justify-content-between">
                                    <div>
                                        <div class="d-flex align-items-center gap-3 mb-3">
                                            @if($benefit->icon)
                                                <div
                                                    style="width: 48px; height: 48px; min-width: 48px; border-radius: 50%; overflow: hidden; background: #fff; border: 1px solid #eee; display: flex; align-items: center; justify-content: center;">
                                                    <img src="{{ str_starts_with($benefit->icon, 'http') ? $benefit->icon : (file_exists(public_path($benefit->icon)) ? asset($benefit->icon) : rtrim(env('BACKEND_URL', 'http://127.0.0.1:8001'), '/') . '/' . ltrim($benefit->icon, '/')) }}"
                                                        alt="{{ $benefit->title }}"
                                                        style="max-width: 100%; max-height: 100%; object-fit: contain;">
                                                </div>
                                            @endif
                                            <h3 class="scholarship-title mb-0" style="font-size: 1.1rem;">
                                                <a href="{{ route('scholarship.detail', $benefit->id) }}"
                                                    class="text-dark text-decoration-none">{{ $benefit->title }}</a>
                                            </h3>
                                        </div>
                                        <span class="scholarship-amount d-block mb-2">{{ $reward }}</span>
                                        <p class="text-muted mb-3"
                                            style="font-size: 13px; line-height: 1.5; display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden;">
                                            {!! strip_tags($benefit->content) !!}
                                        </p>
                                        <div class="scholarship-badges-row mb-3">
                                            <span class="badge-stream">{{ $stream }}</span>
                                            <span class="badge-income">{{ $income }}</span>
                                        </div>
                                    </div>
                                    <a href="{{ route('scholarship.detail', $benefit->id) }}"
                                        class="btn btn-enrollzy btn-enrollzy-md w-100 mt-auto">
                                        Check eligibility & Apply
                                        <i class="fa-solid fa-arrow-right-long" style="color: #fff;"></i>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <!-- Fallback Card 1 -->
                        <div class="col">
                            <div class="scholarship-card">
                                <div>
                                    <h3 class="scholarship-title">PM Scholarship Scheme</h3>
                                    <a href="#" class="scholarship-authority">Government of India · Central Sector Scheme</a>
                                    <span class="scholarship-amount">₹75,000 <span
                                            style="font-size: 1rem; color: #777777; font-weight: 500;">/year</span></span>
                                    <div class="scholarship-meta-row">
                                        <span class="scholarship-meta-item">Merit-based</span>
                                        <span class="scholarship-meta-item">Dec 31, 2026</span>
                                    </div>
                                    <div class="scholarship-badges-row">
                                        <span class="badge-stream">Any stream</span>
                                        <span class="badge-income">Income &lt; ₹8L</span>
                                    </div>
                                </div>
                                <a href="{{ route('scholarships') }}" class="btn btn-enrollzy btn-enrollzy-md w-100 mt-3">
                                    Check eligibility & Apply
                                    <i class="fa-solid fa-arrow-right-long" style="color: #fff;"></i>
                                </a>
                            </div>
                        </div>
                    @endif
                </div>

                <!-- View More Button -->
                <div class="text-center">
                    <a href="{{ route('scholarships') }}"
                        class="btn btn-enrollzy btn-enrollzy-lg text-decoration-none text-white">View
                        More <i class="fa-solid fa-arrow-right-long"></i></a>
                </div>
            </div>
        </section>
    @endif

<!-- Trending Section -->
    @php $secNoteworthy = $homepageSections['noteworthy_mentions'] ?? null; @endphp
    @if(!isset($secNoteworthy) || (isset($secNoteworthy->is_visible) && $secNoteworthy->is_visible))
        <section class="trending-section ptb-70">
            <div class="container">
                <!-- Section Header -->
                <div class="text-center" style="margin-bottom: 57px;">
                    <div class="heading-with-lines d-flex align-items-center justify-content-center gap-3 mb-3">
                        <span class="heading-line d-none d-md-block"></span>
                        <h2 class="section-title mb-0">
                            {{ !empty($secNoteworthy->title) ? $secNoteworthy->title : "Trending Learning Opportunities" }}</h2>
                        <span class="heading-line d-none d-md-block"></span>
                    </div>
                    <p class="section-subtitle mx-auto text-muted" style="max-width: 900px;">
                        {!! !empty($secNoteworthy->subtitle) ? $secNoteworthy->subtitle : "Explore our popular certificates, credentials, and achievements." !!}
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
                                                            <img src="{{ str_starts_with($mention->image, 'http') ? $mention->image : (file_exists(public_path($mention->image)) ? asset($mention->image) : rtrim(env('BACKEND_URL', 'http://127.0.0.1:8001'), '/') . '/' . ltrim($mention->image, '/')) }}"
                                                                alt="{{ $mention->title }}"
                                                                style="width: 22px; height: 22px; object-fit: contain; filter: brightness(0) invert(1);">
                                                        @else
                                                            <span class="text-white fw-bold" style="font-size: 12px;">AI</span>
                                                        @endif
                                                    </div>
                                                    <h4 class="skill-card-title" style="min-height: 48px;">
                                                        @if(!empty($mention->url))
                                                            <a href="{{ $mention->url }}" target="_blank"
                                                                class="text-dark text-decoration-none">{{ $mention->title }}</a>
                                                        @else
                                                            {{ $mention->title }}
                                                        @endif
                                                    </h4>
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
                @if(!empty($secNoteworthy->cta_url))
                    <div class="text-center" style="margin-top: 57px;">
                        <a href="{{ $secNoteworthy->cta_url }}"
                            class="btn btn-enrollzy btn-enrollzy-lg text-decoration-none text-white">
                            {{ !empty($secNoteworthy->cta_title) ? $secNoteworthy->cta_title : 'View More' }}
                            <i class="fa-solid fa-arrow-right-long"></i>
                        </a>
                    </div>
                @endif
            </div>
        </section>
    @endif

<!-- Expert Mentors Section -->
    @php $secMentors = $homepageSections['expert_carousel'] ?? $homepageSections['talk_to_alumni'] ?? null; @endphp
    @if(!isset($secMentors) || (isset($secMentors->is_visible) && $secMentors->is_visible))
        <section class="mentors-section ptb-70">
            <div class="container">
                <!-- Section Header -->
                <div class="text-center mb-5">
                    <div class="heading-with-lines d-flex align-items-center justify-content-center gap-3 mb-3">
                        <span class="heading-line d-none d-md-block"></span>
                        <h2 class="section-title mb-0">{{ !empty($secMentors->title) ? $secMentors->title : "Expert Mentors" }}
                        </h2>
                        <span class="heading-line d-none d-md-block"></span>
                    </div>
                    <p class="section-subtitle mx-auto text-muted" style="max-width: 900px;">
                        {!! !empty($secMentors->subtitle) ? $secMentors->subtitle : "Learn from experienced professionals, industry leaders, and academic mentors dedicated to student success." !!}
                    </p>
                </div>

                <!-- Mentors Grid -->
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-2 row-cols-lg-4 g-4 mb-5">
                    @foreach($mentors as $mentor)
                        <div class="col">
                            <div class="mentor-card h-100 d-flex flex-column">
                                <div class="mentor-img-wrapper" style="height: 250px; overflow: hidden;">
                                    <img src="{{ $mentor->profile_photo ? (str_starts_with($mentor->profile_photo, 'http') ? $mentor->profile_photo : rtrim(env('BACKEND_URL', 'http://127.0.0.1:8001'), '/') . '/' . ltrim($mentor->profile_photo, '/')) : asset('assets/images/mentor1.png') }}"
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
                                            <span class="price-amount">₹{{ number_format($mentor->price_per_min ?? 500, 0) }}</span><span class="price-unit">/min</span>
                                        </div>
                                        <a href="{{ route('mentor.detail', $mentor->id) }}" class="btn btn-enrollzy btn-enrollzy-sm px-3 rounded-pill">Book session <i
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
                    <a href="{{ !empty($secMentors->cta_url) ? (str_starts_with($secMentors->cta_url, 'http') ? $secMentors->cta_url : url($secMentors->cta_url)) : route('mentors') }}" class="btn btn-enrollzy btn-enrollzy-lg text-decoration-none text-white">
                        {{ !empty($secMentors->cta_title) ? $secMentors->cta_title : 'View More' }} <i class="fa-solid fa-arrow-right-long"></i>
                    </a>
                </div>
            </div>
        </section>
    @endif

<!-- FAQ Zone Section -->
    @php $secFaq = $homepageSections['faq'] ?? null; @endphp
    @if(!isset($secFaq) || (isset($secFaq->is_visible) && $secFaq->is_visible))
        <section class="faq-zone-section ptb-70">
            <div class="container">
                <!-- Section Header -->
                <div class="text-center mb-5">
                    <div class="heading-with-lines d-flex align-items-center justify-content-center gap-3 mb-3">
                        <span class="heading-line d-none d-md-block"></span>
                        <h2 class="section-title mb-0">{{ !empty($secFaq->title) ? $secFaq->title : "The FAQ Zone" }}</h2>
                        <span class="heading-line d-none d-md-block"></span>
                    </div>
                    <p class="section-subtitle mx-auto text-muted" style="max-width: 900px;">
                        {!! !empty($secFaq->subtitle) ? $secFaq->subtitle : "Get quick answers about trending programs, skills, certifications, and free courses." !!}
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
    @endif

<!-- Trending Skills & Top Exams Section -->
    @php $secTrendingSkills = $homepageSections['trending_skills'] ?? null; @endphp
    @if(!isset($secTrendingSkills) || (isset($secTrendingSkills->is_visible) && $secTrendingSkills->is_visible))
        <section class="top-exams-section ptb-70">
            <div class="container">
                <!-- Section Header -->
                <div class="text-center mb-5">
                    <div class="heading-with-lines d-flex align-items-center justify-content-center gap-3 mb-3">
                        <span class="heading-line d-none d-md-block"></span>
                        <h2 class="section-title mb-0">
                            {{ !empty($secTrendingSkills->title) ? $secTrendingSkills->title : "Trending Skills & Top Exams" }}
                        </h2>
                        <span class="heading-line d-none d-md-block"></span>
                    </div>
                    <p class="section-subtitle mx-auto text-muted" style="max-width: 900px;">
                        {!! !empty($secTrendingSkills->subtitle) ? $secTrendingSkills->subtitle : "Explore in-demand skills, certifications, and prepare for top competitive exams." !!}
                    </p>
                </div>

                <!-- Dynamic Trending Skills Badges from Admin -->
                @if(isset($trending_skills) && count($trending_skills) > 0)
                    <div class="mb-5 text-center">
                        <div class="d-flex flex-wrap justify-content-center gap-2">
                            @foreach($trending_skills as $skill)
                                @if(!empty($skill->url))
                                    <a href="{{ $skill->url }}" target="_blank"
                                        class="badge bg-light text-primary border border-primary-subtle px-3 py-2 fs-6 rounded-pill text-decoration-none shadow-sm transition-all">
                                        <i class="fa-solid fa-bolt text-warning me-1"></i> {{ $skill->name }}
                                    </a>
                                @else
                                    <span class="badge bg-light text-dark border px-3 py-2 fs-6 rounded-pill shadow-sm">
                                        <i class="fa-solid fa-bolt text-warning me-1"></i> {{ $skill->name }}
                                    </span>
                                @endif
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- Exams Grid -->
                @if(isset($top_exams) && $top_exams->count() > 0)
                    <div class="row row-cols-1 row-cols-md-3 g-5 mb-5 justify-content-center">
                        @foreach($top_exams as $exam)
                            <div class="col text-center">
                                <div class="exam-icon-wrapper">
                                    @if($exam->logo)
                                        <img src="{{ str_starts_with($exam->logo, 'http') ? $exam->logo : rtrim(env('BACKEND_URL', 'http://127.0.0.1:8001'), '/') . '/' . ltrim($exam->logo, '/') }}"
                                            alt="{{ $exam->name }}" style="max-width:45px;max-height:45px;object-fit:contain;">
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
    @endif

<!-- Questions & Answers Section -->
    @php $secQuesAns = $homepageSections['ques_ans'] ?? null; @endphp
    @if(!isset($secQuesAns) || (isset($secQuesAns->is_visible) && $secQuesAns->is_visible))
        <div class="grad-main"
            style="background: linear-gradient(180deg, rgba(191, 219, 247, 0) 0%, rgb(191 219 247 / 30%) 50%, rgba(191, 219, 247, 0) 100%)">
            <section class="qa-section ptb-70">
                <div class="container">
                    <!-- Section Header -->
                    <div class="text-center mb-5">
                        <div class="heading-with-lines d-flex align-items-center justify-content-center gap-3 mb-3">
                            <span class="heading-line d-none d-md-block"></span>
                            <h2 class="section-title mb-0">
                                {{ !empty($secQuesAns->title) ? $secQuesAns->title : "Questions & Answers" }}</h2>
                            <span class="heading-line d-none d-md-block"></span>
                        </div>
                        <p class="section-subtitle mx-auto text-muted" style="max-width: 900px;">
                            {!! !empty($secQuesAns->subtitle) ? $secQuesAns->subtitle : "Here are some of the most commonly asked questions by our prospective students." !!}
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
            </section>
        </div>
    @endif

<!-- Our Latest Blog Section -->
    @php $secBlogs = $homepageSections['blogs'] ?? null; @endphp
    @if(!isset($secBlogs) || (isset($secBlogs->is_visible) && $secBlogs->is_visible))
        <section class="blog-section ptb-70">
            <div class="container">
                <!-- Section Header -->
                <div class="text-center mb-5">
                    <div class="heading-with-lines d-flex align-items-center justify-content-center gap-3 mb-3">
                        <span class="heading-line d-none d-md-block"></span>
                        <h2 class="section-title mb-0">{{ !empty($secBlogs->title) ? $secBlogs->title : "Our Latest Blog" }}
                        </h2>
                        <span class="heading-line d-none d-md-block"></span>
                    </div>
                    <p class="section-subtitle mx-auto text-muted" style="max-width: 900px;">
                        {!! !empty($secBlogs->subtitle) ? $secBlogs->subtitle : "What our students and parents have to say about their experience with us." !!}
                    </p>
                </div>

                <!-- Blog Grid -->
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-2 row-cols-lg-4 g-4 mb-5">
                    @if(isset($blogs) && $blogs->count() > 0)
                        @foreach($blogs as $blog)
                            <div class="col">
                                <div class="blog-card">
                                    <div class="blog-img-wrapper">
                                        <img src="{{ $blog->image ? (str_starts_with($blog->image, 'http') ? $blog->image : rtrim(env('BACKEND_URL', 'http://127.0.0.1:8001'), '/') . '/' . ltrim($blog->image, '/')) : asset('assets/images/blog-img-1.png') }}"
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
    @endif

<!-- Testimonials Section (Video Testimonials) -->
    @php $secVideoTestimonials = $homepageSections['video_testimonials'] ?? null; @endphp
    @if((!isset($secVideoTestimonials) || (isset($secVideoTestimonials->is_visible) && $secVideoTestimonials->is_visible)) && isset($video_testimonials) && $video_testimonials->count() > 0)
        <section class="testimonials-section ptb-70" style="background-color: #FFFCF8;">
            <div class="container">
                <!-- Section Header -->
                <div class="text-center mb-5">
                    <div class="heading-with-lines d-flex align-items-center justify-content-center gap-3 mb-3">
                        <span class="heading-line d-none d-md-block"></span>
                        <h2 class="section-title mb-0">
                            {{ !empty($secVideoTestimonials->title) ? $secVideoTestimonials->title : "Testimonials" }}</h2>
                        <span class="heading-line d-none d-md-block"></span>
                    </div>
                    <p class="section-subtitle mx-auto text-muted" style="max-width: 900px;">
                        {!! !empty($secVideoTestimonials->subtitle) ? $secVideoTestimonials->subtitle : "What our students and parents have to say about their experience with us." !!}
                    </p>
                </div>

                <!-- Video Cards Grid -->
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-2 row-cols-lg-4 g-4 {{ !empty($secVideoTestimonials->cta_title) ? 'mb-5' : '' }}">
                    @foreach($video_testimonials as $video)
                        <div class="col">
                            <div class="testimonial-card"
                                style="background-image: url('{{ $video->thumbnail ? (str_starts_with($video->thumbnail, 'http') ? $video->thumbnail : rtrim(env('BACKEND_URL', 'http://127.0.0.1:8001'), '/') . '/' . ltrim($video->thumbnail, '/')) : asset('assets/images/mentor_1.png') }}');">
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
                </div>

                <!-- View More Button (Shows only if cta_title/label is defined) -->
                @if(!empty($secVideoTestimonials->cta_title))
                    <div class="text-center">
                        <a href="{{ !empty($secVideoTestimonials->cta_url) ? (str_starts_with($secVideoTestimonials->cta_url, 'http') ? $secVideoTestimonials->cta_url : url($secVideoTestimonials->cta_url)) : route('blogs') }}" class="btn btn-enrollzy btn-enrollzy-lg text-decoration-none text-white">
                            {{ $secVideoTestimonials->cta_title }} <i class="fa-solid fa-arrow-right-long"></i>
                        </a>
                    </div>
                @endif
            </div>
        </section>
    @endif

<!-- Student Insights & Feedback Section -->
    @php $secTestimonials = $homepageSections['testimonials'] ?? null; @endphp
    @if((!isset($secTestimonials) || (isset($secTestimonials->is_visible) && $secTestimonials->is_visible)) && isset($testimonials) && $testimonials->count() > 0)
        <section class="feedback-section ptb-70" style="background:#FFFCF8;">
            <div class="container">
                <div class="text-center mb-5">
                    <div class="heading-with-lines d-flex align-items-center justify-content-center gap-3 mb-3">
                        <span class="heading-line d-none d-md-block"></span>
                        <h2 class="section-title mb-0">
                            {{ !empty($secTestimonials->title) ? $secTestimonials->title : "Student Insights & Feedback" }}</h2>
                        <span class="heading-line d-none d-md-block"></span>
                    </div>
                    <p class="section-subtitle mx-auto text-muted" style="max-width: 900px;">
                        {!! !empty($secTestimonials->subtitle) ? $secTestimonials->subtitle : "What our students and parents have to say about their experience with us." !!}
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
                <div class="swiper feedback-swiper" style="overflow: hidden;padding:0px 50px 0px 50px;">
                    <div class="swiper-wrapper">
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
                                        <img src="{{ $testimonial->image ? (str_starts_with($testimonial->image, 'http') ? $testimonial->image : rtrim(env('BACKEND_URL', 'http://127.0.0.1:8001'), '/') . '/' . ltrim($testimonial->image, '/')) : asset('assets/images/mentor_2.png') }}"
                                            alt="{{ $testimonial->name }}" class="feedback-avatar">
                                        <div>
                                            <h4 class="feedback-author-name">{{ $testimonial->name }}</h4>
                                            <span class="feedback-author-title">{{ $testimonial->role }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- View More Button (Shows only if cta_title/label is defined) -->
                @if(!empty($secTestimonials->cta_title))
                    <div class="text-center mt-5">
                        <a href="{{ !empty($secTestimonials->cta_url) ? (str_starts_with($secTestimonials->cta_url, 'http') ? $secTestimonials->cta_url : url($secTestimonials->cta_url)) : '#' }}" class="btn btn-enrollzy btn-enrollzy-lg text-decoration-none text-white">
                            {{ $secTestimonials->cta_title }} <i class="fa-solid fa-arrow-right-long"></i>
                        </a>
                    </div>
                @endif
            </div>
        </section>
    @endif

<!-- Find The Perfect University For You Section -->
    @php $secUnivGrid = $homepageSections['university_grid'] ?? null; @endphp
    @if(!isset($secUnivGrid) || (isset($secUnivGrid->is_visible) && $secUnivGrid->is_visible))
        <section class="perfect-university-section ptb-70" style="padding-bottom: 27px;">
            <div class="container">
                <!-- Section Header -->
                <div class="text-center mb-4">
                    <div class="heading-with-lines d-flex align-items-center justify-content-center gap-3 mb-3">
                        <span class="heading-line d-none d-md-block"></span>
                        <h2 class="section-title mb-0">
                            {{ !empty($secUnivGrid->title) ? $secUnivGrid->title : "Leading Universities" }}</h2>
                        <span class="heading-line d-none d-md-block"></span>
                    </div>
                    <p class="section-subtitle mx-auto text-muted" style="max-width: 900px;">
                        {!! !empty($secUnivGrid->subtitle) ? $secUnivGrid->subtitle : "Discover leading universities offering world-class education, industry-relevant curriculum, and strong career opportunities." !!}
                    </p>
                </div>

                <!-- Category Tabs Navigation -->
                <div class="mb-5 m-auto">
                    <ul class="perfect-univ-tabs nav m-auto" role="tablist" id="perfectUnivTabs">
                        @if(isset($dbStreamTabs) && $dbStreamTabs->count() > 0)
                            @foreach($dbStreamTabs as $tab)
                                <li role="presentation">
                                    <a href="#tab-{{ $tab->key }}" class="perfect-univ-tab {{ $loop->first ? 'active' : '' }}" data-bs-toggle="tab" role="tab" aria-selected="{{ $loop->first ? 'true' : 'false' }}">
                                        {{ $tab->name }}
                                    </a>
                                </li>
                            @endforeach
                        @endif
                    </ul>
                </div>

                <!-- Perfect Match Box Grid -->
                <div class="tab-content">
                    @if(isset($streamData) && count($streamData) > 0)
                        @foreach($streamData as $sKey => $sVal)
                            <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" id="tab-{{ $sKey }}" role="tabpanel">
                                <div class="row row-cols-1 row-cols-lg-3 g-4">
                                    <!-- Column 1: Featured Colleges -->
                                    <div class="col">
                                        <div class="perfect-match-box">
                                            <div class="perfect-match-header">
                                                <h3 class="perfect-match-title mb-0">Featured Colleges</h3>
                                                <a href="{{ route('university') }}" class="btn-view-all-link">View all</a>
                                            </div>
                                            <div class="perfect-badges-grid">
                                                @if(isset($sVal['colleges']) && $sVal['colleges']->count() > 0)
                                                    @foreach($sVal['colleges'] as $univ)
                                                        <a href="{{ route('university.detail', $univ->slug ?? $univ->id) }}" class="badge-univ-pill text-decoration-none text-dark d-inline-block">
                                                            {{ Str::limit($univ->brand_name ?? $univ->name, 25) }}
                                                        </a>
                                                    @endforeach
                                                @endif
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
                                                    <a href="{{ route('top-exams') }}" class="btn-view-all-link">View all</a>
                                                </div>
                                                <div class="perfect-badges-grid" style="padding: 10px 12px;border-radius: 10px;background-color: #fff;border: 1px solid #DDDDDD;">
                                                    @foreach($sVal['exams'] as $ex)
                                                        <a href="{{ route('top-exams', ['search' => $ex]) }}" class="badge-univ-pill text-decoration-none text-dark d-inline-block">
                                                            {{ $ex }}
                                                        </a>
                                                    @endforeach
                                                </div>
                                            </div>
                                            <!-- Box B: Top States -->
                                            <div class="perfect-match-box" style="flex: 1;">
                                                <div class="perfect-match-header" style="margin-bottom:10px;">
                                                    <h3 class="perfect-match-title mb-0">Top States</h3>
                                                    <a href="{{ route('university') }}" class="btn-view-all-link">View all</a>
                                                </div>
                                                <div class="perfect-badges-grid" style="padding: 10px 12px;border-radius: 10px;background-color: #fff;border: 1px solid #DDDDDD;">
                                                    @foreach($sVal['states'] as $st)
                                                        <a href="{{ route('university', ['state' => $st]) }}" class="badge-univ-pill text-decoration-none text-dark d-inline-block">
                                                            {{ $st }}
                                                        </a>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Column 3: Related Courses -->
                                    <div class="col">
                                        <div class="perfect-match-box">
                                            <div class="perfect-match-header">
                                                <h3 class="perfect-match-title mb-0">Related Courses</h3>
                                                <a href="{{ route('university') }}" class="btn-view-all-link">View all</a>
                                            </div>
                                            <div class="perfect-badges-grid">
                                                @foreach($sVal['courses'] as $crs)
                                                    <a href="{{ route('university', ['search' => $crs]) }}" class="badge-univ-pill text-decoration-none text-dark d-inline-block">
                                                        {{ $crs }}
                                                    </a>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>         </div>
                <!-- View More Button (Shows only if cta_title/label is defined) -->
                @if(!empty($secUnivGrid->cta_title))
                    @php
                        $univCtaUrl = route('university');
                        if (!empty($secUnivGrid->cta_url)) {
                            $uStr = $secUnivGrid->cta_url;
                            if (str_contains($uStr, 'university') || str_contains($uStr, 'universities')) {
                                $univCtaUrl = route('university');
                            } elseif (str_starts_with($uStr, 'http')) {
                                $univCtaUrl = $uStr;
                            } else {
                                $univCtaUrl = url($uStr);
                            }
                        }
                    @endphp
                    <div class="text-center mt-5">
                        <a href="{{ $univCtaUrl }}" class="btn btn-enrollzy btn-enrollzy-lg text-decoration-none text-white">
                            {{ $secUnivGrid->cta_title }} <i class="fa-solid fa-arrow-right-long"></i>
                        </a>
                    </div>
                @endif
            </div>
        </section>
    @endif

<!-- Compare Banner & Trending Courses Section -->
    @php $secUnivComp = $homepageSections['university_comparison'] ?? null; @endphp
    @if(!isset($secUnivComp) || (isset($secUnivComp->is_visible) && $secUnivComp->is_visible))
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
                        <button type="button" class="btn btn-enrollzy btn-enrollzy-white btn-enrollzy-md" data-bs-toggle="modal" data-bs-target="#courseSelectionModal">
                            Compare Now
                            <i class="fa-solid fa-arrow-right-long" style="color: #000;"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        @include('partials.compare-modal')

        @php $secTrendingCourses = $homepageSections['trending_courses'] ?? null; @endphp
        @if(!isset($secTrendingCourses) || (isset($secTrendingCourses->is_visible) && $secTrendingCourses->is_visible))
            <section class="compare-courses-section ptb-70">
                <div class="container">
                    <!-- Part B: Trending Courses Header -->
                    <div class="text-center" style="margin-bottom: 57px;">
                        <span class="marketplace-badge mb-3">Trending Courses</span>
                        <div class="heading-with-lines d-flex align-items-center justify-content-center gap-3 mb-3">
                            <span class="heading-line d-none d-md-block"></span>
                            <h2 class="section-title mb-0">
                                {{ !empty($secTrendingCourses->title) ? $secTrendingCourses->title : "Build skills employers actually want" }}
                            </h2>
                            <span class="heading-line d-none d-md-block"></span>
                        </div>
                        <p class="section-subtitle mx-auto text-muted" style="max-width: 900px;">
                            {!! !empty($secTrendingCourses->subtitle) ? $secTrendingCourses->subtitle : "Prepare for the top competitive exams and professional career courses in the country." !!}
                        </p>
                    </div>

                    <!-- Course Cards Grid -->
                    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-6 g-3 mb-5">
                        @if(isset($trendingCourses) && $trendingCourses->count() > 0)
                            @foreach($trendingCourses as $course)
                                <div class="col">
                                    <a href="{{ !empty($course->url) ? (str_starts_with($course->url, 'http') ? $course->url : url($course->url)) : route('university', ['search' => $course->name]) }}" class="text-decoration-none text-dark">
                                        <div class="course-card h-100">
                                            <img src="{{ !empty($course->image) ? asset($course->image) : 'assets/images/training-course-img.png' }}" alt="{{ $course->name }}" class="course-img-circular">
                                            <h3 class="course-title" title="{{ $course->name }}">{{ Str::limit($course->name, 22) }}</h3>
                                            <span class="course-instructor">{{ $course->instructor ?? 'Featured Course' }}</span>
                                            <div class="course-footer">
                                                <span class="star-rating">★★★★★ <span class="text-dark">{{ $course->rating ?? '4.9' }}</span></span>
                                                <span class="text-primary">{{ $course->price ?? 'Popular' }}</span>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        @endif
                    </div>

                    <!-- View More Button (Shows only if cta_title is set in admin Homepage Sections) -->
                    @if(!empty($secTrendingCourses->cta_title))
                        <div class="text-center">
                            <a href="{{ !empty($secTrendingCourses->cta_url) ? (str_starts_with($secTrendingCourses->cta_url, 'http') ? $secTrendingCourses->cta_url : url($secTrendingCourses->cta_url)) : route('university') }}" class="btn btn-enrollzy btn-enrollzy-lg text-decoration-none text-white">
                                {{ $secTrendingCourses->cta_title }} <i class="fa-solid fa-arrow-right-long"></i>
                            </a>
                        </div>
                    @endif
                </div>
            </section>
        @endif
    @endif

<!-- Let's Get in Touch Section (Student Form) -->
    @php $secStudentForm = $homepageSections['student_form'] ?? null; @endphp
    @if(!isset($secStudentForm) || (isset($secStudentForm->is_visible) && $secStudentForm->is_visible))
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
                            <h2 class="section-title mb-2 text-start" style="font-size: 2.2rem;">
                                {{ !empty($secStudentForm->title) ? $secStudentForm->title : "Let’s Get in Touch" }}</h2>
                            <p class="text-muted mb-4">
                                {!! !empty($secStudentForm->subtitle) ? $secStudentForm->subtitle : "Leave us a message and our advisors will get back to you shortly." !!}
                            </p>

                            @if(session('success'))
                                <div class="alert alert-success alert-dismissible fade show mb-4 p-3 shadow-sm border-0 bg-success text-white rounded-3"
                                    role="alert">
                                    <h5 class="alert-heading fw-bold mb-1"><i class="fa-solid fa-circle-check me-2"></i> Request
                                        Received!</h5>
                                    <span>{{ session('success') }}</span>
                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                                <script>
                                    document.addEventListener("DOMContentLoaded", function () {
                                        const el = document.getElementById("contact-section");
                                        if (el) el.scrollIntoView({ behavior: "smooth" });
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
                                    document.addEventListener("DOMContentLoaded", function () {
                                        const el = document.getElementById("contact-section");
                                        if (el) el.scrollIntoView({ behavior: "smooth" });
                                    });
                                </script>
                            @endif

                            <form action="{{ route('contact.submit') }}" method="POST">
                                @csrf
                                <div class="row g-3 mb-3">
                                    <div class="col-md-6">
                                        <label for="studentName" class="form-label fw-semibold">Student Name <span class="text-danger">*</span></label>
                                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="studentName" placeholder="Enter Student Name" value="{{ old('name') }}" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="phoneNumber" class="form-label fw-semibold">Mobile number <span class="text-danger">*</span></label>
                                        <input type="tel" name="phone" class="form-control @error('phone') is-invalid @enderror" id="phoneNumber" placeholder="Enter Mobile Number" value="{{ old('phone') }}" required>
                                    </div>
                                </div>
                                <div class="mb-4">
                                    <label for="programmeInterested" class="form-label fw-semibold">Programme interested in? <span class="text-danger">*</span></label>
                                    <select name="programme" class="form-select @error('programme') is-invalid @enderror" id="programmeInterested" required>
                                        <option value="" disabled {{ old('programme') ? '' : 'selected' }}>Select Programme</option>
                                        <option value="School" {{ old('programme') == 'School' ? 'selected' : '' }}>School</option>
                                        <option value="Coaching" {{ old('programme') == 'Coaching' ? 'selected' : '' }}>Coaching</option>
                                        <option value="UG" {{ old('programme') == 'UG' ? 'selected' : '' }}>UG</option>
                                        <option value="PG" {{ old('programme') == 'PG' ? 'selected' : '' }}>PG</option>
                                        <option value="Doctorate" {{ old('programme') == 'Doctorate' ? 'selected' : '' }}>Doctorate</option>
                                    </select>
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
    @endif

    @endif

@push('scripts')
    <script src="{{ asset('assets/js/compare-modal.js') }}"></script>
@endpush

@endsection