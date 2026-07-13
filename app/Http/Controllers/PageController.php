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

        return view('index', compact('boardingSchools', 'noteworthy_categories', 'faqs', 'home_services', 'top_exams'));
    }
    public function about() { return view('about'); }
    public function allSchools() {
        $schools = \App\Models\Organisation::where('organisation_type_id', 4)->where('status', 1)->paginate(12);
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
    public function blogs() { return view('blogs'); }
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
    public function scholarships() { return view('scholarships-and-benefits'); }
    public function schoolDetail($slug) {
        $school = \App\Models\Organisation::where('slug', $slug)->where('organisation_type_id', 4)->where('status', 1)->firstOrFail();
        return view('school-detail', compact('school'));
    }
    public function university() { return view('university'); }
}
