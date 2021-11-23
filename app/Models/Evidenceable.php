<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evidenceable extends Model
{
    use HasFactory;
    protected $table = 'evidenciables';

    public function videos()
    {
        return $this->hasMany('App\Models\Video');
    }

    public function pictures()
    {
        return $this->hasMany('App\Models\Picture');
    }
}
