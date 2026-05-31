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
use Throwable;

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
        Paginator::useBootstrap();

        // Skip DB-backed shared view data for console commands (route:list, config:cache, etc.).
        if ($this->app->runningInConsole()) {
            return;
        }

        try {
        // Cache site-wide settings and navigation data for 24 hours
        $site_settings = Cache::remember(config('cache_keys.site_settings'), config('cache_keys.ttl_minutes'), function () {
            return SiteSettings::find(1);
        });

        if (!$site_settings) {
            $site_settings = new SiteSettings([
                'title' => '',
                'welcome_phrase' => '',
                'address' => '',
                'city' => '',
                'phone' => '',
                'country' => '',
                'meta_title' => '',
                'meta_description' => '',
                'meta_keyword' => '',
                'logo' => 'default.png',
                'favicon' => 'favicon.png',
                'story' => '',
                'mission' => '',
                'vision' => '',
                'story_image' => 'default.png',
                'mission_image' => 'default.png',
                'vision_image' => 'default.png',
                'portfolio_file' => null,
                'google_analytics' => '',
                'google_client_id' => '',
                'google_secret_key' => '',
                'google_redirect' => '',
                'facebook_client_id' => '',
                'facebook_secret_key' => '',
                'facebook_redirect' => '',
            ]);
        }

        $project_categories = Cache::remember(config('cache_keys.project_categories'), config('cache_keys.ttl_minutes'), function () {
            return Category::with(['projects' => function ($query) {
                $query->where('is_active', '1');
            }])->whereHas('projects', function (Builder $query) {
                $query->where('is_active', '1');
            })->where('type', '1')->get();
        });

        $hq = Cache::remember(config('cache_keys.hq_branch'), config('cache_keys.ttl_minutes'), function () {
            return Branch::find(8);
        });

        setSiteSettingsConfig($site_settings);

        View::share([
            'site_settings' =>  $site_settings,
            'project_categories' =>  $project_categories,
            'hq' => $hq,
        ]);
        } catch (Throwable $exception) {
            report($exception);

            $fallbackSiteSettings = new SiteSettings([
                'title' => '',
                'welcome_phrase' => '',
                'address' => '',
                'city' => '',
                'phone' => '',
                'country' => '',
                'meta_title' => '',
                'meta_description' => '',
                'meta_keyword' => '',
                'logo' => 'default.png',
                'favicon' => 'favicon.png',
                'story' => '',
                'mission' => '',
                'vision' => '',
                'story_image' => 'default.png',
                'mission_image' => 'default.png',
                'vision_image' => 'default.png',
                'portfolio_file' => null,
                'google_analytics' => '',
                'google_client_id' => '',
                'google_secret_key' => '',
                'google_redirect' => '',
                'facebook_client_id' => '',
                'facebook_secret_key' => '',
                'facebook_redirect' => '',
            ]);

            setSiteSettingsConfig($fallbackSiteSettings);

            View::share([
                'site_settings' => $fallbackSiteSettings,
                'project_categories' => collect(),
                'hq' => null,
            ]);
        }
    }
}
