@extends('layouts.app')

@section('content')
<div class="career-roadmap-page-wrapper">

    <!-- 1. HERO BANNER SECTION (MATCHING CLIENT DESIGN MOCKUP) -->
    <section class="roadmap-hero-section py-5 position-relative" style="background: linear-gradient(180deg, #f0f7ff 0%, #ffffff 100%);">
        <div class="container custom-roadmap-container">
            <div class="row align-items-center">
                <!-- Left Content -->
                <div class="col-lg-6 col-12 text-center text-lg-start mb-4 mb-lg-0">
                    <div class="d-inline-flex align-items-center gap-2 px-3 py-1 rounded-pill mb-3" style="background: #e0f2fe; border: 1px solid #bae6fd;">
                        <span class="text-primary fw-bold text-uppercase" style="font-size: 11px; letter-spacing: 0.06em;">PLAN TODAY &bull; A BRIGHTER TOMORROW</span>
                    </div>

                    <h1 class="fw-bold text-dark mb-3 hero-title" style="font-size: 2.6rem; line-height: 1.18; letter-spacing: -0.03em;">
                        Choose the right path.<br>
                        Build your <span class="text-primary" style="color: #2563eb !important;">brighter future.</span>
                    </h1>

                    <p class="text-muted mb-4 hero-desc" style="max-width: 520px; font-size: 0.95rem; line-height: 1.6;">
                        Explore step-by-step career roadmaps from school to higher education, entrance exams, top colleges, skills and job opportunities &mdash; all in one place.
                    </p>

                    <!-- 3 Metric Highlights -->
                    <div class="d-flex flex-wrap gap-3 gap-md-4 justify-content-center justify-content-lg-start pt-2">
                        <div class="d-flex align-items-center gap-2">
                            <div class="metric-icon-circle" style="background: #ecfdf5; color: #10b981; width: 38px; height: 38px; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 15px;">
                                <i class="fa-solid fa-bullseye"></i>
                            </div>
                            <div class="text-start">
                                <div class="fw-bold text-dark lh-1" style="font-size: 13.5px;">100+</div>
                                <span class="text-muted" style="font-size: 11.5px;">Career Pathways</span>
                            </div>
                        </div>

                        <div class="d-flex align-items-center gap-2">
                            <div class="metric-icon-circle" style="background: #fffbeb; color: #f59e0b; width: 38px; height: 38px; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 15px;">
                                <i class="fa-solid fa-book-open"></i>
                            </div>
                            <div class="text-start">
                                <div class="fw-bold text-dark lh-1" style="font-size: 13.5px;">Step-by-Step</div>
                                <span class="text-muted" style="font-size: 11.5px;">Guidance</span>
                            </div>
                        </div>

                        <div class="d-flex align-items-center gap-2">
                            <div class="metric-icon-circle" style="background: #f5f3ff; color: #8b5cf6; width: 38px; height: 38px; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 15px;">
                                <i class="fa-solid fa-building-columns"></i>
                            </div>
                            <div class="text-start">
                                <div class="fw-bold text-dark lh-1" style="font-size: 13.5px;">Colleges &amp; Exams</div>
                                <span class="text-muted" style="font-size: 11.5px;">All in One Place</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Visual Area with Floating Badges -->
                <div class="col-lg-6 col-12 text-center position-relative mt-4 mt-lg-0">
                    <div class="hero-visual-wrapper position-relative d-inline-block">
                        <img src="{{ asset('assets/images/mentor-banner-img.png') }}" alt="Career Roadmap" class="img-fluid rounded-4" style="max-height: 400px; object-fit: contain;">

                        <!-- Floating Badge 1: Top Left -->
                        <div class="floating-badge badge-top-left shadow-sm bg-white rounded-3 p-2 px-3 d-flex align-items-center gap-2 border">
                            <i class="fa-solid fa-compass text-primary fs-5"></i>
                            <div class="text-start">
                                <span class="fw-bold text-dark d-block lh-1" style="font-size: 12px;">Explore</span>
                                <span class="text-muted" style="font-size: 10.5px;">Options</span>
                            </div>
                        </div>

                        <!-- Floating Badge 2: Top Right -->
                        <div class="floating-badge badge-top-right shadow-sm bg-white rounded-3 p-2 px-3 d-flex align-items-center gap-2 border">
                            <i class="fa-solid fa-chart-simple text-primary fs-5"></i>
                            <div class="text-start">
                                <span class="fw-bold text-dark d-block lh-1" style="font-size: 12px;">Make</span>
                                <span class="text-muted" style="font-size: 10.5px;">Informed Decisions</span>
                            </div>
                        </div>

                        <!-- Floating Badge 3: Bottom Right -->
                        <div class="floating-badge badge-bottom-right shadow-sm bg-white rounded-3 p-2 px-3 d-flex align-items-center gap-2 border">
                            <i class="fa-solid fa-trophy text-warning fs-5"></i>
                            <div class="text-start">
                                <span class="fw-bold text-dark d-block lh-1" style="font-size: 12px;">Achieve</span>
                                <span class="text-muted" style="font-size: 10.5px;">Your Goals</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 2. MAIN CATEGORY TABS & STAGES SECTION -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <div class="career-roadmap-wrapper pb-5 pt-2" id="roadmap-categories-sec">
        <div class="container custom-roadmap-container">
            
            <!-- MAIN CLASS SELECTOR CARD (MATCHING CLIENT MOCKUP) -->
            <div class="class-selector-card shadow-sm mb-4" id="class-selector-card">
                
                <!-- Card Header -->
                <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-3 mb-4 pb-2 border-bottom border-light">
                    <div>
                        <h2 class="fw-bold mb-1 class-selector-title" id="dynamic-heading">Select your current class</h2>
                        <p class="text-muted mb-0 class-selector-subtitle">Get personalized career paths based on your current stage of education</p>
                    </div>
                    
                    <a href="{{ route('experts') }}" class="expert-cta-pill text-decoration-none" data-bs-toggle="modal" data-bs-target="#bookSessionModal">
                        <div class="expert-icon-wrap">
                            <i class="fa-solid fa-users"></i>
                        </div>
                        <div class="expert-text-wrap text-start">
                            <span class="expert-hint">Not sure?</span>
                            <span class="expert-action">Talk to our career expert</span>
                        </div>
                        <i class="fa-solid fa-chevron-right expert-chevron"></i>
                    </a>
                </div>

                <!-- Categories & Stages Layout -->
                <div class="categories-stages-wrapper">
                    @php
                        $categoryMeta = [
                            1 => [
                                'icon' => 'fa-solid fa-seedling',
                                'icon_color' => '#10b981',
                                'icon_bg' => '#ecfdf5',
                                'title' => 'Early Stage – Foundation Years',
                                'subtitle' => 'Explore interests and build a strong foundation'
                            ],
                            2 => [
                                'icon' => 'fa-solid fa-compass',
                                'icon_color' => '#0284c7',
                                'icon_bg' => '#f0f9ff',
                                'title' => 'Decision Years',
                                'subtitle' => 'Discover streams and career options'
                            ],
                            3 => [
                                'icon' => 'fa-solid fa-bullseye',
                                'icon_color' => '#10b981',
                                'icon_bg' => '#ecfdf5',
                                'title' => 'Critical Years',
                                'subtitle' => 'Choose the right stream and prepare for your future'
                            ],
                            4 => [
                                'icon' => 'fa-solid fa-building-columns',
                                'icon_color' => '#8b5cf6',
                                'icon_bg' => '#f5f3ff',
                                'title' => 'Higher Education',
                                'subtitle' => 'Explore courses, colleges and career opportunities'
                            ],
                        ];

                        $stageMeta = [
                            'class-5' => [
                                'icon' => 'fa-solid fa-book-open',
                                'theme' => 'stage-mint',
                                'icon_color' => '#10b981'
                            ],
                            'class-6' => [
                                'icon' => 'fa-solid fa-graduation-cap',
                                'theme' => 'stage-purple',
                                'icon_color' => '#8b5cf6'
                            ],
                            'class-7' => [
                                'icon' => 'fa-solid fa-book-bookmark',
                                'theme' => 'stage-blue',
                                'icon_color' => '#2563eb'
                            ],
                            'class-8' => [
                                'icon' => 'fa-solid fa-palette',
                                'theme' => 'stage-amber',
                                'icon_color' => '#f59e0b'
                            ],
                            'class-9' => [
                                'icon' => 'fa-solid fa-book-open',
                                'theme' => 'stage-rose',
                                'icon_color' => '#ef4444'
                            ],
                            'class-10' => [
                                'icon' => 'fa-solid fa-file-lines',
                                'theme' => 'stage-mint',
                                'icon_color' => '#10b981'
                            ],
                            'class-11' => [
                                'icon' => 'fa-solid fa-file-lines',
                                'theme' => 'stage-rose',
                                'icon_color' => '#ef4444'
                            ],
                            'class-12' => [
                                'icon' => 'fa-solid fa-file-lines',
                                'theme' => 'stage-blue',
                                'icon_color' => '#2563eb'
                            ],
                            'graduation' => [
                                'icon' => 'fa-solid fa-graduation-cap',
                                'theme' => 'stage-purple',
                                'icon_color' => '#8b5cf6'
                            ],
                            'post-graduation' => [
                                'icon' => 'fa-solid fa-file-lines',
                                'theme' => 'stage-blue',
                                'icon_color' => '#2563eb'
                            ],
                        ];
                    @endphp

                    @foreach($categories as $category)
                    @php 
                        $catStages = $stages->get($category->id, collect());
                        $meta = $categoryMeta[$category->id] ?? [
                            'icon' => 'fa-solid fa-layer-group',
                            'icon_color' => '#3b82f6',
                            'icon_bg' => '#eff6ff',
                            'title' => $category->name,
                            'subtitle' => 'Explore pathways and career opportunities'
                        ];
                    @endphp
                    <div class="category-block mb-4 pb-1">
                        <!-- Category Header -->
                        <div class="d-flex align-items-center gap-3 mb-3">
                            <div class="cat-icon-badge" style="background-color: {{ $meta['icon_bg'] }}; color: {{ $meta['icon_color'] }};">
                                <i class="{{ $meta['icon'] }}"></i>
                            </div>
                            <div>
                                <h6 class="fw-bold mb-0 text-dark cat-title">{{ $meta['title'] }}</h6>
                                <p class="text-muted mb-0 cat-subtitle">{{ $meta['subtitle'] }}</p>
                            </div>
                        </div>
                        
                        <!-- Stages Grid (4 Equal Columns matching mockup) -->
                        <div class="row g-3 row-cols-1 row-cols-sm-2 row-cols-md-4">
                            @foreach($catStages as $stage)
                            @php
                                $slug = $stage->slug ?? \Illuminate\Support\Str::slug($stage->title);
                                $sMeta = $stageMeta[$slug] ?? [
                                    'icon' => 'fa-solid fa-graduation-cap',
                                    'theme' => 'stage-blue',
                                    'icon_color' => '#2563eb'
                                ];
                            @endphp
                            <div class="col">
                                <button type="button" class="stage-card-btn {{ $sMeta['theme'] }} w-100" data-stage-id="{{ $stage->id }}" data-stage-title="{{ $stage->title }}" data-stage-slug="{{ $slug }}">
                                    <div class="stage-left d-flex align-items-center gap-3">
                                        <i class="{{ $sMeta['icon'] }} stage-card-icon"></i>
                                        <span class="stage-name">{{ $stage->title }}</span>
                                    </div>
                                    <i class="fa-solid fa-chevron-right stage-arrow"></i>
                                </button>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endforeach
                </div>

            </div> <!-- /class-selector-card -->

            <!-- 4-FEATURE HIGHLIGHTS BAR -->
            <div class="roadmap-features-strip p-3 p-md-4 rounded-4 mb-5 shadow-sm">
                <div class="row g-3 align-items-center">
                    <div class="col-6 col-lg-3">
                        <div class="d-flex align-items-center gap-3">
                            <div class="feature-strip-icon icon-blue">
                                <i class="fa-solid fa-compass"></i>
                            </div>
                            <div>
                                <h6 class="fw-bold mb-0 text-dark feature-strip-title">Career Clarity</h6>
                                <span class="text-muted feature-strip-desc">Explore multiple options</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-lg-3">
                        <div class="d-flex align-items-center gap-3">
                            <div class="feature-strip-icon icon-purple">
                                <i class="fa-solid fa-users"></i>
                            </div>
                            <div>
                                <h6 class="fw-bold mb-0 text-dark feature-strip-title">Expert Guidance</h6>
                                <span class="text-muted feature-strip-desc">Insights from industry experts</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-lg-3">
                        <div class="d-flex align-items-center gap-3">
                            <div class="feature-strip-icon icon-cyan">
                                <i class="fa-solid fa-file-lines"></i>
                            </div>
                            <div>
                                <h6 class="fw-bold mb-0 text-dark feature-strip-title">Complete Information</h6>
                                <span class="text-muted feature-strip-desc">Courses, exams, colleges &amp; more</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-lg-3">
                        <div class="d-flex align-items-center gap-3">
                            <div class="feature-strip-icon icon-blue">
                                <i class="fa-solid fa-rocket"></i>
                            </div>
                            <div>
                                <h6 class="fw-bold mb-0 text-dark feature-strip-title">Plan with Confidence</h6>
                                <span class="text-muted feature-strip-desc">A step closer to your dream career</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- STREAMS SECTION (Hidden Initially, populated via AJAX) -->
            <div id="streams-section" class="mb-5 fade-in" style="display: none;">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div>
                        <h4 class="fw-bold mb-1 text-dark" style="font-size: 1.35rem;">Choose your stream or interest area</h4>
                        <p class="text-muted small mb-0">Select the path you are currently on or planning to pursue</p>
                    </div>
                </div>
                
                <div class="row g-3" id="streams-container">
                    <!-- Streams will be injected here via AJAX -->
                </div>
            </div>

            <!-- TIMELINES SECTION (Hidden Initially, populated via AJAX) -->
            <div id="timeline-section" class="fade-in pb-4" style="display: none;">
                
                <!-- Blue/Teal Alert Message -->
                <div id="stream-alert" class="alert d-flex align-items-center rounded-4 mb-4 p-3" role="alert" style="display: none; background-color: #f0fdfa; color: #0f766e; border: 1px solid #ccfbf1 !important;">
                    <i class="fas fa-info-circle fs-5 me-3"></i>
                    <div id="stream-alert-text" class="fw-medium small"></div>
                </div>

                <!-- Vertical Timeline container -->
                <div class="timeline-container-wrapper pt-2">
                    <div id="timeline-container" class="position-relative" style="border-left: 2px solid #e2e8f0; padding-left: 2rem; margin-left: 0.75rem;">
                        <!-- Timeline Groups will be injected here -->
                    </div>
                </div>

            </div>

            <!-- POPULAR CAREER ROADMAPS SECTION (MOCKUP COMPONENT) -->
            <div class="popular-roadmaps-section mb-5 pt-2">
                <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
                    <div>
                        <h3 class="fw-bold mb-1 text-dark" style="font-size: 1.45rem;">Popular Career Roadmaps</h3>
                        <p class="text-muted mb-0 small">Explore some of the most sought-after career paths</p>
                    </div>
                    <a href="#class-selector-card" class="text-primary fw-semibold text-decoration-none d-flex align-items-center gap-1 small view-all-link">
                        View All Roadmaps <i class="fa-solid fa-arrow-right-long ms-1"></i>
                    </a>
                </div>

                <div class="row g-3">
                    <!-- Card 1: Doctor -->
                    <div class="col-12 col-sm-6 col-lg-3">
                        <div class="popular-roadmap-card h-100 p-3 rounded-4 bg-white border d-flex flex-column" onclick="triggerRoadmapBySearch('Doctor', 'medical')">
                            <div class="d-flex align-items-center gap-3 mb-2">
                                <img src="{{ asset('assets/images/mentor-img-1.png') }}" alt="Doctor" class="popular-roadmap-img rounded-3">
                                <div class="flex-grow-1">
                                    <h6 class="fw-bold mb-0 text-dark popular-title">Doctor (MBBS)</h6>
                                    <span class="text-muted pathway-text">Class 11-12 &rarr; NEET &rarr; MBBS &rarr; Medical Specialist</span>
                                </div>
                                <i class="fa-solid fa-chevron-right text-muted small ms-auto"></i>
                            </div>
                            <div class="mt-auto pt-2">
                                <span class="badge badge-tag-green rounded-pill px-3 py-1">High Demand</span>
                            </div>
                        </div>
                    </div>

                    <!-- Card 2: Engineer -->
                    <div class="col-12 col-sm-6 col-lg-3">
                        <div class="popular-roadmap-card h-100 p-3 rounded-4 bg-white border d-flex flex-column" onclick="triggerRoadmapBySearch('Engineer', 'engineering')">
                            <div class="d-flex align-items-center gap-3 mb-2">
                                <img src="{{ asset('assets/images/mentor-img-2.png') }}" alt="Engineer" class="popular-roadmap-img rounded-3">
                                <div class="flex-grow-1">
                                    <h6 class="fw-bold mb-0 text-dark popular-title">Engineer (B.Tech)</h6>
                                    <span class="text-muted pathway-text">Class 11-12 &rarr; JEE &rarr; B.Tech &rarr; Multiple</span>
                                </div>
                                <i class="fa-solid fa-chevron-right text-muted small ms-auto"></i>
                            </div>
                            <div class="mt-auto pt-2">
                                <span class="badge badge-tag-teal rounded-pill px-3 py-1">Versatile Options</span>
                            </div>
                        </div>
                    </div>

                    <!-- Card 3: MBA -->
                    <div class="col-12 col-sm-6 col-lg-3">
                        <div class="popular-roadmap-card h-100 p-3 rounded-4 bg-white border d-flex flex-column" onclick="triggerRoadmapBySearch('MBA', 'management')">
                            <div class="d-flex align-items-center gap-3 mb-2">
                                <img src="{{ asset('assets/images/mentor-img-3.png') }}" alt="MBA" class="popular-roadmap-img rounded-3">
                                <div class="flex-grow-1">
                                    <h6 class="fw-bold mb-0 text-dark popular-title">MBA</h6>
                                    <span class="text-muted pathway-text">Graduation &rarr; CAT &rarr; MBA &rarr; Leadership Roles</span>
                                </div>
                                <i class="fa-solid fa-chevron-right text-muted small ms-auto"></i>
                            </div>
                            <div class="mt-auto pt-2">
                                <span class="badge badge-tag-green rounded-pill px-3 py-1">High Growth</span>
                            </div>
                        </div>
                    </div>

                    <!-- Card 4: Data Scientist -->
                    <div class="col-12 col-sm-6 col-lg-3">
                        <div class="popular-roadmap-card h-100 p-3 rounded-4 bg-white border d-flex flex-column" onclick="triggerRoadmapBySearch('Data Scientist', 'data')">
                            <div class="d-flex align-items-center gap-3 mb-2">
                                <img src="{{ asset('assets/images/mentor-img-4.png') }}" alt="Data Scientist" class="popular-roadmap-img rounded-3">
                                <div class="flex-grow-1">
                                    <h6 class="fw-bold mb-0 text-dark popular-title">Data Scientist</h6>
                                    <span class="text-muted pathway-text">Graduation &rarr; Skills &rarr; PG/Certifications &rarr; Global</span>
                                </div>
                                <i class="fa-solid fa-chevron-right text-muted small ms-auto"></i>
                            </div>
                            <div class="mt-auto pt-2">
                                <span class="badge badge-tag-purple rounded-pill px-3 py-1">Future Ready</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- STILL CONFUSED? GUIDANCE CTA BANNER -->
            <div class="still-confused-banner rounded-4 p-4 p-md-5 position-relative overflow-hidden mb-4 shadow-sm">
                <div class="row align-items-center position-relative" style="z-index: 2;">
                    <div class="col-lg-7 col-md-12 mb-4 mb-lg-0">
                        <div class="confused-badge mb-2">
                            <span class="badge rounded-pill bg-primary bg-opacity-10 text-primary fw-bold text-uppercase px-3 py-2" style="font-size: 11px; letter-spacing: 0.05em;">Still Confused?</span>
                        </div>
                        <h3 class="fw-bold text-dark mb-2 confused-title" style="font-size: 1.6rem;">Let our experts help you choose the right career path</h3>
                        <p class="text-muted mb-4 confused-desc" style="font-size: 0.95rem;">Get personalized guidance based on your interests, strengths and goals.</p>

                        <div class="d-flex flex-wrap gap-3">
                            <button type="button" class="btn btn-primary rounded-pill px-4 py-2 fw-semibold d-flex align-items-center gap-2 shadow-sm" data-bs-toggle="modal" data-bs-target="#bookSessionModal">
                                Talk to Career Expert <i class="fa-solid fa-arrow-right"></i>
                            </button>
                            <a href="{{ route('ask.enrollzy') }}" class="btn btn-outline-primary rounded-pill px-4 py-2 fw-semibold d-flex align-items-center gap-2" style="border-width: 1.5px; background: #ffffff;">
                                Ask Enrollzy <i class="fa-solid fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>

                    <div class="col-lg-5 col-md-12">
                        <div class="d-flex flex-column gap-2 ms-lg-4">
                            <div class="feature-check-item d-flex align-items-center gap-2 bg-white rounded-pill px-3 py-2 shadow-sm border border-light">
                                <i class="fa-solid fa-circle-check text-primary"></i>
                                <span class="fw-semibold text-dark small">Personalized Guidance</span>
                            </div>
                            <div class="feature-check-item d-flex align-items-center gap-2 bg-white rounded-pill px-3 py-2 shadow-sm border border-light">
                                <i class="fa-solid fa-circle-check text-primary"></i>
                                <span class="fw-semibold text-dark small">Course &amp; College Recommendations</span>
                            </div>
                            <div class="feature-check-item d-flex align-items-center gap-2 bg-white rounded-pill px-3 py-2 shadow-sm border border-light">
                                <i class="fa-solid fa-circle-check text-primary"></i>
                                <span class="fw-semibold text-dark small">Exam Preparation Strategy</span>
                            </div>
                            <div class="feature-check-item d-flex align-items-center gap-2 bg-white rounded-pill px-3 py-2 shadow-sm border border-light">
                                <i class="fa-solid fa-circle-check text-primary"></i>
                                <span class="fw-semibold text-dark small">Career Opportunities</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<style>
    /* ==========================================================================
       CAREER ROADMAP WRAPPER & MODERN UI/UX REDESIGN
       ========================================================================== */
    .career-roadmap-page-wrapper {
        font-family: 'Inter', system-ui, -apple-system, sans-serif;
        background-color: #f8fbfe;
    }
    
    .custom-roadmap-container {
        max-width: 1140px;
        margin: 0 auto;
    }

    .text-dark { color: #0f172a !important; }
    .text-muted { color: #64748b !important; }

    /* Floating Badges for Hero Section */
    .floating-badge {
        position: absolute;
        z-index: 5;
        transition: transform 0.3s ease;
        white-space: nowrap;
    }
    .floating-badge:hover {
        transform: translateY(-3px);
    }
    .badge-top-left {
        top: 20px;
        left: -35px;
    }
    .badge-top-right {
        top: 15px;
        right: -30px;
    }
    .badge-bottom-right {
        bottom: 40px;
        right: -25px;
    }

    @media (max-width: 991px) {
        .floating-badge {
            display: none !important;
        }
    }

    /* 1. Main Class Selector Card */
    .class-selector-card {
        background: #ffffff;
        border: 1px solid #e8edf5;
        border-radius: 22px;
        padding: 2.25rem 2.25rem;
        box-shadow: 0 4px 20px -2px rgba(15, 23, 42, 0.03);
    }

    .class-selector-title {
        font-size: 1.55rem;
        color: #0f172a;
        letter-spacing: -0.02em;
    }

    .class-selector-subtitle {
        font-size: 0.92rem;
        color: #64748b;
    }

    /* "Not sure? Talk to career expert" Action Pill */
    .expert-cta-pill {
        display: inline-flex;
        align-items: center;
        gap: 12px;
        background: #f0f7ff;
        border: 1px solid #dbeafe;
        border-radius: 14px;
        padding: 8px 16px;
        transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
        cursor: pointer;
    }
    .expert-cta-pill:hover {
        background: #e0efff;
        border-color: #bfdbfe;
        transform: translateY(-2px);
        box-shadow: 0 6px 16px rgba(37, 99, 235, 0.12);
    }
    .expert-icon-wrap {
        width: 34px;
        height: 34px;
        border-radius: 10px;
        background: #dbeafe;
        color: #2563eb;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 14px;
    }
    .expert-hint {
        font-size: 11px;
        color: #64748b;
        font-weight: 500;
        display: block;
        line-height: 1.2;
    }
    .expert-action {
        font-size: 13px;
        color: #1d4ed8;
        font-weight: 700;
        display: block;
        line-height: 1.2;
    }
    .expert-chevron {
        font-size: 11px;
        color: #1d4ed8;
        transition: transform 0.2s ease;
    }
    .expert-cta-pill:hover .expert-chevron {
        transform: translateX(2px);
    }

    /* Category Headers */
    .cat-icon-badge {
        width: 32px;
        height: 32px;
        border-radius: 9px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 15px;
        flex-shrink: 0;
    }
    .cat-title {
        font-size: 0.98rem;
        font-weight: 700;
        color: #0f172a;
    }
    .cat-subtitle {
        font-size: 0.82rem;
        color: #64748b;
    }

    /* 2. Interactive Stage Card Buttons (Matching Mockup Height and Alignment) */
    .stage-card-btn {
        display: flex;
        align-items: center;
        justify-content: space-between;
        height: 52px;
        border-radius: 12px;
        padding: 0 16px;
        border: 1px solid;
        cursor: pointer;
        text-align: left;
        transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
        width: 100%;
        outline: none;
    }
    .stage-card-btn .stage-card-icon {
        font-size: 15px;
        width: 20px;
        text-align: center;
    }
    .stage-card-btn .stage-name {
        font-weight: 600;
        font-size: 0.92rem;
        color: #0f172a;
        transition: color 0.2s ease;
    }
    .stage-card-btn .stage-arrow {
        font-size: 0.72rem;
        color: #94a3b8;
        transition: transform 0.2s ease, color 0.2s ease;
    }
    .stage-card-btn:hover {
        transform: translateY(-2px);
    }
    .stage-card-btn:hover .stage-arrow {
        transform: translateX(3px);
        color: #64748b;
    }

    /* Specific Stage Color Themes (Pastel Backgrounds with Rich Icon & Active States) */
    /* Mint / Green Theme (Class 5, Class 10) */
    .stage-mint {
        background-color: #f2faf5;
        border-color: #d8f3e5;
    }
    .stage-mint .stage-card-icon { color: #10b981; }
    .stage-mint:hover {
        background-color: #e5f7ed;
        border-color: #bbf7d0;
        box-shadow: 0 4px 14px rgba(16, 185, 129, 0.12);
    }
    .stage-mint.active, .stage-mint:focus-visible {
        background-color: #10b981 !important;
        border-color: #10b981 !important;
        box-shadow: 0 6px 18px rgba(16, 185, 129, 0.28) !important;
    }
    .stage-mint.active .stage-card-icon, .stage-mint.active .stage-name, .stage-mint.active .stage-arrow {
        color: #ffffff !important;
    }

    /* Purple Theme (Class 6, Graduation) */
    .stage-purple {
        background-color: #faf5ff;
        border-color: #ede9fe;
    }
    .stage-purple .stage-card-icon { color: #8b5cf6; }
    .stage-purple:hover {
        background-color: #f3e8ff;
        border-color: #ddd6fe;
        box-shadow: 0 4px 14px rgba(139, 92, 246, 0.12);
    }
    .stage-purple.active, .stage-purple:focus-visible {
        background-color: #8b5cf6 !important;
        border-color: #8b5cf6 !important;
        box-shadow: 0 6px 18px rgba(139, 92, 246, 0.28) !important;
    }
    .stage-purple.active .stage-card-icon, .stage-purple.active .stage-name, .stage-purple.active .stage-arrow {
        color: #ffffff !important;
    }

    /* Blue Theme (Class 7, Class 12, Post graduation) */
    .stage-blue {
        background-color: #f0f7ff;
        border-color: #dbeafe;
    }
    .stage-blue .stage-card-icon { color: #2563eb; }
    .stage-blue:hover {
        background-color: #e0efff;
        border-color: #bfdbfe;
        box-shadow: 0 4px 14px rgba(37, 99, 235, 0.12);
    }
    .stage-blue.active, .stage-blue:focus-visible {
        background-color: #2563eb !important;
        border-color: #2563eb !important;
        box-shadow: 0 6px 18px rgba(37, 99, 235, 0.28) !important;
    }
    .stage-blue.active .stage-card-icon, .stage-blue.active .stage-name, .stage-blue.active .stage-arrow {
        color: #ffffff !important;
    }

    /* Amber / Orange Theme (Class 8) */
    .stage-amber {
        background-color: #fffbeb;
        border-color: #fef3c7;
    }
    .stage-amber .stage-card-icon { color: #f59e0b; }
    .stage-amber:hover {
        background-color: #fef3c7;
        border-color: #fde68a;
        box-shadow: 0 4px 14px rgba(245, 158, 11, 0.12);
    }
    .stage-amber.active, .stage-amber:focus-visible {
        background-color: #f59e0b !important;
        border-color: #f59e0b !important;
        box-shadow: 0 6px 18px rgba(245, 158, 11, 0.28) !important;
    }
    .stage-amber.active .stage-card-icon, .stage-amber.active .stage-name, .stage-amber.active .stage-arrow {
        color: #ffffff !important;
    }

    /* Rose / Coral Theme (Class 9, Class 11) */
    .stage-rose {
        background-color: #fff1f2;
        border-color: #fee2e2;
    }
    .stage-rose .stage-card-icon { color: #ef4444; }
    .stage-rose:hover {
        background-color: #ffe4e6;
        border-color: #fecdd3;
        box-shadow: 0 4px 14px rgba(239, 68, 68, 0.12);
    }
    .stage-rose.active, .stage-rose:focus-visible {
        background-color: #ef4444 !important;
        border-color: #ef4444 !important;
        box-shadow: 0 6px 18px rgba(239, 68, 68, 0.28) !important;
    }
    .stage-rose.active .stage-card-icon, .stage-rose.active .stage-name, .stage-rose.active .stage-arrow {
        color: #ffffff !important;
    }

    /* 3. 4-Feature Highlights Strip */
    .roadmap-features-strip {
        background: #ffffff;
        border: 1px solid #e8edf5;
    }
    .feature-strip-icon {
        width: 44px;
        height: 44px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.2rem;
        flex-shrink: 0;
    }
    .icon-blue { background: #eff6ff; color: #2563eb; }
    .icon-purple { background: #f5f3ff; color: #7c3aed; }
    .icon-cyan { background: #f0fdfa; color: #0284c7; }
    .feature-strip-title { font-size: 0.95rem; }
    .feature-strip-desc { font-size: 0.8rem; }

    /* 4. Popular Roadmaps Section */
    .popular-roadmap-card {
        cursor: pointer;
        border-color: #e8edf5 !important;
        transition: all 0.2s ease;
    }
    .popular-roadmap-card:hover {
        border-color: #93c5fd !important;
        transform: translateY(-3px);
        box-shadow: 0 8px 24px -4px rgba(0, 0, 0, 0.06);
    }
    .popular-roadmap-img {
        width: 48px;
        height: 48px;
        object-fit: cover;
    }
    .popular-title { font-size: 0.95rem; }
    .pathway-text {
        font-size: 0.73rem;
        line-height: 1.35;
        display: block;
    }
    .badge-tag-green { background: #ecfdf5; color: #059669; font-weight: 600; font-size: 11px; }
    .badge-tag-teal { background: #f0fdfa; color: #0d9488; font-weight: 600; font-size: 11px; }
    .badge-tag-purple { background: #f5f3ff; color: #7c3aed; font-weight: 600; font-size: 11px; }

    /* 5. Still Confused Banner */
    .still-confused-banner {
        background: linear-gradient(135deg, #e0f2fe 0%, #f0f9ff 50%, #eff6ff 100%);
        border: 1px solid #bfdbfe;
    }

    /* 6. Dynamic Streams Section */
    .stream-card {
        cursor: pointer;
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 16px;
        transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
        height: 100%;
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        padding: 1.4rem;
    }
    .stream-card:hover {
        border-color: #3b82f6;
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(59, 130, 246, 0.08);
    }
    .stream-card.active {
        background-color: #eff6ff;
        border-color: #2563eb;
        box-shadow: 0 4px 16px rgba(37, 99, 235, 0.15);
    }
    .stream-card.active .stream-title, .stream-card.active .stream-icon {
        color: #1d4ed8 !important;
    }
    .stream-icon {
        color: #2563eb;
        font-size: 1.25rem;
        width: 44px;
        height: 44px;
        border-radius: 12px;
        background: #eff6ff;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 0.85rem;
        transition: all 0.2s ease;
    }
    .stream-card.active .stream-icon {
        background: #2563eb;
        color: #ffffff;
    }
    .stream-title {
        font-size: 0.95rem;
        color: #0f172a;
        font-weight: 700;
        margin-bottom: 0.35rem;
    }
    .stream-desc {
        font-size: 0.8rem;
        color: #64748b;
        line-height: 1.45;
    }

    /* 7. Dynamic Timeline */
    .timeline-group {
        position: relative;
        margin-bottom: 2.5rem;
    }
    .timeline-group:last-child {
        margin-bottom: 0;
    }
    .timeline-dot {
        position: absolute;
        left: -39px; 
        top: 6px;
        width: 14px;
        height: 14px;
        border-radius: 50%;
        background-color: #cbd5e1;
        border: 2px solid #fff;
        box-shadow: 0 0 0 3px rgba(255,255,255,1);
    }
    .dot-blue { background-color: #2563eb !important; box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.2); }
    .dot-green { background-color: #10b981 !important; box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.2); }
    .dot-purple { background-color: #8b5cf6 !important; box-shadow: 0 0 0 3px rgba(139, 92, 246, 0.2); }
    .dot-orange { background-color: #f59e0b !important; box-shadow: 0 0 0 3px rgba(245, 158, 11, 0.2); }

    .timeline-group-title {
        font-size: 1.05rem;
        color: #0f172a;
    }
    
    .action-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 14px;
        padding: 1.35rem;
        transition: all 0.2s ease;
    }
    .action-card:hover {
        border-color: #cbd5e1;
        box-shadow: 0 6px 18px -2px rgba(0, 0, 0, 0.06);
    }
    .action-card.has-children {
        cursor: pointer;
    }
    .action-card.has-children:hover {
        border-color: #2563eb;
        background-color: #f8fafc;
    }
    .action-title {
        font-size: 0.95rem;
        color: #0f172a;
    }
    .salary-text {
        font-size: 0.78rem;
        color: #1f2937;
        background: #fffbeb;
        border: 1px solid #fde68a;
        padding: 6px 12px;
        border-radius: 8px;
        display: inline-flex;
        align-items: center;
        font-weight: 600;
    }

    /* Badges */
    .badge-soft-primary { background: #eff6ff; color: #2563eb; font-weight: 600; font-size: 11.5px; }
    .badge-soft-success { background: #ecfdf5; color: #059669; font-weight: 600; font-size: 11.5px; }
    .badge-soft-warning { background: #fffbeb; color: #d97706; font-weight: 600; font-size: 11.5px; }
    .badge-soft-purple { background: #f5f3ff; color: #7c3aed; font-weight: 600; font-size: 11.5px; }
    .badge-soft-secondary { background: #f1f5f9; color: #475569; border: 1px solid #e2e8f0; font-weight: 600; font-size: 11.5px; }

    /* Long Description Content Styling */
    .long-description-content b, 
    .long-description-content strong {
        font-weight: bold !important;
    }
    .long-description-content i, 
    .long-description-content em {
        font-style: italic !important;
    }
    .long-description-content u {
        text-decoration: underline !important;
    }
    .long-description-content p {
        margin-bottom: 0.5rem;
    }
    .long-description-content p:last-child {
        margin-bottom: 0;
    }
    .long-description-content ul, 
    .long-description-content ol {
        margin-bottom: 0.5rem;
        padding-left: 1.5rem;
    }
    .long-description-content li {
        margin-bottom: 0.25rem;
    }

    /* Animations */
    .fade-in {
        animation: fadeIn 0.3s ease forwards;
    }
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(6px); }
        to { opacity: 1; transform: translateY(0); }
    }

    @media (max-width: 768px) {
        .class-selector-card {
            padding: 1.5rem 1.25rem;
            border-radius: 18px;
        }
        .class-selector-title {
            font-size: 1.35rem;
        }
        .hero-title {
            font-size: 2rem !important;
        }
    }
</style>

<script>
    let cardChildrenMap = {};

    window.showNestedRow = function(e, groupId, cardId) {
        e.stopPropagation();
        const data = cardChildrenMap[cardId];
        if(!data || !data.children || !data.children.length) return;

        const container = document.getElementById('group-nested-' + groupId);
        
        // If clicking the same card that is already open, just toggle it
        if (container.dataset.activeCard == cardId && !container.classList.contains('d-none')) {
            container.classList.add('d-none');
            document.querySelector('.toggle-icon-' + cardId).classList.replace('fa-chevron-up', 'fa-chevron-down');
            return;
        }

        // Reset all icons in this group
        document.querySelectorAll(`#group-row-${groupId} .fa-chevron-up`).forEach(icon => {
            icon.classList.replace('fa-chevron-up', 'fa-chevron-down');
        });

        // Set active
        container.dataset.activeCard = cardId;
        container.classList.remove('d-none');
        document.querySelector('.toggle-icon-' + cardId).classList.replace('fa-chevron-down', 'fa-chevron-up');

        let html = `
            <div class="d-flex align-items-center mb-3">
                <i class="fas fa-level-down-alt text-primary opacity-50 me-2" style="transform: rotate(180deg) scaleX(-1);"></i>
                <h6 class="fw-bold mb-0 text-dark">Details for: <span class="text-primary">${data.title}</span></h6>
            </div>
            <div class="row g-3">
        `;

        data.children.forEach(sub => {
            let cf = sub.custom_fields;
            if(typeof cf === 'string') {
                try { cf = JSON.parse(cf); } catch(e) { cf = {}; }
            }
            const badge = cf ? cf.Badge : null;
            const salary = cf ? cf.Salary : null;

            let badgeClass = 'badge-soft-primary';
            if(badge) {
                const bLow = badge.toLowerCase();
                if(bLow.includes('prep') || bLow.includes('merit') || bLow.includes('success')) badgeClass = 'badge-soft-success';
                if(bLow.includes('strategy') || bLow.includes('plan')) badgeClass = 'badge-soft-purple';
                if(bLow.includes('exec') || bLow.includes('req') || bLow.includes('gov') || bLow.includes('med') || bLow.includes('date')) badgeClass = 'badge-soft-warning';
            }

            html += `
                <div class="col-md-6 col-lg-4">
                    <div class="action-card d-flex flex-column h-100" style="background-color: #ffffff; border-color: #cbd5e1;">
                        <h6 class="fw-bold mb-2 action-title" style="font-size: 0.95rem;">${sub.title}</h6>
                        <p class="text-muted small mb-3 flex-grow-1" style="line-height: 1.5;">${sub.description || ''}</p>
                        ${sub.long_description ? `<div class="text-dark small mb-3 w-100 long-description-content" style="line-height: 1.6;">${sub.long_description}</div>` : ''}
                        
                        <div class="mt-auto d-flex flex-column align-items-start gap-2">
                            ${badge ? `<span class="badge ${badgeClass} rounded-pill px-3 py-2">${badge}</span>` : ''}
                            ${salary ? `<div class="salary-text mt-2"><i class="fas fa-coins text-warning me-1"></i> <span>${salary}</span></div>` : ''}
                        </div>
                    </div>
                </div>
            `;
        });

        html += `</div>`;
        container.innerHTML = html;
        container.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
    };

    // Helper for Popular Roadmaps trigger
    window.triggerRoadmapBySearch = function(stageName, streamKeyword) {
        let targetBtn = null;
        const allBtns = document.querySelectorAll('.stage-card-btn');
        
        if(stageName.toLowerCase().includes('doctor') || stageName.toLowerCase().includes('engineer')) {
            targetBtn = Array.from(allBtns).find(b => b.dataset.stageTitle.toLowerCase().includes('class 11') || b.dataset.stageTitle.toLowerCase().includes('class 12'));
        } else {
            targetBtn = Array.from(allBtns).find(b => b.dataset.stageTitle.toLowerCase().includes('graduation') || b.dataset.stageTitle.toLowerCase().includes('class 12'));
        }

        if(targetBtn) {
            targetBtn.click();
            setTimeout(() => {
                const streamCards = document.querySelectorAll('.stream-card');
                const matchedStream = Array.from(streamCards).find(c => c.dataset.streamTitle.toLowerCase().includes(streamKeyword.toLowerCase()));
                if(matchedStream) {
                    matchedStream.click();
                }
            }, 500);
        }
    };

    document.addEventListener('DOMContentLoaded', function() {
        const stageButtons = document.querySelectorAll('.stage-card-btn');
        const streamsSection = document.getElementById('streams-section');
        const streamsContainer = document.getElementById('streams-container');
        const timelineSection = document.getElementById('timeline-section');
        const timelineContainer = document.getElementById('timeline-container');
        const streamAlert = document.getElementById('stream-alert');
        const streamAlertText = document.getElementById('stream-alert-text');
        
        const dynamicHeading = document.getElementById('dynamic-heading');

        let currentStageId = null;
        let currentStageTitle = '';

        stageButtons.forEach(btn => {
            btn.addEventListener('click', function() {
                stageButtons.forEach(b => b.classList.remove('active'));
                this.classList.add('active');
                
                currentStageTitle = this.dataset.stageTitle;
                
                dynamicHeading.innerText = `Paths for ${currentStageTitle}`;

                timelineSection.style.display = 'none';
                streamsSection.style.display = 'block';
                streamsContainer.innerHTML = '<div class="col-12 text-center text-muted py-5"><i class="fas fa-spinner fa-spin fs-4 text-primary"></i><p class="mt-2 small text-muted">Loading available streams...</p></div>';

                currentStageId = this.dataset.stageId;
                
                setTimeout(() => {
                    streamsSection.scrollIntoView({ behavior: 'smooth', block: 'start' });
                }, 100);
                
                fetch(`/career-roadmap/api/stage/${currentStageId}`)
                    .then(res => res.json())
                    .then(data => renderStreams(data.streams))
                    .catch(err => {
                        console.error(err);
                        streamsContainer.innerHTML = '<div class="col-12 text-center text-danger py-4 border rounded bg-white">Failed to load streams. Please try again.</div>';
                    });
            });
        });

        function renderStreams(streams) {
            streamsContainer.innerHTML = '';
            if(!streams || !streams.length) {
                streamsContainer.innerHTML = '<div class="col-12 text-center text-muted py-4 border rounded-4 bg-white shadow-sm">No streams available for this stage yet.</div>';
                return;
            }

            streams.forEach((stream, idx) => {
                const col = document.createElement('div');
                col.className = 'col-md-4 col-sm-6';
                col.style.animationDelay = `${idx * 0.05}s`;
                col.classList.add('fade-in');
                
                let iconClass = 'fas fa-shield-alt';
                const t = stream.title.toLowerCase();
                if(t.includes('defence')) iconClass = 'fas fa-shield-alt';
                else if(t.includes('science') && t.includes('eng')) iconClass = 'fas fa-microchip';
                else if(t.includes('science') && t.includes('med')) iconClass = 'fas fa-user-doctor';
                else if(t.includes('commerce') || t.includes('finance')) iconClass = 'far fa-chart-bar';
                else if(t.includes('art') || t.includes('humanities')) iconClass = 'fas fa-book-open';
                else if(t.includes('law')) iconClass = 'fas fa-balance-scale';
                else if(t.includes('management') || t.includes('mba')) iconClass = 'fas fa-briefcase';
                else if(t.includes('tech') || t.includes('engineer')) iconClass = 'fas fa-laptop-code';
                else if(t.includes('civil') || t.includes('upsc')) iconClass = 'fas fa-landmark';
                else iconClass = 'fas fa-graduation-cap';

                col.innerHTML = `
                    <div class="stream-card" data-stream-id="${stream.id}" data-stream-title="${stream.title}">
                        <div class="stream-icon">
                            <i class="${iconClass}"></i>
                        </div>
                        <div class="stream-title">${stream.title}</div>
                        <div class="stream-desc">${stream.description || 'Explore this career pathway and milestones'}</div>
                    </div>
                `;
                
                col.querySelector('.stream-card').addEventListener('click', function() {
                    document.querySelectorAll('.stream-card').forEach(c => c.classList.remove('active'));
                    this.classList.add('active');
                    loadStreamDetails(stream.id, stream.title);
                });

                streamsContainer.appendChild(col);
            });
        }

        function loadStreamDetails(streamId, streamTitle) {
            dynamicHeading.innerText = `Career Roadmap — ${streamTitle}`;

            timelineSection.style.display = 'block';
            timelineContainer.innerHTML = '<div class="text-center text-muted py-5"><i class="fas fa-spinner fa-spin fs-4 text-primary"></i><p class="mt-2 small text-muted">Building roadmap timeline...</p></div>';
            streamAlert.style.display = 'none';

            setTimeout(() => {
                timelineSection.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }, 100);

            fetch(`/career-roadmap/api/stream/${streamId}`)
                .then(res => res.json())
                .then(data => renderTimeline(data.stream))
                .catch(err => {
                    console.error(err);
                    timelineContainer.innerHTML = '<div class="text-danger py-4">Failed to load roadmap timeline. Please try again.</div>';
                });
        }

        function renderTimeline(stream) {
            timelineContainer.innerHTML = '';
            cardChildrenMap = {};
            
            let cf = stream.custom_fields;
            if(typeof cf === 'string') {
                try { cf = JSON.parse(cf); } catch(e) { cf = {}; }
            }
            if(cf && cf.alert_message) {
                streamAlertText.innerHTML = cf.alert_message;
                streamAlert.style.display = 'flex';
            } else {
                streamAlert.style.display = 'none';
            }

            const groups = stream.children || [];
            if(!groups.length) {
                timelineContainer.innerHTML = '<div class="text-muted py-4 bg-white p-4 rounded-4 border">No detailed timeline available for this pathway yet.</div>';
                return;
            }

            const dotColors = ['dot-blue', 'dot-green', 'dot-purple', 'dot-orange'];

            groups.forEach((group, index) => {
                let groupCf = group.custom_fields;
                if(typeof groupCf === 'string') {
                    try { groupCf = JSON.parse(groupCf); } catch(e) { groupCf = {}; }
                }
                const groupBadge = groupCf ? groupCf.Badge : null;
                const dotColor = dotColors[index % dotColors.length];

                const groupDiv = document.createElement('div');
                groupDiv.className = 'timeline-group fade-in';
                groupDiv.style.animationDelay = `${index * 0.1}s`;
                
                let groupHtml = `
                    <div class="timeline-dot ${dotColor}"></div>
                    <div class="d-flex align-items-center mb-3">
                        <h5 class="fw-bold mb-0 me-3 timeline-group-title">${group.title}</h5>
                        ${groupBadge ? `<span class="badge badge-soft-secondary rounded-pill px-3 py-1">${groupBadge}</span>` : ''}
                    </div>
                    <div class="row g-3" id="group-row-${group.id}">
                `;

                const cards = group.children || [];
                cards.forEach(card => {
                    let cardCf = card.custom_fields;
                    if(typeof cardCf === 'string') {
                        try { cardCf = JSON.parse(cardCf); } catch(e) { cardCf = {}; }
                    }
                    const badge = cardCf ? cardCf.Badge : null;
                    const salary = cardCf ? cardCf.Salary : null;

                    const hasChildren = card.children && card.children.length > 0;
                    if(hasChildren) {
                        cardChildrenMap[card.id] = { title: card.title, desc: card.description, children: card.children };
                    }

                    let badgeClass = 'badge-soft-primary';
                    if(badge) {
                        const bLow = badge.toLowerCase();
                        if(bLow.includes('prep') || bLow.includes('merit') || bLow.includes('success')) badgeClass = 'badge-soft-success';
                        if(bLow.includes('strategy') || bLow.includes('plan')) badgeClass = 'badge-soft-purple';
                        if(bLow.includes('exec') || bLow.includes('req') || bLow.includes('gov')) badgeClass = 'badge-soft-warning';
                    }
                    
                    groupHtml += `
                        <div class="col-md-6 col-lg-4">
                            <div class="action-card d-flex flex-column h-100 ${hasChildren ? 'has-children' : ''}" 
                                 ${hasChildren ? `onclick="window.showNestedRow(event, ${group.id}, ${card.id})"` : ''}>
                                <div class="d-flex justify-content-between align-items-start mb-2">
                                    <h6 class="fw-bold mb-0 action-title" style="font-size: 0.95rem;">${card.title}</h6>
                                    ${hasChildren ? `<i class="fas fa-chevron-down text-primary opacity-50 ms-2 mt-1 toggle-icon-${card.id}"></i>` : ''}
                                </div>
                                <p class="text-muted small mb-3 flex-grow-1" style="line-height: 1.5;">${card.description || ''}</p>
                                ${card.long_description ? `<div class="text-dark small mb-3 w-100 long-description-content" style="line-height: 1.6;">${card.long_description}</div>` : ''}
                                
                                <div class="mt-auto d-flex flex-column align-items-start gap-2">
                                    ${badge ? `<span class="badge ${badgeClass} rounded-pill px-3 py-2">${badge}</span>` : ''}
                                    ${salary ? `<div class="salary-text mt-2"><i class="fas fa-coins text-warning me-1"></i> <span>${salary}</span></div>` : ''}
                                </div>
                            </div>
                        </div>
                    `;
                });

                groupHtml += `</div>`;

                groupHtml += `
                    <div id="group-nested-${group.id}" class="d-none mt-4 p-4 bg-light rounded-4 border border-primary border-opacity-25 nested-master-container"></div>
                `;

                groupDiv.innerHTML = groupHtml;
                timelineContainer.appendChild(groupDiv);
            });
        }
    });
</script>

@include('partials.book-session-modal')
@endsection
