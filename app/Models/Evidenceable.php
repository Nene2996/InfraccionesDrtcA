<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evidenceable extends Model
{
    use HasFactory;
    protected $table = 'evidenceables';

    public function FileEvidence()
    {
        return $this->belongsTo('App\Models\FileEvidence', 'file_evidence_id');
    }

    public function TypeEvidence()
    {
        return $this->belongsTo('App\Models\Evidence', 'evidence_id');
    }
}
