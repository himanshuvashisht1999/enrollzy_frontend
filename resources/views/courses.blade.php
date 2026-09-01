@extends('layouts.app')

@section('meta_title', 'Explore Top Courses & Degrees in India | Enrollzy')
@section('meta_description', 'Discover undergraduate, postgraduate, diploma, and certificate courses. Compare curriculum, eligibility, entrance exams, and career scope.')

@section('content')
<!-- Hero Section -->
<main class="about-hero-section ptb-70">
    <div class="bg-square">
        <img src="{{ asset('assets/images/banner-square-img.svg') }}" alt="" />
    </div>
    <div class="container">
        <div class="about-hero-container">
            <img src="{{ asset('assets/images/top-exam-img.png') }}" alt="Explore Courses" style="width: 100%; max-height: 380px; object-fit: cover; border-radius: 24px;" />

            <!-- Centered Badge -->
            <div class="about-us-badge-wrapper">
                <button class="about-us-badge">Explore Courses</button>
                <p>Discover 300+ degree, diploma, and professional programs across India.</p>
            </div>

            <!-- Green Down Arrow Button -->
            <button class="about-scroll-btn" aria-label="Scroll Down" onclick="document.getElementById('coursesCatalog').scrollIntoView({behavior: 'smooth'})">
                <img style="width: 49px; height: 62px" src="{{ asset('assets/images/inner-banner-down-arror.png') }}" alt="" />
            </button>
        </div>
    </div>
</main>

<!-- Stream Quick Category Pills -->
<div class="univ-partner-band" style="padding: 15px 0; background: #fff; border-bottom: 1px solid #f0f0f0;">
    <div class="container">
        <div class="d-flex align-items-center gap-2 overflow-auto py-1" style="scrollbar-width: thin;">
            <span class="fw-bold text-muted me-2 text-nowrap" style="font-size: 13px;"><i class="fa-solid fa-fire text-danger me-1"></i> Popular Streams:</span>
            <a href="{{ route('courses.index') }}" class="btn btn-sm rounded-pill px-3 {{ !request('stream') ? 'btn-primary' : 'btn-outline-secondary' }}" style="font-size: 12.5px; white-space: nowrap;">All Streams</a>
            @foreach($allStreams->take(8) as $st)
                <a href="{{ route('courses.index', array_merge(request()->except(['stream', 'page']), ['stream' => [$st->id]])) }}" 
                   class="btn btn-sm rounded-pill px-3 {{ in_array($st->id, (array) request('stream', [])) ? 'btn-primary' : 'btn-outline-secondary' }}" 
                   style="font-size: 12.5px; white-space: nowrap;">
                    {{ $st->title }}
                </a>
            @endforeach
        </div>
    </div>
</div>

<!-- Breadcrumb path -->
<div class="py-3" style="background-color: #f9ad0b14">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0" style="font-size: 13.5px; font-weight: 500;">
                <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-decoration-none text-muted"><i class="fa-solid fa-house me-1"></i> Home</a></li>
                <li class="breadcrumb-item active text-primary" aria-current="page">Courses</li>
            </ol>
        </nav>
    </div>
</div>

