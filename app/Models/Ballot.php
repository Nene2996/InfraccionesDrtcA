<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ballot extends Model
{
    use HasFactory;

    protected $table = 'papeletas';
    protected $fillable = [
        'dni',
        'ruc',
        'razon_social',
        'nombre_apellidos',
        'placa_vehiculo',
        'lugar_intervencion',
        'origen',
        'destino',
        'nombre_conductor',
        'direccion_infractor',
        'nro_licencia',
        'fecha_infraccion',
        'hora_infraccion',
        'clase_categoria_licencia',
        'nro_tarjeta_vehicular',
        'codigo_infraccion',
        'observaciones_verificacion',
        'manifestacion_usuario',
        'nro_acta',
        'servicio',
        'estado_actual',
        'fecha_cancelacion',
        'nro_boleta_pago',
        'idinspectores',
        'fecha_registro_infraccion',
        'sede_infraccion',
        'id_district',
        'informacion_adicional',
        'referencia',
        'descripcion',
        'calificacion'
        ];
    
    public $timestamps = false;
    protected $rules = [];
}
