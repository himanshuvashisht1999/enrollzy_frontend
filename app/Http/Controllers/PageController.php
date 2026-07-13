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

        return view('index', compact('boardingSchools', 'noteworthy_categories', 'faqs', 'home_services', 'top_exams', 'video_testimonials', 'blogs', 'testimonials', 'schoolsCount', 'coachingCount', 'universitiesCount', 'mentorsCount', 'coachingInstitutes', 'mentors'));
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
    
    public function contactUs() { return view('contact-us'); }
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
        $school = \App\Models\Organisation::where('slug', $slug)->where('organisation_type_id', 4)->where('status', 1)->firstOrFail();
        return view('school-detail', compact('school'));
    }
    
    public function allCoaching() {
        $coachings = \App\Models\Organisation::where('organisation_type_id', 3)
            ->where('status', 1)
            ->orderBy('id', 'desc')
            ->paginate(10);
            
        return view('all-coaching', compact('coachings'));
    }
    
    public function coachingDetail($slug) {
        $coaching = \App\Models\Organisation::where('slug', $slug)->where('organisation_type_id', 3)->where('status', 1)->firstOrFail();
        return view('coaching-detail', compact('coaching'));
    }

    public function university() { return view('university'); }
}
