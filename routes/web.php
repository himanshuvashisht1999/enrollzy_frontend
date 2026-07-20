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
    Route::get('/school-detail/{slug}', [PageController::class, 'schoolDetail'])->name('school.detail');
    Route::get('/all-coaching', [PageController::class, 'allCoaching'])->name('all.coaching');
    Route::get('/coaching-detail/{slug}', [PageController::class, 'coachingDetail'])->name('coaching.detail');
    Route::get('/university', [PageController::class, 'university'])->name('university');
});
