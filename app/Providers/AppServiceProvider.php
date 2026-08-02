<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Pagination\Paginator;
use App\Models\HeaderLink;
use App\Models\HeaderMenu;
use App\Models\MegaMenu;

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
            $view->with('headerMenus', \App\Models\HeaderMenu::where('status', 1)->whereNull('parent_id')->orderBy('sort_order')->get());

            // Build mega menu categories from header_links with their sub-items from mega_menus
            $megaMenuCategories = collect([]);
            try {
                if (\Illuminate\Support\Facades\Schema::hasTable('mega_menus') &&
                    \Illuminate\Support\Facades\Schema::hasColumn('mega_menus', 'header_link_id')) {

                    // Load all active sub-items grouped by header_link_id
                    $subItems = MegaMenu::whereNotNull('parent_id')
                        ->whereNotNull('header_link_id')
                        ->where('status', 1)
                        ->orderBy('sort_order')
                        ->get()
                        ->groupBy('header_link_id');

                    // Build category objects from header_links with re-indexed values
                    $megaMenuCategories = HeaderLink::where('status', 1)
                        ->orderBy('sort_order')
                        ->get()
                        ->map(function ($hl) use ($subItems) {
                            $hl->children = $subItems->get($hl->id, collect());
                            return $hl;
                        })
                        ->values();
                } elseif (\Illuminate\Support\Facades\Schema::hasTable('mega_menus')) {
                    // Legacy fallback: load by parent_id=null structure
                    $megaMenuCategories = MegaMenu::whereNull('parent_id')
                        ->where('status', 1)
                        ->orderBy('sort_order')
                        ->with(['children' => function($q) { $q->where('status', 1)->orderBy('sort_order'); }])
                        ->get();
                }
            } catch (\Throwable $e) {
                $megaMenuCategories = collect([]);
            }
            $view->with('megaMenuCategories', $megaMenuCategories);
            $view->with('headerBoardingSchools', \App\Models\Organisation::where('organisation_type_id', 4)->where('status', 1)->take(7)->get());
            $view->with('headerUniversities', \App\Models\Organisation::where('organisation_type_id', 1)->where('status', 1)->take(7)->get());
            $view->with('headerCoachingInstitutes', \App\Models\Organisation::where('organisation_type_id', 3)->where('status', 1)->take(7)->get());
            $view->with('headerTopExams', \App\Models\DynamicExam::where('status', 'Active')->orderBy('id', 'desc')->take(8)->get());
        });

        View::composer('common.footer', function ($view) {
            $view->with('footerColumns', \App\Models\FooterMenu::with(['children' => function($q) { $q->where('status', 1)->orderBy('sort_order'); }])->where('status', 1)->whereNull('parent_id')->orderBy('sort_order')->get());
            $view->with('generalLinks', \App\Models\GeneralLink::where('status', 1)->orderBy('sort_order')->get());
            $view->with('siteSettings', \App\Models\Setting::first());
        });
    }
}
