<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PageController;

Route::get('/site-login', function () {
    return view('simple-login');
})->name('site-login');

Route::post('/site-login', function (\Illuminate\Http\Request $request) {
    if ($request->username === 'enrollzy' && $request->password === '12345678') {
        $request->session()->put('simple_auth', true);
        return redirect('/');
    }
    return back()->with('error', 'Invalid username or password');
})->name('site-login.submit');

Route::middleware([\App\Http\Middleware\SimpleAuthMiddleware::class])->group(function () {
    Route::get('/', [PageController::class, 'index'])->name('home');
    Route::get('/about', [PageController::class, 'about']);
    Route::get('/all-schools', [PageController::class, 'allSchools'])->name('all-schools');
    Route::get('/blogs', [PageController::class, 'blogs'])->name('blogs');
    Route::get('/blog/{slug}', [PageController::class, 'blogDetail'])->name('blog.detail');
    Route::get('/contact-us', [PageController::class, 'contactUs'])->name('contact');
    Route::post('/contact-us', [PageController::class, 'submitContactUs'])->name('contact.submit');
    Route::get('/top-exams', [PageController::class, 'topExams'])->name('top-exams');
    Route::get('/exam/{slug}', [PageController::class, 'examDetail'])->name('exam.detail');
    Route::get('/faq', [App\Http\Controllers\PageController::class, 'faq'])->name('faq');
    Route::get('/about-us', [App\Http\Controllers\PageController::class, 'aboutUs'])->name('about-us');
    Route::get('/scholarships-and-benefits', [PageController::class, 'scholarships'])->name('scholarships');
    Route::get('/scholarship-detail/{id}', [PageController::class, 'scholarshipDetail'])->name('scholarship.detail');
    Route::get('/school-detail/{slug}', [PageController::class, 'schoolDetail'])->name('school.detail');
    Route::get('/all-coaching', [PageController::class, 'allCoaching'])->name('all.coaching');
    Route::get('/coaching-detail/{slug}', [PageController::class, 'coachingDetail'])->name('coaching.detail');
    Route::get('/university', [PageController::class, 'university'])->name('university');
    Route::get('/university-detail/{slug}', [PageController::class, 'universityDetail'])->name('university.detail');
    Route::get('/mentors', [PageController::class, 'mentors'])->name('mentors');
    Route::get('/mentor-detail/{id?}', [PageController::class, 'mentorDetail'])->name('mentor.detail');
    Route::post('/mentor-detail/review', [PageController::class, 'submitMentorReview'])->name('mentor.review.submit');
    Route::get('/ask-enrollzy', [PageController::class, 'askEnrollzy'])->name('ask.enrollzy');
    Route::post('/ask-enrollzy/question/store', [PageController::class, 'storeQuestion'])->name('ask.enrollzy.store');
    Route::get('/ask-enrollzy/question/{id}', [PageController::class, 'questionDetail'])->name('ask.enrollzy.detail');
    Route::post('/ask-enrollzy/reply/store', [PageController::class, 'storeReply'])->name('ask.enrollzy.reply.store');
    Route::post('/ask-enrollzy/like', [PageController::class, 'toggleLike'])->name('ask.enrollzy.like');
    Route::get('/global-search', [PageController::class, 'globalSearch'])->name('global.search');
    Route::get('/live-search', [PageController::class, 'liveSearch'])->name('live.search');
    Route::get('/top-universities', [PageController::class, 'topUniversities'])->name('top.universities');
    Route::get('/top-schools', [PageController::class, 'topSchools'])->name('top.schools');
    Route::get('/top-coaching', [PageController::class, 'topCoaching'])->name('top.coaching');
});
