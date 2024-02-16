<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Models\Settings\SiteSettings;
use App\Models\Category;
use Illuminate\Pagination\Paginator;
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
        // Fetch the Site Settings object
        $site_settings = SiteSettings::find(1);
        $project_categories = Category::where('type', '1')->get();

        siteSettings();

        View::share([
            'site_settings' =>  $site_settings,
            'project_categories' =>  $project_categories,
        ]);

        Paginator::useBootstrap();
    }
}
