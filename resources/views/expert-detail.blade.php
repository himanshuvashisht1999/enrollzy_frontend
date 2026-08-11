@extends('layouts.app')

@section('content')

    <div class="mentor-detail-page">

        @php
            $mName = $expert->name ?? 'Dr. Pawan Sharma';

            $mPhoto = asset('assets/images/mentor_1.png');
            $backendUrl = rtrim(env('BACKEND_URL', 'http://127.0.0.1:8001'), '/');
            if (!empty($expert->img)) {
                $mPhoto = str_starts_with($expert->img, 'http') ? $expert->img : (file_exists(public_path($expert->img)) ? asset($expert->img) : $backendUrl . '/' . ltrim($expert->img, '/'));
            } elseif (!empty($expert->profile_photo_url)) {
                $mPhoto = str_starts_with($expert->profile_photo_url, 'http') ? $expert->profile_photo_url : (file_exists(public_path($expert->profile_photo_url)) ? asset($expert->profile_photo_url) : $backendUrl . '/' . ltrim($expert->profile_photo_url, '/'));
            } elseif (!empty($expert->profile_photo)) {
                $mPhoto = str_starts_with($expert->profile_photo, 'http') ? $expert->profile_photo : (file_exists(public_path('storage/' . $expert->profile_photo)) ? asset('storage/' . $expert->profile_photo) : $backendUrl . '/storage/' . ltrim($expert->profile_photo, '/'));
            }

            $mRole = $expert->designation ?? $expert->role ?? $expert->primary_domain ?? 'Senior Counselor & Mentor';
            $mRating = $expert->rating ?? '4.9';
            $mCount = $expert->count ?? ($expert->no_of_students_counseled ? ($expert->no_of_students_counseled . '+ Counseled') : '280+ Sessions');
            $mPrice = $expert->price_per_min ?? 10.00;

            $mShortBio = $expert->short_bio ?? '';
            $mDetailedBio = $expert->detailed_bio ?? '';
            $mBio = !empty($mDetailedBio) ? $mDetailedBio : (!empty($mShortBio) ? $mShortBio : 'Guiding students for university admissions, JEE/NEET strategy, and career roadmaps with verified industry experience.');

            // Expertise Pills
            $expertiseList = [];
            if (!empty($expert->subject_specialization)) {
                $arr = is_array($expert->subject_specialization) ? $expert->subject_specialization : json_decode($expert->subject_specialization, true);
                if (is_array($arr)) $expertiseList = array_merge($expertiseList, $arr);
            }
            if (!empty($expert->counseling_specialization)) {
                $arr = is_array($expert->counseling_specialization) ? $expert->counseling_specialization : json_decode($expert->counseling_specialization, true);
                if (is_array($arr)) $expertiseList = array_merge($expertiseList, $arr);
            }
            if (empty($expertiseList)) {
                $expertiseList = ['Career Counseling', 'Admissions Strategy', 'Exam Mentoring', 'College Selection', 'Domain Guidance'];
            }

            // Education
            $eduList = [];
            if (!empty($expert->highest_qualification)) $eduList[] = ['degree' => 'Highest Qualification', 'school' => $expert->highest_qualification];
            if (!empty($expert->degree)) $eduList[] = ['degree' => 'Degree', 'school' => $expert->degree];
            if (!empty($expert->other_qualifications)) {
                $arr = is_array($expert->other_qualifications) ? $expert->other_qualifications : json_decode($expert->other_qualifications, true);
                if (is_array($arr)) {
                    foreach($arr as $eq) {
                        if (is_string($eq) && !empty($eq)) $eduList[] = ['degree' => 'Qualification', 'school' => $eq];
                    }
                }
            }
            if (empty($eduList)) {
                $eduList[] = ['degree' => 'Credentials', 'school' => 'Graduate / Higher Degree Credentials Verified'];
            }

            // Skills & Badges
            $skillsList = [];
            if (!empty($expert->certifications)) {
                $arr = is_array($expert->certifications) ? $expert->certifications : json_decode($expert->certifications, true);
                if (is_array($arr)) $skillsList = array_merge($skillsList, $arr);
            }
            if (!empty($expert->domain_certification)) $skillsList[] = $expert->domain_certification;
            if (!empty($expert->teaching_credentials)) $skillsList[] = $expert->teaching_credentials;
            if (!empty($expert->exams_cleared)) {
                $arr = is_array($expert->exams_cleared) ? $expert->exams_cleared : json_decode($expert->exams_cleared, true);
                if (is_array($arr)) $skillsList = array_merge($skillsList, $arr);
            }
            if (empty($skillsList)) {
                $skillsList = ['Career Counseling', 'Doubt Clearing', 'Mentoring', 'Soft Skills', 'Admissions Guidance'];
            }
        @endphp

        <!-- 1. Profile Header Banner -->
        <main class="about-hero-section ptb-70 pb-0">
            <div class="bg-square">
                <img src="{{ asset('assets/images/banner-square-img.svg') }}" alt="" />
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
                            <i class="fa-solid fa-chevron-left"></i> Back to Experts
                        </a>
                        <span class="verified-mentor-badge">Verified Expert</span>
                    </div>

                    <!-- Profile Info Card (Overlapping) -->
                    <div class="profile-details-card">
                        <div class="profile-main-card">
                            <div class="row align-items-center">
                                <div class="col-lg-2 col-md-3 col-12 d-flex justify-content-center">
                                    <div class="profile-avatar-wrapper">
                                        <img src="{{ $mPhoto }}" alt="{{ $mName }}" onError="this.src='{{ asset('assets/images/mentor_1.png') }}'">
                                    </div>
                                </div>
                                <div class="col-lg-7 col-md-6 col-12 text-center text-md-start ps-lg-4">
                                    <h1 class="profile-info-name">{{ $mName }}</h1>
                                    <p class="profile-info-role">{{ $mRole }}</p>
                                    <div class="mb-3">
                                        @foreach(array_slice($expertiseList, 0, 3) as $eIdx => $ePill)
                                            <span class="profile-info-badge {{ ['tag-blue', 'tag-yellow', 'tag-green'][$eIdx % 3] }}">{{ $ePill }}</span>
                                        @endforeach
                                    </div>
                                    <div class="text-muted small">
                                        <i class="fa-solid fa-tag me-1 text-primary"></i> Rate: <strong>₹{{ number_format($mPrice, 2) }}/min</strong>
                                        @if(!empty($expert->exp) || !empty($expert->years_of_experience_total))
                                            <span class="ms-3"><i class="fa-solid fa-briefcase me-1 text-primary"></i> Exp: <strong>{{ $expert->years_of_experience_total ?? $expert->exp }} Years</strong></span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-3 col-12 text-center text-md-end">
                                    <div class="profile-rating-info">
                                        <div class="profile-sessions-count">{{ $mCount }}</div>
                                        <div class="profile-rating-stars mt-1">
                                            @for($s=1; $s<=5; $s++)
                                                <i class="fa-solid fa-star {{ $s <= round($mRating) ? '' : 'opacity-25' }}"></i>
                                            @endfor
                                            <span class="profile-rating-num">{{ $mRating }}</span>
                                        </div>
                                        <div class="mt-3">
                                            <button type="button" onclick="openBookingModal('{{ $expert->id }}', '{{ addslashes($mName) }}')" class="profile-connect-btn border-0 w-100 shadow-sm" style="cursor: pointer;">
                                                Connect Now <i class="fa-solid fa-arrow-right-long ms-1"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- About Me section inside details card -->
                        <div class="profile-about-box">
                            <h2 class="profile-about-title">About {{ $mName }}</h2>
                            <p class="profile-about-text">
                                {{ $mBio }}
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
                        <div class="grid-info-card h-100">
                            <h2 class="grid-info-card-title">Areas of Expertise</h2>
                            <div class="expertise-pills-row">
                                @foreach($expertiseList as $expPill)
                                    <div class="expertise-pill-card">{{ $expPill }}</div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <!-- Row 1 Right: Ready to connect (Blue CTA) -->
                    <div class="col-lg-6 col-12">
                        <div class="ready-connect-card h-100 d-flex flex-column justify-content-between">
                            <div>
                                <h2 class="ready-connect-title">Ready to connect?</h2>
                                <p class="ready-connect-desc">
                                    Book a personalized 1:1 counseling session with {{ $mName }} and get all your career & admission queries resolved.
                                </p>
                            </div>
                            <button type="button" onclick="openBookingModal('{{ $expert->id }}', '{{ addslashes($mName) }}')" class="btn-ready-connect border-0" style="cursor: pointer;">
                                Connect Now <i class="fa-solid fa-arrow-right-long ms-1"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Row 2 Left: Education -->
                    <div class="col-lg-6 col-12">
                        <div class="grid-info-card h-100">
                            <h2 class="grid-info-card-title">Qualifications & Education</h2>
                            <div class="education-list">
                                @foreach($eduList as $edu)
                                    <div class="education-capsule mb-2">
                                        <span class="education-grade-badge">{{ $edu['degree'] }}</span>
                                        <span class="education-school-name">{{ $edu['school'] }}</span>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <!-- Row 2 Right: Skills & Certifications -->
                    <div class="col-lg-6 col-12">
                        <div class="grid-info-card h-100">
                            <h2 class="grid-info-card-title">Skills & Credentials</h2>
                            <div class="skills-row-box mb-3">
                                @foreach($skillsList as $sk)
                                    <span class="skills-outline-badge mb-2 d-inline-block me-1">{{ $sk }}</span>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <div class="grad-main" style="background: linear-gradient(180deg, rgb(205 230 255 / 3%) 0%, rgb(226 240 255 / 51%) 50%, rgb(191 219 247 / 1%) 100%)">

            <!-- 3. Achievements Section -->
            <section class="achievements-section">
                <div class="container">
                    <div class="text-center heading-achievements">
                        <div class="heading-with-lines d-flex align-items-center justify-content-center gap-3">
                            <span class="heading-line-orange d-none d-md-block"></span>
                            <h2>Achievements & Impact</h2>
                            <span class="heading-line-orange d-none d-md-block"></span>
                        </div>
                    </div>

                    <div class="achievements-flow">
                        <!-- Item 1 -->
                        <div class="achievement-item">
                            <div class="achievement-icon-circle">
                               <img src="{{ asset('assets/images/achievement-icon-1.png') }}" alt="">
                            </div>
                            <div class="achievement-stat">{{ $expert->count ?? '2423+' }}</div>
                            <div class="achievement-label">Total Counseling</div>
                        </div>

                        <i class="fa-solid fa-arrow-right-long achievement-flow-arrow d-none d-lg-block"></i>

                        <!-- Item 2 -->
                        <div class="achievement-item">
                            <div class="achievement-icon-circle">
                                <img src="{{ asset('assets/images/achievement-icon-2.png') }}" alt="">
                            </div>
                            <div class="achievement-stat">{{ $expert->years_of_experience_total ?? $expert->exp ?? '8+' }} Yrs</div>
                            <div class="achievement-label">Total Experience</div>
                        </div>

                        <i class="fa-solid fa-arrow-right-long achievement-flow-arrow d-none d-lg-block"></i>

                        <!-- Item 3 -->
                        <div class="achievement-item">
                            <div class="achievement-icon-circle">
                               <img src="{{ asset('assets/images/achievement-icon-3.png') }}" alt="">
                            </div>
                            <div class="achievement-stat">{{ $expert->exam_success_rate ?? '95%' }}</div>
                            <div class="achievement-label">Success Rate</div>
                        </div>

                        <i class="fa-solid fa-arrow-right-long achievement-flow-arrow d-none d-lg-block"></i>

                        <!-- Item 4 -->
                        <div class="achievement-item">
                            <div class="achievement-icon-circle">
                            <img src="{{ asset('assets/images/achievement-icon-4.png') }}" alt="">
                            </div>
                            <div class="achievement-stat">{{ $mRating }} / 5</div>
                            <div class="achievement-label">Satisfaction Score</div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Video Testimonials Section -->
            <section class="testimonials-section ptb-70">
                <div class="container">
                    <div class="text-center mb-5">
                        <div class="heading-with-lines d-flex align-items-center justify-content-center gap-3 mb-3">
                            <span class="heading-line d-none d-md-block"></span>
                            <h2 class="section-title mb-0">Video Testimonials</h2>
                            <span class="heading-line d-none d-md-block"></span>
                        </div>
                        <p class="section-subtitle mx-auto text-muted" style="max-width: 900px;">
                            What our students and parents have to say about their counseling experience.
                        </p>
                    </div>

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
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-play-fill" viewBox="0 0 16 16">
                                                    <path d="m11.596 8.697-6.363 3.692c-.54.313-1.233-.066-1.233-.697V4.308c0-.63.692-1.01 1.233-.696l6.363 3.692a.802.802 0 0 1 0 1.393z" />
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
                </div>
            </section>
        </div>

        <!-- 4. Review Our Mentors Section -->
        <section class="review-form-section">
            <div class="container">
                <div class="text-center mb-5">
                    <div class="heading-with-lines d-flex align-items-center justify-content-center gap-3">
                        <span class="heading-line-orange d-none d-md-block"></span>
                        <h2>Review Expert</h2>
                        <span class="heading-line-orange d-none d-md-block"></span>
                    </div>
                </div>

                <div class="row align-items-center">
                    <div class="col-lg-6 col-12">
                        <div class="review-box-card">
                            <div class="mx-auto review-box-icon d-flex align-items-center justify-content-center">
                                <img src="{{ asset('assets/images/mentor-review-icon.png') }}" alt="">
                            </div>

                            <h3 class="review-box-title">Review {{ $mName }}</h3>
                            <p class="review-box-desc">We value your feedback. Please share your honest review.</p>

                            <div class="text-start mb-3" style="font-size: 13.5px; font-weight: 700; color: #0D1B2A;">Overall Rating</div>
                            <div class="rating-stars-interactive" id="stars-container">
                                <i class="fa-regular fa-star" data-index="1"></i>
                                <i class="fa-regular fa-star" data-index="2"></i>
                                <i class="fa-regular fa-star" data-index="3"></i>
                                <i class="fa-regular fa-star" data-index="4"></i>
                                <i class="fa-regular fa-star" data-index="5"></i>
                                <span class="ms-2" style="font-size: 12.5px; color: #888888; font-weight: 500;" id="rating-label">Tap to rate</span>
                            </div>

                            <form action="{{ route('mentor.review.submit') }}" method="POST">
                                @csrf
                                <input type="hidden" name="mentor_id" value="{{ optional($expert)->id }}">
                                <div class="text-start mb-2" style="font-size: 13.5px; font-weight: 700; color: #0D1B2A;">Your Feedback</div>
                                <textarea name="feedback" class="review-textarea" placeholder="Write your feedback about the expert..." required></textarea>
                                <input type="hidden" name="rating" id="rating-input" value="5">

                                <button type="submit" class="btn-submit-review">
                                    Submit Review <i class="fa-solid fa-chevron-right"></i>
                                </button>
                            </form>
                        </div>
                    </div>

                    <div class="col-lg-6 col-12 ps-lg-5 position-relative">
                        <div class="review-info-notice">
                            <img src="{{ asset('assets/images/review-anti-icon.png') }}" alt="">
                            <span>Your feedback is important and helps us maintain high quality counseling.</span>
                        </div>

                        <div class="review-collage-wrapper">
                            <img src="{{ asset('assets/images/review-mentor-img.png') }}" class="review-img-small" alt="Expert at work">
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
    @include('partials.book-session-modal')
@endsection
