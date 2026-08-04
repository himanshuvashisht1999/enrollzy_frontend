@extends('layouts.app')
@section('meta_title', 'Scholarships & Benefits | Enrollzy')
@section('meta_description', 'Find the perfect scholarship for your education. Check out top student benefits, financial aid, and support programs.')

@section('content')
<main class="about-hero-section ptb-70">
    <div class="bg-square">
        <img src="{{ asset('assets/images/banner-square-img.svg') }}" alt="" />
    </div>
    <div class="container">
        <div class="about-hero-container">
            <img src="{{ asset('assets/images/scholarship-page-banner-img.png') }}" alt="Scholarships & Benefits Banner" />

            <!-- Centered Badge -->
            <div class="about-us-badge-wrapper">
                <button class="about-us-badge">Scholarships & Benefits</button>
                <p>Check out the top student benefits and programs designed for your success.</p>
            </div>

            <!-- Scroll Down Button -->
            <button class="about-scroll-btn" aria-label="Scroll Down" onclick="document.getElementById('scholarshipFilterCard').scrollIntoView({behavior: 'smooth'})">
                <img style="width: 49px; height: 62px" src="{{ asset('assets/images/inner-banner-down-arror.png') }}" alt="" />
            </button>
        </div>
    </div>
</main>

<!-- Breadcrumb path -->
<div class="py-3" style="background-color: #f9ad0b14; position: relative; z-index: 100;">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0" style="font-size: 13.5px; font-weight: 500;">
                <li class="breadcrumb-item"><a href="{{ url('/') }}" class="text-decoration-none text-muted" style="position: relative; z-index: 101; cursor: pointer;"><i class="fa-solid fa-house me-1"></i> Home</a></li>
                <li class="breadcrumb-item active text-primary" aria-current="page">Scholarships & Benefits</li>
            </ol>
        </nav>
    </div>
</div>

