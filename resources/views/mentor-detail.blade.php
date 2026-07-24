@extends('layouts.app')

@section('content')


    <div class="mentor-detail-page">

        <!-- 1. Profile Header Banner -->
        <main class="about-hero-section ptb-70 pb-0">
            <div class="bg-square">
                <img src="assets/images/banner-square-img.svg" alt="" />
            </div>
            <div class="profile-hero-banner">
                <div class="bg-square">
                    <img src="{{ asset('assets/images/banner-square-img.svg') }}" alt="Grid Background">
                </div>
                <div class="container">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show rounded-4 shadow-sm border-0 mb-4" role="alert">
                            <i class="fa-solid fa-circle-check me-2"></i> {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <!-- Grey Card Banner -->
                    <div class="profile-banner-card">
                        <div class="profile-banner-watermark">enrollzy</div>
                        <a href="{{ route('mentors') }}" class="btn-back-mentors">
                            <i class="fa-solid fa-chevron-left"></i> Back to mentors
                        </a>
                        <span class="verified-mentor-badge">Verified mentor</span>
                    </div>

                    <!-- Profile Info Card (Overlapping) -->
                    <div class="profile-details-card">
                        <div class="profile-main-card">
                            <div class="row align-items-center">
                                @php
                                    $mName = trim(($mentor->first_name ?? '') . ' ' . ($mentor->last_name ?? ''));
                                    if (empty($mName)) {
                                        $mName = $mentor->user->name ?? 'Abhishek Sharma';
                                    }

                                    $mPhoto = asset('assets/images/mentor_1.png');
                                    if (!empty($mentor->profile_photo)) {
                                        if (str_starts_with($mentor->profile_photo, 'http')) {
                                            $mPhoto = $mentor->profile_photo;
                                        } elseif (file_exists(public_path('storage/' . $mentor->profile_photo))) {
                                            $mPhoto = asset('storage/' . $mentor->profile_photo);
                                        } elseif (file_exists(base_path('../enrollzy_backend/public/storage/' . $mentor->profile_photo))) {
                                            $mPhoto = 'http://127.0.0.1:8001/storage/' . $mentor->profile_photo;
                                        } elseif (file_exists(public_path('assets/images/' . $mentor->profile_photo))) {
                                            $mPhoto = asset('assets/images/' . $mentor->profile_photo);
                                        }
                                    }
                                @endphp
                                <div class="col-lg-2 col-md-3 col-12 d-flex justify-content-center">
                                    <div class="profile-avatar-wrapper">
                                        <img src="{{ $mPhoto }}" alt="{{ $mName }}" onError="this.src='{{ asset('assets/images/mentor_1.png') }}'">
                                    </div>
                                </div>
                                <div class="col-lg-7 col-md-6 col-12 text-center text-md-start ps-lg-4">
                                    <h1 class="profile-info-name">{{ $mName }}</h1>
                                    <p class="profile-info-role">{{ $mentor->professional_headline ?? 'Product Manager • Google • IIM-A' }}</p>
                                    <div class="mb-3">
                                        <span class="profile-info-badge tag-blue">MBA Prep</span>
                                        <span class="profile-info-badge tag-yellow">Product</span>
                                        <span class="profile-info-badge tag-green">Startups</span>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-3 col-12 text-center text-md-end">
                                    <div class="profile-rating-info">
                                        <div class="profile-sessions-count">280 sessions</div>
                                        <div class="profile-rating-stars mt-1">
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <span class="profile-rating-num">4.9</span>
                                        </div>
                                        <div class="mt-3">
                                            <a href="#" class="profile-connect-btn">
                                                Connect Now <i class="fa-solid fa-arrow-right-long"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- About Me section inside details card -->
                        <div class="profile-about-box">
                            <h2 class="profile-about-title">About {{ $mName }}</h2>
                            <p class="profile-about-text">
                                {{ $mentor->short_bio ?? 'Guiding students for MBA admissions, JEE Advanced strategy, and tech career roadmaps with 8+ years of industry experience.' }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </main>


        <!-- 2. Grid Cards Layout -->
        <section class="py-5">
            <div class="container">
                <div class="row g-4">
                    <!-- Row 1 Left: Areas of expertise -->
                    <div class="col-lg-6 col-12">
                        <div class="grid-info-card">
                            <h2 class="grid-info-card-title">Areas of expertise</h2>
                            <div class="expertise-pills-row">
                                <div class="expertise-pill-card">Campus life</div>
                                <div class="expertise-pill-card">Campus life</div>
                                <div class="expertise-pill-card">Campus life</div>
                                <div class="expertise-pill-card">Campus life</div>
                                <div class="expertise-pill-card">Campus life</div>
                                <div class="expertise-pill-card">Campus life</div>
                                <div class="expertise-pill-card">Campus life</div>
                                <div class="expertise-pill-card">Campus life</div>
                            </div>
                        </div>
                    </div>

                    <!-- Row 1 Right: Ready to connect (Blue CTA) -->
                    <div class="col-lg-6 col-12">
                        <div class="ready-connect-card">
                            <div>
                                <h2 class="ready-connect-title">Ready to connect?</h2>
                                <p class="ready-connect-desc">
                                    Book a session with Abhishek sharma and get your questions answered.
                                </p>
                            </div>
                            <a href="#" class="btn-ready-connect">
                                Connect Now <i class="fa-solid fa-arrow-right-long"></i>
                            </a>
                        </div>
                    </div>

                    <!-- Row 2 Left: Education -->
                    <div class="col-lg-6 col-12">
                        <div class="grid-info-card">
                            <h2 class="grid-info-card-title">Education</h2>
                            <div class="education-list">
                                <div class="education-capsule">
                                    <span class="education-grade-badge">10th</span>
                                    <span class="education-school-name">Govt senior secondary school sector 33 - d
                                        chandigarh</span>
                                </div>
                                <div class="education-capsule">
                                    <span class="education-grade-badge">12th</span>
                                    <span class="education-school-name">Netaji subhash chandra bose school hamirpur himchal
                                        pradesh</span>
                                </div>
                                <div class="education-capsule">
                                    <span class="education-grade-badge">Btech</span>
                                    <span class="education-school-name">shaheed kansi ram college of technology hamipur
                                        himachal pradesh</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Row 2 Right: Skills -->
                    <div class="col-lg-6 col-12">
                        <div class="grid-info-card">
                            <h2 class="grid-info-card-title">Skills</h2>
                            <div class="skills-row-box mb-3">
                                <span class="skills-outline-badge">Human Resource</span>
                                <span class="skills-outline-badge">Marketing</span>
                                <span class="skills-outline-badge">Social work</span>
                                <span class="skills-outline-badge">writing skills</span>
                            </div>
                            <div class="skills-row-box">
                                <span class="skills-outline-badge">Human Resource</span>
                                <span class="skills-outline-badge">Marketing</span>
                                <span class="skills-outline-badge">Social work</span>
                                <span class="skills-outline-badge">writing skills</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- 3. Achievements Section -->
        <section class="achievements-section">
            <div class="container">
                <div class="text-center heading-achievements">
                    <div class="heading-with-lines d-flex align-items-center justify-content-center gap-3">
                        <span class="heading-line-orange d-none d-md-block"></span>
                        <h2>Achievements</h2>
                        <span class="heading-line-orange d-none d-md-block"></span>
                    </div>
                </div>

                <div class="achievements-flow">
                    <!-- Item 1 -->
                    <div class="achievement-item">
                        <div class="achievement-icon-circle" >
                           <img src="{{ asset('assets/images/achievement-icon-1.png') }}" alt="">
                        </div>
                        <div class="achievement-stat">10003+</div>
                        <div class="achievement-label">Total Counselling</div>
                    </div>

                    <!-- Arrow -->
                    <i class="fa-solid fa-arrow-right-long achievement-flow-arrow d-none d-lg-block"></i>

                    <!-- Item 2 -->
                    <div class="achievement-item">
                        <div class="achievement-icon-circle">
                            <img src="{{ asset('assets/images/achievement-icon-2.png') }}" alt="">
                        </div>
                        <div class="achievement-stat">217hr</div>
                        <div class="achievement-label">Total Hours</div>
                    </div>

                    <!-- Arrow -->
                    <i class="fa-solid fa-arrow-right-long achievement-flow-arrow d-none d-lg-block"></i>

                    <!-- Item 3 -->
                    <div class="achievement-item">
                        <div class="achievement-icon-circle">
                           <img src="{{ asset('assets/images/achievement-icon-3.png') }}" alt="">
                        </div>
                        <div class="achievement-stat">42+</div>
                        <div class="achievement-label">Successful Sessions</div>
                    </div>

                    <!-- Arrow -->
                    <i class="fa-solid fa-arrow-right-long achievement-flow-arrow d-none d-lg-block"></i>

                    <!-- Item 4 -->
                    <div class="achievement-item">
                        <div class="achievement-icon-circle" >
                        <img src="{{ asset('assets/images/achievement-icon-4.png') }}" alt="">
                        </div>
                        <div class="achievement-stat">98%</div>
                        <div class="achievement-label">Satisfaction Score</div>
                    </div>
                </div>
            </div>
        </section>
        <section class="testimonials-section ptb-70" style="background-color: #FFFCF8;">
            <div class="container">
                <!-- Section Header -->
                <div class="text-center mb-5">
                    <div class="heading-with-lines d-flex align-items-center justify-content-center gap-3 mb-3">
                        <span class="heading-line d-none d-md-block"></span>
                        <h2 class="section-title mb-0">Video Testimonials</h2>
                        <span class="heading-line d-none d-md-block"></span>
                    </div>
                    <p class="section-subtitle mx-auto text-muted" style="max-width: 900px;">
                        What our students and parents have to say about their experience with us.
                    </p>
                </div>

                <!-- Video Cards Grid -->
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-2 row-cols-lg-4 g-4 mb-5">
                    @if(isset($video_testimonials) && $video_testimonials->count() > 0)
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
                    @else
                        <p class="text-center text-muted">No testimonials found.</p>
                    @endif
                </div>

                <!-- View More Button -->
                <div class="text-center">
                    <a href="{{ route('blogs') }}"
                        class="btn btn-enrollzy btn-enrollzy-lg text-decoration-none text-white">View
                        More <i class="fa-solid fa-arrow-right-long"></i></a>
                </div>
            </div>
        </section>

        <!-- 4. Review Our Mentors Section -->
        <section class="review-form-section">
            <div class="container">
                <div class="text-center mb-5">
                    <div class="heading-with-lines d-flex align-items-center justify-content-center gap-3">
                        <span class="heading-line-orange d-none d-md-block"></span>
                        <h2>Review our mentors</h2>
                        <span class="heading-line-orange d-none d-md-block"></span>
                    </div>
                </div>

                <div class="row align-items-center">
                    <!-- Left: Review Form -->
                    <div class="col-lg-6 col-12">
                        <div class="review-box-card">
                            <!-- Checklist/Notepad Icon -->
                            <div class="mx-auto review-box-icon d-flex align-items-center justify-content-center"
                                >
                                <img src="{{ asset('assets/images/mentor-review-icon.png') }}" alt="">
                            </div>

                            <h3 class="review-box-title">Review Your Mentor</h3>
                            <p class="review-box-desc">we value your feedback. Please share your honest review.</p>

                            <!-- Overall Rating Stars -->
                            <div class="text-start mb-3" style="font-size: 13.5px; font-weight: 700; color: #0D1B2A;">
                                Overall Rating</div>
                            <div class="rating-stars-interactive" id="stars-container">
                                <i class="fa-regular fa-star" data-index="1"></i>
                                <i class="fa-regular fa-star" data-index="2"></i>
                                <i class="fa-regular fa-star" data-index="3"></i>
                                <i class="fa-regular fa-star" data-index="4"></i>
                                <i class="fa-regular fa-star" data-index="5"></i>
                                <span class="ms-2" style="font-size: 12.5px; color: #888888; font-weight: 500;"
                                    id="rating-label">Tap to rate</span>
                            </div>

                            <!-- Feedback Form -->
                            <form action="{{ route('mentor.review.submit') }}" method="POST">
                                @csrf
                                <input type="hidden" name="mentor_id" value="{{ optional($mentor)->id }}">
                                <div class="text-start mb-2" style="font-size: 13.5px; font-weight: 700; color: #0D1B2A;">
                                    Your Feedback</div>
                                <textarea name="feedback" class="review-textarea"
                                    placeholder="Write your feedback about the mentor..." required></textarea>
                                <input type="hidden" name="rating" id="rating-input" value="5">

                                <button type="submit" class="btn-submit-review">
                                    Submit Review <i class="fa-solid fa-chevron-right"></i>
                                </button>
                            </form>
                        </div>
                    </div>

                    <!-- Right: Collage & Notice -->
                    <div class="col-lg-6 col-12 ps-lg-5 position-relative">
                        <div class="review-info-notice">
                            <img src="{{ asset('assets/images/review-anti-icon.png') }}" alt="">
                            <span>Your feedback is important and helps us maintain high quality mentorship.</span>
                        </div>

                        <div class="review-collage-wrapper">
                           
                            <img src="{{ asset('assets/images/review-mentor-img.png') }}" class="review-img-small"
                                alt="Mentor at work">
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </div>

    <!-- Interactive Stars script logic -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const stars = document.querySelectorAll('#stars-container i');
            const ratingInput = document.getElementById('rating-input');
            const ratingLabel = document.getElementById('rating-label');

            stars.forEach(star => {
                star.addEventListener('click', function () {
                    const index = parseInt(this.getAttribute('data-index'));
                    ratingInput.value = index;
                    ratingLabel.textContent = index + "/5 rating selected";

                    // Toggle classes
                    stars.forEach((s, idx) => {
                        if (idx < index) {
                            s.classList.remove('fa-regular');
                            s.classList.add('fa-solid', 'active');
                        } else {
                            s.classList.remove('fa-solid', 'active');
                            s.classList.add('fa-regular');
                        }
                    });
                });

                star.addEventListener('mouseenter', function () {
                    const index = parseInt(this.getAttribute('data-index'));
                    stars.forEach((s, idx) => {
                        if (idx < index) {
                            s.style.color = '#FEA008';
                        }
                    });
                });

                star.addEventListener('mouseleave', function () {
                    stars.forEach(s => {
                        s.style.color = '';
                    });
                });
            });
        });
    </script>
@endsection