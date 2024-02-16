<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UsersSeeder::class,
            SiteSettingsSeeder::class,
            ServiceSeeder::class,
            BranchSeeder::class,
            CategorySeeder::class,
            CertificateSeeder::class,
            ClientSeeder::class,
            PageSeeder::class,
            PartnerSeeder::class,
            ProjectManagementOfficeSeeder::class,
            ProjectSeeder::class,
        ]);
    }
}
