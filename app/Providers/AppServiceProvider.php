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
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        Paginator::useBootstrapFive();

        View::composer('common.header', function ($view) {
            $view->with('headerLinks', HeaderLink::where('status', 1)->whereNull('parent_id')->orderBy('sort_order')->get());
            $view->with('headerMenus', \App\Models\HeaderMenu::where('status', 1)->whereNull('parent_id')->orderBy('sort_order')->get());

            $megaMenuCategories = collect([]);
            try {
                if (\Illuminate\Support\Facades\Schema::hasTable('mega_menus') &&
                    \Illuminate\Support\Facades\Schema::hasColumn('mega_menus', 'header_link_id')) {

                    $subItems = MegaMenu::whereNotNull('parent_id')
                        ->whereNotNull('header_link_id')
                        ->where('status', 1)
                        ->orderBy('sort_order')
                        ->get()
                        ->groupBy('header_link_id');

                    // Load Top Level Categories
                    $megaMenuCategories = HeaderLink::where('status', 1)
                        ->whereNull('parent_id')
                        ->orderBy('sort_order')
                        ->get()
                        ->map(function ($hl) use ($subItems) {
                            // Load Child Categories
                            $hl->child_links = HeaderLink::where('status', 1)
                                ->where('parent_id', $hl->id)
                                ->orderBy('sort_order')
                                ->get()
                                ->map(function ($child) use ($subItems) {
                                    $child->mega_menus = $subItems->get($child->id, collect());
                                    return $child;
                                });
                            return $hl;
                        })
                        ->values();
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

        View::composer('common.head', function ($view) {
            $siteSettings = \App\Models\Setting::first();
            $seoSetting = null;
            try {
                if (\Illuminate\Support\Facades\Schema::hasTable('seo_organization_settings')) {
                    $seoSetting = \App\Models\SeoOrganizationSetting::with('founders')->first();
                    if ($seoSetting && $seoSetting->schema_enabled && $seoSetting->organization_schema) {
                        $view->with('organizationSchema', $seoSetting->generateOrganizationSchema());
                    }
                }
            } catch (\Throwable $e) {
                // Silently handle
            }

            $faviconUrl = null;
            $backendUrl = rtrim(env('BACKEND_URL', 'http://127.0.0.1:8001'), '/');

            if ($siteSettings && !empty($siteSettings->favicon)) {
                $fav = $siteSettings->favicon;
                if (str_starts_with($fav, 'http')) {
                    $faviconUrl = $fav;
                } elseif (file_exists(public_path($fav))) {
                    $faviconUrl = asset($fav);
                } else {
                    $faviconUrl = $backendUrl . '/' . ltrim($fav, '/');
                }
            } elseif ($seoSetting && !empty($seoSetting->favicon)) {
                $fav = $seoSetting->favicon;
                if (str_starts_with($fav, 'http')) {
                    $faviconUrl = $fav;
                } elseif (file_exists(public_path($fav))) {
                    $faviconUrl = asset($fav);
                } else {
                    $faviconUrl = $backendUrl . '/' . ltrim($fav, '/');
                }
            }

            if (!$faviconUrl) {
                $faviconUrl = asset('assets/images/logo.svg');
            }

            $view->with('siteFavicon', $faviconUrl);
            $view->with('siteSettings', $siteSettings);
            $view->with('seoSetting', $seoSetting);
        });
    }
}

