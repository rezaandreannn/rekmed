<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
            'name' => 'admin',
            'deskripsi' => 'semua perizinan'
        ]);

        Role::create([
            'name' => 'pendaftaran',
            'deskripsi' => 'mengelola data pasien yang ingin mendaftar'
        ]);
        Role::create([
            'name' => 'poli',
            'deskripsi' => 'memeriksa pasien yang berkunjung'
        ]);
    }
}
