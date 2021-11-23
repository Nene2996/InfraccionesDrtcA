<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ControlActResolution extends Model
{
    use HasFactory;
    protected $table = 'control_act_resolution';

    protected $fillable = [
        'control_act_id',
        'resolution_id',
        'date_notification_driver',
        'type_act'
    ];
}
