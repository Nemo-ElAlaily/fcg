<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Project;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $project = new Project();
        $project -> title = 'Test project';
        $project -> category_id = 1;
        $project -> client_id = 1;
        $project -> is_active = 0;
        $project -> is_awarded = 0;
        $project -> add_to_home = 1;
        $project -> gallery = '["5ymL81RtiHRhxOpDJOi80dr0JhZNEldDw1yWK8Cg.jpg","5ZJAT7WY5y7rItaVaZI5n1OLFKtUJ0TUGKy9fuav.jpg"]';
        $project -> slug = 'test_project_slug';
        $project -> save();
        $project->services()->attach('1');
    }
}
