<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Client;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $client = new Client();
        $client -> name = 'Test Client';
        $client -> is_active = 1;
        $client -> slug = 'test_client_slug';
        $client -> save();
    }
}
