<?php

namespace Database\Seeders;

use App\Models\Uit;
use Illuminate\Database\Seeder;

class UitTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Uit::create([
            'year' => 1992,
            'amount_uit' => 1040,
            'legal_regulation' => 'D.S. N° 307-91-EF',
            'observations' => 'Durante 1992 estuvo vigente la Unidad de Referencia Tributaria (URT).'
        ]);
        Uit::create([
            'year' => 1993,
            'amount_uit' => 1350,
            'legal_regulation' => 'R.M. N° 370-92-EF/15',
            'observations' => ''
        ]);
        Uit::create([
            'year' => 1993,
            'amount_uit' => 1525,
            'legal_regulation' => 'R.M. N° 125-93-EF/15',
            'observations' => 'Aplicable para la determinación del Impuesto a la Renta de 1993.'
        ]);
        Uit::create([
            'year' => 1993,
            'amount_uit' => 1700,
            'legal_regulation' => 'R.M. N° 125-93-EF/15',
            'observations' => 'Aplicable para retenciones y pagos a cuenta del Impuesto a la Renta.'
        ]);
        Uit::create([
            'year' => 1994,
            'amount_uit' => 1700,
            'legal_regulation' => 'D.S. N° 168-93-EF',
            'observations' => ''
        ]);
        Uit::create([
            'year' => 1995,
            'amount_uit' => 2000,
            'legal_regulation' => 'D.S. N° 178-94-EF',
            'observations' => ''
        ]);
        Uit::create([
            'year' => 1996,
            'amount_uit' => 2000,
            'legal_regulation' => 'D.S. N° 178-94-EF',
            'observations' => 'Para la determinación del Impuesto a la Renta por el ejercicio 1996 se utiliza el promedio anual del valor de la UIT S/.2183.'
        ]);
        Uit::create([
            'year' => 1996,
            'amount_uit' => 2200,
            'legal_regulation' => 'D.S. N° 012-96-EF',
            'observations' => 'Vigente a partir de febrero de 1996'
        ]);
        Uit::create([
            'year' => 1997,
            'amount_uit' => 2400,
            'legal_regulation' => 'D.S. N° 134-96-EF',
            'observations' => ''
        ]);
        Uit::create([
            'year' => 1998,
            'amount_uit' => 2600,
            'legal_regulation' => 'D.S. N° 177-97-EF',
            'observations' => ''
        ]);
        Uit::create([
            'year' => 1999,
            'amount_uit' => 2800,
            'legal_regulation' => 'D.S. N° 123-98-EF',
            'observations' => ''
        ]);
        Uit::create([
            'year' => 2000,
            'amount_uit' => 2900,
            'legal_regulation' => 'D.S. Nº 191-99-EF',
            'observations' => ''
        ]);
        Uit::create([
            'year' => 2001,
            'amount_uit' => 3000,
            'legal_regulation' => 'D.S. Nº 145-2000-EF',
            'observations' => ''
        ]);
        Uit::create([
            'year' => 2002,
            'amount_uit' => 3100,
            'legal_regulation' => 'D.S. N° 241-2001-EF',
            'observations' => ''
        ]);
        Uit::create([
            'year' => 2003,
            'amount_uit' => 3100,
            'legal_regulation' => 'D. S. N° 191-2002-EF',
            'observations' => ''
        ]);
        Uit::create([
            'year' => 2004,
            'amount_uit' => 3200,
            'legal_regulation' => 'D.S. N° 192-2003-EF',
            'observations' => ''
        ]);
        Uit::create([
            'year' => 2005,
            'amount_uit' => 3300,
            'legal_regulation' => 'D.S. N° 177-2004-EF',
            'observations' => ''
        ]);
        Uit::create([
            'year' => 2006,
            'amount_uit' => 3400,
            'legal_regulation' => 'D.S. N° 176-2005-EF',
            'observations' => ''
        ]);
        Uit::create([
            'year' => 2007,
            'amount_uit' => 3450,
            'legal_regulation' => 'D.S. N° 213-2006-EF',
            'observations' => ''
        ]);
        Uit::create([
            'year' => 2008,
            'amount_uit' => 3500,
            'legal_regulation' => 'D.S. N° 209-2007-EF',
            'observations' => ''
        ]);
        Uit::create([
            'year' => 2009,
            'amount_uit' => 3550,
            'legal_regulation' => 'D.S. N° 169-2008-EF',
            'observations' => ''
        ]);
        Uit::create([
            'year' => 2010,
            'amount_uit' => 3600,
            'legal_regulation' => 'D.S. N° 311-2009-EF',
            'observations' => ''
        ]);

        Uit::create([
            'year' => 2011,
            'amount_uit' => 3600,
            'legal_regulation' => 'D.S. N° 252-2010-EF',
            'observations' => ''
        ]);
        Uit::create([
            'year' => 2012,
            'amount_uit' => 3650,
            'legal_regulation' => 'D.S. N° 233-2011-EF',
            'observations' => ''
        ]);
        Uit::create([
            'year' => 2013,
            'amount_uit' => 3700,
            'legal_regulation' => 'D.S. N° 264-2012-E',
            'observations' => ''
        ]);
        Uit::create([
            'year' => 2014,
            'amount_uit' => 3800,
            'legal_regulation' => 'D.S. N° 304-2013-EF',
            'observations' => ''
        ]);
        Uit::create([
            'year' => 2015,
            'amount_uit' => 3850,
            'legal_regulation' => 'D.S. N° 374-2014-EF',
            'observations' => ''
        ]);
        Uit::create([
            'year' => 2016,
            'amount_uit' => 3950,
            'legal_regulation' => 'D.S. N° 397-2015-EF',
            'observations' => ''
        ]);
        Uit::create([
            'year' => 2017,
            'amount_uit' => 4050,
            'legal_regulation' => 'D.S. N° 353-2016-EF',
            'observations' => ''
        ]);
        Uit::create([
            'year' => 2018,
            'amount_uit' => 4150,
            'legal_regulation' => 'D.S. N° 380-2017-EF',
            'observations' => ''
        ]);
        Uit::create([
            'year' => 2019,
            'amount_uit' => 4200,
            'legal_regulation' => 'D.S. N° 298-2018-EF',
            'observations' => ''
        ]);
        Uit::create([
            'year' => 2020,
            'amount_uit' => 4300,
            'legal_regulation' => 'D.S. N° 380-2019-EF',
            'observations' => ''
        ]);
        Uit::create([
            'year' => 2021,
            'amount_uit' => 4400,
            'legal_regulation' => 'D.S. N° 392-2020-EF',
            'observations' => ''
        ]);

    }
}
