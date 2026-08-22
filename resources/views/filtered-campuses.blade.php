@extends('layouts.app')
@section('content')
<main class="about-hero-section pt-3">
    <div class="bg-square">
        <img src="{{ asset('assets/images/banner-square-img.svg') }}" alt="" />
    </div>
    <div class="container">
        <div class="about-hero-container mb-4">
            @php
                $imageUrl = $filteredPage->image ? rtrim(env('BACKEND_URL', 'http://127.0.0.1:8001'), '/') . '/' . ltrim($filteredPage->image, '/') : asset('assets/images/school-banner-img.png');
            @endphp
            <img src="{{ $imageUrl }}" alt="{{ $filteredPage->title ?? ucfirst($filteredPage->category) . ' Listing' }}" style="width: 100%; max-height: 450px; object-fit: cover;" />

            <!-- Centered Badge -->
            <div class="about-us-badge-wrapper">
                <button class="about-us-badge" style="text-transform: uppercase;">{{ $filteredPage->title ?? (ucfirst($filteredPage->category) . ' Listing') }}</button>
                <p>{{ $filteredPage->sub_title ?? ('Explore ' . strtolower($filteredPage->category) . 's filtered by your criteria.') }}</p>
            </div>
        </div>
    </div>
</main>

<div style="background-color: #f9f9f9; padding: 20px 0 60px 0;">
    <div class="container">
        
        @php
            $hasBadges = $filteredPage->ownership_type || $filteredPage->curriculum || $filteredPage->university_type || $filteredPage->degree || $filteredPage->state || $filteredPage->city || $filteredPage->coaching_category_id;
        @endphp
        
        @if($hasBadges)
        <div class="mb-4 text-center">
            <div class="d-flex justify-content-center gap-2 flex-wrap mt-2">
                @if(isset($filteredPage->coaching_category_name)) <span class="badge" style="background: #1e3a8a; font-size: 14px; padding: 8px 15px;">Coaching: {{ $filteredPage->coaching_category_name }}</span> @endif
                @if($filteredPage->ownership_type) <span class="badge" style="background: #1e3a8a; font-size: 14px; padding: 8px 15px;">Ownership: {{ $filteredPage->ownership_type }}</span> @endif
                @if($filteredPage->curriculum) <span class="badge" style="background: #1e3a8a; font-size: 14px; padding: 8px 15px;">Curriculum: {{ $filteredPage->curriculum }}</span> @endif
                @if($filteredPage->university_type) <span class="badge" style="background: #1e3a8a; font-size: 14px; padding: 8px 15px;">Type: {{ $filteredPage->university_type }}</span> @endif
                @if($filteredPage->degree) <span class="badge" style="background: #1e3a8a; font-size: 14px; padding: 8px 15px;">Degree: {{ $filteredPage->degree }}</span> @endif
                @if($filteredPage->state) <span class="badge" style="background: #0ea5e9; font-size: 14px; padding: 8px 15px;">State: {{ $filteredPage->state }}</span> @endif
                @if($filteredPage->city) <span class="badge" style="background: #0ea5e9; font-size: 14px; padding: 8px 15px;">City: {{ $filteredPage->city }}</span> @endif
            </div>
        </div>
        @endif

        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
            @if($campuses->count() > 0)
                @foreach($campuses as $campus)
                    @php
                        $org = $campus->organisation;
                        $coverUrl = $org && $org->cover_image_url ? (str_starts_with($org->cover_image_url, 'http') ? $org->cover_image_url : rtrim(env('BACKEND_URL', 'http://127.0.0.1:8001'), '/') . '/' . ltrim($org->cover_image_url, '/')) : asset('assets/images/about_team_meeting.png');
                        $logoUrl = $org && $org->logo_url ? (str_starts_with($org->logo_url, 'http') ? $org->logo_url : rtrim(env('BACKEND_URL', 'http://127.0.0.1:8001'), '/') . '/' . ltrim($org->logo_url, '/')) : asset('assets/images/school-card-logo.png');
                    @endphp
                    <div class="col">
                        <div class="school-card" style="cursor: pointer;" onclick="window.location.href='{{ route('campus.detail', $campus->slug) }}'">
                            <div class="swiper school-image-swiper">
                                <div class="swiper-wrapper">
                                    <div class="swiper-slide">
                                        <img src="{{ $coverUrl }}" alt="{{ $campus->campus_name }} Cover" style="object-fit:fill;">
                                    </div>
                                </div>
                                @if($org && ($org->minority_type || $org->brand_type))
                                <span class="school-gender-badge">{{ $org->minority_type ?? $org->brand_type }}</span>
                                @endif
                            </div>
                            <div class="school-info-body">
                                <div class="school-identity-row">
                                    <div class="school-logo-box" style="width: 48px; height: 48px; flex-shrink: 0;">
                                        <img src="{{ $logoUrl }}" alt="{{ $campus->campus_name }} Logo" style="object-fit: contain;">
                                    </div>
                                    <div class="school-identity-text">
                                        <h3 class="school-name text-dark text-decoration-none">{{ $campus->campus_name }}</h3>
                                        <span class="school-location"><i class="fa-solid fa-location-dot me-1 text-muted"></i> {{ $campus->city ?? ($org->head_office_location ?? 'India') }}</span>
                                    </div>
                                </div>
                                <p class="school-card-desc mt-3">{{ Str::limit($campus->full_address ?? strip_tags($org->about_organisation ?? ''), 100, '...') }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="col-12 text-center py-5">
                    <div class="p-5 bg-white rounded-4 shadow-sm">
                        <i class="fas fa-search fa-4x text-muted mb-3 opacity-25"></i>
                        <h4 class="text-dark fw-bold">No campuses found</h4>
                        <p class="text-muted">Try adjusting your filter criteria from the backend.</p>
                    </div>
                </div>
            @endif
        </div>
        
        @if($campuses->hasPages())
        <div class="d-flex justify-content-center mt-5">
            {{ $campuses->links('pagination::bootstrap-5') }}
        </div>
        @endif
        
    </div>
</div>
@endsection
