<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Uit extends Model
{
    use HasFactory;

    protected $table = 'uit';
    protected $fillable = [
        'year',
        'amount_uit',
        'start_date',
        'end_date'
    ];
}
