<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index() {
        $boardingSchools = \App\Models\Organisation::where('organisation_type_id', 4)->where('status', 1)->take(6)->get();
        $noteworthy_categories = \App\Models\NoteworthyCategory::with(['mentions' => function ($q) {
            $q->where('status', 1)->orderBy('sort_order');
        }])->where('status', 1)->orderBy('sort_order')->get();

        $faqs = \App\Models\Faq::orderBy('sort_order')->take(5)->get();
        $home_services = \App\Models\HomeService::where('status', 1)->orderBy('sort_order')->get();
        $home_benefits = \App\Models\HomeBenefit::where('status', 1)->orderBy('sort_order')->get();
        $trending_skills = \App\Models\TrendingSkill::where('status', 1)->orderBy('sort_order')->get();
        $trendingCourses = \App\Models\TrendingCourse::where('status', 1)->orderBy('sort_order', 'asc')->get();
        $top_exams = \App\Models\DynamicExam::where('status', 'Active')->orderBy('id', 'desc')->take(6)->get();
        $video_testimonials = \App\Models\VideoTestimonial::where('is_active', 1)->orderBy('sort_order', 'asc')->get();
        $blogs = \App\Models\Blog::with('category')->orderBy('published_at', 'desc')->take(4)->get();
        $testimonials = \App\Models\Testimonial::orderBy('id', 'desc')->get();

        $schoolsCount = \App\Models\Organisation::where('organisation_type_id', 4)->count();
        $coachingCount = \App\Models\Organisation::where('organisation_type_id', 3)->count();
        $universitiesCount = \App\Models\Organisation::where('organisation_type_id', 1)->count();
        $collegesCount = \App\Models\Organisation::where('organisation_type_id', 2)->count();
        $examBodiesCount = \App\Models\Organisation::where('organisation_type_id', 5)->count();
        $counsellingBodiesCount = \App\Models\Organisation::where('organisation_type_id', 6)->count();
        $regulatoryBodiesCount = \App\Models\Organisation::where('organisation_type_id', 7)->count();
        $govAgenciesCount = \App\Models\Organisation::where('organisation_type_id', 8)->count();
        $totalInstitutionsCount = \App\Models\Organisation::count();
        
        $totalLeadsCount = 10000 + \Illuminate\Support\Facades\DB::table('leads')->count();
        $totalExamsCount = \App\Models\DynamicExam::where('status', 'Active')->count();

        // Since MentorProfile might be in backend, let's copy the model to frontend first if it's not there, or just use DB facade
        $mentorsCount = \Illuminate\Support\Facades\DB::table('mentor_profiles')->count();
        $mentors = \Illuminate\Support\Facades\DB::table('mentor_profiles')->orderBy('id', 'desc')->take(4)->get();
        $blogsCount = \App\Models\Blog::count();

        $scholarshipsCount = 850;
        $internshipsCount = 4500;
        
        $coachingInstitutes = \App\Models\Organisation::where('organisation_type_id', 3)->where('status', 1)->take(6)->get();
        $featuredUniversities = \App\Models\Organisation::where('organisation_type_id', 1)->where('status', 1)->orderBy('id', 'desc')->take(15)->get();

        $allActiveUnivs = \App\Models\Organisation::where('organisation_type_id', 1)->where('status', 1)->orderBy('id', 'desc')->get();

        $dbStreamTabs = \App\Models\HomepageStreamTab::where('status', 1)->orderBy('sort_order', 'asc')->get();

        $streamData = [];
        foreach ($dbStreamTabs as $tab) {
            $keywords = is_array($tab->keywords) ? $tab->keywords : json_decode($tab->keywords ?? '[]', true);
            $exams = is_array($tab->default_exams) ? $tab->default_exams : json_decode($tab->default_exams ?? '[]', true);
            $states = is_array($tab->default_states) ? $tab->default_states : json_decode($tab->default_states ?? '[]', true);
            $courses = is_array($tab->default_courses) ? $tab->default_courses : json_decode($tab->default_courses ?? '[]', true);

            $filteredUnivs = $allActiveUnivs->filter(function($u) use ($keywords) {
                if (empty($keywords)) return true;
                $text = strtolower($u->name . ' ' . ($u->about_organisation ?? '') . ' ' . ($u->meta_title ?? ''));
                foreach ($keywords as $kw) {
                    if (!empty($kw) && str_contains($text, strtolower($kw))) return true;
                }
                return false;
            })->take(12);

            if ($filteredUnivs->count() < 4) {
                $filteredUnivs = $allActiveUnivs->take(12);
            }

            $streamData[$tab->key] = [
                'name' => $tab->name,
                'colleges' => $filteredUnivs,
                'exams' => $exams ?? [],
                'states' => $states ?? [],
                'courses' => $courses ?? [],
            ];
        }

        $homepageSections = \Illuminate\Support\Facades\DB::table('homepage_sections')->get()->keyBy('section_key');
        $heroSliders = \Illuminate\Support\Facades\DB::table('hero_sliders')->where('is_active', 1)->orderBy('sort_order')->get();
        $firstHero = $heroSliders->first();

        return view('index', compact(
            'boardingSchools', 'noteworthy_categories', 'faqs', 'home_services', 'home_benefits', 'trending_skills',
            'top_exams', 'video_testimonials', 'blogs', 'testimonials', 
            'schoolsCount', 'coachingCount', 'universitiesCount', 'collegesCount', 'examBodiesCount',
            'counsellingBodiesCount', 'regulatoryBodiesCount', 'govAgenciesCount', 'totalInstitutionsCount',
            'totalLeadsCount', 'totalExamsCount', 'mentorsCount', 'scholarshipsCount', 'internshipsCount', 'blogsCount', 'coachingInstitutes', 'featuredUniversities', 'streamData', 'dbStreamTabs', 'trendingCourses',
            'mentors', 'heroSliders', 'firstHero', 'homepageSections'
        ));
    }
    public function about() { return view('about'); }
    
    public function blogs() {
        $blogs = \App\Models\Blog::with('category')->orderBy('published_at', 'desc')->paginate(9);
        return view('blogs', compact('blogs'));
    }

    public function blogDetail($slug) {
        $blog = \App\Models\Blog::with('category')->where('slug', $slug)->firstOrFail();
        // Also fetch related blogs or recent blogs
        $recent_blogs = \App\Models\Blog::where('id', '!=', $blog->id)->orderBy('published_at', 'desc')->take(4)->get();
        return view('blog-detail', compact('blog', 'recent_blogs'));
    }

    private function applyOrganisationFilters(\Illuminate\Database\Eloquent\Builder $query, \Illuminate\Http\Request $request) {
        // 1. Search Query Filter
        if ($request->filled('search')) {
            $search = trim($request->search);
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('about_organisation', 'like', "%{$search}%")
                  ->orWhere('meta_title', 'like', "%{$search}%")
                  ->orWhere('head_office_location', 'like', "%{$search}%")
                  ->orWhere('states_present_in', 'like', "%{$search}%")
                  ->orWhere('cities_present_in', 'like', "%{$search}%")
                  ->orWhere('education_boards_supported', 'like', "%{$search}%")
                  ->orWhere('education_levels_supported', 'like', "%{$search}%");
            });
        }

        // 2. Region Filter
        if ($request->filled('region')) {
            $regions = (array) $request->region;
            $regionMap = [
                'North India' => ['Uttarakhand', 'Rajasthan', 'Uttar Pradesh', 'Punjab', 'Haryana', 'Himachal Pradesh', 'Jammu', 'Kashmir', 'Delhi', 'Chandigarh', 'Noida', 'Dehradun', 'Jaipur', 'Ajmer', 'Mussoorie', 'Gurgaon', 'Gurugram', 'Lucknow', 'Nainital', 'Shimla', 'Solan', 'Selaqui'],
                'South India' => ['Tamil Nadu', 'Karnataka', 'Andhra Pradesh', 'Telangana', 'Kerala', 'Bengaluru', 'Bangalore', 'Hyderabad', 'Chennai', 'Ooty', 'Kodaikanal', 'Madanapalle', 'Lovedale'],
                'East India' => ['West Bengal', 'Bihar', 'Jharkhand', 'Odisha', 'Assam', 'Kolkata', 'Patna', 'Guwahati', 'Tezpur'],
                'West India' => ['Maharashtra', 'Gujarat', 'Goa', 'Mumbai', 'Pune', 'Panchgani', 'Ahmedabad'],
                'Central India' => ['Madhya Pradesh', 'Chhattisgarh', 'Bhopal', 'Indore', 'Gwalior'],
            ];

            $keywords = [];
            foreach ($regions as $reg) {
                if (isset($regionMap[$reg])) {
                    $keywords = array_merge($keywords, $regionMap[$reg]);
                } else {
                    $keywords[] = $reg;
                }
            }
            $keywords = array_unique($keywords);

            $query->where(function($q) use ($keywords) {
                foreach ($keywords as $kw) {
                    $q->orWhere('states_present_in', 'like', "%{$kw}%")
                      ->orWhere('cities_present_in', 'like', "%{$kw}%")
                      ->orWhere('head_office_location', 'like', "%{$kw}%");
                }
            });
        }

        // 3. State Filter
        if ($request->filled('state')) {
            $states = (array) $request->state;
            $query->where(function($q) use ($states) {
                foreach ($states as $st) {
                    $q->orWhere('states_present_in', 'like', "%{$st}%")
                      ->orWhere('head_office_location', 'like', "%{$st}%");
                }
            });
        }

        // 4. City Filter
        if ($request->filled('city')) {
            $cities = (array) $request->city;
            $query->where(function($q) use ($cities) {
                foreach ($cities as $ct) {
                    $q->orWhere('cities_present_in', 'like', "%{$ct}%")
                      ->orWhere('head_office_location', 'like', "%{$ct}%");
                }
            });
        }

        // 5. Area Filter
        if ($request->filled('area')) {
            $areas = (array) $request->area;
            $query->where(function($q) use ($areas) {
                foreach ($areas as $ar) {
                    $q->orWhere('head_office_location', 'like', "%{$ar}%")
                      ->orWhere('about_organisation', 'like', "%{$ar}%");
                }
            });
        }

        // 6. Board Filter
        if ($request->filled('board')) {
            $boards = (array) $request->board;
            $keywords = [];
            foreach ($boards as $bd) {
                if ($bd === 'ICSE/CISE') {
                    $keywords[] = 'ICSE';
                    $keywords[] = 'CISE';
                    $keywords[] = 'CISCE';
                } elseif (str_contains($bd, 'JEE')) {
                    $keywords[] = 'JEE';
                    $keywords[] = 'Engineering';
                    $keywords[] = 'IIT';
                } elseif (str_contains($bd, 'NEET')) {
                    $keywords[] = 'NEET';
                    $keywords[] = 'Medical';
                } else {
                    $keywords[] = $bd;
                }
            }
            $keywords = array_unique($keywords);

            $query->where(function($q) use ($keywords) {
                foreach ($keywords as $kw) {
                    $q->orWhere('education_boards_supported', 'like', "%{$kw}%")
                      ->orWhere('streams_supported', 'like', "%{$kw}%")
                      ->orWhere('about_organisation', 'like', "%{$kw}%");
                }
            });
        }

        // 7. Class / Level Filter
        if ($request->filled('class')) {
            $classes = (array) $request->class;
            $keywords = [];
            foreach ($classes as $cl) {
                $clLower = strtolower($cl);
                if (in_array($clLower, ['toddlers', 'pre nursery', 'nursery', 'lkg', 'ukg', 'class 1', 'class 2', 'class 3', 'class 4', 'class 5'])) {
                    $keywords[] = 'Primary';
                    $keywords[] = $cl;
                } elseif (in_array($clLower, ['class 6', 'class 7', 'class 8'])) {
                    $keywords[] = 'Middle';
                    $keywords[] = 'Primary';
                    $keywords[] = $cl;
                } elseif (in_array($clLower, ['class 9', 'class 10'])) {
                    $keywords[] = 'Secondary';
                    $keywords[] = $cl;
                } elseif (in_array($clLower, ['class 11', 'class 12', 'target / dropper', 'target', 'dropper'])) {
                    $keywords[] = 'Senior Secondary';
                    $keywords[] = 'Target';
                    $keywords[] = 'Dropper';
                    $keywords[] = $cl;
                } else {
                    $keywords[] = $cl;
                }
            }
            $keywords = array_unique($keywords);

            $query->where(function($q) use ($keywords) {
                foreach ($keywords as $kw) {
                    $q->orWhere('education_levels_supported', 'like', "%{$kw}%")
                      ->orWhere('about_organisation', 'like', "%{$kw}%");
                }
            });
        }

        // 8. Ownership Filter
        if ($request->filled('ownership')) {
            $ownerships = (array) $request->ownership;
            $query->where(function($q) use ($ownerships) {
                foreach ($ownerships as $own) {
                    $q->orWhere('ownership_type', 'like', "%{$own}%");
                }
            });
        }

        // 9. School / Coaching Type Filter
        if ($request->filled('school_type')) {
            $types = (array) $request->school_type;
            $query->where(function($q) use ($types) {
                foreach ($types as $tp) {
                    $tpLower = strtolower($tp);
                    if (str_contains($tpLower, 'girl')) {
                        $q->orWhere('minority_type', 'like', '%Girl%')
                          ->orWhere('brand_type', 'like', '%Girl%')
                          ->orWhere('about_organisation', 'like', '%girl%')
                          ->orWhere('name', 'like', '%Girl%');
                    } elseif (str_contains($tpLower, 'boy')) {
                        $q->orWhere('minority_type', 'like', '%Boy%')
                          ->orWhere('brand_type', 'like', '%Boy%')
                          ->orWhere('about_organisation', 'like', '%boy%')
                          ->orWhere('name', 'like', '%Boy%');
                    } elseif (str_contains($tpLower, 'co-ed') || str_contains($tpLower, 'coed') || str_contains($tpLower, 'coed')) {
                        $q->orWhere('minority_type', 'like', '%Coed%')
                          ->orWhere('brand_type', 'like', '%Coed%')
                          ->orWhere('about_organisation', 'like', '%co-ed%')
                          ->orWhere('about_organisation', 'like', "%co-educational%")
                          ->orWhere('about_organisation', 'like', "%coeducational%");
                    } elseif (str_contains($tpLower, 'residential')) {
                        $q->orWhere('about_organisation', 'like', '%residential%')
                          ->orWhere('about_organisation', 'like', '%boarding%');
                    } else {
                        $q->orWhere('minority_type', 'like', "%{$tp}%")
                          ->orWhere('brand_type', 'like', "%{$tp}%")
                          ->orWhere('about_organisation', 'like', "%{$tp}%")
                          ->orWhere('name', 'like', "%{$tp}%");
                    }
                }
            });
        }

        // 10. Gender Filter
        if ($request->filled('gender')) {
            $genders = (array) $request->gender;
            $query->where(function($q) use ($genders) {
                foreach ($genders as $gen) {
                    $genLower = strtolower($gen);
                    if (str_contains($genLower, 'girl')) {
                        $q->orWhere('minority_type', 'like', '%Girl%')
                          ->orWhere('about_organisation', 'like', '%girl%')
                          ->orWhere('name', 'like', '%Girl%');
                    } elseif (str_contains($genLower, 'boy')) {
                        $q->orWhere('minority_type', 'like', '%Boy%')
                          ->orWhere('about_organisation', 'like', '%boy%')
                          ->orWhere('name', 'like', '%Boy%');
                    } elseif (str_contains($genLower, 'coed') || str_contains($genLower, 'co-ed')) {
                        $q->orWhere('minority_type', 'like', '%Coed%')
                          ->orWhere('about_organisation', 'like', '%co-ed%')
                          ->orWhere('about_organisation', 'like', '%co-educational%')
                          ->orWhere('about_organisation', 'like', '%coeducational%');
                    } else {
                        $q->orWhere('minority_type', 'like', "%{$gen}%")
                          ->orWhere('about_organisation', 'like', "%{$gen}%")
                          ->orWhere('name', 'like', "%{$gen}%");
                    }
                }
            });
        }

        // 11. Top / Featured Filter
        if ($request->has('is_top') && ($request->is_top == '1' || $request->is_top == 'true')) {
            $query->where('is_top', 1);
        }
    }

    public function allSchools(\Illuminate\Http\Request $request) {
        $query = \App\Models\Organisation::where('organisation_type_id', 4)
            ->where('status', 1);

        $this->applyOrganisationFilters($query, $request);

        $heroPillLabel = null;
        if ($request->has('is_top') && ($request->is_top == '1' || $request->is_top == 'true')) {
            $heroPillLabel = \Illuminate\Support\Facades\DB::table('hero_sliders')
                ->where('is_active', 1)
                ->whereNotNull('pill_2_label')
                ->where('pill_2_label', '!=', '')
                ->orderBy('sort_order')
                ->value('pill_2_label');
        }

        $schools = $query->orderBy('id', 'desc')->paginate(10)->withQueryString();
            
        return view('all-schools', compact('schools', 'heroPillLabel'));
    }
    public function topExams(\Illuminate\Http\Request $request) {
        $query = \App\Models\DynamicExam::where('status', 'Active');

        // Search filter
        if ($request->filled('search')) {
            $search = trim($request->search);
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('short_name', 'like', "%{$search}%")
                  ->orWhere('conducting_authority_name', 'like', "%{$search}%");
            });
        }

        // Category filter (exam_category is a JSON array)
        if ($request->filled('category')) {
            $categories = array_filter((array) $request->category);
            if (!empty($categories)) {
                $query->where(function($q) use ($categories) {
                    foreach ($categories as $cat) {
                        $q->orWhereJsonContains('exam_category', $cat)
                          ->orWhere('exam_category', 'like', '%"' . $cat . '"%');
                    }
                });
            }
        }

        // Exam Type filter
        if ($request->filled('exam_type')) {
            $query->where('exam_type', $request->exam_type);
        }

        // Conducting body type filter
        if ($request->filled('conducting_body_type')) {
            $query->where('conducting_body_type', $request->conducting_body_type);
        }

        // Featured filter
        if ($request->boolean('featured')) {
            $query->where('featured_exam', true);
        }

        // Sort
        $sort = $request->get('sort', 'latest');
        if ($sort === 'name') {
            $query->orderBy('name', 'asc');
        } elseif ($sort === 'featured') {
            $query->orderByDesc('featured_exam')->orderBy('name');
        } else {
            $query->orderBy('id', 'desc');
        }

        $exams = $query->paginate(12)->withQueryString();

        // Pass distinct values for dynamic filter options
        $allCategories = \App\Models\DynamicExam::where('status', 'Active')
            ->whereNotNull('exam_category')
            ->pluck('exam_category')
            ->flatten()
            ->unique()
            ->filter()
            ->sort()
            ->values();

        $allExamTypes = \App\Models\DynamicExam::where('status', 'Active')
            ->whereNotNull('exam_type')
            ->distinct()
            ->pluck('exam_type')
            ->sort()
            ->values();

        $allConductingBodyTypes = \App\Models\DynamicExam::where('status', 'Active')
            ->whereNotNull('conducting_body_type')
            ->distinct()
            ->pluck('conducting_body_type')
            ->sort()
            ->values();

        return view('top-exams', compact('exams', 'allCategories', 'allExamTypes', 'allConductingBodyTypes'));
    }
    public function examDetail($slug)
    {
        $exam = \App\Models\DynamicExam::with('sections')->where('slug', $slug)->firstOrFail();
        return view('top-exam-detail', compact('exam'));
    }
    
    public function contactUs() {
        $contactDetails = \App\Models\ContactUsDetail::firstOrCreate(['id' => 1]);
        return view('contact-us', compact('contactDetails'));
    }

    public function submitContactUs(\Illuminate\Http\Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'programme' => 'nullable|string|max:100',
            'email' => 'nullable|email|max:255',
            'company' => 'nullable|string|max:255',
            'organisation_name' => 'nullable|string|max:255',
            'type' => 'nullable|string|max:100',
            'business_type' => 'nullable|string|max:100',
            'looking_for' => 'nullable|string|max:255',
            'session_time' => 'nullable|string|max:255',
            'message' => 'nullable|string',
        ]);

        $prog = $request->programme ?? $request->type ?? $request->business_type ?? $request->looking_for;
        $orgName = $request->organisation_name ?? $request->company;

        $subjectParts = ['Student Lead Inquiry'];
        if ($prog) $subjectParts[] = 'Programme: ' . $prog;
        if ($orgName) $subjectParts[] = 'Institute/School: ' . $orgName;
        
        $subject = implode(' | ', $subjectParts);

        $messageContent = $request->message;
        if (empty($messageContent)) {
            $details = [];
            if ($prog) $details[] = 'Programme Interested In: ' . $prog;
            if ($orgName) $details[] = 'Institute/School Name: ' . $orgName;
            if ($request->session_time) $details[] = 'Preferred Session Time: ' . $request->session_time;
            $messageContent = !empty($details) ? implode("\n", $details) : 'Student Lead Inquiry from website.';
        }

        \Illuminate\Support\Facades\DB::table('leads')->insert([
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email ?? '',
            'subject' => $subject,
            'type' => 'Student', // ENUM only accepts 'Student','Expert','Alumni'
            'message' => $messageContent,
            'status' => 'New',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Your callback request has been submitted successfully! Our team will get back to you shortly.'
            ]);
        }

        return redirect()->to(url()->previous() . '#contact-section')->with('success', 'Your request has been submitted successfully! Our team will get back to you shortly.');
    }

    public function faq() {
        $categories = \App\Models\FaqCategory::whereNull('parent_id')
            ->with(['faqs' => function($q) {
                $q->where('status', 1)->orderBy('sort_order');
            }, 'children'])
            ->where('status', 1)
            ->get();
        return view('faq', compact('categories'));
    }
    public function aboutUs() {
        $about_page = \App\Models\AboutUsPage::first();
        $offers = \App\Models\AboutUsOffer::orderBy('sort_order')->get();
        $features = \App\Models\AboutUsFeature::orderBy('sort_order')->get();
        $impacts = \App\Models\AboutUsImpact::orderBy('sort_order')->get();
        $teams = \App\Models\AboutUsTeam::orderBy('sort_order')->get();
        $advisory_boards = \App\Models\AboutUsAdvisoryBoard::orderBy('sort_order')->get();
        
        return view('about-us', compact('about_page', 'offers', 'features', 'impacts', 'teams', 'advisory_boards'));
    }
    
    public function scholarships() {
        $benefits = \App\Models\HomeBenefit::where('status', 1)->orderBy('sort_order')->get();
        return view('scholarships-and-benefits', compact('benefits'));
    }

    public function scholarshipDetail($id) {
        $benefit = \App\Models\HomeBenefit::where('id', $id)->where('status', 1)->firstOrFail();
        $relatedBenefits = \App\Models\HomeBenefit::where('id', '!=', $id)->where('status', 1)->take(3)->get();
        return view('scholarship-detail', compact('benefit', 'relatedBenefits'));
    }
    public function schoolDetail($slug) {
        $school = \App\Models\Organisation::with(['feeStructures', 'admissionRoutes'])
            ->where('slug', $slug)
            ->where('organisation_type_id', 4)
            ->where('status', 1)
            ->firstOrFail();
            
        $locationParts = [];
        $cities = is_string($school->cities_present_in) ? json_decode($school->cities_present_in, true) : ($school->cities_present_in ?? []);
        $states = is_string($school->states_present_in) ? json_decode($school->states_present_in, true) : ($school->states_present_in ?? []);
        if (!empty($cities)) {
            $locationParts[] = $cities[0];
        }
        if (!empty($states)) {
            $locationParts[] = $states[0];
        }
        $location = implode(', ', $locationParts);
        
        $boards = is_string($school->education_boards_supported) ? json_decode($school->education_boards_supported, true) : ($school->education_boards_supported ?? []);
        $grades = is_string($school->education_levels_supported) ? json_decode($school->education_levels_supported, true) : ($school->education_levels_supported ?? []);
            
        return view('school-detail', compact('school', 'location', 'boards', 'grades'));
    }
    
    public function allCoaching(\Illuminate\Http\Request $request) {
        $query = \App\Models\Organisation::where('organisation_type_id', 3)
            ->where('status', 1);

        $this->applyOrganisationFilters($query, $request);

        $heroPillLabel = null;
        if ($request->has('is_top') && ($request->is_top == '1' || $request->is_top == 'true')) {
            $heroPillLabel = \Illuminate\Support\Facades\DB::table('hero_sliders')
                ->where('is_active', 1)
                ->whereNotNull('pill_4_label')
                ->where('pill_4_label', '!=', '')
                ->orderBy('sort_order')
                ->value('pill_4_label');
        }

        $coachings = $query->orderBy('id', 'desc')->paginate(10)->withQueryString();
            
        return view('all-coaching', compact('coachings', 'heroPillLabel'));
    }
    
    public function coachingDetail($slug) {
        $coaching = \App\Models\Organisation::with(['feeStructures', 'admissionRoutes'])
            ->where('slug', $slug)
            ->where('organisation_type_id', 3)
            ->where('status', 1)
            ->firstOrFail();
            
        $locationParts = [];
        $cities = is_string($coaching->cities_present_in) ? json_decode($coaching->cities_present_in, true) : ($coaching->cities_present_in ?? []);
        $states = is_string($coaching->states_present_in) ? json_decode($coaching->states_present_in, true) : ($coaching->states_present_in ?? []);
        if (!empty($cities)) {
            $locationParts[] = $cities[0];
        }
        if (!empty($states)) {
            $locationParts[] = $states[0];
        }
        if (empty($locationParts) && !empty($coaching->head_office_location)) {
            $location = $coaching->head_office_location;
        } else {
            $location = implode(', ', $locationParts);
        }
        
        $boards = is_string($coaching->education_boards_supported) ? json_decode($coaching->education_boards_supported, true) : ($coaching->education_boards_supported ?? []);
        $grades = is_string($coaching->education_levels_supported) ? json_decode($coaching->education_levels_supported, true) : ($coaching->education_levels_supported ?? []);
            
        return view('coaching-detail', compact('coaching', 'location', 'boards', 'grades'));
    }

    public function university(\Illuminate\Http\Request $request) {
        $regionMap = [
            'North India'   => ['Uttarakhand','Rajasthan','Uttar Pradesh','Punjab','Haryana','Himachal Pradesh','Jammu','Kashmir','Delhi','Chandigarh','Noida','Dehradun','Jaipur','Ajmer','Mussoorie','Gurgaon','Gurugram','Lucknow','Nainital','Shimla','Solan','Selaqui'],
            'South India'   => ['Tamil Nadu','Karnataka','Andhra Pradesh','Telangana','Kerala','Bengaluru','Bangalore','Hyderabad','Chennai','Ooty','Kodaikanal','Madanapalle','Lovedale'],
            'East India'    => ['West Bengal','Bihar','Jharkhand','Odisha','Assam','Kolkata','Patna','Guwahati','Tezpur'],
            'West India'    => ['Maharashtra','Gujarat','Goa','Mumbai','Pune','Panchgani','Ahmedabad'],
            'Central India' => ['Madhya Pradesh','Chhattisgarh','Bhopal','Indore','Gwalior'],
        ];

        $query = \App\Models\Organisation::where('organisation_type_id', 1)->where('status', 1);

        // Top Filter
        if ($request->has('is_top') && ($request->is_top == '1' || $request->is_top == 'true')) {
            $query->where('is_top', 1);
        }

        // Search
        if ($request->filled('search')) {
            $search = trim($request->search);
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('about_university', 'like', "%{$search}%")
                  ->orWhere('head_office_location', 'like', "%{$search}%")
                  ->orWhere('states_present_in', 'like', "%{$search}%")
                  ->orWhere('cities_present_in', 'like', "%{$search}%");
            });
        }

        // Region filter
        $regions = (array) $request->input('region', []);
        if (!empty($regions)) {
            $keywords = [];
            foreach ($regions as $reg) {
                if (isset($regionMap[$reg])) {
                    $keywords = array_merge($keywords, $regionMap[$reg]);
                }
            }
            if (!empty($keywords)) {
                $query->where(function($q) use ($keywords) {
                    foreach ($keywords as $kw) {
                        $q->orWhere('head_office_location', 'like', "%{$kw}%")
                          ->orWhere('states_present_in', 'like', "%{$kw}%")
                          ->orWhere('cities_present_in', 'like', "%{$kw}%");
                    }
                });
            }
        }

        // State filter
        $states = (array) $request->input('state', []);
        if (!empty($states)) {
            $query->where(function($q) use ($states) {
                foreach ($states as $st) {
                    $q->orWhere('head_office_location', 'like', "%{$st}%")
                      ->orWhere('states_present_in', 'like', "%{$st}%");
                }
            });
        }

        // City filter
        $cities = (array) $request->input('city', []);
        if (!empty($cities)) {
            $query->where(function($q) use ($cities) {
                foreach ($cities as $cy) {
                    $q->orWhere('head_office_location', 'like', "%{$cy}%")
                      ->orWhere('cities_present_in', 'like', "%{$cy}%");
                }
            });
        }

        // Ownership filter (Private / Government / Trust)
        $ownerships = (array) $request->input('ownership', []);
        if (!empty($ownerships)) {
            $query->where(function($q) use ($ownerships) {
                foreach ($ownerships as $own) {
                    $q->orWhere('ownership_type', 'like', "%{$own}%");
                }
            });
        }

        // University type filter (Deemed / Central / State / Private)
        $univTypes = (array) $request->input('university_type', []);
        if (!empty($univTypes)) {
            $query->where(function($q) use ($univTypes) {
                foreach ($univTypes as $ut) {
                    $q->orWhere('university_type', 'like', "%{$ut}%");
                }
            });
        }

        // Level / Program filter (UG, PG, Diploma, PhD)
        $levels = (array) $request->input('level', []);
        if (!empty($levels)) {
            $query->where(function($q) use ($levels) {
                foreach ($levels as $lv) {
                    $q->orWhere('levels_offered', 'like', "%{$lv}%");
                }
            });
        }

        $heroPillLabel = null;
        if ($request->has('is_top') && ($request->is_top == '1' || $request->is_top == 'true')) {
            $heroPillLabel = \Illuminate\Support\Facades\DB::table('hero_sliders')
                ->where('is_active', 1)
                ->whereNotNull('pill_1_label')
                ->where('pill_1_label', '!=', '')
                ->orderBy('sort_order')
                ->value('pill_1_label');
        }

        $universities = $query->orderBy('is_top', 'desc')->orderBy('nirf_rank_overall', 'asc')->paginate(12)->withQueryString();

        return view('university', compact('universities', 'heroPillLabel'));
    }

    public function topUniversities(\Illuminate\Http\Request $request) {
        $request->merge(['is_top' => 1]);
        return $this->university($request);
    }

    public function topSchools(\Illuminate\Http\Request $request) {
        $request->merge(['is_top' => 1]);
        return $this->allSchools($request);
    }

    public function topCoaching(\Illuminate\Http\Request $request) {
        $request->merge(['is_top' => 1]);
        return $this->allCoaching($request);
    }

    public function universityDetail($slug) {
        $university = \App\Models\Organisation::with(['feeStructures', 'admissionRoutes'])
            ->where('slug', $slug)
            ->where('organisation_type_id', 1)
            ->where('status', 1)
            ->firstOrFail();
            
        $locationParts = [];
        $cities = is_string($university->cities_present_in) ? json_decode($university->cities_present_in, true) : ($university->cities_present_in ?? []);
        $states = is_string($university->states_present_in) ? json_decode($university->states_present_in, true) : ($university->states_present_in ?? []);
        if (!empty($cities)) {
            $locationParts[] = $cities[0];
        }
        if (!empty($states)) {
            $locationParts[] = $states[0];
        }
        if (empty($locationParts) && !empty($university->head_office_location)) {
            $location = $university->head_office_location;
        } else {
            $location = implode(', ', $locationParts);
        }
        
        $boards = is_string($university->education_boards_supported) ? json_decode($university->education_boards_supported, true) : ($university->education_boards_supported ?? []);
        $grades = is_string($university->education_levels_supported) ? json_decode($university->education_levels_supported, true) : ($university->education_levels_supported ?? []);
            
        return view('university-detail', compact('university', 'location', 'boards', 'grades'));
    }

    public function mentors(\Illuminate\Http\Request $request) {
        $query = \App\Models\MentorProfile::with('user');

        if ($request->filled('search') || $request->filled('q')) {
            $search = trim($request->input('search', $request->input('q')));
            $query->where(function($q) use ($search) {
                $q->where('first_name', 'like', "%{$search}%")
                  ->orWhere('last_name', 'like', "%{$search}%")
                  ->orWhere('professional_headline', 'like', "%{$search}%")
                  ->orWhere('short_bio', 'like', "%{$search}%");
            });
        }

        $mentors = $query->latest()->get();

        $dbTestimonials = \App\Models\Testimonial::latest()->get();
        $testimonials = [];
        if ($dbTestimonials->isNotEmpty()) {
            foreach ($dbTestimonials as $idx => $tItem) {
                $mentorRef = null;
                if (!empty($tItem->mentor_profile_id)) {
                    $mentorRef = \App\Models\MentorProfile::with('user')->find($tItem->mentor_profile_id);
                }
                if (!$mentorRef) {
                    $mentorRef = $mentors->get($idx % max(1, $mentors->count()));
                }

                $mName = $mentorRef ? trim(($mentorRef->first_name ?? '') . ' ' . ($mentorRef->last_name ?? '')) : 'Expert Mentor';
                if (empty($mName) && $mentorRef) {
                    $mName = $mentorRef->user->name ?? 'Expert Mentor';
                }

                $tPhoto = 'team_member_1.png';
                if (!empty($tItem->image)) {
                    if (str_starts_with($tItem->image, 'http')) {
                        $tPhoto = $tItem->image;
                    } elseif (file_exists(public_path($tItem->image))) {
                        $tPhoto = asset($tItem->image);
                    } elseif (file_exists(public_path('storage/' . $tItem->image))) {
                        $tPhoto = asset('storage/' . $tItem->image);
                    } elseif (file_exists(base_path('../enrollzy_backend/public/' . ltrim($tItem->image, '/')))) {
                        $tPhoto = 'http://127.0.0.1:8001/' . ltrim($tItem->image, '/');
                    } elseif (file_exists(public_path('assets/images/' . $tItem->image))) {
                        $tPhoto = asset('assets/images/' . $tItem->image);
                    }
                }

                $testimonials[] = [
                    'mentor_name' => $mName,
                    'mentor_role' => $mentorRef->professional_headline ?? 'Senior Mentor & Guide',
                    'mentor_avatar' => $mentorRef && $mentorRef->profile_photo ? $mentorRef->profile_photo : 'mentor_1.png',
                    'mentee_name' => $tItem->name,
                    'mentee_role' => $tItem->role ?? 'Mentee / Student',
                    'mentee_avatar' => $tPhoto,
                    'text' => $tItem->content,
                    'stars' => $tItem->rating ?? 5
                ];
            }
        } else {
            $testimonials = [
                [
                    'mentor_name' => 'Abhishek Sharma',
                    'mentor_role' => 'Product Lead • Google',
                    'mentor_avatar' => 'mentor_1.png',
                    'mentee_name' => 'Serhiy Hipskyy',
                    'mentee_role' => 'Tech Aspirant',
                    'mentee_avatar' => 'team_member_1.png',
                    'text' => 'The session with Abhishek was game-changing for my MBA application strategy and interview prep!',
                    'stars' => 5
                ],
                [
                    'mentor_name' => 'Priya Verma',
                    'mentor_role' => 'Sr. Software Engineer • Microsoft',
                    'mentor_avatar' => 'mentor_2.png',
                    'mentee_name' => 'Sneha Patel',
                    'mentee_role' => 'CS Student',
                    'mentee_avatar' => 'team_member_2.png',
                    'text' => 'Priya gave direct, clear insights into system design and top university computer science admissions.',
                    'stars' => 5
                ],
                [
                    'mentor_name' => 'Dr. Rajesh Kulkarni',
                    'mentor_role' => 'AIIMS Counselor',
                    'mentor_avatar' => 'mentor_3.png',
                    'mentee_name' => 'Karan Malhotra',
                    'mentee_role' => 'NEET Aspirant',
                    'mentee_avatar' => 'team_member_3.png',
                    'text' => 'Outstanding guidance on NEET strategy and stress management before the final exam.',
                    'stars' => 5
                ]
            ];
        }

        $video_testimonials = \App\Models\VideoTestimonial::where('is_active', 1)->orderBy('sort_order', 'asc')->get();

        return view('mentors', compact('mentors', 'testimonials', 'video_testimonials'));
    }

    public function mentorDetail($id = null) {
        $mentor = null;
        if ($id) {
            $mentor = \App\Models\MentorProfile::with('user')->find($id);
        }
        if (!$mentor) {
            $mentor = \App\Models\MentorProfile::with('user')->first();
        }

        $otherMentors = \App\Models\MentorProfile::with('user')->where('id', '!=', optional($mentor)->id)->take(4)->get();
        $video_testimonials = \App\Models\VideoTestimonial::where('is_active', 1)->orderBy('sort_order', 'asc')->get();

        return view('mentor-detail', compact('mentor', 'otherMentors', 'video_testimonials'));
    }

    public function submitMentorReview(Request $request) {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'feedback' => 'required|string|max:1000'
        ]);

        return back()->with('success', 'Thank you! Your review for this mentor has been submitted successfully.');
    }
    public function askEnrollzy(Request $request) {
        $query = \App\Models\CommunityQuestion::with(['user', 'category'])
            ->withCount(['replies', 'likes'])
            ->where('is_active', 1)
            ->where('status', 'approved');

        $sort = $request->input('sort', 'new');
        if ($sort === 'popular') {
            $query->orderBy('views', 'desc')->orderBy('id', 'desc');
        } else {
            $query->latest();
        }

        $selectedCategory = null;
        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
            $selectedCategory = \App\Models\CommunityCategory::find($request->category);
        }

        $questions = $query->paginate(10);
        $categories = \App\Models\CommunityCategory::withCount('questions')->get();

        $rules = [
            [
                'title' => '1. Rule 1 - Questions must be clear and direct and may not use the body textbox',
                'body' => 'Please ensure all submitted questions are direct and fully written in the title bar. Do not submit blank questions or post questions that only reference descriptions.'
            ],
            [
                'title' => '2. Rule 2 - No personal or professional advice requests',
                'body' => 'Avoid requests that ask for specific legal, medical, or financial advice. The community represents an academic forum.'
            ],
            [
                'title' => '3. Rule 3 - Open ended questions only',
                'body' => 'Ask questions that prompt discussion and allow multiple expert perspectives to add value, rather than simple yes/no checks.'
            ],
            [
                'title' => '4. Rule 4 - No personal info',
                'body' => 'Do not post email addresses, phone numbers, or private details to protect user privacy.'
            ],
            [
                'title' => '5. Rule 5 - No loaded questions',
                'body' => 'Keep questions unbiased. Do not frame questions in a way that forces a specific viewpoint.'
            ]
        ];

        return view('ask-enrollzy', compact('questions', 'categories', 'rules', 'sort', 'selectedCategory'));
    }

    public function storeQuestion(Request $request) {
        $request->validate([
            'question_text' => 'required|string|max:1000',
            'category_id' => 'required|exists:community_categories,id',
            'image' => 'nullable|image|max:4096'
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('community_questions', 'public');
        }

        \App\Models\CommunityQuestion::create([
            'user_id' => auth()->id() ?? 1,
            'category_id' => $request->category_id,
            'question_text' => $request->question_text,
            'image' => $imagePath,
            'status' => 'approved',
            'is_active' => 1,
            'views' => 0
        ]);

        return redirect()->route('ask.enrollzy')->with('success', 'Your question has been posted successfully!');
    }

    public function questionDetail($id) {
        $question = \App\Models\CommunityQuestion::with(['user', 'category', 'replies' => function($q) {
            $q->where('status', 'approved')->where('is_active', 1)->with(['user', 'likes']);
        }])->withCount(['replies', 'likes'])->findOrFail($id);

        $question->increment('views');

        $relatedQuestions = \App\Models\CommunityQuestion::where('category_id', $question->category_id)
            ->where('id', '!=', $question->id)
            ->where('status', 'approved')
            ->where('is_active', 1)
            ->take(5)
            ->get();

        $categories = \App\Models\CommunityCategory::withCount('questions')->get();

        return view('ask-enrollzy-detail', compact('question', 'relatedQuestions', 'categories'));
    }

    public function storeReply(Request $request) {
        $request->validate([
            'question_id' => 'required|exists:community_questions,id',
            'content' => 'required|string|max:2000'
        ]);

        \App\Models\CommunityReply::create([
            'user_id' => auth()->id() ?? 1,
            'question_id' => $request->question_id,
            'content' => $request->content,
            'status' => 'approved',
            'is_active' => 1
        ]);

        return back()->with('success', 'Your answer/reply has been posted successfully!');
    }

    public function toggleLike(Request $request) {
        $request->validate([
            'question_id' => 'required|exists:community_questions,id'
        ]);

        $userId = auth()->id() ?? 1;
        $questionId = $request->question_id;

        $existingLike = \App\Models\CommunityLike::where('user_id', $userId)
            ->where('likable_id', $questionId)
            ->where('likable_type', \App\Models\CommunityQuestion::class)
            ->first();

        if ($existingLike) {
            $existingLike->delete();
            $liked = false;
        } else {
            \App\Models\CommunityLike::create([
                'user_id' => $userId,
                'likable_id' => $questionId,
                'likable_type' => \App\Models\CommunityQuestion::class
            ]);
            $liked = true;
        }

        $likesCount = \App\Models\CommunityLike::where('likable_id', $questionId)
            ->where('likable_type', \App\Models\CommunityQuestion::class)
            ->count();

        return response()->json([
            'success' => true,
            'liked' => $liked,
            'likes_count' => $likesCount
        ]);
    }

    public function globalSearch(\Illuminate\Http\Request $request) {
        $type = strtolower(trim($request->input('type', '')));
        $q = trim($request->input('q', ''));

        $params = array_filter(['search' => $q]);

        if ($type === 'colleges') {
            return redirect()->route('university', $params);
        } elseif ($type === 'courses' || $type === 'coaching') {
            return redirect()->route('all.coaching', $params);
        } elseif ($type === 'mentors') {
            return redirect()->route('mentors', array_filter(['search' => $q, 'q' => $q]));
        } elseif ($type === 'schools') {
            return redirect()->route('all-schools', $params);
        }

        // All Categories — show combined search results page
        if (!empty($q)) {
            return redirect()->route('search.results', ['q' => $q]);
        }

        return redirect()->route('home');
    }

    public function searchResults(\Illuminate\Http\Request $request) {
        $q = trim($request->input('q', ''));

        if (empty($q)) {
            return redirect()->route('home');
        }

        // Colleges / Universities
        $colleges = \App\Models\Organisation::where('status', 1)
            ->where('organisation_type_id', 1)
            ->where(function($query) use ($q) {
                $query->where('name', 'like', "%{$q}%")
                      ->orWhere('short_name', 'like', "%{$q}%")
                      ->orWhere('cities_present_in', 'like', "%{$q}%")
                      ->orWhere('states_present_in', 'like', "%{$q}%");
            })
            ->limit(6)->get();

        // Schools
        $schools = \App\Models\Organisation::where('status', 1)
            ->where('organisation_type_id', 4)
            ->where(function($query) use ($q) {
                $query->where('name', 'like', "%{$q}%")
                      ->orWhere('short_name', 'like', "%{$q}%")
                      ->orWhere('cities_present_in', 'like', "%{$q}%")
                      ->orWhere('states_present_in', 'like', "%{$q}%");
            })
            ->limit(6)->get();

        // Coaching
        $coachings = \App\Models\Organisation::where('status', 1)
            ->where('organisation_type_id', 3)
            ->where(function($query) use ($q) {
                $query->where('name', 'like', "%{$q}%")
                      ->orWhere('short_name', 'like', "%{$q}%")
                      ->orWhere('cities_present_in', 'like', "%{$q}%");
            })
            ->limit(6)->get();

        // Mentors
        $mentors = \App\Models\MentorProfile::with('user')
            ->where(function($query) use ($q) {
                $query->where('first_name', 'like', "%{$q}%")
                      ->orWhere('last_name', 'like', "%{$q}%")
                      ->orWhere('professional_headline', 'like', "%{$q}%")
                      ->orWhere('short_bio', 'like', "%{$q}%");
            })
            ->limit(6)->get();

        $totalResults = $colleges->count() + $schools->count() + $coachings->count() + $mentors->count();

        return view('search-results', compact('q', 'colleges', 'schools', 'coachings', 'mentors', 'totalResults'));
    }


    public function liveSearch(\Illuminate\Http\Request $request) {
        $q = trim($request->input('q', ''));
        $type = strtolower(trim($request->input('type', '')));

        if (empty($q)) {
            return response()->json([]);
        }

        $results = collect();

        // 1. Colleges / Universities
        if (empty($type) || $type === 'colleges') {
            $colleges = \App\Models\Organisation::where('status', 1)
                ->where('organisation_type_id', 1)
                ->where(function($query) use ($q) {
                    $query->where('name', 'like', "%{$q}%")
                          ->orWhere('short_name', 'like', "%{$q}%")
                          ->orWhere('cities_present_in', 'like', "%{$q}%")
                          ->orWhere('states_present_in', 'like', "%{$q}%");
                })
                ->limit(5)
                ->get();

            foreach ($colleges as $c) {
                $location = '';
                $cities = is_string($c->cities_present_in) ? json_decode($c->cities_present_in, true) : ($c->cities_present_in ?? []);
                $states = is_string($c->states_present_in) ? json_decode($c->states_present_in, true) : ($c->states_present_in ?? []);
                if (!empty($cities[0])) $location .= $cities[0];
                if (!empty($states[0])) $location .= ($location ? ', ' : '') . $states[0];

                $results->push([
                    'title' => $c->name,
                    'subtitle' => $location ?: 'University',
                    'type' => 'University',
                    'url' => route('university.detail', $c->slug ?? $c->id)
                ]);
            }
        }

        // 2. Schools
        if (empty($type) || $type === 'schools') {
            $schools = \App\Models\Organisation::where('status', 1)
                ->where('organisation_type_id', 4)
                ->where(function($query) use ($q) {
                    $query->where('name', 'like', "%{$q}%")
                          ->orWhere('short_name', 'like', "%{$q}%")
                          ->orWhere('cities_present_in', 'like', "%{$q}%")
                          ->orWhere('states_present_in', 'like', "%{$q}%");
                })
                ->limit(5)
                ->get();

            foreach ($schools as $s) {
                $location = '';
                $cities = is_string($s->cities_present_in) ? json_decode($s->cities_present_in, true) : ($s->cities_present_in ?? []);
                $states = is_string($s->states_present_in) ? json_decode($s->states_present_in, true) : ($s->states_present_in ?? []);
                if (!empty($cities[0])) $location .= $cities[0];
                if (!empty($states[0])) $location .= ($location ? ', ' : '') . $states[0];

                $results->push([
                    'title' => $s->name,
                    'subtitle' => $location ?: 'Boarding School',
                    'type' => 'School',
                    'url' => route('school.detail', $s->slug ?? $s->id)
                ]);
            }
        }

        // 3. Coaching / Courses
        if (empty($type) || $type === 'courses' || $type === 'coaching') {
            $coachings = \App\Models\Organisation::where('status', 1)
                ->where('organisation_type_id', 3)
                ->where(function($query) use ($q) {
                    $query->where('name', 'like', "%{$q}%")
                          ->orWhere('short_name', 'like', "%{$q}%")
                          ->orWhere('cities_present_in', 'like', "%{$q}%");
                })
                ->limit(5)
                ->get();

            foreach ($coachings as $co) {
                $results->push([
                    'title' => $co->name,
                    'subtitle' => 'Integrated Coaching',
                    'type' => 'Coaching',
                    'url' => route('coaching.detail', $co->slug ?? $co->id)
                ]);
            }
        }

        // 4. Mentors
        if (empty($type) || $type === 'mentors') {
            $mentors = \App\Models\MentorProfile::where(function($query) use ($q) {
                    $query->where('first_name', 'like', "%{$q}%")
                          ->orWhere('last_name', 'like', "%{$q}%")
                          ->orWhere('professional_headline', 'like', "%{$q}%")
                          ->orWhere('short_bio', 'like', "%{$q}%");
                })
                ->limit(5)
                ->get();

            foreach ($mentors as $m) {
                $name = trim(($m->first_name ?? '') . ' ' . ($m->last_name ?? ''));
                $results->push([
                    'title' => $name ?: 'Expert Mentor',
                    'subtitle' => $m->professional_headline ?: ($m->city ?: 'Mentor'),
                    'type' => 'Mentor',
                    'url' => route('mentor.detail', $m->id)
                ]);
            }
        }

        // 5. Dynamic Exams
        if (empty($type)) {
            $exams = \App\Models\DynamicExam::where('status', 1)
                ->where(function($query) use ($q) {
                    $query->where('name', 'like', "%{$q}%")
                          ->orWhere('short_name', 'like', "%{$q}%");
                })
                ->limit(5)
                ->get();

            foreach ($exams as $ex) {
                $results->push([
                    'title' => $ex->name ?? $ex->short_name,
                    'subtitle' => 'Entrance Exam',
                    'type' => 'Exam',
                    'url' => route('top-exam.detail', $ex->slug ?? $ex->id)
                ]);
            }
        }

        return response()->json($results->take(5)->values());
    }
}
