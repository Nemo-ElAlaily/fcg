<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Builder;

use App\Models\Settings\SiteSettings;
use App\Models\Category;
use App\Models\Branch;
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
        $project_categories = Category::with('projects')->whereHas('projects', function (Builder $query) {
            $query->where('is_active', '1');
           })->get();
        $hq = Branch::find(8);

        siteSettings();

        View::share([
            'site_settings' =>  $site_settings,
            'project_categories' =>  $project_categories,
            'hq' => $hq,
        ]);

        Paginator::useBootstrap();
    }
}
