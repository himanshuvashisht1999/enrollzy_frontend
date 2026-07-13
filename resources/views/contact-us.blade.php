@extends('layouts.app')
@section('content')
<!-- Main Content Section -->
    <main class="about-hero-section ptb-70">
      <div class="bg-square">
        <img src="assets/images/banner-square-img.svg" alt="" />
      </div>
      <div class="container">
        <div class="about-hero-container">
          <img src="assets/images/contact-us-banner-img.png" alt="" />

          <!-- Centered Badge (Placed outside card to prevent clipping) -->
          <div class="about-us-badge-wrapper">
            <button class="about-us-badge">Contact US</button>
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

    <div
      style="
        background: linear-gradient(180deg, rgb(191 219 247 / 3%) 0%, rgb(191 219 247 / 55%) 50%, rgba(191, 219, 247, 0) 100%);
      "
    >
      <!-- Section 1: Contact Info -->
      <section class="contact-info-sectionv ptb-70">
        <div class="container">
          <div class="row g-5 align-items-center">
            <!-- Left: Info rows -->
            <div class="col-lg-5">
              <!-- Row 1: Phone -->
              <div class="contact-info-row">
                <div class="contact-info-icon-wrapper">
                  <i class="fa-solid fa-phone"></i>
                </div>
                <div class="contact-info-card">
                  <table>
                    <tr>
                      <td class="label-text">Call Us</td>
                      <td class="val-text">+91 85785 43210</td>
                    </tr>
                    <tr>
                      <td class="label-text">Support Phone</td>
                      <td class="val-text">1800-123-4567</td>
                    </tr>
                    <tr>
                      <td class="label-text">Working Hours</td>
                      <td class="val-text">10 AM to 7 PM</td>
                    </tr>
                  </table>
                  <p class="muted-note">
                    Some decisions need a conversation. <br />call us we're
                    here.
                  </p>
                </div>
              </div>

              <!-- Row 2: Location -->
              <div class="contact-info-row">
                <div class="contact-info-icon-wrapper">
                  <i class="fa-solid fa-location-dot"></i>
                </div>
                <div class="contact-info-card">
                  <table>
                    <tr>
                      <td class="label-text">Visit Us</td>
                      <td class="val-text">
                        <a href="#" class="head-office-link">Head Office</a>
                      </td>
                    </tr>
                    <tr>
                      <td
                        colspan="2"
                        class="val-text"
                        style="
                          padding-top: 10px;
                          font-size: 13.5px;
                          line-height: 1.5;
                        "
                      >
                        UNIDANCE EDUCATION PVT LTD<br />
                        Workaholic Work Zone, SCO 354-355-356,<br />
                        SECOND FLOOR, Sector 34A,<br />
                        Chandigarh, 160022, INDIA
                      </td>
                    </tr>
                  </table>
                </div>
              </div>

              <!-- Row 3: Email -->
              <div class="contact-info-row">
                <div class="contact-info-icon-wrapper">
                  <i class="fa-solid fa-envelope"></i>
                </div>
                <div class="contact-info-card">
                  <table>
                    <tr>
                      <td class="label-text">Email Us</td>
                      <td class="val-text">info@enrollzy.com</td>
                    </tr>
                    <tr>
                      <td class="label-text">Support Email</td>
                      <td class="val-text">support@enrollzy.com</td>
                    </tr>
                  </table>
                </div>
              </div>
            </div>

            <!-- Right: Smartphone stock image -->
            <div class="col-lg-7 contact-side-img-wrapper">
              <img
                src="assets/images/contact-detail-img.png"
                alt="Get in touch with Enrollzy"
                class="img-fluid"
              />
            </div>
          </div>
        </div>
      </section>

      <!-- Section 2: Talk to the Founder -->
      <section class="contact-founder-section ptb-70">
        <div class="container">
          <div class="row g-5 align-items-center">
            <div class="col-md-12">
              <div class="text-center heading-card mb-5">
                <div
                  class="heading-with-lines d-flex align-items-center justify-content-center gap-3 mb-3"
                >
                  <span class="heading-line d-none d-md-block"></span>
                  <h2 class="section-title mb-0">
                    Talk to the person who built this for you
                  </h2>
                  <span class="heading-line d-none d-md-block"></span>
                </div>
                <p
                  class="section-subtitle mx-auto text-muted"
                  style="max-width: 900px"
                >
                  "Every feature on Enrollzy exists because a student somewhere
                  had a question no one answered. Be that student. Write to our
                  founder — your feedback, your story, your doubt. It goes
                  straight to the top."
                </p>
              </div>
            </div>
            <!-- Left: Portrait -->
            <div class="col-lg-5 founder-portrait-wrapper">
              <img
                src="assets/images/founder-img-contact.png"
                alt="Vinay Singh - Founder"
                class="img-fluid"
              />
            </div>

            <!-- Right: Text block -->
            <div class="col-lg-7">
              <div class="contact-founder-card">
                <div class="contact-founder-watermark">FOUNDER</div>
                <h2 class="contact-founder-title">
                  Talk to the person who built this for you
                </h2>
                <div class="contact-founder-quote">
                  <p>
                    "Every feature on Enrollzy exists because a student
                    somewhere had a question no one answered. Be that student.
                    Write to our founder — your feedback, your story, your
                    doubt. It goes straight to the top."
                  </p>
                </div>
                <div class="contact-founder-author">
                  <h4 class="contact-founder-name">Vinay Singh</h4>
                  <span class="contact-founder-role">Founder</span>
                </div>
                <div class="contact-founder-buttons">
                  <a href="mailto:vinay@enrollzy.com" class="btn-founder-email">
                    <i class="fa-solid fa-envelope"></i>
                    Email Founder
                  </a>
                  <a href="#" class="btn-founder-consult">
                    Book Consultation
                    <i class="fa-solid fa-arrow-right"></i>
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>

    <!-- Section 3: Request Consultation & Map -->
    <section class="contact-form-section ptb-70">
      <div class="container">
        <!-- Section Header -->
        <div class="text-center heading-card mb-5">
          <div
            class="heading-with-lines d-flex align-items-center justify-content-center gap-3 mb-3"
          >
            <span class="heading-line d-none d-md-block"></span>
            <h2 class="section-title mb-0">
              Talk to the person who built this for you
            </h2>
            <span class="heading-line d-none d-md-block"></span>
          </div>
          <p
            class="section-subtitle mx-auto text-muted"
            style="max-width: 900px"
          >
            "Every feature on Enrollzy exists because a student somewhere had a
            question no one answered. Be that student. Write to our founder —
            your feedback, your story, your doubt. It goes straight to the top."
          </p>
        </div>

        <div class="row g-5 align-items-stretch">
          <!-- Left: Form -->
          <div class="col-lg-7">
            <div class="contact-form-card">
              <h3 class="fw-bold mb-2" style="color: #0d1b2a; font-size: 24px">
                Request a Consultation
              </h3>
              <p class="text-muted mb-4" style="font-size: 14px">
                Leave us a message and our advisors will get back to you
                shortly.
              </p>

              <form action="#">
                <div class="row g-3">
                  <div class="col-md-6">
                    <label class="form-label">Full Name</label>
                    <input
                      type="text"
                      class="form-control"
                      placeholder="Enter your name"
                      required
                    />
                  </div>
                  <div class="col-md-6">
                    <label class="form-label">Phone Number</label>
                    <input
                      type="tel"
                      class="form-control"
                      placeholder="Enter your Phone Number"
                      required
                    />
                  </div>
                  <div class="col-md-6">
                    <label class="form-label">Email Address</label>
                    <input
                      type="email"
                      class="form-control"
                      placeholder="Email address"
                      required
                    />
                  </div>
                  <div class="col-md-6">
                    <label class="form-label">Company Name</label>
                    <input
                      type="text"
                      class="form-control"
                      placeholder="Company name"
                    />
                  </div>
                  <div class="col-12">
                    <label class="form-label">Business Type</label>
                    <select class="form-select">
                      <option selected>School Admission</option>
                      <option>University Admission</option>
                      <option>Coaching Programs</option>
                      <option>Scholarships & Support</option>
                    </select>
                  </div>
                  <div class="col-12">
                    <label class="form-label"
                      >How can we help your business</label
                    >
                    <textarea
                      class="form-control"
                      rows="4"
                      placeholder="write message..."
                      required
                    ></textarea>
                  </div>
                  <div class="col-12 text-center">
                    <button
                      type="submit"
                      class="btn-form-submit w-100 justify-content-center"
                    >
                      Submit request
                      <i class="fa-solid fa-arrow-right"></i>
                    </button>
                  </div>
                </div>
              </form>

              <div class="text-center">
                <div class="contact-secure-notice">
                  <i class="fa-solid fa-lock"></i>
                  Your personal information is secure with us
                </div>
              </div>

              <p class="contact-form-disclaimer">
                I agree and consent to receive all communications at the mobile
                number provided, even if this mobile number is registered under
                DND/NCPR list under TRAI regulations. And for that purpose, I
                further authorize the Company to share/disclose the information
                to any third-party service provider or any affiliates, group
                companies, their authorized agents, or third-party service
                providers.
              </p>
            </div>
          </div>

          <!-- Right: Map -->
          <div class="col-lg-5 px-0">
            <div class="contact-map-wrapper">
              <!-- Chandigarh Sector 34A Location Google Map Iframe -->
              <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3430.2223849502847!2d76.76450637684824!3d30.726224385966398!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x390fed160a000001%3A0x63334dc2809e53b1!2sSector%2034%2C%20Chandigarh!5e0!3m2!1sen!2sin!4v1700000000000!5m2!1sen!2sin"
                allowfullscreen=""
                loading="lazy"
                referrerpolicy="no-referrer-when-downgrade"
              ></iframe>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Section 4: Why Businesses Work With Us -->
    <section class="contact-why-section ptb-70">
      <div class="container">
        <!-- Section Header -->
        <div class="text-center heading-card mb-5">
          <div
            class="heading-with-lines d-flex align-items-center justify-content-center gap-3 mb-3"
          >
            <span class="heading-line d-none d-md-block"></span>
            <h2 class="section-title mb-0">Why Businesses Work With Us</h2>
            <span class="heading-line d-none d-md-block"></span>
          </div>
          <p
            class="section-subtitle mx-auto text-muted"
            style="max-width: 900px"
          >
            What our students and parents have to say about their experience
            with us.
          </p>
        </div>

        <!-- Cards Grid -->
        <div class="row g-4 justify-content-center">
          <!-- Card 1 -->
          <div class="col-lg-3 col-sm-6">
            <div class="why-card">
              <div class="why-card-icon">
                <img src="assets/images/why-wok-icon-1.png" alt="" />
              </div>
              <h4 class="why-card-title">Process Improvement</h4>
              <p class="why-card-desc">
                We analyze your workflows and eliminate bottlenecks to increase
                efficiency.
              </p>
            </div>
          </div>

          <!-- Card 2 -->
          <div class="col-lg-3 col-sm-6">
            <div class="why-card">
              <div class="why-card-icon">
                <img src="assets/images/why-wok-icon-2.png" alt="" />
              </div>
              <h4 class="why-card-title">Process Improvement</h4>
              <p class="why-card-desc">
                We analyze your workflows and eliminate bottlenecks to increase
                efficiency.
              </p>
            </div>
          </div>

          <!-- Card 3 -->
          <div class="col-lg-3 col-sm-6">
            <div class="why-card">
              <div class="why-card-icon">
                <img src="assets/images/why-wok-icon-3.png" alt="" />
              </div>
              <h4 class="why-card-title">Process Improvement</h4>
              <p class="why-card-desc">
                We analyze your workflows and eliminate bottlenecks to increase
                efficiency.
              </p>
            </div>
          </div>

          <!-- Card 4 -->
          <div class="col-lg-3 col-sm-6">
            <div class="why-card">
              <div class="why-card-icon">
                <img src="assets/images/why-wok-icon-4.png" alt="" />
              </div>
              <h4 class="why-card-title">Process Improvement</h4>
              <p class="why-card-desc">
                We analyze your workflows and eliminate bottlenecks to increase
                efficiency.
              </p>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Section 5: Partnership -->
    <section class="contact-partnership-section ptb-70">
      <div class="container">
        <div class="row g-5 align-items-center">
          <!-- Left: Text -->
          <div class="col-lg-6">
            <h2 class="partnership-title">PARTNERSHIP</h2>

            <ul class="partnership-list">
              <li class="partnership-item">
                <i class="fa-solid fa-circle-check"></i>
                University Partnership Inquiries
              </li>
              <li class="partnership-item">
                <i class="fa-solid fa-circle-check"></i>
                University Partnership Inquiries
              </li>
            </ul>

            <div class="partnership-buttons">
              <a href="#" class="btn-partnership-consult">
                <i class="fa-solid fa-phone"></i>
                FREE BOOK CONSULTATION
              </a>
              <a
                href="https://wa.me/918578543210"
                class="btn-partnership-whatsapp"
                target="_blank"
              >
                <i class="fa-brands fa-whatsapp"></i>
                WhatsApp Us
              </a>
            </div>
          </div>

          <!-- Right: Image -->
          <div class="col-lg-6 partnership-img-wrapper text-end">
            <img
              src="assets/images/contact-partner-sec.png"
              alt="Collaborative team meeting"
              class="img-fluid"
            />
          </div>
        </div>
      </div>
    </section>

    <!-- Curved Footer Section -->
@endsection
