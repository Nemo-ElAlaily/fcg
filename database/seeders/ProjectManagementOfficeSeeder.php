<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ProjectManagementOffice;

class ProjectManagementOfficeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pmo = new ProjectManagementOffice();
        $pmo -> title = 'Test pmo';
        $pmo -> is_active = 1;
        $pmo -> slug = 'test_pmo_slug';
        $pmo -> save();
    }
}
