<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InspectionActResolution extends Model
{
    use HasFactory;
    protected $table = 'inspection_act_resolution';

    protected $fillable = [
        'inspection_act_id',
        'resolution_id',
        'date_notification_driver',
        'type_act'
    ];
}
