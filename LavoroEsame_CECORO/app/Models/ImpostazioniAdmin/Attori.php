<?php

namespace App\Models\ImpostazioniAdmin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Attori extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = "attori";
    protected $primaryKey = "idAttore";

    protected $fillable = [
        'nomeAttore',
        'cognomeAttore',
        'annoNascita'
    ];
}
