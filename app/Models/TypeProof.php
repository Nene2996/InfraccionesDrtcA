<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeProof extends Model
{
    use HasFactory;

    protected $table = 'type_proof';
    protected $fillable = ['type'];

    public function paiments(){
        return $this->hasMany('App\Models\Paiment');
    }

}
