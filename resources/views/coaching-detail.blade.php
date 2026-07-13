@extends('layouts.app')

@section('content')
<main class="about-hero-section ptb-70">
        <div class="bg-square">
            <img src="{{ asset('assets/images/banner-square-img.svg') }}" alt="" />
        </div>
        <div class="container">
            <div class="about-hero-container">
                <img src="{{ asset('assets/images/school-detail-banner-img.png') }}" alt="" />

                <!-- Centered Badge (Placed outside card to prevent clipping) -->
                <div class="about-us-badge-wrapper">
                    <button class="about-us-badge">The Doon School</button>
                    <p>Dehradun, Uttrakhand</p>
                </div>

                <!-- Green Down Arrow Button -->
                <button class="about-scroll-btn" aria-label="Scroll Down">
                    <img style="width: 49px; height: 62px" src="{{ asset('assets/images/inner-banner-down-arror.png') }}" alt="" />
                </button>
            </div>
        </div>
    </main>

    <!-- Breadcrumbs navigation -->
    <div class="py-3" style="background-color: #f9ad0b14">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0" style="font-size: 14px; font-weight: 500">
                    <li class="breadcrumb-item">
                        <a href="#" class="text-decoration-none text-muted"><i class="fa-solid fa-house me-1"></i>
                            Home</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="all-schools.html" class="text-decoration-none active text-primary">Schools</a>
                    </li>
                    <li class="breadcrumb-item active text-primary" aria-current="page">
                        Birla Vidya Mandir Nainital
                    </li>
                </ol>
            </nav>
        </div>
    </div>

    <!-- Main Content wrapper -->
    <div style=" padding: 40px 0;padding-bottom: 0;">
        <div class="container">
            <!-- School Info Header Card -->
            <div class="sd-info-card">
                <div class="sd-title-row">
                    <div class="sd-title-box">
                        <h1 class="sd-title">The Doon School</h1>
                        <a href="#" class="sd-location"><i class="fa-solid fa-location-dot me-1"></i> Dehradun
                            (Uttrakhand)</a>
                    </div>
                    <span class="sd-status-badge">
                        <span class="sd-status-dot"></span> Status: Admission ongoing
                    </span>
                </div>

                <div class="sd-meta-row">
                    <div class="sd-meta-item">
                        <i class="fa-solid fa-book-open"></i> CBSE
                    </div>
                    <div class="sd-meta-item">
                        <i class="fa-solid fa-graduation-cap"></i> 6 - 12 Class
                    </div>
                    <div class="sd-meta-item">
                        <i class="fa-solid fa-calendar-days"></i> Estd. 1897
                    </div>
                </div>

                <div class="sd-views-row">
                    <i class="fa-regular fa-eye"></i> 11.2k Views
                </div>

                <h3 class="sd-about-title">About us</h3>
                <p class="sd-about-desc">
                    The history of The Scindia School provides a fascinating insight
                    into the changes happening in India from feudal times to the modern
                    day. The Scindia School was founded as The Sardar School in 1897 by
                    the visionary HH Maharaja Madhavrao Scindia I.
                </p>
                <p class="sd-about-desc mb-0">
                    The turn of the nineteenth century was a period of turmoil and
                    disorientation, as the colonial system of education with English as
                    the medium of instruction, was displacing the traditional
                    pathshalas, madarsas and gurukuls. However, even then, the school
                    captured the best of the learning of the new world and combined it
                    with the finest of timeless India. In this respect, The Scindia
                    School has been the torchbearer of modern education systems,
                    combining it with a unique Indian ethos. It has been, in every way,
                    always one step ahead of the times.
                </p>
            </div>
        </div>
    </div>


    <!-- Tab Pills Navigation -->
    <div style="background-color: #3771C812;padding: 20px 0px;    margin-bottom: 51px;">
        <div class="sd-tab-pills-row mb-0">
            <button class="sd-tab-pill-btn active" data-tab-target="overview">Overview</button>
            <button class="sd-tab-pill-btn" data-tab-target="admissions">Admissions</button>
            <button class="sd-tab-pill-btn" data-tab-target="fee-structure">Fee Structure</button>
            <button class="sd-tab-pill-btn" data-tab-target="photos">Photos</button>
            <button class="sd-tab-pill-btn" data-tab-target="reviews">Reviews</button>
        </div>
    </div>

    <!-- 1. Fill Admission Form Section -->
    <div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="sd-section-card" data-tab-content="overview">
                        <div class="row g-5">
                            <!-- Left Process text -->
                            <div class="col-lg-7">
                                <h2 class="sd-section-title mb-4">Admission Process</h2>
                                <div style="font-size: 14px; line-height: 1.6; color: #4a5568">
                                    <p>
                                        The Scindia School admission process starts with:<br />Guidelines
                                        to the parents for Scindia Aptitude Analysis – 2025-26
                                    </p>
                                    <p class="mb-1">
                                        a) Scindia Aptitude Analysis (SAA-I) is exclusive to The
                                        Scindia School, Fort, Gwalior.
                                    </p>
                                    <p class="mb-1">
                                        b) Scindia Aptitude Analysis (SAA-I) is exclusive to The
                                        Scindia School, Fort, Gwalior.
                                    </p>
                                    <p class="mb-1">
                                        c) Scindia Aptitude Analysis (SAA-I) is exclusive to The
                                        Scindia School, Fort, Gwalior.
                                    </p>
                                    <p class="mb-1">
                                        d) Scindia Aptitude Analysis (SAA-I) is exclusive to The
                                        Scindia School, Fort, Gwalior.
                                    </p>
                                    <p class="mb-4">
                                        e) Scindia Aptitude Analysis (SAA-I) is exclusive to The
                                        Scindia School, Fort, Gwalior.
                                    </p>

                                    <h4 class="fw-bold text-dark mb-3" style="font-size: 15px ; color:#000 !important;">
                                        HOW?
                                    </h4>
                                    <ul class="ps-3 mb-4">
                                        <li class="mb-2">
                                            For students wishing to join The Scindia School, the first
                                            step is filling the registration form.
                                        </li>
                                        <li class="mb-2">
                                            The filled in Registration Form along with the requisite fee
                                            and copy of the birth certificate issued by the local
                                            Municipal Corporation, Report Card of previous class and
                                            three self-attested passport size photographs of the
                                            applicant should be submitted online or sent to the school.
                                        </li>
                                        <li class="mb-2">
                                            Payment for non-refundable enrollment: – Rs 25,000 (includes
                                            registration charges, assessment fee and prospectus).
                                            Registration is valid for any two consecutive assessments.
                                        </li>
                                        <li class="mb-2">
                                            For SAA, a registration amount of Rs. 18,500/- is to be paid
                                            after the admission is confirmed. For doing the enrolment
                                            for SAA, a sum of Rs. 6500/- is to be remitted. For Class XI
                                            admission seekers, the applicants have to choose SAA
                                            category and pay Rs. 18,500/- irrespective of the date of
                                            registration. The assessment for admission to Class XI will
                                            be held in the last week of March every year at The Scindia
                                            School, Gwalior.
                                        </li>
                                        <li class="mb-2">
                                            The registration fee is non-refundable. For the convenience
                                            of parents, the school has the following methods of payment
                                            – Net banking, Credit Card or by a bank draft drawn in
                                            favour of ‘Principal, The Scindia School’, payable at
                                            Gwalior.
                                        </li>
                                        <li class="mb-2">
                                            Submission of the Aadhar Card copy of the candidate before
                                            joining the school is MANDATORY and is applicable for
                                            students from all states of India except J & K, Assam,
                                            Meghalaya.
                                        </li>
                                        <li class="mb-2">Please fill-in the registration form</li>
                                    </ul>

                                    <h4 class="fw-bold text-dark mb-3" style="font-size: 15px ; color:#000 !important;">
                                        WHO CAN APPLY
                                    </h4>
                                    <ul class="ps-3 mb-0">
                                        <li class="mb-2">
                                            Admission is granted to classes VI, VII, VIII and IX, for
                                            which the applicant should not be more than
                                            eleven/twelve/thirteen years of age respectively as on 1st
                                            of January of the year in which the admissions are sought.
                                        </li>
                                        <li class="mb-2">
                                            Admission may be granted to classes IX and XI to extremely
                                            meritorious students, if vacancies are available.
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <!-- Right Inquiry form -->
                            <div class="col-lg-5">
                                <div class="sd-enquiry-card">
                                    <h3 class="sd-enquiry-title">Enquiry about admission</h3>
                                    <form class="sd-enquiry-form">
                                        <div class="mb-3">
                                            <label class="form-label">Parent Name</label>
                                            <input type="text" placeholder="Enter your name" class="form-control" />
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Phone Number</label>
                                            <input type="text" placeholder="Enter phone number" class="form-control" />
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Email ID</label>
                                            <input type="email" placeholder="Enter email id" class="form-control" />
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Select class</label>
                                            <select class="form-select">
                                                <option>Select class</option>
                                                <option>Class 6</option>
                                                <option>Class 7</option>
                                                <option>Class 8</option>
                                            </select>
                                        </div>
                                        <div class="mb-4">
                                            <label class="form-label">Alternate Number (Phone)</label>
                                            <input type="text" placeholder="Enter alternate number"
                                                class="form-control" />
                                        </div>
                                        <button type="submit" class="btn-sd-submit-enquiry">
                                            Submit Enquiry
                                            <i class="fa-solid fa-chevron-right" style="font-size: 10px"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="sd-section-card" data-tab-content="admissions">
                        <div class="sd-section-header">
                            <h2 class="sd-section-title">Fill Admission Form</h2>
                            <div style="width: 160px">
                                <select class="form-select"
                                    style="font-size: 14px; font-weight: 600; border-radius: 8px">
                                    <option>Select Session</option>
                                    <option selected>2026-2027</option>
                                    <option>2027-2028</option>
                                </select>
                            </div>
                        </div>

                        <div class="sd-table-container">
                            <table class="sd-admission-table">
                                <thead>
                                    <tr>
                                        <th>Class</th>
                                        <th>Session</th>
                                        <th>Application Date</th>
                                        <th>Status</th>
                                        <th>Application Fee</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Row 1 -->
                                    <tr>
                                        <td>Class 6</td>
                                        <td>2026-2027</td>
                                        <td>
                                            <div class="fw-bold" style="color: #0d1b2a; font-size: 14px">
                                                Last Date
                                            </div>
                                            <div class="text-muted" style="font-size: 11px">
                                                Jul 31, 2025
                                            </div>
                                        </td>
                                        <td><span class="sd-badge-ongoing">Ongoing</span></td>
                                        <td class="fw-bold" style="color: #0d1b2a">0</td>
                                        <td>
                                            <div class="sd-table-btn-row">
                                                <button class="btn-sd-apply">Apply</button>
                                                <button class="btn-sd-enquire">Enquire</button>
                                            </div>
                                        </td>
                                    </tr>
                                    <!-- Row 2 -->
                                    <tr>
                                        <td>Class 6</td>
                                        <td>2026-2027</td>
                                        <td>
                                            <div class="fw-bold" style="color: #0d1b2a; font-size: 14px">
                                                Last Date
                                            </div>
                                            <div class="text-muted" style="font-size: 11px">
                                                Jul 31, 2025
                                            </div>
                                        </td>
                                        <td><span class="sd-badge-ongoing">Ongoing</span></td>
                                        <td class="fw-bold" style="color: #0d1b2a">0</td>
                                        <td>
                                            <div class="sd-table-btn-row">
                                                <button class="btn-sd-apply">Apply</button>
                                                <button class="btn-sd-enquire">Enquire</button>
                                            </div>
                                        </td>
                                    </tr>
                                    <!-- Row 3 -->
                                    <tr>
                                        <td>Class 6</td>
                                        <td>2026-2027</td>
                                        <td>
                                            <div class="fw-bold" style="color: #0d1b2a; font-size: 14px">
                                                Last Date
                                            </div>
                                            <div class="text-muted" style="font-size: 11px">
                                                Jul 31, 2025
                                            </div>
                                        </td>
                                        <td><span class="sd-badge-ongoing">Ongoing</span></td>
                                        <td class="fw-bold" style="color: #0d1b2a">0</td>
                                        <td>
                                            <div class="sd-table-btn-row">
                                                <button class="btn-sd-apply">Apply</button>
                                                <button class="btn-sd-enquire">Enquire</button>
                                            </div>
                                        </td>
                                    </tr>
                                    <!-- Row 4 -->
                                    <tr>
                                        <td>Class 6</td>
                                        <td>2026-2027</td>
                                        <td>
                                            <div class="fw-bold" style="color: #0d1b2a; font-size: 14px">
                                                Last Date
                                            </div>
                                            <div class="text-muted" style="font-size: 11px">
                                                Jul 31, 2025
                                            </div>
                                        </td>
                                        <td><span class="sd-badge-ongoing">Ongoing</span></td>
                                        <td class="fw-bold" style="color: #0d1b2a">0</td>
                                        <td>
                                            <div class="sd-table-btn-row">
                                                <button class="btn-sd-apply">Apply</button>
                                                <button class="btn-sd-enquire">Enquire</button>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="text-center mt-3">
                            <a href="#" class="text-primary text-decoration-none fw-bold" style="font-size: 14px">See
                                More</a>
                        </div>
                    </div>

                    <!-- 2. Schedule Visit Banner -->
                    <div class="sd-schedule-banner" data-tab-content="overview admissions">
                        <div class="row align-items-center">
                            <div class="col-md-5">
                                <div class="sd-schedule-left">
                                    <h2 class="sd-schedule-title">Schedule Visit this school</h2>
                                    <p class="sd-schedule-desc">
                                        Select your preferred date for visit<br />Meet teachers &
                                        explore school's facilities <br>
                                        School visit timings: <b>08:40 AM to 01:40 PM</b>
                                    </p>


                                    <div class="sd-schedule-timings-card">

                                        Your confirmed visit timings will be shared by the school.
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div>
                                    <button class="btn-sd-schedule">
                                        Schedule Visit
                                        <i class="fa-solid fa-chevron-right" style="font-size: 10px"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="col-md-4 d-none d-md-block">
                                <div class="sd-schedule-right">
                                    <div class="sd-schedule-calendar-img">
                                        <img src="{{ asset('assets/images/admission-calender.png') }}" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- 3. Fees Structure Accordion -->
                    <div class="sd-section-card" data-tab-content="fee-structure">
                        <div class="sd-section-header">
                            <h2 class="sd-section-title">Fees Structure</h2>
                            <div class="d-flex gap-2">
                                <select class="form-select" style="
                  font-size: 14px;
                  font-weight: 600;
                  border-radius: 8px;
                  width: 188px;
                ">
                                    <option>Academic Session</option>
                                    <option selected>2026-2027</option>
                                </select>
                                <button class="btn btn-light" style="
                  font-size: 12.5px;
    font-weight: 700;
    border: 1px solid #3771C8;
    color: #3771C8;
    background-color: #3771C812;
    border-radius: 8px;
    padding: 6px 16px;
                ">
                                    Download Fees
                                </button>
                            </div>
                        </div>

                        <div class="row g-4">
                            <!-- Left column: Accordion lists -->
                            <div class="col-lg-8" style="    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;">
                                <div class="sd-fee-accordion-item">
                                    <div class="sd-fee-accordion-header">
                                        <span>Class 6 Fee structure | 2026 - 2027</span>
                                        <div>
                                            <span class="sd-fee-price">18,21,500</span>
                                            <i class="fa-solid fa-chevron-down text-muted"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="sd-fee-accordion-item">
                                    <div class="sd-fee-accordion-header">
                                        <span>Class 7 Fee structure | 2026 - 2027</span>
                                        <div>
                                            <span class="sd-fee-price">18,21,500</span>
                                            <i class="fa-solid fa-chevron-down text-muted"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="sd-fee-accordion-item">
                                    <div class="sd-fee-accordion-header">
                                        <span>Class 8 Fee structure | 2026 - 2027</span>
                                        <div>
                                            <span class="sd-fee-price">18,21,500</span>
                                            <i class="fa-solid fa-chevron-down text-muted"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="sd-fee-accordion-item">
                                    <div class="sd-fee-accordion-header">
                                        <span>Class 9 Fee structure | 2026 - 2027</span>
                                        <div>
                                            <span class="sd-fee-price">18,21,500</span>
                                            <i class="fa-solid fa-chevron-down text-muted"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="sd-fee-accordion-item">
                                    <div class="sd-fee-accordion-header">
                                        <span>Class 10 Fee structure | 2026 - 2027</span>
                                        <div>
                                            <span class="sd-fee-price">18,21,500</span>
                                            <i class="fa-solid fa-chevron-down text-muted"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="sd-fee-accordion-item">
                                    <div class="sd-fee-accordion-header">
                                        <span>Class 11 Fee structure | 2026 - 2027</span>
                                        <div>
                                            <span class="sd-fee-price">18,21,500</span>
                                            <i class="fa-solid fa-chevron-down text-muted"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="sd-fee-accordion-item">
                                    <div class="sd-fee-accordion-header">
                                        <span>Class 12 Fee structure | 2026 - 2027</span>
                                        <div>
                                            <span class="sd-fee-price">18,21,500</span>
                                            <i class="fa-solid fa-chevron-down text-muted"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Right column: Help Widget -->
                            <div class="col-lg-4">
                                <div class="sd-help-widget">
                                    <!-- Question mark avatar drawing -->
                                    <img src="{{ asset('assets/images/need-help-img.png') }}" alt="">
                                    <div style="    display: flex;
    justify-content: space-between;
    width: 100%;
    padding: 0px 25px;
    margin-top: 20px;">
                                        <h4 class="fw-bold mb-3" style="    font-size: 20px;
    font-weight: 500 !important;
    color: #3771C8;">
                                            Need Help?
                                        </h4>
                                        <a href="#" class="btn-sd-callnow"><i class="fa-solid fa-phone"></i> Call
                                            now</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- 4. Photos & Videos -->
                    <div class="sd-section-card" data-tab-content=" photos">
                        <div class="sd-section-header">
                            <h2 class="sd-section-title">Photos & Videos</h2>
                            <button class="btn btn-primary rounded-pill px-4" style="
                background-color: #3771c8;
                border: none;
                font-size: 12.5px;
                font-weight: 700;
                height: 34px;
              ">
                                View all Images
                            </button>
                        </div>

                        <div class="row g-3">
                            <div class="col-md-4 col-sm-6">
                                <div class="sd-gallery-item">
                                    <img src="{{ asset('assets/images/school-img-1.png') }}" alt="Doon School landscape 1" />
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <div class="sd-gallery-item">
                                    <span class="sd-video-play-btn"><i class="fa-solid fa-play"></i></span>
                                    <img src="{{ asset('assets/images/school-img-2.png') }}" alt="Doon School landscape 2" />
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-12">
                                <div class="sd-gallery-item">
                                    <img src="{{ asset('assets/images/school-img-3.png') }}" alt="Doon School landscape 3" />
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- 5. Admission Process Section -->


                    <!-- 6. Student Reviews Section -->
                    <div class="sd-reviews-section text-center" data-tab-content="reviews">
                        <div class="sd-reviews-form-card text-start">
                            <h3 class="fw-bold text-center mb-3" style="font-size: 23px; color: #0d1b2a">
                                Student Review
                            </h3>
                            <p class="text-muted text-center mb-4" style="font-size: 12px">
                                Your review can guide families in choosing the right school.
                            </p>
                            <form class="sd-enquiry-form">
                                <div class="mb-3">
                                    <label class="form-label">Name</label>
                                    <input type="text" placeholder="Enter your name" class="form-control" />
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Email ID</label>
                                    <input type="email" placeholder="Enter email id" class="form-control" />
                                </div>
                                <div class="mb-4">
                                    <label class="form-label">Your Review</label>
                                    <textarea placeholder="Write your review" rows="3" class="form-control"></textarea>
                                </div>
                                <button type="submit" class="btn-sd-submit-enquiry">
                                    Submit Review
                                    <i class="fa-solid fa-chevron-right" style="font-size: 10px"></i>
                                </button>
                            </form>
                        </div>

                        <div class="sd-top-reviews-label">Top Reviews by Students</div>

                        <!-- Review cards slider -->
                        <div class="swiper sd-reviews-swiper">
                            <div class="swiper-wrapper">
                                <!-- Muskan card -->
                                <div class="swiper-slide">
                                    <div class="sd-review-card">
                                        <img src="{{ asset('assets/images/mentor-img-1.png') }}" alt="Muskan avatar"
                                            class="sd-review-avatar" />
                                        <div>
                                            <div class="sd-review-stars">
                                                <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i
                                                    class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i
                                                    class="fa-solid fa-star"></i>
                                            </div>
                                            <h4 class="sd-review-text">calm & good environment</h4>
                                            <span class="sd-review-author">— Muskan</span>
                                        </div>
                                    </div>
                                </div>
                                <!-- Review 2 -->
                                <div class="swiper-slide">
                                    <div class="sd-review-card">
                                        <img src="{{ asset('assets/images/mentor-img-2.png') }}" alt="Student avatar 2"
                                            class="sd-review-avatar" />
                                        <div>
                                            <div class="sd-review-stars">
                                                <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i
                                                    class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i
                                                    class="fa-solid fa-star"></i>
                                            </div>
                                            <h4 class="sd-review-text">nice place and education</h4>
                                            <span class="sd-review-author">— Student</span>
                                        </div>
                                    </div>
                                </div>
                                <!-- Review 3 -->
                                <div class="swiper-slide">
                                    <div class="sd-review-card">
                                        <img src="{{ asset('assets/images/mentor-img-3.png') }}" alt="Student avatar 3"
                                            class="sd-review-avatar" />
                                        <div>
                                            <div class="sd-review-stars">
                                                <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i
                                                    class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i
                                                    class="fa-solid fa-star"></i>
                                            </div>
                                            <h4 class="sd-review-text">Nice faculty great place</h4>
                                            <span class="sd-review-author">— Student</span>
                                        </div>
                                    </div>
                                </div>
                                <!-- Review 4 -->
                                <div class="swiper-slide">
                                    <div class="sd-review-card">
                                        <img src="{{ asset('assets/images/mentor-img-4.png') }}" alt="Student avatar 4"
                                            class="sd-review-avatar" />
                                        <div>
                                            <div class="sd-review-stars">
                                                <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i
                                                    class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i
                                                    class="fa-solid fa-star"></i>
                                            </div>
                                            <h4 class="sd-review-text">Nice faculty great place</h4>
                                            <span class="sd-review-author">— Student</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="sd-review-card">
                                        <img src="{{ asset('assets/images/mentor-img-4.png') }}" alt="Student avatar 4"
                                            class="sd-review-avatar" />
                                        <div>
                                            <div class="sd-review-stars">
                                                <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i
                                                    class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i
                                                    class="fa-solid fa-star"></i>
                                            </div>
                                            <h4 class="sd-review-text">Nice faculty great place</h4>
                                            <span class="sd-review-author">— Student</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="sd-review-card">
                                        <img src="{{ asset('assets/images/mentor-img-4.png') }}" alt="Student avatar 4"
                                            class="sd-review-avatar" />
                                        <div>
                                            <div class="sd-review-stars">
                                                <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i
                                                    class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i
                                                    class="fa-solid fa-star"></i>
                                            </div>
                                            <h4 class="sd-review-text">Nice faculty great place</h4>
                                            <span class="sd-review-author">— Student</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="sd-review-card">
                                        <img src="{{ asset('assets/images/mentor-img-4.png') }}" alt="Student avatar 4"
                                            class="sd-review-avatar" />
                                        <div>
                                            <div class="sd-review-stars">
                                                <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i
                                                    class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i
                                                    class="fa-solid fa-star"></i>
                                            </div>
                                            <h4 class="sd-review-text">Nice faculty great place</h4>
                                            <span class="sd-review-author">— Student</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="sd-review-card">
                                        <img src="{{ asset('assets/images/mentor-img-4.png') }}" alt="Student avatar 4"
                                            class="sd-review-avatar" />
                                        <div>
                                            <div class="sd-review-stars">
                                                <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i
                                                    class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i
                                                    class="fa-solid fa-star"></i>
                                            </div>
                                            <h4 class="sd-review-text">Nice faculty great place</h4>
                                            <span class="sd-review-author">— Student</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- <div class="swiper-pagination reviews-pagination mt-4"></div> -->
                        </div>
                    </div>

                    <!-- 7. Address & Contact Section -->
                    <div data-tab-content="overview" class="school-add-cont">
                        <div class="text-center heading-card">
                            <div class="heading-with-lines d-flex align-items-center justify-content-center gap-3 mb-3">
                                <span class="heading-line d-none d-md-block"></span>
                                <h2 class="section-title mb-0">ADDRESS & CONTACT</h2>
                                <span class="heading-line d-none d-md-block"></span>
                            </div>

                        </div>

                        <div class="row g-4 mb-4">
                            <!-- Col 1 -->
                            <div class="col-md-3 col-sm-6">
                                <div class="sd-contact-card">
                                    <div class="sd-contact-icon">
                                        <i class="fa-solid fa-location-dot"></i>
                                    </div>
                                    <p class="sd-contact-text">
                                        Lorem ipsum dummy text free lorem ipsum dummy text imp free
                                        lorem ipsum dummy text.
                                    </p>
                                </div>
                            </div>
                            <!-- Col 2 -->
                            <div class="col-md-3 col-sm-6">
                                <div class="sd-contact-card">
                                    <div class="sd-contact-icon">
                                        <i class="fa-solid fa-envelope"></i>
                                    </div>
                                    <p class="sd-contact-text">https://enrollzy.com/school</p>
                                </div>
                            </div>
                            <!-- Col 3 -->
                            <div class="col-md-3 col-sm-6">
                                <div class="sd-contact-card">
                                    <div class="sd-contact-icon">
                                        <i class="fa-solid fa-phone"></i>
                                    </div>
                                    <p class="sd-contact-text">+91 9780052489</p>
                                </div>
                            </div>
                            <!-- Col 4 -->
                            <div class="col-md-3 col-sm-6">
                                <div class="sd-contact-card">
                                    <div class="sd-contact-icon">
                                        <i class="fa-solid fa-globe"></i>
                                    </div>
                                    <p class="sd-contact-text">enrollzy@gmail.com</p>
                                </div>
                            </div>
                        </div>

                        <!-- Mock Google Map Graphic -->
                        <div class="sd-map-frame ptb-70">
                           <iframe style="    width: 100%;
    height: 427px;"
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3430.2223849502847!2d76.76450637684824!3d30.726224385966398!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x390fed160a000001%3A0x63334dc2809e53b1!2sSector%2034%2C%20Chandigarh!5e0!3m2!1sen!2sin!4v1700000000000!5m2!1sen!2sin"
                allowfullscreen=""
                loading="lazy"
                referrerpolicy="no-referrer-when-downgrade"
              ></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>

    <!-- Bootstrap Bundle JS -->
    
@endsection
