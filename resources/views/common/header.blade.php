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
                                            $titleToTab = [
                                                'BOARDING SCHOOLS' => 'tab-boarding',
                                                'UNIVERSITIES' => 'tab-universities',
                                                'INTEGRATED COACHING' => 'tab-coaching',
                                                'CAREER ROADMAP' => 'tab-roadmap',
                                                'TOP EXAMS' => 'tab-exams',
                                                'SCHOLARSHIPS' => 'tab-scholarships'
                                            ];
                                        @endphp
                                        @foreach($headerLinks as $link)
                                            <li class="nav-item" {!! isset($titleToTab[strtoupper($link->title)]) ? 'data-tab-trigger="'.$titleToTab[strtoupper($link->title)].'"' : '' !!}>
                                                <a class="nav-link" href="{{ $link->url }}">{{ strtoupper($link->title) }}</a>
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
                                                                <li><a href="#" class="highlight-link">Boys Boarding Schools</a></li>
                                                                <li><a href="#">Girls Boarding Schools</a></li>
                                                                <li><a href="#">Co-Ed Boarding Schools</a></li>
                                                                <li><a href="#">Residential Schools</a></li>
                                                                <li><a href="#">Day Boarding</a></li>
                                                                <li><a href="#">International Boarding</a></li>
                                                            </ul>
                                                        </div>
                                                        <div class="mega-col">
                                                            <h5>Curriculum</h5>
                                                            <ul>
                                                                <li><a href="#">CBSE</a></li>
                                                                <li><a href="#">ICSE</a></li>
                                                                <li><a href="#">ISC</a></li>
                                                                <li><a href="#">IB</a></li>
                                                                <li><a href="#">Cambridge</a></li>
                                                                <li><a href="#">State Board</a></li>
                                                            </ul>
                                                        </div>
                                                        <div class="mega-col">
                                                            <h5>Browse by State</h5>
                                                            <ul>
                                                                <li><a href="#">Uttarakhand</a></li>
                                                                <li><a href="#">Himachal Pradesh</a></li>
                                                                <li><a href="#">Karnataka</a></li>
                                                                <li><a href="#">Tamil Nadu</a></li>
                                                                <li><a href="#">Rajasthan</a></li>
                                                                <li><a href="#">Maharashtra</a></li>
                                                            </ul>
                                                        </div>
                                                        <div class="mega-col">
                                                            <h5>Popular Schools</h5>
                                                            <ul>
                                                                <li><a href="#">Doon School</a></li>
                                                                <li><a href="#">Mayo College</a></li>
                                                                <li><a href="#">Bishop Cotton School</a></li>
                                                                <li><a href="#">Residential Schools</a></li>
                                                                <li><a href="#">Welham Girl's</a></li>
                                                                <li><a href="#">Birla Vidya Mandir</a></li>
                                                                <li><a href="#">Scindia School</a></li>
                                                            </ul>
                                                        </div>
                                                        <div class="mega-col">
                                                            <h5>Resources</h5>
                                                            <ul>
                                                                <li><a href="#">Compare Schools</a></li>
                                                                <li><a href="#">Admission Process</a></li>
                                                                <li><a href="#">Fee Structure</a></li>
                                                                <li><a href="#">Scholarships</a></li>
                                                                <li><a href="#">Reviews</a></li>
                                                                <li><a href="#">Virtual Campus Tour</a></li>
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
                                                                <li><a href="#" class="highlight-link">Engineering</a></li>
                                                                <li><a href="#">Medical</a></li>
                                                                <li><a href="#">Management</a></li>
                                                                <li><a href="#">Law</a></li>
                                                                <li><a href="#">Design</a></li>
                                                                <li><a href="#">Commerce
</a></li>
                                                            </ul>
                                                        </div>
                                                        <div class="mega-col">
                                                            <h5>Browse by Degree
