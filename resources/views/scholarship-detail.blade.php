@extends('layouts.app')

@section('meta_title', $benefit->title . ' - Scholarships & Benefits | Enrollzy')
@section('meta_description', $benefit->meta_description ?: Str::limit($benefit->short_description ?: strip_tags($benefit->overview), 160))

@section('content')
<main>
    <!-- Breadcrumb path -->
    <div class="py-3" style="background-color: #f9ad0b14; position: relative; z-index: 5;">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0" style="font-size: 13.5px; font-weight: 500;">
                    <li class="breadcrumb-item">
                        <a href="{{ route('home') }}" class="text-decoration-none text-muted"><i class="fa-solid fa-house me-1"></i> Home</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('scholarships') }}" class="text-decoration-none text-muted">Scholarships & Benefits</a>
                    </li>
                    <li class="breadcrumb-item active text-primary" aria-current="page">{{ Str::limit($benefit->title, 45) }}</li>
                </ol>
            </nav>
        </div>
    </div>

    <!-- Scholarship Detail Header -->
    <section class="py-5" style="background: linear-gradient(135deg, #0F59C7 0%, #083880 100%); color: #fff;">
        <div class="container">
            <div class="row align-items-center g-4">
                <div class="col-lg-8">
                    <div class="d-flex flex-wrap align-items-center gap-2 mb-3">
                        <span class="badge bg-success px-3 py-2 rounded-pill"><i class="fa-solid fa-circle-check me-1"></i> Verified Program</span>
                        @if($benefit->max_amount)
                            <span class="badge bg-warning text-dark px-3 py-2 rounded-pill"><i class="fa-solid fa-lightbulb me-1"></i> {{ $benefit->amount_prefix }} ₹{{ number_format($benefit->max_amount, 0) }} {{ $benefit->amount_suffix }}</span>
                        @endif
                    </div>
                    <h1 class="display-6 fw-bold mb-3">{{ $benefit->title }}</h1>
                    @if($benefit->short_description)
                        <p class="lead text-white-50 mb-4" style="max-width: 750px;">
                            {{ $benefit->short_description }}
                        </p>
                    @else
                        <p class="lead text-white-50 mb-4" style="max-width: 750px;">
                            Explore complete eligibility requirements, financial aid details, and step-by-step application guidance for this student benefit program.
                        </p>
                    @endif
                    <div class="d-flex flex-wrap gap-3">
                        @if($benefit->cta_url)
                            <a href="{{ $benefit->cta_url }}" target="_blank" class="btn btn-warning btn-lg fw-bold text-dark px-4 rounded-pill">
                                <i class="fa-solid fa-paper-plane me-2"></i> {{ $benefit->cta_text ?: 'Apply Now' }}
                            </a>
                        @else
                            <a href="#applySection" class="btn btn-warning btn-lg fw-bold text-dark px-4 rounded-pill">
                                <i class="fa-solid fa-paper-plane me-2"></i> Apply for Assistance
                            </a>
                        @endif
                        <a href="{{ url('/scholarships-and-benefits') }}" class="btn btn-outline-light btn-lg px-4 rounded-pill">
                            <i class="fa-solid fa-arrow-left me-2"></i> Back to Scholarships
                        </a>
                    </div>
                </div>
                <div class="col-lg-4 text-center">
                    <div class="p-4 bg-white rounded-4 shadow text-dark d-inline-block w-100" style="max-width: 320px;">
                        <img src="{{ $benefit->featured_image ? (str_starts_with($benefit->featured_image, 'http') ? $benefit->featured_image : (file_exists(public_path($benefit->featured_image)) ? asset($benefit->featured_image) : rtrim(env('BACKEND_URL', 'http://127.0.0.1:8001'), '/') . '/' . ltrim($benefit->featured_image, '/'))) : asset('assets/images/scholarship-card-img.png') }}" alt="{{ $benefit->title }}" class="img-fluid mb-3" style="max-height: 120px; object-fit: contain;">
                        <h6 class="text-muted small text-uppercase fw-bold mb-1">Benefit Reward</h6>
                        <div class="h3 fw-bold text-primary mb-3">
                            @if($benefit->max_amount)
                                {{ $benefit->amount_prefix }} ₹{{ number_format($benefit->max_amount, 0) }}
                            @else
                                Reward Details Inside
                            @endif
                        </div>
                        <a href="#applySection" class="btn btn-enrollzy btn-enrollzy-sm w-100">Get Free Assistance</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Main Content Body -->
    <section class="py-5" style="background-color: #FAFBFD;">
        <div class="container">
            <div class="row g-4">
                <!-- Main Detail Column -->
                <div class="col-lg-8">
                    <!-- Overview Card -->
                    <div class="card border-0 shadow-sm rounded-4 mb-4">
                        <div class="card-body p-4 p-md-5">
                            <h3 class="fw-bold text-dark mb-4 pb-2 border-bottom">
                                <i class="fa-solid fa-circle-info text-primary me-2"></i> Program Overview
                            </h3>
                            <div class="fs-6 text-secondary lh-lg mb-4">
                                {!! $benefit->overview ?: nl2br(e($benefit->short_description)) !!}
                            </div>

                            @if($benefit->about_scholarship)
                                <h4 class="fw-bold text-dark mt-4 mb-3"><i class="fa-solid fa-graduation-cap text-primary me-2"></i> About the Scholarship</h4>
                                <div class="fs-6 text-secondary lh-lg mb-4">{!! $benefit->about_scholarship !!}</div>
                            @endif

                            @if($benefit->why_apply)
                                <h4 class="fw-bold text-dark mt-4 mb-3"><i class="fa-solid fa-check-circle text-success me-2"></i> Why You Should Apply</h4>
                                <div class="fs-6 text-secondary lh-lg mb-4">{!! $benefit->why_apply !!}</div>
                            @endif

                            @if($benefit->selection_process)
                                <h4 class="fw-bold text-dark mt-4 mb-3"><i class="fa-solid fa-user-check text-primary me-2"></i> Selection Process</h4>
                                <div class="fs-6 text-secondary lh-lg mb-4">{!! $benefit->selection_process !!}</div>
                            @endif

                            @if($benefit->terms_conditions)
                                <h4 class="fw-bold text-dark mt-4 mb-3"><i class="fa-solid fa-scale-balanced text-primary me-2"></i> Terms & Conditions</h4>
                                <div class="fs-6 text-secondary lh-lg mb-4">{!! $benefit->terms_conditions !!}</div>
                            @endif

                            @if($benefit->important_notes)
                                <div class="alert alert-warning border-0 rounded-4 p-4 mt-4 mb-4">
                                    <h5 class="fw-bold text-warning-emphasis mb-2"><i class="fa-solid fa-circle-exclamation me-2"></i> Important Notes</h5>
                                    <div class="text-warning-emphasis mb-0">{!! $benefit->important_notes !!}</div>
                                </div>
                            @endif

                            <!-- Eligibility Criteria -->
                            @if($benefit->eligibility)
                            <h4 class="fw-bold text-dark mt-5 mb-3"><i class="fa-solid fa-clipboard-list text-primary me-2"></i> Eligibility Criteria</h4>
                            <div class="table-responsive mb-4">
                                <table class="table table-bordered align-middle">
                                    <tbody>
                                        @if($benefit->eligibility->minimum_class)
                                        <tr>
                                            <th class="bg-light" style="width: 250px;">Education Level</th>
                                            <td>Min: {{ $benefit->eligibility->minimum_class }} @if($benefit->eligibility->maximum_class) - Max: {{ $benefit->eligibility->maximum_class }} @endif</td>
                                        </tr>
                                        @endif
                                        @if($benefit->eligibility->minimum_percentage)
                                        <tr>
                                            <th class="bg-light">Academic Score Required</th>
                                            <td>Minimum of {{ $benefit->eligibility->minimum_percentage }}% in last qualifying exam</td>
                                        </tr>
                                        @endif
                                        @if($benefit->eligibility->gender && $benefit->eligibility->gender !== 'Any')
                                        <tr>
                                            <th class="bg-light">Gender preference</th>
                                            <td>{{ $benefit->eligibility->gender }} candidates only</td>
                                        </tr>
                                        @endif
                                        @if($benefit->eligibility->annual_family_income)
                                        <tr>
                                            <th class="bg-light">Annual Family Income</th>
                                            <td>{{ $benefit->eligibility->annual_family_income }}</td>
                                        </tr>
                                        @endif
                                        @if($benefit->eligibility->academic_stream)
                                        <tr>
                                            <th class="bg-light">Academic Stream</th>
                                            <td>{{ $benefit->eligibility->academic_stream }}</td>
                                        </tr>
                                        @endif
                                        @if($benefit->eligibility->entrance_exam)
                                        <tr>
                                            <th class="bg-light">Entrance Exam</th>
                                            <td>{{ $benefit->eligibility->entrance_exam }} @if($benefit->eligibility->minimum_exam_score) (Min score/rank: {{ $benefit->eligibility->minimum_exam_score }}) @endif</td>
                                        </tr>
                                        @endif
                                        @if($benefit->eligibility->state)
                                        <tr>
                                            <th class="bg-light">State Eligibility</th>
                                            <td>{{ $benefit->eligibility->state }} @if($benefit->eligibility->city) ({{ $benefit->eligibility->city }}) @endif</td>
                                        </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                            @endif

                            <!-- Benefits Table -->
                            @if($benefit->benefits && $benefit->benefits->count() > 0)
                            <h4 class="fw-bold text-dark mt-5 mb-3"><i class="fa-solid fa-gift text-primary me-2"></i> Scholarship Benefits</h4>
                            <div class="table-responsive mb-4">
                                <table class="table table-striped align-middle border">
                                    <thead>
                                        <tr class="bg-light">
                                            <th>Benefit Type</th>
                                            <th>Amount</th>
                                            <th>Description</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($benefit->benefits as $b)
                                        <tr>
                                            <td class="fw-bold text-dark">{{ $b->benefit_title }}</td>
                                            <td class="text-primary fw-bold">@if($b->benefit_amount) ₹{{ number_format($b->benefit_amount, 0) }} @else N/A @endif</td>
                                            <td>{{ $b->benefit_description }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            @endif

                            <!-- Required Documents -->
                            @if($benefit->documents && $benefit->documents->count() > 0)
                            <h4 class="fw-bold text-dark mt-5 mb-3"><i class="fa-solid fa-file-invoice text-primary me-2"></i> Documents Required</h4>
                            <ul class="list-group list-group-flush mb-4 rounded-3 border">
                                @foreach($benefit->documents as $doc)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <span><i class="fa-regular fa-file-lines text-muted me-2"></i> {{ $doc->document_name }}</span>
                                    @if($doc->is_mandatory)
                                        <span class="badge bg-danger rounded-pill">Mandatory</span>
                                    @else
                                        <span class="badge bg-secondary rounded-pill">Optional</span>
                                    @endif
                                </li>
                                @endforeach
                            </ul>
                            @endif

                            <!-- Key Dates Timeline -->
                            @if($benefit->dates)
                            @php $dates = $benefit->dates; @endphp
                            @if($dates->application_start_date || $dates->application_end_date || $dates->exam_date || $dates->result_date)
                            <h4 class="fw-bold text-dark mt-5 mb-3"><i class="fa-solid fa-calendar-days text-primary me-2"></i> Important Dates</h4>
                            <div class="row g-3 mb-4">
                                @if($dates->application_start_date)
                                <div class="col-6 col-md-3">
                                    <div class="border rounded p-3 text-center bg-light">
                                        <small class="text-uppercase text-muted fw-bold d-block mb-1">Start Date</small>
                                        <span class="fw-bold text-dark">{{ $dates->application_start_date->format('d M Y') }}</span>
                                    </div>
                                </div>
                                @endif
                                @if($dates->application_end_date)
                                <div class="col-6 col-md-3">
                                    <div class="border rounded p-3 text-center bg-light">
                                        <small class="text-uppercase text-muted fw-bold d-block mb-1">Deadline</small>
                                        <span class="fw-bold text-danger">{{ $dates->application_end_date->format('d M Y') }}</span>
                                    </div>
                                </div>
                                @endif
                                @if($dates->exam_date)
                                <div class="col-6 col-md-3">
                                    <div class="border rounded p-3 text-center bg-light">
                                        <small class="text-uppercase text-muted fw-bold d-block mb-1">Exam Date</small>
                                        <span class="fw-bold text-dark">{{ $dates->exam_date->format('d M Y') }}</span>
                                    </div>
                                </div>
                                @endif
                                @if($dates->result_date)
                                <div class="col-6 col-md-3">
                                    <div class="border rounded p-3 text-center bg-light">
                                        <small class="text-uppercase text-muted fw-bold d-block mb-1">Result Date</small>
                                        <span class="fw-bold text-dark">{{ $dates->result_date->format('d M Y') }}</span>
                                    </div>
                                </div>
                                @endif
                            </div>
                            @endif
                            @endif

                            <!-- FAQs Accordion -->
                            @if($benefit->faqs && $benefit->faqs->count() > 0)
                            <h4 class="fw-bold text-dark mt-5 mb-3"><i class="fa-solid fa-circle-question text-primary me-2"></i> Frequently Asked Questions</h4>
                            <div class="accordion accordion-flush mb-4 rounded-3 border overflow-hidden" id="faqAccordion">
                                @foreach($benefit->faqs as $i => $faq)
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="faq-heading-{{ $i }}">
                                        <button class="accordion-button collapsed fw-bold text-dark" type="button" data-bs-toggle="collapse" data-bs-target="#faq-collapse-{{ $i }}">
                                            {{ $faq->question }}
                                        </button>
                                    </h2>
                                    <div id="faq-collapse-{{ $i }}" class="accordion-collapse collapse" aria-labelledby="faq-heading-{{ $i }}" data-bs-parent="#faqAccordion">
                                        <div class="accordion-body text-secondary lh-lg">
                                            {{ $faq->answer }}
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            @endif

                            <h4 class="fw-bold text-dark mb-3"><i class="fa-solid fa-map-location-dot text-primary me-2"></i> Application Process</h4>
                            <ol class="ps-3 text-secondary lh-lg mb-0">
                                <li>Submit your application request form using the instant inquiry panel.</li>
                                <li>Our education advisor verifies your academic profile and eligibility.</li>
                                <li>Get step-by-step assistance in preparing documents and final submission.</li>
                            </ol>
                        </div>
                    </div>
                </div>

                <!-- Sidebar Inquiry Form -->
                <div class="col-lg-4" id="applySection">
                    <div class="card border-0 shadow-sm rounded-4 sticky-top" style="top: 90px;">
                        <div class="card-body p-4">
                            <h4 class="fw-bold text-dark mb-2">Apply for Assistance</h4>
                            <p class="text-muted small mb-4">Fill in your details to get instant assistance from an Enrollzy counselor.</p>

                            @if(session('success'))
                                <div class="alert alert-success border-0 small rounded-3 mb-3">
                                    <i class="fa-solid fa-circle-check me-1"></i> {{ session('success') }}
                                </div>
                            @endif

                            <form action="{{ route('contact.submit') }}" method="POST">
                                @csrf
                                <input type="hidden" name="subject" value="Scholarship Inquiry: {{ $benefit->title }}">
                                <div class="mb-3">
                                    <label class="form-label fw-semibold small text-muted">Full Name *</label>
                                    <input type="text" name="name" class="form-control" required placeholder="Enter your full name">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-semibold small text-muted">Mobile Number *</label>
                                    <input type="tel" name="phone" class="form-control" required placeholder="e.g. 9876543210">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-semibold small text-muted">Email Address *</label>
                                    <input type="email" name="email" class="form-control" required placeholder="name@example.com">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-semibold small text-muted">Message / Education Level</label>
                                    <textarea name="message" class="form-control" rows="3" placeholder="e.g. Currently in Class 12, seeking scholarship guidance..."></textarea>
                                </div>
                                <button type="submit" class="btn btn-enrollzy w-100 py-2">
                                    Submit Application Request <i class="fa-solid fa-paper-plane ms-2"></i>
                                </button>
                            </form>

                            <hr class="my-4">
                            <div class="d-flex align-items-center gap-3">
                                <div class="rounded-circle bg-light p-3 text-primary">
                                    <i class="fa-solid fa-headset fa-xl"></i>
                                </div>
                                <div>
                                    <div class="fw-bold small text-dark">Need Immediate Guidance?</div>
                                    <div class="text-muted small">Our counselors are online 9 AM - 7 PM</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Related Scholarships -->
            @if(isset($relatedBenefits) && count($relatedBenefits) > 0)
            <div class="mt-5 pt-4 border-top">
                <h3 class="fw-bold text-dark mb-4">Other Top Scholarships & Programs</h3>
                <div class="row row-cols-1 row-cols-md-3 g-4">
                    @foreach($relatedBenefits as $rel)
                    <div class="col">
                        <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden">
                            <div class="p-4 text-center bg-light border-bottom">
                                <img src="{{ $rel->icon ? (str_starts_with($rel->icon, 'http') ? $rel->icon : (file_exists(public_path($rel->icon)) ? asset($rel->icon) : rtrim(env('BACKEND_URL', 'http://127.0.0.1:8001'), '/') . '/' . ltrim($rel->icon, '/'))) : asset('assets/images/scholarship-card-img.png') }}" alt="{{ $rel->title }}" style="max-height: 80px; object-fit: contain;">
                            </div>
                            <div class="card-body p-4 d-flex flex-column">
                                <span class="badge bg-warning text-dark me-auto mb-2">{{ $rel->reward_amount ?: 'Up to INR 30,000' }}</span>
                                <h5 class="fw-bold text-dark mb-2">
                                    <a href="{{ route('scholarship.detail', $rel->id) }}" class="text-dark text-decoration-none">{{ Str::limit($rel->title, 45) }}</a>
                                </h5>
                                <p class="text-muted small flex-grow-1 mb-4">{{ Str::limit(strip_tags($rel->content), 90) }}</p>
                                <a href="{{ route('scholarship.detail', $rel->id) }}" class="btn btn-outline-primary btn-sm rounded-pill mt-auto">
                                    Learn More <i class="fa-solid fa-chevron-right ms-1" style="font-size: 10px;"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif
        </div>
    </section>
</main>
@endsection
