<?php

namespace Database\Seeders;

use App\Models\Infraction;
use Illuminate\Database\Seeder;

class InfractionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Infraction::create([
            'description' => 'Prestar el servicio de transporte de personas, de mercancias o mixto, sin contar con autorización otorgada por la autoridad competente o una modalidad o ámbito diferente al autorizado.',
            'code' => 'F.1',
            'infringement_agent' => 'Quien realiza la actividad de transporte',
            'uit_penalty' => 'Multa de 1 UIT',
            'pecuniary_sanction' => 4400,
            'administrative_sanction' => 'No Aplica',
            'discount_five_days' => 0,
            'discount_fifteen_days' => 0,
        ]);

        Infraction::create([
            'description' => 'INFRACCIONDEL TRANSPORTISTA: Permitir lautilización outilizar, intencionalmente, los vehículos destinados a la prestación del servicio, en acciones de bloqueo,interrupción u otras que impidan el libre tránsito por las calles,carreteras,puentes, vías férreas y otras vías públicas terrestres.',
            'code' => 'F.2',
            'infringement_agent' => 'Transportista',
            'uit_penalty' => 'No aplica',
            'pecuniary_sanction' => 0,
            'administrative_sanction' => 'Inhabilitación por un (1) año para prestar el servicio de transporte',
            'discount_five_days' => 0,
            'discount_fifteen_days' => 0,
        ]);

        Infraction::create([
            'description' => 'INFRACCION DEL CONDUCTOR: Participar como conductor de vehículos que sean utilizados en acciones de bloqueo, interrupción u otras que impidan el libre transito por las calles, carreteras, puentes, vías férreas y otras vías públicas terrestres.',
            'code' => 'F.3',
            'infringement_agent' => 'Conductor',
            'uit_penalty' => 'No aplica',
            'pecuniary_sanction' => 0,
            'administrative_sanction' => 'Suspensión por noventa (90) días de la habilitación para conducir vehículos del servicio de transporte',
            'discount_five_days' => 0,
            'discount_fifteen_days' => 0,
        ]);

        Infraction::create([
            'description' => 'INFRACCION DEL TRANSPORTISTA: Obstruir la labor de fiscalización en cualesquiera de los siguientes casos: a) Negarse a entregar la información o documentación correspondiente al vehículo, a su habilitación como conductor, al servicio que presta o actividad de transporte que realiza, al ser requerido para ello.',
            'code' => 'F.4.a',
            'infringement_agent' => 'Transportista',
            'uit_penalty' => 'No aplica',
            'pecuniary_sanction' => 0,
            'administrative_sanction' => 'Suspensión por noventa (90) días de la autorización para prestar servicio en la ruta o rutas en que ocurrió la infracción; o en el servicio tratándose del transporte de mercancías',
            'discount_five_days' => 0,
            'discount_fifteen_days' => 0,
        ]);

        Infraction::create([
            'description' => 'INFRACCION DEL TRANSPORTISTA: Obstruir la labor de fiscalización en cualesquiera de los siguientes casos: b) Brindar intencionalmente información no conforme, a la autoridad competente, durante la fiscalización con el propósito de hacerla incurrir en error respecto de la autorización para prestar el servicio, de la habilitación del vehículo o la del conductor.',
            'code' => 'F.4.b',
            'infringement_agent' => 'Transportista',
            'uit_penalty' => 'No aplica',
            'pecuniary_sanction' => 0,
            'administrative_sanction' => 'Suspensión por noventa (90) días de la autorización para prestar servicio en la ruta o rutas en que ocurrió la infracción; o en el servicio tratándose del transporte de mercancías',
            'discount_five_days' => 0,
            'discount_fifteen_days' => 0,
        ]);

        Infraction::create([
            'description' => 'INFRACCION DEL TRANSPORTISTA: Obstruir la labor de fiscalización en cualesquiera de los siguientes casos: c) Incurrir en actos de simulación, suplantación u otras conductas destinadas a hacer incurrir en error a la autoridad competente respecto de la\nautorización para prestar el servicio, o respecto de la habilitación del vehículo o la del conductor.',
            'code' => 'F.4.c',
            'infringement_agent' => 'Transportista',
            'uit_penalty' => 'No aplica',
            'pecuniary_sanction' => 0,
            'administrative_sanction' => 'Suspensión por noventa (90) días de la autorización para prestar servicio en la ruta o rutas en que ocurrió la infracción; o en el servicio tratándose del transporte de mercancías',
            'discount_five_days' => 0,
            'discount_fifteen_days' => 0,
        ]);

        # 7
        Infraction::create([
            'description' => 'INFRACCION DEL GENERADOR DE CARGA: Obstruir la labor de fiscalización en cualesquiera de los siguientes casos: a) Negarse a entregar la información o documentación correspondiente al vehículo, a su habilitación como conductor, al servicio que presta o actividad de transporte que realiza, al ser requerido para ello.',
            'code' => 'F.5.a',
            'infringement_agent' => 'Generador de Carga',
            'uit_penalty' => 'Multa de 0.5 de la UIT',
            'pecuniary_sanction' => 2200,
            'administrative_sanction' => 'No aplica',
            'discount_five_days' => 0,
            'discount_fifteen_days' => 0,
        ]);

        # 8
        Infraction::create([
            'description' => 'INFRACCION DEL GENERADOR DE CARGA: Obstruir la labor de fiscalización en cualesquiera de los siguientes casos: b) Brindar intencionalmente información no conforme, a la autoridad competente, durante la fiscalización con el propósito de hacerla incurrir en error respecto de la autorización para prestar el servicio, de la habilitación del vehículo o la del conductor.',
            'code' => 'F.5.b',
            'infringement_agent' => 'Generador de Carga',
            'uit_penalty' => 'Multa de 0.5 de la UIT',
            'pecuniary_sanction' => 2200,
            'administrative_sanction' => 'No aplica',
            'discount_five_days' => 0,
            'discount_fifteen_days' => 0,
        ]);

        # 9
        Infraction::create([
            'description' => 'INFRACCION DEL GENERADOR DE CARGA: Obstruir la labor de fiscalización en cualesquiera de los siguientes casos: c) Incurrir en actos de simulación, suplantación u otras conductas destinadas a hacer incurrir en error a la autoridad competente respecto de la\nautorización para prestar el servicio, o respecto de la habilitación del vehículo o la del conductor.',
            'code' => 'F.5.c',
            'infringement_agent' => 'Generador de Carga',
            'uit_penalty' => 'Multa de 0.5 de la UIT',
            'pecuniary_sanction' => 2200,
            'administrative_sanction' => 'No aplica',
            'discount_five_days' => 0,
            'discount_fifteen_days' => 0,
        ]);

        # 10
        Infraction::create([
            'description' => 'INFRACCION DEL CONDUCTOR:\n\nObstruir la labor de fiscalización en cualesquiera de los casos: a) Negarse a entregar la información o documentación correspondiente al vehículo, a su habilitación como conductor, al servicio que presta o actividad de transporte que realiza, al ser requerido para ello.',
            'code' => 'F.6.a',
            'infringement_agent' => 'Conductor',
            'uit_penalty' => 'Multa de 0.5 de la UIT',
            'pecuniary_sanction' => 2200,
            'administrative_sanction' => 'Suspención de la licencia de conducir por (90) días calendario',
            'discount_five_days' => 1100,
            'discount_fifteen_days' => 1470,
        ]);

        # 11
        Infraction::create([
            'description' => 'INFRACCION DEL CONDUCTOR: Obstruir la labor de fiscalización en cualesquiera de los casos: b) Brindar información no conforme, a la autoridad competente, durante la fiscalización con el proposito de hacerla incurrir en error respecto de la autorización para prestar el servicio, de la habilitación del vehículo o la del conductor.',
            'code' => 'F.6.b',
            'infringement_agent' => 'Conductor',
            'uit_penalty' => 'Multa de 0.5 de la UIT',
            'pecuniary_sanction' => 2200,
            'administrative_sanction' => 'Suspención de la licencia de conducir por (90) días calendario',
            'discount_five_days' => 1100,
            'discount_fifteen_days' => 1470,
        ]);

        # 12
        Infraction::create([
            'description' => 'INFRACCION DEL CONDUCTOR: Obstruir la labor de fiscalización en cualesquiera de los casos: c) Realizar maniobras evasivas con el vehículo para evitar la fiscalización.',
            'code' => 'F.6.c',
            'infringement_agent' => 'Conductor',
            'uit_penalty' => 'Multa de 0.5 de la UIT',
            'pecuniary_sanction' => 2200,
            'administrative_sanction' => 'Suspención de la licencia de conducir por (90) días calendario',
            'discount_five_days' => 1100,
            'discount_fifteen_days' => 1470,
        ]);

        # 13
        Infraction::create([
            'description' => 'INFRACCION DEL CONDUCTOR: Obstruir la labor de fiscalización en cualesquiera de los casos: d) Incurrir en actos de simulación, suplantación u otras conductas destinadas a hacer incurrir en error a la autoridad competente respecto de la autorización para prestar el servicio, o respecto de la habilitación del vehículo o la del conductor.',
            'code' => 'F.6.d',
            'infringement_agent' => 'Conductor',
            'uit_penalty' => 'Multa de 0.5 de la UIT',
            'pecuniary_sanction' => 2200,
            'administrative_sanction' => 'Suspención de la licencia de conducir por (90) días calendario',
            'discount_five_days' => 1100,
            'discount_fifteen_days' => 1470,
        ]);

        # 14
        Infraction::create([
            'description' => 'INFRACCIÓN DEL CONDUCTOR: Atentar contra la integridad física del inspector durante la realización de sus funciones.',
            'code' => 'F.7',
            'infringement_agent' => 'Conductor',
            'uit_penalty' => 'Multa de 0.5 de la UIT',
            'pecuniary_sanction' => 2200,
            'administrative_sanction' => 'Cancelación de la Licencia de Conducir e inhabilitación definitiva para obtener nueva licencia',
            'discount_five_days' => 1100,
            'discount_fifteen_days' => 1470,
        ]);

        # 15
        Infraction::create([
            'description' => 'INFRACCIÓN DEL TRANSPORTISTA: Presta el servicio circulando, interrumpiendo y/o impidiendo el tránsito, en situaciones de desastre natural o emergencia, incumpliendo las disposiciones que establezca la autoridad competente para la restricción de acceso a las vías',
            'code' => 'F.8',
            'infringement_agent' => 'Conductor',
            'uit_penalty' => 'No Aplica',
            'pecuniary_sanction' => 0,
            'administrative_sanction' => 'Inhabilitación por dos años del vehículo para ser utilizado en la prestación del servicio de transporte terrestre. Para el caso del conductor aplicará lo dispuesto en el Código M.41 del Anexo I del Reglamento Nacional de Tránsito- Código de Tránsito.',
            'discount_five_days' => 0,
            'discount_fifteen_days' => 0,
        ]);

        # 16
        Infraction::create([
            'description' => 'INFRACCION DEL CONDUCTOR: No portar durante la prestación del servicio de transporte, según corresponda: a) El manifiesto de usuarios o el de pasajeros, en el transporte de personas, cuando éstos no sean electrónicos.',
            'code' => 'I.1.a',
            'infringement_agent' => 'Conductor',
            'uit_penalty' => 'Multa de 0.1 de la UIT',
            'pecuniary_sanction' => 440,
            'administrative_sanction' => 'No aplica',
            'discount_five_days' => 220,
            'discount_fifteen_days' => 294,
        ]);

        # 17
        Infraction::create([
            'description' => 'INFRACCION DEL CONDUCTOR: No portar durante la prestación del servicio de transporte, según corresponda: b) La hoja de ruta manual o electrónica, según corresponda.',
            'code' => 'I.1.b',
            'infringement_agent' => 'Conductor',
            'uit_penalty' => 'Multa de 0.1 de la UIT',
            'pecuniary_sanction' => 440,
            'administrative_sanction' => 'No aplica',
            'discount_five_days' => 220,
            'discount_fifteen_days' => 294,
        ]);

        # 18
        Infraction::create([
            'description' => 'INFRACCION DEL CONDUCTOR: No portar durante la prestación del servicio de transporte, según corresponda: c) En el servicio de transporte de mercancías, la guía de remisión del transportista y, de ser el caso, el manifiesto de carga.',
            'code' => 'I.1.c',
            'infringement_agent' => 'Conductor',
            'uit_penalty' => 'Multa de 0.1 de la UIT',
            'pecuniary_sanction' => 440,
            'administrative_sanction' => 'No aplica',
            'discount_five_days' => 220,
            'discount_fifteen_days' => 294,
        ]);

        # 19
        Infraction::create([
            'description' => 'INFRACCION DEL CONDUCTOR: No portar durante la prestación del servicio de transporte, según corresponda: d) El documento de habilitación del vehículo.',
            'code' => 'I.1.d',
            'infringement_agent' => 'Conductor',
            'uit_penalty' => 'Multa de 0.1 de la UIT',
            'pecuniary_sanction' => 440,
            'administrative_sanction' => 'No aplica',
            'discount_five_days' => 220,
            'discount_fifteen_days' => 294,
        ]);

        # 20
        Infraction::create([
            'description' => 'INFRACCION DEL CONDUCTOR: No portar durante la prestación del servicio de transporte, según corresponda: e) El Certificado de ITV.',
            'code' => 'I.1.e',
            'infringement_agent' => 'Conductor',
            'uit_penalty' => 'Multa de 0.1 de la UIT',
            'pecuniary_sanction' => 440,
            'administrative_sanction' => 'No aplica',
            'discount_five_days' => 220,
            'discount_fifteen_days' => 294,
        ]);

        # 21
        Infraction::create([
            'description' => 'INFRACCION DEL CONDUCTOR: No portar durante la prestación del servicio de transporte, según corresponda: f) El Certificado del Seguro Obligatorio de Accidente de Tránsito o CAT cuando corresponda.',
            'code' => 'I.1.f',
            'infringement_agent' => 'Conductor',
            'uit_penalty' => 'Multa de 0.1 de la UIT',
            'pecuniary_sanction' => 440,
            'administrative_sanction' => 'No aplica',
            'discount_five_days' => 220,
            'discount_fifteen_days' => 294,
        ]);

        # 22
        Infraction::create([
            'description' => 'INFRACCION DEL TRANSPORTISTA: a) No exhibir en cada vehículo habilitado al servicio de transporte público de personas, la modalidad del servicio, según corresponda, la razón social y el nombre comercial si lo tuviera.',
            'code' => 'I.2.a',
            'infringement_agent' => 'Transportista',
            'uit_penalty' => 'Multa de 0.1 de la UIT',
            'pecuniary_sanction' => 440,
            'administrative_sanction' => 'No aplica',
            'discount_five_days' => 220,
            'discount_fifteen_days' => 294,
        ]);

        # 23
        Infraction::create([
            'description' => 'INFRACCION DEL TRANSPORTISTA: b) En el servicio de transporte provincial de personas, no colocar en lugar visible para el usuario, la información sobre las tarifas vigentes y la ruta autorizada.',
            'code' => 'I.2.b',
            'infringement_agent' => 'Transportista',
            'uit_penalty' => 'Multa de 0.1 de la UIT',
            'pecuniary_sanction' => 440,
            'administrative_sanction' => 'No aplica',
            'discount_five_days' => 220,
            'discount_fifteen_days' => 294,
        ]);

        # 24
        Infraction::create([
            'description' => 'INFRACCION DEL TRANSPORTISTA: a) Realizar enmendaduras o anotaciones que modifiquen o invaliden la información contenida en la hoja de ruta o el manifiesto de usuarios o de pasajeros, con el propósito de hacer incurrir en error a la autoridad.',
            'code' => 'I.3.a',
            'infringement_agent' => 'Transportista',
            'uit_penalty' => 'Multa de 0.5 de la UIT',
            'pecuniary_sanction' => 2200,
            'administrative_sanction' => 'No aplica',
            'discount_five_days' => 0,
            'discount_fifteen_days' => 0,
        ]);

        # 25
        Infraction::create([
            'description' => 'INFRACCION DEL TRANSPORTISTA: b) No cumplir con llenar la información necesaria en la hoja de ruta o el manifiesto de usuarios o de pasajeros, cuando corresponda, conforme a lo establecido en el presente Reglamento y normas complementarias.',
            'code' => 'I.3.b',
            'infringement_agent' => 'Transportista',
            'uit_penalty' => 'Multa de 0.5 de la UIT',
            'pecuniary_sanction' => 2200,
            'administrative_sanction' => 'No aplica',
            'discount_five_days' => 2100,
            'discount_fifteen_days' => 1470,
        ]);

        # 26
        Infraction::create([
            'description' => 'INFRACCION DEL TRANSPORTISTA: c) Prestar el servicio de transporte especial de personas en la modalidad de transporte turístico, sin tener o no contener la información requerida en la hoja de ruta por el presente Reglamento.',
            'code' => 'I.3.c',
            'infringement_agent' => 'Transportista',
            'uit_penalty' => 'Multa de 0.5 de la UIT',
            'pecuniary_sanction' => 2200,
            'administrative_sanction' => 'No aplica',
            'discount_five_days' => 2100,
            'discount_fifteen_days' => 1470,
        ]);

        # 27
        Infraction::create([
            'description' => 'INFRACCION DEL TRANSPORTISTA: d) No tener o no llenar la información de los usuarios en el servicio de transporte turístico.',
            'code' => 'I.3.d',
            'infringement_agent' => 'Transportista',
            'uit_penalty' => 'Multa de 0.5 de la UIT',
            'pecuniary_sanction' => 2200,
            'administrative_sanction' => 'No aplica',
            'discount_five_days' => 2100,
            'discount_fifteen_days' => 1470,
        ]);

        # 28
        Infraction::create([
            'description' => 'INFRACCION DEL TRANSPORTISTA: No proporcionar instrucciones al conductor respecto de las obligaciones que deben ser observadas durante la prestación del servicio de transporte.',
            'code' => 'I.4',
            'infringement_agent' => 'Transportista',
            'uit_penalty' => 'Multa de 0.05 de la UIT',
            'pecuniary_sanction' => 220,
            'administrative_sanction' => 'No aplica',
            'discount_five_days' => 110,
            'discount_fifteen_days' => 66,
        ]);

        # 29
        Infraction::create([
            'description' => 'INFRACCION DEL GENERADOR DE CARGA: a) No entregar al transportista autorizado las mercancías debidamente rotuladas y embaladas, encajonadas, enfardadas, en barricas o en contenedores, conforme a las exigencias de su naturaleza, con excepción de las cargas líquidas y a granel.',
            'code' => 'I.5.a',
            'infringement_agent' => 'Generador de Carga',
            'uit_penalty' => 'Multa de 0.1 de la UIT',
            'pecuniary_sanction' => 440,
            'administrative_sanction' => 'No aplica',
            'discount_five_days' => 220,
            'discount_fifteen_days' => 132,
        ]);

        # 30
        Infraction::create([
            'description' => 'INFRACCION DEL GENERADOR DE CARGA: b) No identificar al destinatario e indicar el domicilio de éste.',
            'code' => 'I.5.b',
            'infringement_agent' => 'Generador de Carga',
            'uit_penalty' => 'Multa de 0.1 de la UIT',
            'pecuniary_sanction' => 440,
            'administrative_sanction' => 'No aplica',
            'discount_five_days' => 220,
            'discount_fifteen_days' => 132,
        ]);

        # 31
        Infraction::create([
            'description' => 'INFRACCION DEL GENERADOR DE CARGA: c) No declarar verazmente, en los documentos del transporte, la identificación y contenido de las mercancías embaladas, encajonadas, enfardadas, en barricas o en contenedores y, de ser el caso, las condiciones para su manejo, así como toda otra información de su responsabilidad que deba constar en los indicados documentos.',
            'code' => 'I.5.c',
            'infringement_agent' => 'Generador de Carga',
            'uit_penalty' => 'Multa de 0.1 de la UIT',
            'pecuniary_sanction' => 440,
            'administrative_sanction' => 'No aplica',
            'discount_five_days' => 220,
            'discount_fifteen_days' => 132,
        ]);

        # 32
        Infraction::create([
            'description' => 'INFRACCION DEL TRANSPORTISTA: En el servicio de transporte de personas, no exhibir en lugar visible del salón del vehículo un cartel o aviso, legible para los usuarios, que contenga la información prevista en el presente Reglamento.',
            'code' => 'I.6',
            'infringement_agent' => 'Transportista',
            'uit_penalty' => 'Multa de 0.05 de la UIT',
            'pecuniary_sanction' => 220,
            'administrative_sanction' => 'No aplica',
            'discount_five_days' => 110,
            'discount_fifteen_days' => 66,
        ]);

        # 33
        Infraction::create([
            'description' => 'INFRACCION DEL CONDUCTOR: a) Impedir que la autoridad competente la Policía Nacional del Perú deje alguna constancia en la hoja de ruta.',
            'code' => 'I.7.a',
            'infringement_agent' => 'Conductor',
            'uit_penalty' => 'Multa de 0.1 de la UIT',
            'pecuniary_sanction' => 440,
            'administrative_sanction' => 'No aplica',
            'discount_five_days' => 220,
            'discount_fifteen_days' => 132
        ]);

        # 34
        Infraction::create([
            'description' => 'INFRACCION DEL CONDUCTOR: b) Realizar enmendaduras o anotaciones que modifiquen o invaliden la información contenida en la hoja de ruta o el manifiesto de usuarios o de pasajeros, con el propósito de hacer incurrir en error a la autoridad.',
            'code' => 'I.7.b',
            'infringement_agent' => 'Conductor',
            'uit_penalty' => 'Multa de 0.1 de la UIT',
            'pecuniary_sanction' => 440,
            'administrative_sanction' => 'No aplica',
            'discount_five_days' => 220,
            'discount_fifteen_days' => 132
        ]);

        # 35
        Infraction::create([
            'description' => 'INFRACCION DEL CONDUCTOR: c) No cumplir con llenar la información necesaria en la hoja de ruta o el manifiesto de usuarios o de pasajeros, cuando corresponda, conforme a lo establecido en el presente Reglamento y las normas complementarias.',
            'code' => 'I.7.c',
            'infringement_agent' => 'Conductor',
            'uit_penalty' => 'Multa de 0.1 de la UIT',
            'pecuniary_sanction' => 440,
            'administrative_sanction' => 'No aplica',
            'discount_five_days' => 220,
            'discount_fifteen_days' => 132
        ]);

        # 36
        Infraction::create([
            'description' => 'INFRACCION DEL CONDUCTOR: d) No comunicar a la empresa, la relación de los usuarios que se embarquen en terminales terrestres y/o estaciones de ruta.',
            'code' => 'I.7.d',
            'infringement_agent' => 'Conductor',
            'uit_penalty' => 'Multa de 0.1 de la UIT',
            'pecuniary_sanction' => 440,
            'administrative_sanction' => 'No aplica',
            'discount_five_days' => 220,
            'discount_fifteen_days' => 132
        ]);

        # 37
        Infraction::create([
            'description' => 'INFRACCIÓN DEL TRANSPORTISTA: No informar por escrito a la autoridad competente, dentro de las cuarenta y ocho (48) horas de producidos, los accidentes de tránsito con daños personales ocurridos durante la operación del servicio.',
            'code' => 'I.8',
            'infringement_agent' => 'Transportista',
            'uit_penalty' => 'Multa de 0.5 de la UIT',
            'pecuniary_sanction' => 2200,
            'administrative_sanction' => 'No aplica',
            'discount_five_days' => 1100,
            'discount_fifteen_days' => 660
        ]);

        # 38
        Infraction::create([
            'description' => 'INFRACCIÓN DEL TRANSPORTISTA: a)Que la tripulación, antes de iniciar el servicio, no brinde información conforme a lo señalado en el numeral 42.1.14 del artículo 42 del presente reglamento.',
            'code' => 'I.9.a',
            'infringement_agent' => 'Transportista',
            'uit_penalty' => 'Multa de 0.1 de la UIT',
            'pecuniary_sanction' => 440,
            'administrative_sanction' => 'No aplica',
            'discount_five_days' => 220,
            'discount_fifteen_days' => 132
        ]);

        # 39
        Infraction::create([
            'description' => 'INFRACCION DEL TRANSPORTISTA: Utilizar conductores que: a) No tenga(n) licencia de conducir.',
            'code' => 'S.1.a',
            'infringement_agent' => 'Transportista',
            'uit_penalty' => 'Multa de 0.5 de la UIT',
            'pecuniary_sanction' => 2200,
            'administrative_sanction' => 'No aplica',
            'discount_five_days' => 0,
            'discount_fifteen_days' => 0
        ]);

        # 40
        Infraction::create([
            'description' => 'INFRACCION DEL TRANSPORTISTA: Utilizar conductores que: b) Cuya licencia no se encuentra vigente.',
            'code' => 'S.1.b',
            'infringement_agent' => 'Transportista',
            'uit_penalty' => 'Multa de 0.5 de la UIT',
            'pecuniary_sanction' => 2200,
            'administrative_sanction' => 'No aplica',
            'discount_five_days' => 0,
            'discount_fifteen_days' => 0
        ]);

        # 41
        Infraction::create([
            'description' => 'INFRACCION DEL TRANSPORTISTA: Utilizar conductores que: c) Cuya licencia de conducir no corresponde a la clase y categoría requerida por las características del vehículo y del servicio a prestar.',
            'code' => 'S.1.c',
            'infringement_agent' => 'Transportista',
            'uit_penalty' => 'Multa de 0.5 de la UIT',
            'pecuniary_sanction' => 2200,
            'administrative_sanction' => 'No aplica',
            'discount_five_days' => 0,
            'discount_fifteen_days' => 0
        ]);

        # 42
        Infraction::create([
            'description' => 'INFRACCION DEL TRANSPORTISTA: Utilizar vehículos que no cuenten con alguno o cualquiera de los elementos de seguridad y emergencia, siguientes: a) Extintores de fuego de conformidad con lo establecido en el Reglamento.',
            'code' => 'S.2.a',
            'infringement_agent' => 'Transportista',
            'uit_penalty' => 'Multa de 0.05 de la UIT',
            'pecuniary_sanction' => 220,
            'administrative_sanction' => 'No aplica',
            'discount_five_days' => 110,
            'discount_fifteen_days' => 66
        ]);

        # 43
        Infraction::create([
            'description' => 'INFRACCION DEL TRANSPORTISTA: Utilizar vehículos que no cuenten con alguno o cualquiera de los elementos de seguridad y emergencia, siguientes: b) Conos o triángulos de seguridad.',
            'code' => 'S.2.b',
            'infringement_agent' => 'Transportista',
            'uit_penalty' => 'Multa de 0.05 de la UIT',
            'pecuniary_sanction' => 220,
            'administrative_sanction' => 'No aplica',
            'discount_five_days' => 110,
            'discount_fifteen_days' => 66
        ]);

        # 44
        Infraction::create([
            'description' => 'INFRACCION DEL TRANSPORTISTA: Utilizar vehículos que no cuenten con alguno o cualquiera de los elementos de seguridad y emergencia, siguientes: c) Botiquín equipado para brindar primeros auxilios.',
            'code' => 'S.2.c',
            'infringement_agent' => 'Transportista',
            'uit_penalty' => 'Multa de 0.05 de la UIT',
            'pecuniary_sanction' => 220,
            'administrative_sanction' => 'No aplica',
            'discount_five_days' => 110,
            'discount_fifteen_days' => 66
        ]);

        # 45
        Infraction::create([
            'description' => 'INFRACCION DEL TRANSPORTISTA: Utilizar vehículos que: a) No cuenten con las láminas retrorreflectivas.',
            'code' => 'S.3.a',
            'infringement_agent' => 'Transportista',
            'uit_penalty' => 'Multa de 0.5 de la UIT',
            'pecuniary_sanction' => 2200,
            'administrative_sanction' => 'No aplica',
            'discount_five_days' => 1100,
            'discount_fifteen_days' => 660
        ]);

        # 46
        Infraction::create([
            'description' => 'INFRACCION DEL TRANSPORTISTA: Utilizar vehículos que:\nb) No cuenten con parachoques delantero o posterior.',
            'code' => 'S.3.b',
            'infringement_agent' => 'Transportista',
            'uit_penalty' => 'Multa de 0.5 de la UIT',
            'pecuniary_sanction' => 2200,
            'administrative_sanction' => 'No aplica',
            'discount_five_days' => 1100,
            'discount_fifteen_days' => 660
        ]);

        # 47
        Infraction::create([
            'description' => 'INFRACCION DEL TRANSPORTISTA: Utilizar vehículos que: c) No cuenten con el dispositivo antiempotramiento exigido por el RNV, en el transporte de mercancías.',
            'code' => 'S.3.c',
            'infringement_agent' => 'Transportista',
            'uit_penalty' => 'Multa de 0.5 de la UIT',
            'pecuniary_sanction' => 2200,
            'administrative_sanction' => 'No aplica',
            'discount_five_days' => 1100,
            'discount_fifteen_days' => 660
        ]);

        # 48
        Infraction::create([
            'description' => 'INFRACCION DEL TRANSPORTISTA: Utilizar vehículos que: d) No cuenten con el número mínimo de luces exigidas por el RNV.',
            'code' => 'S.3.d',
            'infringement_agent' => 'Transportista',
            'uit_penalty' => 'Multa de 0.5 de la UIT',
            'pecuniary_sanction' => 2200,
            'administrative_sanction' => 'No aplica',
            'discount_five_days' => 1100,
            'discount_fifteen_days' => 660
        ]);

        # 49
        Infraction::create([
            'description' => 'INFRACCION DEL TRANSPORTISTA: Utilizar vehículos que: e) No cuenten con vidrio parabrisas delantero o éste se encuentre trizado en forma de telaraña, de tal manera que impida la visibilidad del conductor.',
            'code' => 'S.3.e',
            'infringement_agent' => 'Transportista',
            'uit_penalty' => 'Multa de 0.5 de la UIT',
            'pecuniary_sanction' => 2200,
            'administrative_sanction' => 'No aplica',
            'discount_five_days' => 1100,
            'discount_fifteen_days' => 660
        ]);

         # 50
         Infraction::create([
            'description' => 'INFRACCION DEL TRANSPORTISTA: Utilizar vehículos que: f) No cuenten con el limitador de velocidad y/o éste no se encuentre programado de acuerdo a lo dispuesto en el presente Reglamento, cuando éste es exigible.',
            'code' => 'S.3.f',
            'infringement_agent' => 'Transportista',
            'uit_penalty' => 'Multa de 0.5 de la UIT',
            'pecuniary_sanction' => 2200,
            'administrative_sanction' => 'No aplica',
            'discount_five_days' => 1100,
            'discount_fifteen_days' => 660
        ]);

        # 51
        Infraction::create([
            'description' => 'INFRACCION DEL TRANSPORTISTA: Utilizar vehículos que: g) No cuenten con dispositivo registrador de eventos y ocurrencias ó sistema sustitutorio en perfecto estado de funcionamiento.',
            'code' => 'S.3.g',
            'infringement_agent' => 'Transportista',
            'uit_penalty' => 'Multa de 0.5 de la UIT',
            'pecuniary_sanction' => 2200,
            'administrative_sanction' => 'No aplica',
            'discount_five_days' => 1100,
            'discount_fifteen_days' => 660
        ]);

        # 52
        Infraction::create([
            'description' => 'INFRACCION DEL TRANSPORTISTA: Utilizar vehículos que: h) Correspondan a las categorías M o N con neumáticos que no cumplen lo dispuesto por el RNV.',
            'code' => 'S.3.h',
            'infringement_agent' => 'Transportista',
            'uit_penalty' => 'Multa de 0.5 de la UIT',
            'pecuniary_sanction' => 2200,
            'administrative_sanction' => 'No aplica',
            'discount_five_days' => 1100,
            'discount_fifteen_days' => 660
        ]);

        # 53
        Infraction::create([
            'description' => 'INFRACCION DEL TRANSPORTISTA: Utilizar vehículos en los que: a) Alguna de las luces exigidas por el RNV no funcione.',
            'code' => 'S.4.a',
            'infringement_agent' => 'Transportista',
            'uit_penalty' => 'Multa de 0.05 de la UIT',
            'pecuniary_sanction' => 220,
            'administrative_sanction' => 'No aplica',
            'discount_five_days' => 110,
            'discount_fifteen_days' => 66
        ]);

        # 54
        Infraction::create([
            'description' => 'INFRACCION DEL TRANSPORTISTA: Utilizar vehículos en los que: b) Las láminas retrorreflectivas no cumplan lo dispuesto por el RNV.',
            'code' => 'S.4.b',
            'infringement_agent' => 'Transportista',
            'uit_penalty' => 'Multa de 0.05 de la UIT',
            'pecuniary_sanction' => 220,
            'administrative_sanction' => 'No aplica',
            'discount_five_days' => 110,
            'discount_fifteen_days' => 66
        ]);

        # 55
        Infraction::create([
            'description' => 'INFRACCION DEL TRANSPORTISTA: Utilizar vehículos en los que: c) Los neumáticos no cumplen lo dispuesto por el RNV (aplicable sólo para vehículos de la categoría O).',
            'code' => 'S.4.c',
            'infringement_agent' => 'Transportista',
            'uit_penalty' => 'Multa de 0.05 de la UIT',
            'pecuniary_sanction' => 220,
            'administrative_sanction' => 'No aplica',
            'discount_five_days' => 110,
            'discount_fifteen_days' => 66
        ]);

        # 56
        Infraction::create([
            'description' => 'INFRACCION DEL TRANSPORTISTA: Permitir que: a) Se transporte usuarios que excedan el número de asientos indicado por el fabricante del vehículo, con excepción del transporte provincial regular de personas que se realice en vehículos diseñados para el transporte de usuarios de pie.',
            'code' => 'S.5.a',
            'infringement_agent' => 'Transportista',
            'uit_penalty' => 'Multa de 0.5 de la UIT',
            'pecuniary_sanction' => 2200,
            'administrative_sanction' => 'No aplica',
            'discount_five_days' => 0,
            'discount_fifteen_days' => 0
        ]);

        # 57
        Infraction::create([
            'description' => 'INFRACCION DEL TRANSPORTISTA: Permitir que: b) Se transporte mercancías sin estibarlas, atarlas o\nprotegerlas con los elementos necesarios para evitar que se desplacen o caigan del vehículo.',
            'code' => 'S.5.b',
            'infringement_agent' => 'Transportista',
            'uit_penalty' => 'Multa de 0.5 de la UIT',
            'pecuniary_sanction' => 2200,
            'administrative_sanction' => 'No aplica',
            'discount_five_days' => 0,
            'discount_fifteen_days' => 0
        ]);

        # 58
        Infraction::create([
            'description' => 'INFRACCION DEL TRANSPORTISTA: Permitir que: c) Se transporte usuarios que excedan al número establecido, conforme lo establece el presente Reglamento.',
            'code' => 'S.5.c',
            'infringement_agent' => 'Transportista',
            'uit_penalty' => 'Multa de 0.1 de la UIT',
            'pecuniary_sanction' => 440,
            'administrative_sanction' => 'No aplica',
            'discount_five_days' => 0,
            'discount_fifteen_days' => 0
        ]);

        # 59
        Infraction::create([
            'description' => 'INFRACCION DEL TRANSPORTISTA: Permitir que: d) Se preste el servicio de transporte terrestre regular y especial de personas de ámbito nacional y regional, sin contar con los asientos del vehículo fijados rígidamente a la estructura del vehículo.',
            'code' => 'S.5.d',
            'infringement_agent' => 'Transportista',
            'uit_penalty' => 'Multa de 0.1 de la UIT',
            'pecuniary_sanction' => 440,
            'administrative_sanction' => 'No aplica',
            'discount_five_days' => 0,
            'discount_fifteen_days' => 0
        ]);

        # 60
        Infraction::create([
            'description' => 'INFRACCION DEL TRANSPORTISTA: a) Se permita el viaje de menores de más de cinco años en el mismo asiento que un adulto.',
            'code' => 'S.6.a',
            'infringement_agent' => 'Transportista',
            'uit_penalty' => 'Multa de 0.1 de la UIT',
            'pecuniary_sanction' => 440,
            'administrative_sanction' => 'No aplica',
            'discount_five_days' => 220,
            'discount_fifteen_days' => 132
        ]);

        # 61
        Infraction::create([
            'description' => 'INFRACCION DEL TRANSPORTISTA: b) Los conductores que realicen el servicio sobrepasen el límite de edad máximo establecido en el presente Reglamento.',
            'code' => 'S.6.b',
            'infringement_agent' => 'Transportista',
            'uit_penalty' => 'Multa de 0.1 de la UIT',
            'pecuniary_sanction' => 440,
            'administrative_sanction' => 'No aplica',
            'discount_five_days' => 220,
            'discount_fifteen_days' => 132
        ]);

        # 62
        Infraction::create([
            'description' => 'INFRACCION DEL CONDUCTOR: Transportar a sabiendas, productos explosivos, inflamables corrosivos, venenosos o similares, en un vehículo destinado al servicio de transporte de personas.',
            'code' => 'S.7',
            'infringement_agent' => 'Conductor',
            'uit_penalty' => 'No aplica',
            'pecuniary_sanction' => 0,
            'administrative_sanction' => 'Suspensión por noventa (90) días de la habilitación para conducir vehículos del servicio de transporte',
            'discount_five_days' => 0,
            'discount_fifteen_days' => 0
        ]);

        # 63
        Infraction::create([
            'description' => 'INFRACCION DEL CONDUCTOR: Realizar la conducción de un vehículo de transporte con licencia de conducir: a) Que se encuentre vencida.',
            'code' => 'S.8.a',
            'infringement_agent' => 'Conductor',
            'uit_penalty' => 'Multa de 0.5 de la UIT',
            'pecuniary_sanction' => 2200,
            'administrative_sanction' => 'Suspensión por noventa (90) días de la habilitación para conducir vehículos del servicio de transporte',
            'discount_five_days' => 1100,
            'discount_fifteen_days' => 660
        ]);

        # 64
        Infraction::create([
            'description' => 'INFRACCION DEL CONDUCTOR: Realizar la conducción de un vehículo de transporte con licencia de conducir: b) Que se encuentre retenida, suspendida o cancelada.',
            'code' => 'S.8.b',
            'infringement_agent' => 'Conductor',
            'uit_penalty' => 'Multa de 0.5 de la UIT',
            'pecuniary_sanction' => 2200,
            'administrative_sanction' => 'No aplica',
            'discount_five_days' => 1100,
            'discount_fifteen_days' => 660
        ]);

        # 65
        Infraction::create([
            'description' => 'INFRACCION DEL CONDUCTOR: Realizar la conducción de un vehículo de transporte con licencia de conducir: c) Que no corresponda a la clase y categoría requerida por la naturaleza y características del servicio.',
            'code' => 'S.8.c',
            'infringement_agent' => 'Conductor',
            'uit_penalty' => 'Multa de 0.5 de la UIT',
            'pecuniary_sanction' => 2200,
            'administrative_sanction' => 'No aplica',
            'discount_five_days' => 1100,
            'discount_fifteen_days' => 660
        ]);

        # 66
        Infraction::create([
            'description' => 'INFRACCION DEL GENERADOR DE CARGA: No verificar, adoptar y/o ver que el transportista adopte las medidas necesarias la correcta estiba de las mercancías para evitar que se desplace o caiga del vehículo.',
            'code' => 'S.9',
            'infringement_agent' => 'Generador de Carga',
            'uit_penalty' => 'Multa de 0.5 de la UIT',
            'pecuniary_sanction' => 2200,
            'administrative_sanction' => 'No aplica',
            'discount_five_days' => 1100,
            'discount_fifteen_days' => 660
        ]);

         # 67
         Infraction::create([
            'description' => 'INFRACCION DEL TRANSPORTISTA: Ubicar paquetes, equipajes, bultos, encomiendas u otros en el pasadizo del salón del vehículo.',
            'code' => 'S.10',
            'infringement_agent' => 'Transportista',
            'uit_penalty' => 'Multa de 0.1 de la UIT',
            'pecuniary_sanction' => 440,
            'administrative_sanction' => 'No aplica',
            'discount_five_days' => 220,
            'discount_fifteen_days' => 132
        ]);

        # 68
        Infraction::create([
            'description' => 'INFRACCION DEL TRANSPORTISTA: Utilizar vehículos que: a) No cuenten con el sistema de control y monitoreo inalámbrico conforme lo dispuesto por el Reglamento y las normas complementarias',
            'code' => 'S.11.a',
            'infringement_agent' => 'Transportista',
            'uit_penalty' => 'Multa de 0.7 de la UIT',
            'pecuniary_sanction' => 3080,
            'administrative_sanction' => 'No aplica',
            'discount_five_days' => 1540,
            'discount_fifteen_days' => 924
        ]);

        # 69
        Infraction::create([
            'description' => 'INFRACCION DEL TRANSPORTISTA: Utilizar vehículos que: b) No Transmitan a la autoridad competente, a través del sistema de control y monitoreo inalámbrico, la información del vehículo, conforme a lo establecido en el presente reglamento y sus normas complementarias',
            'code' => 'S.11.b',
            'infringement_agent' => 'Transportista',
            'uit_penalty' => 'Multa de 0.5 de la UIT',
            'pecuniary_sanction' => 2200,
            'administrative_sanction' => 'No aplica',
            'discount_five_days' => 1100,
            'discount_fifteen_days' => 660
        ]);

        # 70
        Infraction::create([
            'description' => 'INFRACCION DEL TRANSPORTISTA: Utilizar vehículos que: b) No Transmitan a la autoridad competente, a través del sistema de control y monitoreo inalámbrico, la información del vehículo, conforme a lo establecido en el presente reglamento y sus normas complementarias',
            'code' => 'S.11.c',
            'infringement_agent' => 'Transportista',
            'uit_penalty' => 'Multa de 0.9 de la UIT',
            'pecuniary_sanction' => 3960,
            'administrative_sanction' => 'No aplica',
            'discount_five_days' => 1980,
            'discount_fifteen_days' => 1188
        ]);

        # 71
        Infraction::create([
            'description' => 'a) Permitir el comercio ambulatorio de productos dentro de la infraestructura, en las áreas de embarque y desembarque de usuarios.',
            'code' => 'T.1.a',
            'infringement_agent' => 'Operador de la Infraestructura Complementario /Propietario / Arrendatario',
            'uit_penalty' => 'Multa de 0.1 de la UIT',
            'pecuniary_sanction' => 440,
            'administrative_sanction' => 'No aplica',
            'discount_five_days' => 220,
            'discount_fifteen_days' => 132
        ]);

        # 72
        Infraction::create([
            'description' => 'b) Permitir que los transportistas utilicen artefactos que emitan sonidos que perturben la tranquilidad de los usuarios y/o de los vecinos de la infraestructura mientras hacen uso de la infraestructura.',
            'code' => 'T.1.b',
            'infringement_agent' => 'Operador de la Infraestructura Complementario /Propietario / Arrendatario',
            'uit_penalty' => 'Multa de 0.1 de la UIT',
            'pecuniary_sanction' => 440,
            'administrative_sanction' => 'No aplica',
            'discount_five_days' => 220,
            'discount_fifteen_days' => 132
        ]);

        # 73
        Infraction::create([
            'description' => 'c) Permitir que el transportista o terceros oferten los servicios de transporte dentro de la infraestructura, incumpliendo lo que dispone el reglamento interno, directivas o normas de uso de la infraestructura.',
            'code' => 'T.1.c',
            'infringement_agent' => 'Operador de la Infraestructura Complementario /Propietario / Arrendatario',
            'uit_penalty' => 'Multa de 0.1 de la UIT',
            'pecuniary_sanction' => 440,
            'administrative_sanction' => 'No aplica',
            'discount_five_days' => 220,
            'discount_fifteen_days' => 132
        ]);

        # 74
        Infraction::create([
            'description' => 'Modificar las características o condiciones de operación de la infraestructura complementaria, sin contar con la autorización de la autoridad competente.',
            'code' => 'T.2',
            'infringement_agent' => 'Operador de la Infraestructura Complementario /Propietario / Arrendatario',
            'uit_penalty' => 'Multa de 0.5 de la UIT',
            'pecuniary_sanction' => 2200,
            'administrative_sanction' => 'No aplica',
            'discount_five_days' => 0,
            'discount_fifteen_days' => 0
        ]);

        # 75
        Infraction::create([
            'description' => 'Operar una infraestructura complementaria sin contar con el respectivo Certificado de Habilitación Técnica.',
            'code' => 'T.3',
            'infringement_agent' => 'Operador de la Infraestructura Complementario /Propietario / Arrendatario',
            'uit_penalty' => 'Multa de 0.5 de la UIT',
            'pecuniary_sanction' => 2200,
            'administrative_sanction' => 'No aplica',
            'discount_five_days' => 0,
            'discount_fifteen_days' => 0
        ]);

        # 76
        Infraction::create([
            'description' => 'Proporcionar a la autoridad competente información que no se ajusta a la verdad, con el propósito de simular el cumplimiento de las condiciones de acceso y permanencia.',
            'code' => 'T.4',
            'infringement_agent' => 'Operador de la Infraestructura Complementario /Propietario / Arrendatario',
            'uit_penalty' => 'Multa de 0.5 de la UIT',
            'pecuniary_sanction' => 2200,
            'administrative_sanction' => 'No aplica',
            'discount_five_days' => 1100,
            'discount_fifteen_days' => 660
        ]);

        //TABLA DE INFRACCIONES Y SANCIONES SOBRE LOS LINEAMIENTOS SECTORIALES PARA LA PREVENCIÓN DEL COVID-19 EN LA PRESTACIÓN DEL SERVICIO DE TRANSPORTE TERRESTRE (Establecido por la modificacion Decreto Supremo N° DS N° 016-2020-MTC)

        # 77

        Infraction::create([
            'description' => 'No utilizar la mascarilla y el protector facial, según corresponda, durante la conducción de un vehículo del servicio de transporte, de acuerdo con lo dispuesto en los lineamientos sectoriales para la prevención del COVID-19 en la prestación del servicio de transporte terrestre, aprobado por el MTC.',
            'code' => 'V.6',
            'infringement_agent' => 'Conductor',
            'uit_penalty' => 'Multa de 0.1 de la UIT',
            'pecuniary_sanction' => 440,
            'administrative_sanction' => 'Retención de la licencia de conducir',
            'discount_five_days' => 0,
            'discount_fifteen_days' => 0
        ]);

        # 78
        Infraction::create([
            'description' => 'Realizar la conducción de un vehículo del servicio de transporte: sin cumplir con el aforo al transportar usuarios que exceden el número de asientos señalados en la Tarjeta de Identificación Vehicular y/o usuarios de pie; y/o utilizando los asientos del vehículo señalizados o que no pueden ser empleados; y/o que no cuenta con las cortinas de polietileno u otro material análogo para el aislamiento entre asientos; y/o permitiendo que un usuario sea transportado sin utilizar su mascarilla y protector facial; Según corresponda, de acuerdo con lo establecido en los lineamientos sectoriales para la prevención del COVID-19 en la prestación del servicio de transporte terrestre, aprobado por el MTC.',
            'code' => 'V.7',
            'infringement_agent' => 'Conductor',
            'uit_penalty' => 'Multa de 0.1 de la UIT',
            'pecuniary_sanction' => 440,
            'administrative_sanction' => 'Retención de la licencia de conducir',
            'discount_five_days' => 0,
            'discount_fifteen_days' => 0
        ]);

        # 79
        Infraction::create([
            'description' => 'Art. 31.6
            Actualizarse, anualmente mediante los cursos de capacitación establecidos por la autoridad
            competente. (D. S. N° 006-2010-MTC del 22.01.2010 ).
            Art. 31.10
            No debe tener su licencia de conducir suspendida, retenida o cancelada, o que el conductor no debe
            llegar o excederse del tope máximo de cien (100) puntos firmes o que tenga impuesta dos o más
            infracciones cuya calificación sean muy graves; cinco o más infracciones cuya calificación sean graves; o
            una infracción muy grave y tres o más infracciones cuya calificación sea grave. (D. S. N° 003-2014-MTC
            del 24.04.2014 )',
            'code' => 'C-2 c',
            'infringement_agent' => 'Conductor',
            'uit_penalty' => 'No aplica',
            'pecuniary_sanction' => 0,
            'administrative_sanction' => 'Suspensión de la habilitación del conductor por 60 días',
            'discount_five_days' => 0,
            'discount_fifteen_days' => 0
        ]);

        # 80
        Infraction::create([
            'description' => 'Art. 41.2.5.4
            Por conducir vehículos del servicio de transporte, bajo la influencia de alcohol y/o sustancias
            estupefacientes. (D. S. N° 017-2009-MTC del 22.04.2009 )',
            'code' => 'C-4 b',
            'infringement_agent' => 'Conductor',
            'uit_penalty' => 'No aplica',
            'pecuniary_sanction' => 0,
            'administrative_sanction' => 'Suspensión de la autorización por 90 días para prestar el servicio de transporte terrestre',
            'discount_five_days' => 0,
            'discount_fifteen_days' => 0
        ]);

        # 81
        Infraction::create([
            'description' => 'El incumplimiento de cualquiera de las condiciones de acceso y permanencia previstas en los siguientes artículos: Artículo 20.- Numeral 20.1.13, Artículo 24, Artículo 27, Artículo 28, Artículo 41.- Numerales 41.3.1, 41.3.5.5, 41.3.5.6 y 41.3.5.7, Artículo 42.- Numerales 42.1.16, 42.1.8, 42.2.1, 42.2.2, 42.2.5, Artículo 64.- Numerales 64.1 y 64.5, Artículo 66.- Numeral 66.2, Artículo 69 que no se encuentren tipificadas como infraccion',
            'code' => 'C-1b',
            'infringement_agent' => 'Conductor',
            'uit_penalty' => 'No aplica',
            'pecuniary_sanction' => 0,
            'administrative_sanction' => 'Suspensión de la Habilitación Vehicular por 90 días. En forma sucesiva: Interrupción de viaje,Remoción del vehículo, Internamiento del vehículo. En los casos que corresponda: Suspensión de la habilitación vehicular.',
            'discount_five_days' => 0,
            'discount_fifteen_days' => 0
        ]);

        # 82
        Infraction::create([
            'description' => 'Prestar el servicio de transporte( con conductores que cuenten )con licencia de conducir que no corresponda a la clase y categoria requerida para el vehiculo que conduce.',
            'code' => 'T.15',
            'infringement_agent' => 'Conductor',
            'uit_penalty' => 'Multa de 0.5 de la UIT',
            'pecuniary_sanction' => 2200,
            'administrative_sanction' => 'Internamiento del vehiculo en el DMV',
            'discount_five_days' => 0,
            'discount_fifteen_days' => 0
        ]);

        # 83
        Infraction::create([
            'description' => 'No cumplir con el aforo del vehículo, transportando usuarios que exceden el número de asientos señalados en la Tarjeta de Identificación Vehicular y/o usuarios de pie; y/o no señalizar los asientos del vehículo que no deben ser usados por los usuarios; y/o no implementar las cortinas de polietileno u otro material análogo en el vehículo; según corresponda, de acuerdo con lo establecido en los lineamientos sectoriales para la prevención del COVID-19 en la prestación del servicio de transporte terrestre, aprobado por el MTC',
            'code' => 'V.1',
            'infringement_agent' => 'Transportista',
            'uit_penalty' => 'Multa de 0.5 de la UIT',
            'pecuniary_sanction' => 2200,
            'administrative_sanction' => 'En forma sucesiva
            - Interrupción del viaje
            - Retención del vehículo
            - Internamiento preventivo
            del vehículo
            - Suspensión precautoria
            de la habilitación vehicular
            ',
            'discount_five_days' => 0,
            'discount_fifteen_days' => 0
        ]);

        #84
        Infraction::create([
            'description' => 'Prestar el servicio de transporte sin haber realizado la limpieza y/o la desinfección del vehículo, de acuerdo con lo establecido en los lineamientos sectoriales para la prevención del COVID-19 en la prestación del servicio de transporte terrestre, aprobado por el MTC.',
            'code' => 'V.2',
            'infringement_agent' => 'Transportista',
            'uit_penalty' => 'Multa de 0.5 de la UIT',
            'pecuniary_sanction' => 2200,
            'administrative_sanction' => 'En forma sucesiva
            - Interrupción del viaje
            - Retención del vehículo
            - Internamiento preventivo
            del vehículo
            - Suspensión precautoria
            de la habilitación vehicular',
            'discount_five_days' => 0,
            'discount_fifteen_days' => 0
        ]);

        #85
        Infraction::create([
            'description' => 'No proporcionar al conductor, a la tripulación y al cobrador, mascarillas y protector facial para la prestación del servicio de transporte, según corresponda, de acuerdo con lo establecido en los lineamientos sectoriales para la prevención del COVID-19 en la prestación del servicio de transporte terrestre, aprobado por el MTC.',
            'code' => 'V.3',
            'infringement_agent' => 'Transportista',
            'uit_penalty' => 'Multa de 0.1 de la UIT',
            'pecuniary_sanction' => 440,
            'administrative_sanction' => 'En forma sucesiva
            - Interrupción del viaje
            - Retención del vehículo
            - Internamiento preventivo
            del vehículo.',
            'discount_five_days' => 0,
            'discount_fifteen_days' => 0
        ]);

        #86
        Infraction::create([
            'description' => 'No realizar el control de temperatura a los usuarios con termómetro infrarrojo, antes del embarque al vehículo, cuando corresponda, de acuerdo con lo establecido en los lineamientos sectoriales para la prevención del COVID-19 en la prestación del servicio de transporte terrestre, aprobado por el MTC.',
            'code' => 'V.4',
            'infringement_agent' => 'Transportista',
            'uit_penalty' => 'Multa de 0.1 de la UIT',
            'pecuniary_sanction' => 440,
            'administrative_sanction' => 'En forma sucesiva
            - Interrupción del viaje
            - Retención del vehículo
            - Internamiento preventivo
            del vehículo',
            'discount_five_days' => 0,
            'discount_fifteen_days' => 0
        ]);

        #87
        Infraction::create([
            'description' => 'Prestar el servicio de transporte incumpliendo los lineamientos sectoriales para la prevención del COVID-19 en la prestación del servicio de transporte terrestre, aprobado por el MTC, con excepción de lo dispuesto en los numerales 41.1.11, 41.1.12, 41.1.13 y 41.1.14 del artículo 41 del presente Reglamento.',
            'code' => 'V.5',
            'infringement_agent' => 'Transportista',
            'uit_penalty' => 'Multa de 0.05 de la UIT',
            'pecuniary_sanction' => 220,
            'administrative_sanction' => 'No aplica',
            'discount_five_days' => 0,
            'discount_fifteen_days' => 0
        ]);


        #88
        Infraction::create([
            'description' => 'Realizar la conducción de un vehículo del servicio de transporte incumpliendo los lineamientos sectoriales para la prevención del COVID-19 en la prestación del servicio de transporte terrestre, aprobado por el MTC, con excepción de lo dispuesto en los numerales 31.11 y 31.12 del artículo 31 del presente Reglamento.',
            'code' => 'V.8',
            'infringement_agent' => 'Conductor',
            'uit_penalty' => 'Multa de 0.05 de la UIT',
            'pecuniary_sanction' => 220,
            'administrative_sanction' => 'No aplica',
            'discount_five_days' => 0,
            'discount_fifteen_days' => 0
        ]);

        #89
        Infraction::create([
            'description' => 'Operar la infraestructura complementaria sin observar las medidas mínimas de limpieza y/o desinfección y/o aforo establecidas en los lineamientos sectoriales para la prevención del COVID-19 en la prestación del servicio de transporte terrestre, aprobado por el MTC.',
            'code' => 'V.9',
            'infringement_agent' => 'Operador de infraestructura complementaria de transporte',
            'uit_penalty' => 'Multa de 0.5 de la UIT',
            'pecuniary_sanction' => 2200,
            'administrative_sanction' => 'Suspensión precautoria del servicio',
            'discount_five_days' => 0,
            'discount_fifteen_days' => 0
        ]);

        #90
        Infraction::create([
            'description' => 'No proporcionar a su personal mascarillas para la prestación del servicio, de acuerdo con lo dispuesto en los lineamientos sectoriales para la prevención del COVID-19 en la prestación del servicio de transporte terrestre, aprobado por el MTC.',
            'code' => 'V.10',
            'infringement_agent' => 'Operador de infraestructura complementaria de transporte',
            'uit_penalty' => 'Multa de 0.1 de la UIT',
            'pecuniary_sanction' => 440,
            'administrative_sanction' => 'No aplica',
            'discount_five_days' => 0,
            'discount_fifteen_days' => 0
        ]);

        #91
        Infraction::create([
            'description' => 'Operar la infraestructura complementaria incumpliendo los lineamientos sectoriales para la prevención del COVID-19 en la prestación del servicio de transporte terrestre, aprobado por el MTC, con excepción de lo dispuesto en los numerales 35.10 y 35.11 del artículo 35 del presente Reglamento.',
            'code' => 'V.11',
            'infringement_agent' => 'Operador de infraestructura complementaria de transporte',
            'uit_penalty' => 'Multa de 0.05 de la UIT',
            'pecuniary_sanction' => 220,
            'administrative_sanction' => 'No aplica',
            'discount_five_days' => 0,
            'discount_fifteen_days' => 0
        ]);

    }
}
