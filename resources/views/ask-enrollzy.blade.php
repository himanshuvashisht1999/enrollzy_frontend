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
                            @php
                                $headerAvatar = asset('assets/images/mentor_1.png');
                                if ($selectedCategory && !empty($selectedCategory->image)) {
                                    if (str_starts_with($selectedCategory->image, 'http')) {
                                        $headerAvatar = $selectedCategory->image;
                                    } elseif (file_exists(public_path('storage/' . $selectedCategory->image))) {
                                        $headerAvatar = asset('storage/' . $selectedCategory->image);
                                    } elseif (file_exists(base_path('../enrollzy_backend/public/storage/' . $selectedCategory->image))) {
                                        $headerAvatar = 'http://127.0.0.1:8001/storage/' . $selectedCategory->image;
                                    } else {
                                        $headerAvatar = asset('storage/' . $selectedCategory->image);
                                    }
                                }
                            @endphp
                            <img src="{{ $headerAvatar }}" alt="Community Profile" onError="this.src='{{ asset('assets/images/mentor_1.png') }}'">
                        </div>
                        <div class="flex-grow-1 text-center text-lg-start">
                            <h1 class="ask-community-name mb-0">{{ $selectedCategory->name ?? 'AskEnrollzy' }}</h1>
                            @if($selectedCategory)
                                <p class="text-muted small mb-0 mt-1" style="max-width: 600px; font-size: 0.85rem;">{{ \Illuminate\Support\Str::limit($selectedCategory->description, 110) }}</p>
                            @endif
                        </div>
                        <div class="d-flex gap-2 align-items-center">
                            <button type="button" class="btn-create-post border-0 text-decoration-none cursor-pointer" data-bs-toggle="modal" data-bs-target="#createPostModal">
                                <i class="fa-solid fa-plus"></i> Create Post
                            </button>
                            <a href="#" class="btn-join-community">Join</a>
                        </div>
                    </div>

                   
                </div>
            </section>

            <!-- 2. Main content Layout grid -->
            <div class="container py-4">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show rounded-4 shadow-sm border-0 mb-3" role="alert">
                        <i class="fa-solid fa-circle-check me-2"></i> {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <div class="row g-4">
                    <!-- Sort/Dropdown Option -->
                    <div class="col-lg-12 col-12">
                        <div class="mt-4 d-flex justify-content-between align-items-center flex-wrap gap-2">
                            <div class="dropdown">
                                <button class="filter-sort-btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    {{ ucfirst($sort ?? 'New') }} <i class="fa-solid fa-chevron-down ms-1"></i>
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item {{ ($sort ?? 'new') == 'new' ? 'active' : '' }}" href="{{ route('ask.enrollzy', array_merge(request()->query(), ['sort' => 'new'])) }}">New</a></li>
                                    <li><a class="dropdown-item {{ ($sort ?? '') == 'popular' ? 'active' : '' }}" href="{{ route('ask.enrollzy', array_merge(request()->query(), ['sort' => 'popular'])) }}">Popular</a></li>
                                </ul>
                            </div>
                            @if(request()->filled('category'))
                                <a href="{{ route('ask.enrollzy') }}" class="btn btn-sm btn-outline-secondary">
                                    <i class="fa-solid fa-times me-1"></i> Clear Category Filter
                                </a>
                            @endif
                        </div>
                    </div>
                   

                    <!-- Left Main Column: Post Feed -->
                    <div class="col-lg-8 col-12">

                        @forelse($questions as $question)
                            <div class="post-card">
                                <div class="post-header">
                                    <div class="d-flex align-items-center gap-2">
                                        @php
                                            $avatar = asset('assets/images/team_member_1.png');
                                            if (!empty($question->user->avatar)) {
                                                $avatar = str_starts_with($question->user->avatar, 'http') ? $question->user->avatar : asset('storage/' . $question->user->avatar);
                                            }
                                        @endphp
                                        <img src="{{ $avatar }}" class="post-author-avatar" alt="Avatar" onError="this.src='{{ asset('assets/images/team_member_1.png') }}'">
                                        <span class="post-author-name">{{ $question->user->name ?? 'Enrollzy Member' }}</span>
                                        <span class="post-time">• {{ $question->created_at ? $question->created_at->diffForHumans() : '1 min ago' }}</span>
                                        @if($question->category)
                                            <span class="badge bg-light text-dark ms-2 fw-normal" style="font-size: 0.75rem;">{{ $question->category->name }}</span>
                                        @endif
                                    </div>
                                    <button class="post-dots-menu"><i class="fa-solid fa-ellipsis"></i></button>
                                </div>
                                <h2 class="post-title">
                                    <a href="{{ route('ask.enrollzy.detail', $question->id) }}" class="text-decoration-none text-dark hover-primary">
                                        {{ $question->question_text }}
                                    </a>
                                </h2>

                                @if(!empty($question->image))
                                    @php
                                        $imgUrl = asset('storage/' . $question->image);
                                        if (str_starts_with($question->image, 'http')) {
                                            $imgUrl = $question->image;
                                        } elseif (file_exists(public_path('assets/images/' . $question->image))) {
                                            $imgUrl = asset('assets/images/' . $question->image);
                                        }
                                    @endphp
                                    <div class="post-image-carousel-container swiper post-swiper">
                                        <div class="swiper-wrapper">
                                            <div class="swiper-slide position-relative">
                                                <img src="{{ $imgUrl }}" class="post-carousel-img" alt="Post Image">
                                                <div class="post-image-bottom-bar">
                                                    <h4 class="post-image-label">{{ $question->question_text }}</h4>
                                                    <a href="{{ route('ask.enrollzy.detail', $question->id) }}" class="btn-post-image-learn">learn more</a>
                                                </div>
                                            </div>
                                        </div>
                                        <button class="post-swiper-arrow post-arrow-left post-swiper-prev"><i class="fa-solid fa-chevron-left"></i></button>
                                        <button class="post-swiper-arrow post-arrow-right post-swiper-next"><i class="fa-solid fa-chevron-right"></i></button>
                                    </div>
                                @endif

                                <div class="post-footer-buttons">
                                    <a href="#" class="post-pill-btn btn-vote-toggle" data-question-id="{{ $question->id }}"><i class="fa-solid fa-arrow-up text-primary"></i> <span class="vote-count-span">{{ $question->likes_count ?? ($question->likes ? $question->likes->count() : 0) }}</span> <i class="fa-solid fa-arrow-down"></i></a>
                                    <a href="{{ route('ask.enrollzy.detail', $question->id) }}" class="post-pill-btn"><i class="fa-regular fa-comment"></i> {{ $question->replies_count ?? ($question->replies ? $question->replies->count() : 0) }}</a>
                                    <a href="#" class="post-pill-btn btn-report-post" data-question-id="{{ $question->id }}"><i class="fa-regular fa-flag"></i></a>
                                    <a href="#" class="post-pill-btn btn-share-post" data-share-url="{{ route('ask.enrollzy.detail', $question->id) }}"><i class="fa-solid fa-arrow-up-from-bracket"></i> Share</a>
                                </div>
                            </div>
                        @empty
                            <div class="post-card text-center py-5">
                                <i class="fa-regular fa-comments fa-3x text-muted mb-3"></i>
                                <h4>No questions found</h4>
                                <p class="text-muted">Be the first to ask a question in the community!</p>
                            </div>
                        @endforelse

                        @if($questions->hasPages())
                            <div class="d-flex justify-content-center my-4">
                                {{ $questions->withQueryString()->links() }}
                            </div>
                        @endif

                        <!-- Related Communities section -->
                        <div class="related-communities-sec">
                            <style>
                                .related-nav-btn {
                                    width: 36px;
                                    height: 36px;
                                    border-radius: 50%;
                                    border: 1px solid #E2E8F0;
                                    background-color: #FFFFFF;
                                    color: #0D1B2A;
                                    display: inline-flex;
                                    align-items: center;
                                    justify-content: center;
                                    transition: all 0.2s ease;
                                    cursor: pointer;
                                    box-shadow: 0px 2px 5px rgba(0,0,0,0.05);
                                }
                                .related-nav-btn:hover {
                                    background-color: #3771C8;
                                    color: #FFFFFF;
                                    border-color: #3771C8;
                                }
                                .related-nav-btn.swiper-button-disabled {
                                    opacity: 0.4;
                                    cursor: not-allowed;
                                    background-color: #F8FAFC;
                                    color: #A0AEC0;
                                    border-color: #E2E8F0;
                                }
                            </style>
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h3 class="related-communities-title mb-0">Related communities</h3>
                                <div class="d-flex gap-2 align-items-center">
                                    <button type="button" class="related-nav-btn related-swiper-prev" aria-label="Previous Slide">
                                        <i class="fa-solid fa-chevron-left"></i>
                                    </button>
                                    <button type="button" class="related-nav-btn related-swiper-next" aria-label="Next Slide">
                                        <i class="fa-solid fa-chevron-right"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="swiper related-communities-swiper" style="overflow: hidden; padding-bottom: 10px;">
                                <div class="swiper-wrapper">
                                    @forelse($categories as $index => $cat)
                                        @php
                                            $avatars = [
                                                'about_team_meeting.png',
                                                'about_professor_portrait.png',
                                                'about_tablet_use.png'
                                            ];
                                            $catAvatar = asset('assets/images/' . $avatars[$index % count($avatars)]);
                                            if (!empty($cat->image)) {
                                                if (str_starts_with($cat->image, 'http')) {
                                                    $catAvatar = $cat->image;
                                                } elseif (file_exists(public_path('storage/' . $cat->image))) {
                                                    $catAvatar = asset('storage/' . $cat->image);
                                                } elseif (file_exists(base_path('../enrollzy_backend/public/storage/' . $cat->image))) {
                                                    $catAvatar = 'http://127.0.0.1:8001/storage/' . $cat->image;
                                                }
                                            }
                                        @endphp
                                        <div class="swiper-slide h-auto">
                                            <div class="community-card">
                                                <img src="{{ $catAvatar }}" class="community-card-avatar" alt="Avatar">
                                                <h4 class="community-card-name">{{ $cat->name }}</h4>
                                                <p class="community-card-desc">{{ \Illuminate\Support\Str::limit($cat->description ?? 'Discuss academic topics, placements and college choices.', 80) }}</p>
                                                <a href="{{ route('ask.enrollzy', ['category' => $cat->id]) }}" class="btn-community-join">Join <i class="fa-solid fa-arrow-right-long"></i></a>
                                            </div>
                                        </div>
                                    @empty
                                        <div class="swiper-slide h-auto">
                                            <div class="community-card">
                                                <img src="{{ asset('assets/images/about_team_meeting.png') }}" class="community-card-avatar" alt="Avatar">
                                                <h4 class="community-card-name">General Discussion</h4>
                                                <p class="community-card-desc">Discuss student topics and career choices.</p>
                                                <a href="#" class="btn-community-join">Join <i class="fa-solid fa-arrow-right-long"></i></a>
                                            </div>
                                        </div>
                                    @endforelse
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
                                @foreach($rules as $index => $rule)
                                    <div class="rule-accordion-item {{ $index === 0 ? 'active' : '' }}">
                                        <button class="rule-header-btn" onclick="toggleRule(this)">
                                            {{ $rule['title'] }}
                                            <i class="fa-solid fa-chevron-down rule-toggle-arrow"></i>
                                        </button>
                                        <div class="rule-body-panel" style="{{ $index === 0 ? 'max-height: 100px;' : '' }}">
                                            <p class="rule-body-text">
                                                {{ $rule['body'] }}
                                            </p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        </div>

                    </div>                <!-- Widget 2: Rules Accordion -->
                      

                    </div>

                </div>
            </div>

        </div>
    </main>


    <!-- Create Post Modal -->
    <div class="modal fade" id="createPostModal" tabindex="-1" aria-labelledby="createPostModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow rounded-4">
                <div class="modal-header border-bottom-0 pb-0">
                    <h5 class="modal-title fw-bold" id="createPostModalLabel" style="color: #3771C8;">
                        <i class="fa-solid fa-pen-to-square me-2"></i> Ask a Question
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('ask.enrollzy.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body py-3">
                        <div class="mb-3">
                            <label class="form-label fw-semibold text-dark small">Select Category</label>
                            <select name="category_id" class="form-select rounded-3" required>
                                <option value="" disabled selected>Choose a category for your question</option>
                                @foreach($categories as $cat)
                                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold text-dark small">Question Title / Text</label>
                            <textarea name="question_text" class="form-control rounded-3" rows="4" placeholder="What's your question? Be clear and direct..." required></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold text-dark small">Attach Image (Optional)</label>
                            <input type="file" name="image" class="form-control rounded-3" accept="image/*">
                        </div>
                    </div>
                    <div class="modal-footer border-top-0 pt-0">
                        <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary rounded-pill px-4 fw-bold" style="background-color: #3771C8; border: none;">
                            <i class="fa-solid fa-paper-plane me-1"></i> Post Question
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

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

            // Initialize Related Communities Swiper (with Left/Right Navigation Arrows & Drag/Scroll)
            const relatedSwiperEl = document.querySelector('.related-communities-swiper');
            if (relatedSwiperEl) {
                new Swiper(relatedSwiperEl, {
                    slidesPerView: 1.2,
                    spaceBetween: 16,
                    grabCursor: true,
                    navigation: {
                        nextEl: '.related-swiper-next',
                        prevEl: '.related-swiper-prev',
                    },
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
            // Handle Vote Toggle AJAX
            document.querySelectorAll('.btn-vote-toggle').forEach(btn => {
                btn.addEventListener('click', function(e) {
                    e.preventDefault();
                    const qId = this.getAttribute('data-question-id');
                    const countSpan = this.querySelector('.vote-count-span');

                    fetch("{{ route('ask.enrollzy.like') }}", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                            "X-CSRF-TOKEN": "{{ csrf_token() }}"
                        },
                        body: JSON.stringify({ question_id: qId })
                    })
                    .then(res => res.json())
                    .then(data => {
                        if (data.success && countSpan) {
                            countSpan.textContent = data.likes_count;
                        }
                    })
                    .catch(err => console.error(err));
                });
            });

            // Handle Share Post
            document.querySelectorAll('.btn-share-post').forEach(btn => {
                btn.addEventListener('click', function(e) {
                    e.preventDefault();
                    const shareUrl = this.getAttribute('data-share-url') || window.location.href;
                    navigator.clipboard.writeText(shareUrl).then(() => {
                        alert("Question link copied to clipboard!");
                    });
                });
            });

            // Handle Report Post
            document.querySelectorAll('.btn-report-post').forEach(btn => {
                btn.addEventListener('click', function(e) {
                    e.preventDefault();
                    alert("Thank you! Question has been reported to Enrollzy community moderators for review.");
                });
            });

            // Handle Join Community
            document.querySelectorAll('.btn-join-community').forEach(btn => {
                btn.addEventListener('click', function(e) {
                    e.preventDefault();
                    if (this.textContent.trim() === 'Join') {
                        this.textContent = 'Joined';
                        this.style.backgroundColor = '#28a745';
                        this.style.borderColor = '#28a745';
                        this.style.color = '#ffffff';
                    } else {
                        this.textContent = 'Join';
                        this.style.backgroundColor = '';
                        this.style.borderColor = '';
                        this.style.color = '';
                    }
                });
            });
        });
    </script>
@endsection