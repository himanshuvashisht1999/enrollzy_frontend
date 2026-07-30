@extends('layouts.app')
@section('content')
<!-- Main Content Section -->
    <main class="about-hero-section">
       <div class="bg-square">
            <img src="assets/images/banner-square-img.svg" alt="">
        </div>
      <div class="container">
        <div class="about-hero-container">
          <img src="assets/images/about-banner-img.png" alt="" />

          <!-- Centered Badge (Placed outside card to prevent clipping) -->
          <div class="about-us-badge-wrapper">
            <button class="about-us-badge">ABOUT US</button>
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

    <!-- Section 1: Simplify Education Decisions -->
    <section class="about-section ptb-70">
      <div class="container">
        <!-- Section Header -->
        <div class="text-center heading-card">
          <span class="marketplace-badge mb-3">About us</span>
          <div
            class="heading-with-lines d-flex align-items-center justify-content-center gap-3 mb-3"
          >
            <span class="heading-line d-none d-md-block"></span>
            <h2 class="section-title mb-0">We simplify education decisions.</h2>
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

        <!-- Split Card -->
        <div class="about-split-card about-border-orange">
          <div class="row g-5">
            <div class="col-lg-5 about-split-img-col">
              <img
                src="assets/images/inner-about-img.png"
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
          <span class="marketplace-badge mb-3">OUR STORY</span>
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
                src="assets/images/about-our-story-img.png"
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
                  src="assets/images/mentor-img-1.png"
                  alt="Our Mission Mentor"
                />
              </div>
              <h3 class="about-mvp-title blue-text">Our Mission</h3>
              <p class="about-mvp-desc">
                Most platforms solve one piece of the student journey. A portal
                for admissions here. A scholarship aggregator there. A job board
                at the end. Enrollzy's mission is different — we exist to
                connect all of it. Because a student who finds the right college
                but misses the scholarship that makes it affordable has not been
                served. A student who graduates with a degree, but no career
                direction has not been served. We measure our mission against
                the whole journey, not a single transaction.
              </p>
            </div>
          </div>

          <!-- Card 2: Our Vision -->
          <div class="col-lg-4 col-md-6">
            <div class="about-mvp-card border-orange">
              <div class="about-mvp-card-avatar">
                <img
                  src="assets/images/mentor-img-1.png"
                  alt="Our Vision Mentor"
                />
              </div>
              <h3 class="about-mvp-title orange-text">Our Vision</h3>
              <p class="about-mvp-desc">
                Most platforms solve one piece of the student journey. A portal
                for admissions here. A scholarship aggregator there. A job board
                at the end. Enrollzy's mission is different — we exist to
                connect all of it. Because a student who finds the right college
                but misses the scholarship that makes it affordable has not been
                served. A student who graduates with a degree, but no career
                direction has not been served. We measure our mission against
                the whole journey, not a single transaction.
              </p>
            </div>
          </div>

          <!-- Card 3: Our Philosophy -->
          <div class="col-lg-4 col-md-6">
            <div class="about-mvp-card border-green">
              <div class="about-mvp-card-avatar">
                <img
                  src="assets/images/mentor-img-1.png"
                  alt="Our Philosophy Mentor"
                />
              </div>
              <h3 class="about-mvp-title green-text">Our Philosophy</h3>
              <p class="about-mvp-desc">
                Most platforms solve one piece of the student journey. A portal
                for admissions here. A scholarship aggregator there. A job board
                at the end. Enrollzy's mission is different — we exist to
                connect all of it. Because a student who finds the right college
                but misses the scholarship that makes it affordable has not been
                served. A student who graduates with a degree, but no career
                direction has not been served. We measure our mission against
                the whole journey, not a single transaction.
              </p>
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
          <span class="marketplace-badge mb-3">WHAT WE OFFER</span>
          <div
            class="heading-with-lines d-flex align-items-center justify-content-center gap-3 mb-3"
          >
            <span class="heading-line d-none d-md-block"></span>
            <h2 class="section-title mb-0">A Complete Education Ecosystem</h2>
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
            <!-- Slide 1 -->
            <div class="swiper-slide h-auto">
              <div class="about-dark-card">
                <div class="about-dark-card-icon">
                  <img
                    src="assets/images/offer-icon.png"
                    alt="Boarding schools logo"
                  />
                </div>
                <h3 class="about-dark-card-title">Boarding schools</h3>
                <p class="about-dark-card-desc">
                  Discover quality boarding schools that combine academics,
                  personal development, and structured learning environments to
                  help students build strong foundations for future success.
                </p>
              </div>
            </div>

            <!-- Slide 2 -->
            <div class="swiper-slide h-auto">
              <div class="about-dark-card">
                <div class="about-dark-card-icon">
                  <img
                    src="assets/images/offer-icon.png"
                    alt="Coaching Institute logo"
                  />
                </div>
                <h3 class="about-dark-card-title">Coaching Institute</h3>
                <p class="about-dark-card-desc">
                  Discover quality boarding schools that combine academics,
                  personal development, and structured learning environments to
                  help students build strong foundations for future success.
                </p>
              </div>
            </div>

            <!-- Slide 3 -->
            <div class="swiper-slide h-auto">
              <div class="about-dark-card">
                <div class="about-dark-card-icon">
                  <img
                    src="assets/images/offer-icon.png"
                    alt="Boarding schools logo"
                  />
                </div>
                <h3 class="about-dark-card-title">Boarding schools</h3>
                <p class="about-dark-card-desc">
                  Discover quality boarding schools that combine academics,
                  personal development, and structured learning environments to
                  help students build strong foundations for future success.
                </p>
              </div>
            </div>
            <!-- Slide 3 -->
            <div class="swiper-slide h-auto">
              <div class="about-dark-card">
                <div class="about-dark-card-icon">
                  <img
                    src="assets/images/offer-icon.png"
                    alt="Boarding schools logo"
                  />
                </div>
                <h3 class="about-dark-card-title">Boarding schools</h3>
                <p class="about-dark-card-desc">
                  Discover quality boarding schools that combine academics,
                  personal development, and structured learning environments to
                  help students build strong foundations for future success.
                </p>
              </div>
            </div>
            <!-- Slide 3 -->
            <div class="swiper-slide h-auto">
              <div class="about-dark-card">
                <div class="about-dark-card-icon">
                  <img
                    src="assets/images/offer-icon.png"
                    alt="Boarding schools logo"
                  />
                </div>
                <h3 class="about-dark-card-title">Boarding schools</h3>
                <p class="about-dark-card-desc">
                  Discover quality boarding schools that combine academics,
                  personal development, and structured learning environments to
                  help students build strong foundations for future success.
                </p>
              </div>
            </div>
            <!-- Slide 3 -->
            <div class="swiper-slide h-auto">
              <div class="about-dark-card">
                <div class="about-dark-card-icon">
                  <img
                    src="assets/images/offer-icon.png"
                    alt="Boarding schools logo"
                  />
                </div>
                <h3 class="about-dark-card-title">Boarding schools</h3>
                <p class="about-dark-card-desc">
                  Discover quality boarding schools that combine academics,
                  personal development, and structured learning environments to
                  help students build strong foundations for future success.
                </p>
              </div>
            </div>
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
              <img src="assets/images/step-img-1.png" alt="" />
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
              <img src="assets/images/step-img-2.png" alt="" />
            </div>
            <span class="about-impact-number">{{ \App\Models\Organisation::count() }}+</span>
            <span class="about-impact-label">Institutions Listed</span>
          </div>

          <!-- Arrow 2 -->
          <div class="about-impact-arrow">➔</div>

          <!-- Item 3 -->
          <div class="about-impact-item">
            <div class="about-impact-circle">
              <!-- Trophy SVG icon -->
              <img src="assets/images/step-img-3.png" alt="" />
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
              <img src="assets/images/step-img-4.png" alt="" />
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
          <!-- Founder 1: Vinay Singh -->
          <div class="col-lg-6">
            <div class="founder-card">
              <div class="founder-card-top">
                <div class="founder-img-wrapper">
                  <img
                    src="assets/images/mentor-img-1.png"
                    alt="Vinay Singh - Founder"
                  />
                </div>
                <div class="founder-info">
                  <h3 class="founder-name">Vinay Singh</h3>
                  <p class="founder-role">Founder</p>
                  <a href="#" class="founder-linkedin-btn"> Linkedin </a>
                </div>
              </div>
              <p class="founder-desc">
                Explore undergraduate, postgraduate, and professional degree
                opportunities through trusted institutions with flexible and
                future-oriented learning options. Explore undergraduate,
                postgraduate, and professional degree opportunities through
                trusted institutions with flexible and future-oriented learning
                options.
              </p>
            </div>
          </div>

          <!-- Founder 2: Amit Singh -->
          <div class="col-lg-6">
            <div class="founder-card">
              <div class="founder-card-top">
                <div class="founder-img-wrapper">
                  <img
                    src="assets/images/mentor-img-1.png"
                    alt="Amit Singh - Founder"
                  />
                </div>
                <div class="founder-info">
                  <h3 class="founder-name">AMIT Singh</h3>
                  <p class="founder-role">Founder</p>
                  <a href="#" class="founder-linkedin-btn"> Linkedin </a>
                </div>
              </div>
              <p class="founder-desc">
                Explore undergraduate, postgraduate, and professional degree
                opportunities through trusted institutions with flexible and
                future-oriented learning options. Explore undergraduate,
                postgraduate, and professional degree opportunities through
                trusted institutions with flexible and future-oriented learning
                options.
              </p>
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
          <!-- Team Member 1 -->
          <div class="col">
            <div class="team-card">
              <img
                src="assets/images/mentor-img-1.png"
                alt="Abhishek Sharma"
                class="team-card-img"
              />
              <div class="team-card-body">
                <h4 class="team-member-name">Abhishek Sharma</h4>
                <span class="team-member-role">SEO Director</span>
              </div>
            </div>
          </div>

          <!-- Team Member 2 -->
          <div class="col">
            <div class="team-card">
              <img
                src="assets/images/mentor-img-1.png"
                alt="Rahul Verma"
                class="team-card-img"
              />
              <div class="team-card-body">
                <h4 class="team-member-name">Abhishek Sharma</h4>
                <span class="team-member-role">SEO Director</span>
              </div>
            </div>
          </div>

          <!-- Team Member 3 -->
          <div class="col">
            <div class="team-card">
              <img
                src="assets/images/mentor-img-1.png"
                alt="Arjun Mehta"
                class="team-card-img"
              />
              <div class="team-card-body">
                <h4 class="team-member-name">Abhishek Sharma</h4>
                <span class="team-member-role">SEO Director</span>
              </div>
            </div>
          </div>

          <!-- Team Member 4 -->
          <div class="col">
            <div class="team-card">
              <img
                src="assets/images/mentor-img-1.png"
                alt="Priya Nair"
                class="team-card-img"
              />
              <div class="team-card-body">
                <h4 class="team-member-name">Abhishek Sharma</h4>
                <span class="team-member-role">SEO Director</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Curved Footer Section -->
@endsection
