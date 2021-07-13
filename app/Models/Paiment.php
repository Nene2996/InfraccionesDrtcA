<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paiment extends Model
{
    use HasFactory;

    protected $table = 'paiments';
    protected $fillable = ['date_payment', 'proof_number', 'total_amount', 'type_proof_id', 'inspection_act_id', 'user_id'];

    public function typeProof()
    {
        return $this->belongsTo('App\Models\TypeProof');
    }

    public function inspection()
    {
        return $this->belongsTo('App\Models\Inspection', 'inspection_act_id');
    }
    
}
