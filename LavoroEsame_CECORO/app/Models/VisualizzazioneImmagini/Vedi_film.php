<?php

namespace App\Models\VisualizzazioneImmagini;

use App\Models\MainContent\Film;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vedi_film extends Model
{
    use HasFactory;
    protected $table = "vedi_film";
    protected $primaryKey = "idFormatoFilm";

    protected $fillable = [
        'percorsoFilm'
    ];

    /**
     * The PK of his originary table passes to other tables
     * 
     * @param null
     * @return PrimaryKey
     */
    public function film()
    {
        return $this->hasOne(Film::class, 'idFilm', 'idFilm');
    }
}
