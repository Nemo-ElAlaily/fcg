<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Builder;

use App\Models\Settings\SiteSettings;
use App\Models\Category;
use App\Models\Branch;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Cache site-wide settings and navigation data for 24 hours
        $site_settings = Cache::remember('site_settings', 1440, function () {
            return SiteSettings::find(1);
        });

        $project_categories = Cache::remember('project_categories', 1440, function () {
            return Category::with(['projects' => function ($query) {
                $query->where('is_active', '1');
            }])->whereHas('projects', function (Builder $query) {
                $query->where('is_active', '1');
            })->where('type', '1')->get();
        });

        $hq = Cache::remember('hq_branch', 1440, function () {
            return Branch::find(8);
        });

        siteSettings();

        View::share([
            'site_settings' =>  $site_settings,
            'project_categories' =>  $project_categories,
            'hq' => $hq,
        ]);

        Paginator::useBootstrap();
    }
}
