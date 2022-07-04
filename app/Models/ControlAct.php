<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ControlAct extends Model
{
    use HasFactory;
    protected $table = 'control_act';
    //public $timestamps = false;
    protected $fillable = [
        'id',
        'numero_acta',
        'ruc_dni',
        'nro_dni_conductor',
        'razon_social_nombre',
        'nro_habilitacion',
        'placa_vehiculo',
        'lugar_intervencion',
        'origen',
        'destino',
        'apellidos_nombres_conductor',
        'nro_licencia',
        'fecha_infraccion',
        'hora_infraccion',
        'clase_categoria_licencia',
        'descripcion_infraccion',
        'manifestacion_usuario',
        'tipo_servicio',
        'estado_actual',
        'monto_pagado',
        'nro_boleta_pago',
        'fecha_pago_infraccion',
        'fecha_registro_infraccion',
        'infraction_id',
        'inspector_id',
        'campus_id'
    ];

    public function infractions()
    {
        return $this->belongsTo('App\Models\Infraction', 'infraction_id');
    }

    //relacion muchos a muchos
    public function resolutions()
    {
        return $this->belongsToMany('App\Models\Resolution', 'control_act_resolution', 'control_act_id', 'resolution_id')->withPivot('control_act_id', 'id', 'date_notification_driver', 'type_act')->withTimestamps()->orderBy('control_act_resolution.created_at','asc');
    }

    public function hasResolution($idControlAct)
    {
        return ControlActResolution::where('control_act_id', $idControlAct)->exists();
    }

    public function hasResolutionSancion($idControlAct)
    {
        return ControlActResolution::where('control_act_id', $idControlAct)
                                    ->where('type_act', 'ACTA DE CONTROL')
                                    ->exists();
    }

    public function hasPaiment($controlActId)   
    {
        $controlActId = ControlAct::findOrFail($controlActId);
        return $controlActId::paiments()->exists();
    }

    //relacion uno a uno polimorfica
    public function file()
    {
        return $this->morphOne(File::class, 'fileable');
    }

    //Relacion muchos a muchos polimorfica
    public function evidences()
    {
        return $this->morphToMany('App\Models\Evidence', 'evidenceable');
    }

    //Relacion uno a muchos polimorfica
    public function paiments()
    {
        return $this->morphMany('App\Models\Paiment', 'paimentable');
    }

    public function campus()
    {
        return $this->belongsTo('App\Models\Campus', 'campus_id');
    }

    public function inspector()
    {
        return $this->belongsTo('App\Models\Inspector');
    }
}
