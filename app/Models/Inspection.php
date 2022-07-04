<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inspection extends Model
{
    use HasFactory;

    protected $table = 'inspection_act';

    protected $fillable = [
        'act_number',
        'names_business_name',
        'address',
        'document_number',
        'licence_number',
        'qualification',
        'date_infraction',
        'hour_infraction',
        'additional_Information',
        'place',
        'reference',
        'observation',
        'description',
        'vehicle_id',
        'district_id',
        'evidence_id',
        'inspector_id',
        'campus_id',
        'infraction_id',
        'typeNames_id',
        'typeDocument_id',
        'user_id',
        'status'
    ];

    //Relacion uno a muchos (inversa)
    public function vehicle()
    {
        return $this->belongsTo('App\Models\Vehicle');
    }

    //Relacion uno a muchos (inversa)
    public function typeName()
    {
        return $this->belongsTo('App\Models\TypeName','typeNames_id', 'id');
    }

    //Relacion uno a muchos (inversa)
    public function typeDocument()
    {
        return $this->belongsTo('App\Models\TypeDocument');
    }

    //Relacion uno a muchos (inversa)
    public function district()
    {
        return $this->belongsTo('App\Models\District');
    }

    //Relacion uno a muchos (inversa)
    public function campus()
    {
        return $this->belongsTo('App\Models\Campus');
    }

    //Relacion uno a muchos (inversa)
    public function inspector()
    {
        return $this->belongsTo('App\Models\Inspector');
    }

    //Relacion uno a muchos (inversa)
    public function infraction()
    {
        return $this->belongsTo('App\Models\Infraction');
    }
    //Relacion uno a muchos (inversa)
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    //Relacion muchos a muchos
    public function resolutions()
    {
        return $this->belongsToMany(Resolution::class, 'inspection_act_resolution', 'inspection_act_id', 'resolution_id')->withPivot('inspection_act_id', 'id', 'date_notification_driver','type_act', 'created_at', 'updated_at')->withTimestamps()->orderBy('inspection_act_resolution.created_at','asc');
    }

    //verificar si existe la resolución
    public function hasResolution($idInspection)
    {
        return InspectionActResolution::where('inspection_act_id', $idInspection)->exists();
    }

    //verificar si existe resolución de Sanción asociada.
    public function hasResolutionSancion($idInspectionAct)
    {
        return InspectionActResolution::where('inspection_act_id', $idInspectionAct)->where('type_act', 'ACTA DE FISCALIZACION')->exists();
    }

    //relacion uno a uno polimorfica
    public function file()
    {
        return $this->morphOne(File::class, 'fileable');
    }

    //Relacion muchos a muchos polimorfica
    public function evidences()
    {
        return $this->morphToMany('App\Models\Evidence', 'evidenceable')->withPivot('evidence_id', 'file_evidence_id', 'created_at')->withTimestamps();
    }

    //Relacion uno a muchos polimorfica
    public function paiments()
    {
        return $this->morphMany('App\Models\Paiment', 'paimentable');
    }

    public function hasPaiment($inspectionId)
    {
        $inspection = Inspection::findOrFail($inspectionId);
        return $inspection::paiments()->exists();
    }
}
