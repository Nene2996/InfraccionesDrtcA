<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    use HasFactory;

    //Relacion uno a muchos
    public function inspections()
    {
        return $this->hasMany('App\Models\Inspection');
    }

    //Relacion uno a muchos (inversa)
    public function province()
    {
        return $this->belongsTo('App\Models\Province');
    }
}
