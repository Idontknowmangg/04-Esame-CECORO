<?php

namespace App\Models\ImpostazioniGenere;

use App\Models\MainContent\Film;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Film_hasGenere extends Model
{
    use HasFactory;
    protected $table = "film_has_genere";
    protected $primaryKey = "idTracciaFilm";

    protected $fillable = [
        'idFilm',
        'idGenere'
    ];


        //       ---------------------------    FK    ---------------------------


    /**
     * The table that passed his PK to another table will be transformed into FK
     * 
     * @param null
     * @return ForeignKey
     */
    public function FilmFK()
    {
        return $this->belongsTo(Film::class, 'idFilm', 'idFilm');
    }

    public function GenereFK()
    {
        return $this->belongsTo(Genere::class, 'idGenere', 'idGenere');
    }
}
