<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Branch;


class BranchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $branch = new Branch();
        $branch -> name = 'Test branch';
        $branch -> phone_no = '010XXXXXXXX';
        $branch -> is_active = 1;
        $branch -> slug = 'test_branch_slug';
        $branch -> save();
    }
}
