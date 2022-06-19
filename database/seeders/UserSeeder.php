<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'role_id' => 1,
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('password')
        ]);
        User::create([
            'role_id' => 2,
            'name' => 'pendaftaran',
            'email' => 'pendaftaran@gmail.com',
            'password' => bcrypt('password')
        ]);
        User::create([
            'role_id' => 3,
            'name' => 'poli',
            'email' => 'poli@gmail.com',
            'password' => bcrypt('password')
        ]);
    }
}
