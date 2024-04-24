<?php

namespace App\Models\ImpostazioniSito;

use App\Models\MainContent\Film;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CreditiFilm extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = "crediti_film";

    protected $primaryKey = "idCreditiFilm";
    protected $fillable = [
        'idFilm',
        'creditiNecessari'
    ];

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
}
