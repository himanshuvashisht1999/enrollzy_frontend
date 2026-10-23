@extends('layouts.app')

@section('meta_title', ($course->name . ($course->full_form ? ' (' . $course->full_form . ')' : '') . ' - Course Overview, Eligibility, Syllabus, Scope & Colleges | Enrollzy'))
@section('meta_description', 'Complete guide to ' . $course->name . '. Learn about admission eligibility, syllabus curriculum, top entrance exams, career scope, average salary, and top colleges offering ' . $course->name . '.')

@section('content')
<!-- Hero Section -->
<main class="about-hero-section ptb-70">
    <div class="bg-square">
        <img src="{{ asset('assets/images/banner-square-img.svg') }}" alt="" />
    </div>
    <div class="container">
        <div class="about-hero-container">
            <img src="{{ asset('assets/images/top-exam-img.png') }}" alt="{{ $course->name }}" style="width: 100%; max-height: 380px; object-fit: cover; border-radius: 24px;" />

            <!-- Centered Badge -->
            <div class="about-us-badge-wrapper">
                <button class="about-us-badge">{{ $course->name }}</button>
                <p>{{ $course->full_form ?: ($course->programLevel->title ?? 'Professional Degree Program') }}</p>
            </div>

            <!-- Green Down Arrow Button -->
            <button class="about-scroll-btn" aria-label="Scroll Down" onclick="document.getElementById('course-main-content').scrollIntoView({behavior: 'smooth'})">
                <img style="width: 49px; height: 62px" src="{{ asset('assets/images/inner-banner-down-arror.png') }}" alt="" />
            </button>
        </div>
    </div>
</main>

<!-- Breadcrumb path -->
<div class="py-3" style="background-color: #f9ad0b14">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0" style="font-size: 13.5px; font-weight: 500">
                <li class="breadcrumb-item">
                    <a href="{{ route('home') }}" class="text-decoration-none text-muted"><i class="fa-solid fa-house me-1"></i> Home</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('courses.index') }}" class="text-decoration-none text-primary">Courses</a>
                </li>
                <li class="breadcrumb-item active text-primary" aria-current="page">
                    {{ $course->name }}
                </li>
            </ol>
        </nav>
    </div>
</div>

<!-- Header Course Info Banner -->
<section class="py-4" style="background-color: #fafbfd">
    <div class="container">
        <div class="bg-white p-4 rounded-4 border shadow-sm mb-3">
            <div class="row align-items-center g-3">
                <div class="col-lg-8">
                    <div class="d-flex align-items-center gap-2 mb-2 flex-wrap">
                        @if($course->programLevel)
                            <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-1 rounded-pill fw-bold" style="font-size: 12.5px;">
                                <i class="fa-solid fa-graduation-cap me-1"></i> {{ $course->programLevel->title }}
                            </span>
                        @endif
                        @if($course->courseType)
                            <span class="badge bg-success bg-opacity-10 text-success px-3 py-1 rounded-pill fw-bold" style="font-size: 12.5px;">
                                {{ $course->courseType->title }}
                            </span>
                        @endif
                        @if($course->duration)
                            <span class="badge bg-warning bg-opacity-25 text-dark px-3 py-1 rounded-pill fw-bold" style="font-size: 12.5px;">
                                <i class="fa-regular fa-clock me-1 text-warning"></i> {{ $course->duration }} {{ is_numeric($course->duration) ? 'Years' : '' }}
                            </span>
                        @endif
                    </div>

                    <h1 class="fw-bold text-dark mb-1" style="font-size: 26px;">{{ $course->name }}</h1>
                    @if($course->full_form)
                        <h2 class="text-muted fw-normal fs-6 mb-3">{{ $course->full_form }}</h2>
                    @endif

                    <div class="d-flex align-items-center gap-3 text-muted flex-wrap" style="font-size: 13.5px;">
                        @if($course->streamOffered)
                            <span><i class="fa-solid fa-layer-group text-primary me-1"></i> Stream: <strong>{{ $course->streamOffered->title }}</strong></span>
                        @endif
                        @if($course->discipline)
                            <span><i class="fa-solid fa-book text-primary me-1"></i> Discipline: <strong>{{ $course->discipline->title }}</strong></span>
                        @endif
                        <span><i class="fa-solid fa-money-bill-trend-up text-success me-1"></i> Avg Salary: <strong class="text-success">{{ $course->average_salary_range ?: '₹4.5 - ₹12 LPA' }}</strong></span>
                    </div>
                </div>

                <div class="col-lg-4 text-lg-end">
                    <div class="d-flex flex-column flex-sm-row flex-lg-column gap-2 justify-content-end">
                        <a href="#admission-enquiry-card" class="btn btn-primary px-4 py-2 fw-bold text-white rounded-3 shadow-sm" style="font-size: 14px;">
                            <i class="fa-solid fa-headset me-1"></i> Free Admission Guidance
                        </a>
                        <a href="#offering-colleges" class="btn btn-outline-secondary px-4 py-2 fw-bold rounded-3" style="font-size: 14px;">
                            <i class="fa-solid fa-building-columns me-1"></i> View Offering Colleges
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Interactive Navigation Tabs Bar -->
<section style="background-color: #3771c812" class="sticky-top shadow-sm" style="top: 80px; z-index: 90;">
    <div class="container">
        <div class="exam-detail-tabs-bar d-flex overflow-auto py-2 gap-2" id="courseDetailTabs" style="scrollbar-width: none;">
            <button class="exam-detail-tab-btn active" data-course-tab="overview">Overview</button>
            <button class="exam-detail-tab-btn" data-course-tab="eligibility">Eligibility</button>
            <button class="exam-detail-tab-btn" data-course-tab="curriculum">Curriculum</button>
            <button class="exam-detail-tab-btn" data-course-tab="specializations">Specializations</button>
            <button class="exam-detail-tab-btn" data-course-tab="exams">Entrance Exams</button>
            <button class="exam-detail-tab-btn" data-course-tab="career">Career & Salary</button>
            <button class="exam-detail-tab-btn" data-course-tab="colleges">Offering Colleges</button>
            <button class="exam-detail-tab-btn" data-course-tab="faqs">FAQs</button>
        </div>
    </div>
