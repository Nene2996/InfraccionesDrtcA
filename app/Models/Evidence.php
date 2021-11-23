<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evidence extends Model
{
    use HasFactory;

    protected $table = 'evidences';
    protected $fillable = ['description']; 
    
    /*
    //Relacion uno a muchos
    public function inspections()
    {
        return $this->hasMany('App\Models\Inspection');
    }
    */

    //Relacion muchos a muchos inversa polimorfica
    public function inspections()
    {
        return $this->morphedByMany('App\Models\Inspection', 'evidenceable');
    }

    //Relacion muchos a muchos inversa polimorfica
    public function controlActs()
    {
        return $this->morphedByMany('App\Models\ControlAct', 'evidenceable');
    }

}
