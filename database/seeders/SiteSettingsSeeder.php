<?php

namespace Database\Seeders;

use App\Models\Settings\SiteSettings;
use Illuminate\Database\Seeder;

class SiteSettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $site_settings = new SiteSettings();
        $site_settings -> title = 'Test title';
        $site_settings -> welcome_phrase = 'test welcome phrase';
        $site_settings -> address = 'Test Address';
        $site_settings -> city = 'test city';
        $site_settings -> country = 'test country';
        $site_settings -> meta_title = 'test Meta title';
        $site_settings -> meta_description = 'test meta description';
        $site_settings -> meta_keyword = 'test meta_keyword';
        $site_settings -> logo = 'default.png';
        $site_settings -> favicon = 'favicon.png';
        $site_settings -> phone = '01XXXXXXXXX';
        $site_settings -> save();
    }
}
