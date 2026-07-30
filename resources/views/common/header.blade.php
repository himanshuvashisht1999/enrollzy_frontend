<header class="w-100">
        <nav class="navbar navbar-expand-lg navbar-light ">
            <div class="container d-block">
                <!-- Logo -->
                <div class="d-flex header-d-fl">
                    <a class="logo navbar-brand d-flex align-items-center text-decoration-none" href="{{ url('/') }}">
                        <img src="{{ asset('assets/images/logo.svg') }}" alt="">
                    </a>
                    <!-- Navigation Pills (Stacked and Centered) -->
                    <div class="offcanvas-mobile offcanvas offcanvas-start order-lg-2" tabindex="-1" id="enrollzyNavbar"
                        aria-labelledby="enrollzyNavbarLabel">
                        <div class="offcanvas-header d-lg-none">
                            <a class="logo text-decoration-none" href="{{ url('/') }}">
                                <img src="{{ asset('assets/images/logo.svg') }}" alt="Enrollzy Logo" style="width: 140px;">
                            </a>
                            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                                aria-label="Close"></button>
                        </div>
                        <div class="offcanvas-body">
                            <div class="d-flex flex-column align-items-center gap-2 gap-lg-3 w-100">
                                <!-- Top Nav Card (Primary Links) - Desktop Only -->
                                <div class="nav-card-top w-100 d-none d-lg-block">
                                    <ul class="navbar-nav flex-row flex-wrap justify-content-center align-items-center"
                                        style="gap:16px">
                                        @php
                                            $linkUrlMap = [
                                                'BOARDING SCHOOLS' => route('all-schools'),
                                                'UNIVERSITIES' => route('university'),
                                                'INTEGRATED COACHING' => route('all.coaching'),
                                                'CAREER ROADMAP' => route('mentors'),
                                                'TOP EXAMS' => route('top-exams'),
                                                'SCHOLARSHIPS' => route('scholarships'),
                                            ];

                                            if (!function_exists('resolveHeaderTab')) {
                                                function resolveHeaderTab($title) {
                                                    $t = strtoupper(trim($title));
                                                    if (str_contains($t, 'BOARDING')) return 'tab-boarding';
                                                    if (str_contains($t, 'UNIV')) return 'tab-universities';
                                                    if (str_contains($t, 'COACHING')) return 'tab-coaching';
                                                    if (str_contains($t, 'ROADMAP') || str_contains($t, 'CAREER')) return 'tab-roadmap';
                                                    if (str_contains($t, 'EXAM')) return 'tab-exams';
                                                    if (str_contains($t, 'SCHOLAR')) return 'tab-scholarships';
                                                    return null;
                                                }
                                            }
                                        @endphp
                                        @foreach($headerLinks as $link)
                                            @php
                                                $upperTitle = strtoupper(trim($link->title));
                                                $linkHref = $linkUrlMap[$upperTitle] ?? url($link->url);
                                                $tabTrigger = resolveHeaderTab($upperTitle);
                                            @endphp
                                            <li class="nav-item" {!! $tabTrigger ? 'data-tab-trigger="'.$tabTrigger.'"' : '' !!}>
                                                <a class="nav-link" href="{{ $linkHref }}">{{ $upperTitle }}</a>
                                            </li>
                                        @endforeach
                                    </ul>

                                    <!-- Mega Menu Wrapper -->
                                    <div class="mega-menu-wrapper">
                                        <div class="mega-menu-container">
                                            <!-- Sidebar -->
                                            <div class="mega-menu-sidebar">
                                                <ul class="mega-sidebar-list">
                                                    <li class="mega-sidebar-item active" data-mega-tab="tab-boarding">
                                                        <span>Boarding Schools</span>
                                                        <i class="fa-solid fa-chevron-right mega-arrow-icon"></i>
                                                    </li>
                                                    <li class="mega-sidebar-item" data-mega-tab="tab-universities">
                                                        <span>Universities</span>
                                                        <i class="fa-solid fa-chevron-right mega-arrow-icon"></i>
                                                    </li>
                                                    <li class="mega-sidebar-item" data-mega-tab="tab-coaching">
                                                        <span>Integrated Coaching</span>
                                                        <i class="fa-solid fa-chevron-right mega-arrow-icon"></i>
                                                    </li>
                                                    <li class="mega-sidebar-item" data-mega-tab="tab-roadmap">
                                                        <span>Career Roadmap</span>
                                                        <i class="fa-solid fa-chevron-right mega-arrow-icon"></i>
                                                    </li>
                                                    <li class="mega-sidebar-item" data-mega-tab="tab-skills">
                                                        <span>Trending Skills</span>
                                                        <i class="fa-solid fa-chevron-right mega-arrow-icon"></i>
                                                    </li>
                                                    <li class="mega-sidebar-item" data-mega-tab="tab-courses">
                                                        <span>Free Courses</span>
                                                        <i class="fa-solid fa-chevron-right mega-arrow-icon"></i>
                                                    </li>
                                                    <li class="mega-sidebar-item" data-mega-tab="tab-programs">
                                                        <span>Trending Programs</span>
                                                        <i class="fa-solid fa-chevron-right mega-arrow-icon"></i>
                                                    </li>
                                                    <li class="mega-sidebar-item" data-mega-tab="tab-exams">
                                                        <span>Top Exams</span>
                                                        <i class="fa-solid fa-chevron-right mega-arrow-icon"></i>
                                                    </li>
                                                    <li class="mega-sidebar-item" data-mega-tab="tab-scholarships">
                                                        <span>Scholarships</span>
                                                        <i class="fa-solid fa-chevron-right mega-arrow-icon"></i>
                                                    </li>
                                                </ul>
                                            </div>

                                            <!-- Content Area -->
                                            <div class="mega-menu-content">
                                                <!-- Pane 1: Boarding Schools -->
                                                <div class="mega-tab-content active" id="tab-boarding">
                                                    <div class="mega-grid">
                                                        <div class="mega-col">
                                                            <h5>School Type</h5>
                                                            <ul>
                                                                <li><a href="{{ route('all-schools', ['school_type' => 'Boys Boarding']) }}" class="highlight-link">Boys Boarding Schools</a></li>
                                                                <li><a href="{{ route('all-schools', ['school_type' => 'Girls Boarding']) }}">Girls Boarding Schools</a></li>
                                                                <li><a href="{{ route('all-schools', ['school_type' => 'Co-Ed Boarding']) }}">Co-Ed Boarding Schools</a></li>
                                                                <li><a href="{{ route('all-schools', ['school_type' => 'Residential']) }}">Residential Schools</a></li>
                                                                <li><a href="{{ route('all-schools', ['school_type' => 'Day Boarding']) }}">Day Boarding</a></li>
                                                                <li><a href="{{ route('all-schools', ['school_type' => 'International Boarding']) }}">International Boarding</a></li>
                                                            </ul>
                                                        </div>
                                                        <div class="mega-col">
                                                            <h5>Curriculum</h5>
                                                            <ul>
                                                                <li><a href="{{ route('all-schools', ['board' => 'CBSE']) }}">CBSE</a></li>
                                                                <li><a href="{{ route('all-schools', ['board' => 'ICSE']) }}">ICSE</a></li>
                                                                <li><a href="{{ route('all-schools', ['board' => 'ISC']) }}">ISC</a></li>
                                                                <li><a href="{{ route('all-schools', ['board' => 'IB']) }}">IB</a></li>
                                                                <li><a href="{{ route('all-schools', ['board' => 'Cambridge']) }}">Cambridge</a></li>
                                                                <li><a href="{{ route('all-schools', ['board' => 'State Board']) }}">State Board</a></li>
                                                            </ul>
                                                        </div>
                                                        <div class="mega-col">
                                                            <h5>Browse by State</h5>
                                                            <ul>
                                                                <li><a href="{{ route('all-schools', ['state' => 'Uttarakhand']) }}">Uttarakhand</a></li>
                                                                <li><a href="{{ route('all-schools', ['state' => 'Himachal Pradesh']) }}">Himachal Pradesh</a></li>
                                                                <li><a href="{{ route('all-schools', ['state' => 'Karnataka']) }}">Karnataka</a></li>
                                                                <li><a href="{{ route('all-schools', ['state' => 'Tamil Nadu']) }}">Tamil Nadu</a></li>
                                                                <li><a href="{{ route('all-schools', ['state' => 'Rajasthan']) }}">Rajasthan</a></li>
                                                                <li><a href="{{ route('all-schools', ['state' => 'Maharashtra']) }}">Maharashtra</a></li>
                                                            </ul>
                                                        </div>
                                                        <div class="mega-col">
                                                            <h5>Popular Schools</h5>
                                                            <ul>
                                                                @if(isset($headerBoardingSchools) && $headerBoardingSchools->count() > 0)
                                                                    @foreach($headerBoardingSchools as $school)
                                                                        <li><a href="{{ route('school.detail', $school->slug) }}">{{ $school->name }}</a></li>
                                                                    @endforeach
                                                                @else
                                                                    <li><a href="{{ route('all-schools') }}">View All Boarding Schools</a></li>
                                                                @endif
                                                            </ul>
                                                        </div>
                                                        <div class="mega-col">
                                                            <h5>Resources</h5>
                                                            <ul>
                                                                <li><a href="{{ route('all-schools') }}">Compare Schools</a></li>
                                                                <li><a href="{{ route('ask.enrollzy') }}">Admission Process</a></li>
                                                                <li><a href="{{ route('all-schools') }}">Fee Structure</a></li>
                                                                <li><a href="{{ route('scholarships') }}">Scholarships</a></li>
                                                                <li><a href="{{ route('all-schools') }}">Reviews</a></li>
                                                                <li><a href="{{ route('all-schools') }}">Virtual Campus Tour</a></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Pane 2: Universities -->
                                                <div class="mega-tab-content" id="tab-universities">
                                                    <div class="mega-grid">
                                                        <div class="mega-col">
                                                            <h5>Browse by Stream</h5>
                                                            <ul>
                                                                <li><a href="{{ route('university', ['search' => 'Engineering']) }}" class="highlight-link">Engineering</a></li>
                                                                <li><a href="{{ route('university', ['search' => 'Medical']) }}">Medical</a></li>
                                                                <li><a href="{{ route('university', ['search' => 'Management']) }}">Management</a></li>
                                                                <li><a href="{{ route('university', ['search' => 'Law']) }}">Law</a></li>
                                                                <li><a href="{{ route('university', ['search' => 'Design']) }}">Design</a></li>
                                                                <li><a href="{{ route('university', ['search' => 'Commerce']) }}">Commerce</a></li>
                                                            </ul>
                                                        </div>
                                                        <div class="mega-col">
                                                            <h5>Browse by Degree</h5>
                                                            <ul>
                                                                <li><a href="{{ route('university', ['search' => 'Diploma']) }}">Diploma</a></li>
                                                                <li><a href="{{ route('university', ['search' => 'Undergraduate']) }}">Undergraduate</a></li>
                                                                <li><a href="{{ route('university', ['search' => 'Postgraduate']) }}">Postgraduate</a></li>
                                                                <li><a href="{{ route('university', ['search' => 'Doctorate']) }}">Doctorate</a></li>
                                                                <li><a href="{{ route('university', ['search' => 'Online']) }}">Online Degree</a></li>
                                                                <li><a href="{{ route('university') }}">State Board</a></li>
                                                            </ul>
                                                        </div>
                                                        <div class="mega-col">
                                                            <h5>Browse by Location</h5>
                                                            <ul>
                                                                <li><a href="{{ route('university', ['region' => 'North India']) }}">North India</a></li>
                                                                <li><a href="{{ route('university', ['region' => 'South India']) }}">South India</a></li>
                                                                <li><a href="{{ route('university', ['region' => 'East India']) }}">East India</a></li>
                                                                <li><a href="{{ route('university', ['region' => 'West India']) }}">West India</a></li>
                                                                <li><a href="{{ route('university', ['region' => 'Central India']) }}">Central India</a></li>
                                                                <li><a href="{{ route('university') }}">Top Universities</a></li>
                                                            </ul>
                                                        </div>
                                                        <div class="mega-col">
                                                            <h5>Popular Universities</h5>
                                                            <ul>
                                                                @if(isset($headerUniversities) && $headerUniversities->count() > 0)
                                                                    @foreach($headerUniversities as $uni)
                                                                        <li><a href="{{ route('university.detail', $uni->slug) }}">{{ $uni->name }}</a></li>
                                                                    @endforeach
                                                                @else
                                                                    <li><a href="{{ route('university') }}">View All Universities</a></li>
                                                                @endif
                                                            </ul>
                                                        </div>
                                                        <div class="mega-col">
                                                            <h5>Resources</h5>
                                                            <ul>
                                                                <li><a href="{{ route('university') }}">Compare Universities</a></li>
                                                                <li><a href="{{ route('university') }}">NIRF Rankings</a></li>
                                                                <li><a href="{{ route('scholarships') }}">Scholarships</a></li>
                                                                <li><a href="{{ route('ask.enrollzy') }}">Apply Now</a></li>
                                                                <li><a href="{{ route('university') }}">Reviews</a></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Pane 3: Integrated Coaching -->
                                                <div class="mega-tab-content" id="tab-coaching">
                                                    <div class="mega-grid">
                                                        <div class="mega-col">
                                                            <h5>Browse by Stream</h5>
                                                            <ul>
                                                                <li><a href="{{ route('all.coaching', ['search' => 'Engineering']) }}" class="highlight-link">Engineering</a></li>
                                                                <li><a href="{{ route('all.coaching', ['board' => 'JEE']) }}">IIT-JEE</a></li>
                                                                <li><a href="{{ route('all.coaching', ['board' => 'BITSAT']) }}">BITSAT</a></li>
                                                                <li><a href="{{ route('all.coaching', ['board' => 'VITEEE']) }}">VITEEE</a></li>
                                                                <li><a href="{{ route('all.coaching', ['board' => 'Olympiad']) }}">Olympiads</a></li>
                                                            </ul>
                                                            <h5 class="mt-4">Resources</h5>
                                                            <ul>
                                                                <li><a href="{{ route('all.coaching') }}">Top Coaching Institutes</a></li>
                                                                <li><a href="{{ route('mentors') }}">Faculty & Mentors</a></li>
                                                                <li><a href="{{ route('all.coaching') }}">Fees & Hostel</a></li>
                                                            </ul>
                                                        </div>
                                                        <div class="mega-col">
                                                            <h5>Medical</h5>
                                                            <ul>
                                                                <li><a href="{{ route('all.coaching', ['board' => 'NEET']) }}">NEET</a></li>
                                                                <li><a href="{{ route('all.coaching', ['board' => 'AIIMS']) }}">AIIMS</a></li>
                                                                <li><a href="{{ route('all.coaching', ['board' => 'JIPMER']) }}">JIPMER</a></li>
                                                            </ul>
                                                        </div>
                                                        <div class="mega-col">
                                                            <h5>Government Exams</h5>
                                                            <ul>
                                                                <li><a href="{{ route('all.coaching', ['search' => 'NDA']) }}">NDA</a></li>
                                                                <li><a href="{{ route('all.coaching', ['search' => 'UPSC']) }}">UPSC</a></li>
                                                                <li><a href="{{ route('all.coaching', ['search' => 'SSC']) }}">SSC</a></li>
                                                                <li><a href="{{ route('all.coaching', ['search' => 'Banking']) }}">Banking</a></li>
                                                            </ul>
                                                        </div>
                                                        <div class="mega-col">
                                                            <h5>Popular Coaching</h5>
                                                            <ul>
                                                                @if(isset($headerCoachingInstitutes) && $headerCoachingInstitutes->count() > 0)
                                                                    @foreach($headerCoachingInstitutes as $coaching)
                                                                        <li><a href="{{ route('coaching.detail', $coaching->slug) }}">{{ $coaching->name }}</a></li>
                                                                    @endforeach
                                                                @else
                                                                    <li><a href="{{ route('all.coaching') }}">View All Coaching</a></li>
                                                                @endif
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Pane: Career Roadmap -->
                                                <div class="mega-tab-content" id="tab-roadmap">
                                                    <div class="mega-grid">
                                                        <div class="mega-col">
                                                            <h5>Popular Roadmaps</h5>
                                                            <ul>
                                                                <li><a href="{{ route('mentors') }}" class="highlight-link">Engineering Pathway</a></li>
                                                                <li><a href="{{ route('mentors') }}">Medical Pathway</a></li>
                                                                <li><a href="{{ route('mentors') }}">Management Pathway</a></li>
                                                                <li><a href="{{ route('mentors') }}">Creative Arts Pathway</a></li>
                                                                <li><a href="{{ route('mentors') }}">Law Career Pathway</a></li>
                                                            </ul>
                                                        </div>
                                                        <div class="mega-col">
                                                            <h5>Expert Guidance</h5>
                                                            <ul>
                                                                <li><a href="{{ route('mentors') }}">1:1 Mentorship</a></li>
                                                                <li><a href="{{ route('mentors') }}">Profile Building</a></li>
                                                                <li><a href="{{ route('mentors') }}">Resume Review</a></li>
                                                                <li><a href="{{ route('mentors') }}">Interview Prep</a></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Pane 4: Trending Skills -->
                                                <div class="mega-tab-content" id="tab-skills">
                                                    <div class="mega-grid">
                                                        <div class="mega-col">
                                                            <h5>Technology</h5>
                                                            <ul>
                                                                <li><a href="{{ route('mentors') }}" class="highlight-link">Artificial Intelligence</a></li>
                                                                <li><a href="{{ route('mentors') }}">Machine Learning</a></li>
                                                                <li><a href="{{ route('mentors') }}">Data Science</a></li>
                                                                <li><a href="{{ route('mentors') }}">Cyber Security</a></li>
                                                            </ul>
                                                        </div>
                                                        <div class="mega-col">
                                                            <h5>Business & Career</h5>
                                                            <ul>
                                                                <li><a href="{{ route('mentors') }}">Digital Marketing</a></li>
                                                                <li><a href="{{ route('mentors') }}">Finance & Management</a></li>
                                                                <li><a href="{{ route('mentors') }}">Leadership Skills</a></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Pane 5: Free Courses -->
                                                <div class="mega-tab-content" id="tab-courses">
                                                    <div class="mega-grid">
                                                        <div class="mega-col">
                                                            <h5>Programming & Tech</h5>
                                                            <ul>
                                                                <li><a href="{{ route('mentors') }}" class="highlight-link">Python for Beginners</a></li>
                                                                <li><a href="{{ route('mentors') }}">Web Dev Essentials</a></li>
                                                                <li><a href="{{ route('mentors') }}">Java Programming</a></li>
                                                            </ul>
                                                        </div>
                                                        <div class="mega-col">
                                                            <h5>Self Growth</h5>
                                                            <ul>
                                                                <li><a href="{{ route('mentors') }}">Public Speaking</a></li>
                                                                <li><a href="{{ route('mentors') }}">Financial Literacy</a></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Pane 6: Trending Programs -->
                                                <div class="mega-tab-content" id="tab-programs">
                                                    <div class="mega-grid">
                                                        <div class="mega-col">
                                                            <h5>Undergraduate</h5>
                                                            <ul>
                                                                <li><a href="{{ route('university', ['search' => 'B.Tech']) }}" class="highlight-link">B.Tech CSE</a></li>
                                                                <li><a href="{{ route('university', ['search' => 'BBA']) }}">BBA / BCA</a></li>
                                                                <li><a href="{{ route('university', ['search' => 'B.Com']) }}">B.Com Honors</a></li>
                                                            </ul>
                                                        </div>
                                                        <div class="mega-col">
                                                            <h5>Postgraduate</h5>
                                                            <ul>
                                                                <li><a href="{{ route('university', ['search' => 'MBA']) }}">MBA Finance</a></li>
                                                                <li><a href="{{ route('university', ['search' => 'M.Tech']) }}">M.Tech AI</a></li>
                                                                <li><a href="{{ route('university', ['search' => 'MCA']) }}">MCA Cloud</a></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Pane 7: Top Exams -->
                                                <div class="mega-tab-content" id="tab-exams">
                                                    <div class="mega-grid">
                                                        <div class="mega-col">
                                                            <h5>Top Exams</h5>
                                                            <ul>
                                                                @if(isset($headerTopExams) && $headerTopExams->count() > 0)
                                                                    @foreach($headerTopExams as $exam)
                                                                        <li><a href="{{ route('exam.detail', $exam->slug) }}">{{ $exam->name ?? $exam->short_name }}</a></li>
                                                                    @endforeach
                                                                @else
                                                                    <li><a href="{{ route('top-exams') }}">JEE Main / Advanced</a></li>
                                                                    <li><a href="{{ route('top-exams') }}">NEET UG</a></li>
                                                                    <li><a href="{{ route('top-exams') }}">CAT Exam</a></li>
                                                                    <li><a href="{{ route('top-exams') }}">CLAT Law</a></li>
                                                                @endif
                                                            </ul>
                                                        </div>
                                                        <div class="mega-col">
                                                            <h5>All Exams</h5>
                                                            <ul>
                                                                <li><a href="{{ route('top-exams') }}">Explore All Exams</a></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Pane 8: Scholarships -->
                                                <div class="mega-tab-content" id="tab-scholarships">
                                                    <div class="mega-grid">
                                                        <div class="mega-col">
                                                            <h5>Scholarships & Benefits</h5>
                                                            <ul>
                                                                <li><a href="{{ route('scholarships') }}" class="highlight-link">NSP Scholarships</a></li>
                                                                <li><a href="{{ route('scholarships') }}">State Scholarships</a></li>
                                                                <li><a href="{{ route('scholarships') }}">Inspire Scheme</a></li>
                                                                <li><a href="{{ route('scholarships') }}">Corporate Scholarships</a></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Bottom Footer -->
                                                <div class="mega-menu-footer-main">
                                                    <div class="mega-menu-footer">
                                                        <div class="mega-footer-left">
                                                            <span>Not sure where to begin?</span>
                                                            <a href="{{ route('all-schools') }}">browse more schools</a>
                                                            <span>or</span>
                                                            <a href="{{ route('mentors') }}">Learn more about Mentors</a>
                                                        </div>
                                                        <div class="mega-footer-right">
                                                            <img src="{{ asset('assets/images/logo.svg') }}" alt="Enrollzy"
                                                                class="mega-footer-logo">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Mobile Menu Accordion (Mobile Only) -->
                                <div class="mobile-menu-accordion accordion d-lg-none w-100" id="mobileMenuAccordion">
                                    <!-- Item 1: Boarding Schools -->
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="heading-m-boarding">
                                            <button class="accordion-button collapsed" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#collapse-m-boarding"
                                                aria-expanded="false" aria-controls="collapse-m-boarding">
                                                BOARDING SCHOOLS
                                            </button>
                                        </h2>
                                        <div id="collapse-m-boarding" class="accordion-collapse collapse"
                                            aria-labelledby="heading-m-boarding" data-bs-parent="#mobileMenuAccordion">
                                            <div class="accordion-body">
                                                <div class="mobile-submenu-group">
                                                    <h6>School Type</h6>
                                                    <ul>
                                                        <li><a href="{{ route('all-schools', ['school_type' => 'Boys Boarding']) }}">Boys Boarding Schools</a></li>
                                                        <li><a href="{{ route('all-schools', ['school_type' => 'Girls Boarding']) }}">Girls Boarding Schools</a></li>
                                                        <li><a href="{{ route('all-schools', ['school_type' => 'Co-Ed Boarding']) }}">Co-Ed Boarding Schools</a></li>
                                                        <li><a href="{{ route('all-schools', ['school_type' => 'Residential']) }}">Residential Schools</a></li>
                                                        <li><a href="{{ route('all-schools', ['school_type' => 'Day Boarding']) }}">Day Boarding</a></li>
                                                    </ul>
                                                </div>
                                                <div class="mobile-submenu-group mt-3">
                                                    <h6>Curriculum</h6>
                                                    <ul>
                                                        <li><a href="{{ route('all-schools', ['board' => 'CBSE']) }}">CBSE</a></li>
                                                        <li><a href="{{ route('all-schools', ['board' => 'ICSE']) }}">ICSE</a></li>
                                                        <li><a href="{{ route('all-schools', ['board' => 'ISC']) }}">ISC</a></li>
                                                        <li><a href="{{ route('all-schools', ['board' => 'IB']) }}">IB</a></li>
                                                    </ul>
                                                </div>
                                                <div class="mobile-submenu-group mt-3">
                                                    <h6>Browse by State</h6>
                                                    <ul>
                                                        <li><a href="{{ route('all-schools', ['state' => 'Uttarakhand']) }}">Uttarakhand</a></li>
                                                        <li><a href="{{ route('all-schools', ['state' => 'Himachal Pradesh']) }}">Himachal Pradesh</a></li>
                                                        <li><a href="{{ route('all-schools', ['state' => 'Karnataka']) }}">Karnataka</a></li>
                                                    </ul>
                                                </div>
                                                <div class="mobile-submenu-group mt-3">
                                                    <h6>Popular Schools</h6>
                                                    <ul>
                                                        @if(isset($headerBoardingSchools) && $headerBoardingSchools->count() > 0)
                                                            @foreach($headerBoardingSchools as $school)
                                                                <li><a href="{{ route('school.detail', $school->slug) }}">{{ $school->name }}</a></li>
                                                            @endforeach
                                                        @else
                                                            <li><a href="{{ route('all-schools') }}">View All Schools</a></li>
                                                        @endif
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Item 2: Universities -->
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="heading-m-universities">
                                            <button class="accordion-button collapsed" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#collapse-m-universities"
                                                aria-expanded="false" aria-controls="collapse-m-universities">
                                                UNIVERSITIES
                                            </button>
                                        </h2>
                                        <div id="collapse-m-universities" class="accordion-collapse collapse"
                                            aria-labelledby="heading-m-universities"
                                            data-bs-parent="#mobileMenuAccordion">
                                            <div class="accordion-body">
                                                <div class="mobile-submenu-group">
                                                    <h6>Featured Streams</h6>
                                                    <ul>
                                                        <li><a href="{{ route('university', ['search' => 'Engineering']) }}">Engineering</a></li>
                                                        <li><a href="{{ route('university', ['search' => 'Medical']) }}">Medical</a></li>
                                                        <li><a href="{{ route('university', ['search' => 'Management']) }}">Management</a></li>
                                                        <li><a href="{{ route('university', ['search' => 'Law']) }}">Law</a></li>
                                                    </ul>
                                                </div>
                                                <div class="mobile-submenu-group mt-3">
                                                    <h6>Popular Universities</h6>
                                                    <ul>
                                                        @if(isset($headerUniversities) && $headerUniversities->count() > 0)
                                                            @foreach($headerUniversities as $uni)
                                                                <li><a href="{{ route('university.detail', $uni->slug) }}">{{ $uni->name }}</a></li>
                                                            @endforeach
                                                        @else
                                                            <li><a href="{{ route('university') }}">View All Universities</a></li>
                                                        @endif
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Item 3: Integrated Coaching -->
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="heading-m-coaching">
                                            <button class="accordion-button collapsed" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#collapse-m-coaching"
                                                aria-expanded="false" aria-controls="collapse-m-coaching">
                                                INTEGRATED COACHING
                                            </button>
                                        </h2>
                                        <div id="collapse-m-coaching" class="accordion-collapse collapse"
                                            aria-labelledby="heading-m-coaching" data-bs-parent="#mobileMenuAccordion">
                                            <div class="accordion-body">
                                                <div class="mobile-submenu-group">
                                                    <h6>Exam Prep</h6>
                                                    <ul>
                                                        <li><a href="{{ route('all.coaching', ['board' => 'JEE']) }}">IIT JEE Prep</a></li>
                                                        <li><a href="{{ route('all.coaching', ['board' => 'NEET']) }}">NEET Coaching</a></li>
                                                        <li><a href="{{ route('all.coaching', ['search' => 'NDA']) }}">NDA Prep</a></li>
                                                    </ul>
                                                </div>
                                                <div class="mobile-submenu-group mt-3">
                                                    <h6>Popular Coaching</h6>
                                                    <ul>
                                                        @if(isset($headerCoachingInstitutes) && $headerCoachingInstitutes->count() > 0)
                                                            @foreach($headerCoachingInstitutes as $coaching)
                                                                <li><a href="{{ route('coaching.detail', $coaching->slug) }}">{{ $coaching->name }}</a></li>
                                                            @endforeach
                                                        @else
                                                            <li><a href="{{ route('all.coaching') }}">View All Coaching</a></li>
                                                        @endif
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Item 4: Career Roadmap -->
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="heading-m-roadmap">
                                            <button class="accordion-button collapsed" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#collapse-m-roadmap"
                                                aria-expanded="false" aria-controls="collapse-m-roadmap">
                                                CAREER ROADMAP
                                            </button>
                                        </h2>
                                        <div id="collapse-m-roadmap" class="accordion-collapse collapse"
                                            aria-labelledby="heading-m-roadmap" data-bs-parent="#mobileMenuAccordion">
                                            <div class="accordion-body">
                                                <div class="mobile-submenu-group">
                                                    <h6>Mentorship & Guidance</h6>
                                                    <ul>
                                                        <li><a href="{{ route('mentors') }}">1:1 Mentorship</a></li>
                                                        <li><a href="{{ route('mentors') }}">Engineering Pathway</a></li>
                                                        <li><a href="{{ route('mentors') }}">Medical Pathway</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Item 5: Top Exams -->
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="heading-m-exams">
                                            <button class="accordion-button collapsed" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#collapse-m-exams"
                                                aria-expanded="false" aria-controls="collapse-m-exams">
                                                TOP EXAMS
                                            </button>
                                        </h2>
                                        <div id="collapse-m-exams" class="accordion-collapse collapse"
                                            aria-labelledby="heading-m-exams" data-bs-parent="#mobileMenuAccordion">
                                            <div class="accordion-body">
                                                <div class="mobile-submenu-group">
                                                    <h6>Top Exams</h6>
                                                    <ul>
                                                        @if(isset($headerTopExams) && $headerTopExams->count() > 0)
                                                            @foreach($headerTopExams as $exam)
                                                                <li><a href="{{ route('exam.detail', $exam->slug) }}">{{ $exam->name ?? $exam->short_name }}</a></li>
                                                            @endforeach
                                                        @else
                                                            <li><a href="{{ route('top-exams') }}">Explore All Exams</a></li>
                                                        @endif
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Item 6: Scholarships -->
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="heading-m-scholarships">
                                            <button class="accordion-button collapsed" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#collapse-m-scholarships"
                                                aria-expanded="false" aria-controls="collapse-m-scholarships">
                                                SCHOLARSHIPS
                                            </button>
                                        </h2>
                                        <div id="collapse-m-scholarships" class="accordion-collapse collapse"
                                            aria-labelledby="heading-m-scholarships"
                                            data-bs-parent="#mobileMenuAccordion">
                                            <div class="accordion-body">
                                                <div class="mobile-submenu-group">
                                                    <h6>Scholarships</h6>
                                                    <ul>
                                                        <li><a href="{{ route('scholarships') }}">All Scholarships & Benefits</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Mobile Secondary Links (Mobile Only) -->
                                <div class="mobile-secondary-links d-lg-none w-100 mt-4">
                                    <h5>Quick Links</h5>
                                    <ul>
                                        @foreach($headerMenus as $menu)
                                            @php
                                                $mTitleUpper = strtoupper($menu->title);
                                                $menuHref = $menuUrlMap[$mTitleUpper] ?? url($menu->url);
                                            @endphp
                                            <li><a href="{{ $menuHref }}">{{ $menu->title }}</a></li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Action Controls (Profile Button and Hamburger for Mobile) -->
                    <div class="d-flex align-items-center gap-3 order-lg-3">
                        <!-- Profile Button -->
                        <a href="#" class="profile-btn" id="profileBtn" aria-label="Profile">
                            <i class="fa-regular fa-user" style="color: #fff;"></i>
                        </a>
                        <!-- Mobile Hamburger -->
                        <button class="navbar-toggler border-0 p-0" type="button" data-bs-toggle="offcanvas"
                            data-bs-target="#enrollzyNavbar" aria-controls="enrollzyNavbar" aria-expanded="false"
                            aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                    </div>
                </div>
                <div class="text-center">
                    <!-- Bottom Nav Card (Secondary Links) -->
                    <div class="nav-card-bottom d-none d-lg-inline-block">
                        <ul class="navbar-nav flex-row flex-wrap justify-content-center align-items-center"
                            style="gap:45px">
                            @php
                                $menuUrlMap = [
                                    'ASK ENROLLZY' => route('ask.enrollzy'),
                                    'CONNECT WITH EXPERT' => route('mentors'),
                                    'ABOUT US' => route('about-us'),
                                    'BLOG' => route('blogs'),
                                    'BLOGS' => route('blogs'),
                                    "FAQ'S" => route('faq'),
                                    'FAQ' => route('faq'),
                                ];
                            @endphp
                            @foreach($headerMenus as $menu)
                                @php
                                    $mTitleUpper = strtoupper($menu->title);
                                    $menuHref = $menuUrlMap[$mTitleUpper] ?? url($menu->url);
                                @endphp
                                <li class="nav-item"><a class="nav-link" href="{{ $menuHref }}">{{ $menu->title }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>


            </div>
        </nav>
    </header>
