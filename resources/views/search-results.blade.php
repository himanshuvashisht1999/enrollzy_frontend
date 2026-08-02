@extends('layouts.app')

@section('content')

<style>
    .search-results-page {
        background: #f8f9fc;
        min-height: 70vh;
        padding-bottom: 60px;
    }

    /* Hero Banner */
    .sr-hero {
        background: linear-gradient(135deg, #1a2744 0%, #2d4fa1 60%, #1a2744 100%);
        padding: 48px 0 40px;
        position: relative;
        overflow: hidden;
    }
    .sr-hero::before {
        content: '';
        position: absolute;
        inset: 0;
        background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.03'%3E%3Ccircle cx='30' cy='30' r='20'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
    }
    .sr-hero-inner { position: relative; z-index: 1; }
    .sr-badge {
        display: inline-block;
        background: rgba(249,173,11,0.18);
        border: 1px solid rgba(249,173,11,0.5);
        color: #f9ad0b;
        font-size: 12px;
        font-weight: 700;
        letter-spacing: 1.5px;
        text-transform: uppercase;
        padding: 5px 16px;
        border-radius: 50px;
        margin-bottom: 14px;
    }
    .sr-title {
        color: #fff;
        font-size: 28px;
        font-weight: 700;
        margin-bottom: 6px;
    }
    .sr-title span { color: #f9ad0b; }
    .sr-subtitle {
        color: rgba(255,255,255,0.65);
        font-size: 14px;
    }
    .sr-total-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: rgba(255,255,255,0.1);
        border: 1px solid rgba(255,255,255,0.18);
        color: #fff;
        border-radius: 50px;
        padding: 5px 16px;
        font-size: 13px;
        font-weight: 600;
        margin-top: 10px;
    }

    /* Filter Tabs */
    .sr-tabs {
        background: #fff;
        border-bottom: 2px solid #e8ecf4;
        position: sticky;
        top: 0;
        z-index: 100;
        box-shadow: 0 2px 8px rgba(0,0,0,0.05);
    }
    .sr-tabs .nav-tabs {
        border: none;
        gap: 4px;
        padding: 0 15px;
        flex-wrap: nowrap;
        overflow-x: auto;
    }
    .sr-tabs .nav-tabs::-webkit-scrollbar { display: none; }
    .sr-tabs .nav-link {
        border: none;
        color: #666;
        font-size: 13.5px;
        font-weight: 600;
        padding: 14px 20px;
        border-bottom: 3px solid transparent;
        border-radius: 0;
        white-space: nowrap;
        transition: all 0.2s;
    }
    .sr-tabs .nav-link:hover { color: #2d4fa1; }
    .sr-tabs .nav-link.active {
        color: #2d4fa1;
        border-bottom-color: #2d4fa1;
        background: transparent;
    }
    .sr-tabs .nav-link .badge {
        font-size: 10px;
        padding: 2px 7px;
        border-radius: 20px;
        margin-left: 5px;
        background: #e8ecf4;
        color: #2d4fa1;
    }
    .sr-tabs .nav-link.active .badge {
        background: #2d4fa1;
        color: #fff;
    }

    /* Section heading */
    .sr-section-title {
        font-size: 16px;
        font-weight: 700;
        color: #1a2744;
        padding-bottom: 10px;
        border-bottom: 2px solid #e8ecf4;
        margin-bottom: 18px;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .sr-section-title .icon-dot {
        width: 10px; height: 10px;
        border-radius: 50%;
        display: inline-block;
    }
    .sr-view-all {
        font-size: 13px;
        color: #2d4fa1;
        font-weight: 600;
        text-decoration: none;
        margin-left: auto;
    }
    .sr-view-all:hover { text-decoration: underline; }

    /* Result Cards */
    .sr-card {
        background: #fff;
        border-radius: 14px;
        border: 1.5px solid #e8ecf4;
        padding: 16px 18px;
        display: flex;
        align-items: center;
        gap: 14px;
        transition: all 0.22s;
        text-decoration: none;
        color: inherit;
    }
    .sr-card:hover {
        border-color: #2d4fa1;
        box-shadow: 0 4px 18px rgba(45,79,161,0.12);
        transform: translateY(-2px);
        color: inherit;
        text-decoration: none;
    }
    .sr-card-icon {
        width: 48px; height: 48px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
        flex-shrink: 0;
    }
    .icon-college { background: #e8eefa; color: #2d4fa1; }
    .icon-school  { background: #fff7e6; color: #f9ad0b; }
    .icon-coaching{ background: #e8f5ee; color: #10b981; }
    .icon-mentor  { background: #fce8f3; color: #e83e8c; }

    .sr-card-body { flex: 1; min-width: 0; }
    .sr-card-name {
        font-size: 14px;
        font-weight: 700;
        color: #1a2744;
        margin-bottom: 3px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    .sr-card-sub {
        font-size: 12px;
        color: #888;
    }
    .sr-card-tag {
        font-size: 11px;
        font-weight: 700;
        padding: 3px 10px;
        border-radius: 20px;
        flex-shrink: 0;
    }
    .tag-college  { background: #e8eefa; color: #2d4fa1; }
    .tag-school   { background: #fff7e6; color: #e8960a; }
    .tag-coaching { background: #e8f5ee; color: #10b981; }
    .tag-mentor   { background: #fce8f3; color: #e83e8c; }

    /* Empty state */
    .sr-empty {
        text-align: center;
        padding: 60px 20px;
        color: #aaa;
    }
    .sr-empty i { font-size: 48px; margin-bottom: 16px; display: block; }
    .sr-empty h4 { font-size: 18px; color: #555; margin-bottom: 8px; }
    .sr-empty p { font-size: 14px; }
    .sr-empty a { color: #2d4fa1; font-weight: 600; }
</style>

<div class="search-results-page">

    {{-- Hero --}}
    <div class="sr-hero">
        <div class="container sr-hero-inner">
            <div class="sr-badge"><i class="fa-solid fa-magnifying-glass me-1"></i> Search Results</div>
            <h1 class="sr-title">Results for <span>"{{ $q }}"</span></h1>
            <p class="sr-subtitle">Showing results across colleges, coaching, schools & mentors</p>
            <span class="sr-total-badge">
                <i class="fa-solid fa-layer-group"></i>
                {{ $totalResults }} result{{ $totalResults != 1 ? 's' : '' }} found
            </span>
        </div>
    </div>

    {{-- Breadcrumb --}}
    <div class="py-2" style="background:#fff;border-bottom:1px solid #e8ecf4;">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0" style="font-size:13px;">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-decoration-none text-muted"><i class="fa-solid fa-house me-1"></i>Home</a></li>
                    <li class="breadcrumb-item active text-primary">Search: {{ $q }}</li>
                </ol>
            </nav>
        </div>
    </div>

    {{-- Tabs --}}
    <div class="sr-tabs">
        <div class="container">
            <ul class="nav nav-tabs" id="srTabs">
                <li class="nav-item">
                    <a class="nav-link active" href="#sr-all" data-bs-toggle="tab">
                        All <span class="badge">{{ $totalResults }}</span>
                    </a>
                </li>
                @if($colleges->count())
                <li class="nav-item">
                    <a class="nav-link" href="#sr-colleges" data-bs-toggle="tab">
                        Colleges <span class="badge">{{ $colleges->count() }}</span>
                    </a>
                </li>
                @endif
                @if($coachings->count())
                <li class="nav-item">
                    <a class="nav-link" href="#sr-coaching" data-bs-toggle="tab">
                        Coaching <span class="badge">{{ $coachings->count() }}</span>
                    </a>
                </li>
                @endif
                @if($schools->count())
                <li class="nav-item">
                    <a class="nav-link" href="#sr-schools" data-bs-toggle="tab">
                        Schools <span class="badge">{{ $schools->count() }}</span>
                    </a>
                </li>
                @endif
                @if($mentors->count())
                <li class="nav-item">
                    <a class="nav-link" href="#sr-mentors" data-bs-toggle="tab">
                        Mentors <span class="badge">{{ $mentors->count() }}</span>
                    </a>
                </li>
                @endif
            </ul>
        </div>
    </div>

    {{-- Content --}}
    <div class="container py-4">
        <div class="tab-content">

            {{-- ALL TAB --}}
            <div class="tab-pane fade show active" id="sr-all">
                @if($totalResults === 0)
                    <div class="sr-empty">
                        <i class="fa-solid fa-search-minus"></i>
                        <h4>No results found for "{{ $q }}"</h4>
                        <p>Try different keywords or <a href="{{ route('home') }}">go back to homepage</a></p>
                    </div>
                @else

                    {{-- Colleges --}}
                    @if($colleges->count())
                    <div class="mb-4">
                        <div class="sr-section-title">
                            <span class="icon-dot" style="background:#2d4fa1;"></span>
                            Colleges / Universities
                            <a href="{{ route('university', ['search' => $q]) }}" class="sr-view-all">View all <i class="fa-solid fa-arrow-right ms-1" style="font-size:11px;"></i></a>
                        </div>
                        <div class="row g-3">
                            @foreach($colleges as $org)
                            @php
                                $cities = is_string($org->cities_present_in) ? json_decode($org->cities_present_in, true) : ($org->cities_present_in ?? []);
                                $states = is_string($org->states_present_in) ? json_decode($org->states_present_in, true) : ($org->states_present_in ?? []);
                                $loc = collect([$cities[0] ?? null, $states[0] ?? null])->filter()->implode(', ');
                            @endphp
                            <div class="col-md-6 col-12">
                                <a href="{{ route('university.detail', $org->slug ?? $org->id) }}" class="sr-card">
                                    <div class="sr-card-icon icon-college"><i class="fa-solid fa-university"></i></div>
                                    <div class="sr-card-body">
                                        <div class="sr-card-name">{{ $org->name }}</div>
                                        <div class="sr-card-sub">{{ $loc ?: 'University' }}</div>
                                    </div>
                                    <span class="sr-card-tag tag-college">College</span>
                                </a>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    {{-- Coaching --}}
                    @if($coachings->count())
                    <div class="mb-4">
                        <div class="sr-section-title">
                            <span class="icon-dot" style="background:#10b981;"></span>
                            Coaching Institutes
                            <a href="{{ route('all.coaching', ['search' => $q]) }}" class="sr-view-all">View all <i class="fa-solid fa-arrow-right ms-1" style="font-size:11px;"></i></a>
                        </div>
                        <div class="row g-3">
                            @foreach($coachings as $org)
                            @php
                                $cities2 = is_string($org->cities_present_in) ? json_decode($org->cities_present_in, true) : ($org->cities_present_in ?? []);
                                $loc2 = !empty($cities2[0]) ? $cities2[0] : 'Coaching';
                            @endphp
                            <div class="col-md-6 col-12">
                                <a href="{{ route('coaching.detail', $org->slug ?? $org->id) }}" class="sr-card">
                                    <div class="sr-card-icon icon-coaching"><i class="fa-solid fa-chalkboard-teacher"></i></div>
                                    <div class="sr-card-body">
                                        <div class="sr-card-name">{{ $org->name }}</div>
                                        <div class="sr-card-sub">{{ $loc2 }}</div>
                                    </div>
                                    <span class="sr-card-tag tag-coaching">Coaching</span>
                                </a>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    {{-- Schools --}}
                    @if($schools->count())
                    <div class="mb-4">
                        <div class="sr-section-title">
                            <span class="icon-dot" style="background:#f9ad0b;"></span>
                            Schools
                            <a href="{{ route('all-schools', ['search' => $q]) }}" class="sr-view-all">View all <i class="fa-solid fa-arrow-right ms-1" style="font-size:11px;"></i></a>
                        </div>
                        <div class="row g-3">
                            @foreach($schools as $org)
                            @php
                                $scCities = is_string($org->cities_present_in) ? json_decode($org->cities_present_in, true) : ($org->cities_present_in ?? []);
                                $scStates = is_string($org->states_present_in) ? json_decode($org->states_present_in, true) : ($org->states_present_in ?? []);
                                $scLoc = collect([$scCities[0] ?? null, $scStates[0] ?? null])->filter()->implode(', ');
                            @endphp
                            <div class="col-md-6 col-12">
                                <a href="{{ route('school.detail', $org->slug ?? $org->id) }}" class="sr-card">
                                    <div class="sr-card-icon icon-school"><i class="fa-solid fa-school"></i></div>
                                    <div class="sr-card-body">
                                        <div class="sr-card-name">{{ $org->name }}</div>
                                        <div class="sr-card-sub">{{ $scLoc ?: 'Boarding School' }}</div>
                                    </div>
                                    <span class="sr-card-tag tag-school">School</span>
                                </a>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    {{-- Mentors --}}
                    @if($mentors->count())
                    <div class="mb-4">
                        <div class="sr-section-title">
                            <span class="icon-dot" style="background:#e83e8c;"></span>
                            Mentors
                            <a href="{{ route('mentors', ['search' => $q]) }}" class="sr-view-all">View all <i class="fa-solid fa-arrow-right ms-1" style="font-size:11px;"></i></a>
                        </div>
                        <div class="row g-3">
                            @foreach($mentors as $mentor)
                            @php
                                $mName = trim(($mentor->first_name ?? '') . ' ' . ($mentor->last_name ?? ''));
                                if (empty($mName)) $mName = $mentor->user->name ?? 'Expert Mentor';
                            @endphp
                            <div class="col-md-6 col-12">
                                <a href="{{ route('mentor.detail', $mentor->id) }}" class="sr-card">
                                    <div class="sr-card-icon icon-mentor"><i class="fa-solid fa-user-tie"></i></div>
                                    <div class="sr-card-body">
                                        <div class="sr-card-name">{{ $mName }}</div>
                                        <div class="sr-card-sub">{{ $mentor->professional_headline ?? 'Expert Mentor' }}</div>
                                    </div>
                                    <span class="sr-card-tag tag-mentor">Mentor</span>
                                </a>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif

                @endif
            </div>

            {{-- COLLEGES TAB --}}
            <div class="tab-pane fade" id="sr-colleges">
                <div class="mb-4 pt-2">
                    <div class="row g-3">
                        @foreach($colleges as $org)
                        @php
                            $cities = is_string($org->cities_present_in) ? json_decode($org->cities_present_in, true) : ($org->cities_present_in ?? []);
                            $states = is_string($org->states_present_in) ? json_decode($org->states_present_in, true) : ($org->states_present_in ?? []);
                            $loc = collect([$cities[0] ?? null, $states[0] ?? null])->filter()->implode(', ');
                        @endphp
                        <div class="col-md-6 col-12">
                            <a href="{{ route('university.detail', $org->slug ?? $org->id) }}" class="sr-card">
                                <div class="sr-card-icon icon-college"><i class="fa-solid fa-university"></i></div>
                                <div class="sr-card-body">
                                    <div class="sr-card-name">{{ $org->name }}</div>
                                    <div class="sr-card-sub">{{ $loc ?: 'University' }}</div>
                                </div>
                                <span class="sr-card-tag tag-college">College</span>
                            </a>
                        </div>
                        @endforeach
                    </div>
                    <div class="mt-3 text-center">
                        <a href="{{ route('university', ['search' => $q]) }}" class="btn btn-outline-primary btn-sm px-4">View All Colleges</a>
                    </div>
                </div>
            </div>

            {{-- COACHING TAB --}}
            <div class="tab-pane fade" id="sr-coaching">
                <div class="mb-4 pt-2">
                    <div class="row g-3">
                        @foreach($coachings as $org)
                        @php
                            $cities2 = is_string($org->cities_present_in) ? json_decode($org->cities_present_in, true) : ($org->cities_present_in ?? []);
                            $loc2 = !empty($cities2[0]) ? $cities2[0] : 'Coaching';
                        @endphp
                        <div class="col-md-6 col-12">
                            <a href="{{ route('coaching.detail', $org->slug ?? $org->id) }}" class="sr-card">
                                <div class="sr-card-icon icon-coaching"><i class="fa-solid fa-chalkboard-teacher"></i></div>
                                <div class="sr-card-body">
                                    <div class="sr-card-name">{{ $org->name }}</div>
                                    <div class="sr-card-sub">{{ $loc2 }}</div>
                                </div>
                                <span class="sr-card-tag tag-coaching">Coaching</span>
                            </a>
                        </div>
                        @endforeach
                    </div>
                    <div class="mt-3 text-center">
                        <a href="{{ route('all.coaching', ['search' => $q]) }}" class="btn btn-outline-success btn-sm px-4">View All Coaching</a>
                    </div>
                </div>
            </div>

            {{-- SCHOOLS TAB --}}
            <div class="tab-pane fade" id="sr-schools">
                <div class="mb-4 pt-2">
                    <div class="row g-3">
                        @foreach($schools as $org)
                        @php
                            $scCities = is_string($org->cities_present_in) ? json_decode($org->cities_present_in, true) : ($org->cities_present_in ?? []);
                            $scStates = is_string($org->states_present_in) ? json_decode($org->states_present_in, true) : ($org->states_present_in ?? []);
                            $scLoc = collect([$scCities[0] ?? null, $scStates[0] ?? null])->filter()->implode(', ');
                        @endphp
                        <div class="col-md-6 col-12">
                            <a href="{{ route('school.detail', $org->slug ?? $org->id) }}" class="sr-card">
                                <div class="sr-card-icon icon-school"><i class="fa-solid fa-school"></i></div>
                                <div class="sr-card-body">
                                    <div class="sr-card-name">{{ $org->name }}</div>
                                    <div class="sr-card-sub">{{ $scLoc ?: 'Boarding School' }}</div>
                                </div>
                                <span class="sr-card-tag tag-school">School</span>
                            </a>
                        </div>
                        @endforeach
                    </div>
                    <div class="mt-3 text-center">
                        <a href="{{ route('all-schools', ['search' => $q]) }}" class="btn btn-outline-warning btn-sm px-4">View All Schools</a>
                    </div>
                </div>
            </div>

            {{-- MENTORS TAB --}}
            <div class="tab-pane fade" id="sr-mentors">
                <div class="mb-4 pt-2">
                    <div class="row g-3">
                        @foreach($mentors as $mentor)
                        @php
                            $mName = trim(($mentor->first_name ?? '') . ' ' . ($mentor->last_name ?? ''));
                            if (empty($mName)) $mName = $mentor->user->name ?? 'Expert Mentor';
                        @endphp
                        <div class="col-md-6 col-12">
                            <a href="{{ route('mentor.detail', $mentor->id) }}" class="sr-card">
                                <div class="sr-card-icon icon-mentor"><i class="fa-solid fa-user-tie"></i></div>
                                <div class="sr-card-body">
                                    <div class="sr-card-name">{{ $mName }}</div>
                                    <div class="sr-card-sub">{{ $mentor->professional_headline ?? 'Expert Mentor' }}</div>
                                </div>
                                <span class="sr-card-tag tag-mentor">Mentor</span>
                            </a>
                        </div>
                        @endforeach
                    </div>
                    <div class="mt-3 text-center">
                        <a href="{{ route('mentors', ['search' => $q]) }}" class="btn btn-outline-danger btn-sm px-4" style="border-color:#e83e8c;color:#e83e8c;">View All Mentors</a>
                    </div>
                </div>
            </div>

        </div>
    </div>

</div>

@endsection
