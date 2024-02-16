<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Certificate;

class CertificateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $certificate = new Certificate();
        $certificate -> name = 'Test Certificate';
        $certificate -> is_active = 1;
        $certificate -> slug = 'test_certificate_slug';
        $certificate -> save();
    }
}
