@extends('layouts.app')

@section('content')
<div class="career-roadmap-page-wrapper">

    <!-- 1. HERO BANNER SECTION -->
    <main class="about-hero-section ptb-70 pb-0">
        <div class="bg-square">
            <img src="{{ asset('assets/images/banner-square-img.svg') }}" alt="" />
        </div>
        <div class="container position-relative">
            <div class="row align-items-center">
                <!-- Left Content -->
                <div class="col-lg-6 col-12 text-center text-lg-start mentors-hero-content">
                    <div class="hero-badge-container mb-2">
                        <span class="hero-badge">Step-By-Step Career Pathways</span>
                        <img src="{{ asset('assets/images/mentor-banner-arrow.png') }}" alt="">
                    </div>

                    <h1 class="mentors-hero-title mb-3">
                        <span class="highlight-orange">Interactive</span> Career Roadmap
                    </h1>

                    <p class="mentors-hero-desc mb-4" style="max-width: 540px;">
                        Explore complete step-by-step career pathways from Class 5 foundation years to Class 10, 12, competitive exams, and Higher Education.
                    </p>

                    <div class="d-flex flex-wrap gap-3 justify-content-center justify-content-lg-start">
                        <a href="#roadmap-categories-sec" class="btn-book-session text-decoration-none">
                            Explore Career Stages <i class="fa-solid fa-arrow-right-long ms-2"></i>
                        </a>
                        <a href="{{ route('experts') }}" class="btn btn-outline-primary rounded-pill px-4 py-2 fw-bold text-decoration-none d-flex align-items-center justify-content-center" style="border-width: 2px;">
                            Talk to Career Expert <i class="fa-solid fa-user-doctor ms-2"></i>
                        </a>
                    </div>
                </div>

                <!-- Right Visual Area -->
                <div class="col-lg-6 col-12 text-center position-relative mt-4 mt-lg-0">
                    <div class="hero-image-container p-4 rounded-4 shadow-sm" style="background: rgba(255, 255, 255, 0.85); backdrop-filter: blur(10px); border: 1px solid rgba(55, 113, 200, 0.15);">
                        <img src="{{ asset('assets/images/mentor-banner-img.png') }}" alt="Career Roadmap" class="img-fluid rounded-3" style="max-height: 380px; object-fit: contain;">
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Breadcrumb Bar -->
    <div class="py-3" style="background-color: #f9ad0b14">
        <div class="container d-flex justify-content-between align-items-center flex-wrap gap-2">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0" style="font-size: 13.5px; font-weight: 500;">
                    <li class="breadcrumb-item">
                        <a href="{{ route('home') }}" class="text-decoration-none text-muted"><i class="fa-solid fa-house me-1"></i> Home</a>
                    </li>
                    <li class="breadcrumb-item active text-primary" aria-current="page">Career Roadmap</li>
                </ol>
            </nav>
        </div>
    </div>

    <!-- 2. CATEGORY TABS & STAGES SECTION -->
    <section class="roadmap-main-sec ptb-70" id="roadmap-categories-sec" style="background: #FAFBFC;">
        <div class="container">

            <div class="text-center mb-5">
                <div class="heading-with-lines d-flex align-items-center justify-content-center gap-3 mb-3">
                    <span class="heading-line-orange d-none d-md-block"></span>
                    <h2 class="fw-bold">Select Your Current Stage</h2>
                    <span class="heading-line-orange d-none d-md-block"></span>
                </div>
                <p class="section-subtitle-custom mx-auto" style="max-width: 750px; font-size: 15px; color: #555;">
                    Choose your educational stage below to unlock tailored career roadmaps, exam preparation strategies, and top degree options.
                </p>
            </div>

            <!-- Category Pill Filter Tabs -->
            @if(isset($categories) && $categories->count() > 0)
                <div class="d-flex flex-wrap justify-content-center gap-2 mb-5">
                    @foreach($categories as $cIndex => $cat)
                        <button type="button" class="filter-pill-btn career-cat-btn {{ $cIndex === 0 ? 'active' : '' }}" data-category-id="{{ $cat->id }}" style="padding: 10px 24px; font-weight: 600; font-size: 14.5px; border-radius: 50px;">
                            <i class="fa-solid fa-graduation-cap me-2"></i>{{ $cat->name }}
                        </button>
                    @endforeach
                </div>
            @endif

            <!-- Category Content Panels -->
            @if(isset($categories) && $categories->count() > 0)
                @foreach($categories as $cIndex => $cat)
                    @php 
                        $catStages = $stages->get($cat->id, collect());
                    @endphp
                    <div class="career-cat-panel {{ $cIndex === 0 ? '' : 'd-none' }}" id="cat-panel-{{ $cat->id }}">
                        
                        @if($catStages->count() > 0)
                            <div class="accordion accordion-flush" id="accordionStages-{{ $cat->id }}">
                                @foreach($catStages as $sIndex => $stg)
                                    @php 
                                        $stgSubModules = $subModules->get($stg->id, collect());
                                    @endphp
                                    <div class="accordion-item mb-4 border rounded-4 overflow-hidden shadow-sm" style="background: #ffffff;">
                                        <h3 class="accordion-header" id="headingStage-{{ $stg->id }}">
                                            <button class="accordion-button {{ $sIndex === 0 ? '' : 'collapsed' }} py-3 px-4 fw-bold text-dark fs-5 d-flex align-items-center justify-content-between" type="button" data-bs-toggle="collapse" data-bs-target="#collapseStage-{{ $stg->id }}" aria-expanded="{{ $sIndex === 0 ? 'true' : 'false' }}" aria-controls="collapseStage-{{ $stg->id }}" style="background: #ffffff; border-left: 5px solid #3771C8;">
                                                <div class="d-flex align-items-center gap-3">
                                                    <span class="badge rounded-circle p-3 d-flex align-items-center justify-content-center text-white" style="width: 42px; height: 42px; background: linear-gradient(135deg, #1e3a8a, #3b82f6); font-size: 14px;">
                                                        {{ $stg->title }}
                                                    </span>
                                                    <div>
                                                        <span class="fs-5 fw-bold text-dark">{{ $stg->title }}</span>
                                                        @if(!empty($stg->description))
                                                            <div class="small text-muted fw-normal" style="font-size: 13px;">{{ $stg->description }}</div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </button>
                                        </h3>
                                        
                                        <div id="collapseStage-{{ $stg->id }}" class="accordion-collapse collapse {{ $sIndex === 0 ? 'show' : '' }}" aria-labelledby="headingStage-{{ $stg->id }}" data-bs-parent="#accordionStages-{{ $cat->id }}">
                                            <div class="accordion-body p-4 bg-light">
                                                
                                                @if($stgSubModules->count() > 0)
                                                    <div class="row g-4">
                                                        @foreach($stgSubModules as $sub)
                                                            @php
                                                                $cRaw = $sub->custom_fields ?? [];
                                                                if (is_string($cRaw)) {
                                                                    $cRaw = json_decode($cRaw, true) ?? [];
                                                                    if (is_string($cRaw)) {
                                                                        $cRaw = json_decode($cRaw, true) ?? [];
                                                                    }
                                                                }
                                                                $customFields = is_array($cRaw) ? $cRaw : (array)$cRaw;
                                                                $alertMsg = $customFields['alert_message'] ?? null;

                                                                // Left Button (btn1)
                                                                $btn1Label = isset($customFields['btn1_label']) && $customFields['btn1_label'] !== '' ? trim($customFields['btn1_label']) : 'Get Guidance';
                                                                $rawUrl1 = !empty($customFields['btn1_url']) ? $customFields['btn1_url'] : (!empty($customFields['guidance_url']) ? $customFields['guidance_url'] : route('contact'));
                                                                $btn1Url = !empty($rawUrl1) ? (str_starts_with($rawUrl1, 'http') ? $rawUrl1 : url($rawUrl1)) : route('contact');

                                                                // Right Button (btn2)
                                                                $btn2Label = isset($customFields['btn2_label']) && $customFields['btn2_label'] !== '' ? trim($customFields['btn2_label']) : 'Talk to Counselor';
                                                                $rawUrl2 = !empty($customFields['btn2_url']) ? $customFields['btn2_url'] : (!empty($customFields['counselor_url']) ? $customFields['counselor_url'] : route('contact'));
                                                                $btn2Url = !empty($rawUrl2) ? (str_starts_with($rawUrl2, 'http') ? $rawUrl2 : url($rawUrl2)) : route('contact');
                                                            @endphp
                                                            <div class="col-lg-4 col-md-6 col-12">
                                                                <div class="card h-100 border-0 shadow-sm rounded-4 transition-all hover-top" style="background: #ffffff; border: 1px solid #eaeaea !important;">
                                                                    <div class="card-body p-4 d-flex flex-column justify-content-between">
                                                                        <div>
                                                                            <div class="d-flex align-items-center justify-content-between mb-3">
                                                                                <span class="badge bg-primary-subtle text-primary fw-semibold px-3 py-2 rounded-pill" style="font-size: 12px; background-color: #3771c815 !important;">
                                                                                    <i class="fa-solid fa-compass me-1"></i> Career Track
                                                                                </span>
                                                                                <a href="{{ $btn1Url }}" class="text-muted small" title="Open Details"><i class="fa-solid fa-arrow-up-right-from-square"></i></a>
                                                                            </div>

                                                                            <h4 class="fw-bold fs-5 text-dark mb-2">{{ $sub->title }}</h4>

                                                                            @if(!empty($sub->description))
                                                                                <p class="text-muted small mb-3" style="font-size: 13.5px; line-height: 1.5;">
                                                                                    {{ $sub->description }}
                                                                                </p>
                                                                            @endif

                                                                            @if(!empty($alertMsg))
                                                                                <div class="alert alert-warning border-0 p-3 rounded-3 small mb-3" style="background: #fff8eb; color: #b45309; font-size: 12.5px; line-height: 1.4;">
                                                                                    <i class="fa-solid fa-lightbulb me-1" style="color: #f9ad0b;"></i> {{ \Illuminate\Support\Str::limit($alertMsg, 160) }}
                                                                                </div>
                                                                            @endif
                                                                        </div>

                                                                        @if(!empty($btn1Label) || !empty($btn2Label))
                                                                            <div class="pt-3 border-top mt-3 d-flex align-items-center justify-content-between flex-wrap gap-2">
                                                                                @if(!empty($btn1Label))
                                                                                    <a href="{{ $btn1Url }}" class="btn btn-sm btn-outline-primary rounded-pill px-3 py-2 fw-semibold text-decoration-none" style="font-size: 12.5px;">
                                                                                        {{ $btn1Label }} <i class="fa-solid fa-chevron-right ms-1"></i>
                                                                                    </a>
                                                                                @endif

                                                                                @if(!empty($btn2Label))
                                                                                    <a href="{{ $btn2Url }}" class="text-decoration-none text-muted small fw-semibold">
                                                                                        {{ $btn2Label }}
                                                                                    </a>
                                                                                @endif
                                                                            </div>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                @else
                                                    <div class="text-center py-4 text-muted">
                                                        <i class="fa-solid fa-folder-open fs-3 mb-2 opacity-50"></i>
                                                        <p class="mb-0">No career sub-tracks available under this stage currently.</p>
                                                    </div>
                                                @endif

                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-5 bg-white rounded-4 shadow-sm border">
                                <p class="text-muted fs-5 mb-0">No stages found under this category.</p>
                            </div>
                        @endif

                    </div>
                @endforeach
            @else
                <div class="text-center py-5 bg-white rounded-4 border">
                    <p class="text-muted fs-5 mb-0">No career roadmap categories found currently.</p>
                </div>
            @endif

        </div>
    </section>

    <!-- 3. CONNECT WITH EXPERTS BANNER -->
    @if(isset($experts) && $experts->count() > 0)
        <section class="expert-mentors-sec ptb-70" style="background: #ffffff;">
            <div class="container">
                <div class="text-center mb-5">
                    <div class="heading-with-lines d-flex align-items-center justify-content-center gap-3 mb-3">
                        <span class="heading-line-orange d-none d-md-block"></span>
                        <h2 class="fw-bold">Discuss Your Career Roadmap With Experts</h2>
                        <span class="heading-line-orange d-none d-md-block"></span>
                    </div>
                    <p class="section-subtitle-custom mx-auto" style="max-width: 750px; font-size: 15px; color: #555;">
                        Get 1:1 personalized advice from top mentors and career counselors to build your dream academic journey.
                    </p>
                </div>

                <div class="row g-4 justify-content-center">
                    @foreach($experts as $index => $exp)
                        @php
                            $eName = $exp->name ?? 'Expert Counselor';
                            $backendUrl = rtrim(env('BACKEND_URL', 'http://127.0.0.1:8001'), '/');
                            $defaultAvatars = ['mentor_1.png', 'mentor_2.png', 'mentor_3.png', 'mentor_4.png'];
                            $ePhoto = asset('assets/images/' . $defaultAvatars[$index % count($defaultAvatars)]);
                            $imgPath = $exp->img ?? $exp->profile_photo ?? null;
                            if (!empty($imgPath)) {
                                if (str_starts_with($imgPath, 'http')) {
                                    $ePhoto = $imgPath;
                                } elseif (file_exists(public_path($imgPath))) {
                                    $ePhoto = asset($imgPath);
                                } else {
                                    $ePhoto = $backendUrl . '/' . ltrim($imgPath, '/');
                                }
                            }
                            $priceMin = isset($exp->price_per_min) && $exp->price_per_min !== '' ? number_format((float)$exp->price_per_min, 2) : '10.00';
                        @endphp
                        <div class="col-xl-3 col-lg-4 col-md-6 col-12">
                            <div class="mentor-grid-card shadow-sm rounded-4 overflow-hidden border">
                                <div class="mentor-card-img-wrapper" style="height: 240px; overflow: hidden; background-color: #f8f9fa;">
                                    <img src="{{ $ePhoto }}" alt="{{ $eName }}" style="width: 100%; height: 240px; object-fit: cover; object-position: top center;" onError="this.src='{{ asset('assets/images/mentor_1.png') }}'">
                                    <a href="{{ route('expert.detail', $exp->id) }}" class="mentor-view-profile-btn" title="View Profile">
                                        <i class="fa-solid fa-eye"></i>
                                    </a>
                                </div>
                                <div class="mentor-card-content p-3 text-center">
                                    <h4 class="mentor-card-name fs-6 fw-bold mb-1">{{ $eName }}</h4>
                                    <p class="mentor-card-role text-muted small mb-2">{{ $exp->designation ?? $exp->role ?? 'Career Counselor' }}</p>
                                    
                                    <div class="d-flex align-items-center justify-content-between pt-2 border-top mt-2">
                                        <span class="fw-bold text-dark" style="font-size: 14px;">₹{{ $priceMin }}<span class="small text-muted">/min</span></span>
                                        <button type="button" onclick="openBookingModal({{ $exp->id }}, '{{ addslashes($eName) }}')" class="btn btn-sm btn-primary rounded-pill px-3" style="background: #1e3a8a; border: none; font-size: 12.5px;">
                                            Book Session
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <!-- 4. FAQ ACCORDION SECTION -->
    <section class="faq-accordion-sec ptb-70" style="background: #FAFBFC;">
        <div class="container">
            <div class="text-center mb-5">
                <div class="heading-with-lines d-flex align-items-center justify-content-center gap-3">
                    <span class="heading-line-orange d-none d-md-block"></span>
                    <h2 class="fw-bold">Frequently Asked Questions</h2>
                    <span class="heading-line-orange d-none d-md-block"></span>
                </div>
            </div>

            <div class="faq-list-wrapper">
                <div class="faq-card-item active">
                    <button class="faq-question-header" onclick="toggleFaq(this)">
                        How do I choose the right career roadmap?
                        <i class="fa-solid fa-plus faq-toggle-icon"></i>
                    </button>
                    <div class="faq-answer-panel" style="max-height: 200px;">
                        <div class="faq-answer-content">
                            Start by identifying your current academic class/stage. Explore the detailed stream options and career tracks listed under your stage. For 1:1 guidance, book a session with our verified experts.
                        </div>
                    </div>
                </div>

                <div class="faq-card-item">
                    <button class="faq-question-header" onclick="toggleFaq(this)">
                        Can I switch career tracks later?
                        <i class="fa-solid fa-plus faq-toggle-icon"></i>
                    </button>
                    <div class="faq-answer-panel">
                        <div class="faq-answer-content">
                            Yes! Many career paths have flexible entry criteria. Our roadmap details eligibility criteria for competitive entrance exams and degree courses to help you pivot smoothly.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Category Pill Filter Switcher
        const catBtns = document.querySelectorAll('.career-cat-btn');
        const catPanels = document.querySelectorAll('.career-cat-panel');

        catBtns.forEach(btn => {
            btn.addEventListener('click', function () {
                catBtns.forEach(b => b.classList.remove('active'));
                this.classList.add('active');

                const catId = this.getAttribute('data-category-id');
                catPanels.forEach(panel => {
                    if (panel.id === 'cat-panel-' + catId) {
                        panel.classList.remove('d-none');
                    } else {
                        panel.classList.add('d-none');
                    }
                });
            });
        });
    });

    function toggleFaq(header) {
        const item = header.parentElement;
        const panel = header.nextElementSibling;
        const isActive = item.classList.contains('active');

        document.querySelectorAll('.faq-card-item').forEach(el => {
            el.classList.remove('active');
            el.querySelector('.faq-answer-panel').style.maxHeight = null;
        });

        if (!isActive) {
            item.classList.add('active');
            panel.style.maxHeight = panel.scrollHeight + "px";
        }
    }
</script>

@include('partials.book-session-modal')
@endsection