<!-- Main Content Grid -->
<div style="background-color: #FAFBFD; padding: 45px 0;">
    <div class="container">

        @if(session('error'))
            <div class="alert alert-warning alert-dismissible fade show mb-4 rounded-3 shadow-sm" role="alert">
                <i class="fa-solid fa-triangle-exclamation me-2"></i> {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- Filter Panel Box -->
        <div class="sb-filter-card mb-4" id="scholarshipFilterCard">
            <form action="{{ route('scholarships') }}" method="GET" id="sbFilterForm">
                <div class="sb-filter-header">
                    <div>
                        <h1 class="sb-filter-title">Scholarships & Benefits</h1>
                        <p class="sb-filter-subtitle">Find the perfect scholarship for your education</p>
                    </div>
                    <div class="sb-search-wrapper">
                        <i class="fa-solid fa-magnifying-glass"></i>
                        <input type="text" name="search" id="sbSearchInput" value="{{ request('search') }}" placeholder="Search scholarships..." class="form-control">
                    </div>
                </div>

                <div class="sb-filter-row mt-3">
                    <div class="sb-selects-group">
                        <select name="class" id="sbClassSelect" class="form-select sb-filter-select">
                            <option value="">Select Class / Level</option>
                            <option value="9" {{ request('class') == '9' ? 'selected' : '' }}>Class 9</option>
                            <option value="10" {{ request('class') == '10' ? 'selected' : '' }}>Class 10</option>
                            <option value="11" {{ request('class') == '11' ? 'selected' : '' }}>Class 11</option>
                            <option value="12" {{ request('class') == '12' ? 'selected' : '' }}>Class 12</option>
                            <option value="higher" {{ request('class') == 'higher' ? 'selected' : '' }}>Higher Education / Degrees</option>
                        </select>

                        <select name="gender" id="sbGenderSelect" class="form-select sb-filter-select">
                            <option value="">Select Gender</option>
                            <option value="boys" {{ request('gender') == 'boys' ? 'selected' : '' }}>Boys</option>
                            <option value="girls" {{ request('gender') == 'girls' ? 'selected' : '' }}>Girls / Women</option>
                            <option value="coed" {{ request('gender') == 'coed' ? 'selected' : '' }}>Co-ed / All</option>
                        </select>

                        <select name="state" id="sbStateSelect" class="form-select sb-filter-select">
                            <option value="">Select State</option>
                            @if(isset($dbStates) && count($dbStates) > 0)
                                @foreach($dbStates as $st)
                                    <option value="{{ strtolower($st) }}" {{ strtolower(request('state')) == strtolower($st) ? 'selected' : '' }}>{{ $st }}</option>
                                @endforeach
                            @else
                                <option value="uttarakhand" {{ request('state') == 'uttarakhand' ? 'selected' : '' }}>Uttarakhand</option>
                                <option value="rajasthan" {{ request('state') == 'rajasthan' ? 'selected' : '' }}>Rajasthan</option>
                                <option value="punjab" {{ request('state') == 'punjab' ? 'selected' : '' }}>Punjab</option>
                                <option value="delhi" {{ request('state') == 'delhi' ? 'selected' : '' }}>Delhi / All India</option>
                            @endif
                        </select>

                        <select name="status" id="sbStatusSelect" class="form-select sb-filter-select">
                            <option value="">Select Status</option>
                            <option value="live" {{ request('status') == 'live' ? 'selected' : '' }}>Live</option>
                            <option value="upcoming" {{ request('status') == 'upcoming' ? 'selected' : '' }}>Upcoming</option>
                            <option value="closed" {{ request('status') == 'closed' ? 'selected' : '' }}>Closed</option>
                        </select>

                        <select name="year" id="sbYearSelect" class="form-select sb-filter-select">
                            <option value="">Select Year</option>
                            @if(isset($dbYears) && count($dbYears) > 0)
                                @foreach($dbYears as $yr)
                                    <option value="{{ $yr }}" {{ request('year') == $yr ? 'selected' : '' }}>{{ $yr }}</option>
                                @endforeach
                            @else
                                <option value="2025" {{ request('year') == '2025' ? 'selected' : '' }}>2025</option>
                                <option value="2026" {{ request('year') == '2026' ? 'selected' : '' }}>2026</option>
                                <option value="2027" {{ request('year') == '2027' ? 'selected' : '' }}>2027</option>
                            @endif
                        </select>
                    </div>

                    <div class="sb-buttons-group">
                        <button type="button" class="btn btn-light btn-sb-reset" id="btnSbReset">Reset</button>
                        <button type="submit" class="btn btn-primary btn-sb-apply">Apply Filters</button>
                    </div>
                </div>
            </form>
        </div>

        <!-- Scholarship cards grid -->
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4" id="sbCardsContainer">
            @forelse($benefits as $benefit)
                @php
                    $elig = $benefit->eligibility;
                    $classes = [];
                    if ($elig) {
                        $minC = strtolower($elig->minimum_class ?? '');
                        $maxC = strtolower($elig->maximum_class ?? '');
                        $lvl = strtolower($elig->course_level ?? '');
                        
                        if (str_contains($minC, '9') || str_contains($maxC, '9') || str_contains($lvl, '9')) $classes[] = '9';
                        if (str_contains($minC, '10') || str_contains($maxC, '10') || str_contains($lvl, '10')) $classes[] = '10';
                        if (str_contains($minC, '11') || str_contains($maxC, '11') || str_contains($lvl, '11')) $classes[] = '11';
                        if (str_contains($minC, '12') || str_contains($maxC, '12') || str_contains($lvl, '12')) $classes[] = '12';
                        if (str_contains($lvl, 'ug') || str_contains($lvl, 'pg') || str_contains($lvl, 'degree') || str_contains($lvl, 'diploma') || str_contains($lvl, 'higher')) {
                            $classes[] = 'higher';
                        }
                    }
                    if (empty($classes)) {
                        $classes = ['9', '10', '11', '12', 'higher'];
                    }
                    
                    $gender = 'coed';
                    if ($elig && (strtolower($elig->gender) === 'female' || strtolower($elig->gender) === 'girls' || strtolower($elig->gender) === 'women')) {
                        $gender = 'girls';
                    } elseif ($elig && (strtolower($elig->gender) === 'male' || strtolower($elig->gender) === 'boys')) {
                        $gender = 'boys';
                    }
                    
                    $state = strtolower($elig->state ?? 'all');
                    
                    $status = 'live';
                    if ($benefit->dates) {
                        $now = now();
                        $start = $benefit->dates->application_start_date;
                        $end = $benefit->dates->application_end_date;
                        if ($start && $now->lt($start)) {
                            $status = 'upcoming';
                        } elseif ($end && $now->gt($end->endOfDay())) {
                            $status = 'closed';
                        }
                    }
                    if ($benefit->status == 0) {
                        $status = 'closed';
                    }
                    
                    $year = '2026';
                    if ($benefit->dates && $benefit->dates->application_end_date) {
                        $year = $benefit->dates->application_end_date->format('Y');
                    } elseif ($benefit->dates && $benefit->dates->application_start_date) {
                        $year = $benefit->dates->application_start_date->format('Y');
                    }

                    $reward = '';
                    if ($benefit->max_amount) {
                        $reward = ($benefit->amount_prefix ? $benefit->amount_prefix . ' ' : '') . '₹' . number_format($benefit->max_amount, 0) . ($benefit->amount_suffix ? ' ' . $benefit->amount_suffix : '');
                    } else {
                        $reward = 'Reward Details Inside';
                    }

                    $desc = $benefit->short_description ?: Str::limit(strip_tags($benefit->overview), 140);
                @endphp

                <div class="col sb-card-item" data-class="{{ implode(',', $classes) }}" data-gender="{{ $gender }}" data-state="{{ $state }}" data-status="{{ $status }}" data-year="{{ $year }}">
                    <div class="sb-card h-100 d-flex flex-column">
                        <div class="sb-card-banner">
                            @if($status === 'live')
                                <span class="sb-badge-live">Live</span>
                            @elseif($status === 'upcoming')
                                <span class="sb-badge-live bg-warning">Upcoming</span>
                            @else
                                <span class="sb-badge-live bg-danger">Closed</span>
                            @endif
                            
                            @if($status === 'live' && $benefit->dates && $benefit->dates->application_end_date)
                                <span class="sb-badge-deadline">Deadline: {{ $benefit->dates->application_end_date->format('d M Y') }}</span>
                            @endif
                            
                            <img src="{{ $benefit->featured_image ? (str_starts_with($benefit->featured_image, 'http') ? $benefit->featured_image : (file_exists(public_path($benefit->featured_image)) ? asset($benefit->featured_image) : rtrim(env('BACKEND_URL', 'http://127.0.0.1:8001'), '/') . '/' . ltrim($benefit->featured_image, '/'))) : asset('assets/images/scholarship-card-img.png') }}" alt="{{ $benefit->title }}">
                        </div>
                        <div class="sb-card-body d-flex flex-column flex-grow-1">
                            <h3 class="sb-card-title"><a href="{{ route('scholarship.detail', $benefit->slug ?: $benefit->id) }}" class="text-dark text-decoration-none">{{ $benefit->title }}</a></h3>
                            <div class="sb-reward-badge mb-2">
                                <i class="fa-regular fa-lightbulb text-warning me-1"></i> {{ $reward }}
                            </div>
                            <p class="sb-card-text flex-grow-1">{{ $desc }}</p>
                            <a href="{{ route('scholarship.detail', $benefit->slug ?: $benefit->id) }}" class="btn-sb-learnmore mt-auto">Learn more <i class="fa-solid fa-chevron-right" style="font-size: 8px;"></i></a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-5">
                    <p class="text-muted fs-5">No active scholarships found matching your criteria.</p>
                </div>
            @endforelse
        </div>

        <!-- No Filter Results Message -->
        <div id="sbNoResults" class="text-center py-5" style="display: none;">
            <div class="mb-3">
                <i class="fa-solid fa-folder-open text-muted fa-3x"></i>
            </div>
            <h4 class="fw-bold text-dark mb-2">No matching scholarships found</h4>
            <p class="text-muted">Try adjusting or resetting your filter criteria.</p>
        </div>
    </div>
</div>

<!-- Interactive Dynamic Client-side Filter Logic -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const searchInput = document.getElementById('sbSearchInput');
        const classSelect = document.getElementById('sbClassSelect');
        const genderSelect = document.getElementById('sbGenderSelect');
        const stateSelect = document.getElementById('sbStateSelect');
        const statusSelect = document.getElementById('sbStatusSelect');
        const yearSelect = document.getElementById('sbYearSelect');
        
        const resetBtn = document.getElementById('btnSbReset');
        const cards = document.querySelectorAll('.sb-card-item');
        const noResultsMsg = document.getElementById('sbNoResults');
        
        function filterCards() {
            const searchQuery = searchInput.value.toLowerCase().trim();
            const selectedClass = classSelect.value.toLowerCase();
            const selectedGender = genderSelect.value.toLowerCase();
            const selectedState = stateSelect.value.toLowerCase();
            const selectedStatus = statusSelect.value.toLowerCase();
            const selectedYear = yearSelect.value;

            let visibleCount = 0;

            cards.forEach(card => {
                const cardTitle = (card.querySelector('.sb-card-title')?.textContent || '').toLowerCase();
                const cardText = (card.querySelector('.sb-card-text')?.textContent || '').toLowerCase();
                
                const cardClasses = (card.getAttribute('data-class') || '').split(',');
                const cardGender = card.getAttribute('data-gender') || 'coed';
                const cardState = (card.getAttribute('data-state') || 'all').toLowerCase();
                const cardStatus = card.getAttribute('data-status') || 'live';
                const cardYear = card.getAttribute('data-year') || '2026';
                
                // 1. Search Query
                const matchesSearch = !searchQuery || cardTitle.includes(searchQuery) || cardText.includes(searchQuery);
                
                // 2. Class Filter
                const matchesClass = !selectedClass || cardClasses.includes(selectedClass);
                
                // 3. Gender Filter
                const matchesGender = !selectedGender || cardGender === 'coed' || selectedGender === 'coed' || cardGender === selectedGender;
                
                // 4. State Filter
                const matchesState = !selectedState || cardState === 'all' || cardState.includes(selectedState) || selectedState.includes(cardState);
                
                // 5. Status Filter
                const matchesStatus = !selectedStatus || cardStatus === selectedStatus;
                
                // 6. Year Filter
                const matchesYear = !selectedYear || cardYear === selectedYear;

                if (matchesSearch && matchesClass && matchesGender && matchesState && matchesStatus && matchesYear) {
                    card.style.display = 'block';
                    visibleCount++;
                } else {
                    card.style.display = 'none';
                }
            });

            if (noResultsMsg) {
                noResultsMsg.style.display = visibleCount === 0 ? 'block' : 'none';
            }
        }

        // Live input & select filtering
        [searchInput, classSelect, genderSelect, stateSelect, statusSelect, yearSelect].forEach(el => {
            if (el) {
                el.addEventListener('input', filterCards);
                el.addEventListener('change', filterCards);
            }
        });

        if (resetBtn) {
            resetBtn.addEventListener('click', function (e) {
                e.preventDefault();
                searchInput.value = '';
                classSelect.value = '';
                genderSelect.value = '';
                stateSelect.value = '';
                statusSelect.value = '';
                yearSelect.value = '';
                if (window.location.search) {
                    window.location.href = "{{ route('scholarships') }}";
                } else {
                    filterCards();
                }
            });
        }
    });
</script>
@endsection
