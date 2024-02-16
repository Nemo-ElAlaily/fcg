<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $values = [];
        $values += [
            'first_name' => 'super',
            'last_name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => '$2y$10$vRmOd8J/L0.526DLX3j0COCYh9CXQsGpIISz/ikmkaRIKzwci8vnO'
        ];

        $new_user = User::create($values);
    }
}
