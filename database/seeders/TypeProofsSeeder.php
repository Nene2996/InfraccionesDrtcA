<?php

namespace Database\Seeders;

use App\Models\TypeProof;
use Illuminate\Database\Seeder;

class TypeProofsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TypeProof::create([
            'type' => 'BOLETA DE VENTA'
        ]);

        TypeProof::create([
            'type' => 'VAUCHER DEL BANCO DE LA NACION'
        ]);

        TypeProof::create([
            'type' => 'VAUCHER DE AGENTE MULTIRED'
        ]);
    }
}
