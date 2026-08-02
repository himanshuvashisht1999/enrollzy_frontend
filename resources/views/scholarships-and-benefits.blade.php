@extends('layouts.app')
@section('content')
<main class="about-hero-section ptb-70">
        <div class="bg-square">
            <img src="{{ asset('assets/images/banner-square-img.svg') }}" alt="" />
        </div>
        <div class="container">
            <div class="about-hero-container">
                <img src="{{ asset('assets/images/scholarship-page-banner-img.png') }}" alt="Scholarships & Benefits Banner" />

                <!-- Centered Badge (Placed outside card to prevent clipping) -->
                <div class="about-us-badge-wrapper">
                    <button class="about-us-badge">Scholarships & Benefits</button>
                    <p>Check out the top student benefits and programs designed for your success.</p>
                </div>

                <!-- Green Down Arrow Button -->
                <button class="about-scroll-btn" aria-label="Scroll Down">
                    <img style="width: 49px; height: 62px" src="{{ asset('assets/images/inner-banner-down-arror.png') }}" alt="" />
                </button>
            </div>
        </div>
    </main>
    <!-- Breadcrumb path -->
    <div class="py-3" style="background-color: #f9ad0b14">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0" style="font-size: 13.5px; font-weight: 500;">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-decoration-none text-muted"><i class="fa-solid fa-house me-1"></i> Home</a></li>
                    <li class="breadcrumb-item active text-primary" aria-current="page">Scholarships & Benefits</li>
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
                        <input type="text" id="sbSearchInput" placeholder="Search scholarships..." class="form-control">
                    </div>
                </div>

                <div class="sb-filter-row">
                    <div class="sb-selects-group">
                        <select id="sbClassSelect" class="form-select sb-filter-select">
                            <option value="">Select Class / Level</option>
                            <option value="9">Class 9</option>
                            <option value="10">Class 10</option>
                            <option value="11">Class 11</option>
                            <option value="12">Class 12</option>
                            <option value="higher">Higher Education / Degrees</option>
                        </select>
                        <select id="sbGenderSelect" class="form-select sb-filter-select">
                            <option value="">Select Gender</option>
                            <option value="boys">Boys</option>
                            <option value="girls">Girls / Women</option>
                            <option value="coed">Co-ed / All</option>
                        </select>
                        <select id="sbStateSelect" class="form-select sb-filter-select">
                            <option value="">Select State</option>
                            <option value="uttarakhand">Uttarakhand</option>
                            <option value="rajasthan">Rajasthan</option>
                            <option value="punjab">Punjab</option>
                            <option value="delhi">Delhi / All India</option>
                        </select>
                        <select id="sbStatusSelect" class="form-select sb-filter-select">
                            <option value="">Select Status</option>
                            <option value="live">Live</option>
                            <option value="upcoming">Upcoming</option>
                            <option value="closed">Closed</option>
                        </select>
                        <select id="sbYearSelect" class="form-select sb-filter-select">
                            <option value="">Select Year</option>
                            <option value="2026">2026</option>
                            <option value="2027">2027</option>
                        </select>
                    </div>

                    <div class="sb-buttons-group">
                        <button type="button" class="btn btn-light btn-sb-reset">Reset</button>
                        <button type="button" class="btn btn-primary btn-sb-apply">Apply Filters</button>
                    </div>
                </div>
            </div>

            <!-- Scholarship cards grid -->
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4" id="sbCardsContainer">
                @forelse($benefits as $benefit)
                    @php
                        $titleLower = strtolower($benefit->title);
                        $contentLower = strtolower($benefit->content);
                        $fullText = $titleLower . ' ' . $contentLower;
                        
                        $classes = [];
                        if (str_contains($fullText, '9') || str_contains($fullText, 'ninth')) $classes[] = '9';
                        if (str_contains($fullText, '10') || str_contains($fullText, 'tenth')) $classes[] = '10';
                        if (str_contains($fullText, '11') || str_contains($fullText, 'eleventh')) $classes[] = '11';
                        if (str_contains($fullText, '12') || str_contains($fullText, 'twelfth')) $classes[] = '12';
                        if (str_contains($fullText, 'degree') || str_contains($fullText, 'online mba') || str_contains($fullText, 'bba') || str_contains($fullText, 'mca') || str_contains($fullText, 'postgraduate') || str_contains($fullText, 'undergraduate')) {
                            $classes[] = 'higher';
                        }
                        if (empty($classes)) {
                            $classes = ['9', '10', '11', '12', 'higher'];
                        }
                        
                        $gender = 'coed';
                        if (str_contains($fullText, 'girl') || str_contains($fullText, 'woman') || str_contains($fullText, 'female') || str_contains($fullText, 'women')) {
                            $gender = 'girls';
                        } elseif (str_contains($fullText, 'boy') || str_contains($fullText, 'male')) {
                            $gender = 'boys';
                        }
                        
                        $state = 'all';
                        if (str_contains($fullText, 'uttarakhand')) $state = 'uttarakhand';
                        elseif (str_contains($fullText, 'rajasthan')) $state = 'rajasthan';
                        elseif (str_contains($fullText, 'punjab')) $state = 'punjab';
                        elseif (str_contains($fullText, 'delhi')) $state = 'delhi';
                        
                        $status = 'live';
                        if (str_contains($fullText, 'upcoming')) $status = 'upcoming';
                        elseif (str_contains($fullText, 'closed')) $status = 'closed';
                        
                        $year = '2026';
                        if (str_contains($fullText, '2027')) $year = '2027';

                        $reward = $benefit->reward_amount ?: 'Upto INR 30,000';
                    @endphp

                    <div class="col sb-card-item" data-class="{{ implode(',', $classes) }}" data-gender="{{ $gender }}" data-state="{{ $state }}" data-status="{{ $status }}" data-year="{{ $year }}">
                        <div class="sb-card h-100">
                            <div class="sb-card-banner">
                                @if($status === 'live')
                                    <span class="sb-badge-live">Live</span>
                                @elseif($status === 'upcoming')
                                    <span class="sb-badge-live bg-warning">Upcoming</span>
                                @else
                                    <span class="sb-badge-live bg-danger">Closed</span>
                                @endif
                                
                                @if($status === 'live')
                                    <span class="sb-badge-deadline">Deadline: 20 Jul 2026</span>
                                @endif
                                
                                <img src="{{ $benefit->icon ? (str_starts_with($benefit->icon, 'http') ? $benefit->icon : (file_exists(public_path($benefit->icon)) ? asset($benefit->icon) : rtrim(env('BACKEND_URL', 'http://127.0.0.1:8001'), '/') . '/' . ltrim($benefit->icon, '/'))) : asset('assets/images/scholarship-card-img.png') }}" alt="{{ $benefit->title }}">
                            </div>
                            <div class="sb-card-body d-flex flex-column">
                                <h3 class="sb-card-title"><a href="{{ route('scholarship.detail', $benefit->id) }}" class="text-dark text-decoration-none">{{ $benefit->title }}</a></h3>
                                <div class="sb-reward-badge mb-2">
                                    <i class="fa-regular fa-lightbulb text-warning me-1"></i> {{ $reward }}
                                </div>
                                <p class="sb-card-text flex-grow-1">{{ $benefit->content }}</p>
                                <a href="{{ route('scholarship.detail', $benefit->id) }}" class="btn-sb-learnmore mt-auto">Learn more <i class="fa-solid fa-chevron-right" style="font-size: 8px;"></i></a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center py-5">
                        <p class="text-muted">No scholarships and benefits found.</p>
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

    <!-- Interactive Client-side Filter Logic -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const searchInput = document.getElementById('sbSearchInput');
            const classSelect = document.getElementById('sbClassSelect');
            const genderSelect = document.getElementById('sbGenderSelect');
            const stateSelect = document.getElementById('sbStateSelect');
            const statusSelect = document.getElementById('sbStatusSelect');
            const yearSelect = document.getElementById('sbYearSelect');
            
            const applyBtn = document.querySelector('.btn-sb-apply');
            const resetBtn = document.querySelector('.btn-sb-reset');
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
                    const cardState = card.getAttribute('data-state') || 'all';
                    const cardStatus = card.getAttribute('data-status') || 'live';
                    const cardYear = card.getAttribute('data-year') || '2026';
                    
                    // 1. Search Query
                    const matchesSearch = !searchQuery || cardTitle.includes(searchQuery) || cardText.includes(searchQuery);
                    
                    // 2. Class Filter
                    const matchesClass = !selectedClass || cardClasses.includes(selectedClass);
                    
                    // 3. Gender Filter
                    const matchesGender = !selectedGender || cardGender === 'coed' || selectedGender === 'coed' || cardGender === selectedGender;
                    
                    // 4. State Filter
                    const matchesState = !selectedState || cardState === 'all' || cardState === selectedState;
                    
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

            // Bind triggers to all inputs and selects for instant filtering
            [searchInput, classSelect, genderSelect, stateSelect, statusSelect, yearSelect].forEach(el => {
                if (el) {
                    el.addEventListener('change', filterCards);
                    el.addEventListener('input', filterCards);
                }
            });

            if (applyBtn) {
                applyBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    filterCards();
                });
            }

            if (resetBtn) {
                resetBtn.addEventListener('click', function (e) {
                    e.preventDefault();
                    searchInput.value = '';
                    classSelect.value = '';
                    genderSelect.value = '';
                    stateSelect.value = '';
                    statusSelect.value = '';
                    yearSelect.value = '';
                    filterCards();
                });
            }
        });
    </script>
@endsection
