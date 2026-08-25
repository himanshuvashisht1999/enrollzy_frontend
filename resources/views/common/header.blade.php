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
                                            if (!function_exists('formatHeaderLinkUrl')) {
                                                function formatHeaderLinkUrl($rawUrl, $title) {
                                                    $u = trim($rawUrl ?? '');
                                                    $t = strtoupper(trim($title));

                                                    if (!empty($u)) {
                                                        if (str_contains($u, 'enrollzy.com')) {
                                                            $path = parse_url($u, PHP_URL_PATH);
                                                            if ($path === '/schools' || $path === '/all-schools') return route('all-schools');
                                                            if ($path === '/universities' || $path === '/university') return route('university');
                                                            if ($path === '/all-coaching' || $path === '/institutes' || $path === '/coaching') return route('all.coaching');
                                                            if ($path === '/top-exams' || $path === '/exams') return route('top-exams');
                                                            if ($path === '/scholarships' || $path === '/scholarships-and-benefits') return route('scholarships');
                                                            if ($path === '/mentors') return route('mentors');
                                                            // For /career-roadmap and any other paths, use the URL as-is from admin
                                                            return url($path ?? '/');
                                                        }
                                                        return str_starts_with($u, 'http') ? $u : url($u);
                                                    }

                                                    if (str_contains($t, 'SCHOOL')) return route('all-schools');
                                                    if (str_contains($t, 'UNIV')) return route('university');
                                                    if (str_contains($t, 'COACH')) return route('all.coaching');
                                                    if (str_contains($t, 'EXAM')) return route('top-exams');
                                                    if (str_contains($t, 'SCHOLAR')) return route('scholarships');
                                                    if (str_contains($t, 'ROADMAP') || str_contains($t, 'CAREER')) return route('career-roadmap.index');
                                                    return route('home');
                                                }
                                            }

                                            if (!function_exists('resolveHeaderTab')) {
                                                function resolveHeaderTab($linkId, $categories = null) {
                                                    // $linkId = HeaderLink->id, $categories = HeaderLink objects with sub-items
                                                    if ($categories && $categories->count() > 0) {
                                                        foreach ($categories as $cat) {
                                                            if ($cat->id == $linkId) {
                                                                return 'tab-mega-' . $cat->id;
                                                            }
                                                        }
                                                        return null; // no sub-items configured for this header_link
                                                    }
                                                    return null;
                                                }
                                            }
                                        @endphp
                                        @foreach($headerLinks as $link)
                                            @php
                                                $displayTitle = strtoupper(trim($link->title));
                                                $linkHref = formatHeaderLinkUrl($link->url, $link->title);
                                                $catData = isset($megaMenuCategories) ? $megaMenuCategories->where('id', $link->id)->first() : null;
                                                $hasMegaMenu = $catData && $catData->child_links && $catData->child_links->count() > 0;
                                            @endphp
                                            <li class="nav-item" {!! $hasMegaMenu ? 'data-tab-trigger="mega-nav-'.$link->id.'"' : '' !!}>
                                                <a class="nav-link" href="{{ $linkHref }}">{{ $displayTitle }}</a>
                                            </li>
                                        @endforeach
                                    </ul>

                                    <!-- Mega Menu Wrapper -->
                                    @if(isset($megaMenuCategories) && $megaMenuCategories->count() > 0)
                                        <div class="mega-menu-wrapper">
                                            @foreach($megaMenuCategories as $parentCat)
                                                @if($parentCat->child_links && $parentCat->child_links->count() > 0)
                                                    <div class="mega-menu-container" id="mega-nav-{{ $parentCat->id }}" style="display: none;">
                                                        <!-- Sidebar -->
                                                        <div class="mega-menu-sidebar">
                                                            <ul class="mega-sidebar-list">
                                                                @foreach($parentCat->child_links as $index => $cat)
                                                                    <li class="mega-sidebar-item {{ $index === 0 ? 'active' : '' }}" data-mega-tab="tab-mega-{{ $cat->id }}">
                                                                        <span>{{ $cat->title }}</span>
                                                                        <i class="fa-solid fa-chevron-right mega-arrow-icon"></i>
                                                                    </li>
                                                                @endforeach
                                                            </ul>
                                                        </div>

                                                        <!-- Content Area -->
                                                        <div class="mega-menu-content">
                                                            @foreach($parentCat->child_links as $index => $cat)
                                                                <div class="mega-tab-content {{ $index === 0 ? 'active' : '' }}" id="tab-mega-{{ $cat->id }}">
                                                                    <div class="mega-grid">
                                                                        @php
                                                                            $groupedCols = $cat->mega_menus->groupBy('column_title');
                                                                        @endphp
                                                                         @forelse($groupedCols as $colHeading => $children)
                                                                            <div class="mega-col">
                                                                                @if($colHeading)
                                                                                    <h5>{{ $colHeading }}</h5>
                                                                                @endif
                                                                                <ul>
                                                                                    @foreach($children as $child)
                                                                                        <li>
                                                                                            <a href="{{ $child->url ? (str_starts_with($child->url, 'http') ? $child->url : url($child->url)) : '#' }}" 
                                                                                               class="{{ $child->is_highlighted ? 'highlight-link' : '' }}">
                                                                                                {{ $child->title }}
                                                                                            </a>
                                                                                        </li>
                                                                                    @endforeach
                                                                                </ul>
                                                                            </div>
                                                                        @empty
                                                                            <div class="mega-col">
                                                                                <h5>{{ $cat->title }}</h5>
                                                                                <ul>
                                                                                    <li><a href="{{ formatHeaderLinkUrl($cat->url, $cat->title) }}">Explore {{ $cat->title }}</a></li>
                                                                                </ul>
                                                                            </div>
                                                                        @endforelse
                                                                    </div>
                                                                </div>
                                                            @endforeach

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
                                                                        <img src="{{ asset('assets/images/logo.svg') }}" alt="Enrollzy" class="mega-footer-logo">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                    @elseif(!isset($megaMenuCategories))
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
                                                                    <li><a href="{{ route('ask.enrollzy') }}">Admission Process</a></li>
                                                                    <li><a href="{{ route('university') }}">Fee Structure</a></li>
                                                                    <li><a href="{{ route('scholarships') }}">Scholarships</a></li>
                                                                    <li><a href="{{ route('university') }}">Reviews</a></li>
                                                                    <li><a href="{{ route('university') }}">Virtual Campus Tour</a></li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Pane 3: Integrated Coaching -->
                                                    <div class="mega-tab-content" id="tab-coaching">
                                                        <div class="mega-grid">
                                                            <div class="mega-col">
                                                                <h5>Top Coaching Programs</h5>
                                                                <ul>
                                                                    <li><a href="{{ route('all-coaching', ['search' => 'IIT JEE']) }}" class="highlight-link">IIT JEE Coaching</a></li>
                                                                    <li><a href="{{ route('all-coaching', ['search' => 'NEET Medical']) }}">NEET Medical Coaching</a></li>
                                                                    <li><a href="{{ route('all-coaching', ['search' => 'NDA Defence']) }}">NDA Defence Coaching</a></li>
                                                                    <li><a href="{{ route('all-coaching', ['search' => 'CUET']) }}">CUET Prep</a></li>
                                                                    <li><a href="{{ route('all-coaching', ['search' => 'Foundation']) }}">Foundation Courses (8th-10th)</a></li>
                                                                </ul>
                                                            </div>
                                                            <div class="mega-col">
                                                                <h5>Coaching Format</h5>
                                                                <ul>
                                                                    <li><a href="{{ route('all-coaching') }}">Classroom Coaching</a></li>
                                                                    <li><a href="{{ route('all-coaching') }}">Online Live Classes</a></li>
                                                                    <li><a href="{{ route('all-coaching') }}">Distance Learning (DLP)</a></li>
                                                                    <li><a href="{{ route('all-coaching') }}">Test Series</a></li>
                                                                </ul>
                                                            </div>
                                                            <div class="mega-col">
                                                                <h5>Popular Hubs</h5>
                                                                <ul>
                                                                    <li><a href="{{ route('all-coaching', ['state' => 'Rajasthan']) }}">Kota</a></li>
                                                                    <li><a href="{{ route('all-coaching', ['state' => 'Delhi']) }}">Delhi NCR</a></li>
                                                                    <li><a href="{{ route('all-coaching', ['state' => 'Telangana']) }}">Hyderabad</a></li>
                                                                    <li><a href="{{ route('all-coaching', ['state' => 'Karnataka']) }}">Bangalore</a></li>
                                                                    <li><a href="{{ route('all-coaching', ['state' => 'Bihar']) }}">Patna</a></li>
                                                                </ul>
                                                            </div>
                                                            <div class="mega-col">
                                                                <h5>Popular Coaching</h5>
                                                                <ul>
                                                                    @if(isset($headerCoachingInstitutes) && $headerCoachingInstitutes->count() > 0)
                                                                        @foreach($headerCoachingInstitutes as $coach)
                                                                            <li><a href="{{ route('coaching.detail', $coach->slug) }}">{{ $coach->name }}</a></li>
                                                                        @endforeach
                                                                    @else
                                                                        <li><a href="{{ route('all-coaching') }}">View All Coaching</a></li>
                                                                    @endif
                                                                </ul>
                                                            </div>
                                                            <div class="mega-col">
                                                                <h5>Resources</h5>
                                                                <ul>
                                                                    <li><a href="{{ route('all-coaching') }}">Compare Coaching</a></li>
                                                                    <li><a href="{{ route('all-coaching') }}">Free Mock Tests</a></li>
                                                                    <li><a href="{{ route('scholarships') }}">Scholarship Tests</a></li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Pane 4: Career Roadmap -->
                                                    <div class="mega-tab-content" id="tab-roadmap">
                                                        <div class="mega-grid">
                                                            <div class="mega-col">
                                                                <h5>After 10th Class</h5>
                                                                <ul>
                                                                    <li><a href="{{ route('career-roadmap.index') }}" class="highlight-link">Science Stream Guide</a></li>
                                                                    <li><a href="{{ route('career-roadmap.index') }}">Commerce Stream Guide</a></li>
                                                                    <li><a href="{{ route('career-roadmap.index') }}">Arts / Humanities Guide</a></li>
                                                                    <li><a href="{{ route('career-roadmap.index') }}">Diploma & Vocational</a></li>
                                                                </ul>
                                                            </div>
                                                            <div class="mega-col">
                                                                <h5>After 12th Class</h5>
                                                                <ul>
                                                                    <li><a href="{{ route('career-roadmap.index') }}">B.Tech / Engineering Roadmap</a></li>
                                                                    <li><a href="{{ route('career-roadmap.index') }}">MBBS / Medical Roadmap</a></li>
                                                                    <li><a href="{{ route('career-roadmap.index') }}">BBA / Management Roadmap</a></li>
                                                                    <li><a href="{{ route('career-roadmap.index') }}">Design & Architecture</a></li>
                                                                    <li><a href="{{ route('career-roadmap.index') }}">Law & Civil Services</a></li>
                                                                </ul>
                                                            </div>
                                                            <div class="mega-col">
                                                                <h5>Tools & Assessment</h5>
                                                                <ul>
                                                                    <li><a href="{{ route('mentors') }}">Talk to Career Mentors</a></li>
                                                                    <li><a href="{{ route('career-roadmap.index') }}">Aptitude Test</a></li>
                                                                    <li><a href="{{ route('career-roadmap.index') }}">Download Career E-books</a></li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Pane 5: Trending Skills -->
                                                    <div class="mega-tab-content" id="tab-skills">
                                                        <div class="mega-grid">
                                                            <div class="mega-col">
                                                                <h5>Technology & Coding</h5>
                                                                <ul>
                                                                    <li><a href="{{ route('trending-skills.index') }}" class="highlight-link">Full-Stack Development</a></li>
                                                                    <li><a href="{{ route('trending-skills.index') }}">AI & Machine Learning</a></li>
                                                                    <li><a href="{{ route('trending-skills.index') }}">Data Science & Analytics</a></li>
                                                                    <li><a href="{{ route('trending-skills.index') }}">Cyber Security</a></li>
                                                                    <li><a href="{{ route('trending-skills.index') }}">Cloud Computing (AWS/Azure)</a></li>
                                                                </ul>
                                                            </div>
                                                            <div class="mega-col">
                                                                <h5>Business & Creative</h5>
                                                                <ul>
                                                                    <li><a href="{{ route('trending-skills.index') }}">Digital Marketing & SEO</a></li>
                                                                    <li><a href="{{ route('trending-skills.index') }}">UI/UX Design</a></li>
                                                                    <li><a href="{{ route('trending-skills.index') }}">Financial Modeling</a></li>
                                                                    <li><a href="{{ route('trending-skills.index') }}">Product Management</a></li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Pane 6: Free Courses -->
                                                    <div class="mega-tab-content" id="tab-courses">
                                                        <div class="mega-grid">
                                                            <div class="mega-col">
                                                                <h5>Popular Free Courses</h5>
                                                                <ul>
                                                                    <li><a href="{{ route('free-courses.index') }}" class="highlight-link">Python for Beginners</a></li>
                                                                    <li><a href="{{ route('free-courses.index') }}">Excel & Data Analytics</a></li>
                                                                    <li><a href="{{ route('free-courses.index') }}">English Communication</a></li>
                                                                    <li><a href="{{ route('free-courses.index') }}">Digital Marketing 101</a></li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Pane 7: Top Exams -->
                                                    <div class="mega-tab-content" id="tab-exams">
                                                        <div class="mega-grid">
                                                            <div class="mega-col">
                                                                <h5>Popular Exams</h5>
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
                                    @endif
                                </div>

                                <!-- Mobile Menu Accordion (Mobile Only) -->
                                  @if(isset($megaMenuCategories) && $megaMenuCategories->count() > 0)
                                      <div class="mobile-menu-accordion accordion d-lg-none w-100" id="mobileMenuAccordion">
                                          @foreach($megaMenuCategories as $mIndex => $mCat)
                                            @if($mCat->child_links->count() > 0)
                                              <div class="accordion-item">
                                                  <h2 class="accordion-header" id="heading-m-dyn-{{ $mCat->id }}">
                                                      <button class="accordion-button {{ $mIndex === 0 ? '' : 'collapsed' }}" type="button"
                                                          data-bs-toggle="collapse" data-bs-target="#collapse-m-dyn-{{ $mCat->id }}"
                                                          aria-expanded="{{ $mIndex === 0 ? 'true' : 'false' }}" aria-controls="collapse-m-dyn-{{ $mCat->id }}">
                                                          {{ strtoupper($mCat->title) }}
                                                      </button>
                                                  </h2>
                                                  <div id="collapse-m-dyn-{{ $mCat->id }}" class="accordion-collapse collapse {{ $mIndex === 0 ? 'show' : '' }}"
                                                      aria-labelledby="heading-m-dyn-{{ $mCat->id }}" data-bs-parent="#mobileMenuAccordion">
                                                      <div class="accordion-body">
                                                        @foreach($mCat->child_links as $mChildCat)
                                                          <div class="mobile-submenu-group mb-3">
                                                            <h5 class="text-primary">{{ $mChildCat->title }}</h5>
                                                            @php
                                                                $mGrouped = $mChildCat->mega_menus->groupBy('column_title');
                                                            @endphp
                                                            @foreach($mGrouped as $mColHead => $mChildren)
                                                                <div class="mobile-submenu-group {{ !$loop->first ? 'mt-3' : '' }}">
                                                                    @if($mColHead)
                                                                        <h6>{{ $mColHead }}</h6>
                                                                    @endif
                                                                    <ul>
                                                                        @foreach($mChildren as $mChild)
                                                                            <li>
                                                                                <a href="{{ $mChild->url ? (str_starts_with($mChild->url, 'http') ? $mChild->url : url($mChild->url)) : '#' }}">
                                                                                    {{ $mChild->title }}
                                                                                </a>
                                                                            </li>
                                                                        @endforeach
                                                                    </ul>
                                                                </div>
                                                            @endforeach
                                                          </div>
                                                        @endforeach
                                                      </div>
                                                  </div>
                                              </div>
                                            @else
                                              <div class="accordion-item">
                                                  <h2 class="accordion-header">
                                                      <a href="{{ $mCat->url }}" class="accordion-button collapsed" style="text-decoration:none;">
                                                          {{ strtoupper($mCat->title) }}
                                                      </a>
                                                  </h2>
                                              </div>
                                            @endif
                                          @endforeach
                                      </div>
                                  @elseif(!isset($megaMenuCategories))
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
                                                        <h6>Popular Streams</h6>
                                                        <ul>
                                                            <li><a href="{{ route('all-coaching', ['search' => 'Engineering']) }}">Engineering Coaching</a></li>
                                                            <li><a href="{{ route('all-coaching', ['board' => 'JEE']) }}">IIT-JEE Prep</a></li>
                                                            <li><a href="{{ route('all-coaching', ['board' => 'NEET']) }}">NEET Prep</a></li>
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
                                                        <h6>Roadmap Guides</h6>
                                                        <ul>
                                                            <li><a href="{{ route('mentors') }}">Engineering Pathway</a></li>
                                                            <li><a href="{{ route('mentors') }}">Medical Pathway</a></li>
                                                            <li><a href="{{ route('mentors') }}">1:1 Mentorship</a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Item 5: Trending Skills -->
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="heading-m-skills">
                                                <button class="accordion-button collapsed" type="button"
                                                    data-bs-toggle="collapse" data-bs-target="#collapse-m-skills"
                                                    aria-expanded="false" aria-controls="collapse-m-skills">
                                                    TRENDING SKILLS
                                                </button>
                                            </h2>
                                            <div id="collapse-m-skills" class="accordion-collapse collapse"
                                                aria-labelledby="heading-m-skills" data-bs-parent="#mobileMenuAccordion">
                                                <div class="accordion-body">
                                                    <div class="mobile-submenu-group">
                                                        <h6>Top Skills</h6>
                                                        <ul>
                                                            <li><a href="{{ route('mentors') }}">Artificial Intelligence</a></li>
                                                            <li><a href="{{ route('mentors') }}">Data Science</a></li>
                                                            <li><a href="{{ route('mentors') }}">Digital Marketing</a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Item 6: Top Exams -->
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
                                                        <h6>Exams</h6>
                                                        <ul>
                                                            <li><a href="{{ route('top-exams') }}">JEE Main</a></li>
                                                            <li><a href="{{ route('top-exams') }}">NEET UG</a></li>
                                                            <li><a href="{{ route('top-exams') }}">Explore All Exams</a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Item 7: Scholarships -->
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="heading-m-scholarships">
                                                <button class="accordion-button collapsed" type="button"
                                                    data-bs-toggle="collapse" data-bs-target="#collapse-m-scholarships"
                                                    aria-expanded="false" aria-controls="collapse-m-scholarships">
                                                    SCHOLARSHIPS
                                                </button>
                                            </h2>
                                            <div id="collapse-m-scholarships" class="accordion-collapse collapse"
                                                aria-labelledby="heading-m-scholarships" data-bs-parent="#mobileMenuAccordion">
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
                                @endif

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
                        @auth
                            <div class="dropdown">
                                <a href="#" class="profile-btn dropdown-toggle" id="profileDropdown" data-bs-toggle="dropdown" aria-expanded="false" aria-label="Profile">
                                    <i class="fa-regular fa-user" style="color: #fff;"></i>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="profileDropdown">
                                    <li class="px-3 py-2 fw-bold text-dark border-bottom">
                                        <i class="fa-solid fa-user-circle me-1"></i> {{ auth()->user()->name ?? auth()->user()->mobile }}
                                    </li>
                                    <li>
                                        <a href="{{ route('user.dashboard') }}" class="dropdown-item py-2">
                                            <i class="fa-solid fa-gauge me-2"></i> Dashboard
                                        </a>
                                    </li>
                                    <li>
                                        <form action="{{ route('logout') }}" method="POST" class="m-0">
                                            @csrf
                                            <button type="submit" class="dropdown-item text-danger py-2">
                                                <i class="fa-solid fa-right-from-bracket me-2"></i> Logout
                                            </button>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        @else
                            <a href="{{ route('login') }}" class="profile-btn" id="profileBtn" aria-label="Login" title="Login / Register">
                                <i class="fa-regular fa-user" style="color: #fff;"></i>
                            </a>
                        @endauth
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
