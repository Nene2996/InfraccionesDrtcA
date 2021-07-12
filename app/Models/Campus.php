<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Campus extends Model
{
    use HasFactory;

    protected $table = 'campus';

    protected $fillable = ['campus_name'];

    //Relacion uno a muchos
    public function inspections()
    {
        return $this->hasMany('App\Models\Inspection');
    }

    //Relacion muchos a muchos
    public function inspectors()
    {
        return $this->belongsToMany('App\Models\Inspector', 'campus_inspectors');
    }

    //Relacion uno a muchos
    public function users()
    {
        return $this->hasMany('App\Models\User');
    }
}
