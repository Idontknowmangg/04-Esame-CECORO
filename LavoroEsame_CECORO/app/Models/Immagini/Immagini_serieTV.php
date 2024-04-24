<?php

namespace App\Models\Immagini;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Immagini_serieTV extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = "immagini_serietv";
    protected $primaryKey = "idImmagineSerieTV";

    protected $fillable = [
        "percorsoImmagineSerieTV"
    ];
}
