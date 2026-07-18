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
        $video_testimonials = \App\Models\VideoTestimonial::where('is_active', 1)->orderBy('sort_order')->get();
        $blogs = \App\Models\Blog::with('category')->orderBy('published_at', 'desc')->take(4)->get();
        $testimonials = \App\Models\Testimonial::orderBy('id', 'desc')->get();

        $schoolsCount = \App\Models\Organisation::where('organisation_type_id', 4)->count();
        $coachingCount = \App\Models\Organisation::where('organisation_type_id', 3)->count();
        $universitiesCount = \App\Models\Organisation::where('organisation_type_id', 1)->count();
        // Since MentorProfile might be in backend, let's copy the model to frontend first if it's not there, or just use DB facade
        $mentorsCount = \Illuminate\Support\Facades\DB::table('mentor_profiles')->count();
        $mentors = \Illuminate\Support\Facades\DB::table('mentor_profiles')->orderBy('id', 'desc')->take(4)->get();
        
        $coachingInstitutes = \App\Models\Organisation::where('organisation_type_id', 3)->where('status', 1)->take(6)->get();

        $heroSliders = \Illuminate\Support\Facades\DB::table('hero_sliders')->where('is_active', 1)->orderBy('sort_order')->get();

        return view('index', compact('boardingSchools', 'noteworthy_categories', 'faqs', 'home_services', 'top_exams', 'video_testimonials', 'blogs', 'testimonials', 'schoolsCount', 'coachingCount', 'universitiesCount', 'mentorsCount', 'coachingInstitutes', 'mentors', 'heroSliders'));
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

    public function allSchools() {
        $schools = \App\Models\Organisation::where('organisation_type_id', 4)
            ->where('status', 1)
            ->orderBy('id', 'desc')
            ->paginate(10);
            
        return view('all-schools', compact('schools'));
    }
    public function topExams() {
        $exams = \App\Models\DynamicExam::where('status', 'Active')->orderBy('id', 'desc')->paginate(12);
        return view('top-exams', compact('exams'));
    }
    public function examDetail($slug)
    {
        $exam = \App\Models\DynamicExam::with('sections')->where('slug', $slug)->firstOrFail();
        return view('top-exam-detail', compact('exam'));
    }
    
    public function contactUs() {
        $contactDetails = \Illuminate\Support\Facades\DB::table('contact_us_details')->first();
        return view('contact-us', compact('contactDetails'));
    }

    public function submitContactUs(\Illuminate\Http\Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'company' => 'nullable|string|max:255',
            'type' => 'nullable|string|max:100',
            'message' => 'required|string',
        ]);

        $subjectParts = ['Contact Us'];
        if ($request->type) $subjectParts[] = 'Type: ' . $request->type;
        if ($request->company) $subjectParts[] = 'Company: ' . $request->company;
        
        $subject = implode(' | ', $subjectParts);

        \Illuminate\Support\Facades\DB::table('leads')->insert([
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'subject' => $subject,
            'type' => 'Student', // ENUM only accepts 'Student','Expert','Alumni'
            'message' => $request->message,
            'status' => 'New',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->back()->with('success', 'Your message has been sent successfully. We will get back to you soon!');
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
    
    public function scholarships() { return view('scholarships-and-benefits'); }
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
    
    public function allCoaching() {
        $coachings = \App\Models\Organisation::where('organisation_type_id', 3)
            ->where('status', 1)
            ->orderBy('id', 'desc')
            ->paginate(10);
            
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

    public function university() { return view('university'); }
}
