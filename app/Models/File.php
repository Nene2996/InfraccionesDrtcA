<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;

    protected $fillable = [
        'url_path',
        'size',
        'fileable_id',
        'fileable_type'
    ];

    public function fileable()
    {
        return $this->morphTo();
    }
}