@extends('layouts.app')

@section('content')
<!-- Main Content Section -->
    <main class="about-hero-section">
       <div class="bg-square">
            <img src="{{ asset('assets/images/banner-square-img.svg') }}" alt="">
        </div>
      <div class="container">
        <div class="about-hero-container">
          <img src="{{ asset('assets/images/about-banner-img.png') }}" alt="" />

          <!-- Centered Badge (Placed outside card to prevent clipping) -->
          <div class="about-us-badge-wrapper">
            <button class="about-us-badge">ABOUT US</button>
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
          <p class="section-subtitle mx-auto text-muted" style="max-width: 900px">{{ $about_page->hero_description ?? 'From your first school admission to your first job offer — we cover every milestone of your education journey.' }}</p>
        </div>

        <!-- Split Card -->
        <div class="about-split-card about-border-orange">
          <div class="row g-5">
            <div class="col-lg-5 about-split-img-col">
              <img
                src="{{ asset('assets/images/inner-about-img.png') }}"
                alt="Tablet Checkout App Usage"
                class="img-fluid"
              />
            </div>
            <div class="col-lg-7 about-split-text-col">
              <p>
                Enrollzy is a student-first education marketplace where learners
                can discover, compare, and access solutions for every stage of
                their academic journey—all in one place. Whether a student is
                looking for a boarding school, coaching institute, competitive
                exam guidance, scholarships, undergraduate or postgraduate
                programs, online degrees, certifications, or career-focused
                learning opportunities, Enrollzy connects them with the right
                options through a single, trusted platform. Our vision is to
                eliminate the confusion and fragmentation that students often
                face while making educational decisions. By bringing
                institutions, programs, services, resources, and guidance
                together in one ecosystem, we help students find answers to
                their educational needs quickly, transparently, and confidently.
                At Enrollzy, we believe that every student deserves access to
                reliable information, meaningful choices, expert guidance, and
                opportunities that support their growth. Through technology,
                data-driven insights, and a seamless user experience, we empower
                learners to make informed decisions and achieve their academic
                and career goals. Education is not a single decision—it is a
                continuous journey. Enrollzy is building the marketplace that
                supports students at every step, providing the right solutions,
                opportunities, and guidance whenever they need them.
              </p>
            </div>
          </div>
        </div>
      </div>
    </section>

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
              We've been that confused student. We built <br />
              what we wished existed.
            </h2>
            <span class="heading-line d-none d-md-block"></span>
          </div>
          <p
            class="section-subtitle mx-auto text-muted"
            style="max-width: 900px"
          >
            From your first school admission to your first job offer — we cover
            every milestone of your education journey.
          </p>
        </div>

        <!-- Split Card (Reversed columns on desktop for layout variety) -->
        <div
          class="about-split-card about-border-blue"
          style="background-color: #3771c814; border: 1px solid #3771c8"
        >
          <div class="row g-5 flex-lg-row-reverse">
            <div class="col-lg-5 about-split-img-col">
              <img
                src="{{ asset('assets/images/about-our-story-img.png') }}"
                alt="Enrollzy Founder Portrait"
                class="img-fluid"
              />
            </div>
            <div class="col-lg-7 about-split-text-col">
              <p>
                Every student reaches a point where they must make some of the
                most important decisions of their life — often with very little
                guidance. Questions begin early. Which college should I choose?
                Which entrance exam should I prepare for? Are scholarships
                available? What skills will improve my career opportunities?
                Where can I find information, I can trust? "We faced the same
                challenges ourselves" Like millions of students across India, we
                spent countless hours searching across multiple websites,
                comparing information, and trying to build a clear path forward.
                Admissions were on one platform, scholarships on another, career
                guidance elsewhere, and skill programs scattered across
                different portals. The information existed — but it was
                fragmented, difficult to discover, and overwhelming to navigate.
                That experience led to one realization: students do not lack
                ambition or opportunities — they often lack a single place where
                everything comes together. India has one of the world's largest
                education ecosystems, yet students still struggle to discover
                the right opportunities at the right time. Important decisions
                are often made with incomplete information, and valuable
                opportunities are missed simply because students never knew they
                existed. That realization became the foundation of Enrollzy. We
                set out to build a platform that simplifies educational
                decision-making and connects every stage of the learning
                journey. A place where students can discover, compare, and
                access the opportunities that help them move forward with
                confidence. Whether someone is searching for a school, college,
                university, coaching institute, scholarship, degree program...
              </p>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Section 3: Mission, Vision & Philosophy Cards -->
    <section class="about-cards-section ptb-70">
      <div class="container">
        <div class="row g-4 justify-content-center">
          <!-- Card 1: Our Mission -->
          <div class="col-lg-4 col-md-6">
            <div class="about-mvp-card border-blue">
              <div class="about-mvp-card-avatar">
                <img
                  src="{{ asset('assets/images/mentor-img-1.png') }}"
                  alt="Our Mission Mentor"
                />
              </div>
              <h3 class="about-mvp-title blue-text">Our Mission</h3>
              <p class="about-mvp-desc">{{ $about_page->mission_text ?? 'Our mission text goes here.' }}</p>
            </div>
          </div>

          <!-- Card 2: Our Vision -->
          <div class="col-lg-4 col-md-6">
            <div class="about-mvp-card border-orange">
              <div class="about-mvp-card-avatar">
                <img
                  src="{{ asset('assets/images/mentor-img-1.png') }}"
                  alt="Our Vision Mentor"
                />
              </div>
              <h3 class="about-mvp-title orange-text">Our Vision</h3>
              <p class="about-mvp-desc">{{ $about_page->vision_text ?? 'Our vision text goes here.' }}</p>
            </div>
          </div>

          <!-- Card 3: Our Philosophy -->
          <div class="col-lg-4 col-md-6">
            <div class="about-mvp-card border-green">
              <div class="about-mvp-card-avatar">
                <img
                  src="{{ asset('assets/images/mentor-img-1.png') }}"
                  alt="Our Philosophy Mentor"
                />
              </div>
              <h3 class="about-mvp-title green-text">Our Philosophy</h3>
              <p class="about-mvp-desc">{{ $about_page->philosophy_text ?? 'Our philosophy text goes here.' }}</p>
            </div>
          </div>
        </div>
      </div>
    </section>

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
            From your first school admission to your first job offer — we cover
            every milestone of your education journey.
          </p>
        </div>

        <!-- Dark Cards Swiper -->
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
                        <img src="{{ env('BACKEND_URL') . '/' . $offer->icon_image }}" alt="" />
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
        </div>
      </div>
    </section>



    <!-- Section 5: Our Impact So Far -->
    <section class="about-impact-section ptb-70">
      <div class="container">
        <!-- Section Header -->
        <div class="text-center heading-card">
          <div
            class="heading-with-lines d-flex align-items-center justify-content-center gap-3 mb-3"
          >
            <span class="heading-line d-none d-md-block"></span>
            <h2 class="section-title mb-0 text-white">Our Impact So Far</h2>
            <span class="heading-line d-none d-md-block"></span>
          </div>
        </div>

        <!-- Impact items row -->
        <div class="about-impact-container mt-5">
          <!-- Item 1 -->
          <div class="about-impact-item">
            <div class="about-impact-circle">
              <!-- Yellow book SVG icon -->
              <img src="{{ asset('assets/images/step-img-1.png') }}" alt="" />
            </div>
            <span class="about-impact-number">10003+</span>
            <span class="about-impact-label">Student Helped</span>
          </div>

          <!-- Arrow 1 -->
          <div class="about-impact-arrow">➔</div>

          <!-- Item 2 -->
          <div class="about-impact-item">
            <div class="about-impact-circle">
              <!-- School building SVG icon -->
              <img src="{{ asset('assets/images/step-img-2.png') }}" alt="" />
            </div>
            <span class="about-impact-number">217+</span>
            <span class="about-impact-label">Institutions Listed</span>
          </div>

          <!-- Arrow 2 -->
          <div class="about-impact-arrow">➔</div>

          <!-- Item 3 -->
          <div class="about-impact-item">
            <div class="about-impact-circle">
              <!-- Trophy SVG icon -->
              <img src="{{ asset('assets/images/step-img-3.png') }}" alt="" />
            </div>
            <span class="about-impact-number">1310+</span>
            <span class="about-impact-label">Programs & Courses</span>
          </div>

          <!-- Arrow 3 -->
          <div class="about-impact-arrow">➔</div>

          <!-- Item 4 -->
          <div class="about-impact-item">
            <div class="about-impact-circle">
              <!-- Stacked books SVG icon -->
              <img src="{{ asset('assets/images/step-img-4.png') }}" alt="" />
            </div>
            <span class="about-impact-number">2000+</span>
            <span class="about-impact-label">Scholarship Available</span>
          </div>
        </div>
      </div>
    </section>

    <!-- Section 6: Meet Our Founders -->
    <section class="about-founders-section ptb-70">
      <div class="container">
        <!-- Section Header -->
        <div class="text-center heading-card">
          <div
            class="heading-with-lines d-flex align-items-center justify-content-center gap-3 mb-3"
          >
            <span class="heading-line d-none d-md-block"></span>
            <h2 class="section-title mb-0">Meet Our Founders</h2>
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
                    src="{{ $about_page->founder_1_image ? env('BACKEND_URL') . '/' . $about_page->founder_1_image : asset('assets/images/mentor-img-1.png') }}"
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
                {!! $about_page->founders_common_message !!}
              </div>
            </div>
          </div>

          <!-- Founder 2 -->
          <div class="col-lg-6">
            <div class="founder-card">
              <div class="founder-card-top">
                <div class="founder-img-wrapper">
                  <img
                    src="{{ $about_page->founder_2_image ? env('BACKEND_URL') . '/' . $about_page->founder_2_image : asset('assets/images/mentor-img-1.png') }}"
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
                {!! $about_page->founders_common_message !!}
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    

    <!-- Section 7: Our Team -->
    <section class="about-team-section ptb-70">
      <div class="container">
        <!-- Section Header -->
        <div class="text-center heading-card">
          <span class="marketplace-badge mb-3">OUR TEAM</span>
          <div
            class="heading-with-lines d-flex align-items-center justify-content-center gap-3 mb-3"
          >
            <span class="heading-line d-none d-md-block"></span>
            <h2 class="section-title mb-0">The People Behind Enrollzy</h2>
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
                  src="{{ $team->image ? env('BACKEND_URL') . '/' . $team->image : asset('assets/images/mentor-img-1.png') }}"
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



    
    <script>
      document.addEventListener("DOMContentLoaded", function () {
        // About Dark Section Swiper
        const darkSectionSwiper = new Swiper(".about-dark-swiper", {
          slidesPerView: 1,
          spaceBetween: 24,
          loop: false,
          grabCursor: true,
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
