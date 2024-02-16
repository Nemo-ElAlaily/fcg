<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Partner;

class PartnerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $partner = new Partner();
        $partner -> name = 'Test Partner';
        $partner -> category_id = 2;
        $partner -> is_active = 1;
        $partner -> slug = 'test_partner_slug';
        $partner -> save();
    }
}
