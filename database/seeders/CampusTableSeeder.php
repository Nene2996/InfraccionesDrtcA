<?php

namespace Database\Seeders;

use App\Models\Campus;
use Illuminate\Database\Seeder;

class CampusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Campus::create([
            'campus_name' => 'DIRECCIÓN REGIONAL DE TRANSPORTES Y COMUNICACIONES - AMAZONAS',
            'alias' => 'Chachapoyas'
        ]);

        Campus::create([
            'campus_name' => 'DIRECCIÓN SUB REGIONAL DE TRANSPORTES Y COMUNICACIONES BAGUA-UTCUBAMBA-CONDORANQUI',
            'alias' => 'Bagua'
        ]);
    }
}
