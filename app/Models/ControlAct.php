<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ControlAct extends Model
{
    use HasFactory;
    protected $table = 'control_act';
    public $timestamps = false;
    protected $fillable = [
        'id',
        'ruc',
        'dni',
        'razon_social',
        'placa_vehiculo',
        'lugar_intervencion',
        'origen',
        'destino',
        'nombre_apellidos',
        'direccion_infractor',
        'nro_licencia',
        'fecha_infraccion',
        'hora_infraccion',
        'clase_categoria_licencia',
        'nro_tarjeta_vehicular',
        'codigo_infraccion',
        'observaciones_intervenido',
        'manifestacion_usuario',
        'nro_acta',
        'servicio',
        'estado_actual',
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

    public function infractions()
    {
        return $this->belongsTo('App\Models\Infraction', 'codigo_infraccion');
    }
}
