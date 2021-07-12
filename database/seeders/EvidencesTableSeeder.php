<?php

namespace Database\Seeders;

use App\Models\Evidence;
use Illuminate\Database\Seeder;

class EvidencesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Evidence::create([
            'description' => 'FÍLMICO'
        ]);
        Evidence::create([
            'description' => 'FOTOGRÁFICO'
        ]);
        Evidence::create([
            'description' => 'OTROS'
        ]);
    }
}
