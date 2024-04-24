<?php

namespace App\Models\Immagini;

use App\Models\MainContent\Film;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Immagini_film extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = "immagini_film";
    protected $primaryKey = "idImmagineFilm";

    protected $fillable = [
        'percorsoImmagineFilm'
    ];

    /**
     * The PK of his originary table passes to other tables
     * 
     * @param null
     * @return PrimaryKey
     */
    public function film()
    {
        return $this->hasOne(Film::class, 'idImmagineFilm', 'idImmagineFilm');
    }
}
