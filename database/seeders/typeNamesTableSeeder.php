<?php

namespace Database\Seeders;

use App\Models\TypeName;
use Illuminate\Database\Seeder;

class typeNamesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TypeName::create([
            'type_name' => 'APELLIDOS Y NOMBRES'
        ]);

        TypeName::create([
            'type_name' => 'RAZÓN SOCIAL'
        ]);
    }
}
