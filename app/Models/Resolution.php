<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resolution extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'date_resolution',
        'type',
        'url',
        'size'
    ];

    //relacion muchos a muchos Inspection Act
    public function inspections()
    {
        return $this->belongsToMany(Inspection::class, 'inspection_act_resolution', 'resolution_id', 'inspection_act_id')->withPivot('resolution_id', 'date_notification_driver','type_act', 'created_at')->withTimestamps();
    }

    //relacion muchos a muchos Control Act
    public function controlActs()
    {
        return $this->belongsToMany(ControlAct::class, 'control_act_resolution', 'resolution_id', 'control_act_id')->withPivot('resolution_id', 'date_notification_driver','type_act', 'created_at')->withTimestamps();
    }
}
