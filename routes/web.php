<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PageController;

Route::get('/', [PageController::class, 'index']);
Route::get('/about', [PageController::class, 'about']);
Route::get('/all-schools', [PageController::class, 'allSchools']);
Route::get('/blogs', [PageController::class, 'blogs']);
Route::get('/contact-us', [PageController::class, 'contactUs']);
Route::get('/faq', [PageController::class, 'faq']);
Route::get('/scholarships-and-benefits', [PageController::class, 'scholarships']);
Route::get('/school-detail', [PageController::class, 'schoolDetail']);
Route::get('/top-exam-detail', [PageController::class, 'topExamDetail']);
Route::get('/top-exams', [PageController::class, 'topExams']);
Route::get('/university', [PageController::class, 'university']);
