@extends('layouts.app')

@section('content')
<main class="about-hero-section ptb-70">
      <div class="bg-square">
        <img src="assets/images/banner-square-img.svg" alt="" />
      </div>
      <div class="container">
        <div class="about-hero-container">
          <img src="assets/images/faq-banner-bg.png" alt="" />

          <!-- Centered Badge (Placed outside card to prevent clipping) -->
          <div class="about-us-badge-wrapper">
            <button class="about-us-badge">FAQs</button>
            <p>
             Find answers to common questions about our platform and services.
            </p>
          </div>

          <!-- Green Down Arrow Button -->
          <button class="about-scroll-btn" aria-label="Scroll Down">
            <img
              style="width: 49px; height: 62px"
              src="assets/images/inner-banner-down-arror.png"
              alt=""
            />
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
                    <li class="breadcrumb-item active text-primary" aria-current="page">FAQ</li>
                </ol>
            </nav>
        </div>
    </div>

    <!-- Main Content Grid -->
    <div class="ptb-70">
        <div class="container">
            
            <!-- Section Header -->
            <div class="text-center heading-card">
          <div
            class="heading-with-lines d-flex align-items-center justify-content-center gap-3 mb-3"
          >
            <span class="heading-line d-none d-md-block"></span>
            <h2 class="section-title mb-0">Frequently Asked Questions</h2>
            <span class="heading-line d-none d-md-block"></span>
          </div>
          
        </div>

            <div class="row g-4 mt-2">
                <!-- Left Sidebar Column -->
                <div class="col-lg-4 col-md-4">
                    <div class="faq-search-wrapper">
                        <i class="fa-solid fa-magnifying-glass"></i>
                        <input type="text" placeholder="Search" class="form-control">
                    </div>

                    <ul class="faq-topic-list">
                        @foreach($categories as $index => $category)
                        <li class="faq-topic-item {{ $index === 0 ? 'active' : '' }}" data-category-id="{{ $category->id }}">{{ $category->name }}</li>
                        @endforeach
                    </ul>

                    <div class="faq-contact-widget">
                        <h4 class="faq-contact-title">Still have a questions?</h4>
                        <p class="faq-contact-text">if you didn't find your answer, feel free to reach out.</p>
                        <button class="btn-faq-contact">Contact Support</button>
                    </div>
                </div>

                <!-- Right Accordion Column -->
                <div class="col-lg-8 col-md-8">
                    <div class="faq-active-badge">{{ $categories->count() > 0 ? $categories->first()->name : 'FAQs' }}</div>

                    <div class="accordion" id="faqAccordion">
                        @foreach($categories as $index => $category)
                            <div class="faq-category-content" id="content-{{ $category->id }}" style="display: {{ $index === 0 ? 'block' : 'none' }};">
                                @if($category->faqs->count() > 0)
                                    @foreach($category->faqs as $faqIndex => $faq)
                                        <div class="faq-accordion-item faq-search-item">
                                            <div class="faq-accordion-header {{ $index === 0 && $faqIndex === 0 ? '' : 'collapsed' }}" data-bs-toggle="collapse" data-bs-target="#faq-collapse-{{ $faq->id }}" aria-expanded="{{ $index === 0 && $faqIndex === 0 ? 'true' : 'false' }}">
                                                <span class="faq-question-text">{{ $faq->question }}</span>
                                                <i class="fa-solid {{ $index === 0 && $faqIndex === 0 ? 'fa-minus' : 'fa-plus' }} text-muted" style="font-size: 13px;"></i>
                                            </div>
                                            <div id="faq-collapse-{{ $faq->id }}" class="collapse {{ $index === 0 && $faqIndex === 0 ? 'show' : '' }}" data-bs-parent="#faqAccordion">
                                                <div class="faq-accordion-content faq-answer-text">
                                                    {!! nl2br(e($faq->answer)) !!}
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="text-center py-5">
                                        <p class="text-muted">No FAQs found for this category.</p>
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

                </div>
            </div>

        </div>
    </div>

  
    <!-- Bootstrap Bundle JS -->
    

    <!-- Swiper Slider JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Hero Image Swiper
            const heroSwiper = new Swiper('.hero-swiper', {
                slidesPerView: 1,
                spaceBetween: 0,
                loop: true,
                autoplay: {
                    delay: 4000,
                    disableOnInteraction: false,
                },
                pagination: {
                    el: '.carousel-dots',
                    bulletClass: 'dot',
                    bulletActiveClass: 'active',
                    clickable: true,
                }
            });

            // Student Insights & Feedback Swiper
            const feedbackSwiper = new Swiper('.feedback-swiper', {
                slidesPerView: 1,
                spaceBetween: 24,
                loop: true,
                navigation: {
                    nextEl: '.feedback-next-btn',
                    prevEl: '.feedback-prev-btn',
                },
                breakpoints: {
                    768: {
                        slidesPerView: 2,
                    },
                    992: {
                        slidesPerView: 3,
                    }
                }
            });
        });
        (function () {
            const slider = document.getElementById('perfectUnivTabs');
            if (!slider) return;
            let isDown = false;
            let startX;
            let scrollLeft;
            let moved = false;

            slider.addEventListener('mousedown', (e) => {
                isDown = true;
                moved = false;
                slider.classList.add('dragging');
                startX = e.pageX - slider.offsetLeft;
                scrollLeft = slider.scrollLeft;
            });

            slider.addEventListener('mouseleave', () => {
                isDown = false;
                slider.classList.remove('dragging');
            });

            slider.addEventListener('mouseup', () => {
                isDown = false;
                slider.classList.remove('dragging');
            });

            slider.addEventListener('mousemove', (e) => {
                if (!isDown) return;
                e.preventDefault();
                const x = e.pageX - slider.offsetLeft;
                const walk = x - startX;
                if (Math.abs(walk) > 5) moved = true; // threshold so clicks still register as clicks
                slider.scrollLeft = scrollLeft - walk;
            });

            // Prevent tab click from firing right after a drag
            slider.addEventListener('click', (e) => {
                if (moved) {
                    e.preventDefault();
                    e.stopPropagation();
                }
            }, true);
        })();
        (function () {
            const megaMenu = document.querySelector('.mega-menu-wrapper');
            if (!megaMenu) return;

            const triggerItems = document.querySelectorAll('.nav-item[data-tab-trigger]');
            let hideTimeout;

            function showMenu(tabId) {
                clearTimeout(hideTimeout);
                megaMenu.classList.add('show-mega');

                // Switch tab sidebar and content panel
                const sidebarItem = megaMenu.querySelector(`.mega-sidebar-item[data-mega-tab="${tabId}"]`);
                if (sidebarItem) {
                    // Remove active classes
                    megaMenu.querySelectorAll('.mega-sidebar-item').forEach(i => i.classList.remove('active'));
                    megaMenu.querySelectorAll('.mega-tab-content').forEach(pane => pane.classList.remove('active'));

                    // Set active
                    sidebarItem.classList.add('active');
                    const targetPane = megaMenu.querySelector('#' + tabId);
                    if (targetPane) {
                        targetPane.classList.add('active');
                    }
                }
            }

            function hideMenu() {
                hideTimeout = setTimeout(() => {
                    megaMenu.classList.remove('show-mega');
                }, 150); // delay to allow moving between trigger and menu
            }

            triggerItems.forEach(item => {
                item.addEventListener('mouseenter', function () {
                    const tabId = this.getAttribute('data-tab-trigger');
                    showMenu(tabId);
                });

                item.addEventListener('mouseleave', function () {
                    hideMenu();
                });
            });

            megaMenu.addEventListener('mouseenter', function () {
                clearTimeout(hideTimeout);
            });

            megaMenu.addEventListener('mouseleave', function () {
                hideMenu();
            });

            // Mega Menu inner sidebar tab switching on hover
            const sidebarItems = megaMenu.querySelectorAll('.mega-sidebar-item');
            sidebarItems.forEach(item => {
                item.addEventListener('mouseenter', function () {
                    // Remove active classes inside menu
                    megaMenu.querySelectorAll('.mega-sidebar-item').forEach(i => i.classList.remove('active'));
                    megaMenu.querySelectorAll('.mega-tab-content').forEach(pane => pane.classList.remove('active'));

                    // Set active
                    this.classList.add('active');
                    const targetTabId = this.getAttribute('data-mega-tab');
                    const targetPane = megaMenu.querySelector('#' + targetTabId);
                    if (targetPane) {
                        targetPane.classList.add('active');
                    }
                });
            });
        })();

        // FAQ Accordions and Topic Switcher logic
        document.addEventListener('DOMContentLoaded', function () {
            // Topics switcher
            const topicItems = document.querySelectorAll('.faq-topic-item');
            const activeBadge = document.querySelector('.faq-active-badge');
            const categoryContents = document.querySelectorAll('.faq-category-content');
            
            topicItems.forEach(item => {
                item.addEventListener('click', function () {
                    // Update active class
                    topicItems.forEach(t => t.classList.remove('active'));
                    this.classList.add('active');
                    
                    // Update active category badge text
                    if (activeBadge) {
                        activeBadge.textContent = this.textContent;
                    }
                    
                    // Show/hide category content
                    const categoryId = this.getAttribute('data-category-id');
                    categoryContents.forEach(content => {
                        content.style.display = 'none';
                        if (content.id === 'content-' + categoryId) {
                            content.style.display = 'block';
                        }
                    });
                });
            });

            // Search logic
            const searchInput = document.querySelector('.faq-search-wrapper input');
            if(searchInput) {
                searchInput.addEventListener('input', function() {
                    const query = this.value.toLowerCase().trim();
                    const faqItems = document.querySelectorAll('.faq-search-item');
                    
                    if (query === '') {
                        // Reset search
                        faqItems.forEach(item => item.style.display = 'block');
                        const activeItem = document.querySelector('.faq-topic-item.active');
                        if (activeItem) activeItem.click();
                        return;
                    }

                    // Hide all category constraints and badge
                    categoryContents.forEach(content => content.style.display = 'block');
                    topicItems.forEach(t => t.classList.remove('active'));
                    if (activeBadge) activeBadge.textContent = 'Search Results';

                    faqItems.forEach(item => {
                        const qText = item.querySelector('.faq-question-text').textContent.toLowerCase();
                        const aText = item.querySelector('.faq-answer-text').textContent.toLowerCase();
                        if (qText.includes(query) || aText.includes(query)) {
                            item.style.display = 'block';
                        } else {
                            item.style.display = 'none';
                        }
                    });
                });
            }

            // Bootstrap accordion icon toggle
            const faqAccordion = document.getElementById('faqAccordion');
            if (faqAccordion) {
                faqAccordion.addEventListener('show.bs.collapse', function (e) {
                    const header = e.target.previousElementSibling;
                    if (header) {
                        const icon = header.querySelector('i');
                        if (icon) {
                            icon.classList.replace('fa-plus', 'fa-minus');
                        }
                    }
                });

                faqAccordion.addEventListener('hide.bs.collapse', function (e) {
                    const header = e.target.previousElementSibling;
                    if (header) {
                        const icon = header.querySelector('i');
                        if (icon) {
                            icon.classList.replace('fa-minus', 'fa-plus');
                        }
                    }
                });
            }
        });
    </script>

@endsection