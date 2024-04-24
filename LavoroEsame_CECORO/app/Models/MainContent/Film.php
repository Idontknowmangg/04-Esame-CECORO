<?php

namespace App\Models\MainContent;

use App\Models\Immagini\Immagini_film;
use App\Models\ImpostazioniGenere\Film_hasGenere;
use App\Models\ImpostazioniGenere\Genere;
use App\Models\ImpostazioniSito\CreditiFilm;
use App\Models\VisualizzazioneImmagini\Vedi_film;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Film extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = "film";
    protected $primaryKey = "idFilm";

    protected $fillable = [
        'titoloFilm',
        'idGenere',
        'idImmagineFilm',
        'idFormatoFilm',
        'descrizione',
        'regista',
        'anno',
        'durata'
    ];

    /**
     * The PK of his originary table passes to other tables
     * 
     * @param null
     * @return PrimaryKey
     */
    public function FilmGenere()
    {
        return $this->hasMany(Film_hasGenere::class, 'idFilm', 'idFilm');
    }

    public function FilmCrediti()
    {
        return $this->hasMany(CreditiFilm::class, 'idFilm', 'idFilm');
    }

        //       ---------------------------    FK    ---------------------------


    /**
     * The table that passed his PK to another table will be transformed into FK
     * 
     * @param null
     * @return ForeignKey
     */
    public function GenereFK()
    {
        return $this->belongsTo(Genere::class, 'idGenere', 'idGenere');
    }
    
    public function immaginiFilmFK()
    {
        return $this->belongsTo(Immagini_film::class, 'idImmagineFilm', 'idImmagineFilm');
    }

    public function vediFilm_FK()
    {
        return $this->belongsTo(Vedi_film::class, 'idFormatoFilm', 'idFormatoFilm');
    }
}
