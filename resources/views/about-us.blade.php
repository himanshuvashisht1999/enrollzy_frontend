@extends('layouts.app')

@section('content')
<!-- Main Content Section -->
@php
    $defaultSections = ['hero', 'story', 'core_values', 'offers', 'features', 'impacts', 'founders', 'teams', 'advisory_board', 'cta'];
    $sections = (isset($about_page) && is_array($about_page->section_orders)) ? $about_page->section_orders : $defaultSections;
@endphp

@foreach($sections as $section)

    @if($section == 'hero')
        <!-- Hero Banner Section -->
        <main class="about-hero-section">
           <div class="bg-square">
                <img src="{{ asset('assets/images/banner-square-img.svg') }}" alt="">
            </div>
          <div class="container">
            <div class="about-hero-container">
              <img src="{{ $about_page->hero_image ? (str_starts_with($about_page->hero_image, 'http') ? $about_page->hero_image : rtrim(env('BACKEND_URL', 'http://127.0.0.1:8001'), '/') . '/' . ltrim($about_page->hero_image, '/')) : asset('assets/images/about-banner-img.png') }}" alt="" />

              <!-- Centered Badge -->
              <div class="about-us-badge-wrapper">
                <button class="about-us-badge">{{ $about_page->hero_subtitle ?? 'ABOUT US' }}</button>
              </div>

              <!-- Green Down Arrow Button -->
              <button class="about-scroll-btn" aria-label="Scroll Down">
                <img
                  style="width: 49px; height: 62px"
                  src="{{ asset('assets/images/inner-banner-down-arror.png') }}"
                  alt=""
                />
              </button>
            </div>
          </div>
        </main>

        <!-- Section 1: Simplify Education Decisions -->
        <section class="about-section ptb-70">
          <div class="container">
            <!-- Section Header -->
            <div class="text-center heading-card">
              <span class="marketplace-badge mb-3">{{ $about_page->hero_subtitle ?? 'About us' }}</span>
              <div
                class="heading-with-lines d-flex align-items-center justify-content-center gap-3 mb-3"
              >
                <span class="heading-line d-none d-md-block"></span>
                <h2 class="section-title mb-0">{{ $about_page->hero_title ?? 'We simplify education decisions.' }}</h2>
                <span class="heading-line d-none d-md-block"></span>
              </div>
              <p class="section-subtitle mx-auto text-muted" style="max-width: 900px">{{ $about_page->hero_tagline ?? 'From your first school admission to your first job offer — we cover every milestone of your education journey.' }}</p>
            </div>

            <!-- Split Card -->
            <div class="about-split-card about-border-orange">
              <div class="row g-5">
                <div class="col-lg-5 about-split-img-col">
                  <img
                    src="{{ $about_page->simplify_decisions_image ? (str_starts_with($about_page->simplify_decisions_image, 'http') ? $about_page->simplify_decisions_image : rtrim(env('BACKEND_URL', 'http://127.0.0.1:8001'), '/') . '/' . ltrim($about_page->simplify_decisions_image, '/')) : asset('assets/images/inner-about-img.png') }}"
                    alt="Tablet Checkout App Usage"
                    class="img-fluid"
                  />
                </div>
                <div class="col-lg-7 about-split-text-col">
                  <p>
                    {!! $about_page->hero_description ?? 'Enrollzy is a student-first education marketplace where learners can discover, compare, and access solutions for every stage of their academic journey—all in one place. Whether a student is looking for a boarding school, coaching institute, competitive exam guidance, scholarships, undergraduate or postgraduate programs, online degrees, certifications, or career-focused learning opportunities, Enrollzy connects them with the right options through a single, trusted platform. Our vision is to eliminate the confusion and fragmentation that students often face while making educational decisions. By bringing institutions, programs, services, resources, and guidance together in one ecosystem, we help students find answers to their educational needs quickly, transparently, and confidently. At Enrollzy, we believe that every student deserves access to reliable information, meaningful choices, expert guidance, and opportunities that support their growth. Through technology, data-driven insights, and a seamless user experience, we empower learners to make informed decisions and achieve their academic and career goals. Education is not a single decision—it is a continuous journey. Enrollzy is building the marketplace that supports students at every step, providing the right solutions, opportunities, and guidance whenever they need them.' !!}
                  </p>
                </div>
              </div>
            </div>
          </div>
        </section>

    @elseif($section == 'story')
        <!-- Section 2: Our Story -->
        <section class="about-section ptb-70">
          <div class="container">
            <!-- Section Header -->
            <div class="text-center heading-card">
              <span class="marketplace-badge mb-3">{{ $about_page->story_subtitle ?? 'OUR STORY' }}</span>
              <div
                class="heading-with-lines d-flex align-items-center justify-content-center gap-3 mb-3"
              >
                <span class="heading-line d-none d-md-block"></span>
                <h2 class="section-title mb-0">
                  {{ $about_page->story_title ?? "We've been that confused student. We built what we wished existed." }}
                </h2>
                <span class="heading-line d-none d-md-block"></span>
              </div>
              @if(isset($about_page->story_purpose_text))
                <p
                  class="section-subtitle mx-auto text-muted"
                  style="max-width: 900px"
                >
                  {{ $about_page->story_purpose_text }}
                </p>
              @endif
            </div>

            <!-- Split Card (Reversed columns on desktop for layout variety) -->
            <div
              class="about-split-card about-border-blue"
              style="background-color: #3771c814; border: 1px solid #3771c8"
            >
              <div class="row g-5 flex-lg-row-reverse">
                <div class="col-lg-5 about-split-img-col">
                  <img
                    src="{{ $about_page->story_image ? (str_starts_with($about_page->story_image, 'http') ? $about_page->story_image : rtrim(env('BACKEND_URL', 'http://127.0.0.1:8001'), '/') . '/' . ltrim($about_page->story_image, '/')) : asset('assets/images/about-our-story-img.png') }}"
                    alt="Enrollzy Founder Portrait"
                    class="img-fluid"
                  />
                </div>
                <div class="col-lg-7 about-split-text-col">
                  <p>
                    {!! $about_page->story_description ?? 'Every student reaches a point where they must make some of the most important decisions of their life — often with very little guidance. Questions begin early. Which college should I choose? Which entrance exam should I prepare for? Are scholarships available? What skills will improve my career opportunities? Where can I find information, I can trust? "We faced the same challenges ourselves" Like millions of students across India, we spent countless hours searching across multiple websites, comparing information, and trying to build a clear path forward. Admissions were on one platform, scholarships on another, career guidance elsewhere, and skill programs scattered across different portals. The information existed — but it was fragmented, difficult to discover, and overwhelming to navigate. That experience led to one realization: students do not lack ambition or opportunities — they often lack a single place where everything comes together. India has one of the world\'s largest education ecosystems, yet students still struggle to discover the right opportunities at the right time. Important decisions are often made with incomplete information, and valuable opportunities are missed simply because students never knew they existed. That realization became the foundation of Enrollzy. We set out to build a platform that simplifies educational decision-making and connects every stage of the learning journey. A place where students can discover, compare, and access the opportunities that help them move forward with confidence.' !!}
                  </p>
                </div>
              </div>
            </div>
          </div>
        </section>

    @elseif($section == 'core_values')
        <!-- Section 3: Mission, Vision & Philosophy Cards -->
        <section class="about-cards-section ptb-70">
          <div class="container">
            <div class="row g-4 justify-content-center">
              <!-- Card 1: Our Mission -->
              <div class="col-lg-4 col-md-6">
                <div class="about-mvp-card border-blue">
                  <div class="about-mvp-card-avatar">
                    <img
                      src="{{ $about_page->mission_image ? (str_starts_with($about_page->mission_image, 'http') ? $about_page->mission_image : rtrim(env('BACKEND_URL', 'http://127.0.0.1:8001'), '/') . '/' . ltrim($about_page->mission_image, '/')) : asset('assets/images/mentor-img-1.png') }}"
                      alt="Our Mission Mentor"
                    />
                  </div>
                  <h3 class="about-mvp-title blue-text">Our Mission</h3>
                  <div class="about-mvp-desc">{!! $about_page->mission_text ?? 'Our mission text goes here.' !!}</div>
                </div>
              </div>

              <!-- Card 2: Our Vision -->
              <div class="col-lg-4 col-md-6">
                <div class="about-mvp-card border-orange">
                  <div class="about-mvp-card-avatar">
                    <img
                      src="{{ $about_page->vision_image ? (str_starts_with($about_page->vision_image, 'http') ? $about_page->vision_image : rtrim(env('BACKEND_URL', 'http://127.0.0.1:8001'), '/') . '/' . ltrim($about_page->vision_image, '/')) : asset('assets/images/mentor-img-1.png') }}"
                      alt="Our Vision Mentor"
                    />
                  </div>
                  <h3 class="about-mvp-title orange-text">Our Vision</h3>
                  <div class="about-mvp-desc">{!! $about_page->vision_text ?? 'Our vision text goes here.' !!}</div>
                </div>
              </div>

              <!-- Card 3: Our Philosophy -->
              <div class="col-lg-4 col-md-6">
                <div class="about-mvp-card border-green">
                  <div class="about-mvp-card-avatar">
                    <img
                      src="{{ $about_page->philosophy_image ? (str_starts_with($about_page->philosophy_image, 'http') ? $about_page->philosophy_image : rtrim(env('BACKEND_URL', 'http://127.0.0.1:8001'), '/') . '/' . ltrim($about_page->philosophy_image, '/')) : asset('assets/images/mentor-img-1.png') }}"
                      alt="Our Philosophy Mentor"
                    />
                  </div>
                  <h3 class="about-mvp-title green-text">Our Philosophy</h3>
                  <div class="about-mvp-desc">{!! $about_page->philosophy_text ?? 'Our philosophy text goes here.' !!}</div>
                </div>
              </div>
            </div>
          </div>
        </section>

    @elseif($section == 'offers')
        <!-- Section 4: What We Offer (Dark Theme) -->
        <section class="about-dark-section mt-5 ptb-70">
          <div class="container">
            <!-- Section Header -->
            <div class="text-center heading-card">
              <span class="marketplace-badge mb-3">{{ $about_page->offers_subtitle ?? 'WHAT WE OFFER' }}</span>
              <div
                class="heading-with-lines d-flex align-items-center justify-content-center gap-3 mb-3"
              >
                <span class="heading-line d-none d-md-block"></span>
                <h2 class="section-title mb-0">{{ $about_page->offers_title ?? 'A Complete Education Ecosystem' }}</h2>
                <span class="heading-line d-none d-md-block"></span>
              </div>
              <p
                class="section-subtitle mx-auto text-muted"
                style="max-width: 900px"
              >
                {{ $about_page->offers_description ?? 'From your first school admission to your first job offer — we cover every milestone of your education journey.' }}
              </p>
            </div>

            <!-- Dark Cards Swiper -->
            <div class="swiper-container-wrapper" style="position: relative; padding: 0 45px;">
              <div
                class="swiper about-dark-swiper"
                style="overflow: hidden; padding: 20px 0px"
              >
                <div class="swiper-wrapper">
                  @if(isset($offers) && $offers->count() > 0)
                    @foreach($offers as $offer)
                      <div class="swiper-slide h-auto">
                        <div class="about-dark-card">
                          <div class="about-dark-card-icon">
                            @if($offer->icon_image)
                              <img src="{{ str_starts_with($offer->icon_image, 'http') ? $offer->icon_image : rtrim(env('BACKEND_URL', 'http://127.0.0.1:8001'), '/') . '/' . ltrim($offer->icon_image, '/') }}" alt="" />
                            @else
                              <img src="{{ asset('assets/images/offer-icon.png') }}" alt="" />
                            @endif
                          </div>
                          <h3 class="about-dark-card-title">{{ $offer->title }}</h3>
                          <p class="about-dark-card-desc">{{ $offer->description }}</p>
                        </div>
                      </div>
                    @endforeach
                  @endif
                </div>
                
                <!-- Pagination -->
                <div class="swiper-pagination" style="position: relative; margin-top: 25px;"></div>
              </div>

              <!-- Navigation Arrows -->
              <div class="swiper-button-next" style="color: #fff; right: 5px; top: 50%; transform: translateY(-50%); position: absolute; z-index: 10; font-size: 24px;"></div>
              <div class="swiper-button-prev" style="color: #fff; left: 5px; top: 50%; transform: translateY(-50%); position: absolute; z-index: 10; font-size: 24px;"></div>
            </div>
          </div>
        </section>

    @elseif($section == 'features')
        <!-- Section: Why Choose Enrollzy / Features -->
        @if(isset($features) && $features->count() > 0)
        <section class="about-section ptb-70" style="background-color: #f8f9fa;">
          <div class="container">
            <!-- Section Header -->
            <div class="text-center heading-card">
              <span class="marketplace-badge mb-3">{{ $about_page->features_subtitle ?? 'WHY CHOOSE US' }}</span>
              <div class="heading-with-lines d-flex align-items-center justify-content-center gap-3 mb-3">
                <span class="heading-line d-none d-md-block"></span>
                <h2 class="section-title mb-0">{{ $about_page->features_title ?? 'Why Choose Enrollzy' }}</h2>
                <span class="heading-line d-none d-md-block"></span>
              </div>
            </div>

            <div class="row g-4 mt-4">
              @foreach($features as $feature)
                <div class="col-lg-4 col-md-6">
                  <div class="about-mvp-card h-100" style="border: 1px solid #e3e6ef; border-radius: 12px; padding: 30px; background: #fff; box-shadow: 0 4px 20px rgba(0,0,0,0.05);">
                    <div class="about-dark-card-icon mb-3" style="width: 60px; height: 60px; display: flex; align-items: center; justify-content: center; background: rgba(55, 113, 200, 0.1); border-radius: 50%;">
                      @if($feature->icon_image)
                        <img src="{{ str_starts_with($feature->icon_image, 'http') ? $feature->icon_image : rtrim(env('BACKEND_URL', 'http://127.0.0.1:8001'), '/') . '/' . ltrim($feature->icon_image, '/') }}" alt="" style="width: 32px; height: 32px; object-fit: contain;" />
                      @else
                        <img src="{{ asset('assets/images/offer-icon.png') }}" alt="" style="width: 32px; height: 32px; object-fit: contain;" />
                      @endif
                    </div>
                    <h3 class="about-mvp-title blue-text" style="font-size: 20px; font-weight: 700; margin-bottom: 12px;">{{ $feature->title }}</h3>
                    <p class="about-mvp-desc" style="color: #6c757d; font-size: 15px; line-height: 1.6;">{{ $feature->description }}</p>
                  </div>
                </div>
              @endforeach
            </div>
          </div>
        </section>
        @endif

    @elseif($section == 'impacts')
        <!-- Section 5: Our Impact So Far -->
        @if(isset($impacts) && $impacts->count() > 0)
        <section class="about-impact-section ptb-70">
          <div class="container">
            <!-- Section Header -->
            <div class="text-center heading-card">
              <div
                class="heading-with-lines d-flex align-items-center justify-content-center gap-3 mb-3"
              >
                <span class="heading-line d-none d-md-block"></span>
                <h2 class="section-title mb-0 text-white">{{ $about_page->impacts_title ?? 'Our Impact So Far' }}</h2>
                <span class="heading-line d-none d-md-block"></span>
              </div>
            </div>

            <!-- Impact items row -->
            <div class="about-impact-container mt-5">
              @foreach($impacts as $key => $impact)
                <!-- Item -->
                <div class="about-impact-item">
                  <div class="about-impact-circle">
                    @if($impact->icon_image)
                      <img src="{{ str_starts_with($impact->icon_image, 'http') ? $impact->icon_image : rtrim(env('BACKEND_URL', 'http://127.0.0.1:8001'), '/') . '/' . ltrim($impact->icon_image, '/') }}" alt="" />
                    @else
                      <img src="{{ asset('assets/images/step-img-' . (($key % 4) + 1) . '.png') }}" alt="" />
                    @endif
                  </div>
                  <span class="about-impact-number">{{ $impact->count_text }}</span>
                  <span class="about-impact-label">{{ $impact->label }}</span>
                </div>

                @if(!$loop->last)
                  <!-- Arrow -->
                  <div class="about-impact-arrow">➔</div>
                @endif
              @endforeach
            </div>
          </div>
        </section>
        @endif

    @elseif($section == 'founders')
        <!-- Section 6: Meet Our Founders -->
        <section class="about-founders-section ptb-70">
          <div class="container">
            <!-- Section Header -->
            <div class="text-center heading-card">
              <div
                class="heading-with-lines d-flex align-items-center justify-content-center gap-3 mb-3"
              >
                <span class="heading-line d-none d-md-block"></span>
                <h2 class="section-title mb-0">{{ $about_page->founders_title ?? 'Meet Our Founders' }}</h2>
                <span class="heading-line d-none d-md-block"></span>
              </div>
            </div>

            <!-- Founders Grid -->
            <div class="row g-4 mt-2">
              <!-- Founder 1 -->
              <div class="col-lg-6">
                <div class="founder-card">
                  <div class="founder-card-top">
                    <div class="founder-img-wrapper">
                      <img
                        src="{{ $about_page->founder_1_image ? (str_starts_with($about_page->founder_1_image, 'http') ? $about_page->founder_1_image : rtrim(env('BACKEND_URL', 'http://127.0.0.1:8001'), '/') . '/' . ltrim($about_page->founder_1_image, '/')) : asset('assets/images/mentor-img-1.png') }}"
                        alt="{{ $about_page->founder_1_name }}"
                      />
                    </div>
                    <div class="founder-info">
                      <h3 class="founder-name">{{ $about_page->founder_1_name ?? 'Vinay Singh' }}</h3>
                      <p class="founder-role">{{ $about_page->founder_1_title ?? 'Founder' }}</p>
                      <div class="d-flex gap-2 mt-2">
                          @if($about_page->founder_1_linkedin)
                            <a href="{{ $about_page->founder_1_linkedin }}" class="founder-linkedin-btn" target="_blank" style="padding: 5px 10px;"> LinkedIn </a>
                          @endif
                          @if($about_page->founder_1_facebook)
                            <a href="{{ $about_page->founder_1_facebook }}" class="founder-linkedin-btn" target="_blank" style="padding: 5px 10px;"> Facebook </a>
                          @endif
                          @if($about_page->founder_1_twitter)
                            <a href="{{ $about_page->founder_1_twitter }}" class="founder-linkedin-btn" target="_blank" style="padding: 5px 10px;"> Twitter </a>
                          @endif
                      </div>
                    </div>
                  </div>
                  <div class="founder-desc mt-4">
                    {!! $about_page->founder_1_message ?? $about_page->founders_common_message !!}
                  </div>
                </div>
              </div>

              <!-- Founder 2 -->
              <div class="col-lg-6">
                <div class="founder-card">
                  <div class="founder-card-top">
                    <div class="founder-img-wrapper">
                      <img
                        src="{{ $about_page->founder_2_image ? (str_starts_with($about_page->founder_2_image, 'http') ? $about_page->founder_2_image : rtrim(env('BACKEND_URL', 'http://127.0.0.1:8001'), '/') . '/' . ltrim($about_page->founder_2_image, '/')) : asset('assets/images/mentor-img-1.png') }}"
                        alt="{{ $about_page->founder_2_name }}"
                      />
                    </div>
                    <div class="founder-info">
                      <h3 class="founder-name">{{ $about_page->founder_2_name ?? 'Amit Singh' }}</h3>
                      <p class="founder-role">{{ $about_page->founder_2_title ?? 'Founder' }}</p>
                      <div class="d-flex gap-2 mt-2">
                          @if($about_page->founder_2_linkedin)
                            <a href="{{ $about_page->founder_2_linkedin }}" class="founder-linkedin-btn" target="_blank" style="padding: 5px 10px;"> LinkedIn </a>
                          @endif
                          @if($about_page->founder_2_facebook)
                            <a href="{{ $about_page->founder_2_facebook }}" class="founder-linkedin-btn" target="_blank" style="padding: 5px 10px;"> Facebook </a>
                          @endif
                          @if($about_page->founder_2_twitter)
                            <a href="{{ $about_page->founder_2_twitter }}" class="founder-linkedin-btn" target="_blank" style="padding: 5px 10px;"> Twitter </a>
                          @endif
                      </div>
                    </div>
                  </div>
                  <div class="founder-desc mt-4">
                    {!! $about_page->founder_2_message ?? $about_page->founders_common_message !!}
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>

    @elseif($section == 'teams')
        <!-- Section 7: Our Team -->
        <section class="about-team-section ptb-70">
          <div class="container">
            <!-- Section Header -->
            <div class="text-center heading-card">
              <span class="marketplace-badge mb-3">{{ $about_page->team_subtitle ?? 'OUR TEAM' }}</span>
              <div
                class="heading-with-lines d-flex align-items-center justify-content-center gap-3 mb-3"
              >
                <span class="heading-line d-none d-md-block"></span>
                <h2 class="section-title mb-0">{{ $about_page->team_title ?? 'The People Behind Enrollzy' }}</h2>
                <span class="heading-line d-none d-md-block"></span>
              </div>
            </div>

            <!-- Team Cards Grid -->
            <div class="row g-4 row-cols-2 row-cols-md-4 mt-2">
              @if(isset($teams) && $teams->count() > 0)
                @foreach($teams as $team)
                <div class="col">
                  <div class="team-card">
                    <img
                      src="{{ $team->image ? (str_starts_with($team->image, 'http') ? $team->image : rtrim(env('BACKEND_URL', 'http://127.0.0.1:8001'), '/') . '/' . ltrim($team->image, '/')) : asset('assets/images/mentor-img-1.png') }}"
                      alt="{{ $team->name }}"
                      class="team-card-img"
                    />
                    <div class="team-card-body">
                      <h4 class="team-member-name">{{ $team->name }}</h4>
                      <span class="team-member-role">{{ $team->designation ?? $team->job_profile ?? 'Team Member' }}</span>
                    </div>
                  </div>
                </div>
                @endforeach
              @endif
            </div>
          </div>
        </section>

    @elseif($section == 'advisory_board')
        <!-- Section: Advisory Board -->
        @if(isset($advisory_boards) && $advisory_boards->count() > 0)
        <section class="about-team-section ptb-70" style="background-color: #fff;">
          <div class="container">
            <!-- Section Header -->
            <div class="text-center heading-card">
              <span class="marketplace-badge mb-3">{{ $about_page->advisory_subtitle ?? 'ADVISORY BOARD' }}</span>
              <div class="heading-with-lines d-flex align-items-center justify-content-center gap-3 mb-3">
                <span class="heading-line d-none d-md-block"></span>
                <h2 class="section-title mb-0">{{ $about_page->advisory_title ?? 'Our Advisory Board' }}</h2>
                <span class="heading-line d-none d-md-block"></span>
              </div>
            </div>

            <!-- Advisory Board Grid -->
            <div class="row g-4 row-cols-2 row-cols-md-4 mt-2">
              @foreach($advisory_boards as $board)
                <div class="col">
                  <div class="team-card">
                    <img
                      src="{{ $board->image ? (str_starts_with($board->image, 'http') ? $board->image : rtrim(env('BACKEND_URL', 'http://127.0.0.1:8001'), '/') . '/' . ltrim($board->image, '/')) : asset('assets/images/mentor-img-1.png') }}"
                      alt="{{ $board->name }}"
                      class="team-card-img"
                    />
                    <div class="team-card-body text-center">
                      <h4 class="team-member-name">{{ $board->name }}</h4>
                      <span class="team-member-role d-block mb-2">{{ $board->designation ?? 'Advisor' }}</span>
                      @if($board->linkedin_url)
                        <a href="{{ $board->linkedin_url }}" target="_blank" class="text-primary" style="font-size: 18px;"><i class="fab fa-linkedin"></i></a>
                      @endif
                    </div>
                  </div>
                </div>
              @endforeach
            </div>
          </div>
        </section>
        @endif

    @elseif($section == 'cta')
        <!-- Section: CTA Section -->
        @if(isset($about_page->cta_title))
        <section class="about-section ptb-70">
          <div class="container">
            <div class="p-4 p-md-5 rounded-4 text-white" style="background: linear-gradient(135deg, #3771c8 0%, #1e4b8f 100%); overflow: hidden;">
              <div class="row align-items-center g-4">
                <div class="col-lg-7">
                  <h2 class="fw-bold mb-3" style="font-size: 32px; line-height: 1.3;">{{ $about_page->cta_title }}</h2>
                  @if($about_page->cta_description)
                    <p class="mb-4 text-white-50" style="font-size: 16px; line-height: 1.6; max-width: 600px;">{{ $about_page->cta_description }}</p>
                  @endif
                  <div class="d-flex flex-wrap gap-3">
                    @if($about_page->cta_button_1_text && $about_page->cta_button_1_link)
                      <a href="{{ $about_page->cta_button_1_link }}" class="btn btn-light px-4 py-2.5 fw-bold" style="border-radius: 8px; color: #1e4b8f;">{{ $about_page->cta_button_1_text }}</a>
                    @endif
                    @if($about_page->cta_button_2_text && $about_page->cta_button_2_link)
                      <a href="{{ $about_page->cta_button_2_link }}" class="btn btn-outline-light px-4 py-2.5 fw-bold" style="border-radius: 8px;">{{ $about_page->cta_button_2_text }}</a>
                    @endif
                  </div>
                </div>
                @if($about_page->cta_image)
                  <div class="col-lg-5 text-center text-lg-end">
                    <img src="{{ str_starts_with($about_page->cta_image, 'http') ? $about_page->cta_image : rtrim(env('BACKEND_URL', 'http://127.0.0.1:8001'), '/') . '/' . ltrim($about_page->cta_image, '/') }}" alt="CTA Image" class="img-fluid rounded-3" style="max-height: 250px; object-fit: cover;" />
                  </div>
                @endif
              </div>
            </div>
          </div>
        </section>
        @endif

    @endif

@endforeach

    <script>
      document.addEventListener("DOMContentLoaded", function () {
        // About Dark Section Swiper
        const darkSectionSwiper = new Swiper(".about-dark-swiper", {
          slidesPerView: 1,
          spaceBetween: 24,
          loop: false,
          grabCursor: true,
          navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
          },
          pagination: {
            el: '.swiper-pagination',
            clickable: true,
          },
          breakpoints: {
            576: {
              slidesPerView: 2,
            },
            992: {
              slidesPerView: 2.8,
            },
          },
        });
      });
    </script>
@endsection
