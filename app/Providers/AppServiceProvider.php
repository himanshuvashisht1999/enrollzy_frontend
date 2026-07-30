<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Pagination\Paginator;
use App\Models\HeaderLink;
use App\Models\HeaderMenu;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrapFive();

        View::composer('common.header', function ($view) {
            $view->with('headerLinks', HeaderLink::where('status', 1)->orderBy('sort_order')->get());
            $view->with('headerMenus', HeaderMenu::where('status', 1)->whereNull('parent_id')->orderBy('sort_order')->get());
            $view->with('headerBoardingSchools', \App\Models\Organisation::where('organisation_type_id', 4)->where('status', 1)->take(7)->get());
            $view->with('headerUniversities', \App\Models\Organisation::where('organisation_type_id', 1)->where('status', 1)->take(7)->get());
            $view->with('headerCoachingInstitutes', \App\Models\Organisation::where('organisation_type_id', 3)->where('status', 1)->take(7)->get());
            $view->with('headerTopExams', \App\Models\DynamicExam::where('status', 'Active')->orderBy('id', 'desc')->take(8)->get());
        });

        View::composer('common.footer', function ($view) {
            $view->with('footerColumns', \App\Models\FooterMenu::with('children')->where('status', 1)->whereNull('parent_id')->orderBy('sort_order')->get());
            $view->with('siteSettings', \App\Models\Setting::first());
        });
    }
}
