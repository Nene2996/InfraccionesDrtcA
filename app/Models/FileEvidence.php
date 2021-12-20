<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FileEvidence extends Model
{
    use HasFactory;

    protected $table = 'file_evidences';
    protected $fillable = [
        'size',
        'url_path'
    ];
}
