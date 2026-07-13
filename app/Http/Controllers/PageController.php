<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index() { return view('index'); }
    public function about() { return view('about'); }
    public function allSchools() { return view('all-schools'); }
    public function blogs() { return view('blogs'); }
    public function contactUs() { return view('contact-us'); }
    public function faq() { return view('faq'); }
    public function scholarships() { return view('scholarships-and-benefits'); }
    public function schoolDetail() { return view('school-detail'); }
    public function topExamDetail() { return view('top-exam-detail'); }
    public function topExams() { return view('top-exams'); }
    public function university() { return view('university'); }
}
