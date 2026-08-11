@extends('layouts.app')

@section('content')
<main class="about-hero-section ptb-70">
      <div class="bg-square">
        <img src="{{ asset('assets/images/banner-square-img.svg') }}" alt="" />
      </div>
      <div class="container">
        <div class="about-hero-container">
          <img src="{{ $exam->cover_image ? (str_starts_with($exam->cover_image, 'http') ? $exam->cover_image : rtrim(env('BACKEND_URL', 'http://127.0.0.1:8001'), '/') . '/' . ltrim($exam->cover_image, '/')) : asset('assets/images/top-exam-img.png') }}" alt="{{ $exam->name }}" style="width: 100%; max-height: 400px; object-fit: cover; border-radius: 24px; box-shadow: 0 10px 30px rgba(0,0,0,0.1);" />

          <!-- Centered Badge -->
          <div class="about-us-badge-wrapper">
            <button class="about-us-badge">{{ $exam->name }}</button>
            <p>{{ Str::limit(strip_tags($exam->about_exam ?? ''), 120, '...') }}</p>
          </div>

          <!-- Green Down Arrow Button -->
          <button class="about-scroll-btn" aria-label="Scroll Down">
            <img style="width: 49px; height: 62px" src="{{ asset('assets/images/inner-banner-down-arror.png') }}" alt="" />
          </button>
        </div>
      </div>
    </main>

    <!-- Breadcrumb path -->
    <div class="py-3" style="background-color: #f9ad0b14">
      <div class="container">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb mb-0" style="font-size: 13.5px; font-weight: 500">
            <li class="breadcrumb-item">
              <a href="{{ route('home') }}" class="text-decoration-none text-muted"><i class="fa-solid fa-house me-1"></i> Home</a>
            </li>
            <li class="breadcrumb-item text-primary">
              <a href="{{ route('top-exams') }}" class="text-decoration-none text-primary">Top Exams</a>
            </li>
            <li class="breadcrumb-item active text-primary" aria-current="page">
              {{ $exam->name }}
            </li>
          </ol>
        </nav>
      </div>
    </div>

    <!-- Main Detail Page Section -->
    <section class="py-4" style="background-color: #fafbfd">
      <div class="container">
        <!-- Announcement Banner -->
        <div class="exam-detail-banner">
          <div class="exam-detail-banner-content">
            <div class="exam-detail-banner-logo">
              <img src="{{ $exam->logo ? (str_starts_with($exam->logo, 'http') ? $exam->logo : rtrim(env('BACKEND_URL', 'http://127.0.0.1:8001'), '/') . '/' . ltrim($exam->logo, '/')) : asset('assets/images/top-exam-icon-1.png') }}" alt="{{ $exam->name }}" style="width: 32px; height: 32px; object-fit: contain;" />
            </div>
            <span>{{ $exam->name }} 2026: Official Notification, Exam Dates, Syllabus, Cutoff & Result Updates</span>
          </div>
          <div class="exam-detail-banner-actions">
            <a href="tel:1800-xxx-xxxx" class="btn-banner-counselling">
              <i class="fa-solid fa-phone me-1"></i> Free Counselling
            </a>
            <a href="#exam-content-area" class="btn-banner-mockup">
              Get Free Mock Test <i class="fa-solid fa-chevron-right ms-1" style="font-size: 9px"></i>
            </a>
          </div>
        </div>
      </div>
    </section>

    <!-- Interactive Navigation Tabs Bar -->
    <section style="background-color: #3771c812" class="sticky-top shadow-sm" style="top: 80px; z-index: 90;">
      <div class="container">
        <div class="exam-detail-tabs-bar" id="examDetailTabs">
          <button class="exam-detail-tab-btn active" data-exam-tab="info">Info</button>
          <button class="exam-detail-tab-btn" data-exam-tab="answer-key">Answer Key</button>
          <button class="exam-detail-tab-btn" data-exam-tab="result">Result</button>
          <button class="exam-detail-tab-btn" data-exam-tab="cutoff">Cutoff</button>
          <button class="exam-detail-tab-btn" data-exam-tab="college-predictor">College Predictor</button>
          <button class="exam-detail-tab-btn" data-exam-tab="rank-predictor">Rank Predictor</button>
          <button class="exam-detail-tab-btn" data-exam-tab="counselling">Counselling</button>
          <button class="exam-detail-tab-btn" data-exam-tab="analysis">Analysis</button>
          <button class="exam-detail-tab-btn" data-exam-tab="admit-card">Admit Card</button>
          <button class="exam-detail-tab-btn" data-exam-tab="dates">Dates</button>
          <button class="exam-detail-tab-btn" data-exam-tab="intimation">Intimation</button>
        </div>
      </div>
    </section>

    <!-- Main Content Grid -->
    <section class="py-5" id="exam-content-area">
      <div class="container">
        <div class="row g-4">
          
          <!-- Left Sidebar Column -->
          <div class="col-lg-4 col-md-5">
            <!-- Exam Overview Quick Specs -->
            <div class="detail-sidebar-card mb-4 bg-white p-4 rounded-4 border shadow-sm">
              <h4 class="detail-sidebar-card-title fw-bold mb-3"><i class="fa-solid fa-circle-info text-primary me-2"></i> Quick Exam Overview</h4>
              <ul class="list-unstyled mb-0" style="font-size: 13.5px; line-height: 2;">
                <li class="d-flex justify-content-between border-bottom py-1">
                  <span class="text-muted">Exam Name:</span>
                  <strong class="text-dark text-end">{{ $exam->name }}</strong>
                </li>
                <li class="d-flex justify-content-between border-bottom py-1">
                  <span class="text-muted">Short Name:</span>
                  <strong class="text-primary text-end">{{ $exam->short_name ?? 'N/A' }}</strong>
                </li>
                <li class="d-flex justify-content-between border-bottom py-1">
                  <span class="text-muted">Conducting Body:</span>
                  <strong class="text-dark text-end">{{ $exam->conducting_authority_name ?? 'NTA / National Body' }}</strong>
                </li>
                <li class="d-flex justify-content-between border-bottom py-1">
                  <span class="text-muted">Exam Level:</span>
                  <strong class="text-dark text-end">{{ $exam->exam_type ?? 'National / University Level' }}</strong>
                </li>
                <li class="d-flex justify-content-between border-bottom py-1">
                  <span class="text-muted">Application Mode:</span>
                  <strong class="text-success text-end">Online Portal</strong>
                </li>
                <li class="d-flex justify-content-between py-1">
                  <span class="text-muted">Official Site:</span>
                  <strong class="text-primary text-end">{{ $exam->official_website ?? 'Official Portal' }}</strong>
                </li>
              </ul>
            </div>

            <!-- Upcoming Exams Widget -->
            <div class="detail-sidebar-card mb-4 bg-white p-4 rounded-4 border shadow-sm">
              <h4 class="detail-sidebar-card-title fw-bold mb-3"><i class="fa-solid fa-calendar-check text-warning me-2"></i> Related Entrance Exams</h4>
              <div class="upcoming-exams-list">
                <a href="{{ route('top-exams') }}" class="upcoming-exam-item text-decoration-none d-flex align-items-center gap-3 p-2 rounded-3 mb-2 bg-light">
                  <div class="upcoming-exam-logo rounded-circle overflow-hidden" style="width: 36px; height: 36px; flex-shrink: 0;">
                    <img src="{{ asset('assets/images/gate-logo.png') }}" alt="" style="width: 100%; height: 100%; object-fit: cover;" />
                  </div>
                  <div class="upcoming-exam-info">
                    <span class="upcoming-exam-name fw-bold text-dark d-block" style="font-size: 13px;">JEE Mains 2026</span>
                    <span class="upcoming-exam-date text-muted" style="font-size: 11px;"><i class="fa-regular fa-calendar me-1"></i> National Level Exam</span>
                  </div>
                </a>
                <a href="{{ route('top-exams') }}" class="upcoming-exam-item text-decoration-none d-flex align-items-center gap-3 p-2 rounded-3 mb-2 bg-light">
                  <div class="upcoming-exam-logo rounded-circle overflow-hidden" style="width: 36px; height: 36px; flex-shrink: 0;">
                    <img src="{{ asset('assets/images/gate-logo.png') }}" alt="" style="width: 100%; height: 100%; object-fit: cover;" />
                  </div>
                  <div class="upcoming-exam-info">
                    <span class="upcoming-exam-name fw-bold text-dark d-block" style="font-size: 13px;">CAT 2026</span>
                    <span class="upcoming-exam-date text-muted" style="font-size: 11px;"><i class="fa-regular fa-calendar me-1"></i> Management Entrance</span>
                  </div>
                </a>
              </div>
            </div>

            <!-- Free Counseling CTA Widget -->
            <div class="bg-primary text-white p-4 rounded-4 text-center shadow-sm">
              <i class="fa-solid fa-headset fs-1 mb-2"></i>
              <h4 class="fw-bold fs-5 mb-2">Need Exam Guidance?</h4>
              <p class="text-white-50 mb-3" style="font-size: 13px;">Talk to our expert admission counselors for personalized preparation tips & cutoff guidance.</p>
              <a href="{{ route('mentors') }}" class="btn btn-light text-primary fw-bold rounded-pill w-100">
                Talk to Counselor <i class="fa-solid fa-arrow-right ms-1"></i>
              </a>
            </div>
          </div>

          <!-- Right Main Content Column -->
          <div class="col-lg-8 col-md-7">
            
            <!-- 1. INFO TAB PANE -->
            <div data-exam-pane="info" class="bg-white p-4 p-md-5 rounded-4 border shadow-sm mb-4">
              <h2 class="fs-4 fw-bold mb-3 text-dark"><i class="fa-solid fa-circle-info text-primary me-2"></i> About {{ $exam->name }}</h2>
              <div class="leading-relaxed text-muted mb-4 fs-6">
                {!! $exam->about_exam ?: '<p>'.$exam->name.' is a key national entrance exam evaluated for university admissions across top colleges and institutions in India.</p>' !!}
              </div>

              @if($exam->sections && $exam->sections->count() > 0)
                @foreach($exam->sections as $sec)
                <div class="border-top pt-4 mt-4">
                  @php
                    $headingVal = $sec->title ?? $sec->heading ?? $sec->tab_name ?? '';
                    if (is_array($headingVal)) {
                        $headingVal = implode(' ', array_filter($headingVal, 'is_string'));
                    }
                  @endphp
                  <h3 class="fs-5 fw-bold text-dark mb-2">{{ $headingVal }}</h3>
                  <div class="text-muted leading-relaxed" style="font-size: 14px;">
                    @php
                      $cVal = $sec->content ?? $sec->description ?? '';
                      if (is_array($cVal)) {
                          $htmlOut = '';
                          foreach ($cVal as $item) {
                              if (is_array($item)) {
                                  $htmlOut .= implode(' ', array_filter($item, 'is_string'));
                              } elseif (is_string($item)) {
                                  $htmlOut .= $item;
                              }
                          }
                          $cVal = $htmlOut;
                      }
                    @endphp
                    {!! $cVal !!}
                  </div>
                </div>
                @endforeach
              @endif
            </div>

            <!-- 2. ANSWER KEY TAB PANE -->
            <div data-exam-pane="answer-key" class="bg-white p-4 p-md-5 rounded-4 border shadow-sm mb-4" style="display: none;">
              <h2 class="fs-4 fw-bold mb-3 text-dark"><i class="fa-solid fa-key text-warning me-2"></i> {{ $exam->name }} Answer Key 2026</h2>
              <p class="text-muted mb-4">The official answer key for {{ $exam->name }} will be released shortly after the exam conclusion. Candidates can challenge provisional answer keys online by submitting supporting documents.</p>

              <div class="p-3 bg-light rounded-3 border mb-4">
                <h5 class="fw-bold fs-6 mb-2">How to Check Answer Key:</h5>
                <ol class="ps-3 text-muted mb-0" style="font-size: 13.5px; line-height: 1.8;">
                  <li>Visit the official examination portal: <strong>{{ $exam->official_website ?? 'Official Website' }}</strong></li>
                  <li>Click on the link <strong>"{{ $exam->name }} Answer Key Challenge Portal"</strong>.</li>
                  <li>Log in using your Application Number and Password / Date of Birth.</li>
                  <li>Download your Response Sheet along with the Official Provisional Master Answer Key.</li>
                </ol>
              </div>

              @if(!empty($exam->official_website))
                <a href="{{ str_starts_with($exam->official_website, 'http') ? $exam->official_website : 'https://' . $exam->official_website }}" target="_blank" class="btn btn-primary rounded-pill px-4 fw-bold">Check Official Answer Key Portal <i class="fa-solid fa-arrow-right ms-1"></i></a>
              @endif
            </div>

            <!-- 3. RESULT TAB PANE -->
            <div data-exam-pane="result" class="bg-white p-4 p-md-5 rounded-4 border shadow-sm mb-4" style="display: none;">
              <h2 class="fs-4 fw-bold mb-3 text-dark"><i class="fa-solid fa-trophy text-success me-2"></i> {{ $exam->name }} Scorecard & Result 2026</h2>
              <p class="text-muted mb-4">Results for {{ $exam->name }} will be announced online. Scores are normalized across sessions to determine final percentiles and merit ranks.</p>

              <div class="row g-3 mb-4">
                <div class="col-md-6">
                  <div class="p-3 border rounded-3 bg-light text-center">
                    <span class="text-muted fw-bold d-block mb-1" style="font-size: 12px;">Result Mode</span>
                    <strong class="fs-6 text-dark">Online Scorecard Download</strong>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="p-3 border rounded-3 bg-light text-center">
                    <span class="text-muted fw-bold d-block mb-1" style="font-size: 12px;">Score Validity</span>
                    <strong class="fs-6 text-success">1 Academic Year (2026-2027)</strong>
                  </div>
                </div>
              </div>

              @if(!empty($exam->official_website))
                <a href="{{ str_starts_with($exam->official_website, 'http') ? $exam->official_website : 'https://' . $exam->official_website }}" target="_blank" class="btn btn-success rounded-pill px-4 fw-bold">Check Scorecard Portal <i class="fa-solid fa-arrow-right ms-1"></i></a>
              @endif
            </div>

            <!-- 4. CUTOFF TAB PANE -->
            <div data-exam-pane="cutoff" class="bg-white p-4 p-md-5 rounded-4 border shadow-sm mb-4" style="display: none;">
              <h2 class="fs-4 fw-bold mb-3 text-dark"><i class="fa-solid fa-chart-line text-info me-2"></i> {{ $exam->name }} Expected Cutoff 2026</h2>
              <p class="text-muted mb-4">Cutoffs vary depending on seat capacity, number of test-takers, and exam difficulty level.</p>

              <div class="table-responsive mb-4">
                <table class="table table-bordered align-middle">
                  <thead class="table-light">
                    <tr>
                      <th>Category</th>
                      <th>Expected Qualifying Percentile</th>
                      <th>Expected Score Range</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td class="fw-bold text-dark">General (UR)</td>
                      <td class="text-primary fw-bold">90.5 - 92.0 %ile</td>
                      <td>120 - 150 Marks</td>
                    </tr>
                    <tr>
                      <td class="fw-bold text-dark">EWS</td>
                      <td class="text-primary fw-bold">75.0 - 78.0 %ile</td>
                      <td>95 - 115 Marks</td>
                    </tr>
                    <tr>
                      <td class="fw-bold text-dark">OBC-NCL</td>
                      <td class="text-primary fw-bold">73.0 - 76.0 %ile</td>
                      <td>90 - 110 Marks</td>
                    </tr>
                    <tr>
                      <td class="fw-bold text-dark">SC</td>
                      <td class="text-primary fw-bold">52.0 - 55.0 %ile</td>
                      <td>65 - 80 Marks</td>
                    </tr>
                    <tr>
                      <td class="fw-bold text-dark">ST</td>
                      <td class="text-primary fw-bold">38.0 - 42.0 %ile</td>
                      <td>45 - 60 Marks</td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>

            <!-- 5. COLLEGE PREDICTOR TAB PANE -->
            <div data-exam-pane="college-predictor" class="bg-white p-4 p-md-5 rounded-4 border shadow-sm mb-4" style="display: none;">
              <h2 class="fs-4 fw-bold mb-3 text-dark"><i class="fa-solid fa-graduation-cap text-primary me-2"></i> {{ $exam->name }} College Predictor 2026</h2>
              <p class="text-muted mb-4">Predict your chances of admission into top universities & colleges based on your rank or expected percentile score.</p>

              <div class="p-4 bg-light rounded-4 border mb-4">
                <form action="#" method="GET" class="row g-3">
                  <div class="col-md-6">
                    <label class="form-label fw-bold" style="font-size: 13px;">Enter Your Expected Rank / Percentile</label>
                    <input type="number" class="form-control" placeholder="e.g. 95.5 or 15000">
                  </div>
                  <div class="col-md-6">
                    <label class="form-label fw-bold" style="font-size: 13px;">Select Reservation Category</label>
                    <select class="form-select">
                      <option selected>General / Unreserved</option>
                      <option>OBC-NCL</option>
                      <option>SC / ST</option>
                      <option>EWS</option>
                    </select>
                  </div>
                  <div class="col-12 text-end">
                    <button type="button" class="btn btn-primary rounded-pill px-4 fw-bold">
                      Predict Eligible Colleges <i class="fa-solid fa-wand-magic-sparkles ms-1"></i>
                    </button>
                  </div>
                </form>
              </div>
            </div>

            <!-- 6. RANK PREDICTOR TAB PANE -->
            <div data-exam-pane="rank-predictor" class="bg-white p-4 p-md-5 rounded-4 border shadow-sm mb-4" style="display: none;">
              <h2 class="fs-4 fw-bold mb-3 text-dark"><i class="fa-solid fa-calculator text-danger me-2"></i> {{ $exam->name }} Marks vs Rank Predictor</h2>
              <p class="text-muted mb-4">Estimate your expected rank based on your total raw marks before the official scorecard release.</p>

              <div class="table-responsive">
                <table class="table table-bordered align-middle">
                  <thead class="table-light">
                    <tr>
                      <th>Raw Score Range</th>
                      <th>Expected Percentile Range</th>
                      <th>Estimated All India Rank</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td class="fw-bold">250 - 300</td>
                      <td class="text-success fw-bold">99.8+ %ile</td>
                      <td>AIR 1 - 500</td>
                    </tr>
                    <tr>
                      <td class="fw-bold">200 - 249</td>
                      <td class="text-success fw-bold">99.0 - 99.7 %ile</td>
                      <td>AIR 501 - 3,500</td>
                    </tr>
                    <tr>
                      <td class="fw-bold">160 - 199</td>
                      <td class="text-primary fw-bold">97.0 - 98.9 %ile</td>
                      <td>AIR 3,501 - 12,000</td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>

            <!-- 7. COUNSELLING TAB PANE -->
            <div data-exam-pane="counselling" class="bg-white p-4 p-md-5 rounded-4 border shadow-sm mb-4" style="display: none;">
              <h2 class="fs-4 fw-bold mb-3 text-dark"><i class="fa-solid fa-handshake-angle text-warning me-2"></i> {{ $exam->name }} Counselling & Choice Filling</h2>
              <p class="text-muted mb-4">Counselling registration, choice filling, locking, and seat allotment rounds details.</p>
              
              <ul class="list-group list-group-flush mb-4">
                <li class="list-group-item px-0"><strong>Round 1 Registration & Choice Locking:</strong> Online seat preference registration.</li>
                <li class="list-group-item px-0"><strong>Mock Seat Allotment:</strong> Provides an idea of seat eligibility based on submitted choices.</li>
                <li class="list-group-item px-0"><strong>Seat Acceptance & Freeze/Float Options:</strong> Candidates confirm allotted seats.</li>
              </ul>
            </div>

            <!-- 8. ANALYSIS TAB PANE -->
            <div data-exam-pane="analysis" class="bg-white p-4 p-md-5 rounded-4 border shadow-sm mb-4" style="display: none;">
              <h2 class="fs-4 fw-bold mb-3 text-dark"><i class="fa-solid fa-magnifying-glass-chart text-primary me-2"></i> {{ $exam->name }} Difficulty & Paper Analysis</h2>
              <p class="text-muted mb-4">Subject-wise difficulty breakdown and expert review of the recent exam shifts.</p>
              <div class="p-3 bg-light rounded-3 border">
                <h5 class="fw-bold fs-6 mb-2">Expert Feedback Summary:</h5>
                <p class="text-muted mb-0" style="font-size: 13.5px;">The overall difficulty level was moderate. Conceptual questions dominated the mathematics section, while physics and chemistry questions were direct and NCERT-based.</p>
              </div>
            </div>

            <!-- 9. ADMIT CARD TAB PANE -->
            <div data-exam-pane="admit-card" class="bg-white p-4 p-md-5 rounded-4 border shadow-sm mb-4" style="display: none;">
              <h2 class="fs-4 fw-bold mb-3 text-dark"><i class="fa-solid fa-id-card text-success me-2"></i> How to Download {{ $exam->name }} Admit Card 2026</h2>
              
              @php
                $admitCardSection = $exam->sections ? $exam->sections->first(function($sec) {
                    $secTitle = $sec->heading ?? $sec->title ?? $sec->tab_name ?? '';
                    $title = strtolower(is_array($secTitle) ? implode(' ', $secTitle) : (string)$secTitle);
                    return str_contains($title, 'admit');
                }) : null;
              @endphp

              @if($admitCardSection && !empty($admitCardSection->content))
                @php
                  $admitContent = $admitCardSection->content;
                  if (is_array($admitContent)) {
                      $htmlOut = '';
                      foreach ($admitContent as $item) {
                          if (is_array($item)) {
                              $htmlOut .= implode(' ', array_filter($item, 'is_string'));
                          } elseif (is_string($item)) {
                              $htmlOut .= $item;
                          }
                      }
                      $admitContent = $htmlOut;
                  }
                @endphp
                <div class="text-muted leading-relaxed mb-4 fs-6">
                  {!! $admitContent !!}
                </div>
              @else
                <p class="text-muted mb-4">Follow these simple step-by-step instructions to download your official {{ $exam->name }} 2026 Admit Card / Hall Ticket online:</p>

                <div class="p-4 bg-light rounded-4 border mb-4">
                  <h5 class="fw-bold fs-6 mb-3 text-dark"><i class="fa-solid fa-list-check text-primary me-2"></i> How to Download Admit Card (Step-by-Step):</h5>
                  <ol class="ps-3 text-muted mb-0" style="font-size: 14px; line-height: 2;">
                    <li>Visit the official examination portal: 
                      @if($exam->official_website)
                        <a href="{{ str_starts_with($exam->official_website, 'http') ? $exam->official_website : 'https://' . $exam->official_website }}" target="_blank" class="fw-bold text-primary">{{ $exam->official_website }}</a>
                      @else
                        <strong class="text-primary">Official Examination Portal</strong>
                      @endif
                    </li>
                    <li>Look for the link titled <strong>"Download {{ $exam->name }} 2026 Admit Card / Hall Ticket"</strong> on the homepage.</li>
                    <li>Enter your <strong>Application Number / User ID</strong> and <strong>Password / Date of Birth (DD/MM/YYYY)</strong>.</li>
                    <li>Submit the security captcha code displayed on the screen and click on <strong>Login / Submit</strong>.</li>
                    <li>Your {{ $exam->name }} Admit Card will appear on screen. Verify all details such as Candidate Name, Roll Number, Exam Center Address, Date & Shift Timings.</li>
                    <li>Click <strong>Download PDF</strong> and take a color printout for exam day entry.</li>
                  </ol>
                </div>
              @endif

              <div class="d-flex flex-wrap gap-3 align-items-center">
                @if(!empty($exam->official_website))
                  <a href="{{ str_starts_with($exam->official_website, 'http') ? $exam->official_website : 'https://' . $exam->official_website }}" target="_blank" class="btn btn-success rounded-pill px-4 py-2 fw-bold">
                    <i class="fa-solid fa-download me-2"></i> Download Official Admit Card
                  </a>
                @endif
                <a href="tel:1800-xxx-xxxx" class="btn btn-outline-primary rounded-pill px-4 py-2 fw-bold">
                  <i class="fa-solid fa-headset me-2"></i> Helpdesk Support
                </a>
              </div>
            </div>

            <!-- 10. DATES TAB PANE -->
            <div data-exam-pane="dates" class="bg-white p-4 p-md-5 rounded-4 border shadow-sm mb-4" style="display: none;">
              <h2 class="fs-4 fw-bold mb-3 text-dark"><i class="fa-solid fa-calendar-days text-primary me-2"></i> {{ $exam->name }} 2026 Important Exam Dates</h2>
              <div class="table-responsive">
                <table class="table table-bordered align-middle">
                  <thead class="table-light">
                    <tr>
                      <th>Event</th>
                      <th>Official Date</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>Online Application Start</td>
                      <td class="fw-bold">15 Nov 2025</td>
                    </tr>
                    <tr>
                      <td>Last Date to Submit Application</td>
                      <td class="fw-bold">15 Jan 2026</td>
                    </tr>
                    <tr>
                      <td>Admit Card Release Date</td>
                      <td class="fw-bold">3 Days before Exam</td>
                    </tr>
                    <tr>
                      <td>Examination Dates</td>
                      <td class="fw-bold text-primary">24 Jan - 01 Feb 2026</td>
                    </tr>
                    <tr>
                      <td>Result Declaration Date</td>
                      <td class="fw-bold text-success">12 Feb 2026</td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>

            <!-- 11. INTIMATION TAB PANE -->
            <div data-exam-pane="intimation" class="bg-white p-4 p-md-5 rounded-4 border shadow-sm mb-4" style="display: none;">
              <h2 class="fs-4 fw-bold mb-3 text-dark"><i class="fa-solid fa-location-dot text-danger me-2"></i> {{ $exam->name }} Exam City Intimation Slip</h2>
              <p class="text-muted mb-4">Check your allotted examination city ahead of hall ticket issuance to plan your travel and logistics.</p>
              @if(!empty($exam->official_website))
                <a href="{{ str_starts_with($exam->official_website, 'http') ? $exam->official_website : 'https://' . $exam->official_website }}" target="_blank" class="btn btn-outline-primary rounded-pill px-4 fw-bold">Check City Allotment Slip <i class="fa-solid fa-arrow-right ms-1"></i></a>
              @endif
            </div>

          </div>
        </div>
      </div>
    </section>

    <!-- Tab Switcher Script -->
    <script>
      document.addEventListener("DOMContentLoaded", function () {
        const tabBtns = document.querySelectorAll("[data-exam-tab]");
        const tabPanes = document.querySelectorAll("[data-exam-pane]");

        function switchExamTab(tabId) {
          tabBtns.forEach(btn => {
            if (btn.getAttribute("data-exam-tab") === tabId) {
              btn.classList.add("active");
            } else {
              btn.classList.remove("active");
            }
          });

          tabPanes.forEach(pane => {
            if (pane.getAttribute("data-exam-pane") === tabId) {
              pane.style.display = "block";
            } else {
              pane.style.display = "none";
            }
          });
        }

        tabBtns.forEach(btn => {
          btn.addEventListener("click", function () {
            const target = this.getAttribute("data-exam-tab");
            switchExamTab(target);
          });
        });

        // Default to 'info'
        switchExamTab("info");
      });
    </script>
@endsection