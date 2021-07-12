<?php

namespace Database\Seeders;

use App\Models\Province;
use Illuminate\Database\Seeder;

class ProvincesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Province::create([
            'name_province' => 'CHACHAPOYAS',
            'department_id' => '1'
        ]);
        Province::create([
            'name_province' => 'BAGUA',
            'department_id' => '1'
        ]);
        Province::create([
            'name_province' => 'BONGARÁ',
            'department_id' => '1'
        ]);
        Province::create([
            'name_province' => 'CONDORCANQUI',
            'department_id' => '1'
        ]);
        Province::create([
            'name_province' => 'LUYA',
            'department_id' => '1'
        ]);
        Province::create([
            'name_province' => 'RODRIGUEZ DE MENDOZA',
            'department_id' => '1'
        ]);
        Province::create([
            'name_province' => 'UTCUBAMBA',
            'department_id' => '1'
        ]);
    }
}
