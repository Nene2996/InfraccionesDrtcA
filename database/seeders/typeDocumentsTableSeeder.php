<?php

namespace Database\Seeders;

use App\Models\TypeDocument;
use Illuminate\Database\Seeder;

class typeDocumentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TypeDocument::create([
            'type_document' => 'DNI'
        ]);

        TypeDocument::create([
            'type_document' => 'RUC'
        ]);
    }
}
