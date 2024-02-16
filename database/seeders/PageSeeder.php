<?php

namespace Database\Seeders;
use App\Models\Pages\Page;

use Illuminate\Database\Seeder;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $page = new Page();
        $page -> title = 'Test Page';
        $page -> is_active = 1;
        $page -> slug = 'test_page_slug';
        $page -> save();
    }
}
