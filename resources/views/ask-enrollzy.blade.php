@extends('layouts.app')

@section('content')

    <main class="about-hero-section ptb-70 pb-0">
        <div class="bg-square">
            <img style="height: auto;" src="assets/images/banner-square-img.svg" alt="" />
        </div>
        <div class="ask-page-wrapper">

            <!-- 1. Header Banner Area -->
            <section class="ask-hero-sec">

                <div class="container ask-banner-container">
                    <!-- Colorful Shingles Banner Image -->
                    <img src="{{ asset('assets/images/ask-enrol-bg-img.png') }}" class="ask-banner-image"
                        alt="Roof Shingles Banner">

                    <!-- Overlapping White Info Card -->
                    <div class="ask-profile-header-card">
                        <div class="ask-avatar-wrapper">
                            <img src="{{ asset('assets/images/mentor_1.png') }}" alt="AskEnrollzy Profile">
                        </div>
                        <div class=" flex-grow-1 text-center text-lg-start">
                            <h1 class="ask-community-name">AskEnrollzy</h1>
                        </div>
                        <div class="d-flex gap-2">
                            <a href="#" class="btn-create-post">
                                <i class="fa-solid fa-plus"></i> Create Post
                            </a>
                            <a href="#" class="btn-join-community">Join</a>
                        </div>
                    </div>

                   
                </div>
            </section>

            <!-- 2. Main content Layout grid -->
            <div class="container py-4">
                <div class="row g-4">
                    <!-- Sort/Dropdown Option -->
                    <div class="col-lg-12 col-12">
                    <div class="mt-4 ">
                        <button class="filter-sort-btn" type="button">
                            New <i class="fa-solid fa-chevron-down"></i>
                        </button>
                    </div>
                    </div>
                   

                    <!-- Left Main Column: Post Feed -->
                    <div class="col-lg-8 col-12">

                        <!-- Post Card 1: Text-only -->
                        <div class="post-card">
                            <div class="post-header">
                                <div class="d-flex align-items-center gap-2">
                                    <img src="{{ asset('assets/images/team_member_1.png') }}" class="post-author-avatar"
                                        alt="Avatar">
                                    <span class="post-author-name">lorem ipsum dumy</span>
                                    <span class="post-time">• 1 min ago</span>
                                </div>
                                <button class="post-dots-menu"><i class="fa-solid fa-ellipsis"></i></button>
                            </div>
                            <h2 class="post-title">What's the biggest green flag someone can have on a first date?</h2>

                            <div class="post-footer-buttons">
                                <a href="#" class="post-pill-btn"><i class="fa-solid fa-arrow-up"></i> 1 <i
                                        class="fa-solid fa-arrow-down"></i></a>
                                <a href="#" class="post-pill-btn"><i class="fa-regular fa-comment"></i> 0</a>
                                <a href="#" class="post-pill-btn"><i class="fa-regular fa-flag"></i></a>
                                <a href="#" class="post-pill-btn"><i class="fa-solid fa-arrow-up-from-bracket"></i>
                                    Share</a>
                            </div>
                        </div>

                        <!-- Post Card 2: Image Carousel -->
                        <div class="post-card">
                            <div class="post-header">
                                <div class="d-flex align-items-center gap-2">
                                    <img src="{{ asset('assets/images/team_member_2.png') }}" class="post-author-avatar"
                                        alt="Avatar">
                                    <span class="post-author-name">lorem ipsum dumy</span>
                                    <span class="post-time">• 1 min ago</span>
                                </div>
                                <button class="post-dots-menu"><i class="fa-solid fa-ellipsis"></i></button>
                            </div>
                            <h2 class="post-title">What's the biggest green flag someone can have on a first date?</h2>

                            <!-- Swiper Carousel Container -->
                            <div class="post-image-carousel-container swiper post-swiper">
                                <div class="swiper-wrapper">
                                    <!-- Slide 1 -->
                                    <div class="swiper-slide position-relative">
                                        <img src="{{ asset('assets/images/about_team_meeting.png') }}"
                                            class="post-carousel-img" alt="Carousel Image">
                                        <div class="post-image-bottom-bar">
                                            <h4 class="post-image-label">[TEST] Timbuk2 Parkside 2.0 Laptop Backpack</h4>
                                            <a href="#" class="btn-post-image-learn">learn more</a>
                                        </div>
                                    </div>
                                    <!-- Slide 2 -->
                                    <div class="swiper-slide position-relative">
                                        <img src="{{ asset('assets/images/about_professor_portrait.png') }}"
                                            class="post-carousel-img" alt="Carousel Image">
                                        <div class="post-image-bottom-bar">
                                            <h4 class="post-image-label">[TEST] Laptop Backpack Premium Edition</h4>
                                            <a href="#" class="btn-post-image-learn">learn more</a>
                                        </div>
                                    </div>
                                </div>
                                <!-- Carousel Arrow Controls -->
                                <button class="post-swiper-arrow post-arrow-left post-swiper-prev"><i
                                        class="fa-solid fa-chevron-left"></i></button>
                                <button class="post-swiper-arrow post-arrow-right post-swiper-next"><i
                                        class="fa-solid fa-chevron-right"></i></button>
                            </div>

                            <div class="post-footer-buttons">
                                <a href="#" class="post-pill-btn">Vote <i class="fa-solid fa-arrow-up"></i> <i
                                        class="fa-solid fa-arrow-down"></i></a>
                                <a href="#" class="post-pill-btn"><i class="fa-regular fa-comment"></i> 0</a>
                                <a href="#" class="post-pill-btn"><i class="fa-solid fa-arrow-up-from-bracket"></i>
                                    Share</a>
                            </div>
                        </div>

                        <!-- Post Card 3: Text-only -->
                        <div class="post-card">
                            <div class="post-header">
                                <div class="d-flex align-items-center gap-2">
                                    <img src="{{ asset('assets/images/team_member_3.png') }}" class="post-author-avatar"
                                        alt="Avatar">
                                    <span class="post-author-name">lorem ipsum dumy</span>
                                    <span class="post-time">• 1 min ago</span>
                                </div>
                                <button class="post-dots-menu"><i class="fa-solid fa-ellipsis"></i></button>
                            </div>
                            <h2 class="post-title">What's the biggest green flag someone can have on a first date?</h2>

                            <div class="post-footer-buttons">
                                <a href="#" class="post-pill-btn"><i class="fa-solid fa-arrow-up"></i> 1 <i
                                        class="fa-solid fa-arrow-down"></i></a>
                                <a href="#" class="post-pill-btn"><i class="fa-regular fa-comment"></i> 0</a>
                                <a href="#" class="post-pill-btn"><i class="fa-regular fa-flag"></i></a>
                                <a href="#" class="post-pill-btn"><i class="fa-solid fa-arrow-up-from-bracket"></i>
                                    Share</a>
                            </div>
                        </div>

                        <!-- Post Card 4: Text-only -->
                        <div class="post-card">
                            <div class="post-header">
                                <div class="d-flex align-items-center gap-2">
                                    <img src="{{ asset('assets/images/team_member_4.png') }}" class="post-author-avatar"
                                        alt="Avatar">
                                    <span class="post-author-name">lorem ipsum dumy</span>
                                    <span class="post-time">• 1 min ago</span>
                                </div>
                                <button class="post-dots-menu"><i class="fa-solid fa-ellipsis"></i></button>
                            </div>
                            <h2 class="post-title">What's the biggest green flag someone can have on a first date?</h2>

                            <div class="post-footer-buttons">
                                <a href="#" class="post-pill-btn"><i class="fa-solid fa-arrow-up"></i> 1 <i
                                        class="fa-solid fa-arrow-down"></i></a>
                                <a href="#" class="post-pill-btn"><i class="fa-regular fa-comment"></i> 0</a>
                                <a href="#" class="post-pill-btn"><i class="fa-regular fa-flag"></i></a>
                                <a href="#" class="post-pill-btn"><i class="fa-solid fa-arrow-up-from-bracket"></i>
                                    Share</a>
                            </div>
                        </div>

                        <!-- Post Card 5: Text-only -->
                        <div class="post-card">
                            <div class="post-header">
                                <div class="d-flex align-items-center gap-2">
                                    <img src="{{ asset('assets/images/team_member_1.png') }}" class="post-author-avatar"
                                        alt="Avatar">
                                    <span class="post-author-name">lorem ipsum dumy</span>
                                    <span class="post-time">• 1 min ago</span>
                                </div>
                                <button class="post-dots-menu"><i class="fa-solid fa-ellipsis"></i></button>
                            </div>
                            <h2 class="post-title">What's the biggest green flag someone can have on a first date?</h2>

                            <div class="post-footer-buttons">
                                <a href="#" class="post-pill-btn"><i class="fa-solid fa-arrow-up"></i> 1 <i
                                        class="fa-solid fa-arrow-down"></i></a>
                                <a href="#" class="post-pill-btn"><i class="fa-regular fa-comment"></i> 0</a>
                                <a href="#" class="post-pill-btn"><i class="fa-regular fa-flag"></i></a>
                                <a href="#" class="post-pill-btn"><i class="fa-solid fa-arrow-up-from-bracket"></i>
                                    Share</a>
                            </div>
                        </div>

                        <!-- Post Card 6: Image Carousel -->
                        <div class="post-card">
                            <div class="post-header">
                                <div class="d-flex align-items-center gap-2">
                                    <img src="{{ asset('assets/images/team_member_2.png') }}" class="post-author-avatar"
                                        alt="Avatar">
                                    <span class="post-author-name">lorem ipsum dumy</span>
                                    <span class="post-time">• 1 min ago</span>
                                </div>
                                <button class="post-dots-menu"><i class="fa-solid fa-ellipsis"></i></button>
                            </div>
                            <h2 class="post-title">What's the biggest green flag someone can have on a first date?</h2>

                            <!-- Swiper Carousel Container -->
                            <div class="post-image-carousel-container swiper post-swiper">
                                <div class="swiper-wrapper">
                                    <!-- Slide 1 -->
                                    <div class="swiper-slide position-relative">
                                        <img src="{{ asset('assets/images/about_tablet_use.png') }}"
                                            class="post-carousel-img" alt="Carousel Image">
                                        <div class="post-image-bottom-bar">
                                            <h4 class="post-image-label">[TEST] Timbuk2 Parkside 2.0 Laptop Backpack</h4>
                                            <a href="#" class="btn-post-image-learn">learn more</a>
                                        </div>
                                    </div>
                                    <!-- Slide 2 -->
                                    <div class="swiper-slide position-relative">
                                        <img src="{{ asset('assets/images/about_team_meeting.png') }}"
                                            class="post-carousel-img" alt="Carousel Image">
                                        <div class="post-image-bottom-bar">
                                            <h4 class="post-image-label">[TEST] Laptop Backpack Premium Edition</h4>
                                            <a href="#" class="btn-post-image-learn">learn more</a>
                                        </div>
                                    </div>
                                </div>
                                <!-- Carousel Arrow Controls -->
                                <button class="post-swiper-arrow post-arrow-left post-swiper-prev"><i
                                        class="fa-solid fa-chevron-left"></i></button>
                                <button class="post-swiper-arrow post-arrow-right post-swiper-next"><i
                                        class="fa-solid fa-chevron-right"></i></button>
                            </div>

                            <div class="post-footer-buttons">
                                <a href="#" class="post-pill-btn">Vote <i class="fa-solid fa-arrow-up"></i> <i
                                        class="fa-solid fa-arrow-down"></i></a>
                                <a href="#" class="post-pill-btn"><i class="fa-regular fa-comment"></i> 0</a>
                                <a href="#" class="post-pill-btn"><i class="fa-solid fa-arrow-up-from-bracket"></i>
                                    Share</a>
                            </div>
                        </div>

                        <!-- Related Communities section -->
                        <div class="related-communities-sec">
                            <h3 class="related-communities-title">Related communities</h3>
                            <div class="swiper related-communities-swiper" style="overflow: hidden; padding-bottom: 10px;">
                                <div class="swiper-wrapper">
                                    <!-- Slide 1 -->
                                    <div class="swiper-slide h-auto">
                                        <div class="community-card">
                                            <img src="{{ asset('assets/images/about_team_meeting.png') }}"
                                                class="community-card-avatar" alt="Avatar">
                                            <h4 class="community-card-name">lorem ipsum dumy needy</h4>
                                            <p class="community-card-desc">lorem ipsum dumy needy lorem ipsum dumy needy..</p>
                                            <a href="#" class="btn-community-join">Join <i
                                                    class="fa-solid fa-arrow-right-long"></i></a>
                                        </div>
                                    </div>
                                    <!-- Slide 2 -->
                                    <div class="swiper-slide h-auto">
                                        <div class="community-card">
                                            <img src="{{ asset('assets/images/about_professor_portrait.png') }}"
                                                class="community-card-avatar" alt="Avatar">
                                            <h4 class="community-card-name">lorem ipsum dumy needy</h4>
                                            <p class="community-card-desc">lorem ipsum dumy needy lorem ipsum dumy needy..</p>
                                            <a href="#" class="btn-community-join">Join <i
                                                    class="fa-solid fa-arrow-right-long"></i></a>
                                        </div>
                                    </div>
                                    <!-- Slide 3 -->
                                    <div class="swiper-slide h-auto">
                                        <div class="community-card">
                                            <img src="{{ asset('assets/images/about_tablet_use.png') }}"
                                                class="community-card-avatar" alt="Avatar">
                                            <h4 class="community-card-name">lorem ipsum dumy needy</h4>
                                            <p class="community-card-desc">lorem ipsum dumy needy lorem ipsum dumy needy..</p>
                                            <a href="#" class="btn-community-join">Join <i
                                                    class="fa-solid fa-arrow-right-long"></i></a>
                                        </div>
                                    </div>
                                    <!-- Slide 4 -->
                                    <div class="swiper-slide h-auto">
                                        <div class="community-card">
                                            <img src="{{ asset('assets/images/about_team_meeting.png') }}"
                                                class="community-card-avatar" alt="Avatar">
                                            <h4 class="community-card-name">lorem ipsum dumy needy</h4>
                                            <p class="community-card-desc">lorem ipsum dumy needy lorem ipsum dumy needy..</p>
                                            <a href="#" class="btn-community-join">Join <i
                                                    class="fa-solid fa-arrow-right-long"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <!-- Right Column: Sidebar Widgets -->
                    <div class="col-lg-4 col-12">

                        <!-- Widget 1: About community -->
                        <div class="sidebar-widget-card" style="background-color: #EBF3FC; border-color: #D2E4F9;">
                            <h3 class="widget-title-bold">Ask Enrollzy...</h3>
                            <p class="widget-desc-text">
                                is the place to ask and answer thought-provoking questions.
                            </p>
                              <div class="">
                            <h3 class="widget-title-bold"
                                style="border-bottom: 1px solid #EEEEEE; padding-bottom: 12px; margin-bottom: 16px;">Ask
                                ENROLLZY RULES</h3>
                            <div class="rules-list-box">
                                <!-- Rule 1 -->
                                <div class="rule-accordion-item active">
                                    <button class="rule-header-btn" onclick="toggleRule(this)">
                                        1. Rule 1 - Questions must be clear and direct and may not use the body textbox
                                        <i class="fa-solid fa-chevron-down rule-toggle-arrow"></i>
                                    </button>
                                    <div class="rule-body-panel" style="max-height: 100px;">
                                        <p class="rule-body-text">
                                            Please ensure all submitted questions are direct and fully written in the title
                                            bar.
                                            Do not submit blank questions or post questions that only reference
                                            descriptions.
                                        </p>
                                    </div>
                                </div>

                                <!-- Rule 2 -->
                                <div class="rule-accordion-item">
                                    <button class="rule-header-btn" onclick="toggleRule(this)">
                                        2. Rule 2 - No personal or professional advice requests
                                        <i class="fa-solid fa-chevron-down rule-toggle-arrow"></i>
                                    </button>
                                    <div class="rule-body-panel">
                                        <p class="rule-body-text">
                                            Avoid requests that ask for specific legal, medical, or financial advice. The
                                            community represents an academic forum.
                                        </p>
                                    </div>
                                </div>

                                <!-- Rule 3 -->
                                <div class="rule-accordion-item">
                                    <button class="rule-header-btn" onclick="toggleRule(this)">
                                        3. Rule 3 - Open ended questions only
                                        <i class="fa-solid fa-chevron-down rule-toggle-arrow"></i>
                                    </button>
                                    <div class="rule-body-panel">
                                        <p class="rule-body-text">
                                            Ask questions that prompt discussion and allow multiple expert perspectives to
                                            add
                                            value, rather than simple yes/no checks.
                                        </p>
                                    </div>
                                </div>

                                <!-- Rule 4 -->
                                <div class="rule-accordion-item">
                                    <button class="rule-header-btn" onclick="toggleRule(this)">
                                        4. Rule 4 - No personal info
                                        <i class="fa-solid fa-chevron-down rule-toggle-arrow"></i>
                                    </button>
                                    <div class="rule-body-panel">
                                        <p class="rule-body-text">
                                            Do not post email addresses, phone numbers, or private details to protect user
                                            privacy.
                                        </p>
                                    </div>
                                </div>

                                <!-- Rule 5 -->
                                <div class="rule-accordion-item">
                                    <button class="rule-header-btn" onclick="toggleRule(this)">
                                        5. Rule 5 - No loaded questions
                                        <i class="fa-solid fa-chevron-down rule-toggle-arrow"></i>
                                    </button>
                                    <div class="rule-body-panel">
                                        <p class="rule-body-text">
                                            Keep questions unbiased. Do not frame questions in a way that forces a specific
                                            viewpoint.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </div>

                        <!-- Widget 2: Rules Accordion -->
                      

                    </div>

                </div>
            </div>

        </div>
    </main>


    <!-- Interactive JavaScript logic for Post Swiper Carousels & Rules Accordion -->
    <script>
        // Rule Accordion Toggle Handler
        function toggleRule(header) {
            const item = header.parentElement;
            const panel = header.nextElementSibling;
            const isActive = item.classList.contains('active');

            // Close all other rule items
            document.querySelectorAll('.rule-accordion-item').forEach(el => {
                el.classList.remove('active');
                el.querySelector('.rule-body-panel').style.maxHeight = null;
            });

            // Toggle current rule item
            if (!isActive) {
                item.classList.add('active');
                panel.style.maxHeight = panel.scrollHeight + "px";
            }
        }

        // Initialize Swiper Carousels on Feed Posts
        document.addEventListener('DOMContentLoaded', function () {
            const postSwipers = document.querySelectorAll('.post-swiper');

            postSwipers.forEach((swiperEl, index) => {
                // Assign unique class names for arrows per swiper to prevent conflict
                const prevBtn = swiperEl.querySelector('.post-swiper-prev');
                const nextBtn = swiperEl.querySelector('.post-swiper-next');

                const prevClass = 'post-prev-' + index;
                const nextClass = 'post-next-' + index;

                prevBtn.classList.add(prevClass);
                nextBtn.classList.add(nextClass);

                new Swiper(swiperEl, {
                    slidesPerView: 1,
                    spaceBetween: 0,
                    loop: true,
                    navigation: {
                        nextEl: '.' + nextClass,
                        prevEl: '.' + prevClass,
                    }
                });
            });

            // Initialize Related Communities Swiper (3 full slides & 4th half slide on desktop)
            const relatedSwiperEl = document.querySelector('.related-communities-swiper');
            if (relatedSwiperEl) {
                new Swiper(relatedSwiperEl, {
                    slidesPerView: 1.2,
                    spaceBetween: 16,
                    breakpoints: {
                        576: {
                            slidesPerView: 2.2,
                            spaceBetween: 16
                        },
                        768: {
                            slidesPerView: 2.8,
                            spaceBetween: 20
                        },
                        1024: {
                            slidesPerView: 3.5,
                            spaceBetween: 24
                        }
                    }
                });
            }
        });
    </script>
@endsection