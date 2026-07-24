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
        $top_exams = \App\Models\DynamicExam::where('status', 'Active')->orderBy('id', 'desc')->take(6)->get();
        $video_testimonials = collect();
        $blogs = \App\Models\Blog::with('category')->orderBy('published_at', 'desc')->take(4)->get();
        $testimonials = \App\Models\Testimonial::orderBy('id', 'desc')->get();

        $schoolsCount = \App\Models\Organisation::where('organisation_type_id', 4)->count();
        $coachingCount = \App\Models\Organisation::where('organisation_type_id', 3)->count();
        $universitiesCount = \App\Models\Organisation::where('organisation_type_id', 1)->count();
        $totalInstitutionsCount = \App\Models\Organisation::where('status', 1)->count();
        
        $totalLeadsCount = \Illuminate\Support\Facades\DB::table('leads')->count();
        $totalExamsCount = \App\Models\DynamicExam::where('status', 'Active')->count();

        // Since MentorProfile might be in backend, let's copy the model to frontend first if it's not there, or just use DB facade
        $mentorsCount = \Illuminate\Support\Facades\DB::table('mentor_profiles')->count();
        $mentors = \Illuminate\Support\Facades\DB::table('mentor_profiles')->orderBy('id', 'desc')->take(4)->get();
        
        $coachingInstitutes = \App\Models\Organisation::where('organisation_type_id', 3)->where('status', 1)->take(6)->get();

        $heroSliders = \Illuminate\Support\Facades\DB::table('hero_sliders')->where('is_active', 1)->orderBy('sort_order')->get();
        $firstHero = $heroSliders->first();

        $quesAnsSection = \Illuminate\Support\Facades\DB::table('homepage_sections')->where('section_key', 'ques_ans')->first();

        return view('index', compact(
            'boardingSchools', 'noteworthy_categories', 'faqs', 'home_services', 
            'top_exams', 'video_testimonials', 'blogs', 'testimonials', 
            'schoolsCount', 'coachingCount', 'universitiesCount', 'totalInstitutionsCount',
            'totalLeadsCount', 'totalExamsCount', 'mentorsCount', 'coachingInstitutes', 
            'mentors', 'heroSliders', 'firstHero', 'quesAnsSection'
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
                    $q->orWhere('minority_type', 'like', "%{$tp}%")
                      ->orWhere('brand_type', 'like', "%{$tp}%")
                      ->orWhere('about_organisation', 'like', "%{$tp}%");
                }
            });
        }

        // 10. Gender Filter
        if ($request->filled('gender')) {
            $genders = (array) $request->gender;
            $query->where(function($q) use ($genders) {
                foreach ($genders as $gen) {
                    $q->orWhere('minority_type', 'like', "%{$gen}%")
                      ->orWhere('about_organisation', 'like', "%{$gen}%");
                }
            });
        }
    }

    public function allSchools(\Illuminate\Http\Request $request) {
        $query = \App\Models\Organisation::where('organisation_type_id', 4)
            ->where('status', 1);

        $this->applyOrganisationFilters($query, $request);

        $schools = $query->orderBy('id', 'desc')->paginate(10)->withQueryString();
            
        return view('all-schools', compact('schools'));
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
            'email' => 'nullable|email|max:255',
            'company' => 'nullable|string|max:255',
            'organisation_name' => 'nullable|string|max:255',
            'type' => 'nullable|string|max:100',
            'business_type' => 'nullable|string|max:100',
            'looking_for' => 'nullable|string|max:255',
            'session_time' => 'nullable|string|max:255',
            'message' => 'nullable|string',
        ]);

        $businessType = $request->type ?? $request->business_type ?? $request->looking_for;
        $orgName = $request->organisation_name ?? $request->company;

        $subjectParts = ['Callback Inquiry'];
        if ($orgName) $subjectParts[] = 'Institute/School: ' . $orgName;
        if ($businessType) $subjectParts[] = 'Type: ' . $businessType;
        
        $subject = implode(' | ', $subjectParts);

        $messageContent = $request->message;
        if (empty($messageContent)) {
            $details = [];
            if ($orgName) $details[] = 'Institute/School Name: ' . $orgName;
            if ($request->session_time) $details[] = 'Preferred Session Time: ' . $request->session_time;
            $messageContent = !empty($details) ? implode("\n", $details) : 'Request a callback from website.';
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

        $coachings = $query->orderBy('id', 'desc')->paginate(10)->withQueryString();
            
        return view('all-coaching', compact('coachings'));
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

        $universities = $query->orderBy('nirf_rank_overall', 'asc')->paginate(12)->withQueryString();

        return view('university', compact('universities'));
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

    public function mentors() {
        $mentors = \App\Models\MentorProfile::with('user')->latest()->get();

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

        if ($type === 'colleges') {
            return redirect()->route('university', array_filter(['search' => $q]));
        } elseif ($type === 'courses') {
            return redirect()->route('all.coaching', array_filter(['search' => $q]));
        } elseif ($type === 'mentors') {
            return redirect()->route('mentors', array_filter(['q' => $q]));
        } elseif ($type === 'schools') {
            return redirect()->route('all-schools', array_filter(['search' => $q]));
        }

        if (!empty($q)) {
            return redirect()->route('university', ['search' => $q]);
        }

        return redirect()->route('home');
    }
}
