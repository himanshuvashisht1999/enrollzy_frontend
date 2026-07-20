@extends('layouts.app')
@section('content')
<main class="about-hero-section ptb-70">
      <div class="bg-square">
        <img src="assets/images/banner-square-img.svg" alt="" />
      </div>
      <div class="container">
        <div class="about-hero-container">
          <img src="{{ $contactDetails->hero_image ? (str_starts_with($contactDetails->hero_image, 'http') ? $contactDetails->hero_image : rtrim(env('BACKEND_URL', 'http://127.0.0.1:8001'), '/') . '/' . ltrim($contactDetails->hero_image, '/')) : asset('assets/images/contact-us-banner-img.png') }}" alt="Contact Us" />

          <!-- Centered Badge / Content Block -->
          <div class="about-us-badge-wrapper w-100 px-3">
            <button class="about-us-badge mb-3">{{ $contactDetails->hero_badge ?? 'Contact US' }}</button>
            
            @if(!empty($contactDetails->hero_title))
              <h1 class="text-white fw-bold mb-3" style="font-size: 2.5rem; text-shadow: 0px 4px 10px rgba(0,0,0,0.5);">{{ $contactDetails->hero_title }}</h1>
            @endif
            
            @if(!empty($contactDetails->hero_description))
              <p class="text-white mx-auto mb-3" style="max-width: 600px; font-size: 1.1rem; font-weight: 500; text-shadow: 0px 2px 5px rgba(0,0,0,0.5);">{{ $contactDetails->hero_description }}</p>
            @endif
            
            @if(!empty($contactDetails->hero_trust_points) && is_array($contactDetails->hero_trust_points))
              <div class="d-flex flex-wrap justify-content-center gap-2 mb-3 text-white">
                @foreach($contactDetails->hero_trust_points as $point)
                  <span class="badge border border-light rounded-pill px-3 py-2" style="background: rgba(13,27,42,0.4); backdrop-filter: blur(5px); font-size: 13px;">
                    <i class="fa-solid fa-circle-check text-warning me-2"></i>{{ $point }}
                  </span>
                @endforeach
              </div>
            @endif
            
            @if(!empty($contactDetails->btn_hero_primary_text) || !empty($contactDetails->btn_hero_secondary_text))
              <div class="d-flex justify-content-center gap-3">
                @if(!empty($contactDetails->btn_hero_primary_text))
                  <a href="{{ $contactDetails->btn_hero_primary_url ?? '#' }}" class="btn btn-enrollzy text-white px-4 py-2 rounded-pill shadow">
                    {{ $contactDetails->btn_hero_primary_text }}
                  </a>
                @endif
                @if(!empty($contactDetails->btn_hero_secondary_text))
                  <a href="{{ $contactDetails->btn_hero_secondary_url ?? '#' }}" class="btn btn-outline-light px-4 py-2 rounded-pill shadow-sm">
                    {{ $contactDetails->btn_hero_secondary_text }}
                  </a>
                @endif
              </div>
            @endif
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
                      <td class="val-text">{{ $contactDetails->phone_general ?? "+91 85785 43210" }}</td>
                    </tr>
                    <tr>
                      <td class="label-text">Support Phone</td>
                      <td class="val-text">{{ $contactDetails->phone_toll_free ?? "1800-123-4567" }}</td>
                    </tr>
                    <tr>
                      <td class="label-text">Working Hours</td>
                      <td class="val-text">{{ $contactDetails->office_timings ?? "10 AM to 7 PM" }}</td>
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
                        {!! isset($contactDetails->address_head_office) ? nl2br(e($contactDetails->address_head_office)) : "UNIDANCE EDUCATION PVT LTD<br />Workaholic Work Zone, SCO 354-355-356,<br />SECOND FLOOR, Sector 34A,<br />Chandigarh, 160022, INDIA" !!}
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
                      <td class="val-text">{{ $contactDetails->email_queries ?? "info@enrollzy.com" }}</td>
                    </tr>
                    <tr>
                      <td class="label-text">Support Email</td>
                      <td class="val-text">{{ $contactDetails->email_support ?? "support@enrollzy.com" }}</td>
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
                  <h2 class="section-title mb-0">{{ $contactDetails->founder_heading ?? "Talk to the person who built this for you" }}</h2>
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
              <img src="{{ $contactDetails->co_founder_image ? (str_starts_with($contactDetails->co_founder_image, 'http') ? $contactDetails->co_founder_image : rtrim(env('BACKEND_URL', 'http://127.0.0.1:8001'), '/') . '/' . ltrim($contactDetails->co_founder_image, '/')) : asset('assets/images/founder-img-contact.png') }}" alt="{{ $contactDetails->co_founder_name ?? 'Founder' }}" class="img-fluid" />
            </div>

            <!-- Right: Text block -->
            <div class="col-lg-7">
              <div class="contact-founder-card">
                <div class="contact-founder-watermark">{{ $contactDetails->founder_badge ?? "FOUNDER" }}</div>
                <h2 class="contact-founder-title">{{ $contactDetails->founder_heading ?? "Talk to the person who built this for you" }}</h2>
                                <div class="contact-founder-quote">
                  <p>
                    {{ $contactDetails->co_founder_message ?? '"Every feature on Enrollzy exists because a student somewhere had a question no one answered. Be that student. Write to our founder — your feedback, your story, your doubt. It goes straight to the top."' }}
                  </p>
                </div>
                <div class="contact-founder-author">
                  <h4 class="contact-founder-name">{{ $contactDetails->co_founder_name ?? "Vinay Singh" }}</h4>
                  <span class="contact-founder-role">{{ $contactDetails->co_founder_title ?? "Founder" }}</span>
                </div>
                <div class="contact-founder-buttons">
                  <a href="mailto:{{ $contactDetails->co_founder_email ?? "vinay@enrollzy.com" }}" class="btn-founder-email">
                    <i class="fa-solid fa-envelope"></i>
                    Email Founder
                  </a>
                  <a href="{{ $contactDetails->btn_founder_book_url ?? '#' }}" class="btn-founder-consult">{{ $contactDetails->btn_founder_book_text ?? "Book Consultation" }} <i class="fa-solid fa-arrow-right"></i></a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>

    <!-- Section 3: Request Consultation & Map -->
    <section class="contact-form-section ptb-70" id="contact-form">
      <div class="container">
        <!-- Section Header -->
        <div class="text-center heading-card mb-5">
          <div
            class="heading-with-lines d-flex align-items-center justify-content-center gap-3 mb-3"
          >
            <span class="heading-line d-none d-md-block"></span>
            <h2 class="section-title mb-0">
              {{ $contactDetails->hero_title ?? 'Request a Free Consultation' }}
            </h2>
            <span class="heading-line d-none d-md-block"></span>
          </div>
          <p
            class="section-subtitle mx-auto text-muted"
            style="max-width: 900px"
          >
            {{ $contactDetails->hero_subtitle ?? 'Leave us a message and our advisors will get back to you shortly.' }}
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

              @php $fromOrg = request('from_org', ''); @endphp

              <form action="{{ route('contact.submit') }}" method="POST">
                @csrf
                <input type="hidden" name="organisation_name" value="{{ $fromOrg }}">

                @if($fromOrg)
                    <div class="alert d-flex align-items-center gap-2 mb-3 rounded-3" style="background: #eef3ff; border: 1px solid #b6ccff; color: #1a3a7c; font-size: 14px;">
                        <i class="fa-solid fa-school"></i>
                        <span>You're requesting a callback about <strong>{{ $fromOrg }}</strong>. Our team will get back to you shortly.</span>
                    </div>
                @endif

                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="row g-3">
                  <div class="col-md-6">
                    <label class="form-label">Full Name</label>
                    <input
                      type="text"
                      class="form-control"
                      name="name" placeholder="Enter your name"
                      required
                    />
                  </div>
                  <div class="col-md-6">
                    <label class="form-label">Phone Number</label>
                    <input
                      type="tel"
                      class="form-control"
                      name="phone" placeholder="Enter your Phone Number"
                      required
                    />
                  </div>
                  <div class="col-md-6">
                    <label class="form-label">Email Address</label>
                    <input
                      type="email"
                      class="form-control"
                      name="email" placeholder="Email address"
                      required
                    />
                  </div>
                  <div class="col-md-6">
                    <label class="form-label">{{ $fromOrg ? 'Institute / School Name' : 'Company Name' }}</label>
                    <input
                      type="text"
                      class="form-control"
                      name="company"
                      placeholder="{{ $fromOrg ? 'Institute or school name' : 'Company name' }}"
                      value="{{ $fromOrg }}"
                    />
                  </div>
                  <div class="col-12">
                    <label class="form-label">Business Type</label>
                    <select name="type" class="form-select">
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
                      name="message" placeholder="write message..."
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
                <div class="d-flex flex-wrap justify-content-center gap-2 mt-3">
                  @if(!empty($contactDetails->form_trust_points) && is_array($contactDetails->form_trust_points))
                    @foreach($contactDetails->form_trust_points as $point)
                      <div class="contact-secure-notice">
                        <i class="fa-solid fa-lock text-success me-1"></i>
                        {{ $point }}
                      </div>
                    @endforeach
                  @else
                    <div class="contact-secure-notice">
                      <i class="fa-solid fa-lock"></i>
                      Your personal information is secure with us
                    </div>
                  @endif
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
              <iframe src="{{ $contactDetails->embed_map_url }}" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
          </div>
        </div>
      </div>
    </section>

    @if(!empty($contactDetails->why_contact_cards) && is_array($contactDetails->why_contact_cards) && collect($contactDetails->why_contact_cards)->filter(function($card) { return !empty($card['title']) || !empty($card['description']); })->count() > 0)
    <!-- Section 4: Why Businesses Work With Us -->
    <section class="contact-why-section ptb-70">
      <div class="container">
        <!-- Section Header -->
        <div class="text-center heading-card mb-5">
          <div
            class="heading-with-lines d-flex align-items-center justify-content-center gap-3 mb-3"
          >
            <span class="heading-line d-none d-md-block"></span>
            <h2 class="section-title mb-0">{{ $contactDetails->why_contact_heading ?? 'Why Businesses Work With Us' }}</h2>
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
          @foreach($contactDetails->why_contact_cards as $card)
            @if(!empty($card['title']) || !empty($card['description']))
              <div class="col-lg-3 col-sm-6">
                <div class="why-card">
                  <div class="why-card-icon d-flex align-items-center justify-content-center" style="font-size: 2.5rem; color: #3771c8; height: 70px; width: 70px; margin-bottom: 20px;">
                    @if(empty($card['icon']))
                      <img src="{{ asset('assets/images/why-wok-icon-1.png') }}" alt="" />
                    @elseif(str_contains($card['icon'], '.') || str_contains($card['icon'], '/'))
                      <img src="{{ str_starts_with($card['icon'], 'http') ? $card['icon'] : (str_starts_with($card['icon'], 'assets/') ? asset($card['icon']) : rtrim(env('BACKEND_URL', 'http://127.0.0.1:8001'), '/') . '/' . ltrim($card['icon'], '/')) }}" alt="" />
                    @else
                      <i class="{{ $card['icon'] }}"></i>
                    @endif
                  </div>
                  <h4 class="why-card-title">{{ $card['title'] ?? '' }}</h4>
                  <p class="why-card-desc">{{ $card['description'] ?? '' }}</p>
                </div>
              </div>
            @endif
          @endforeach
        </div>
      </div>
    </section>
    @endif

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
