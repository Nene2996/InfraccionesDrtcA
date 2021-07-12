<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CampusInspector extends Model
{
    use HasFactory;
    protected $table = 'campus_inspectors';
    protected $fillable = ['inspector_id', 'campus_id'];
}
