<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeName extends Model
{
    use HasFactory;

    protected $table = 'type_names';
    protected $fillable = ['type_name'];

    //Relacion uno a muchos
    public function inspections()
    {
        return $this->hasMany('App\Models\Inspection', 'typeNames_id', 'id');
    }
}