</section>

<!-- Main Content Grid -->
<section class="py-5" id="course-main-content" style="background-color: #f8fafc;">
    <div class="container">
        <div class="row g-4">
            
            <!-- Left Main Content Column -->
            <div class="col-lg-8">
                
                <!-- Section 1: Overview -->
                <div class="bg-white p-4 p-md-5 rounded-4 border shadow-sm mb-4 course-section-card" id="section-overview">
                    <h3 class="fw-bold text-dark mb-3" style="font-size: 20px;">
                        <i class="fa-solid fa-circle-info text-primary me-2"></i> About {{ $course->name }}
                    </h3>
                    
                    <div class="course-text-content text-muted" style="font-size: 14.5px; line-height: 1.8;">
                        @if($course->overview)
                            {!! $course->overview !!}
                        @else
                            <p><strong>{{ $course->name }}</strong> @if($course->full_form) ({{ $course->full_form }}) @endif is a comprehensive program designed to provide students with foundational and advanced knowledge in {{ $course->discipline->title ?? 'their chosen area of specialization' }}. The program focuses on academic excellence, hands-on practical skills, problem-solving abilities, and preparation for career opportunities in modern industries.</p>
                            <p>Throughout the duration of {{ $course->duration ? $course->duration . ' years' : 'the course' }}, students undergo structured classroom learning, laboratory practicals, industry internships, and project work to prepare them for both professional corporate roles and advanced research opportunities.</p>
                        @endif
                    </div>

                    <!-- Quick Highlights Table -->
                    <div class="mt-4">
                        <h4 class="fw-bold text-dark mb-3" style="font-size: 16px;">Course Highlights at a Glance</h4>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped" style="font-size: 13.5px;">
                                <tbody>
                                    <tr>
                                        <th style="width: 35%; background-color: #f1f5f9;">Course Name</th>
                                        <td><strong>{{ $course->name }}</strong> @if($course->full_form) ({{ $course->full_form }}) @endif</td>
                                    </tr>
                                    <tr>
                                        <th style="background-color: #f1f5f9;">Program Level</th>
                                        <td>{{ $course->programLevel->title ?? 'Undergraduate / Degree' }}</td>
                                    </tr>
                                    <tr>
                                        <th style="background-color: #f1f5f9;">Course Duration</th>
                                        <td>{{ $course->duration ? $course->duration . ' Years' : '2 - 4 Years' }}</td>
                                    </tr>
                                    <tr>
                                        <th style="background-color: #f1f5f9;">Stream & Discipline</th>
                                        <td>{{ $course->streamOffered->title ?? 'General' }} • {{ $course->discipline->title ?? 'Core' }}</td>
                                    </tr>
                                    <tr>
                                        <th style="background-color: #f1f5f9;">Study Mode</th>
                                        <td>
                                            @if(is_array($course->available_modes) && count($course->available_modes))
                                                {{ implode(', ', $course->available_modes) }}
                                            @else
                                                Full Time / Regular / Online
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th style="background-color: #f1f5f9;">Average Salary Package</th>
                                        <td class="text-success fw-bold">{{ $course->average_salary_range ?: '₹4.5 LPA - ₹12 LPA' }}</td>
                                    </tr>
                                    <tr>
                                        <th style="background-color: #f1f5f9;">Primary Entrance Exams</th>
                                        <td>
                                            @if($entranceExams->isNotEmpty())
                                                {{ $entranceExams->pluck('short_name')->filter()->implode(', ') ?: $entranceExams->pluck('name')->take(3)->implode(', ') }}
                                            @else
                                                National & State Level Entrance Exams / Merit Based
                                            @endif
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Section 2: Eligibility Criteria -->
                <div class="bg-white p-4 p-md-5 rounded-4 border shadow-sm mb-4 course-section-card" id="section-eligibility">
                    <h3 class="fw-bold text-dark mb-3" style="font-size: 20px;">
                        <i class="fa-solid fa-user-check text-primary me-2"></i> Eligibility Criteria
                    </h3>

                    <div class="course-text-content text-muted" style="font-size: 14.5px; line-height: 1.8;">
                        @if($course->generic_eligibility)
                            {!! $course->generic_eligibility !!}
                        @else
                            <p>To pursue <strong>{{ $course->name }}</strong>, candidates typically need to satisfy the following minimum eligibility parameters set by universities and regulatory bodies:</p>
                            <ul class="ps-3 mb-3">
                                @if(str_contains(strtolower($course->programLevel->title ?? ''), 'undergraduate') || str_contains(strtolower($course->name), 'b.') || str_contains(strtolower($course->name), 'bachelor'))
                                    <li><strong>Academic Qualification:</strong> Passed 10+2 (Senior Secondary Examination) or equivalent from a recognized board (CBSE, ICSE, State Boards).</li>
                                    <li><strong>Minimum Aggregate Marks:</strong> Minimum 50% to 60% marks in aggregate (5% relaxation for reserved categories).</li>
                                    <li><strong>Required Subjects:</strong> Physics, Chemistry, Mathematics / Biology / Commerce / Arts relevant to the chosen stream.</li>
                                @elseif(str_contains(strtolower($course->programLevel->title ?? ''), 'postgraduate') || str_contains(strtolower($course->name), 'm.') || str_contains(strtolower($course->name), 'master'))
                                    <li><strong>Academic Qualification:</strong> Bachelor's Degree in relevant discipline from a recognized university.</li>
                                    <li><strong>Minimum Aggregate Marks:</strong> Minimum 50% to 55% marks in graduation.</li>
                                    <li><strong>Entrance Score:</strong> Valid scorecard in national/state entrance tests.</li>
                                @else
                                    <li><strong>Minimum Qualification:</strong> 10+2 or Graduation depending on program requirements.</li>
                                    <li><strong>Minimum Score:</strong> Passing marks with minimum 50% aggregate score.</li>
                                @endif
                                <li><strong>Age Limit:</strong> Generally no upper age bar for most courses; check specific university guidelines.</li>
                            </ul>
                        @endif
                    </div>
                </div>

                <!-- Section 3: Curriculum & Subjects -->
                <div class="bg-white p-4 p-md-5 rounded-4 border shadow-sm mb-4 course-section-card" id="section-curriculum">
                    <h3 class="fw-bold text-dark mb-3" style="font-size: 20px;">
                        <i class="fa-solid fa-book-open-reader text-primary me-2"></i> Core Curriculum & Syllabus
                    </h3>

                    <div class="course-text-content text-muted" style="font-size: 14.5px; line-height: 1.8;">
                        @if($course->core_curriculum)
                            {!! $course->core_curriculum !!}
                        @else
                            <p>The curriculum of <strong>{{ $course->name }}</strong> is divided into semester-wise modules designed to blend theoretical rigor with practical laboratory work, industry live projects, and internships.</p>
                            
                            <div class="row g-3 mt-2">
                                <div class="col-md-6">
                                    <div class="p-3 bg-light rounded-3 border">
                                        <h5 class="fw-bold text-dark fs-6 mb-2"><i class="fa-solid fa-cubes text-primary me-1"></i> Foundational Subjects</h5>
                                        <ul class="ps-3 mb-0" style="font-size: 13.5px;">
                                            <li>Core Fundamentals & Theory</li>
                                            <li>Analytical & Quantitative Tools</li>
                                            <li>Domain Specific Concepts</li>
                                            <li>Communication & Professional Ethics</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="p-3 bg-light rounded-3 border">
                                        <h5 class="fw-bold text-dark fs-6 mb-2"><i class="fa-solid fa-laptop-code text-primary me-1"></i> Advanced & Applied Modules</h5>
                                        <ul class="ps-3 mb-0" style="font-size: 13.5px;">
                                            <li>Specialization Electives</li>
                                            <li>Hands-on Laboratory / Studio Practicals</li>
                                            <li>Industry Case Studies & Seminars</li>
                                            <li>Capstone Final Year Project / Dissertation</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Section 4: Specializations -->
                <div class="bg-white p-4 p-md-5 rounded-4 border shadow-sm mb-4 course-section-card" id="section-specializations">
                    <h3 class="fw-bold text-dark mb-3" style="font-size: 20px;">
                        <i class="fa-solid fa-sitemap text-primary me-2"></i> Popular Specializations
                    </h3>

                    <div class="course-text-content text-muted mb-3" style="font-size: 14.5px;">
                        <p>Students pursuing {{ $course->name }} can tailor their education by choosing in-demand specializations based on their career goals:</p>
                    </div>

                    <div class="d-flex flex-wrap gap-2">
                        @if($specializations->isNotEmpty())
                            @foreach($specializations as $spec)
                                <span class="badge bg-light text-dark border p-2 px-3 rounded-pill fw-semibold" style="font-size: 13.5px;">
                                    <i class="fa-solid fa-check text-success me-1"></i> {{ $spec->title }}
                                </span>
                            @endforeach
                        @else
                            <span class="badge bg-light text-dark border p-2 px-3 rounded-pill fw-semibold" style="font-size: 13.5px;"><i class="fa-solid fa-check text-success me-1"></i> Core Track</span>
                            <span class="badge bg-light text-dark border p-2 px-3 rounded-pill fw-semibold" style="font-size: 13.5px;"><i class="fa-solid fa-check text-success me-1"></i> Applied Technologies</span>
                            <span class="badge bg-light text-dark border p-2 px-3 rounded-pill fw-semibold" style="font-size: 13.5px;"><i class="fa-solid fa-check text-success me-1"></i> Data & Analytics</span>
                            <span class="badge bg-light text-dark border p-2 px-3 rounded-pill fw-semibold" style="font-size: 13.5px;"><i class="fa-solid fa-check text-success me-1"></i> Management & Strategy</span>
                            <span class="badge bg-light text-dark border p-2 px-3 rounded-pill fw-semibold" style="font-size: 13.5px;"><i class="fa-solid fa-check text-success me-1"></i> Research & Development</span>
                        @endif
                    </div>
                </div>

                <!-- Section 5: Entrance Exams -->
                <div class="bg-white p-4 p-md-5 rounded-4 border shadow-sm mb-4 course-section-card" id="section-exams">
                    <h3 class="fw-bold text-dark mb-3" style="font-size: 20px;">
                        <i class="fa-solid fa-pen-to-square text-primary me-2"></i> Major Entrance Exams
                    </h3>

                    <div class="course-text-content text-muted mb-3" style="font-size: 14.5px;">
                        <p>Admissions to leading colleges and universities for {{ $course->name }} are often based on scores in national, state, and university-level entrance exams:</p>
                    </div>

                    <div class="row row-cols-1 row-cols-md-2 g-3">
                        @foreach($entranceExams as $ex)
                        <div class="col">
                            <div class="p-3 bg-white rounded-3 border h-100 d-flex flex-column justify-content-between hover-shadow transition">
                                <div>
                                    <h5 class="fw-bold mb-1" style="font-size: 15px;">
                                        <a href="{{ route('exam.detail', $ex->slug) }}" class="text-decoration-none text-dark">
                                            {{ $ex->name }}
                                        </a>
                                    </h5>
                                    @if($ex->conducting_authority_name)
                                        <p class="text-muted mb-2" style="font-size: 12px;">By {{ $ex->conducting_authority_name }}</p>
                                    @endif
                                </div>
                                <div class="pt-2 border-top d-flex justify-content-between align-items-center">
                                    <span class="badge bg-light text-primary border" style="font-size: 11px;">{{ $ex->exam_type ?? 'Entrance Test' }}</span>
                                    <a href="{{ route('exam.detail', $ex->slug) }}" class="text-primary fw-bold text-decoration-none" style="font-size: 12.5px;">
                                        Exam Details <i class="fa-solid fa-arrow-right ms-1"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                <!-- Section 6: Career Scope & Salary -->
                <div class="bg-white p-4 p-md-5 rounded-4 border shadow-sm mb-4 course-section-card" id="section-career">
                    <h3 class="fw-bold text-dark mb-3" style="font-size: 20px;">
                        <i class="fa-solid fa-briefcase text-primary me-2"></i> Career Scope & Job Roles
                    </h3>

                    <div class="course-text-content text-muted" style="font-size: 14.5px; line-height: 1.8;">
                        @if($course->career_scope)
                            {!! $course->career_scope !!}
                        @else
                            <p>Graduates with a degree in <strong>{{ $course->name }}</strong> have strong employability prospects across multinational corporations, public sector undertakings, tech startups, and research institutions.</p>
                        @endif

                        <div class="row g-3 my-3">
                            <div class="col-md-6">
                                <div class="p-3 rounded-3 text-center" style="background-color: #ecfdf5; border: 1px solid #a7f3d0;">
                                    <span class="text-muted d-block" style="font-size: 12px; text-transform: uppercase;">Average Starting Package</span>
                                    <h4 class="fw-bold text-success mb-0">{{ $course->average_salary_range ?: '₹4.5 - ₹8.5 LPA' }}</h4>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="p-3 rounded-3 text-center" style="background-color: #eff6ff; border: 1px solid #bfdbfe;">
                                    <span class="text-muted d-block" style="font-size: 12px; text-transform: uppercase;">Senior Level Package</span>
                                    <h4 class="fw-bold text-primary mb-0">₹15 - ₹28+ LPA</h4>
                                </div>
                            </div>
                        </div>

                        @if($course->skills_gained)
                            <h4 class="fw-bold text-dark mt-4 mb-2" style="font-size: 16px;">Key Skills Acquired</h4>
                            <div>{!! $course->skills_gained !!}</div>
                        @endif

                        @if($course->higher_education_options)
                            <h4 class="fw-bold text-dark mt-4 mb-2" style="font-size: 16px;">Higher Education Pathways</h4>
                            <div>{!! $course->higher_education_options !!}</div>
                        @endif
                    </div>
                </div>

                <!-- Section 7: Offering Colleges & Universities -->
                <div class="bg-white p-4 p-md-5 rounded-4 border shadow-sm mb-4 course-section-card" id="offering-colleges">
                    <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
                        <h3 class="fw-bold text-dark mb-0" style="font-size: 20px;">
                            <i class="fa-solid fa-building-columns text-primary me-2"></i> Colleges & Universities Offering {{ $course->name }}
                        </h3>
                        <a href="{{ route('university') }}" class="text-primary fw-bold text-decoration-none" style="font-size: 13.5px;">
                            Explore All Universities <i class="fa-solid fa-arrow-right ms-1"></i>
                        </a>
                    </div>

                    @if($offeringColleges->isNotEmpty())
                        <div class="row row-cols-1 g-3">
                            @foreach($offeringColleges as $item)
                            @php $univ = $item['organisation']; @endphp
                            <div class="col">
                                <div class="p-3 bg-white rounded-3 border d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 hover-shadow transition">
                                    <div class="d-flex align-items-center gap-3">
                                        <div style="width: 55px; height: 55px; flex-shrink: 0; background: #f8fafc; border-radius: 12px; display: flex; align-items: center; justify-content: center; border: 1px solid #e2e8f0; padding: 4px;">
                                            @if($univ->logo)
                                                <img src="{{ str_starts_with($univ->logo, 'http') ? $univ->logo : rtrim(env('BACKEND_URL', 'http://127.0.0.1:8001'), '/') . '/' . ltrim($univ->logo, '/') }}" alt="{{ $univ->name }}" style="max-width: 100%; max-height: 100%; object-fit: contain;">
                                            @else
                                                <i class="fa-solid fa-university text-primary" style="font-size: 24px;"></i>
                                            @endif
                                        </div>
                                        <div>
                                            <h5 class="fw-bold mb-1" style="font-size: 16px;">
                                                <a href="{{ route('university.detail', $univ->slug) }}" class="text-decoration-none text-dark hover-primary">
                                                    {{ $univ->name }}
                                                </a>
                                            </h5>
                                            <p class="text-muted mb-0" style="font-size: 12.5px;">
                                                <i class="fa-solid fa-location-dot text-danger me-1"></i> {{ $univ->head_office_location ?: 'India' }}
                                                @if($univ->university_type) &bull; {{ $univ->university_type }} @endif
                                                @if($item['fees']) &bull; <strong class="text-success">₹{{ $item['fees'] }}</strong> @endif
                                            </p>
                                        </div>
                                    </div>
                                    <div class="text-md-end flex-shrink-0">
                                        <a href="{{ route('university.detail', $univ->slug) }}" class="btn btn-outline-primary btn-sm px-3 fw-bold rounded-pill">
                                            View College <i class="fa-solid fa-chevron-right ms-1" style="font-size: 10px;"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    @elseif($recommendedUnivs->isNotEmpty())
                        <p class="text-muted mb-3" style="font-size: 13.5px;">Top ranked universities offering degree programs in {{ $course->discipline->title ?? 'this stream' }}:</p>
                        <div class="row row-cols-1 g-3">
                            @foreach($recommendedUnivs as $univ)
                            <div class="col">
                                <div class="p-3 bg-white rounded-3 border d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 hover-shadow transition">
                                    <div class="d-flex align-items-center gap-3">
                                        <div style="width: 55px; height: 55px; flex-shrink: 0; background: #f8fafc; border-radius: 12px; display: flex; align-items: center; justify-content: center; border: 1px solid #e2e8f0; padding: 4px;">
                                            @if($univ->logo)
                                                <img src="{{ str_starts_with($univ->logo, 'http') ? $univ->logo : rtrim(env('BACKEND_URL', 'http://127.0.0.1:8001'), '/') . '/' . ltrim($univ->logo, '/') }}" alt="{{ $univ->name }}" style="max-width: 100%; max-height: 100%; object-fit: contain;">
                                            @else
                                                <i class="fa-solid fa-university text-primary" style="font-size: 24px;"></i>
                                            @endif
                                        </div>
                                        <div>
                                            <h5 class="fw-bold mb-1" style="font-size: 16px;">
                                                <a href="{{ route('university.detail', $univ->slug) }}" class="text-decoration-none text-dark hover-primary">
                                                    {{ $univ->name }}
                                                </a>
                                            </h5>
                                            <p class="text-muted mb-0" style="font-size: 12.5px;">
                                                <i class="fa-solid fa-location-dot text-danger me-1"></i> {{ $univ->head_office_location ?: 'India' }}
                                                @if($univ->university_type) &bull; {{ $univ->university_type }} @endif
                                            </p>
                                        </div>
                                    </div>
                                    <div class="text-md-end flex-shrink-0">
                                        <a href="{{ route('university.detail', $univ->slug) }}" class="btn btn-outline-primary btn-sm px-3 fw-bold rounded-pill">
                                            View College <i class="fa-solid fa-chevron-right ms-1" style="font-size: 10px;"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    @endif
                </div>

                <!-- Section 8: FAQs -->
                <div class="bg-white p-4 p-md-5 rounded-4 border shadow-sm mb-4 course-section-card" id="section-faqs">
                    <h3 class="fw-bold text-dark mb-3" style="font-size: 20px;">
                        <i class="fa-solid fa-circle-question text-primary me-2"></i> Frequently Asked Questions
                    </h3>

                    @php
                        $dbFaqs = is_array($course->faqs) ? $course->faqs : (json_decode($course->faqs ?? '[]', true) ?: []);
                    @endphp

                    <div class="accordion" id="courseFaqAccordion">
                        @if(!empty($dbFaqs))
                            @foreach($dbFaqs as $idx => $faq)
                            <div class="accordion-item border rounded-3 mb-2 overflow-hidden">
                                <h2 class="accordion-header" id="heading{{ $idx }}">
                                    <button class="accordion-button {{ $idx > 0 ? 'collapsed' : '' }} fw-semibold" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $idx }}" style="font-size: 14.5px;">
                                        {{ $faq['question'] ?? 'Question' }}
                                    </button>
                                </h2>
                                <div id="collapse{{ $idx }}" class="accordion-collapse collapse {{ $idx === 0 ? 'show' : '' }}" data-bs-parent="#courseFaqAccordion">
                                    <div class="accordion-body text-muted" style="font-size: 14px; line-height: 1.7;">
                                        {!! $faq['answer'] ?? '' !!}
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        @else
                            <div class="accordion-item border rounded-3 mb-2 overflow-hidden">
                                <h2 class="accordion-header" id="faqH1">
                                    <button class="accordion-button fw-semibold" type="button" data-bs-toggle="collapse" data-bs-target="#faqC1" style="font-size: 14.5px;">
                                        What is the duration and structure of {{ $course->name }}?
                                    </button>
                                </h2>
                                <div id="faqC1" class="accordion-collapse collapse show" data-bs-parent="#courseFaqAccordion">
                                    <div class="accordion-body text-muted" style="font-size: 14px; line-height: 1.7;">
                                        The standard duration of {{ $course->name }} is {{ $course->duration ? $course->duration . ' years' : 'typically 3-4 years' }}, divided into semester or annual examination modules along with practical lab work, internships, and capstone projects.
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item border rounded-3 mb-2 overflow-hidden">
                                <h2 class="accordion-header" id="faqH2">
                                    <button class="accordion-button collapsed fw-semibold" type="button" data-bs-toggle="collapse" data-bs-target="#faqC2" style="font-size: 14.5px;">
                                        What are the job prospects and salary after completing {{ $course->name }}?
                                    </button>
                                </h2>
                                <div id="faqC2" class="accordion-collapse collapse" data-bs-parent="#courseFaqAccordion">
                                    <div class="accordion-body text-muted" style="font-size: 14px; line-height: 1.7;">
                                        Graduates have high career demand in corporate, public, and research sectors. Starting packages range from {{ $course->average_salary_range ?: '₹4.5 LPA to ₹10 LPA' }} depending on college tier, specialization, and individual technical skills.
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item border rounded-3 mb-2 overflow-hidden">
                                <h2 class="accordion-header" id="faqH3">
                                    <button class="accordion-button collapsed fw-semibold" type="button" data-bs-toggle="collapse" data-bs-target="#faqC3" style="font-size: 14.5px;">
                                        Can I pursue higher studies after {{ $course->name }}?
                                    </button>
                                </h2>
                                <div id="faqC3" class="accordion-collapse collapse" data-bs-parent="#courseFaqAccordion">
                                    <div class="accordion-body text-muted" style="font-size: 14px; line-height: 1.7;">
                                        Yes, graduates are eligible for master's degree programs (such as M.Tech, MBA, M.Sc, MCA), international MS degrees, and doctorate Ph.D fellowships.
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

            </div>

            <!-- Right Sidebar Column -->
            <div class="col-lg-4">
                
                <!-- Quick Facts Card -->
                <div class="bg-white p-4 rounded-4 border shadow-sm mb-4">
                    <h4 class="fw-bold mb-3" style="font-size: 16px;"><i class="fa-solid fa-list-check text-primary me-2"></i> Quick Course Facts</h4>
                    <ul class="list-unstyled mb-0" style="font-size: 13.5px; line-height: 2.2;">
                        <li class="d-flex justify-content-between border-bottom py-1">
                            <span class="text-muted">Degree / Level:</span>
                            <strong class="text-dark">{{ $course->programLevel->title ?? 'Degree Program' }}</strong>
                        </li>
                        <li class="d-flex justify-content-between border-bottom py-1">
                            <span class="text-muted">Duration:</span>
                            <strong class="text-dark">{{ $course->duration ? $course->duration . ' Years' : '2-4 Years' }}</strong>
                        </li>
                        <li class="d-flex justify-content-between border-bottom py-1">
                            <span class="text-muted">Stream:</span>
                            <strong class="text-primary">{{ $course->streamOffered->title ?? 'General' }}</strong>
                        </li>
                        <li class="d-flex justify-content-between border-bottom py-1">
                            <span class="text-muted">Avg Salary:</span>
                            <strong class="text-success">{{ $course->average_salary_range ?: '₹5 - ₹12 LPA' }}</strong>
                        </li>
                        <li class="d-flex justify-content-between py-1">
                            <span class="text-muted">Colleges Count:</span>
                            <strong class="text-dark">{{ $offeringColleges->count() > 0 ? $offeringColleges->count() . ' Universities' : 'Top Colleges' }}</strong>
                        </li>
                    </ul>
                </div>

                <!-- Admission Enquiry Form -->
                <div class="bg-white p-4 rounded-4 border shadow-sm mb-4" id="admission-enquiry-card">
                    <h4 class="fw-bold text-dark mb-2" style="font-size: 17px;">
                        <i class="fa-solid fa-headset text-primary me-1"></i> Get Free Course Guidance
                    </h4>
                    <p class="text-muted mb-3" style="font-size: 12.5px;">Speak to our certified education counselors for college admissions, fee structures, and scholarship options.</p>

                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show mb-3" role="alert" style="font-size: 13px;">
                            <i class="fa-solid fa-circle-check me-1"></i> {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <form action="{{ route('contact.submit') }}" method="POST">
                        @csrf
                        <input type="hidden" name="type" value="Course Admission Inquiry">
                        <input type="hidden" name="programme" value="{{ $course->name }}">
                        <input type="hidden" name="subject" value="Inquiry for {{ $course->name }}">

                        <div class="mb-3">
                            <label class="form-label fw-semibold" style="font-size: 12.5px;">Your Name <span class="text-danger">*</span></label>
                            <input type="text" name="name" placeholder="Enter full name" class="form-control" style="font-size: 13.5px;" required />
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold" style="font-size: 12.5px;">Phone Number <span class="text-danger">*</span></label>
                            <input type="tel" name="phone" placeholder="Enter mobile number" class="form-control" style="font-size: 13.5px;" required />
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold" style="font-size: 12.5px;">Email Address</label>
                            <input type="email" name="email" placeholder="Enter email address" class="form-control" style="font-size: 13.5px;" />
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold" style="font-size: 12.5px;">City / State</label>
                            <input type="text" name="looking_for" placeholder="e.g. Delhi, Bangalore, Mumbai" class="form-control" style="font-size: 13.5px;" />
                        </div>

                        <button type="submit" class="btn btn-primary w-100 fw-bold py-2 shadow-sm" style="border-radius: 8px; font-size: 14px;">
                            <i class="fa-solid fa-paper-plane me-1"></i> Request Callback
                        </button>
                    </form>
                </div>

                <!-- Similar / Related Courses Widget -->
                @if($relatedCourses->isNotEmpty())
                <div class="bg-white p-4 rounded-4 border shadow-sm">
                    <h4 class="fw-bold mb-3" style="font-size: 16px;"><i class="fa-solid fa-graduation-cap text-primary me-2"></i> Related Programs</h4>
                    <div class="d-flex flex-column gap-2">
                        @foreach($relatedCourses as $rc)
                        <a href="{{ route('course.detail', $rc->slug) }}" class="p-2 rounded-3 border bg-light text-decoration-none text-dark d-flex justify-content-between align-items-center hover-primary transition">
                            <div>
                                <strong class="d-block" style="font-size: 13px;">{{ $rc->name }}</strong>
                                <span class="text-muted" style="font-size: 11.5px;">
                                    {{ $rc->programLevel->title ?? 'Degree' }} &bull; {{ $rc->duration ? $rc->duration . ' Years' : 'Standard' }}
                                </span>
                            </div>
                            <i class="fa-solid fa-chevron-right text-muted" style="font-size: 11px;"></i>
                        </a>
                        @endforeach
                    </div>
                </div>
                @endif

            </div>

        </div>
    </div>
</section>
@endsection

@push('css')
<style>
.course-section-card {
    scroll-margin-top: 130px;
}
.exam-detail-tab-btn {
    background: transparent;
    border: none;
    padding: 8px 16px;
    font-size: 13.5px;
    font-weight: 600;
    color: #4a5568;
    border-radius: 50px;
    white-space: nowrap;
    transition: all 0.2s ease;
}
.exam-detail-tab-btn:hover,
.exam-detail-tab-btn.active {
    background-color: #3771C8;
    color: #ffffff;
}
.hover-primary:hover {
    color: #3771C8 !important;
    border-color: #3771C8 !important;
}
.hover-shadow:hover {
    box-shadow: 0 6px 18px rgba(0, 0, 0, 0.06);
}
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const tabButtons = document.querySelectorAll('.exam-detail-tab-btn');
    tabButtons.forEach(btn => {
        btn.addEventListener('click', function () {
            tabButtons.forEach(b => b.classList.remove('active'));
            this.classList.add('active');
            const targetTab = this.getAttribute('data-course-tab');
            let targetEl = null;
            if (targetTab === 'overview') targetEl = document.getElementById('section-overview');
            else if (targetTab === 'eligibility') targetEl = document.getElementById('section-eligibility');
            else if (targetTab === 'curriculum') targetEl = document.getElementById('section-curriculum');
            else if (targetTab === 'specializations') targetEl = document.getElementById('section-specializations');
            else if (targetTab === 'exams') targetEl = document.getElementById('section-exams');
            else if (targetTab === 'career') targetEl = document.getElementById('section-career');
            else if (targetTab === 'colleges') targetEl = document.getElementById('offering-colleges');
            else if (targetTab === 'faqs') targetEl = document.getElementById('section-faqs');

            if (targetEl) {
                targetEl.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }
        });
    });
});
</script>
@endpush