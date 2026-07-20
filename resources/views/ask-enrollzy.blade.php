@extends('layouts.app')
@section('content')
    <!-- Hero Banner Section -->
    <main class="about-hero-section ptb-70">
        <div class="bg-square">
            <img src="{{ asset('assets/images/banner-square-img.svg') }}" alt="" />
        </div>
        <div class="container">
            <div class="about-hero-container">
                <img src="{{ asset('assets/images/scholarship-page-banner-img.png') }}" alt="Ask Enrollzy Q&A" />

                <!-- Centered Badge / Content Block -->
                <div class="about-us-badge-wrapper">
                    <button class="about-us-badge">Ask Enrollzy Community Q&A</button>
                    <p>Have questions about colleges, cutoffs, entrance exams, or admissions? Ask our verified counselors & alumni community.</p>
                </div>

                <!-- Green Down Arrow Button -->
                <button class="about-scroll-btn" aria-label="Scroll Down">
                    <img style="width: 49px; height: 62px" src="{{ asset('assets/images/inner-banner-down-arror.png') }}" alt="" />
                </button>
            </div>
        </div>
    </main>

    <!-- Breadcrumb -->
    <div class="py-3" style="background-color: #f9ad0b14">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0" style="font-size: 13.5px; font-weight: 500;">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-decoration-none text-muted"><i class="fa-solid fa-house me-1"></i> Home</a></li>
                    <li class="breadcrumb-item active text-primary" aria-current="page">Ask Enrollzy</li>
                </ol>
            </nav>
        </div>
    </div>

    <!-- Main Content Section -->
    <div style="background-color: #FAFBFD; padding: 50px 0;">
        <div class="container">
            
            <!-- Ask Question Header Box -->
            <div class="bg-white rounded-4 p-4 p-md-5 border shadow-sm mb-5">
                <div class="row align-items-center g-4">
                    <div class="col-lg-8">
                        <h1 class="fs-2 fw-bold text-dark mb-2">Got Questions About Colleges or Exams?</h1>
                        <p class="text-muted mb-0">Search thousands of answered questions or post your own query to get expert guidance from verified counselors & alumni.</p>
                    </div>
                    <div class="col-lg-4 text-lg-end">
                        <button type="button" class="btn btn-enrollzy btn-enrollzy-lg" data-bs-toggle="modal" data-bs-target="#askQuestionModal">
                            <i class="fa-solid fa-pen-to-square me-2"></i> Ask A Question
                        </button>
                    </div>
                </div>

                <!-- Search Input Bar -->
                <div class="mt-4 pt-3 border-top">
                    <div class="input-group input-group-lg">
                        <span class="input-group-text bg-light border-end-0"><i class="fa-solid fa-magnifying-glass text-muted"></i></span>
                        <input type="text" class="form-control bg-light border-start-0 ps-0 fs-6" placeholder="Search questions (e.g., 'What is CAT 2026 cutoff for IIM Ahmedabad?', 'Best CBSE schools in Chandigarh')...">
                        <button class="btn btn-primary px-4 fw-bold" type="button">Search</button>
                    </div>
                </div>
            </div>

            <!-- Q&A Main Layout Grid -->
            <div class="row g-4">
                
                <!-- Left Main Column: Question Feed -->
                <div class="col-lg-8">
                    
                    <!-- Filter Navigation Tabs -->
                    <div class="d-flex flex-wrap gap-2 mb-4 border-bottom pb-3">
                        <button class="btn btn-primary btn-sm rounded-pill px-3 active">Trending Questions</button>
                        <button class="btn btn-outline-secondary btn-sm rounded-pill px-3">Recent</button>
                        <button class="btn btn-outline-secondary btn-sm rounded-pill px-3">Unanswered</button>
                        <button class="btn btn-outline-secondary btn-sm rounded-pill px-3">College Cutoffs</button>
                        <button class="btn btn-outline-secondary btn-sm rounded-pill px-3">Entrance Exams</button>
                        <button class="btn btn-outline-secondary btn-sm rounded-pill px-3">Scholarships</button>
                    </div>

                    <!-- Question Card 1 -->
                    <div class="bg-white rounded-4 p-4 border shadow-sm mb-4">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <div class="d-flex align-items-center gap-2">
                                <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center fw-bold" style="width: 38px; height: 38px; font-size: 14px;">RS</div>
                                <div>
                                    <span class="fw-bold text-dark d-block" style="font-size: 14px;">Rohan Srivastava</span>
                                    <span class="text-muted" style="font-size: 11px;">Asked 2 hours ago in <strong class="text-primary">MBA Admissions</strong></span>
                                </div>
                            </div>
                            <span class="badge bg-success-subtle text-success border rounded-pill px-3 py-1" style="font-size: 11px;">
                                <i class="fa-solid fa-circle-check me-1"></i> Verified Answer
                            </span>
                        </div>

                        <h3 class="fs-5 fw-bold text-dark mb-2">What score in CAT is required for non-engineers to get an interview call from IIM Ahmedabad or IIM Bangalore?</h3>
                        <p class="text-muted mb-3 leading-relaxed" style="font-size: 13.5px;">
                            I am a Commerce graduate with a 92% score in 10th and 88% in 12th. I want to know the approximate percentile cutoff required for non-engineering males/females.
                        </p>

                        <!-- Verified Top Answer Highlight Box -->
                        <div class="p-3 bg-light rounded-3 border-start border-4 border-success mb-3">
                            <div class="d-flex align-items-center gap-2 mb-2">
                                <img src="{{ asset('assets/images/mentor1.png') }}" alt="Expert" class="rounded-circle" style="width: 28px; height: 28px; object-fit: cover;">
                                <span class="fw-bold text-dark" style="font-size: 13px;">Aarav Sharma <small class="text-primary font-semibold">(Verified Expert Counselor)</small></span>
                            </div>
                            <p class="text-muted mb-0" style="font-size: 13px;">
                                "For Non-Engineers with strong academic records (9/8/8+ profile), an overall percentile of <strong>98.5%ile to 99.0%ile</strong> is usually sufficient for shortlists at IIM Ahmedabad and IIM Bangalore due to academic diversity points..."
                            </p>
                        </div>

                        <div class="d-flex justify-content-between align-items-center text-muted border-top pt-3" style="font-size: 13px;">
                            <div class="d-flex gap-4">
                                <span><i class="fa-regular fa-thumbs-up me-1 text-primary"></i> 45 Upvotes</span>
                                <span><i class="fa-regular fa-comment me-1 text-primary"></i> 12 Answers</span>
                                <span><i class="fa-regular fa-eye me-1"></i> 1.2k Views</span>
                            </div>
                            <a href="#" class="text-decoration-none text-primary fw-semibold">View All Answers <i class="fa-solid fa-chevron-right ms-1" style="font-size: 10px;"></i></a>
                        </div>
                    </div>

                    <!-- Question Card 2 -->
                    <div class="bg-white rounded-4 p-4 border shadow-sm mb-4">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <div class="d-flex align-items-center gap-2">
                                <div class="bg-warning text-dark rounded-circle d-flex align-items-center justify-content-center fw-bold" style="width: 38px; height: 38px; font-size: 14px;">AP</div>
                                <div>
                                    <span class="fw-bold text-dark d-block" style="font-size: 14px;">Ananya Patel</span>
                                    <span class="text-muted" style="font-size: 11px;">Asked 5 hours ago in <strong class="text-primary">Boarding Schools</strong></span>
                                </div>
                            </div>
                            <span class="badge bg-primary-subtle text-primary border rounded-pill px-3 py-1" style="font-size: 11px;">
                                <i class="fa-solid fa-comments me-1"></i> 8 Community Answers
                            </span>
                        </div>

                        <h3 class="fs-5 fw-bold text-dark mb-2">Which are the top residential boarding schools in Dehradun for Class 6th admission?</h3>
                        <p class="text-muted mb-3 leading-relaxed" style="font-size: 13.5px;">
                            We are planning to enroll our son in Class 6th in a boarding school in Dehradun. Looking for recommendations on CBSE/ICSE schools with good sports & hostel infrastructure.
                        </p>

                        <div class="d-flex justify-content-between align-items-center text-muted border-top pt-3" style="font-size: 13px;">
                            <div class="d-flex gap-4">
                                <span><i class="fa-regular fa-thumbs-up me-1 text-primary"></i> 28 Upvotes</span>
                                <span><i class="fa-regular fa-comment me-1 text-primary"></i> 8 Answers</span>
                                <span><i class="fa-regular fa-eye me-1"></i> 840 Views</span>
                            </div>
                            <a href="#" class="text-decoration-none text-primary fw-semibold">View All Answers <i class="fa-solid fa-chevron-right ms-1" style="font-size: 10px;"></i></a>
                        </div>
                    </div>

                    <!-- Question Card 3 -->
                    <div class="bg-white rounded-4 p-4 border shadow-sm mb-4">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <div class="d-flex align-items-center gap-2">
                                <div class="bg-info text-white rounded-circle d-flex align-items-center justify-content-center fw-bold" style="width: 38px; height: 38px; font-size: 14px;">VK</div>
                                <div>
                                    <span class="fw-bold text-dark d-block" style="font-size: 14px;">Vikram Kaushik</span>
                                    <span class="text-muted" style="font-size: 11px;">Asked 1 day ago in <strong class="text-primary">Scholarships</strong></span>
                                </div>
                            </div>
                            <span class="badge bg-success-subtle text-success border rounded-pill px-3 py-1" style="font-size: 11px;">
                                <i class="fa-solid fa-circle-check me-1"></i> Verified Answer
                            </span>
                        </div>

                        <h3 class="fs-5 fw-bold text-dark mb-2">Are full-tuition fee waiver scholarships available for B.Tech students at private engineering universities?</h3>
                        <p class="text-muted mb-3 leading-relaxed" style="font-size: 13.5px;">
                            Looking for merit-based scholarships based on JEE rank or 12th board marks.
                        </p>

                        <div class="d-flex justify-content-between align-items-center text-muted border-top pt-3" style="font-size: 13px;">
                            <div class="d-flex gap-4">
                                <span><i class="fa-regular fa-thumbs-up me-1 text-primary"></i> 52 Upvotes</span>
                                <span><i class="fa-regular fa-comment me-1 text-primary"></i> 19 Answers</span>
                                <span><i class="fa-regular fa-eye me-1"></i> 1.5k Views</span>
                            </div>
                            <a href="#" class="text-decoration-none text-primary fw-semibold">View All Answers <i class="fa-solid fa-chevron-right ms-1" style="font-size: 10px;"></i></a>
                        </div>
                    </div>

                </div>

                <!-- Right Column: Sidebar Widgets -->
                <div class="col-lg-4">
                    
                    <!-- Popular Categories / Tags Widget -->
                    <div class="bg-white rounded-4 p-4 border shadow-sm mb-4">
                        <h3 class="fs-5 fw-bold text-dark mb-3"><i class="fa-solid fa-fire text-warning me-2"></i> Trending Discussion Topics</h3>
                        <div class="d-flex flex-wrap gap-2">
                            <a href="#" class="badge bg-light text-dark border rounded-pill px-3 py-2 text-decoration-none">#CAT2026Cutoff</a>
                            <a href="#" class="badge bg-light text-dark border rounded-pill px-3 py-2 text-decoration-none">#JEEMainsRank</a>
                            <a href="#" class="badge bg-light text-dark border rounded-pill px-3 py-2 text-decoration-none">#DehradunSchools</a>
                            <a href="#" class="badge bg-light text-dark border rounded-pill px-3 py-2 text-decoration-none">#Scholarships2026</a>
                            <a href="#" class="badge bg-light text-dark border rounded-pill px-3 py-2 text-decoration-none">#StudyInUK</a>
                            <a href="#" class="badge bg-light text-dark border rounded-pill px-3 py-2 text-decoration-none">#NEETPrepTips</a>
                        </div>
                    </div>

                    <!-- Top Expert Contributors Widget -->
                    <div class="bg-white rounded-4 p-4 border shadow-sm mb-4">
                        <h3 class="fs-5 fw-bold text-dark mb-3"><i class="fa-solid fa-award text-primary me-2"></i> Top Answer Contributors</h3>
                        
                        <div class="d-flex align-items-center gap-3 mb-3 border-bottom pb-2">
                            <img src="{{ asset('assets/images/mentor1.png') }}" alt="Aarav" class="rounded-circle" style="width: 42px; height: 42px; object-fit: cover;">
                            <div>
                                <span class="fw-bold text-dark d-block" style="font-size: 14px;">Aarav Sharma <i class="fa-solid fa-circle-check text-primary" style="font-size: 12px;"></i></span>
                                <span class="text-muted" style="font-size: 11px;">142 Verified Answers</span>
                            </div>
                        </div>

                        <div class="d-flex align-items-center gap-3 mb-3 border-bottom pb-2">
                            <img src="{{ asset('assets/images/mentor_1.png') }}" alt="Priya" class="rounded-circle" style="width: 42px; height: 42px; object-fit: cover;">
                            <div>
                                <span class="fw-bold text-dark d-block" style="font-size: 14px;">Priya Verma <i class="fa-solid fa-circle-check text-primary" style="font-size: 12px;"></i></span>
                                <span class="text-muted" style="font-size: 11px;">98 Verified Answers</span>
                            </div>
                        </div>

                        <div class="d-flex align-items-center gap-3">
                            <img src="{{ asset('assets/images/mentor_2.png') }}" alt="Rohan" class="rounded-circle" style="width: 42px; height: 42px; object-fit: cover;">
                            <div>
                                <span class="fw-bold text-dark d-block" style="font-size: 14px;">Rohan Kulkarni <i class="fa-solid fa-circle-check text-primary" style="font-size: 12px;"></i></span>
                                <span class="text-muted" style="font-size: 11px;">86 Verified Answers</span>
                            </div>
                        </div>
                    </div>

                    <!-- Ask Expert Consultation Banner -->
                    <div class="bg-primary text-white rounded-4 p-4 text-center shadow-sm">
                        <i class="fa-solid fa-headset fs-1 mb-3"></i>
                        <h4 class="fw-bold fs-5 mb-2">Need Immediate Guidance?</h4>
                        <p class="text-white-50 mb-3" style="font-size: 13px;">Book a 1:1 direct session with our senior education counselor today.</p>
                        <a href="{{ route('mentors') }}" class="btn btn-light text-primary fw-bold rounded-pill w-100">
                            Explore Mentors <i class="fa-solid fa-arrow-right-long ms-1"></i>
                        </a>
                    </div>

                </div>

            </div>

        </div>
    </div>

    <!-- Ask Question Modal -->
    <div class="modal fade" id="askQuestionModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content rounded-4 border-0 shadow">
                <div class="modal-header border-bottom">
                    <h5 class="modal-title fw-bold text-dark"><i class="fa-solid fa-question-circle text-primary me-2"></i> Ask A Question</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <form action="#" method="POST">
                        <div class="mb-3">
                            <label class="form-label fw-bold" style="font-size: 13px;">Question Title <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" placeholder="e.g. What is the average package at IIM Ahmedabad for freshers?">
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold" style="font-size: 13px;">Select Category <span class="text-danger">*</span></label>
                            <select class="form-select">
                                <option selected>College Admissions</option>
                                <option>Entrance Exams (CAT, JEE, NEET)</option>
                                <option>Boarding Schools</option>
                                <option>Scholarships & Benefits</option>
                                <option>1:1 Mentorship & Careers</option>
                            </select>
                        </div>
                        <div class="mb-4">
                            <label class="form-label fw-bold" style="font-size: 13px;">Detailed Description (Optional)</label>
                            <textarea class="form-control" rows="4" placeholder="Provide background context (e.g. your academic marks, category, budget, target colleges)..."></textarea>
                        </div>
                        <div class="text-end">
                            <button type="button" class="btn btn-secondary rounded-pill px-4 me-2" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-enrollzy rounded-pill px-4">
                                Post Question <i class="fa-solid fa-paper-plane ms-1"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
