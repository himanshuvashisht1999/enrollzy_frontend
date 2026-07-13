<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PageController;

Route::get('/', [PageController::class, 'index']);
Route::get('/about', [PageController::class, 'about']);
Route::get('/all-schools', [PageController::class, 'allSchools']);
Route::get('/blogs', [PageController::class, 'blogs'])->name('blogs');
Route::get('/blog/{slug}', [PageController::class, 'blogDetail'])->name('blog.detail');
Route::get('/contact-us', [PageController::class, 'contactUs']);
Route::get('/top-exams', [PageController::class, 'topExams'])->name('top-exams');
Route::get('/exam/{slug}', [PageController::class, 'examDetail'])->name('exam.detail');
Route::get('/faq', [App\Http\Controllers\PageController::class, 'faq'])->name('faq');
Route::get('/about-us', [App\Http\Controllers\PageController::class, 'aboutUs'])->name('about-us');
Route::get('/scholarships-and-benefits', [PageController::class, 'scholarships']);
Route::get('/school-detail/{slug}', [PageController::class, 'schoolDetail'])->name('school.detail');
Route::get('/all-coaching', [PageController::class, 'allCoaching'])->name('all.coaching');
Route::get('/coaching-detail/{slug}', [PageController::class, 'coachingDetail'])->name('coaching.detail');
Route::get('/university', [PageController::class, 'university']);
