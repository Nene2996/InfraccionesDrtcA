<?php

namespace Database\Seeders;

use App\Models\Inspector;
use Illuminate\Database\Seeder;

class InspectorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Inspector::create([
            'surnames_and_names' => 'CARLOS ALBERTO SANCHEZ MUÑOZ',
            'dni' => '33408395',
            'status' => 1
        ]);

        Inspector::create([
            'surnames_and_names' => 'CECILIA M. REYNA VILCA',
            'dni' => '42966912',
            'status' => 0
        ]);

        Inspector::create([
            'surnames_and_names' => 'CLAUDIA M. IPANAQUE DE LA CRUZ',
            'dni' => '44980244',
            'status' => 0
        ]);

        Inspector::create([
            'surnames_and_names' => 'EDITH GONZALES ESQUEN',
            'dni' => '72353683',
            'status' => 0
        ]);

        Inspector::create([
            'surnames_and_names' => 'EDWAR J. CHAUCA VILLACREZ',
            'dni' => '40392832',
            'status' => 0
        ]);

        Inspector::create([
            'surnames_and_names' => 'ELIAS M. ESPINO VELIZ',
            'dni' => '06793133',
            'status' => 0
        ]);

        Inspector::create([
            'surnames_and_names' => 'ELVIS H. CHAVEZ ALVA',
            'dni' => '42236854',
            'status' => 0
        ]);

        Inspector::create([
            'surnames_and_names' => 'HENRRY AUGUSTO GUERRERO AGUILAR',
            'dni' => '46900309',
            'status' => 0
        ]);

        Inspector::create([
            'surnames_and_names' => 'ISAC TAFUR ZAGACETA',
            'dni' => '45351971',
            'status' => 0
        ]);

        Inspector::create([
            'surnames_and_names' => 'JADY LAPIZ GASLAC',
            'dni' => '42931427',
            'status' => 0
        ]);

        Inspector::create([
            'surnames_and_names' => 'JAIRO ANTONY ESPINAL CRUZ',
            'dni' => '73479032',
            'status' => 1
        ]);

        Inspector::create([
            'surnames_and_names' => 'JORGE LUIS SALAZAR MELENDEZ',
            'dni' => '42839186',
            'status' => 0
        ]);

        Inspector::create([
            'surnames_and_names' => 'JOSE DELGADO DIAZ',
            'dni' => '00000000',
            'status' => 0
        ]);

        Inspector::create([
            'surnames_and_names' => 'LIZ KAROL ALVARADO VILLARINO',
            'dni' => '73895351',
            'status' => 0
        ]);

        Inspector::create([
            'surnames_and_names' => 'LUIS ANTONIO CERNA CASTRO',
            'dni' => '70030074',
            'status' => 0
        ]);

        Inspector::create([
            'surnames_and_names' => 'MAXIMO MALQUI VILCARROMERO',
            'dni' => '72660120',
            'status' => 0
        ]);

        Inspector::create([
            'surnames_and_names' => 'RAFAEL SANTISTEBAN SUCLUPE',
            'dni' => '44640428',
            'status' => 0
        ]);

        Inspector::create([
            'surnames_and_names' => 'ROBERTO CARLOS ROJAS GOMEZ',
            'dni' => '00000000',
            'status' => 0
        ]);

        Inspector::create([
            'surnames_and_names' => 'IVAN PÉREZ GAONA',
            'dni' => '33560517',
            'status' => 0
        ]);

        Inspector::create([
            'surnames_and_names' => 'NUÑEZ PERALTA SEGUNDO ANTONIO',
            'dni' => '33569256',
            'status' => 0
        ]);
    }
}
