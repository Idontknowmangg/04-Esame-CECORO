<?php

namespace App\Models\ImpostazioniSito;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sottotitoli extends Model
{
    use HasFactory;
    protected $table = "sottotitoli";
    protected $primaryKey = "idSottotitolo";

    protected $fillable = [
        'linguaSottotitolo'
    ];
}
