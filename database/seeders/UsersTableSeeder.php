<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Dennis',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('123456789'),
            'role' => 'Administrador',
            'status' => 'Activo',
            'campus_id' => 1
        ]);
    }
}
