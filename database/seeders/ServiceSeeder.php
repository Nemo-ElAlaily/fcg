<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Service;


class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $service = new Service();
        $service -> name = 'Test service';
        $service -> description = 'test service description';
        $service -> is_active = 1;
        $service -> slug = 'test_service_slug';
        $service -> save();
        $service2 = new Service();
        $service2 -> name = 'Test service 2';
        $service2 -> description = 'test service description 2';
        $service2 -> is_active = 1;
        $service2 -> slug = 'test_service_slug_2';
        $service2 -> save();
        $service3 = new Service();
        $service3 -> name = 'Test service 3';
        $service3 -> description = 'test service description 3';
        $service3 -> is_active = 1;
        $service3 -> slug = 'test_service_slug_3';
        $service3 -> save();

    }
}
