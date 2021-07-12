<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;

    protected $fillable = ['plate_number','identification_card_number'];

    //Relacion uno a muchos
    public function inspections()
    {
        return $this->hasMany('App\Models\Inspection');
    }
}
