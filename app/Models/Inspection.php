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
    public function evidence()
    {
        return $this->belongsTo('App\Models\Evidence');
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

    public function paiments(){
        return $this->hasMany('App\Models\Paiment', 'inspection_act_id');
    }
}
