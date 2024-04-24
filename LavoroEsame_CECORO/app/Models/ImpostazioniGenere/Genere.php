<?php

namespace App\Models\ImpostazioniGenere;

use App\Models\MainContent\Documentari;
use App\Models\MainContent\Film;
use App\Models\MainContent\SerieTV;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Genere extends Model
{
    use HasFactory;
    protected $table = "genere";
    protected $primaryKey = "idGenere";

    protected $fillable = [
        'nomeGenere'
    ];

    /**
     * The PK of his originary table passes to other tables
     * 
     * @param null
     * @return PrimaryKey
     */
    public function documentarioHasGenere()
    {
        return $this->hasMany(Documentario_hasGenere::class, 'idGenere', 'idGenere');
    }

    public function filmHasGenere()
    {
        return $this->hasMany(Film_hasGenere::class, 'idGenere', 'idGenere');
    }

    public function serieTVHasGenere()
    {
        return $this->hasMany(SerieTV_hasGenere::class, 'idGenere', 'idGenere');
    }

    public function documentario()
    {
        return $this->hasMany(Documentari::class, 'idGenere', 'idGenere');
    }

    public function film()
    {
        return $this->hasMany(Film::class, 'idGenere', 'idGenere');
    }

    public function serieTV()
    {
        return $this->hasMany(SerieTV::class, 'idGenere', 'idGenere');
    }
}