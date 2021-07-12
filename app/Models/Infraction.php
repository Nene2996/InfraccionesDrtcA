<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Infraction extends Model
{
    use HasFactory;

     //Relacion uno a muchos
     public function inspections()
     {
         return $this->hasMany('App\Models\Inspection');
     }

     //Relacion uno a muchos
     public function controlActs()
     {
         return $this->hasMany('App\Models\ControlAct', 'codigo_infraccion');
     }

}
