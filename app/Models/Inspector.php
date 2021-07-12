<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inspector extends Model
{
    use HasFactory;

    protected $fillable = ['surnames_and_names',
                            'dni',
                            'status'];

    //Relacion uno a muchos
    public function inspections()
    {
        return $this->hasMany('App\Models\Inspection');
    }

    //Relacion muchos a muchos
    public function campus()
    {
        return $this->belongsToMany('App\Models\Campus', 'campus_inspectors', 'inspector_id', 'campus_id');
    }
}
