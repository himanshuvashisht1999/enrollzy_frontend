@extends('layouts.app')

@section('content')


    <div class="mentors-page-wrapper">

        <!-- 1. HERO BANNER SECTION -->
        <main class="about-hero-section ptb-70 pb-0">
            <div class="bg-square">
                <img src="assets/images/banner-square-img.svg" alt="" />
            </div>
            <div class="container position-relative">
                <div class="row align-items-center">
                    <!-- Left Content -->
                    <div class="col-lg-5 col-12 text-center text-lg-start mentors-hero-content">
                        <div class="hero-badge-container">
                            <span class="hero-badge">Learn From The Best</span>
                            <!-- Custom CSS/SVG Curved Arrow -->
                            <img src="{{ asset('assets/images/mentor-banner-arrow.png') }}" alt="">
                        </div>

                        <h1 class="mentors-hero-title">
                            <span class="highlight-orange">Meet Our</span> Mentors
                        </h1>

                        <p class="mentors-hero-desc">
                            Guiding you with expertise, inspiring you with experience and mentoring you towards success.
                        </p>

                        <a href="#expert-grid-section" class="btn-book-session">
                            Book Session Now
                            <i class="fa-solid fa-arrow-right-long"></i>
                        </a>
                    </div>

                    <!-- Right Visual Area -->
                    <div class="col-lg-7 col-12 position-relative">
                        <div class="hero-image-container">
                            <img src="{{ asset('assets/images/mentor-banner-img.png') }}" 
                                alt="Vinay Singh">

                        </div>
                    </div>
                </div>
            </div>
        </main>
        <div class="py-3" style="background-color: #f9ad0b14">
            <div class="container d-flex justify-content-between align-items-center flex-wrap gap-2">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0" style="font-size: 13.5px; font-weight: 500;">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-decoration-none text-muted"><i
                                    class="fa-solid fa-house me-1"></i> Home</a></li>
                        <li class="breadcrumb-item active text-primary" aria-current="page">Experts</li>
                    </ol>
                </nav>
            </div>
        </div>


        <!-- 2. CATEGORY NAVIGATION BAR -->
        <section class="category-nav-sec py-4">
            <div class="container">


                <!-- Card Badges Grid -->
                <div class="swiper category-swiper" style="overflow: hidden; padding: 10px 0;">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide" style="width: auto;">
                            <a href="{{ route('all-schools') }}" class="category-badge-card cat-schools"style="border:1px solid #F9AD0B;background-color:#F9AD0B12;">
                                <img src="{{ asset('assets/images/top-exam-icon-2.png') }}" alt=""> Schools
                            </a>
                        </div>
                        <div class="swiper-slide" style="width: auto;">
                            <a href="{{ route('university') }}" class="category-badge-card cat-universities"style="border:1px solid #3771C8;background-color:#3771C812;">
                                <img src="{{ asset('assets/images/top-exam-icon-2.png') }}" alt=""> Universities
                            </a>
                        </div>
                        <div class="swiper-slide" style="width: auto;">
                            <a href="{{ route('all.coaching') }}" class="category-badge-card cat-coaching"style="border:1px solid #10B981;background-color:#10B98112;">
                                <img src="{{ asset('assets/images/top-exam-icon-2.png') }}" alt=""> Coaching
                            </a>
                        </div>
                        <div class="swiper-slide" style="width: auto;">
                            <a href="{{ route('mentors') }}" class="category-badge-card cat-mentors active"style="border:1px solid #E6E6E6;background-color:#E6E6E612;">
                                <img src="{{ asset('assets/images/top-exam-icon-2.png') }}" alt=""> Mentors
                            </a>
                        </div>
                        <div class="swiper-slide" style="width: auto;">
                            <a href="{{ route('all-schools') }}" class="category-badge-card cat-schools"style="border:1px solid #F9AD0B;background-color:#F9AD0B12;">
                                <img src="{{ asset('assets/images/top-exam-icon-2.png') }}" alt=""> Schools
                            </a>
                        </div>
                        <div class="swiper-slide" style="width: auto;">
                            <a href="{{ route('university') }}" class="category-badge-card cat-universities"style="border:1px solid #3771C8;background-color:#3771C812;">
                                <img src="{{ asset('assets/images/top-exam-icon-2.png') }}" alt=""> Universities
                            </a>
                        </div>
                        <div class="swiper-slide" style="width: auto;">
                            <a href="{{ route('all.coaching') }}" class="category-badge-card cat-coaching"style="border:1px solid #10B981;background-color:#10B98112;">
                                <img src="{{ asset('assets/images/top-exam-icon-2.png') }}" alt=""> Coaching
                            </a>
                        </div>
                        <div class="swiper-slide" style="width: auto;">
                            <a href="{{ route('mentors') }}" class="category-badge-card cat-mentors active"style="border:1px solid #E6E6E6;background-color:#E6E6E612;">
                                <img src="{{ asset('assets/images/top-exam-icon-2.png') }}" alt=""> Mentors
                            </a>
                        </div>
                       
                        
                    </div>
                </div>
            </div>
        </section>

        <!-- 3. TESTIMONIALS SECTION -->
        <section class="testimonials-sec ptb-70">
            <div class="container testimonials-container">
                <!-- Section Header -->
                <div class="text-center mb-5">
                    <div class="heading-with-lines d-flex align-items-center justify-content-center gap-3">
                        <span class="heading-line-orange d-none d-md-block"></span>
                        <h2>What mentees said!</h2>
                        <span class="heading-line-orange d-none d-md-block"></span>
                    </div>
                </div>

                <!-- Swiper Carousel -->
                <div class="swiper feedback-swiper" style="padding: 10px 0 30px 0;">
                    <div class="swiper-wrapper">
                        @if(isset($testimonials) && count($testimonials) > 0)
                            @foreach($testimonials as $t)
                                @php
                                    $mAvatar = asset('assets/images/mentor_1.png');
                                    if (!empty($t['mentor_avatar'])) {
                                        if (str_starts_with($t['mentor_avatar'], 'http')) {
                                            $mAvatar = $t['mentor_avatar'];
                                        } elseif (file_exists(public_path('storage/' . $t['mentor_avatar']))) {
                                            $mAvatar = asset('storage/' . $t['mentor_avatar']);
                                        } elseif (file_exists(base_path('../enrollzy_backend/public/storage/' . $t['mentor_avatar']))) {
                                            $mAvatar = 'http://127.0.0.1:8001/storage/' . $t['mentor_avatar'];
                                        } elseif (file_exists(public_path('assets/images/' . $t['mentor_avatar']))) {
                                            $mAvatar = asset('assets/images/' . $t['mentor_avatar']);
                                        }
                                    }

                                    $menteeAvatar = asset('assets/images/team_member_1.png');
                                    if (!empty($t['mentee_avatar'])) {
                                        if (str_starts_with($t['mentee_avatar'], 'http')) {
                                            $menteeAvatar = $t['mentee_avatar'];
                                        } elseif (file_exists(public_path('storage/' . $t['mentee_avatar']))) {
                                            $menteeAvatar = asset('storage/' . $t['mentee_avatar']);
                                        } elseif (file_exists(base_path('../enrollzy_backend/public/storage/' . $t['mentee_avatar']))) {
                                            $menteeAvatar = 'http://127.0.0.1:8001/storage/' . $t['mentee_avatar'];
                                        } elseif (file_exists(public_path('assets/images/' . $t['mentee_avatar']))) {
                                            $menteeAvatar = asset('assets/images/' . $t['mentee_avatar']);
                                        }
                                    }
                                @endphp
                                <div class="swiper-slide">
                                    <div class="testimonial-slide-card">
                                        <div class="testimonial-top-header">
                                            <img src="{{ $mAvatar }}" class="testimonial-mentor-avatar" alt="{{ $t['mentor_name'] }}" onError="this.onerror=null; this.src='{{ asset('assets/images/mentor_1.png') }}';">
                                            <div>
                                                <div class="testimonial-top-name">{{ $t['mentor_name'] }}</div>
                                                <div class="testimonial-top-role">{{ $t['mentor_role'] }}</div>
                                            </div>
                                        </div>
                                        <div class="testimonial-body">
                                            <div class="testimonial-stars">
                                                @for($s = 0; $s < ($t['stars'] ?? 5); $s++)
                                                    <i class="fa-solid fa-star"></i>
                                                @endfor
                                            </div>
                                            <p class="testimonial-text">
                                                {{ $t['text'] }}
                                            </p>
                                            <div class="testimonial-bottom-profile">
                                                <img src="{{ $menteeAvatar }}" class="testimonial-mentee-avatar" alt="{{ $t['mentee_name'] }}" onError="this.onerror=null; this.src='{{ asset('assets/images/team_member_1.png') }}';">
                                                <div>
                                                    <div class="testimonial-bottom-name">{{ $t['mentee_name'] }}</div>
                                                    <div class="testimonial-bottom-role">{{ $t['mentee_role'] }}</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>

                <!-- Custom Swiper Navigation Buttons -->
                <div class="swiper-arrow-btn feedback-prev-btn">
                    <i class="fa-solid fa-left-long" style="color: rgb(0, 0, 0);"></i>
                </div>
                <div class="swiper-arrow-btn feedback-next-btn">
                    <i class="fa-solid fa-right-long" style="color: rgb(0, 0, 0);"></i>
                </div>
            </div>
        </section>

        <!-- 4. TILTED MARQUEE RIBBON -->
        <div class="tilted-marquee-wrapper-main mb-5 mt-5">
        <div class="tilted-marquee-wrapper mb-5 mt-5">
            <div class="marquee-content">
                <span class="marquee-item">Trusted Mentors  </span>
                <span class="marquee-item"><img src="{{asset('assets/images/marquee-mentor-icon.png')}}" alt=""></span>
                <span class="marquee-item">Real Guidance  </span>
                <span class="marquee-item"><img src="{{asset('assets/images/marquee-mentor-icon.png')}}" alt=""></span>
                <span class="marquee-item">Career Growth  </span>
                <span class="marquee-item"><img src="{{asset('assets/images/marquee-mentor-icon.png')}}" alt=""></span>
                <span class="marquee-item">Grow Smarter  </span>
                <span class="marquee-item"><img src="{{asset('assets/images/marquee-mentor-icon.png')}}" alt=""></span>
                <span class="marquee-item">Trusted Mentors  </span>
                <span class="marquee-item"><img src="{{asset('assets/images/marquee-mentor-icon.png')}}" alt=""></span>
                <span class="marquee-item">Real Guidance  </span>
                <span class="marquee-item"><img src="{{asset('assets/images/marquee-mentor-icon.png')}}" alt=""></span>
                <span class="marquee-item">Career Growth  </span>
                <span class="marquee-item"><img src="{{asset('assets/images/marquee-mentor-icon.png')}}" alt=""></span>
                <span class="marquee-item">Grow Smarter  </span>
                <span class="marquee-item"><img src="{{asset('assets/images/marquee-mentor-icon.png')}}" alt=""></span>
            </div>
            <!-- Duplicate marquee content for seamless infinite scroll -->
            <div class="marquee-content" aria-hidden="true">
                <span class="marquee-item">Trusted Mentors  </span>
                <span class="marquee-item"><img src="{{asset('assets/images/marquee-mentor-icon.png')}}" alt=""></span>
                <span class="marquee-item">Real Guidance  </span>
                <span class="marquee-item"><img src="{{asset('assets/images/marquee-mentor-icon.png')}}" alt=""></span>
                <span class="marquee-item">Career Growth  </span>
                <span class="marquee-item"><img src="{{asset('assets/images/marquee-mentor-icon.png')}}" alt=""></span>
                <span class="marquee-item">Grow Smarter  </span>
                <span class="marquee-item"><img src="{{asset('assets/images/marquee-mentor-icon.png')}}" alt=""></span>
                <span class="marquee-item">Trusted Mentors  </span>
                <span class="marquee-item"><img src="{{asset('assets/images/marquee-mentor-icon.png')}}" alt=""></span>
                <span class="marquee-item">Real Guidance  </span>
                <span class="marquee-item"><img src="{{asset('assets/images/marquee-mentor-icon.png')}}" alt=""></span>
                <span class="marquee-item">Career Growth  </span>
                <span class="marquee-item"><img src="{{asset('assets/images/marquee-mentor-icon.png')}}" alt=""></span>
                <span class="marquee-item">Grow Smarter  </span>
                <span class="marquee-item"><img src="{{asset('assets/images/marquee-mentor-icon.png')}}" alt=""></span>
            </div>
        </div>
        </div>
        <div class="grad-main"
        style="background: linear-gradient(180deg, rgba(191, 219, 247, 0) 0%, rgb(191 219 247 / 17%) 50%, rgba(191, 219, 247, 0) 100%);">

        <!-- 5. EXPERT MENTORS GRID SECTION -->
        <section class="expert-mentors-sec ptb-70" id="expert-grid-section">
            <div class="container">
                <!-- Section Header -->
                <div class="text-center mb-5">
                    <div class="heading-with-lines d-flex align-items-center justify-content-center gap-3 mb-3">
                        <span class="heading-line-orange d-none d-md-block"></span>
                        <h2>Expert Mentors</h2>
                        <span class="heading-line-orange d-none d-md-block"></span>
                    </div>
                    <p class="section-subtitle-custom">
                        Learn from experienced professionals, industry leaders, and academic mentors dedicated to student
                        success.
                    </p>
                </div>

                <!-- Filter Pills -->
                <div class="filter-pills-container">
                    <button class="filter-pill-btn active" data-filter="all">All</button>
                    <button class="filter-pill-btn" data-filter="nda">NDA</button>
                    <button class="filter-pill-btn" data-filter="jee">JEE MAIN</button>
                    <button class="filter-pill-btn" data-filter="neet">NEET</button>
                    <button class="filter-pill-btn" data-filter="ssc">SSC</button>
                    <button class="filter-pill-btn" data-filter="university">University</button>
                </div>

                <!-- Mentors Grid -->
                <div class="row g-4 justify-content-center" id="mentor-grid-row">
                    @forelse($mentors as $index => $mentor)
                        @php
                            $mName = trim(($mentor->first_name ?? '') . ' ' . ($mentor->last_name ?? ''));
                            if (empty($mName)) {
                                $mName = $mentor->user->name ?? 'Expert Mentor';
                            }

                            $defaultAvatars = ['mentor_1.png', 'mentor_2.png', 'mentor_3.png', 'mentor_4.png'];
                            $mPhoto = asset('assets/images/' . $defaultAvatars[$index % count($defaultAvatars)]);
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

                            $tagLists = [
                                ['MBA Prep', 'Product', 'Startups'],
                                ['CS & AI', 'JEE Strategy', 'Coding'],
                                ['NEET Prep', 'MBBS Guide', 'Medical'],
                                ['NDA & SSB', 'Defence', 'Fitness']
                            ];
                            $mTags = $mentor->tags ?? $tagLists[$index % count($tagLists)];

                            $catMapList = ['university,jee', 'nda,ssc', 'neet,jee', 'university,ssc'];
                            $catAttr = $mentor->categories ?? $catMapList[$index % count($catMapList)];
                            $ratingNum = $mentor->rating ?? number_format(4.7 + (($index % 3) * 0.1), 1);
                            $sessionNum = $mentor->sessions_count ?? (180 + ($index * 65));
                            $priceMin = $mentor->price_per_min ?? (300 + ($index * 100));
                        @endphp
                        <div class="col-xl-3 col-lg-4 col-md-6 col-12 mentor-card-col" data-categories="{{ $catAttr }}">
                            <div class="mentor-grid-card">
                                <div class="mentor-card-img-wrapper">
                                    <img src="{{ $mPhoto }}" alt="{{ $mName }}" onError="this.src='{{ asset('assets/images/mentor_1.png') }}'">
                                    <a href="{{ route('mentor.detail', $mentor->id) }}" class="mentor-view-profile-btn" title="View Profile">
                                        <i class="fa-solid fa-eye"></i>
                                    </a>
                                </div>
                                <div class="mentor-card-content">
                                    <h3 class="mentor-card-name">{{ $mName }}</h3>
                                    <p class="mentor-card-role">{{ $mentor->professional_headline ?? 'Product Manager • Google • IIM-A' }}</p>

                                    <div class="mentor-tags-wrapper">
                                        @foreach($mTags as $tIndex => $tTag)
                                            @php $colorClass = ['tag-blue', 'tag-yellow', 'tag-green'][$tIndex % 3]; @endphp
                                            <span class="mentor-tag-badge {{ $colorClass }}">{{ $tTag }}</span>
                                        @endforeach
                                    </div>

                                    <div class="mentor-rating-row">
                                        <div class="mentor-stars-info">
                                            <i class="fa-solid fa-star mentor-star-filled"></i>
                                            <span class="mentor-rating-num">{{ $ratingNum }}</span>
                                        </div>
                                        <span class="mentor-session-count">{{ $sessionNum }} sessions</span>
                                    </div>

                                    <div class="mentor-booking-footer">
                                        <div class="mentor-price-tag">
                                            ₹{{ $priceMin }}<span>/min</span>
                                        </div>
                                        <a href="{{ route('mentor.detail', $mentor->id) }}" class="btn-mentor-book">
                                            Book session <i class="fa-solid fa-arrow-right-long"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12 text-center py-5">
                            <p class="text-muted fs-5">No mentors found at the moment.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </section>
        <!-- Testimonials Section -->
        <section class="testimonials-section ptb-70" id="video-testimonials-sec" >
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
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-2 row-cols-lg-4 g-4 mb-4">
                    @if(isset($video_testimonials) && $video_testimonials->count() > 0)
                        @foreach($video_testimonials as $index => $video)
                            <div class="col video-card-item {{ $index >= 4 ? 'd-none video-card-extra' : '' }}">
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

                @if(isset($video_testimonials) && $video_testimonials->count() > 4)
                <!-- View More Button -->
                <div class="text-center">
                    <button type="button" id="btn-toggle-videos" class="btn btn-enrollzy btn-enrollzy-lg text-white">
                        <span id="video-btn-text">View More</span> <i class="fa-solid fa-chevron-down ms-1" id="video-toggle-icon"></i>
                    </button>
                </div>
                @else
                <div class="text-center">
                    <a href="#video-testimonials-sec" class="btn btn-enrollzy btn-enrollzy-lg text-decoration-none text-white">
                        View More <i class="fa-solid fa-arrow-down ms-1"></i>
                    </a>
                </div>
                @endif
            </div>
        </section>
        </div>

        <!-- 6. FAQ ACCORDION SECTION -->
        <section class="faq-accordion-sec ptb-70">
            <div class="container">
                <!-- Section Header -->
                <div class="text-center mb-5">
                    <div class="heading-with-lines d-flex align-items-center justify-content-center gap-3">
                        <span class="heading-line-orange d-none d-md-block"></span>
                        <h2>Frequently Asked Questions</h2>
                        <span class="heading-line-orange d-none d-md-block"></span>
                    </div>
                </div>

                <!-- Accordion Items -->
                <div class="faq-list-wrapper">
                    <!-- FAQ Item 1 -->
                    <div class="faq-card-item active">
                        <button class="faq-question-header" onclick="toggleFaq(this)">
                            What is Unstop Mentorship?
                            <i class="fa-solid fa-plus faq-toggle-icon"></i>
                        </button>
                        <div class="faq-answer-panel" style="max-height: 200px;">
                            <div class="faq-answer-content">
                                Unstop Mentorship is a unique platform which connects top quality mentors from around the
                                globe with ambitious mentees who are looking for guidance, all on a single platform.
                            </div>
                        </div>
                    </div>

                    <!-- FAQ Item 2 -->
                    <div class="faq-card-item">
                        <button class="faq-question-header" onclick="toggleFaq(this)">
                            How does Unstop Mentorship work?
                            <i class="fa-solid fa-plus faq-toggle-icon"></i>
                        </button>
                        <div class="faq-answer-panel">
                            <div class="faq-answer-content">
                                Mentees can browse through profiles of verified mentors across various industries, fields,
                                and exams. You can select your preferred mentor, choose a date and time slot that works for
                                you, and book a 1:1 video/audio call session directly through our booking calendar.
                            </div>
                        </div>
                    </div>

                    <!-- FAQ Item 3 -->
                    <div class="faq-card-item">
                        <button class="faq-question-header" onclick="toggleFaq(this)">
                            What is the goal of 1:1 mentorship sessions?
                            <i class="fa-solid fa-plus faq-toggle-icon"></i>
                        </button>
                        <div class="faq-answer-panel">
                            <div class="faq-answer-content">
                                The primary goal is to provide personalized, focused guidance. This includes resume reviews,
                                mock interviews, preparation strategy planning for top exams, career roadmap reviews, and
                                deep-dive consulting on transitioning into specific corporate or technical roles.
                            </div>
                        </div>
                    </div>

                    <!-- FAQ Item 4 -->
                    <div class="faq-card-item">
                        <button class="faq-question-header" onclick="toggleFaq(this)">
                            Who is eligible to take 1:1 mentorship sessions?
                            <i class="fa-solid fa-plus faq-toggle-icon"></i>
                        </button>
                        <div class="faq-answer-panel">
                            <div class="faq-answer-content">
                                Anyone seeking guidance is eligible! This includes students preparing for competitive exams
                                (JEE, NEET, NDA, SSC), graduates aiming to secure admissions in top colleges, and working
                                professionals planning to transition careers or upskill in their current fields.
                            </div>
                        </div>
                    </div>

                    <!-- FAQ Item 5 -->
                    <div class="faq-card-item">
                        <button class="faq-question-header" onclick="toggleFaq(this)">
                            Who are Unstop mentors?
                            <i class="fa-solid fa-plus faq-toggle-icon"></i>
                        </button>
                        <div class="faq-answer-panel">
                            <div class="faq-answer-content">
                                Our mentors are experienced industry professionals, successful founders, top scorers in
                                competitive exams, and alumni of top institutions like IITs, IIMs, and prestigious global
                                universities. Every mentor profile undergoes strict verification before being listed.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </div>

    <!-- Interactive JavaScript logic for Pills Filter and Accordion FAQ -->
    <script>
        // FAQ Toggle Handler
        function toggleFaq(header) {
            const item = header.parentElement;
            const panel = header.nextElementSibling;
            const isActive = item.classList.contains('active');

            // Close all other open items
            document.querySelectorAll('.faq-card-item').forEach(el => {
                el.classList.remove('active');
                el.querySelector('.faq-answer-panel').style.maxHeight = null;
            });

            // Toggle current item
            if (!isActive) {
                item.classList.add('active');
                panel.style.maxHeight = panel.scrollHeight + "px";
            }
        }

        // Grid Category Filter Handler & Swiper Initialization
        document.addEventListener('DOMContentLoaded', function () {
            // Initialize Category Swiper
            const categorySwiper = new Swiper('.category-swiper', {
                slidesPerView: 'auto',
                spaceBetween: 25,
                freeMode: true,
                watchSlidesProgress: true,
            });

            const filterBtns = document.querySelectorAll('.filter-pill-btn');
            const mentorCols = document.querySelectorAll('.mentor-card-col');

            filterBtns.forEach(btn => {
                btn.addEventListener('click', function () {
                    // Remove active class from all buttons
                    filterBtns.forEach(b => b.classList.remove('active'));
                    // Add active class to clicked button
                    this.classList.add('active');

                    const filterValue = this.getAttribute('data-filter');

                    mentorCols.forEach(col => {
                        if (filterValue === 'all') {
                            col.style.display = 'block';
                        } else {
                            const categories = col.getAttribute('data-categories').split(',');
                            if (categories.includes(filterValue)) {
                                col.style.display = 'block';
                            } else {
                                col.style.display = 'none';
                            }
                        }
                    });
                });
            });
            // Toggle Video Testimonials Extra Cards
            const toggleVideosBtn = document.getElementById('btn-toggle-videos');
            if (toggleVideosBtn) {
                toggleVideosBtn.addEventListener('click', function () {
                    const extraCards = document.querySelectorAll('.video-card-extra');
                    const btnText = document.getElementById('video-btn-text');
                    const icon = document.getElementById('video-toggle-icon');
                    let isExpanding = false;

                    extraCards.forEach(card => {
                        if (card.classList.contains('d-none')) {
                            card.classList.remove('d-none');
                            isExpanding = true;
                        } else {
                            card.classList.add('d-none');
                        }
                    });

                    if (isExpanding) {
                        if (btnText) btnText.textContent = "Show Less";
                        if (icon) icon.className = "fa-solid fa-chevron-up ms-1";
                    } else {
                        if (btnText) btnText.textContent = "View More";
                        if (icon) icon.className = "fa-solid fa-chevron-down ms-1";
                        document.getElementById('video-testimonials-sec').scrollIntoView({ behavior: 'smooth' });
                    }
                });
            }
        });
    </script>
@endsection