<!-- Main Catalog Section -->
<section class="univ-catalog-section py-5" id="coursesCatalog">
    <div class="container">
        <form method="GET" action="{{ route('courses.index') }}" id="courseFilterForm">
            <div class="row g-4">
                
                <!-- Left Sidebar Filters -->
                <div class="col-lg-3 col-md-4">
                    <!-- Showing Count Card -->
                    <div class="showing-count-card mb-3">
                        Showing <span class="text-primary fw-bold">{{ $courses->total() }}</span> Courses
                    </div>

                    <!-- Sidebar Filter wrapper -->
                    <div class="filter-sidebar-wrapper">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h4 class="fw-bold mb-0" style="font-size: 15px; color: #0D1B2A;">Filters By</h4>
                            <a href="{{ route('courses.index') }}" class="text-decoration-none text-primary fw-bold" style="font-size: 13px;">Reset All</a>
                        </div>

                        <!-- Keyword Search -->
                        <div class="filter-group-card mb-3">
                            <div class="filter-group-header d-flex justify-content-between align-items-center" data-bs-toggle="collapse" data-bs-target="#filterSearch" aria-expanded="true">
                                <span>Search Course</span>
                                <i class="fa-solid fa-chevron-down"></i>
                            </div>
                            <div class="collapse show" id="filterSearch">
                                <div class="filter-group-body">
                                    <div class="filter-search-wrapper position-relative">
                                        <input type="text" name="search" id="courseSearchInput" placeholder="e.g. B.Tech, MBA, Data..." class="form-control ps-4" value="{{ request('search') }}">
                                        <i class="fa-solid fa-magnifying-glass position-absolute" style="left: 10px; top: 12px; color: #888;"></i>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Program Level Filter -->
                        @if($allProgramLevels->isNotEmpty())
                        <div class="filter-group-card mb-3">
                            <div class="filter-group-header d-flex justify-content-between align-items-center" data-bs-toggle="collapse" data-bs-target="#filterLevel" aria-expanded="true">
                                <span>Program Level</span>
                                <i class="fa-solid fa-chevron-down"></i>
                            </div>
                            <div class="collapse show" id="filterLevel">
                                <div class="filter-group-body">
                                    <div class="filter-checklist" style="max-height: 200px; overflow-y: auto;">
                                        @foreach($allProgramLevels as $lvl)
                                        <div class="form-check d-flex align-items-center justify-content-between mb-2">
                                            <div>
                                                <input class="form-check-input filter-checkbox" type="checkbox" name="level[]" value="{{ $lvl->id }}" id="lvl_{{ $lvl->id }}"
                                                    {{ in_array($lvl->id, (array) request('level', [])) || in_array($lvl->title, (array) request('level', [])) ? 'checked' : '' }} onchange="this.form.submit()">
                                                <label class="form-check-label ms-1" for="lvl_{{ $lvl->id }}" style="font-size: 13px;">{{ $lvl->title }}</label>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif

                        <!-- Stream Offered Filter -->
                        @if($allStreams->isNotEmpty())
                        <div class="filter-group-card mb-3">
                            <div class="filter-group-header d-flex justify-content-between align-items-center" data-bs-toggle="collapse" data-bs-target="#filterStream" aria-expanded="true">
                                <span>Stream / Field</span>
                                <i class="fa-solid fa-chevron-down"></i>
                            </div>
                            <div class="collapse show" id="filterStream">
                                <div class="filter-group-body">
                                    <div class="filter-checklist" style="max-height: 220px; overflow-y: auto;">
                                        @foreach($allStreams as $st)
                                        <div class="form-check d-flex align-items-center justify-content-between mb-2">
                                            <div>
                                                <input class="form-check-input filter-checkbox" type="checkbox" name="stream[]" value="{{ $st->id }}" id="st_{{ $st->id }}"
                                                    {{ in_array($st->id, (array) request('stream', [])) || in_array($st->title, (array) request('stream', [])) ? 'checked' : '' }} onchange="this.form.submit()">
                                                <label class="form-check-label ms-1" for="st_{{ $st->id }}" style="font-size: 13px;">{{ $st->title }}</label>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif

                        <!-- Discipline Filter -->
                        @if($allDisciplines->isNotEmpty())
                        <div class="filter-group-card mb-3">
                            <div class="filter-group-header d-flex justify-content-between align-items-center" data-bs-toggle="collapse" data-bs-target="#filterDiscipline" aria-expanded="false">
                                <span>Discipline / Branch</span>
                                <i class="fa-solid fa-chevron-down"></i>
                            </div>
                            <div class="collapse {{ request('discipline') ? 'show' : '' }}" id="filterDiscipline">
                                <div class="filter-group-body">
                                    <div class="filter-checklist" style="max-height: 220px; overflow-y: auto;">
                                        @foreach($allDisciplines as $disc)
                                        <div class="form-check d-flex align-items-center justify-content-between mb-2">
                                            <div>
                                                <input class="form-check-input filter-checkbox" type="checkbox" name="discipline[]" value="{{ $disc->id }}" id="disc_{{ $disc->id }}"
                                                    {{ in_array($disc->id, (array) request('discipline', [])) || in_array($disc->title, (array) request('discipline', [])) ? 'checked' : '' }} onchange="this.form.submit()">
                                                <label class="form-check-label ms-1" for="disc_{{ $disc->id }}" style="font-size: 13px;">{{ $disc->title }}</label>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif

                        <!-- Course Type Filter -->
                        @if($allCourseTypes->isNotEmpty())
                        <div class="filter-group-card mb-3">
                            <div class="filter-group-header d-flex justify-content-between align-items-center" data-bs-toggle="collapse" data-bs-target="#filterCourseType" aria-expanded="false">
                                <span>Degree / Course Type</span>
                                <i class="fa-solid fa-chevron-down"></i>
                            </div>
                            <div class="collapse {{ request('course_type') ? 'show' : '' }}" id="filterCourseType">
                                <div class="filter-group-body">
                                    <div class="filter-checklist">
                                        @foreach($allCourseTypes as $ct)
                                        <div class="form-check d-flex align-items-center justify-content-between mb-2">
                                            <div>
                                                <input class="form-check-input filter-checkbox" type="checkbox" name="course_type[]" value="{{ $ct->id }}" id="ct_{{ $ct->id }}"
                                                    {{ in_array($ct->id, (array) request('course_type', [])) || in_array($ct->title, (array) request('course_type', [])) ? 'checked' : '' }} onchange="this.form.submit()">
                                                <label class="form-check-label ms-1" for="ct_{{ $ct->id }}" style="font-size: 13px;">{{ $ct->title }}</label>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif

                        <!-- Duration Filter -->
                        @if($allDurations->isNotEmpty())
                        <div class="filter-group-card mb-3">
                            <div class="filter-group-header d-flex justify-content-between align-items-center" data-bs-toggle="collapse" data-bs-target="#filterDuration" aria-expanded="false">
                                <span>Duration</span>
                                <i class="fa-solid fa-chevron-down"></i>
                            </div>
                            <div class="collapse {{ request('duration') ? 'show' : '' }}" id="filterDuration">
                                <div class="filter-group-body">
                                    <div class="filter-checklist">
                                        @foreach($allDurations as $dur)
                                        <div class="form-check d-flex align-items-center justify-content-between mb-2">
                                            <div>
                                                <input class="form-check-input filter-checkbox" type="checkbox" name="duration[]" value="{{ $dur }}" id="dur_{{ Str::slug($dur) }}"
                                                    {{ in_array($dur, (array) request('duration', [])) ? 'checked' : '' }} onchange="this.form.submit()">
                                                <label class="form-check-label ms-1" for="dur_{{ Str::slug($dur) }}" style="font-size: 13px;">{{ $dur }} {{ is_numeric($dur) ? 'Years' : '' }}</label>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif

                        <!-- Apply & Reset Buttons -->
                        <div class="d-flex gap-2 mt-3">
                            <button type="submit" class="btn btn-primary flex-grow-1" style="border-radius: 8px; font-size: 14px; font-weight: 600;">
                                <i class="fa-solid fa-filter me-1"></i> Apply
                            </button>
                            <a href="{{ route('courses.index') }}" class="btn btn-outline-secondary" style="border-radius: 8px; font-size: 14px;">
                                Reset
                            </a>
                        </div>

                    </div>
                </div>

                <!-- Right catalog listing grid -->
                <div class="col-lg-9 col-md-8">
                    <!-- Sorting & active filter row -->
                    <div class="catalog-header-bar d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4 p-3 bg-white rounded-3 border">
                        <div class="d-flex align-items-center gap-2 flex-wrap">
                            <span class="text-muted fw-bold" style="font-size: 13.5px;">Active Filters:</span>

                            @php
                                $hasActiveFilters = request()->filled('search') || request()->filled('level') || request()->filled('stream') || request()->filled('discipline') || request()->filled('course_type') || request()->filled('duration') || request()->filled('mode');
                            @endphp

                            @if(!$hasActiveFilters)
                                <span class="badge bg-light text-secondary border px-2 py-1">All Courses</span>
                            @endif

                            @if(request()->filled('search'))
                                <span class="badge bg-primary text-white d-flex align-items-center gap-1 px-2 py-1">
                                    Search: {{ request('search') }}
                                    <a href="{{ route('courses.index', request()->except(['search', 'page'])) }}" class="text-white ms-1 text-decoration-none"><i class="fa-solid fa-xmark"></i></a>
                                </span>
                            @endif

                            @foreach((array) request('level', []) as $activeLvl)
                                @php
                                    $lvlModel = $allProgramLevels->firstWhere('id', $activeLvl) ?? $allProgramLevels->firstWhere('title', $activeLvl);
                                    $remLevels = array_values(array_filter((array) request('level', []), fn($l) => $l != $activeLvl));
                                    $remParams = request()->except(['level', 'page']);
                                    if (!empty($remLevels)) { $remParams['level'] = $remLevels; }
                                @endphp
                                <span class="badge bg-primary text-white d-flex align-items-center gap-1 px-2 py-1">
                                    Level: {{ $lvlModel ? $lvlModel->title : $activeLvl }}
                                    <a href="{{ route('courses.index', $remParams) }}" class="text-white ms-1 text-decoration-none"><i class="fa-solid fa-xmark"></i></a>
                                </span>
                            @endforeach

                            @foreach((array) request('stream', []) as $activeStr)
                                @php
                                    $strModel = $allStreams->firstWhere('id', $activeStr) ?? $allStreams->firstWhere('title', $activeStr);
                                    $remStreams = array_values(array_filter((array) request('stream', []), fn($s) => $s != $activeStr));
                                    $remParams = request()->except(['stream', 'page']);
                                    if (!empty($remStreams)) { $remParams['stream'] = $remStreams; }
                                @endphp
                                <span class="badge bg-primary text-white d-flex align-items-center gap-1 px-2 py-1">
                                    Stream: {{ $strModel ? $strModel->title : $activeStr }}
                                    <a href="{{ route('courses.index', $remParams) }}" class="text-white ms-1 text-decoration-none"><i class="fa-solid fa-xmark"></i></a>
                                </span>
                            @endforeach

                            @foreach((array) request('discipline', []) as $activeDisc)
                                @php
                                    $discModel = $allDisciplines->firstWhere('id', $activeDisc) ?? $allDisciplines->firstWhere('title', $activeDisc);
                                    $remDiscs = array_values(array_filter((array) request('discipline', []), fn($d) => $d != $activeDisc));
                                    $remParams = request()->except(['discipline', 'page']);
                                    if (!empty($remDiscs)) { $remParams['discipline'] = $remDiscs; }
                                @endphp
                                <span class="badge bg-primary text-white d-flex align-items-center gap-1 px-2 py-1">
                                    Discipline: {{ $discModel ? $discModel->title : $activeDisc }}
                                    <a href="{{ route('courses.index', $remParams) }}" class="text-white ms-1 text-decoration-none"><i class="fa-solid fa-xmark"></i></a>
                                </span>
                            @endforeach

                            @foreach((array) request('course_type', []) as $activeCt)
                                @php
                                    $ctModel = $allCourseTypes->firstWhere('id', $activeCt) ?? $allCourseTypes->firstWhere('title', $activeCt);
                                    $remCts = array_values(array_filter((array) request('course_type', []), fn($c) => $c != $activeCt));
                                    $remParams = request()->except(['course_type', 'page']);
                                    if (!empty($remCts)) { $remParams['course_type'] = $remCts; }
                                @endphp
                                <span class="badge bg-primary text-white d-flex align-items-center gap-1 px-2 py-1">
                                    Type: {{ $ctModel ? $ctModel->title : $activeCt }}
                                    <a href="{{ route('courses.index', $remParams) }}" class="text-white ms-1 text-decoration-none"><i class="fa-solid fa-xmark"></i></a>
                                </span>
                            @endforeach

                            @foreach((array) request('duration', []) as $activeDur)
                                @php
                                    $remDurs = array_values(array_filter((array) request('duration', []), fn($d) => $d != $activeDur));
                                    $remParams = request()->except(['duration', 'page']);
                                    if (!empty($remDurs)) { $remParams['duration'] = $remDurs; }
                                @endphp
                                <span class="badge bg-primary text-white d-flex align-items-center gap-1 px-2 py-1">
                                    Duration: {{ $activeDur }}
                                    <a href="{{ route('courses.index', $remParams) }}" class="text-white ms-1 text-decoration-none"><i class="fa-solid fa-xmark"></i></a>
                                </span>
                            @endforeach
                        </div>

                        <!-- Sort Dropdown -->
                        <div class="d-flex align-items-center gap-2 ms-auto">
                            <label for="sortDropdown" class="text-muted fw-bold text-nowrap mb-0" style="font-size: 13.5px;">Sort By:</label>
                            <select name="sort" id="sortDropdown" class="form-select form-select-sm" style="width: auto; font-size: 13px;" onchange="this.form.submit()">
                                <option value="latest" {{ request('sort','latest') === 'latest' ? 'selected' : '' }}>Latest / Recommended</option>
                                <option value="name" {{ request('sort') === 'name' ? 'selected' : '' }}>Course Name (A-Z)</option>
                                <option value="name_desc" {{ request('sort') === 'name_desc' ? 'selected' : '' }}>Course Name (Z-A)</option>
                                <option value="duration" {{ request('sort') === 'duration' ? 'selected' : '' }}>Duration</option>
                            </select>
                        </div>
                    </div>

                    <!-- Cards Row Grid -->
                    <div class="row row-cols-1 row-cols-md-2 g-4">
                        @forelse($courses as $c)
                        <div class="col">
                            <div class="course-listing-card bg-white p-4 rounded-4 border shadow-sm h-100 d-flex flex-column justify-content-between position-relative hover-shadow transition" style="border: 1.5px solid #eaeaea; transition: all 0.25s ease;">
                                
                                <div>
                                    <!-- Top Badges Row -->
                                    <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
                                        <span class="badge bg-primary bg-opacity-10 text-primary fw-bold px-3 py-1 rounded-pill" style="font-size: 12px;">
                                            <i class="fa-solid fa-graduation-cap me-1"></i> {{ $c->programLevel->title ?? 'Degree Program' }}
                                        </span>
                                        @if($c->duration)
                                            <span class="badge bg-warning bg-opacity-25 text-dark fw-bold px-2 py-1 rounded-pill" style="font-size: 11.5px;">
                                                <i class="fa-regular fa-clock me-1 text-warning"></i> {{ $c->duration }} {{ is_numeric($c->duration) ? 'Years' : '' }}
                                            </span>
                                        @endif
                                    </div>

                                    <!-- Course Title -->
                                    <h3 class="fw-bold mb-1" style="font-size: 17px; line-height: 1.4;">
                                        <a href="{{ route('course.detail', $c->slug) }}" class="text-decoration-none text-dark hover-primary">
                                            {{ $c->name }}
                                        </a>
                                    </h3>

                                    @if($c->full_form)
                                        <p class="text-muted mb-2" style="font-size: 13px; font-style: italic;">
                                            {{ $c->full_form }}
                                        </p>
                                    @endif

                                    <!-- Stream & Discipline Meta -->
                                    <div class="d-flex align-items-center gap-1 text-muted mb-3 flex-wrap" style="font-size: 12.5px;">
                                        @if($c->streamOffered)
                                            <span class="badge bg-light text-dark border">{{ $c->streamOffered->title }}</span>
                                        @endif
                                        @if($c->discipline)
                                            <span class="badge bg-light text-dark border">{{ $c->discipline->title }}</span>
                                        @endif
                                        @if($c->courseType)
                                            <span class="badge bg-light text-primary border">{{ $c->courseType->title }}</span>
                                        @endif
                                    </div>

                                    <!-- Key Specs Box -->
                                    <div class="p-3 rounded-3 mb-3" style="background-color: #f8fafc; border-left: 3px solid #3771C8;">
                                        <div class="row g-2 text-start" style="font-size: 12.5px;">
                                            <div class="col-6">
                                                <span class="text-muted d-block" style="font-size: 11px; text-transform: uppercase;">Study Mode</span>
                                                <strong class="text-dark">
                                                    @if(is_array($c->available_modes) && count($c->available_modes))
                                                        {{ implode(', ', $c->available_modes) }}
                                                    @else
                                                        Full-Time / Regular
                                                    @endif
                                                </strong>
                                            </div>
                                            <div class="col-6">
                                                <span class="text-muted d-block" style="font-size: 11px; text-transform: uppercase;">Avg Package / Salary</span>
                                                <strong class="text-success">{{ $c->average_salary_range ?: '₹4.5 - ₹10 LPA' }}</strong>
                                            </div>
                                            <div class="col-12 mt-2 pt-2 border-top">
                                                <span class="text-muted d-block" style="font-size: 11px; text-transform: uppercase;">Offering Institutions</span>
                                                <span class="text-dark fw-semibold">
                                                    <i class="fa-solid fa-university text-primary me-1"></i> 
                                                    {{ $c->organisation_courses_count > 0 ? $c->organisation_courses_count . '+ Universities & Colleges' : 'Top Colleges Nationwide' }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Brief Overview Excerpt -->
                                    @if($c->overview)
                                        <p class="text-muted mb-3" style="font-size: 13px; line-height: 1.5; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">
                                            {{ strip_tags($c->overview) }}
                                        </p>
                                    @endif
                                </div>

                                <!-- Action Buttons -->
                                <div class="pt-3 border-top d-flex gap-2">
                                    <a href="{{ route('course.detail', $c->slug) }}" class="btn btn-outline-primary w-50 fw-bold" style="border-radius: 8px; font-size: 13px; padding: 8px 12px;">
                                        <i class="fa-regular fa-eye me-1"></i> Course Details
                                    </a>
                                    <a href="{{ route('course.detail', $c->slug) }}#offering-colleges" class="btn btn-primary w-50 fw-bold text-white" style="border-radius: 8px; font-size: 13px; padding: 8px 12px;">
                                        Explore Colleges <i class="fa-solid fa-chevron-right ms-1" style="font-size: 10px;"></i>
                                    </a>
                                </div>

                            </div>
                        </div>
                        @empty
                        <div class="col-12">
                            <div class="text-center py-5 bg-white rounded-4 border p-4">
                                <i class="fa-solid fa-book-open text-muted mb-3" style="font-size: 48px;"></i>
                                <h4 class="fw-bold text-dark mb-2">No Courses Found</h4>
                                <p class="text-muted mb-4" style="max-width: 480px; margin: 0 auto;">We couldn't find any courses matching your specific search and filter criteria. Try resetting or selecting different streams or levels.</p>
                                <a href="{{ route('courses.index') }}" class="btn btn-primary px-4 py-2 rounded-pill fw-bold">
                                    <i class="fa-solid fa-rotate-left me-1"></i> Reset All Filters
                                </a>
                            </div>
                        </div>
                        @endforelse
                    </div>

                    <!-- Pagination -->
                    @if($courses->hasPages())
                    <div class="d-flex justify-content-center mt-5">
                        {{ $courses->links('pagination::bootstrap-5') }}
                    </div>
                    @endif

                </div>
            </div>
        </form>
    </div>
</section>
@endsection

@push('css')
<style>
.course-listing-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 12px 28px rgba(0, 0, 0, 0.08) !important;
    border-color: #3771C8 !important;
}
.hover-primary:hover {
    color: #3771C8 !important;
}
</style>
@endpush