<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category = new Category();
        $category -> name = 'Project category 1';
        $category -> type = 1; // 1 = Projects, 2 = Partners
        $category -> is_active = 1;
        $category -> slug = 'Project_category_1';
        $category -> save();

        $category = new Category();
        $category -> name = 'Partner Category 1';
        $category -> type = 2; // 1 = Projects, 2 = Partners
        $category -> is_active = 1;
        $category -> slug = 'Partner_Category_1';
        $category -> save();
    }
}
