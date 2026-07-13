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
                        <li class="faq-topic-item active">All Topics</li>
                        <li class="faq-topic-item">Online Degree FAQs</li>
                        <li class="faq-topic-item">Admission FAQs</li>
                        <li class="faq-topic-item">Degrees & Courses</li>
                        <li class="faq-topic-item">Top Universities & Rankings</li>
                        <li class="faq-topic-item">Technology, Engg & Future Skills</li>
                        <li class="faq-topic-item">Career & Job Prospects</li>
                        <li class="faq-topic-item">Fees & Cost of Education</li>
                        <li class="faq-topic-item">Placements & Career FAQs</li>
                        <li class="faq-topic-item">Scholarships & Financial Aid</li>
                        <li class="faq-topic-item">Course Selection FAQs</li>
                        <li class="faq-topic-item">Exam FAQs</li>
                    </ul>

                    <div class="faq-contact-widget">
                        <h4 class="faq-contact-title">Still have a questions?</h4>
                        <p class="faq-contact-text">if you didn't find your answer, feel free to reach out.</p>
                        <button class="btn-faq-contact">Contact Support</button>
                    </div>
                </div>

                <!-- Right Accordion Column -->
                <div class="col-lg-8 col-md-8">
                    <div class="faq-active-badge">Online Degree FAQs</div>

                    <div class="accordion" id="faqAccordion">
                        <!-- Accordion 1 (Expanded) -->
                        <div class="faq-accordion-item">
                            <div class="faq-accordion-header" data-bs-toggle="collapse" data-bs-target="#faq-collapse-1" aria-expanded="true">
                                <span>Are online degrees valid in India?</span>
                                <i class="fa-solid fa-minus text-muted" style="font-size: 13px;"></i>
                            </div>
                            <div id="faq-collapse-1" class="collapse show" data-bs-parent="#faqAccordion">
                                <div class="faq-accordion-content">
                                    Yes. Online degrees offered by UGC-entitled universities are valid and recognized for higher education, employment, and competitive examinations.
                                </div>
                            </div>
                        </div>

                        <!-- Accordion 2 -->
                        <div class="faq-accordion-item">
                            <div class="faq-accordion-header collapsed" data-bs-toggle="collapse" data-bs-target="#faq-collapse-2" aria-expanded="false">
                                <span>Is an online MBA worth it?</span>
                                <i class="fa-solid fa-plus text-muted" style="font-size: 13px;"></i>
                            </div>
                            <div id="faq-collapse-2" class="collapse" data-bs-parent="#faqAccordion">
                                <div class="faq-accordion-content">
                                    Yes, an online MBA is highly worth it for working professionals as it offers flexibility, UGC recognition, and same career opportunities as a regular MBA.
                                </div>
                            </div>
                        </div>

                        <!-- Accordion 3 -->
                        <div class="faq-accordion-item">
                            <div class="faq-accordion-header collapsed" data-bs-toggle="collapse" data-bs-target="#faq-collapse-3" aria-expanded="false">
                                <span>How do exams work in online degrees?</span>
                                <i class="fa-solid fa-plus text-muted" style="font-size: 13px;"></i>
                            </div>
                            <div id="faq-collapse-3" class="collapse" data-bs-parent="#faqAccordion">
                                <div class="faq-accordion-content">
                                    Online degree exams are typically conducted online via remote proctoring or at designated offline exam centers, depending on the university.
                                </div>
                            </div>
                        </div>

                        <!-- Accordion 4 -->
                        <div class="faq-accordion-item">
                            <div class="faq-accordion-header collapsed" data-bs-toggle="collapse" data-bs-target="#faq-collapse-4" aria-expanded="false">
                                <span>Can I study abroad after an online degree?</span>
                                <i class="fa-solid fa-plus text-muted" style="font-size: 13px;"></i>
                            </div>
                            <div id="faq-collapse-4" class="collapse" data-bs-parent="#faqAccordion">
                                <div class="faq-accordion-content">
                                    Yes, UGC-recognized online degrees are widely accepted by international universities and credential evaluation services like WES for studying abroad.
                                </div>
                            </div>
                        </div>

                        <!-- Accordion 5 -->
                        <div class="faq-accordion-item">
                            <div class="faq-accordion-header collapsed" data-bs-toggle="collapse" data-bs-target="#faq-collapse-5" aria-expanded="false">
                                <span>What is the duration of online UG and PG courses?</span>
                                <i class="fa-solid fa-plus text-muted" style="font-size: 13px;"></i>
                            </div>
                            <div id="faq-collapse-5" class="collapse" data-bs-parent="#faqAccordion">
                                <div class="faq-accordion-content">
                                    Generally, online Undergraduate (UG) degrees take 3 years, while Postgraduate (PG) degrees take 2 years to complete, matching regular courses.
                                </div>
                            </div>
                        </div>

                        <!-- Accordion 6 -->
                        <div class="faq-accordion-item">
                            <div class="faq-accordion-header collapsed" data-bs-toggle="collapse" data-bs-target="#faq-collapse-6" aria-expanded="false">
                                <span>Is there any placement support?</span>
                                <i class="fa-solid fa-plus text-muted" style="font-size: 13px;"></i>
                            </div>
                            <div id="faq-collapse-6" class="collapse" data-bs-parent="#faqAccordion">
                                <div class="faq-accordion-content">
                                    Yes, most top-tier online universities provide dedicated placement assistance, virtual job fairs, resume building, and interview preparation support.
                                </div>
                            </div>
                        </div>

                        <!-- Accordion 7 -->
                        <div class="faq-accordion-item">
                            <div class="faq-accordion-header collapsed" data-bs-toggle="collapse" data-bs-target="#faq-collapse-7" aria-expanded="false">
                                <span>How can I apply for admission?</span>
                                <i class="fa-solid fa-plus text-muted" style="font-size: 13px;"></i>
                            </div>
                            <div id="faq-collapse-7" class="collapse" data-bs-parent="#faqAccordion">
                                <div class="faq-accordion-content">
                                    You can apply online directly through our portal by uploading required documents, paying the application fee, and submitting the form.
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
