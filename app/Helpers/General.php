<?php

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;
use App\Models\Settings\SiteSettings;

function uploadImage($folder, $image)
{
    $file_name = $image -> hashName();
    $image->move(public_path($folder) , $file_name );
    return $file_name;
}

function siteSettings(){
    $site_settings = Cache::remember('site_settings', 1440, function () {
        return SiteSettings::find(1);
    });

    Config::set('services.facebook.client_id', $site_settings->facebook_client_id);
    Config::set('services.facebook.client_secret', $site_settings->facebook_secret_key);
    Config::set('services.facebook.redirect', $site_settings->facebook_redirect);

    Config::set('services.google.client_id', $site_settings->google_client_id);
    Config::set('services.google.client_secret', $site_settings->google_secret_key);
    Config::set('services.google.redirect', $site_settings->google_redirect);
}

function characters(){
    return array(' ', '/', '!', '\\');
}
