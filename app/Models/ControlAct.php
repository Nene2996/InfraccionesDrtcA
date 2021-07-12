<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ControlAct extends Model
{
    use HasFactory;
    protected $table = 'control_act';

    public function infractions()
    {
        return $this->belongsTo('App\Models\Infraction', 'codigo_infraccion');
    }
}
