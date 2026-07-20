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
                        <input type="text" id="sbSearchInput" placeholder="Search scholarships..." class="form-control">
                    </div>
                </div>

                <div class="sb-filter-row">
                    <div class="sb-selects-group">
                        <select id="sbClassSelect" class="form-select sb-filter-select">
                            <option>Class</option>
                            <option>Class 9</option>
                            <option>Class 10</option>
                            <option>Class 11</option>
                            <option>Class 12</option>
                        </select>
                        <select id="sbGenderSelect" class="form-select sb-filter-select">
                            <option>Gender</option>
                            <option>Boys</option>
                            <option>Girls</option>
                            <option>Coed</option>
                        </select>
                        <select id="sbStateSelect" class="form-select sb-filter-select">
                            <option>State</option>
                            <option>Uttarakhand</option>
                            <option>Rajasthan</option>
                            <option>Punjab</option>
                        </select>
                        <select id="sbStatusSelect" class="form-select sb-filter-select">
                            <option>Status</option>
                            <option>Live</option>
                            <option>Upcoming</option>
                            <option>Closed</option>
                        </select>
                        <select id="sbYearSelect" class="form-select sb-filter-select">
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
                @forelse($benefits as $benefit)
                    @php
                        $classes = [];
                        $contentLower = strtolower($benefit->content);
                        $titleLower = strtolower($benefit->title);
                        
                        if (str_contains($contentLower, '9') || str_contains($contentLower, 'ninth')) $classes[] = '9';
                        if (str_contains($contentLower, '10') || str_contains($contentLower, 'tenth')) $classes[] = '10';
                        if (str_contains($contentLower, '11') || str_contains($contentLower, 'eleventh')) $classes[] = '11';
                        if (str_contains($contentLower, '12') || str_contains($contentLower, 'twelfth')) $classes[] = '12';
                        if (empty($classes)) {
                            $classes = ['9', '10', '11', '12'];
                        }
                        
                        $gender = 'coed';
                        if (str_contains($contentLower, 'girl') || str_contains($contentLower, 'woman') || str_contains($contentLower, 'female') || str_contains($titleLower, 'women')) {
                            $gender = 'girls';
                        } elseif (str_contains($contentLower, 'boy') || str_contains($contentLower, 'male')) {
                            $gender = 'boys';
                        }
                        
                        $state = 'all';
                        if (str_contains($contentLower, 'uttarakhand') || str_contains($titleLower, 'uttarakhand')) $state = 'uttarakhand';
                        elseif (str_contains($contentLower, 'rajasthan') || str_contains($titleLower, 'rajasthan')) $state = 'rajasthan';
                        elseif (str_contains($contentLower, 'punjab') || str_contains($titleLower, 'punjab')) $state = 'punjab';
                        
                        $status = 'live';
                        if (str_contains($contentLower, 'upcoming') || str_contains($titleLower, 'upcoming')) $status = 'upcoming';
                        elseif (str_contains($contentLower, 'closed') || str_contains($titleLower, 'closed')) $status = 'closed';
                        
                        $year = '2026';
                        if (str_contains($contentLower, '2027') || str_contains($titleLower, '2027')) $year = '2027';

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
                                
                                <img src="{{ $benefit->icon ? (str_starts_with($benefit->icon, 'http') ? $benefit->icon : rtrim(env('BACKEND_URL', 'http://127.0.0.1:8001'), '/') . '/' . ltrim($benefit->icon, '/')) : asset('assets/images/scholarship-card-img.png') }}" alt="{{ $benefit->title }}">
                            </div>
                            <div class="sb-card-body d-flex flex-column">
                                <h3 class="sb-card-title">{{ $benefit->title }}</h3>
                                <div class="sb-reward-badge mb-2">
                                    <i class="fa-regular fa-lightbulb text-warning me-1"></i> {{ $reward }}
                                </div>
                                <p class="sb-card-text flex-grow-1">{{ $benefit->content }}</p>
                                <a href="#" class="btn-sb-learnmore mt-auto">Learn more <i class="fa-solid fa-chevron-right" style="font-size: 8px;"></i></a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center py-5">
                        <p class="text-muted">No scholarships and benefits found.</p>
                    </div>
                @endforelse
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
            
            function filterCards() {
                const searchQuery = searchInput.value.toLowerCase().trim();
                const selectedClass = classSelect.value.replace('Class ', ''); // e.g. "9", "10", "11", "12" or "Class"
                const selectedGender = genderSelect.value.toLowerCase(); // "boys", "girls", "coed" or "gender"
                const selectedState = stateSelect.value.toLowerCase(); // "uttarakhand", "rajasthan", "punjab" or "state"
                const selectedStatus = statusSelect.value.toLowerCase(); // "live", "upcoming", "closed" or "status"
                const selectedYear = yearSelect.value; // "2026", "2027" or "scholarship year"

                cards.forEach(card => {
                    const cardTitle = card.querySelector('.sb-card-title').textContent.toLowerCase();
                    const cardText = card.querySelector('.sb-card-text').textContent.toLowerCase();
                    
                    const cardClasses = card.getAttribute('data-class').split(',');
                    const cardGender = card.getAttribute('data-gender');
                    const cardState = card.getAttribute('data-state');
                    const cardStatus = card.getAttribute('data-status');
                    const cardYear = card.getAttribute('data-year');
                    
                    // 1. Search Query
                    const matchesSearch = searchQuery === '' || cardTitle.includes(searchQuery) || cardText.includes(searchQuery);
                    
                    // 2. Class Filter
                    const matchesClass = selectedClass === 'class' || cardClasses.includes(selectedClass);
                    
                    // 3. Gender Filter
                    const matchesGender = selectedGender === 'gender' || cardGender === 'coed' || selectedGender === 'coed' || cardGender === selectedGender;
                    
                    // 4. State Filter
                    const matchesState = selectedState === 'state' || cardState === 'all' || cardState === selectedState;
                    
                    // 5. Status Filter
                    const matchesStatus = selectedStatus === 'status' || cardStatus === selectedStatus;
                    
                    // 6. Year Filter
                    const matchesYear = selectedYear === 'Scholarship Year' || cardYear === selectedYear;

                    if (matchesSearch && matchesClass && matchesGender && matchesState && matchesStatus && matchesYear) {
                        card.style.display = 'block';
                    } else {
                        card.style.display = 'none';
                    }
                });
            }

            // Bind triggers
            applyBtn.addEventListener('click', function(e) {
                e.preventDefault();
                filterCards();
            });

            searchInput.addEventListener('input', filterCards);

            resetBtn.addEventListener('click', function (e) {
                e.preventDefault();
                searchInput.value = '';
                classSelect.selectedIndex = 0;
                genderSelect.selectedIndex = 0;
                stateSelect.selectedIndex = 0;
                statusSelect.selectedIndex = 0;
                yearSelect.selectedIndex = 0;
                
                cards.forEach(card => card.style.display = 'block');
            });
        });
    </script>
@endsection