</h5>
                                                            <ul>
                                                                <li><a href="#">Diploma</a></li>
                                                                <li><a href="#">Undergraduate</a></li>
                                                                <li><a href="#">Postgraduate</a></li>
                                                                <li><a href="#">Doctorate</a></li>
                                                                <li><a href="#">Online Degree</a></li>
                                                                <li><a href="#">State Board</a></li>
                                                            </ul>
                                                        </div>
                                                        <div class="mega-col">
                                                            <h5>Browse by Location</h5>
                                                            <ul>
                                                                <li><a href="#">North India</a></li>
                                                                <li><a href="#">South India</a></li>
                                                                <li><a href="#">East India</a></li>
                                                                <li><a href="#">West India</a></li>
                                                                <li><a href="#">Central India</a></li>
                                                                <li><a href="#">Top Universities</a></li>
                                                                <li><a href="#">IITs</a></li>
                                                                <li><a href="#">NITs</a></li>
                                                                <li><a href="#">IIMs</a></li>
                                                                <li><a href="#">AIIMS</a></li>
                                                                <li><a href="#">Central Universities</a></li>
                                                                <li><a href="#">Private Universities</a></li>
                                                            </ul>
                                                        </div>
                                                        <div class="mega-col">
                                                            <h5>Resources</h5>
                                                            <ul>
                                                                <li><a href="#">Compare Universities</a></li>
                                                                <li><a href="#">NIRF Rankings</a></li>
                                                                <li><a href="#">Placements</a></li>
                                                                <li><a href="#">Scholarships</a></li>
                                                                <li><a href="#">Apply Now</a></li>
                                                                <li><a href="#">Reviews</a></li>
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
                                                                <li><a href="#" class="highlight-link">Engineering</a></li>
                                                                <li><a href="#">IIT-JEE</a></li>
                                                                <li><a href="#">BITSAT</a></li>
                                                                <li><a href="#">VITEEE</a></li>
                                                                <li><a href="#">Olympiads</a></li>
                                                            </ul>
                                                            <h5 class="mt-4">Resources</h5>
                                                            <ul>
                                                                <li><a href="#">Top Coaching Institutes</a></li>
                                                                <li><a href="#">Faculty</a></li>
                                                                <li><a href="#">Results</a></li>
                                                                <li><a href="#">Fees</a></li>
                                                                <li><a href="#">Hostel</a></li>
                                                                <li><a href="#">Demo Classes</a></li>
                                                            </ul>
                                                        </div>
                                                        <div class="mega-col">
                                                            <h5>Medical</h5>
                                                            <ul>
                                                                <li><a href="#">NEET</a></li>
                                                                <li><a href="#">AIIMS</a></li>
                                                                <li><a href="#">JIPMER</a></li>
                                                                <li><a href="#">Doctorate</a></li>
                                                                <li><a href="#">Online Degree</a></li>
                                                                <li><a href="#">State Board</a></li>
                                                            </ul>
                                                        </div>
                                                        <div class="mega-col">
                                                            <h5>Government Exams</h5>
                                                            <ul>
                                                                <li><a href="#">NDA</a></li>
                                                                <li><a href="#">UPSC</a></li>
                                                                <li><a href="#">SSC</a></li>
                                                                <li><a href="#">Banking</a></li>
                                                            </ul>
                                                        </div>
                                                        <div class="mega-col">
                                                            <h5>International Exams</h5>
                                                            <ul>
                                                                <li><a href="#">IELTS</a></li>
                                                                <li><a href="#">TOEFL</a></li>
                                                                <li><a href="#">GRE</a></li>
                                                                <li><a href="#">GMAT</a></li>
                                                                <li><a href="#">SAT</a></li>
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
                                                                <li><a href="#" class="highlight-link">Engineering
                                                                        Pathway</a></li>
                                                                <li><a href="#">Medical Pathway</a></li>
                                                                <li><a href="#">Management Pathway</a></li>
                                                                <li><a href="#">Creative Arts Pathway</a></li>
                                                                <li><a href="#">Law Career Pathway</a></li>
                                                            </ul>
                                                        </div>
                                                        <div class="mega-col">
                                                            <h5>Self Assessment</h5>
                                                            <ul>
                                                                <li><a href="#">Aptitude Test</a></li>
                                                                <li><a href="#">Personality Profiling</a></li>
                                                                <li><a href="#">Interest Mapping</a></li>
                                                                <li><a href="#">Skill Gap Analysis</a></li>
                                                            </ul>
                                                        </div>
                                                        <div class="mega-col">
                                                            <h5>Expert Guidance</h5>
                                                            <ul>
                                                                <li><a href="#">1:1 Mentorship</a></li>
                                                                <li><a href="#">Profile Building</a></li>
                                                                <li><a href="#">Resume Review</a></li>
                                                                <li><a href="#">Interview Prep</a></li>
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
                                                                <li><a href="#" class="highlight-link">Artificial Intelligence</a></li>
                                                                <li><a href="#">Machine Learning</a></li>
                                                                <li><a href="#">Data Science</a></li>
                                                                <li><a href="#">Cyber Security</a></li>
                                                                <li><a href="#">Cloud Computing</a></li>
                                                                <li><a href="#">DevOps</a></li>
                                                            </ul>
                                                            <h5 class="mt-4">Resources</h5>
                                                            <ul>
                                                                <li><a href="#">Certifications</a></li>
                                                                <li><a href="#">Learning Paths</a></li>
                                                                <li><a href="#">Beginner Friendly</a></li>
                                                                <li><a href="#">Industry Demand</a></li>
                                                                <li><a href="#">Top Providers</a></li>
                                                            </ul>
                                                        </div>
                                                        <div class="mega-col">
                                                            <h5>Business</h5>
                                                            <ul>
                                                                <li><a href="#">Digital Marketing</a></li>
                                                                <li><a href="#">Finance</a></li>
                                                                <li><a href="#">Stock Market</a></li>
                                                                <li><a href="#">Entrepreneurship</a></li>
                                                                <li><a href="#">Project Management</a></li>
                                                            </ul>
                                                        </div>
                                                        <div class="mega-col">
                                                            <h5>Design</h5>
                                                            <ul>
                                                                <li><a href="#">UI/UX</a></li>
                                                                <li><a href="#">Graphic Design</a></li>
                                                                <li><a href="#">Video Editing</a></li>
                                                                <li><a href="#">Animation</a></li>
                                                            </ul>
                                                        </div>
                                                        <div class="mega-col">
                                                            <h5>Career Skills</h5>
                                                            <ul>
                                                                <li><a href="#">Communication</a></li>
                                                                <li><a href="#">Public Speaking</a></li>
                                                                <li><a href="#">Leadership</a></li>
                                                                <li><a href="#">Interview Skills</a></li>
                                                                <li><a href="#">Resume Building</a></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>


                                                <!-- Pane 5: Free Courses -->
                                                <div class="mega-tab-content" id="tab-courses">
                                                    <div class="mega-grid">
                                                        <div class="mega-col">
                                                            <h5>Programming</h5>
                                                            <ul>
                                                                <li><a href="#" class="highlight-link">Python for
                                                                        Beginners</a></li>
                                                                <li><a href="#">Web Dev Essentials</a></li>
                                                                <li><a href="#">Java Programming</a></li>
                                                                <li><a href="#">SQL & Databases</a></li>
                                                            </ul>
                                                        </div>
                                                        <div class="mega-col">
                                                            <h5>Self Growth</h5>
                                                            <ul>
                                                                <li><a href="#">Public Speaking</a></li>
                                                                <li><a href="#">Graphic Design Basics</a></li>
                                                                <li><a href="#">Financial Literacy</a></li>
                                                                <li><a href="#">Content Writing</a></li>
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
                                                                <li><a href="#" class="highlight-link">B.Tech
                                                                        CSE</a></li>
                                                                <li><a href="#">BBA / BCA</a></li>
                                                                <li><a href="#">B.Com Honors</a></li>
                                                                <li><a href="#">B.Des Fashion</a></li>
                                                            </ul>
                                                        </div>
                                                        <div class="mega-col">
                                                            <h5>Postgraduate</h5>
                                                            <ul>
                                                                <li><a href="#">MBA Finance</a></li>
                                                                <li><a href="#">M.Tech AI</a></li>
                                                                <li><a href="#">MCA Cloud</a></li>
                                                                <li><a href="#">M.Des Product</a></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Pane 7: Top Exams -->
                                                <div class="mega-tab-content" id="tab-exams">
                                                    <div class="mega-grid">
                                                        <div class="mega-col">
                                                            <h5>National Level</h5>
                                                            <ul>
                                                                <li><a href="#" class="highlight-link">JEE Main /
                                                                        Advanced</a></li>
                                                                <li><a href="#">NEET UG</a></li>
                                                                <li><a href="#">CAT Exam</a></li>
                                                                <li><a href="#">CLAT Law</a></li>
                                                            </ul>
                                                        </div>
                                                        <div class="mega-col">
                                                            <h5>Study Abroad</h5>
                                                            <ul>
                                                                <li><a href="#">SAT / ACT</a></li>
                                                                <li><a href="#">GRE / GMAT</a></li>
                                                                <li><a href="#">IELTS / TOEFL</a></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Pane 8: Scholarships -->
                                                <div class="mega-tab-content" id="tab-scholarships">
                                                    <div class="mega-grid">
                                                        <div class="mega-col">
                                                            <h5>Government</h5>
                                                            <ul>
                                                                <li><a href="#" class="highlight-link">NSP
                                                                        Scholarships</a></li>
                                                                <li><a href="#">State Scholarships</a></li>
                                                                <li><a href="#">Inspire Scheme</a></li>
                                                            </ul>
                                                        </div>
                                                        <div class="mega-col">
                                                            <h5>Private & Corporate</h5>
                                                            <ul>
                                                                <li><a href="#">Tata Capital Pankh</a></li>
                                                                <li><a href="#">HDFC Badhte Kadam</a></li>
                                                                <li><a href="#">L'Oreal Girls Science</a></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Bottom Footer -->
                                                <div class="mega-menu-footer-main">
                                                    <div class="mega-menu-footer">
                                                        <div class="mega-footer-left">
                                                            <span>Not sure where to begin?</span>
                                                            <a href="#">browse more courses</a>
                                                            <span>or</span>
                                                            <a href="#">Learn more about</a>
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
                                                        <li><a href="#">Boys Boarding Schools</a></li>
                                                        <li><a href="#">Girls Boarding Schools</a></li>
                                                        <li><a href="#">Co-Ed Boarding Schools</a></li>
                                                        <li><a href="#">Residential Schools</a></li>
                                                        <li><a href="#">Day Boarding</a></li>
                                                        <li><a href="#">International Boarding</a></li>
                                                    </ul>
                                                </div>
                                                <div class="mobile-submenu-group mt-3">
                                                    <h6>Curriculum</h6>
                                                    <ul>
                                                        <li><a href="#">CBSE</a></li>
                                                        <li><a href="#">ICSE</a></li>
                                                        <li><a href="#">ISC</a></li>
                                                        <li><a href="#">IB</a></li>
                                                        <li><a href="#">Cambridge</a></li>
                                                        <li><a href="#">State Board</a></li>
                                                    </ul>
                                                </div>
                                                <div class="mobile-submenu-group mt-3">
                                                    <h6>Browse by State</h6>
                                                    <ul>
                                                        <li><a href="#">Uttarakhand</a></li>
                                                        <li><a href="#">Himachal Pradesh</a></li>
                                                        <li><a href="#">Karnataka</a></li>
                                                        <li><a href="#">Tamil Nadu</a></li>
                                                        <li><a href="#">Rajasthan</a></li>
                                                        <li><a href="#">Maharashtra</a></li>
                                                    </ul>
                                                </div>
                                                <div class="mobile-submenu-group mt-3">
                                                    <h6>Popular Schools</h6>
                                                    <ul>
                                                        <li><a href="#">Doon School</a></li>
                                                        <li><a href="#">Mayo College</a></li>
                                                        <li><a href="#">Bishop Cotton School</a></li>
                                                        <li><a href="#">Residential Schools</a></li>
                                                        <li><a href="#">Welham Girl's</a></li>
                                                        <li><a href="#">Birla Vidya Mandir</a></li>
                                                        <li><a href="#">Scindia School</a></li>
                                                    </ul>
                                                </div>
                                                <div class="mobile-submenu-group mt-3">
                                                    <h6>Resources</h6>
                                                    <ul>
                                                        <li><a href="#">Compare Schools</a></li>
                                                        <li><a href="#">Admission Process</a></li>
                                                        <li><a href="#">Fee Structure</a></li>
                                                        <li><a href="#">Scholarships</a></li>
                                                        <li><a href="#">Reviews</a></li>
                                                        <li><a href="#">Virtual Campus Tour</a></li>
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
                                                    <h6>Featured Programs</h6>
                                                    <ul>
                                                        <li><a href="#">MBA / PGDM</a></li>
                                                        <li><a href="#">B.Tech / B.E.</a></li>
                                                        <li><a href="#">MCA / BCA</a></li>
                                                        <li><a href="#">BBA / BBM</a></li>
                                                        <li><a href="#">MBBS / MD</a></li>
                                                    </ul>
                                                </div>
                                                <div class="mobile-submenu-group mt-3">
                                                    <h6>Study Mode</h6>
                                                    <ul>
                                                        <li><a href="#">Regular Universities</a></li>
                                                        <li><a href="#">Online Universities</a></li>
                                                        <li><a href="#">Distance Education</a></li>
                                                        <li><a href="#">Executive Programs</a></li>
                                                    </ul>
                                                </div>
                                                <div class="mobile-submenu-group mt-3">
                                                    <h6>Top Cities</h6>
                                                    <ul>
                                                        <li><a href="#">Delhi NCR</a></li>
                                                        <li><a href="#">Bangalore</a></li>
                                                        <li><a href="#">Mumbai</a></li>
                                                        <li><a href="#">Pune</a></li>
                                                        <li><a href="#">Chennai</a></li>
                                                    </ul>
                                                </div>
                                                <div class="mobile-submenu-group mt-3">
                                                    <h6>Resources</h6>
                                                    <ul>
                                                        <li><a href="#">Compare Universities</a></li>
                                                        <li><a href="#">Admission Guidelines</a></li>
                                                        <li><a href="#">Education Loans</a></li>
                                                        <li><a href="#">University Rankings</a></li>
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
                                                        <li><a href="#">IIT JEE Prep</a></li>
                                                        <li><a href="#">NEET Coaching</a></li>
                                                        <li><a href="#">NTSE / Olympiads</a></li>
                                                        <li><a href="#">CA / CS Coaching</a></li>
                                                    </ul>
                                                </div>
                                                <div class="mobile-submenu-group mt-3">
                                                    <h6>Study Modes</h6>
                                                    <ul>
                                                        <li><a href="#">Classroom Centers</a></li>
                                                        <li><a href="#">Live Online Classes</a></li>
                                                        <li><a href="#">Self-Paced Programs</a></li>
                                                        <li><a href="#">Test Series Packs</a></li>
                                                    </ul>
                                                </div>
                                                <div class="mobile-submenu-group mt-3">
                                                    <h6>Resources</h6>
                                                    <ul>
                                                        <li><a href="#">Compare Institutes</a></li>
                                                        <li><a href="#">Scholarship Tests</a></li>
                                                        <li><a href="#">Preparation Tips</a></li>
                                                        <li><a href="#">Mock Exams</a></li>
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
                                                    <h6>Popular Roadmaps</h6>
                                                    <ul>
                                                        <li><a href="#">Engineering Pathway</a></li>
                                                        <li><a href="#">Medical Pathway</a></li>
                                                        <li><a href="#">Management Pathway</a></li>
                                                        <li><a href="#">Creative Arts Pathway</a></li>
                                                        <li><a href="#">Law Career Pathway</a></li>
                                                    </ul>
                                                </div>
                                                <div class="mobile-submenu-group mt-3">
                                                    <h6>Self Assessment</h6>
                                                    <ul>
                                                        <li><a href="#">Aptitude Test</a></li>
                                                        <li><a href="#">Personality Profiling</a></li>
                                                        <li><a href="#">Interest Mapping</a></li>
                                                        <li><a href="#">Skill Gap Analysis</a></li>
                                                    </ul>
                                                </div>
                                                <div class="mobile-submenu-group mt-3">
                                                    <h6>Expert Guidance</h6>
                                                    <ul>
                                                        <li><a href="#">1:1 Mentorship</a></li>
                                                        <li><a href="#">Profile Building</a></li>
                                                        <li><a href="#">Resume Review</a></li>
                                                        <li><a href="#">Interview Prep</a></li>
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
                                                    <h6>National Level</h6>
                                                    <ul>
                                                        <li><a href="#">JEE Main / Advanced</a></li>
                                                        <li><a href="#">NEET UG</a></li>
                                                        <li><a href="#">CAT Exam</a></li>
                                                        <li><a href="#">CLAT Law</a></li>
                                                    </ul>
                                                </div>
                                                <div class="mobile-submenu-group mt-3">
                                                    <h6>Study Abroad</h6>
                                                    <ul>
                                                        <li><a href="#">SAT / ACT</a></li>
                                                        <li><a href="#">GRE / GMAT</a></li>
                                                        <li><a href="#">IELTS / TOEFL</a></li>
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
                                                    <h6>Government</h6>
                                                    <ul>
                                                        <li><a href="#">NSP Scholarships</a></li>
                                                        <li><a href="#">State Scholarships</a></li>
                                                        <li><a href="#">Inspire Scheme</a></li>
                                                    </ul>
                                                </div>
                                                <div class="mobile-submenu-group mt-3">
                                                    <h6>Private & Corporate</h6>
                                                    <ul>
                                                        <li><a href="#">Tata Capital Pankh</a></li>
                                                        <li><a href="#">HDFC Badhte Kadam</a></li>
                                                        <li><a href="#">L'Oreal Girls Science</a></li>
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
                                            <li><a href="{{ $menu->url }}">{{ $menu->title }}</a></li>
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
                            @foreach($headerMenus as $menu)
                                <li class="nav-item"><a class="nav-link" href="{{ $menu->url }}">{{ $menu->title }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>


            </div>
        </nav>
    </header>
